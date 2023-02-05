<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertForm extends Model 
{
    use HasFactory;
    protected $fillable=[
    'title',
    'date',
    'agent_name',
    'supervisor_name',
    'qa_name',
    'description',
    'fatal_error',
    'supervisor_comment',
    'qa_signature',
    'date_by_qa',
    'supervisor_signature',
    'date_by_supervisor',
    'agent_signature',
    'date_by_agent',

];
protected $casts = [
    'created_at' => 'datetime:d-M-Y'
];

}
