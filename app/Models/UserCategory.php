<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model
{
    use HasFactory;

    use HasFactory;
    protected $fillable=[
        'user_id',
        'category_id',
        'created_by'


    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y',
    ];

    public static function userCategory()
    {
        $usercategory = DB::table('user_categories')->orderBy('id', 'asc')->get();
        return $usercategory;
    }
}
