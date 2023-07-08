<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveCalls extends Model
{
    use HasFactory;
    protected $fillable=[
        'tittle',
        'account_number',
        'quality_analysts',
        'date',
        'category',
        'supervisor',
        'agent',
        'issue_summary',
        'issue_description',
        'strength_summary',
        'strength_description',
        'gaps_summary',
        'gaps_description',
        'voc_summary',
        'voc_description',
    ];
    // protected $casts = [
    //     'created_at' => 'datetime:d-M-Y'
    // ];
}
