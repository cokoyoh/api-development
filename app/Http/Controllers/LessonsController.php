<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Support\Facades\Response;

class LessonsController extends Controller
{
    public function index()
    {
        $lessons = Lesson::all();

        return Response::json([
            'data' => $this->transformCollection($lessons)
        ], 200);
    }

    public function show($id)
    {
        $lesson = Lesson::find($id);

        if(! $lesson) {
            return Response::json([
                'error' => [
                    'message' => 'lesson does not exit',
                ]
            ], 404);
        }

        return Response::json([
            'data' => $this->transform($lesson)
        ], 200);
    }


    private function transformCollection(\Illuminate\Support\Collection $lessons)
    {
        return $lessons
            ->map(function ($lesson) {
                return $this->transform($lesson);
            });
    }

    public function transform($lesson)
    {
        return [
            'title' => $lesson->title,
            'body' => $lesson->body,
            'active' =>(boolean) $lesson->some_boolean
        ];
    }
}
