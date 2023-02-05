<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    use HasFactory;

    protected $fillable=[
        'summary_title',
        'summary_name',

    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y'
    ];
}
