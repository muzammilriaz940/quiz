<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'examId', 'studentName', 'studentEmail'
    ];

    public function exam()
    {
        return $this->hasOne(Exam::class,'id','examId');
    }

    public function answers()
    {
        return $this->hasmany(ExamAttemptRow::class,'examAttemptId','id');
    }
}
