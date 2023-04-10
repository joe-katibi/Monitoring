<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class FiberWelcomeQuestion extends Model
{
    use HasFactory;
    protected $fillable=[
        'number',
        'question',
        'summarized',
        'yes',
        'no',
        'service',
        'category'
    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y',
    ];

}
