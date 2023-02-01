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
        Permission::create(['name' => 'create hotels']);
        Permission::create(['name' => 'view hotels']);
        Permission::create(['name' => 'edit hotels']);
        Permission::create(['name' => 'view alerts']);
        Permission::create(['name' => 'create alerts']);
        Permission::create(['name' => 'edit alerts']);
        Permission::create(['name' => 'view reservations']);
        Permission::create(['name' => 'view reservation reports']);
        Permission::create(['name' => 'create reservations']);
        Permission::create(['name' => 'edit reservations']);
        Permission::create(['name' => 'delete reservations']);
        Permission::create(['name' => 'capture reservations']);
        Permission::create(['name' => 'create rates']);
        Permission::create(['name' => 'view rates reports']);
        Permission::create(['name' => 'create promotions']);
        Permission::create(['name' => 'edit promotions']);
        Permission::create(['name' => 'create rooms']);
        Permission::create(['name' => 'create accommodations']);
        Permission::create(['name' => 'create occupations']);
        Permission::create(['name' => 'edit markup']);
        Permission::create(['name' => 'edit settings']);
        Permission::create(['name' => 'manage currencies']);
        Permission::create(['name' => 'view layouts']);
        Permission::create(['name' => 'edit children']);
        Permission::create(['name' => 'edit reservation sources']);
        Permission::create(['name' => 'create reservation sources']);
        Permission::create(['name' => 'delete reservation sources']);
        Permission::create(['name' => 'view reservation sources']);
        Permission::create(['name' => 'view hotel partners']);
        Permission::create(['name' => 'edit hotel partners']);



        // create roles and assign permissions
        $role = Role::firstOrCreate(['name' => 'admin']);
        $role->givePermissionTo('view users');
        $role->givePermissionTo('edit users');
        $role->givePermissionTo('delete users');
        $role->givePermissionTo('create users');        
        $role->givePermissionTo('create hotels');
        $role->givePermissionTo('view hotels');
        $role->givePermissionTo('edit hotels');       
        $role->givePermissionTo('view alerts');
        $role->givePermissionTo('create alerts');
        $role->givePermissionTo('edit alerts');       
        $role->givePermissionTo('view reservations');
        $role->givePermissionTo('view reservation reports');
        $role->givePermissionTo('create reservations');
        $role->givePermissionTo('edit reservations');
        $role->givePermissionTo('delete reservations');       
        $role->givePermissionTo('create rates');
        $role->givePermissionTo('view rates reports');        
        $role->givePermissionTo('create promotions');
        $role->givePermissionTo('edit promotions');       
        $role->givePermissionTo('create rooms');
        $role->givePermissionTo('create accommodations');
        $role->givePermissionTo('create occupations');        
        $role->givePermissionTo('edit markup');
        $role->givePermissionTo('edit settings');
        $role->givePermissionTo('manage currencies');
        $role->givePermissionTo('view layouts');
        $role->givePermissionTo('edit children');
        $role->givePermissionTo('capture reservations');
        $role->givePermissionTo('edit reservation sources');
        $role->givePermissionTo('create reservation sources');
        $role->givePermissionTo('delete reservation sources');
        $role->givePermissionTo('view reservation sources');
        $role->givePermissionTo('view hotel partners');
        $role->givePermissionTo('edit hotel partners');

    }
}
