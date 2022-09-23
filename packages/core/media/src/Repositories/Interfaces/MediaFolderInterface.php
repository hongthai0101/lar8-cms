<?php

namespace Messi\Media\Repositories\Interfaces;


use Messi\Base\Repositories\RepositoryInterface;

interface MediaFolderInterface extends RepositoryInterface
{

    /**
     * @param int $folderId
     * @param array $params
     * @param bool $withTrash
     * @return mixed
     */
    public function getFolderByParentId(int $folderId, array $params = [], bool $withTrash = false): mixed;

    /**
     * @param string $name
     * @param int $parentId
     * @return string
     */
    public function createSlug(string $name,int $parentId);

    /**
     * @param string $name
     * @param int $parentId
     */
    public function createName(string $name,int $parentId);

    /**
     * @param int $parentId
     * @param array $breadcrumbs
     * @return array
     */
    public function getBreadcrumbs(int $parentId,array $breadcrumbs = []): array;

    /**
     * @param int $parentId
     * @param array $params
     * @return mixed
     */
    public function getTrashed(int $parentId, array $params = []): mixed;

    /**
     * @param int $folderId
     * @param bool $force
     */
    public function deleteFolder(int $folderId, bool $force = false);

    /**
     * @param int $parentId
     * @param array $child
     * @return array
     */
    public function getAllChildFolders(int $parentId, array $child = []): array;

    /**
     * @param int $folderId
     * @param string $path
     * @return string
     */
    public function getFullPath(int $folderId,string $path = ''): string;

    /**
     * @param int $folderId
     */
    public function restoreFolder(int $folderId);

    /**
     * @return bool
     */
    public function emptyTrash(): bool;
}
