<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamAttemptController;
use App\Http\Controllers\ExamAttemptRowController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestQuestionController;
use App\Http\Controllers\ConfigController;
  
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('exam/{url}', [ExamController::class, 'form']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('configs', ConfigController::class);
    Route::resource('tests', TestController::class);
    Route::resource('testquestions', TestQuestionController::class);
    Route::resource('exams', ExamController::class);
    Route::resource('examattempts', ExamAttemptController::class);
    Route::resource('examattemptrows', ExamAttemptRowController::class);
    Route::resource('users', UserController::class);
});
