<?php
namespace Messi\Base\Http\Collections;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\AbstractPaginator;

abstract class BaseCollection extends ResourceCollection
{
    public int $total = 0;
    public bool $hasMore = false;

    /**
     * CourseCollection constructor.
     * @param $resource
     */
    public function __construct($resource)
    {
        try {
            if ($resource instanceof AbstractPaginator){
                $this->total = $resource->total();
                $this->hasMore = $resource->lastPage() > $resource->currentPage();
                $resource = $resource->getCollection();
            }
            else {
                $this->total = count($resource);
            }
        }
        catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
        parent::__construct($resource);
    }

    /**
     * @param $request
     * @return array
     */
    public function with($request): array
    {
        return [
            'has_more' => $this->hasMore,
            'total' => $this->total
        ];
    }
}
