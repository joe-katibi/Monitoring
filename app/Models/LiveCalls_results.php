<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveCalls_results extends Model
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
