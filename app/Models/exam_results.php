<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exam_results extends Model
{
    use HasFactory;
    protected $fillable=[
        'question_id',
        'answers_selected',
        'marks_achieved',
        'user_id',
        'created_by',

    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y'
    ];
}
