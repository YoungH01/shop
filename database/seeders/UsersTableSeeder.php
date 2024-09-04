<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'hoang hung',
            'email' => 'hungbdh@hopee.com.vn',
            'password' => Hash::make('123qweasdzxc'),
            'phone' => '0848716169',
            'address' => 'quan Binh Thanh, Tp Ho Chi Minh',
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'henry Nguyen',
            'email' => 'henry@gmail.com',
            'password' => Hash::make('123qweasdzxc'),
            'phone' => '0987654321',
            'address' => '456 Elm St',
            'role' => 'customer'
        ]);
    }
}
