<?php

namespace Messi\Base\DataTables;

use Illuminate\Database\Query\Builder;
use Messi\Base\Models\Setting;
use Messi\Base\Supports\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class SettingDataTable extends DataTableAbstract
{
    protected $tableId = 'settings-table';
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
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param Setting $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Setting $model)
    {
        $query = $model
            ->newQuery()
            ->select(['id', 'key', 'value']);
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
                Button::make('create')
                    ->text(__('Update'))
                    ->addClass('m-btn m-btn--gradient-from-accent m-btn--gradient-to-accent')
                    ->action("window.location = '".route('admin.settings.edit')."';")
            );
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
            Column::make('key'),
            Column::make('value')->searchable(false)->orderable(false)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Setting_' . date('YmdHis');
    }
}
