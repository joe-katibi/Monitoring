<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;
    protected $fillable=[
        'name'


    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y'
    ];
}
