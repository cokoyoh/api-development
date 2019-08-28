<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $seeders = [
        LessonsTableSeeder::class
    ];
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Lesson::truncate();

        collect($this->seeders)
            ->each(function ($seeder) {
            $this->call($seeder);
        });
    }
}
