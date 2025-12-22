<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        DB::table('feedback_users')->insert([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create Regular User
        DB::table('feedback_users')->insert([
            'username' => 'user',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('Users created successfully!');
        $this->command->info('Admin: username=admin, password=admin123');
        $this->command->info('User: username=user, password=user123');
    }
}
