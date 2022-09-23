<?php

namespace Messi\Media\Repositories\Interfaces;


use Messi\Base\Repositories\RepositoryInterface;

interface MediaFileInterface extends RepositoryInterface
{
    /**
     * @param string $name
     * @param string $folder
     */
    public function createName(string $name,string $folder);

    /**
     * @param string $name
     * @param string $extension
     * @param string $folderPath
     */
    public function createSlug(string $name,string $extension,string $folderPath);

    /**
     * @param int $folderId
     * @param array $params
     * @param bool $withFolders
     * @param array $folderParams
     * @return mixed
     */
    public function getFilesByFolderId(
        int $folderId,
        array $params = [],
        bool $withFolders = true,
        array $folderParams = []
    ): mixed;

    /**
     * @param int $folderId
     * @param array $params
     * @param bool $withFolders
     * @param array $folderParams
     * @return mixed
     */
    public function getTrashed(
        int $folderId,
        array $params = [],
        bool $withFolders = true,
        array $folderParams = []
    ): mixed;

    /**
     * @return bool
     */
    public function emptyTrash(): bool;
}
