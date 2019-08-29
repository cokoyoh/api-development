<?php

use Illuminate\Database\Seeder;

class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1, 30) as $item)
        {
            \App\Lesson::create([
                'title' => $faker->sentence(6, false),
                'body' => $faker->paragraph(3, false),
                'some_boolean' => $faker->randomElement([0, 1])
            ]);
        }
    }
}
