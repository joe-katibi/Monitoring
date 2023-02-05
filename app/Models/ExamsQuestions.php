<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamsQuestions extends Model
{
    use HasFactory;
    protected $fillable=[
        'service',
        'category',
        'question_weight',
        'course',
        'answer_key',
        'question',
        'answer_a',
        'answer_b',
        'answer_c',
        'answer_d'
    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y'
    ];
}
