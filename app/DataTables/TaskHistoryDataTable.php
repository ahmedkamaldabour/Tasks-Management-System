<?php

namespace App\DataTables;


use App\Models\TaskHistory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;
use function __;

class TaskHistoryDataTable extends DataTable
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
            ->editColumn('task.title', fn($row) => $row->task->title)
            ->editColumn('user.name', fn($row) => $row->user->name)
            ->editColumn('changed_column', fn($row) => change_column_lang($row))
            ->editColumn('old_value', fn($row) => task_history_values($row, $row->old_value))
            ->editColumn('new_value', fn($row) => task_history_values($row, $row->new_value, 1))
            ->editColumn('updated_at', fn($row) => $row->updated_at->diffForHumans())
            ->setRowId('id')
            ->rawColumns([
                'task.title',
                'user.name',
                'changed_column',
                'old_value',
                'new_value',
            ]);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(TaskHistory $model): QueryBuilder
    {
        return $model->newQuery()->with(['task:id,title', 'user:id,name', 'phase_old_value:id,name',
            'phase_new_value:id,name', 'status_old_value:id,name', 'status_new_value:id,name',
            'client_old_value:id,name', 'client_new_value:id,name', 'assigned_old_value:id,name',
            'assigned_new_value:id,name'])->employee();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('task-history-table')
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
                    ['extend' => 'excel', 'className' => 'btn btn-primary',
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
            ['data' => 'id', 'name' => 'id', 'title' => __('shared.id')],
            ['data' => 'task.title', 'name' => 'task.title', 'title' => __('tasks-history.task')],
            ['data' => 'user.name', 'name' => 'user.name', 'title' => __('tasks-history.user')],
            ['data' => 'changed_column', 'name' => 'changed_column', 'title' => __('tasks-history.changed_in')],
            ['data' => 'old_value', 'name' => 'old_value', 'title' => __('tasks-history.old_value')],
            ['data' => 'new_value', 'name' => 'new_value', 'title' => __('tasks-history.new_value')],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => __('tasks-history.updated_at')],
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'TaskHistory_' . date('YmdHis');
    }
}
