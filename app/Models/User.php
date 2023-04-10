<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\User;
use App\Models\UserCategory;
use App\Models\Role;
use App\Models\Categories;
use App\Models\Departments;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'is_admin',
        'country',
        'services',
        'category',
        'position',
        'password',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:d-M-Y',
    ];


    public static function getUsers()
    {
        $users = DB::table('users')->orderBy('id', 'asc')->get();
        return $users;
    }

    public function department()
    {
        return $this->belongsTo(Departments::class , 'department_id' , 'id');
    }

    public static function userCategory()
    {
        $usercategory = DB::table('user_categories')->orderBy('id', 'asc')->get();
        return $usercategory;
    }
}
