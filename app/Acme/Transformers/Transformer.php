<?php


namespace Acme\Transformers;


use Illuminate\Support\Collection;

abstract class Transformer
{
    /**
     * @param Collection $items
     * @return Collection
     */
    public function transformCollection(Collection $items)
    {
        return $items
            ->map(function ($item) {
                return $this->transform($item);
            });
    }

    /**
     * @param $item
     * @return mixed
     */
    public abstract function transform($item);
}
