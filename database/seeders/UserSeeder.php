<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // $user = new User();
        // $user->first_name = 'User';
        // $user->last_name = 'Salma';
        // $user->email = 'userSalma@gmail.com';
        // $user->password = Hash::make('123456789');
        // $user->phone = '0652943737';
        // $user->birthdate = '1999-07-14';
        // $user->save();

        $admin = new User();
        $admin->first_name = 'user'; // Set first_name for admin user
        $admin->last_name = 'Admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = Hash::make('123456789');
        $admin->type = 1;
        $admin->phone = '0652943737';
        $admin->birthdate = '1999-06-14';
        $admin->save();

            //   // Another user without a password
            //   $anotherUser = new User();
            //   $anotherUser->first_name = 'Wissal';
            //   $anotherUser->last_name = 'Bara';
            //   $anotherUser->email = 'wissal@gmail.com';
            //   $anotherUser->type = 0;
            //   $anotherUser->phone = '0652947373';
            //   $anotherUser->birthdate = '2002-06-14';
            //   $anotherUser->save();

    }
}
