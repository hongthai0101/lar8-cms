<?php
namespace Messi\Blog\Http\Requests\Admin;


use Messi\Base\Http\Requests\BaseRequest;
use Messi\Base\Types\MasterData;

class PostRequest extends BaseRequest
{
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
            'thumbnail'        => 'nullable|string',
            'content'          => 'required|string|min:1',
            'status'           => 'required|in:' . implode(',', array_keys(MasterData::statuses())),
            'categories'       => 'required',
            'tags'             => 'required'
        ];
    }
}
