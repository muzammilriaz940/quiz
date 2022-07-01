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
        $data = [
            'foo' => 'bar'
        ];
        $pdf = \PDF::loadView('examattempts.pdf', $data);
        return $pdf->save(storage_path('app/public/').'document.pdf');
        // return view('home');
    }
}