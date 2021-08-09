<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'place-list',
            'place-create',
            'place-edit',
            'place-delete',
        ];

        foreach($permissions as $permission)
        {
          Permission::create(['guard_name' => 'api','name' => $permission]);
        }
    }
}
