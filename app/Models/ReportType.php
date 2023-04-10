<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportType extends Model
{
    use HasFactory;
    protected $fillable=[
        'type_name',
        'type_id'


    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y',
    ];
}
