<?php
  
namespace App\Http\Controllers;
   
use App\Models\ExamAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExamAttemptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examattempts = ExamAttempt::latest()->paginate(5);
        return view('examattempts.index',compact('examattempts'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('examattempts.create');
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
            'examId' => 'required',
            'studentName' => 'required',
            'studentEmail' => 'required',
        ]);

        $request->merge(['url' => Str::random(40)]);
    
        ExamAttempt::create($request->all());
     
        return redirect()->route('examattempts.index')->with('success','Exam Attempt Created Successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\ExamAttempt  $examattempt
     * @return \Illuminate\Http\Response
     */
    public function show(ExamAttempt $examattempt)
    {
        return view('examattempts.show',compact('examattempt'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExamAttempt  $examattempt
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamAttempt $examattempt)
    {
        return view('examattempts.edit',compact('examattempt'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExamAttempt  $examattempt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamAttempt $examattempt)
    {
        $request->validate([
            'examId' => 'required',
            'studentName' => 'required',
            'studentEmail' => 'required',
        ]);
    
        $examattempt->update($request->all());
    
        return redirect()->route('examattempts.index')->with('success','Exam Attempt Updated Successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExamAttempt  $examattempt
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamAttempt $examattempt)
    {
        $examattempt->delete();
    
        return redirect()->route('examattempts.index')->with('success','Exam Attempt Deleted Successfully');
    }
}