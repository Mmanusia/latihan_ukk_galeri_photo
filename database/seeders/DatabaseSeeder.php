<?php

namespace Database\Seeders;

use App\Models\User;
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
        // User::factory(10)->create();

        User::factory()->create([
            'username' => 'admin',
            'email' => '1admin@test.com',
            'password' => bcrypt('12345678'),
            'namalengkap' => 'nama lengkap atmin',
            'alamat' => 'Malang 2.0',
            'role' => 'admin',
        ]);
    }
}
