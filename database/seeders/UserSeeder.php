<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@poltekkes.ac.id',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
        ]);

        User::create([
            'name' => 'Admin Operator',
            'email' => 'admin@poltekkes.ac.id',
            'password' => Hash::make('password'),
            'role' => 'admin_operator',
        ]);
    }
}
