<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'Admin@admin.com',
            'password' => bcrypt('123456'),
            'role' => 'superAdmin'
        ]);


        $Super = Role::where('name' ,'like' , 'superAdmin')->get();
        $user->assignRole($Super);

       // $role = Role::create(['guard_name' => 'api','name' => 'Super Admin']);
        //$permissions = Permission::pluck('id' , 'id')->all();
        //$role->syncPermissions($permissions);
        //$user->assignRole($role);
    }
}
