<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ExamStatus extends Model
{
    use HasFactory;
    protected $fillable=[
        'schedule_id',
        'exam_id',
        'status',
        'service',
        'category'

    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y'
    ];







}
