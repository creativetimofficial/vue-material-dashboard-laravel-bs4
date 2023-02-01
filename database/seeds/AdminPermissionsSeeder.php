<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AdminPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        // create roles permissions
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'edit roles']);
        Permission::create(['name' => 'delete roles']);

        // create admin role and assign roles management to it
        $role = Role::firstOrCreate(['name' => 'admin']);
        $role->givePermissionTo('view roles');
        $role->givePermissionTo('create roles');
        $role->givePermissionTo('edit roles');
        $role->givePermissionTo('delete roles');
        
        // create a user as admin
        $user = User::first();
        $user->assignRole($role);
    }
}
