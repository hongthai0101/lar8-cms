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
    public function rules(): array
    {
        $routeName = $this->route()->getName();
        if ($routeName === 'admin.settings.media') return $this->ruleMedia();

        if ($routeName === 'admin.settings.email') return $this->ruleEmail();

        if ($routeName === 'admin.settings.general') return $this->ruleGeneral();

        return [];
    }

    /**
     * @return string[]
     */
    private function ruleMedia(): array
    {
        return [
            '__filesystem_default__'            => 'required|in:s3,public',
            '__s3_id__'                         => 'required_if:__filesystem_default__,s3',
            '__s3_secret__'                     => 'required_if:__filesystem_default__,s3',
            '__s3_region__'                     => 'required_if:__filesystem_default__,s3',
            '__s3_bucket__'                     => 'required_if:__filesystem_default__,s3',
            'media_watermark_enabled'           => 'nullable',
            'media_default_placeholder_image'   => 'nullable',
            'media_watermark_source'            => 'nullable'
        ];
    }

    /**
     * @return string[]
     */
    private function ruleGeneral(): array
    {
        return [
            '__admin_title__'      => 'nullable',
            '__admin_copyright__'  => 'nullable',
            '__admin_favicon__'    => 'nullable',
            '__admin_logo__'       => 'nullable'
        ];
    }

    /**
     * @return string[]
     */
    private function ruleEmail(): array
    {
        return [
            '__mail_sender_name__' => 'nullable',
            '__mail_sender_email__'=> 'nullable'
        ];
    }
}
