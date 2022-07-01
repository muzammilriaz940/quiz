<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAttemptRow extends Model
{
    use HasFactory;

    protected $fillable = [
        'examAttemptId', 'testQuestionId', 'answer'
    ];
}
