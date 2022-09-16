<?php
  
namespace App\Http\Controllers;
   
use App\Models\Test;
use Illuminate\Http\Request;
  
class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tests = Test::latest()->paginate(5);
        return view('tests.index',compact('tests'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tests.create');
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
        ]);
        
        $request->merge(['userId' => auth()->user()->id]);      
        $request->merge(['created_by' => auth()->user()->name]);  
        Test::create($request->all());
     
        return redirect()->route('tests.index')->with('success','Test Created Successfully');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        return view('tests.show',compact('test'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        return view('tests.edit',compact('test'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        $request->validate([
            'name' => 'required',
        ]);
        
        $request->merge(['updated_by' => auth()->user()->name]);
        $test->update($request->all());
    
        return redirect()->route('tests.index')->with('success','Test Updated Successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        $test->delete();
    
        return redirect()->route('tests.index')->with('success','Test Deleted Successfully');
    }
}