<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole('admin');

        $manager1 = User::firstOrCreate(
            ['email' => 'manager1@test.com'],
            [
                'name' => 'Manager One',
                'password' => Hash::make('password'),
            ]
        );
        $manager1->assignRole('manager');

        $manager2 = User::firstOrCreate(
            ['email' => 'manager2@test.com'],
            [
                'name' => 'Manager Two',
                'password' => Hash::make('password'),
            ]
        );
        $manager2->assignRole('manager');
    }
}
