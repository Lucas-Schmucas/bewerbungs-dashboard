<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\User;
use Illuminate\Database\Seeder;
use function Laravel\Prompts\password;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

         User::factory()->create([
             'name' => 'Lucas',
             'email' => 'lucas@schmucas.de',
             'password' => env('ADMIN_PASSWORD')
         ]);

         Application::factory()->count(3)->create();
         Application::factory()->count(8)->withInterviewDate()->create();
         Application::factory()->count(5)->finished()->create();
    }
}
