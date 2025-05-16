<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            [
                'user_id' => (string) Str::uuid(),
                'email' => 'admin@example.com',
                'password' => 'password123', // mã hóa password
                'name' => 'Admin User',
                'phone_number' => '0123456789',
                'user_image' => null,
                'is_admin' => 'admin',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => (string) Str::uuid(),
                'email' => 'user@example.com',
                'password' => 'password123',
                'name' => 'Regular User',
                'phone_number' => '0987654321',
                'user_image' => null,
                'is_admin' => 'user',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'user_id' => (string) Str::uuid(),
                'email' => 'guest@example.com',
                'password' => 'password123',
                'name' => 'Guest User',
                'phone_number' => '0900123456',
                'user_image' => null,
                'is_admin' => 'user',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
