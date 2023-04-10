<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    // protected $table = 'departments';
    // protected $primaryKey = 'id';


    use HasFactory;
    protected $fillable=[
        'name',
        'descriptions'


    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y',
    ];
}
