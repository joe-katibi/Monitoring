<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class livecalls_summary extends Model
{
    use HasFactory;

    protected $fillable=[
        'live_call_id',
        'summary_id',
        'category_id',
        'created by',


    ];
    // protected $casts = [
    //     'created_at' => 'datetime:d-M-Y'
    // ];
}
