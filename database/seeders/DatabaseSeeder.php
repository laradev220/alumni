<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $admin = User::firstOrCreate(
            ['email' => 'admin@alumniconnect.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
            ]
        );
        $admin->assignRole('admin');

        $alumni = User::firstOrCreate(
            ['email' => 'alumni@alumniconnect.com'],
            [
                'name' => 'Test Alumni',
                'password' => bcrypt('password'),
            ]
        );
        $alumni->assignRole('alumni');

        $student = User::firstOrCreate(
            ['email' => 'student@alumniconnect.com'],
            [
                'name' => 'Test Student',
                'password' => bcrypt('password'),
            ]
        );
        $student->assignRole('student');
    }
}
