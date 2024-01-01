<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\User::create([
            'name' => "Bytermin",
            'email' => "bytermin121023@gmail.com",
            'password' => 'byteasvitamin121023',
            'is_admin' => true
        ]);

        \App\Models\User::create([
            'name' => "Thiha Ko Ko",
            'email' => "thihasithu0224@gmail.com",
            'password' => 'thiha0224',
            'is_admin' => false
        ]);
    }
}
