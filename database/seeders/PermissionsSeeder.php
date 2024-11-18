<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list alattelemetris']);
        Permission::create(['name' => 'view alattelemetris']);
        Permission::create(['name' => 'create alattelemetris']);
        Permission::create(['name' => 'update alattelemetris']);
        Permission::create(['name' => 'delete alattelemetris']);

        Permission::create(['name' => 'list detailkomponens']);
        Permission::create(['name' => 'view detailkomponens']);
        Permission::create(['name' => 'create detailkomponens']);
        Permission::create(['name' => 'update detailkomponens']);
        Permission::create(['name' => 'delete detailkomponens']);

        Permission::create(['name' => 'list formkomponens']);
        Permission::create(['name' => 'view formkomponens']);
        Permission::create(['name' => 'create formkomponens']);
        Permission::create(['name' => 'update formkomponens']);
        Permission::create(['name' => 'delete formkomponens']);

        Permission::create(['name' => 'list jenisalats']);
        Permission::create(['name' => 'view jenisalats']);
        Permission::create(['name' => 'create jenisalats']);
        Permission::create(['name' => 'update jenisalats']);
        Permission::create(['name' => 'delete jenisalats']);

        Permission::create(['name' => 'list komponen2s']);
        Permission::create(['name' => 'view komponen2s']);
        Permission::create(['name' => 'create komponen2s']);
        Permission::create(['name' => 'update komponen2s']);
        Permission::create(['name' => 'delete komponen2s']);

        Permission::create(['name' => 'list pemeliharaan2s']);
        Permission::create(['name' => 'view pemeliharaan2s']);
        Permission::create(['name' => 'create pemeliharaan2s']);
        Permission::create(['name' => 'update pemeliharaan2s']);
        Permission::create(['name' => 'delete pemeliharaan2s']);

        Permission::create(['name' => 'list pemeriksaans']);
        Permission::create(['name' => 'view pemeriksaans']);
        Permission::create(['name' => 'create pemeriksaans']);
        Permission::create(['name' => 'update pemeriksaans']);
        Permission::create(['name' => 'delete pemeriksaans']);

        Permission::create(['name' => 'list setting2s']);
        Permission::create(['name' => 'view setting2s']);
        Permission::create(['name' => 'create setting2s']);
        Permission::create(['name' => 'update setting2s']);
        Permission::create(['name' => 'delete setting2s']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
