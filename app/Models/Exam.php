<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'url', 'testId', 'active'
    ];

    public function attempts()
    {
        return $this->hasmany(ExamAttempt::class,'examId','id');
    }
}