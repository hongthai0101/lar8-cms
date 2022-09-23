<?php

namespace Messi\Blog\DataTables;

use Illuminate\Database\Query\Builder;
use Messi\Base\Supports\DataTableAbstract;
use Messi\Base\Types\MasterData;
use Messi\Blog\Models\Tag;
use Yajra\DataTables\Exceptions\Exception;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class TagDataTable extends DataTableAbstract
{
    protected $tableId = 'tags-table';

    /**
     * Build DataTable class.
     *
     * @param Builder $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     * @throws Exception
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('status', function (Tag $item) {
                return $item->status_html;
            })
            ->editColumn('action', function (Tag $item) {
                return $this->setActionColumn([
                    [
                        'type' => 'edit',
                        'route' => route('admin.tags.edit', $item->id)
                    ],
                    [
                        'type' => 'destroy',
                        'route' => route('admin.tags.destroy', $item->id)
                    ]
                ]);
            })
            ->rawColumns(['status', 'action']);
    }

    /**
     * @param Tag $model
     * @return mixed
     */
    public function query(Tag $model)
    {
        $query = $model
            ->newQuery()
            ->leftJoin('users', 'tags.created_id', '=', 'users.id')
            ->select(['tags.id', 'title', 'users.name as author', 'tags.created_at', 'status']);
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
        return 'Tag_' . date('YmdHis');
    }
}
