<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $authorities = config('permission.authorities');
        $listPermission = [];
        $superAdminPermission = [];
        foreach ($authorities as $label => $permissions) {
            foreach ($permissions as $permission) {
                $listPermission[] = [
                    'name' => $permission,
                    'guard_name' => 'web',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),

                ];
                // hak akses super admin
                $superAdminPermission[] = $permission;
            }
        }

        // Insert permission
        Permission::insert($listPermission);

        // Insert nama Roles Super Admin
        $superAdmin = Role::create([
            'name' => 'Super Admin',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        // pemberian hak akses
        $superAdmin->givePermissionTo($superAdminPermission);

        //assign Roles
        $userSuperAdmin = User::find(1)->assignRole("Super Admin");
    }
}
