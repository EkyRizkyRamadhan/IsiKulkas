<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Role
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // 2. Buat User Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@isikulkas.com'],
            [
                'name' => 'Admin IsiKulkas',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole($adminRole);

        // 3. Buat User Contoh (biasa)
        $user = User::firstOrCreate(
            ['email' => 'user@isikulkas.com'],
            [
                'name' => 'User Contoh',
                'password' => Hash::make('password'),
            ]
        );
        $user->assignRole($userRole);
    }
}