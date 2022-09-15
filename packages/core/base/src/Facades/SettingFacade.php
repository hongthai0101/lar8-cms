<?php
namespace Messi\Base\Facades;

use Illuminate\Support\Facades\Facade;

class SettingFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'setting';
    }
}