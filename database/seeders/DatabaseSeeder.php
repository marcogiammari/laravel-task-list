<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        // carica sul db dei dati con proprietà diverse, qui per esempio degli utenti con email non verificate
        \App\Models\User::factory(10)->unverified()->create();
        \App\Models\Task::factory(20)->create();
    }
}
