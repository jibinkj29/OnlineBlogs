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
        $admin = User::create([
            'name'=>'Admin',
            'email'=>'admin@admin.com',
            'email_verified_at' => now(),
            'password'=>bcrypt('password'),
        ]);

        // $writer = User::create([
        //     'name'=>'writer',
        //     'email'=>'writer@writer.com',
        //     'password'=>bcrypt('password')
        // ]);


        $admin_role = Role::create(['name' => 'admin']);
        // $writer_role = Role::create(['name' => 'writer']);

      
        $permission = Permission::create(['name' => 'User create']);
       

        $admin->assignRole($admin_role);
        // $writer->assignRole($writer_role);


        $admin_role->givePermissionTo(Permission::all());
    }
}