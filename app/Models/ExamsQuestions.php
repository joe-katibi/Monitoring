<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamsQuestions extends Model
{
    use HasFactory;
    protected $fillable=[
        'service',
        'category_id',
        'course',
        'created_by',
        'question',

    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y'
    ];
}
