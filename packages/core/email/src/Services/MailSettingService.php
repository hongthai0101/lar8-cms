<?php

namespace Messi\Email\Services;

use Messi\Email\Http\Requests\Admin\MailSettingRequest;

class MailSettingService
{
    /**
     * @param MailSettingRequest $request
     * @return bool
     */
    public function update(MailSettingRequest $request): bool
    {
        $footer = $request->input('footer');
        $header = $request->input('header');
        \File::replace(config('core.email.mail-template.setting.footer'), $footer);
        \File::replace(config('core.email.mail-template.setting.header'), $header);

        return true;
    }
}
