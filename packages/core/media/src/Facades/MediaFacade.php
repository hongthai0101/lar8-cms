<?php

namespace Messi\Media\Facades;

use Messi\Media\Media;
use Illuminate\Support\Facades\Facade;

class MediaFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Media::class;
    }
}
