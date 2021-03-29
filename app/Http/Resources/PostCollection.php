<?php

namespace App\Http\Resources;

use App\Traits\ApiResourceTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\AbstractPaginator;

class PostCollection extends ResourceCollection
{
    use ApiResourceTrait;
    public $collects = PostResource::class;
    // public $collects = StudioResoure::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $collection = $this->collection;
        if ($this->resource instanceof AbstractPaginator) {
            $collection = ['data' => $this->collection];
            $paginated = $this->resource->toArray();
            $collection['links'] = $this->paginationLinks($paginated);
            $collection['meta'] = $this->meta($paginated);
        }
        return $collection;
    }
}
