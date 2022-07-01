<?php
  
namespace App\Http\Controllers;
   
use App\Models\ExamAttemptRow;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExamAttemptRowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examattemptrows = ExamAttemptRow::latest()->paginate(5);
        return view('examattemptrows.index',compact('examattemptrows'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('examattemptrows.create');
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
            'examAttemptId' => 'required',
            'testQuestionId' => 'required',
            'answer' => 'required',
        ]);

        $request->merge(['url' => Str::random(40)]);
    
        ExamAttemptRow::create($request->all());
     
        return redirect()->route('examattemptrows.index')->with('success','Exam Attempt Row Created Successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\ExamAttemptRow  $examattempt
     * @return \Illuminate\Http\Response
     */
    public function show(ExamAttemptRow $examattempt)
    {
        return view('examattemptrows.show',compact('examattempt'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExamAttemptRow  $examattempt
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamAttemptRow $examattempt)
    {
        return view('examattemptrows.edit',compact('examattempt'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExamAttemptRow  $examattempt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamAttemptRow $examattempt)
    {
        $request->validate([
            'examAttemptId' => 'required',
            'testQuestionId' => 'required',
            'answer' => 'required',
        ]);
    
        $examattempt->update($request->all());
    
        return redirect()->route('examattemptrows.index')->with('success','Exam Attempt Row Updated Successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExamAttemptRow  $examattempt
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamAttemptRow $examattempt)
    {
        $examattempt->delete();
    
        return redirect()->route('examattemptrows.index')->with('success','Exam Attempt Row Deleted Successfully');
    }
}