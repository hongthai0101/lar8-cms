<?php
namespace Messi\Base\Types;

class MasterData
{
    public static function statuses()
    {
        return [
            'publish' => __('Publish'),
            'un_publish' => __('Un Publish'),
            'draft' => __('Draft')
        ];
    }
}