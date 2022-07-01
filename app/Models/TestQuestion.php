<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'testId', 'description', 'options', 'correct_option', 'total_marks'
    ];

    protected $casts = [
        'options' => 'array'
    ];

    public function exam_attempts()
    {
        return $this->hasmany(ExamAttemptRow::class,'testQuestionId','id');
    }
}
