<?php

namespace Messi\Base\Supports;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use Yajra\DataTables\Services\DataTable;

abstract class DataTableAbstract extends DataTable
{
    /** @var array  */
    protected array $actions = ['print', 'csv', 'excel'];

    /** @var string */
    protected $tableId;

    /**
     * @param array $args
     * @return string
     */
    protected function setActionColumn( array $args = []) : string
    {
        $tableId = $this->tableId;
        return view('core/base::datatable.action', compact('args', 'tableId'))->render();
    }

    /**
     * @param $params
     * @return string
     */
    protected function filterFooter($params) : string
    {
        $elements = [];
        foreach ($params as $key => $param) {
            $index = Arr::get($param, 'index');
            if (!$index) continue ;
            $type = Arr::get($param, 'type', 'input');
            $placeholder = Arr::get($param, 'placeholder');
            $data = Arr::get($param, 'data');
            $element = view("core/base::datatable.$type", compact('data', 'placeholder'))->render();
            $elements[$index] = $element;
        }
        $elementStr = json_encode($elements);

        return "function (settings, json) {
                this.api().columns().every(function (index) {
                    var column = this;
                   var elementStr = JSON.stringify($elementStr);
                   var elementObj = JSON.parse(elementStr);
                   var el = elementObj[index]

                    if(el) {
                        $(el).appendTo($(column.footer()).empty())
                        .on('change', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                    }
                });
            }";
    }

    /**
     * @param array $columns
     * @return array
     */
    protected function getFilters(array $columns = []) : array
    {
        $requests = $this->request()->get('columns');
        $filters = [];
        foreach ($columns as $column) {
            $item = Arr::first($requests, function ($request) use ($column) {
                return Arr::get($request, 'data') == $column && Arr::get($request, 'search.value') != '';
            });
            if ( !empty($item) ) {
                $filters[$column] = $item['search']['value'];
            }
        }

        return $filters;
    }

    /**
     * @param Builder $query
     * @param string $column
     * @param $value
     * @return mixed
     */
    protected function filterWhere($query, $column, $value)
    {
        if (empty($column) || empty($value)) {
            return $query;
        }

        return $query->where($column, $value);
    }

    /**
     * @return \Yajra\DataTables\Html\Builder
     */
    public function builder(): \Yajra\DataTables\Html\Builder
    {
        return parent::builder()
            ->minifiedAjax()
            ->setTableAttribute(
                ['class' => 'table table-striped- table-bordered table-hover table-checkable']
            )
            ->searchDelay(1500)
            ->processing(false)
            ->dom('Bfrtip')
            ->orderBy(0, 'desc');
    }
}
