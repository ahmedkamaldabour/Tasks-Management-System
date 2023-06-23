<?php

namespace App\DataTables;

use App\Models\Phase;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use function __;
use function array_merge;
use function get_lang;

class ClientPhaseDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $phases = Phase::pluck('name')->toArray();
        $columns = [];
        foreach ($phases as $phase) {
            $columns[] = $phase;
        }
        $statuses = Status::get(['id', 'name']);
        $phases = Phase::orderBy('step')->get(['id', 'name']);
        $employees = User::where('role', 'employee')->get(['id', 'name']);
        $dataTable = new EloquentDataTable($query);
        $dataTable
            ->editColumn('id', function () {
                static $i = 1;
                return $i++;
            })
            ->editColumn('title', fn(Task $task) => view('pages.client-phase.datatable.link', compact('task')))
            ->editColumn('action', function (Task $task) use ($statuses, $phases, $employees) {
                return view('pages.client-phase.datatable.actions',
                    compact('task', 'statuses', 'phases', 'employees'));
            })
            ->setRowId('id')
            ->rawColumns(array_merge(['action'], $columns));
        $array = [
            '1' => 'outline-badge-info',
            '2' => 'outline-badge-warning',
            '3' => 'outline-badge-danger',
            '4' => 'outline-badge-primary   ',
            '5' => 'outline-badge-info',
            '6' => 'outline-badge-success',
        ];
        foreach ($columns as $columnName) {
            $dataTable->editColumn($columnName, function ($row) use ($columnName, $array) {
                if ($row->phase->name == $columnName) {
                    $index = $row->phase->id;
                    if ($row->phase->id > 6) {
                        $index = rand(1, 6);
                    }
                    return '<span data-id = '.$row->id.' . data-toggle="modal" data-target="#exampleModal"
                     class=" p-1 move-btn badge ' . $array[$index].'">' . $row->status->name . '</span>';
                }
                return '';
            });
        }
        return $dataTable;
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Task $model): QueryBuilder
    {
        return $model->newQuery()->with('client:id,name,phone', 'phase:id,name', 'status:id,name')
            ->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('client-phase-table')
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
                    [0, 'asc']
                ],
                'language' => get_lang(),
            ]);
    }


    public function getColumns(): array
    {
        $phases = Phase::get();
        $phaseColumnNames = $phases->pluck('name');
        $columns = [
            Column::make('id')->title('#'),
            Column::make('client.name')->title(__('tasks.client'))->orderable(false),
            Column::make('client.phone')->title(__('tasks.client_phone'))->orderable(false),
            Column::make('title')->title(__('tasks.title'))->orderable(false),
        ];
        foreach ($phaseColumnNames as $columnName) {
            $columns[] = Column::computed($columnName)
                ->title($columnName)
                ->data($columnName)
                ->orderable(false)
                ->searchable(false)
                ->printable(false)
                ->render('function () {
                console.log(data);
                    return `${data}`;
                }');
        }
        $columns[] = Column::make('action')->title(__('shared.actions'))->orderable(false)->searchable(false)->printable(false)->exportable(false);
        return $columns;
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ClientPhase_' . date('YmdHis');
    }


}
