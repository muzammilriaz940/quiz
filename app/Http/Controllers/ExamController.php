<?php
  
namespace App\Http\Controllers;
   
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::latest()->paginate(5);
        return view('exams.index',compact('exams'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('exams.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'testId' => 'required',
        ]);

        $request->merge(['url' => Str::random(40)]);
    
        Exam::create($request->all());
     
        return redirect()->route('exams.index')->with('success','Exam Created Successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        $allFiles = \Storage::disk('dropbox')->allFiles($exam->name);
        return view('exams.show',compact('exam', 'allFiles'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        return view('exams.edit',compact('exam'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        $request->validate([
            'name' => 'required',
            'testId' => 'required',
        ]);
    
        $exam->update($request->all());
    
        return redirect()->route('exams.index')->with('success','Exam updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
    
        return redirect()->route('exams.index')->with('success','Exam deleted successfully');
    }

    public function form(Request $request)
    {
        $exam = Exam::where('url', $request->url)->first();
        if(!empty($exam)){
            if($exam->active == 0){
                return redirect()->route('examattempts.index')->with('info', 'Exam is not active');
            }
            config(['adminlte.classes_body' => 'sidebar-hidden']);
            config(['adminlte.usermenu_enabled' => false]);
            return view('exams.form', compact('exam'));
        }else{
            return redirect()->route('examattempts.index')->with('info', 'Invalid Exam URL');
        }
    }

     /**
      * Redirect the user to the Google authentication page.
      *
      * @return \Illuminate\Http\Response
      */
    public function redirectToProvider()
    {
        return \Socialite::driver('google')->with(['state' => 'redirectURL='.url()->previous(), "prompt" => "select_account"])->stateless()->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = \Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect()->route('examattempts.index')->with('info', $e->getMessage());
        }
        $state = request()->input('state');
        parse_str($state, $result);
        setcookie("studentName", $user->name, time() + (86400 * 30), "/");
        setcookie("studentEmail", $user->email, time() + (86400 * 30), "/");
        return \Redirect::to($result['redirectURL']);
    }
}