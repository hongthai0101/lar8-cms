<?php

namespace Messi\Media\Services;

use Exception;
use Intervention\Image\ImageManager;
use League\Flysystem\FilesystemException;
use Log;

class ThumbnailService
{

    /**
     * @var ImageManager
     */
    protected ImageManager $imageManager;

    /**
     * @var string
     */
    protected string $imagePath;

    /**
     * @var float
     */
    protected float $thumbRate;

    /**
     * @var int
     */
    protected int $thumbWidth;

    /**
     * @var int
     */
    protected int $thumbHeight;

    /**
     * @var string
     */
    protected string $destinationPath;

    /**
     * @var string | null
     */
    protected string | null $xCoordinate;

    /**
     * @var string | null
     */
    protected string | null $yCoordinate;

    /**
     * @var string
     */
    protected string $fitPosition;

    /**
     * @var string
     */
    protected string $fileName;

    /**
     * @var UploadsManager
     */
    protected UploadsManager $uploadManager;

    /**
     * ThumbnailService constructor.
     * @param UploadsManager $uploadManager
     * @param ImageManager $imageManager
     */
    public function __construct(UploadsManager $uploadManager, ImageManager $imageManager)
    {
        $this->thumbRate = 0.75;
        $this->xCoordinate = null;
        $this->yCoordinate = null;
        $this->fitPosition = 'center';

        $driver = 'gd';
        if (extension_loaded('imagick')) {
            $driver = 'imagick';
        }

        $this->imageManager = $imageManager->configure(compact('driver'));
        $this->uploadManager = $uploadManager;
    }

    /**
     * @param string $imagePath
     * @return ThumbnailService
     */
    public function setImage(string $imagePath): ThumbnailService
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->imagePath;
    }

    /**
     * @param int $width
     * @param int|null $height
     * @return ThumbnailService
     */
    public function setSize(int $width, int | null $height = null): ThumbnailService
    {
        $this->thumbWidth = $width;
        $this->thumbHeight = $height;

        if (empty($height)) {
            $this->thumbHeight = $this->thumbWidth * $this->thumbRate;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getSize(): array
    {
        return [$this->thumbWidth, $this->thumbHeight];
    }

    /**
     * @param string $destinationPath
     * @return ThumbnailService
     */
    public function setDestinationPath(string $destinationPath): ThumbnailService
    {
        $this->destinationPath = $destinationPath;

        return $this;
    }

    /**
     * @param int $xCoordination
     * @param int $yCoordination
     * @return ThumbnailService
     */
    public function setCoordinates(int $xCoordination,int $yCoordination): ThumbnailService
    {
        $this->xCoordinate = $xCoordination;
        $this->yCoordinate = $yCoordination;

        return $this;
    }

    /**
     * @return array
     */
    public function getCoordinates(): array
    {
        return [$this->xCoordinate, $this->yCoordinate];
    }

    /**
     * @param string $fileName
     * @return ThumbnailService
     */
    public function setFileName(string $fileName): ThumbnailService
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @param string $type
     * @return bool|string
     * @throws FilesystemException
     */
    public function save(string $type = 'fit'): bool|string
    {
        $fileName = pathinfo($this->imagePath, PATHINFO_BASENAME);

        if ($this->fileName) {
            $fileName = $this->fileName;
        }

        $destinationPath = sprintf('%s/%s', trim($this->destinationPath, '/'), $fileName);

        $thumbImage = $this->imageManager->make($this->imagePath);

        switch ($type) {
            case 'resize':
                $thumbImage->resize($this->thumbWidth, $this->thumbHeight);
                break;
            case 'crop':
                $thumbImage->crop($this->thumbWidth, $this->thumbHeight, $this->xCoordinate, $this->yCoordinate);
                break;
            case 'fit':
                $thumbImage->fit($this->thumbWidth, $this->thumbHeight, null, $this->fitPosition);
        }

        try {
            $this->uploadManager->saveFile($destinationPath, $thumbImage->stream()->__toString());
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return false;
        }

        return $destinationPath;
    }
}
