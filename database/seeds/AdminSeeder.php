<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Permission;
use Zizaco\Entrust;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //making a admin user
        $admin = User::where('email', '=', 'leqqr@back')->first();
        if ($admin === null) {
            $admin = new User();
            $admin->firstname = 'Leqqr';
            $admin->lastname = 'Back';
            $admin->email='leqqr@back';
            $admin->password=Hash::make('admin');
            $admin->save();

            $admin->attachRole(1);

        }


        $role = $admin->roles()->first();
        $role->perms()->sync(Permission::all());
//        foreach(Permission::all() as $per){
//
//            $role->attachPermission($per);
//
//
//        }





    }
}
