<?php

namespace Messi\Blog\Http\Resources;

use Messi\Base\Http\Resources\BaseResource;

/**
 * @OA\Schema(
 *     title="CategoryResource",
 *     description="CategoryResource",
 *     @OA\Xml(
 *         name="CategoryResource"
 *     )
 * )
 * @SuppressWarnings(PHPMD)
 */
class CategoryResource extends BaseResource
{
    /**
     * @OA\Property(
     *      property="id"
     * )
     *
     * @var int
     */
    public int $id;

    /**
     * @OA\Property(
     *      property="title"
     * )
     *
     * @var string
     */
    public string $title;

    /**
     * @OA\Property(
     *      property="parent_id"
     * )
     *
     * @var int
     */
    public int $parent_id;

    /**
     * @OA\Property(
     *      property="description"
     * )
     *
     * @var string
     */
    public string $description;

    /**
     * @OA\Property(
     *      property="status"
     * )
     *
     * @var string
     */
    public string $status;

    /**
     * @OA\Property(
     *      property="order"
     * )
     *
     * @var int
     */
    public int $order;

    /**
     * @OA\Property(
     *      property="is_featured"
     * )
     *
     * @var int
     */
    public int $is_featured;

    /**
     * @OA\Property(
     *      property="created_at"
     * )
     *
     * @var string
     */
    public string $created_at;

    /**
     * @OA\Property(
     *      property="updated_at",
     *      example="2022-09-23T00:58:57.000000Z"
     * )
     *
     * @var string
     */
    public string $updated_at;

    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
