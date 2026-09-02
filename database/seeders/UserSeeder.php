<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roleAdmin      = Role::create(['name' => 'administrator', 'guard_name' => 'web']);
        $roleBd = Role::create(['name' => 'bd', 'guard_name' => 'web']);
        $password = Hash::make('password');

        $admin = User::create([
            'name' => 'Moonlight Sonata',
            'email' => 'admin@admin.com',
            'password' => $password,
            'email_verified_at' => now(),
        ]);
        $admin->assignRole($roleAdmin);

        $bd = User::create([
            'name' => 'BD User',
            'email' => 'bd@demo.com',
            'password' => $password,
            'email_verified_at' => now(),
        ]);
        $bd->assignRole($roleBd);
    }
}
