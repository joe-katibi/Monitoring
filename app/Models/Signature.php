<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    use HasFactory;

    protected $fillable=[
        'image_path',
        'signed_by',
        'signed_at',
        'signed_by',


    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y'
    ];
}
