<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed a single development admin account.
     *
     * Credentials are read from the environment (see .env.example for the
     * ADMIN_DEFAULT_EMAIL / ADMIN_DEFAULT_PASSWORD keys) so no real secret is
     * hardcoded or committed to source control. For local development where
     * those keys are left unset, a clearly-labeled demo fallback is used.
     */
    public function run(): void
    {
        $email = env('ADMIN_DEFAULT_EMAIL', 'admin@uroojtech.test');
        $password = env('ADMIN_DEFAULT_PASSWORD', 'DevAdmin#2026');

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Urooj Tech Admin',
                'password' => Hash::make($password),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );
    }
}
