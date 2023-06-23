<?php

namespace App\DataTables;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;
use function __;
use function get_lang;

class FilterDataTable extends DataTable
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
            ->editColumn('title', fn($row) => $row->title)
            ->editColumn('status.name', fn($row) => $row->status->name)
            ->editColumn('phase.name', fn($row) => $row->phase->name)
            ->editColumn('reporter.name', fn($row) => $row->reporter->name)
            ->editColumn('assigned.name', fn($row) => $row->assigned->name)
            ->editColumn('created_at', fn($row) => $row->created_at->format('Y-m-d'))
            ->editColumn('updated_at', fn($row) => $row->updated_at->format('Y-m-d'))
            ->setRowId('id')
            ->rawColumns([
                'title',
                'status.name',
                'phase.name',
                'reporter.name',
                'assigned.name',
                'created_at',
                'updated_at'
            ]);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Task $model): QueryBuilder
    {
        return $model->newQuery()->with(['status:id,name', 'phase:id,name',
                'reporter:id,name', 'assigned:id,name', 'client:id,name,phone']
        )->whereIn('id', $this->filters->pluck('id'));
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('filter-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfltip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->parameters([
                'scrollX' => true,
                'responsive' => true,
                'autoWidth' => false,
                'lengthMenu' => [
                    [10, 25, 50, 100, 500, -1],
                    [10, 25, 50, 100, 500, __('shared.all')]
                ],
                'buttons' => [
                    ['extend' => 'excel', 'className' => 'btn btn-sm btn-outline-success',
                        'text' => '<i class="fa fa-file"></i>' . __('shared.export')]

                ],
                'order' => [
                    [0, 'desc']
                ],
                'language' => get_lang(),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            ['data' => 'id', 'name' => 'id', 'title' => '#'],
            ['data' => 'title', 'name' => 'title', 'title' => __('tasks.title')],
            ['data' => 'status.name', 'name' => 'status.name', 'title' => __('tasks.status') ,'orderable' => false],
            ['data' => 'phase.name', 'name' => 'phase.name', 'title' => __('tasks.phase'),'orderable' => false],
            ['data' => 'reporter.name', 'name' => 'reporter.name', 'title' => __('tasks.reporter'),'orderable' => false],
            ['data' => 'assigned.name', 'name' => 'assigned.name', 'title' => __('tasks.assigned'),'orderable' => false],
            ['data' => 'client.name', 'name' => 'client.name', 'title' => __('tasks.client'),'orderable' => false],
            ['data' => 'client.phone', 'name' => 'client.phone', 'title' => __('tasks.client_phone'),'orderable' => false],
            ['data' => 'delivery_date', 'name' => 'delivery_date', 'title' => __('tasks.delivery_date'),'orderable' => false],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => __('shared.created_at'),'orderable' => false],
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Filter_' . date('YmdHis');
    }
}
