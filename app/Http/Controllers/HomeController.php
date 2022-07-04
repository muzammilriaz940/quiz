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
        $EA = \App\Models\ExamAttempt::find(1);
        // return view('examattempts.pdf', compact('EA'));
        $pdf = \PDF::loadView('examattempts.pdf', compact('EA'));
        return $pdf->stream('document.pdf');
        /*$pdf = PDF::loadView('examattempts.pdf', compact('EA'));
        return $pdf->download('document.pdf');*/
        // return $pdf->save(storage_path('app/public/').'document.pdf');
        // return view('home');
    }
}