<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    use HasFactory;

    protected $fillable=[
        'status_name',
        'status_id',

    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y'
    ];
}
