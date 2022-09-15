<?php
namespace Messi\Base\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface as BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

interface RepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Retrieve model by id regardless of status.
     *
     * @param int $id
     * @return mixed
     */
    public function findById($id);

    /**
     * @param int $id
     * @return mixed
     */
    public function findOrFail($id);

    /**
     * Create a new model.
     *
     * @param Model|array $data
     * @param array $condition
     * @return false|Model
     */
    public function createOrUpdate($data, array $condition = []);

    /**
     * @param Builder|Model $data
     * @param bool $isSingle
     * @return Builder
     */
    public function applyBeforeExecuteQuery($data, $isSingle = false);

    /**
     * @param array $condition
     */
    public function forceDelete(array $condition = []);

    /**
     * @param array $condition
     * @return mixed
     */
    public function restoreBy(array $condition = []);

    /**
     * Find a single entity by key value.
     *
     * @param array $condition
     * @param array $select
     * @return mixed
     */
    public function getFirstBy(array $condition = [], array $select = []);

    /**
     * @param array $condition
     * @return mixed
     * @throws Exception
     */
    public function deleteBy(array $condition = []);

    /**
     * Find a single entity by key value.
     *
     * @param array $condition
     * @param array $select
     * @return mixed
     */
    public function getFirstByWithTrash(array $condition = [], array $select = []);
}