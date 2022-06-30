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
        $testquestions = TestQuestion::latest()->paginate(5);
        return view('testquestions.index',compact('testquestions'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('testquestions.create');
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
            'correct_option' => 'required|in:A,B,C,D|max:1',
            'total_marks' => 'required',
        ]);
    
        TestQuestion::create($request->all());
     
        return redirect()->route('tests.show', $request->testId)->with('success','Test Question Created Successfully');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\TestQuestion  $test
     * @return \Illuminate\Http\Response
     */
    public function show(TestQuestion $test)
    {
        return view('testquestions.show',compact('test'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TestQuestion  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(TestQuestion $test)
    {
        return view('testquestions.edit',compact('test'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TestQuestion  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TestQuestion $test)
    {
        $request->validate([
            'name' => 'required',
        ]);
    
        $test->update($request->all());
    
        return redirect()->route('testquestions.index')->with('success','TestQuestion Updated Successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TestQuestion  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(TestQuestion $test)
    {
        $test->delete();
    
        return redirect()->route('testquestions.index')->with('success','TestQuestion Deleted Successfully');
    }
}