<?php

namespace Messi\Base\Transformers\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

abstract class BaseResource extends JsonResource
{
    public static $wrap = '';
}
