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

        $this->middleware('auth.basic')->only('store');
    }


    /**
     * @return JsonResponse
     */
    public function index()
    {
        $lessons = Lesson::latest()->get();

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

    public function store()
    {
        if (!request('title') || !request('body')) {
            return $this->respondFailedValidation('Parameters failed validation for a lesson');
        }

        Lesson::create(request()->all());

        return $this->respondCreated('Lesson created successfully');
    }
}
