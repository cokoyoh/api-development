<?php

namespace App\Http\Controllers;

use Acme\Transformers\TagTransformer;
use App\Lesson;
use App\Tag;

class TagsController extends ApiController
{
    protected $tagsTransformer;

    /**
     * TagsController constructor.
     * @param $tagsTransformer
     */
    public function __construct(TagTransformer $tagsTransformer)
    {
        $this->tagsTransformer = $tagsTransformer;
    }

    public function index($lessonId = null)
    {
        $lesson = Lesson::find($lessonId);

        if (is_null($lesson)) {
            return $this->setStatusCode(404)
                ->respondWithError('Resource not found!');
        }

        $tags = $lesson->tags ?? Tag::latest()->get();

        return $this->respond([
            'data' => $this->tagsTransformer->transformCollection($tags)
        ]);
    }
}
