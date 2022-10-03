<?php
namespace Messi\Email\Http\Requests\Admin;

use Messi\Base\Http\Requests\BaseRequest;
use Messi\Base\Types\MasterData;

class MailTemplateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'            => 'required|max:60|min:2',
            'description'     => 'nullable|string|min:1|max:255',
            'status'          => 'required|in:' . implode(',', array_keys(MasterData::statuses())),
            'subject'         => 'required|max:100|min:2',
            'html_template'   => 'required',
            'text_template'   => 'required',
            'is_header'       => 'nullable',
            'is_footer'       => 'nullable',
            'field_replace_to_content' => 'nullable',
        ];
    }
}
