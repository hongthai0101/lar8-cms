<?php

namespace Messi\Blog\DataTables;

use Illuminate\Database\Query\Builder;
use Messi\Base\Supports\DataTableAbstract;
use Messi\Base\Types\MasterData;
use Messi\Blog\Models\Post;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class PostDataTable extends DataTableAbstract
{
    protected $tableId = 'posts-table';
    /**
     * Build DataTable class.
     *
     * @param Builder $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('thumbnail', function (Post $item) {
                return $item->thumbnail_html;
            })
            ->editColumn('status', function (Post $item) {
                return $item->status_html;
            })
            ->editColumn('action', function (Post $item) {
                return $this->setActionColumn([
                    [
                        'type' => 'edit',
                        'route' => route('admin.posts.edit', $item->id)
                    ],
                    [
                        'type' => 'destroy',
                        'route' => route('admin.posts.destroy', $item->id)
                    ]
                ]);
            })
            ->rawColumns(['status', 'action', 'thumbnail']);
    }

    /**
     * @param Post $model
     * @return mixed
     */
    public function query(Post $model)
    {
        $query = $model
            ->newQuery()
            ->leftJoin('users', 'posts.created_id', '=', 'users.id')
            ->select(['posts.id', 'title', 'users.name as author', 'posts.created_at', 'status', 'thumbnail']);
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
                Button::make('export'),
                Button::make('print'),
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
    protected function filename()
    {
        return 'Post_' . date('YmdHis');
    }
}
