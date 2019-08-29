<?php

namespace App\Http\Controllers;

use Acme\Transformers\LessonTransformer;
use App\Lesson;
use Illuminate\Http\JsonResponse;

class LessonsController extends ApiController
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
     * @return JsonResponse
     */
    public function index()
    {
        $lessons = Lesson::all();

        return $this->respond([
            'data' => $this->lessonsTransformer->transformCollection($lessons)
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);

        if(is_null($lesson)) {
            return $this->respondNotFound('Lesson does not exist');
        }

        return $this->respond([
            'data' => $this->lessonsTransformer->transform($lesson)
        ]);
    }
}
