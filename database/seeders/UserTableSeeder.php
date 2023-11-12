<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use illuminate\Support\str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'super-admin',
            'username' => 'super admin',
            'email' => 'super@admin.com',
            'is_admin' => 1,
            'country'=>'1',
            'services'=>'1',
            'category'=>'null',
            'position'=>'5',
            'user_status'=>'1',
            'department_id'=>'1',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $role = Role::where('id', 1)->first();
        $permission = Permission::pluck('name', 'id');
        $user->syncRoles($role)->syncPermissions($permission);

    }
}
