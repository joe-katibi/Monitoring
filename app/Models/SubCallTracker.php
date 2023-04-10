<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCallTracker extends Model
{
    use HasFactory;
    protected $fillable=[
        'sub_call_tracker',
        'call_tracker_id',
        'services'


    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y'
    ];
}
