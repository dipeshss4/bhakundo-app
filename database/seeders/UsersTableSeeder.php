<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $roles = [
//            [
//                'name' => 'admin',
//                'guard_name' => 'web'
//            ],
//            [
//                'name' => 'editor',
//                'guard_name' => 'web'
//            ]
//        ];
//
//        Role::insert($roles);

        //for creating admin users
        $admin = User::create([
            'first_name' => 'Admin ',
            'last_name' => 'User',
            'email' => 'admin@bhankundo.com',
            'password' => bcrypt('password'),
        ]);
        $admin->roles()->attach(Role::where('name', 'admin')->first());

        $editors = User::create([
            'first_name' => 'Editor ',
            'last_name' => 'User',
            'email' => 'editor@bhankundo.com',
            'password' => bcrypt('password'),
        ]);
        $editors->roles()->attach(Role::where('name', 'editor')->first());








    }
}
