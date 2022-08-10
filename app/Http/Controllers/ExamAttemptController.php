<?php
  
namespace App\Http\Controllers;

use File;
use App\Models\ExamAttempt;
use App\Models\ExamAttemptRow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ExamAttemptController extends Controller
{
    public function __construct(){
        config(['adminlte.classes_body' => 'sidebar-hidden']);
        config(['adminlte.usermenu_enabled' => false]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('examattempts.index');
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
        $examId = $request->examId; 
        $studentEmail = $request->studentEmail; 
        $request->validate([
            'examId' => 'required',
            'studentName' => 'required',
            'studentEmail' => [
                'required',
                Rule::unique('exam_attempts')->where(function ($query) use($examId,$studentEmail) {
                    return $query->where('examId', $examId)->where('studentEmail', $studentEmail);
                }),
            ],
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
            $pdf = \PDF::loadView('examattempts.pdf', compact('EA'));
            // return $pdf->stream('document.pdf');
            // $s = strtotime($EA->created_at);
            // $date = date('Y-m-d', $s);
            // $path = storage_path('app/public').'/'.trim($EA->exam->name);
            // File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
            // $pdf->save($path.'/'.$EA->studentName/*.'-'.$date*/.'.pdf');

            // $is_file_uploaded = Storage::disk('dropbox')->put('public-uploads',$path.'/'.$EA->studentName/*.'-'.$date*/.'.pdf');

            $content = $pdf->download()->getOriginalContent();
            Storage::disk('dropbox')->put(trim($EA->exam->name).'/'.$EA->studentName/*.'-'.$date*/.'.pdf',$content) ;
            return redirect('examattempts/'.$EA->id);
        } catch (\Exception $e) {
            return redirect()->route('examattempts.index')->with('info', $e->getMessage());
        }
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\ExamAttempt  $examattempt
     * @return \Illuminate\Http\Response
     */
    public function show(ExamAttempt $EA, $id)
    {
        $EA = ExamAttempt::find($id);
        return view('examattempts.show', compact('EA'));
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