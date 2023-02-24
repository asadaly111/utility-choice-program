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
            'phone' => '+1 (305) 603-2252',
            'password' => 'password',
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Sean',
            'email' => 'client@gmail.com',
            'phone' => '+1 (305) 603-2252',
            'password' => 'password',
            'role' => 'agent',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'David',
            'email' => 'employee@gmail.com',
            'phone' => '+1 (305) 603-2252',
            'password' => 'password',
            'role' => 'agent',
            'email_verified_at' => now(),
        ]);
    }
}
