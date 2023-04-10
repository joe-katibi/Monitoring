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
        //
        // for ($i=1; $i < 10; $i++) {
        //     $user = User::create([
        //         'name' => 'Test '.$i,
        //         'email' => 'test'.$i.'@test.com',
        //         'is_admin' => 0,
        //         'country'=>'country'.$i,
        //         'services'=>'services'.$i,
        //         'category'=>'category'.$i,
        //         'position'=>'position'.$i,
        //         'email_verified_at' => now(),
        //         'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //         'remember_token' => Str::random(10),
        //     ]);
        //     $role = Role::where('id', 5)->first();
        //     $permission = Permission::where('name', 'N/A')->first();
        //     $user->syncRoles($role)->syncPermissions($permission);
        //}

    }
}
