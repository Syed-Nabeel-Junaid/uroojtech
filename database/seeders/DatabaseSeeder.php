<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);

        // Old categories can only be safely removed once no product
        // references them (restrictOnDelete FK), i.e. after ProductSeeder
        // has replaced the catalog wholesale.
        (new CategorySeeder)->pruneOldCategories();
    }
}
