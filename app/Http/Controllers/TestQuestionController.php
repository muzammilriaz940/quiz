<?php
  
namespace App\Http\Controllers;
   
use App\Models\TestQuestion;
use Illuminate\Http\Request;
  
class TestQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
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
            'testId' => 'required',
            'description' => 'required',
            'options' => 'required',
            'correct_option' => 'required|in:1,2,3,4|max:1',
            'total_marks' => 'required',
        ]);
        $question = new TestQuestion($request->all());
        $question->save();
     
        return redirect()->route('tests.show', $request->testId)->with('success','Test Question Created Successfully');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\TestQuestion  $testquestion
     * @return \Illuminate\Http\Response
     */
    public function show(TestQuestion $testquestion)
    {
        // 
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TestQuestion  $testquestion
     * @return \Illuminate\Http\Response
     */
    public function edit(TestQuestion $testquestion)
    {
        // 
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TestQuestion  $testquestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TestQuestion $testquestion)
    {
        // 
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TestQuestion  $testquestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(TestQuestion $testquestion)
    {
        $testId = $testquestion->testId;
        $testquestion->delete();
        return redirect()->route('tests.show', $testId)->with('success','Test Question Deleted Successfully');
    }
}