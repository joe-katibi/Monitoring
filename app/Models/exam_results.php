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
        'conduct_id',
        'report_type_id',
        'schedule_id',
        'created_by',


    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y'
    ];
    public function question()
{
    return $this->belongsTo(ExamsQuestions::class);
}

public function answer_key()
{
    return $this->belongsTo(AnswerKeys::class, 'answers_selected', 'id');
}

}
