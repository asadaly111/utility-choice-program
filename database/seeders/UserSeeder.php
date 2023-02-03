<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'password' => 'password'
        ]);

        User::create([
            'name' => 'Sean',
            'email' => 'client@gmail.com',
            'email_verified_at' => now(),
            'role' => 'agent',
            'password' => 'password'
        ]);

        User::create([
            'name' => 'David',
            'email' => 'employee@gmail.com',
            'email_verified_at' => now(),
            'role' => 'agent',
            'password' => 'password'
        ]);
    }
}
