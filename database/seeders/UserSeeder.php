<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Schema::disableForeignKeyConstraints();
        // User::truncate();
        // Schema::enableForeignKeyConstraints();

        // Student::factory()->count(30)->create();
        User::insert([
            'email' => 'admin@email.com',
            'username' => 'admin',
            'password' => Hash::make('rahasia'),
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'created_at' => Carbon::now(),
        ]);
    }
}
