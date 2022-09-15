<?php

namespace Messi\Media\Http\Resources;

use Messi\Media\Models\MediaFile;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Media;

/**
 * @mixin MediaFile
 */
class FileResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'basename'   => File::basename($this->url),
            'url'        => $this->url,
            'full_url'   => Media::url($this->url),
            'type'       => $this->type,
            'icon'       => $this->icon,
            'thumb'      => $this->type == 'image' ? Media::getImageUrl($this->url, 'thumb') : null,
            'size'       => $this->human_size,
            'mime_type'  => $this->mime_type,
            'options'    => $this->options,
            'folder_id'  => $this->folder_id,
        ];
    }
}
