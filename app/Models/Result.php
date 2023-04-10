<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'supervisor',
        'category',
        'agent_name',
        'service',
        'quality_analysts',
        'date_recorded',
        'customer_account',
        'recording_id',
        'qa_call_category',
        'qa_call_nature',
        'agent_call_category',
        'agent_call_nature',
        'issue_highlighted',
        'issue_specific',
        'feedback_from_qc',
        'supervisor_comment',
        'agent_comment',
        'status',
        'percentage',
        'results',
        'final_results',
        'totals',
        'date_updated',
    ];
    // protected $casts = [
    //     'created_at' => 'datetime:d-M-Y'
    // ];
}
