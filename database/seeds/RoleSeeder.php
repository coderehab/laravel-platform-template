<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //make roles
        $adminRole = Role::where('name', '=', 'admin')->first();
        if ($adminRole === null) {
            $adminRole = new Role();
            $adminRole->name = 'admin';
            $adminRole->display_name = 'Admin';
            $adminRole->description='This is a admin';
            $adminRole->save();
        }

        $ownerRole = Role::where('name', '=', 'owner')->first();
        if ($ownerRole === null) {
            $ownerRole = new Role();
            $ownerRole->name = 'owner';
            $ownerRole->display_name = 'Company Owner';
            $ownerRole->description='This is a Company Owner';
            $ownerRole->save();
        }

        $userRole = Role::where('name', '=', 'user')->first();
        if ($userRole === null) {
            $userRole = new Role();
            $userRole->name = 'user';
            $userRole->display_name = 'Customer';
            $userRole->description='This is a Customer';
            $userRole->save();
        }

    }
}
