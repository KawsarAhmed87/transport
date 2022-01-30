<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Roles
        $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleEditor = Role::create(['name' => 'editor']);
        $roleUser = Role::create(['name' => 'user']);

        // Permission List as array
        $permissions = [

            
            [
                'group_name' => 'role',
                'permissions' => [
                    // role Permissions
                    'role.view',
                    'role.create',
                    'role.edit',
                    'role.delete',

                ],
            ],

            [
                'group_name' => 'user',
                'permissions' => [
                    // admin Permissions
                    'user.view',
                    'user.create',
                    'user.edit',
                    'user.delete',
                ],
            ],

            [
                'group_name' => 'division',
                'permissions' => [
                    // division Permissions
                    'division.view',
                    'division.create',
                    'division.edit',
                    'division.delete',
                ],
            ],

            [
                'group_name' => 'colour',
                'permissions' => [
                    // colour Permissions
                    'colour.view',
                    'colour.create',
                    'colour.edit',
                    'colour.delete',
                ],
            ],

            [
                'group_name' => 'brand',
                'permissions' => [
                    // brand Permissions
                    'brand.view',
                    'brand.create',
                    'brand.edit',
                    'brand.delete',
                ],
            ],
            
        ];

        // Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup]);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }
    }
}
