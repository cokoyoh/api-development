<?php


namespace Acme\Transformers;


class LessonTransformer extends Transformer
{

    /**
     * @param $lesson
     * @return array|mixed
     */
    public function transform($lesson)
    {
        return [
            'title' => $lesson->title,
            'body' => $lesson->body,
            'active' =>(boolean) $lesson->some_boolean
        ];
    }
}
