<?php

namespace Messi\Email\DataTables;

use Illuminate\Database\Query\Builder;
use Messi\Base\Supports\DataTableAbstract;
use Messi\Base\Types\MasterData;
use Messi\Email\Models\MailTemplate;
use Yajra\DataTables\Exceptions\Exception;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class MailTemplateDataTable extends DataTableAbstract
{
    protected $tableId = 'mail-templates-table';

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
            ->editColumn('status', function (MailTemplate $item) {
                return $item->status_html;
            })
            ->editColumn('action', function (MailTemplate $item) {
                return $this->setActionColumn([
                    [
                        'permission' => 'update-mailtemplate',
                        'type' => 'edit',
                        'route' => route('admin.mail-templates.edit', $item->id)
                    ],
                    [
                        'type' => 'show',
                        'route' => route('admin.mail-templates.show', $item->id),
                        'permission' => 'view-mailtemplate',
                    ],
                    [
                        'type' => 'destroy',
                        'route' => route('admin.mail-templates.destroy', $item->id),
                        'permission' => 'delete-mailtemplate',
                        'isDisplay' => $item->is_can_delete
                    ]
                ]);
            })
            ->rawColumns(['status', 'action']);
    }

    /**
     * @param MailTemplate $model
     * @return mixed
     */
    public function query(MailTemplate $model): mixed
    {
        $query = $model
            ->newQuery()
            ->leftJoin('users', 'mail_templates.created_id', '=', 'users.id')
            ->select([
                'mail_templates.id',
                'mail_templates.name',
                'users.name as author',
                'mail_templates.created_at',
                'mail_templates.status',
                'is_can_delete'
            ]);
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
    protected function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name'),
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
        return 'Email_' . date('YmdHis');
    }
}
