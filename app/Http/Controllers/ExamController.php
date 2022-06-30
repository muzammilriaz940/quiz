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
        return view('exams.show',compact('exam'));
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
            config(['adminlte.classes_body' => 'sidebar-hidden']);
            config(['adminlte.usermenu_enabled' => false]);
            return view('exams.form', compact('exam'));
        }else{
            dd("Not Found!");
        }
    }
}