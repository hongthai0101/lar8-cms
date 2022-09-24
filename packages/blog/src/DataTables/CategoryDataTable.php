<?php

namespace Messi\Blog\DataTables;

use Illuminate\Database\Query\Builder;
use Messi\Base\Supports\DataTableAbstract;
use Messi\Base\Types\MasterData;
use Messi\Blog\Models\Category;
use Yajra\DataTables\Exceptions\Exception;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class CategoryDataTable extends DataTableAbstract
{
    protected $tableId = 'categories-table';

    /**
     * Build DataTable class.
     *
     * @param Builder $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     * @throws Exception
     */
    public function dataTable($query): \Yajra\DataTables\DataTableAbstract
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('status', function (Category $item) {
                return $item->status_html;
            })
            ->editColumn('action', function (Category $item) {
                return $this->setActionColumn([
                    [
                        'permission' => 'update-blog',
                        'type' => 'edit',
                        'route' => route('admin.categories.edit', $item->id)
                    ],
                    [
                        'type' => 'destroy',
                        'route' => route('admin.categories.destroy', $item->id),
                        'permission' => 'delete-blog',
                    ]
                ]);
            })
            ->rawColumns(['status', 'action']);
    }

    /**
     * @param Category $model
     * @return mixed
     */
    public function query(Category $model): mixed
    {
        $query = $model
            ->newQuery()
            ->leftJoin('users', 'categories.created_id', '=', 'users.id')
            ->leftJoin('categories as parent', 'categories.parent_id', '=', 'parent.id')
            ->select(['categories.id', 'categories.title', 'users.name as author', 'categories.created_at', 'categories.status', 'parent.title as parent']);
        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $statuses = MasterData::statuses();
        return $this->builder()
            ->setTableId($this->tableId)
            ->columns($this->getColumns())
            ->buttons(
                Button::make('create'),
                Button::make('reload')
            )->initComplete($this->filterFooter([
                [
                    'type' => 'input',
                    'placeholder' => __('Searching by title ....'),
                    'index' => 1
                ],
                [
                    'type' => 'select',
                    'index' => 2,
                    'data' => ['' => __('Searching by statuses ....')] + $statuses
                ]
            ]));
    }
    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('title'),
            Column::make('parent'),
            Column::make('status'),
            Column::make('author')->searchable(false),
            Column::make('created_at'),
            Column::computed('action')
                ->searchable(false)
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Category_' . date('YmdHis');
    }
}
