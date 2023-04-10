<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable=[
        'category_name',
        'service_id',


    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y'
    ];
}
