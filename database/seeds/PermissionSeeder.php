<?php

use Illuminate\Database\Seeder;
use Zizaco\Entrust;
use App\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //make permissions
        $userListPer = Permission::where('name', 'user_list')->first();
        if ($userListPer === null) {
            $userListPer = new Permission();
            $userListPer->name = 'user_list';
            $userListPer->display_name = 'User List';
            $userListPer->description='This permission gives you permission to get all the users';
            $userListPer->save();
        }

        $manage_allergens = Permission::where('name', 'manage_allergens')->first();
        if ($manage_allergens === null) {
            $manage_allergens = new Permission();
            $manage_allergens->name = 'manage_allergens';
            $manage_allergens->display_name = 'Allergene beheren';
            $manage_allergens->description='Allergene beheren';
            $manage_allergens->save();
        }

    }
}
