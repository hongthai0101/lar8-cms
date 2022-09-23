<?php
namespace Messi\Blog\Http\Requests\Api;


use Messi\Base\Http\Requests\Api\ApiRequest;
use Messi\Base\Types\MasterData;

/**
 * @OA\Schema(
 *      title="Category create request",
 *      description="Category create request body data",
 *      type="object",
 *      required={"title", "order", "status"}
 * )
 * @SuppressWarnings(PHPMD)
 */
class CategoryRequest extends ApiRequest
{
    /**
     * @OA\Property(
     *      title="title"
     * )
     *
     * @var string
     */
    public string $title;

    /**
     * @OA\Property(
     *      title="description",
     *      description="maximum 255 charactor"
     * )
     *
     * @var string
     */
    public string $description;

    /**
     * @OA\Property(
     *      title="parent_id"
     * )
     *
     * @var int
     */
    public int $parent_id;

    /**
     * @OA\Property(
     *      title="is_featured",
     *      example="true"
     * )
     *
     * @var bool
     */
    public bool $is_featured;

    /**
     * @OA\Property(
     *      title="order",
     *      example="1"
     * )
     *
     * @var int
     */
    public int $order;

    /**
     * @OA\Property(
     *      title="status",
     *      example="publish",
     *      enum={"publish: Publish","un_publish: Un Publish","draft: Draft"}
     * )
     *
     * @var string
     */
    public string $status;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'            => 'required|max:60|min:2',
            'description'      => 'nullable|string|min:1|max:255',
            'parent_id'        => 'nullable|int|min:0',
            'is_featured'        => 'nullable',
            'order'       => 'required|integer|min:0|max:127',
            'status'   => 'required|in:' . implode(',', array_keys(MasterData::statuses()))
        ];
    }
}
