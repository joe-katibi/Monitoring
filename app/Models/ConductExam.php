<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConductExam extends Model
{
    use HasFactory;
    protected $fillable=[
        'schedule_name',
        'time',
        'course',
        'exam_name',
        'service',
        'category',
        'trainer_qa',
        'start_date',
        'completion_date',
    ];

     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime:d-M-Y',
    ];
}
