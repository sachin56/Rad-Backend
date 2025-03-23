<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'user-management',

            'role-view',
            'role-create',
            'role-edit',
            'role-delete',

            'user-view',
            'user-create',
            'user-edit',
            'user-delete',

            'cutomer-view',
            'cutomer-create',
            'cutomer-edit',
            'cutomer-delete',
     
            'notification-view'
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission],
                ['name' => $permission]
            );
        }

        // create roles and assign created permissions

        $role = Role::updateOrCreate(
            ['name' => 'super-admin'],
            ['name' => 'super-admin']
        );
        $role->givePermissionTo(Permission::all());

        // create a demo user
        $user = User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Super Admin',
                'lastName' => 'Admin',
                'email' => 'admin@pawlog.lk',
                'password' => bcrypt('admin@123'),
                'userRoleId' => $role->id
            ]);
        $user->assignRole($role);
    }
}
