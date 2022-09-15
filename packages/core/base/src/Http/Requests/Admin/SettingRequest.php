<?php
namespace Messi\Base\Http\Requests\Admin;


use Messi\Base\Http\Requests\BaseRequest;

class SettingRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            '__admin_title__'            => 'nullable',
            '__admin_copyright__'            => 'nullable',
            '__admin_favicon__'            => 'nullable',
            '__admin_logo__'            => 'nullable',
            '__mail_sender_name__' => 'nullable',
            '__mail_sender_email__' => 'nullable'
        ];
    }
}