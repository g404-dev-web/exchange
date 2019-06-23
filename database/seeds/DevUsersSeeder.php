<?php

use App\Question;
use App\User;
use App\Fabric;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DevUsersSeeder extends Seeder
{
    /**
     * Run the database seeds for admin and user for each fabric
     *
     * @return void
     */
    public function run()
    {
        $users = [new User, new User, new User, new User];

        // Fabrique n°1
        $users[0]->name = "admin_f1";
        $users[0]->email = "admin1@admin.com";
        $users[0]->fabric_id = 1;
        $users[0]->password = Hash::make('admin');
        $users[0]->is_admin = 1;
        $users[0]->remember_token = str_random(10);
        $users[0]->save();

        $users[1]->name = "user_f1";
        $users[1]->email = "user1@user.com";
        $users[1]->fabric_id = 1;
        $users[1]->password = Hash::make('user');
        $users[1]->is_admin = 0;
        $users[1]->remember_token = str_random(10);
        $users[1]->save();

        // Fabrique n°2
        $users[2]->name = "admin_f2";
        $users[2]->email = "admin2@admin.com";
        $users[2]->fabric_id = 2;
        $users[2]->password = Hash::make('admin');
        $users[2]->is_admin = 1;
        $users[2]->remember_token = str_random(10);
        $users[2]->save();

        $users[3]->name = "user_f2";
        $users[3]->email = "user2@user.com";
        $users[3]->fabric_id = 2;
        $users[3]->password = Hash::make('user');
        $users[3]->is_admin = 0;
        $users[3]->remember_token = str_random(10);
        $users[3]->save();
    }
}
