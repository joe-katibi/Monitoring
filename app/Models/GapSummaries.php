<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GapSummaries extends Model
{
    use HasFactory;
    protected $fillable=[
        'gap_title',
        'gap_name',

    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y'
    ];
}
