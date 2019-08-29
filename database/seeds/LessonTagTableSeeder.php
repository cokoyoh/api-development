<?php

use App\Lesson;
use App\LessonTag;
use App\Tag;
use Illuminate\Database\Seeder;

class LessonTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 30) as $item) {
            LessonTag::create([
                'lesson_id' => Lesson::inRandomOrder()->first()->id,
                'tag_id' => Tag::inRandomOrder()->first()->id
            ]);
        }
    }
}
