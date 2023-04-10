<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubIssueGeneral extends Model
{
    use HasFactory;

    protected $fillable=[
        'sub_name',
        'issue_general_id',
        'service_id',
        'category_id'


    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y'
    ];
}
