<?php
namespace Messi\Email\Http\Requests\Admin;

use Messi\Base\Http\Requests\BaseRequest;

class MailSettingRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'footer'            => 'required|min:2',
            'header'         => 'required|min:2'
        ];
    }
}
