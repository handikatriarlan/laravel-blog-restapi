<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            // 'data' => $this->collection, //Not formatted

            'data' => PostResource::collection($this->collection),
            'meta' => [
                'total_post' => $this->collection->count()
            ]
        ];
    }
}
