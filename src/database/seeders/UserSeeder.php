<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles: manager, waiter, chef, bartender

        $roles = ['manager', 'waiter', 'chef', 'bartender'];

        foreach ($roles as $role) {
            $user = new User();
            $user->name = 'Teszt ' . ucfirst($role);
            $user->username = $role;
            $user->email = 'teszt.' . $role . '@email.com';
            $user->email_verified_at = now();
            $user->password = bcrypt('password'); // Default password
            $user->role = $role;
            $user->status = 'active';
            $user->save();
        }

    }
}
