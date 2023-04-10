<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCallTracker;

class CallTracker extends Model
{
    use HasFactory;
    protected $fillable=[
        'call_tracker',
        'service_id',



    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y'
    ];
}
