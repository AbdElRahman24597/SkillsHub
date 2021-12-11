<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SettingSeeder::class,
        ]);
        if (env('APP_ENV') != 'production') {
            $this->call([
                UserSeeder::class,
                DummySeeder::class, // Use this to create (categories, skills, exams and questions).
            ]);
        }
    }
}
