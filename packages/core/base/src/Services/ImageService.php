<?php
namespace Messi\Base\Services;

use Illuminate\Support\Facades\Storage;

class ImageService
{
    /**
     * @param $image
     * @param string $pathInput
     * @return bool|array|string
     */
    public function base64($image,string $pathInput = ''): bool|array|string
    {
        try{
            list($type, $image) = explode(';', $image);
            list(, $image)      = explode(',', $image);

            $image = base64_decode($image);
            $imageName = md5(auth()->id()) . '.png';
            $path = $pathInput . $imageName;
            Storage::put($path, $image);
            return $pathInput . $imageName;
        } catch (\Exception $exception){
            logger('ImageService base64 errors:' . $exception->getMessage());
            return false;
        }
    }
}
