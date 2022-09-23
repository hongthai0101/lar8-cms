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
            $this->createFolder($pathInput);

            list($type, $image) = explode(';', $image);
            list(, $image)      = explode(',', $image);

            $image = base64_decode($image);
            $imageName = md5(auth()->id()) . '.png';
            $path = $pathInput . $imageName;
            Storage::disk('local')->put($path, file_put_contents($path, $image));
            return $pathInput . $imageName;
        } catch (\Exception $exception){
            logger($exception->getMessage());
            return false;
        }
    }

    /**
     * @param $folder
     */
    private function createFolder($folder)
    {
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
    }
}
