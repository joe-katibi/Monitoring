<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;
    protected $fillable=[
        'course_name',
        'service_id'


    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y',
    ];
}
