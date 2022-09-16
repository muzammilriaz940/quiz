<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'userId', 'created_by', 'updated_by'
    ];

    public function exams()
    {
        return $this->hasmany(Exam::class,'testId','id');
    }

    public function questions()
    {
        return $this->hasmany(TestQuestion::class,'testId','id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','userId');
    }
}
