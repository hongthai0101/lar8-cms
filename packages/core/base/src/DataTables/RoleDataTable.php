<?php

namespace Messi\Base\DataTables;

use Illuminate\Database\Query\Builder;
use Messi\Base\Supports\DataTableAbstract;
use Yajra\Acl\Models\Role;
use Yajra\DataTables\Exceptions\Exception;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class RoleDataTable extends DataTableAbstract
{
    protected $tableId = 'roles-table';

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
            ->editColumn('action', function (Role $item) {
                return $this->setActionColumn([
                    [
                        'type' => 'edit',
                        'route' => route('admin.roles.edit', $item->id),
                        'permission' => 'update-role'
                    ],
                    [
                        'type' => 'show',
                        'route' => route('admin.roles.show', $item->id),
                        'permission' => 'view-role'
                    ],
                    [
                        'type' => 'destroy',
                        'route' => route('admin.roles.destroy', $item->id),
                        'permission' => 'delete-role'
                    ]
                ]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
    {
        $query = $model
            ->newQuery()
            ->select(['id', 'name', 'description', 'created_at']);
        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId($this->tableId)
            ->columns($this->getColumns())
            ->buttons(
                Button::make('create'),
                Button::make('reload')
            )
           ->initComplete($this->filterFooter([
                [
                    'type' => 'input',
                    'placeholder' => __('Searching by name ....'),
                    'index' => 1
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
            Column::make('name'),
            Column::make('description'),
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
        return 'Roles_' . date('YmdHis');
    }
}
