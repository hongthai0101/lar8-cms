<?php
namespace Messi\Base\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Prettus\Repository\Eloquent\BaseRepository as EloquentRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class BaseRepository extends EloquentRepository implements RepositoryInterface
{
    /**
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder $data
     * @param bool $isSingle
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function applyBeforeExecuteQuery($data, $isSingle = false)
    {
        $this->resetModel();
        return $data;
    }

    /**
     * @param int $id
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|mixed|null|object
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function findOrFail($id)
    {
        $data = $this->makeModel()->where('id', $id);

        $result = $this->applyBeforeExecuteQuery($data, true)->first();

        if (!empty($result)) {
            return $result;
        }

        throw (new ModelNotFoundException)->setModel(
            get_class($this->model), $id
        );
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|mixed|null|object
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function findById($id)
    {
        $data = $this->makeModel()->where('id', $id);

        return $this->applyBeforeExecuteQuery($data, true)->first();
    }

    /**
     * @param array|\Illuminate\Database\Eloquent\Model $data
     * @param array $condition
     * @return array|bool|false|\Illuminate\Database\Eloquent\Model|Model
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function createOrUpdate($data, array $condition = [])
    {
        /**
         * @var Model $item
         */
        if (is_array($data)) {
            if (empty($condition)) {
                $item = new $this->model;
            } else {
                $item = $this->getFirstBy($condition);
            }
            if (empty($item)) {
                $item = new $this->model;
            }

            $item = $item->fill($data);
        } elseif ($data instanceof Model) {
            $item = $data;
        } else {
            return false;
        }

        if ($item->save()) {
            $this->resetModel();
            return $item;
        }

        $this->resetModel();

        return false;
    }

    /**
     * @param array $condition
     */
    public function forceDelete(array $condition = [])
    {
        $this->applyConditions($condition);

        $item = $this->model->withTrashed()->first();
        if (!empty($item)) {
            $item->forceDelete();
        }
    }


    /**
     * @param array $condition
     * @return mixed|void
     */
    public function restoreBy(array $condition = [])
    {
        $this->applyConditions($condition);

        $item = $this->model->withTrashed()->first();
        if (!empty($item)) {
            $item->restore();
        }
    }

    /**
     * @param array $condition
     * @param array $select
     * @return Model|\Illuminate\Database\Query\Builder|mixed|null|object
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getFirstBy(array $condition = [], array $select = ['*'])
    {
        $this->makeModel();

        $this->applyConditions($condition);

        if (!empty($select)) {
            $data = $this->model->select($select);
        } else {
            $data = $this->model->select('*');
        }

        return $this->applyBeforeExecuteQuery($data, true)->first();
    }

    /**
     * {@inheritDoc}
     */
    public function deleteBy(array $condition = [])
    {
        $this->applyConditions($condition);

        $data = $this->model->get();

        if (empty($data)) {
            return false;
        }

        foreach ($data as $item) {
            $item->delete();
        }

        $this->resetModel();

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function getFirstByWithTrash(array $condition = [], array $select = [])
    {
        $this->applyConditions($condition);

        $query = $this->model->withTrashed();

        if (!empty($select)) {
            return $query->select($select)->first();
        }

        return $this->applyBeforeExecuteQuery($query, true)->first();
    }

    /**
     * @param array $where
     * @param null|Eloquent|Builder $model
     */
    protected function applyConditions(array $where, &$model = null)
    {
        if (!$model) {
            $newModel = $this->model;
        } else {
            $newModel = $model;
        }
        foreach ($where as $field => $value) {
            if (is_array($value)) {
                [$field, $condition, $val] = $value;
                switch (strtoupper($condition)) {
                    case 'IN':
                        $newModel = $newModel->whereIn($field, $val);
                        break;
                    case 'NOT_IN':
                        $newModel = $newModel->whereNotIn($field, $val);
                        break;
                    default:
                        $newModel = $newModel->where($field, $condition, $val);
                        break;
                }
            } else {
                $newModel = $newModel->where($field, $value);
            }
        }
        if (!$model) {
            $this->model = $newModel;
        } else {
            $model = $newModel;
        }
    }

    /**
     * @param array $params
     * @return Model|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection|object|null
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function advancedGet(array $params = [])
    {
        $params = array_merge([
            'condition' => [],
            'order_by'  => [],
            'take'      => null,
            'paginate'  => [
                'per_page'      => null,
                'current_paged' => 1,
            ],
            'select'    => ['*'],
            'with'      => [],
            'withCount' => [],
        ], $params);

        $this->applyConditions($params['condition']);

        $data = $this->model;

        if ($params['select']) {
            $data = $data->select($params['select']);
        }

        foreach ($params['order_by'] as $column => $direction) {
            if (!in_array(strtolower($direction), ['asc', 'desc'])) {
                continue;
            }

            if ($direction !== null) {
                $data = $data->orderBy($column, $direction);
            }
        }

        if (!empty($params['with'])) {
            $data = $data->with($params['with']);
        }

        if (!empty($params['withCount'])) {
            $data = $data->withCount($params['withCount']);
        }

        if ($params['take'] == 1) {
            $result = $this->applyBeforeExecuteQuery($data, true)->first();
        } elseif ($params['take']) {
            $result = $this->applyBeforeExecuteQuery($data)->take((int)$params['take'])->get();
        } elseif ($params['paginate']['per_page']) {
            $paginateType = 'paginate';
            if (Arr::get($params, 'paginate.type') && method_exists($data, Arr::get($params, 'paginate.type'))) {
                $paginateType = Arr::get($params, 'paginate.type');
            }
            $result = $this->applyBeforeExecuteQuery($data)
                ->$paginateType(
                    (int)Arr::get($params, 'paginate.per_page', 10),
                    [$this->originalModel->getTable() . '.' . $this->originalModel->getKeyName()],
                    'page',
                    (int)Arr::get($params, 'paginate.current_paged', 1)
                );
        } else {
            $result = $this->applyBeforeExecuteQuery($data)->get();
        }

        return $result;
    }

}
