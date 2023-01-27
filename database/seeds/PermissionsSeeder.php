<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\User;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        // create permissions

        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'create users']);



        // create roles and assign permissions
        $role = Role::firstOrCreate(['name' => 'admin']);
        $role->givePermissionTo('view users');
        $role->givePermissionTo('edit users');
        $role->givePermissionTo('delete users');
        $role->givePermissionTo('create users');

    }
}
