<?php
  
namespace App\Http\Controllers;
   
use App\Models\ExamAttempt;
use App\Models\ExamAttemptRow;
use Illuminate\Http\Request;

class ExamAttemptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('examattempts.success');
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
            'examId' => 'required',
            'studentName' => 'required',
            'studentEmail' => 'unique:exam_attempts,studentEmail',
        ]);

        try {
            $EA = new ExamAttempt($request->all());
            if($EA->save()){
                foreach($request->question as $questionId => $answer){
                    $EAR = new ExamAttemptRow($request->all());
                    $EAR->ExamAttemptId = $EA->id;                
                    $EAR->testQuestionId = $questionId;                
                    $EAR->answer = $answer;      
                    $EAR->save();         
                }
            }
            return redirect()->route('examattempts.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\ExamAttempt  $examattempt
     * @return \Illuminate\Http\Response
     */
    public function show(ExamAttempt $examattempt)
    {
        // 
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExamAttempt  $examattempt
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamAttempt $examattempt)
    {
        // 
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
        // 
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExamAttempt  $examattempt
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamAttempt $examattempt)
    {
        // 
    }
}