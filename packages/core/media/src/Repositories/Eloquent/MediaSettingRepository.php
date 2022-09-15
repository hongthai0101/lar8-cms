<?php

namespace Messi\Media\Repositories\Eloquent;


use Messi\Base\Repositories\BaseRepository;
use Messi\Media\Models\MediaSetting;
use Messi\Media\Repositories\Interfaces\MediaSettingInterface;

class MediaSettingRepository extends BaseRepository implements MediaSettingInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MediaSetting::class;
    }
}
