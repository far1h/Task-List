<?php

namespace Database\Seeders;

use App\Models\Task as ModelsTask;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // php artisan db:seed
        // php artisan migrate:refresh --seed

        User::factory(10)->create();
        User::factory(10)->unverified()->create();
        ModelsTask::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
