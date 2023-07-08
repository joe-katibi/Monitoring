<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerKeys extends Model
{
    use HasFactory;
    protected $fillable=[
        'question_id',
        'choices',
        'question_weight',
        'key_choice',
        'is_correct',
        'created_by',


    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y'
    ];
}
