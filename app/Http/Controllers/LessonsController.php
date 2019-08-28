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
            'data' => $lessons->toArray()
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
            'data' => $lesson->toArray(),
        ], 200);
    }
}
