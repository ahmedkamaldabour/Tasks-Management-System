<?php

namespace App\DataTables;

use App\Models\Status;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;
use function __;
use function compact;
use function view;

class StatusDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('id', function () {
                static $i = 1;
                return $i++;

            })
            ->editColumn('name', fn($raw) => $raw->name)
            ->addColumn('action', fn(Status $status) => view('pages.status.datatable.actions', compact('status')))
            ->rawColumns([
                'name',
                'action'
            ]);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Status $model): QueryBuilder
    {
        return $model->newQuery()->withCount('tasks');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('status-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt')
            ->selectStyleSingle()
            ->parameters([
                'scrollX' => true,
                'responsive' => true,
                'autoWidth' => false,
                'lengthMenu' => [[10, 25, 50, -1], [10, 25, 50, __('shared.all')]],
                'buttons' => [],
                'order' => [
                    [0, 'asc']
                ],
                'language' =>get_lang(),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            ['data' => 'id', 'name' => 'id', 'title' => '#'],
            ['data' => 'name', 'name' => 'name', 'title' => __('actions.name')],
            ['data' => 'tasks_count', 'name' => 'tasks_count', 'title' => __('actions.tasks_count')],
            ['data' => 'action', 'name' => 'action', 'title' => __('shared.actions'), 'orderable' => false,
                'exportable' => false, 'printable' => false , 'searchable' => false],
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Status_' . date('YmdHis');
    }
}
