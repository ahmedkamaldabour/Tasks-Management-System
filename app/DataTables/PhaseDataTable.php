<?php

namespace App\DataTables;

use App\Models\Phase;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;
use function __;

class PhaseDataTable extends DataTable
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
            ->editColumn('name', fn($phase) => $phase->name)
            ->addColumn('action', fn($phase) => view('pages.phase.datatable.actions', compact('phase')))
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Phase $model): QueryBuilder
    {
        return $model->newQuery()->with('user')->withCount('tasks')->orderBy('step');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('phase-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt')
            ->orderBy(1)
            ->selectStyleSingle()
            ->parameters([
                'scrollX' => true,
                'responsive' => true,
                'autoWidth' => false,
                'lengthMenu' => [[10, 25, 50, -1], [10, 25, 50, __('shared.all')]],
                'buttons' => [],
                'order' => [
                    [1, 'asc']
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
            ['data' => 'step', 'name' => 'step', 'title' => __('actions.step')],
            ['data' => 'tasks_count', 'name' => 'tasks_count', 'title' => __('actions.tasks_count')],
            ['data' => 'action', 'name' => 'action', 'title' => __('shared.actions') ,
                'orderable' => false, 'searchable' => false, 'exportable' => false, 'printable' => false],
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Phase_' . date('YmdHis');
    }
}
