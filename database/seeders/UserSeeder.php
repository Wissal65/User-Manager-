<?php
//
// namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;
// use App\Models\User;
// use Illuminate\Support\Facades\Hash;

// class UserSeeder extends Seeder
// {
//     public function run(): void
//     {
//         $userObj = new User();
//         // $userObj->name = 'User Rafi';
//         $userObj->first_name = 'User';
//         $userObj->last_name = 'Rafi';
//         $userObj->email = 'userRafi@gmail.com';
//         $userObj->password = Hash::make('123456789');
//         $userObj->type = 0;
//         $userObj->phone = '0652943737';
//         $userObj->birthdate = '1999-07-14';
//         $userObj->save();

//         $adminObj = new User();
//         // $adminObj->name = 'Admin Rafi';
//         $userObj->first_name = 'Admin';
//         $userObj->last_name = 'Rafi';
//         $adminObj->email = 'adminRafi@gmail.com';
//         $adminObj->password = Hash::make('123456789');
//         $adminObj->type = 1;
//         // $userObj->phone = '0652943737';
//         // $userObj->birthdate = 1999-07-14;
//         $adminObj->save();

//         $adminObj = new User();
//         // $adminObj->name = 'Admin Rafi';
//         $userObj->first_name = 'Wissal';
//         $userObj->last_name = 'Bara';
//         $adminObj->email = 'wissal@gmail.com';
//         $userObj->phone = '0652947373';
//         $userObj->birthdate = '2002-06-14';
//         $adminObj->save();

//     }
// }
//
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = new User();
        $user->first_name = 'User';
        $user->last_name = 'Salma';
        $user->email = 'userSalma@gmail.com';
        $user->password = Hash::make('123456789');
        $user->type = 0;
        $user->phone = '0652943737';
        $user->birthdate = '1999-07-14';
        $user->save();

        $admin = new User();
        $admin->first_name = 'Admin'; // Set first_name for admin user
        $admin->last_name = 'Salma';
        $admin->email = 'adminSalma@gmail.com';
        $admin->password = Hash::make('123456789');
        $admin->type = 1;
        $admin->save();

              // Another user without a password
              $anotherUser = new User();
              $anotherUser->first_name = 'Wissal';
              $anotherUser->last_name = 'Bara';
              $anotherUser->email = 'wissal@gmail.com';
              $anotherUser->type = 0;
              $anotherUser->phone = '0652947373';
              $anotherUser->birthdate = '2002-06-14';
              $anotherUser->save();

    }
}
