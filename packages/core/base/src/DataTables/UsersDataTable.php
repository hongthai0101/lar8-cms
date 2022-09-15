<?php

namespace Messi\Base\DataTables;

use Messi\Base\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use Messi\Base\Supports\DataTableAbstract;
use Yajra\Acl\Models\Role;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class UsersDataTable extends DataTableAbstract
{
    protected $tableId = 'users-table';
    /**
     * Build DataTable class.
     *
     * @param Builder $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query): \Yajra\DataTables\DataTableAbstract
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('action', function (User $user) {
                return $this->setActionColumn([
                    [
                        'type' => 'show',
                        'route' => route('admin.users.show', $user->id)
                    ],
                    [
                        'type' => 'destroy',
                        'route' => route('admin.users.destroy', $user->id)
                    ]
                ]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $filters = $this->getFilters(['role']);

        $query = $model
            ->newQuery()
            ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
            ->leftJoin('roles', 'roles.id', '=', 'role_user.role_id')
            ->where(function ($query) use ($filters) {
                $this->filterWhere($query, 'role_user.role_id', Arr::get($filters, 'role'));
            })
            ->select(['users.id', 'users.name', 'users.email', 'users.created_at', 'roles.name as role', 'phone', 'email']);
        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $roles = Role::all(['id', 'name'])->pluck('name', 'id')->toArray();
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
                    'placeholder' => __('Searching by name ....'),
                    'index' => 1
                ],
                [
                    'type' => 'input',
                    'placeholder' => __('Searching by phone ....'),
                    'index' => 2
                ],
                [
                    'type' => 'input',
                    'placeholder' => __('Searching by email ....'),
                    'index' => 3
                ],
                [
                    'type' => 'select',
                    'placeholder' => __('Searching by role ....'),
                    'index' => 4,
                    'data' => [__('Searching by role ....')] + $roles
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
            Column::make('phone'),
            Column::make('email'),
            Column::make('role')->searchable(false),
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
        return 'Users_' . date('YmdHis');
    }
}
