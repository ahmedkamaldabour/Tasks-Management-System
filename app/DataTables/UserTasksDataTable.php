<?php

namespace App\DataTables;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;
use function __;
use function app;
use function substr;

class UserTasksDataTable extends DataTable
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
            ->editColumn('description', fn($row) => substr($row->description . '...', 0, 50))
            ->editColumn('payment_status', function ($row) {
                if (app()->getLocale() === 'ar') {
                    return $row->payment_status === 'paid' ? 'مدفوع' : 'غير مدفوع';
                }
                return $row->payment_status;
            })
            ->editColumn('status.name', fn($row) => $row->status->name)
            ->editColumn('phase.name', fn($row) => $row->phase->name)
            ->editColumn('reporter.name', fn($row) => $row->reporter->name)
            ->editColumn('assigned.name', fn($row) => $row->assigned->name)
            ->editColumn('client.name', fn($row) => $row->client->name)
            ->setRowId('id')
            ->rawColumns([
                'status.name',
                'phase.name',
                'reporter.name',
                'assigned.name',
            ]);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Task $model)
    {
        return $model->newQuery()->with(['status:id,name', 'phase:id,name',
            'reporter:id,name', 'assigned:id,name', 'client:id,name'])->where('assigned_id', $this->id );
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('Tasks-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
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
                    ['extend' => 'excel', 'className' => 'btn btn-primary',
                        'text' => '<i class="fa fa-file"></i>' . __('shared.export')]

                ],
                'order' => [
                    [0, 'desc']
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
            ['data' => 'id', 'name' => 'id', 'title' => __('shared.id')],
            ['data' => 'title', 'name' => 'title', 'title' => __('tasks.title')],
            ['data' => 'description', 'name' => 'description', 'title' => __('tasks.description')],
            ['data' => 'link', 'name' => 'link', 'title' => __('tasks.link'), 'orderable' => false, 'searchable' => false],
            ['data' => 'delivery_date', 'name' => 'delivery_date', 'title' => __('tasks.delivery_date')],
            ['data' => 'payment_status', 'name' => 'payment_status', 'title' => __('tasks.payment_status')],
            ['data' => 'status.name', 'name' => 'status.name', 'title' => __('tasks.status')],
            ['data' => 'phase.name', 'name' => 'phase.name', 'title' => __('tasks.phase')],
            ['data' => 'reporter.name', 'name' => 'reporter.name', 'title' => __('tasks.reporter')],
            ['data' => 'assigned.name', 'name' => 'assigned.name', 'title' => __('tasks.assigned')],
            ['data' => 'client.name', 'name' => 'client.name', 'title' => __('tasks.client')],
        ];

    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Tasks_' . date('YmdHis');
    }
}
