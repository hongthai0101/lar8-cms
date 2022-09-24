<?php
namespace Messi\Base\Traits;


use Illuminate\Support\Arr;
use Messi\Base\Types\MasterData;
use Throwable;

/**
 *
 * @property string status
 * @property string thumbnail
 * @package namespace App\Models;
 */
trait ModelTrait
{
    /**
     * Get Status Html
     * @return string
     * @throws Throwable
     */
    public function getStatusHtmlAttribute(): string
    {
        $statuses = MasterData::statuses();
        return view('core/base::components.status', [
            'title' => Arr::get($statuses, $this->status),
            'type' => $this->getTypeStatus($this->status)
        ])->render();
    }

    /**
     * @param $status
     * @return string
     */
    private function getTypeStatus($status): string
    {
        return match ($status) {
            'publish' => 'success',
            'un_publish' => 'warning',
            'draft' => 'danger',
            default => 'metal',
        };
    }

    /**
     * Get Thumbnail Html
     * @return string
     * @throws Throwable
     */
    public function getThumbnailHtmlAttribute(): string
    {
        return view('core/base::components.thumbnail', [
            'url' => get_image_url($this->thumbnail, 'thumb')
        ])->render();
    }
}
