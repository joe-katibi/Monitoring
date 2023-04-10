<?php
namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
/** @package Database\Seeders */
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Super-admin
        try {
            $role = Role::create(['name' => 'super-admin', 'description' => 'Super Admin']);
        } catch (\Spatie\Permission\Exceptions\RoleAlreadyExists $e) {
            // Ignore
        }
        $role = Role::findByName('super-admin');
        $role->givePermissionTo(Permission::all());


    }
}
