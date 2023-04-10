<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadCalls extends Model
{
    use HasFactory;
    protected $fillable=[
        'agent_name',
        'service_id',
        'supervisor_name',
        'call_category',
        'qa_name',
        'call_rating',
        'call_date',
        'call_file',

    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y'
    ];
}
