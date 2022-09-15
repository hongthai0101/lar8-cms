<?php
namespace Messi\Base\Http\Requests\Auth;

use Messi\Base\Http\Requests\BaseRequest;

class ProfileRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' =>   'required|string|max:255',
            'phone' => 'required|string|max:25|unique:users,phone,' . $this->id,
        ];
    }
}