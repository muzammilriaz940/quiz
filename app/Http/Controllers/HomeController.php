<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $exam = \App\Models\Exam::find(1);
        // return view('examattempts.pdf', compact('exam'));
        $pdf = \PDF::loadView('examattempts.pdf', compact('exam'));
        return $pdf->stream('document.pdf');
        /*$pdf = PDF::loadView('examattempts.pdf', compact('exam'));
        return $pdf->download('document.pdf');*/
        // return $pdf->save(storage_path('app/public/').'document.pdf');
        // return view('home');
    }
}