<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallRatings extends Model
{
    use HasFactory;
    protected $fillable=[
        'rating_name'


    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y'
    ];
}
