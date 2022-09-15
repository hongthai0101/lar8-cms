<?php
namespace Messi\Base\Http\Requests\Admin;


use Messi\Base\Http\Requests\BaseRequest;

class RoleRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'              => 'required|max:60|min:2',
            'slug'              => 'required|max:60|unique:roles',
            'description'       => 'nullable|string'
        ];
    }
}