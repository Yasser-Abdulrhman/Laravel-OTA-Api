<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminPermissions=[
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'place-list',
            'place-create',
            'place-edit',
            'place-delete',
        ];
        $adminPermissions=[
            'place-list',
            'place-create',
            'place-edit',
            'place-delete',
        ];

        $userPermissions=[
            'place-list',
        ];

      $super= Role::create(['guard_name' => 'api','name' => 'superAdmin']);
      $super->givePermissionTo(Permission::whereIn('name', $superAdminPermissions)->get());

      $admin= Role::create(['guard_name' => 'api','name' => 'admin']);
      $admin->givePermissionTo(Permission::whereIn('name', $adminPermissions)->get());

      $user= Role::create(['guard_name' => 'api','name' => 'user']);
      $user->givePermissionTo(Permission::whereIn('name', $userPermissions)->get());

        
    }
}
