<?php

namespace App\Http\Controllers;

use Acme\Transformers\LessonTransformer;
use App\Lesson;
use Illuminate\Support\Facades\Response;

class LessonsController extends Controller
{
    protected $lessonsTransformer;

    /**
     * LessonsController constructor.
     * @param $lessonsTransformer
     */
    public function __construct(LessonTransformer $lessonsTransformer)
    {
        $this->lessonsTransformer = $lessonsTransformer;
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $lessons = Lesson::all();

        return Response::json([
            'data' => $this->lessonsTransformer->transformCollection($lessons)
        ], 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);

        if(is_null($lesson)) {
            return Response::json([
                'error' => [
                    'message' => 'lesson does not exit',
                ]
            ], 404);
        }

        return Response::json([
            'data' => $this->lessonsTransformer->transform($lesson)
        ], 200);
    }
}
