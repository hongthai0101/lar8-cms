<?php
namespace Messi\Base\Repositories\Eloquent;

use Messi\Base\Models\Setting;
use Messi\Base\Repositories\Contracts\SettingRepository;
use Prettus\Repository\Eloquent\BaseRepository;

class SettingRepositoryEloquent extends BaseRepository implements SettingRepository
{
    public function model(): string
    {
        return Setting::class;
    }
}
