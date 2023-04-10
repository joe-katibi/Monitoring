<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoCSummaries extends Model
{
    use HasFactory;
    protected $fillable=[
        'voc_title',
        'voc_name',

    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y'
    ];
}
