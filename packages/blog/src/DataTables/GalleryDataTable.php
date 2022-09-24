<?php

namespace Messi\Blog\DataTables;

use Illuminate\Database\Query\Builder;
use Messi\Base\Supports\DataTableAbstract;
use Messi\Base\Types\MasterData;
use Messi\Blog\Models\Gallery;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class GalleryDataTable extends DataTableAbstract
{
    protected $tableId = 'galleries-table';

    /**
     * Build DataTable class.
     *
     * @param Builder $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     * @throws \Yajra\DataTables\Exceptions\Exception
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('thumbnail', function (Gallery $item) {
                return $item->thumbnail_html;
            })
            ->editColumn('status', function (Gallery $item) {
                return $item->status_html;
            })
            ->editColumn('action', function (Gallery $item) {
                return $this->setActionColumn([
                    [
                        'type' => 'edit',
                        'route' => route('admin.galleries.edit', $item->id),
                        'permission' => 'update-blog',
                    ],
                    [
                        'type' => 'destroy',
                        'route' => route('admin.galleries.destroy', $item->id),
                        'permission' => 'delete-blog',
                    ]
                ]);
            })
            ->rawColumns(['status', 'action', 'thumbnail']);
    }

    /**
     * @param Gallery $model
     * @return mixed
     */
    public function query(Gallery $model)
    {
        $query = $model
            ->newQuery()
            ->leftJoin('users', 'galleries.created_id', '=', 'users.id')
            ->select(['galleries.id', 'title', 'users.name as author', 'galleries.created_at', 'status', 'thumbnail']);
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
                Button::make('reset'),
                Button::make('reload')
            )->initComplete($this->filterFooter([
                [
                    'type' => 'input',
                    'placeholder' => __('Searching by title ....'),
                    'index' => 2
                ],
                [
                    'type' => 'select',
                    'index' => 3,
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
            Column::make('thumbnail')->width(50)->className('text-center'),
            Column::make('title'),
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
        return 'Gallery_' . date('YmdHis');
    }
}
