<?php


namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Spatie\Translatable\HasTranslations;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;
use function __;
use function compact;
use function view;

class UserDataTable extends DataTable
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
            ->editColumn('name', fn($row) => $row->name)
            ->editColumn('role', function ($row) {
                if (app()->getLocale() == 'ar') {
                    if ($row->role == 'admin') {
                        return 'مشرف | مدير';
                    }
                    return 'موظف';
                }
                return $row->role;
            })
            ->addColumn('action', fn(User $admin) => view('pages.admin.datatable.actions', compact('admin')))
            ->rawColumns([
                'name',
                'action'
            ]);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('role', 'asc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('user-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfltip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->parameters([
                'scrollX' => true,
                'responsive' => true,
                'autoWidth' => false,
                'lengthMenu' => [[10, 25, 50, -1], [10, 25, 50, __('shared.all')]],
                'buttons' => [
                    ['extend' => 'excel', 'className' => 'btn btn-primary',
                        'text' => '<i class="fa fa-file"></i>' . __('shared.export')]

                ],
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
            ['data' => 'email', 'name' => 'email', 'title' => __('users.email')],
            ['data' => 'role', 'name' => 'role', 'title' => __('users.role')],
            ['data' => 'action', 'name' => 'action', 'title' => __('shared.actions'), 'orderable' => false,
                'searchable' => false, 'exportable' => false, 'printable' => false],
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}
