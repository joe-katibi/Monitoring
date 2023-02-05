<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerKeys extends Model
{
    use HasFactory;
    protected $fillable=[
        'question_id',
        'a_key',
        'q_weight',




    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y'
    ];
}
