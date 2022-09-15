<?php
namespace Messi\Base\Http\Requests\Auth;

use Messi\Base\Http\Requests\BaseRequest;
use Messi\Base\Rules\CheckOldPassword;

class PasswordRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => [
                'required',
                'string',
                'min:6',
                new CheckOldPassword()
            ],
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}