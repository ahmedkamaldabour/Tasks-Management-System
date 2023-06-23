<?php

namespace App\Http\Controllers;

use App\DataTables\FilterDataTable;
use App\Models\Client;
use App\Models\Phase;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use function compact;

class FilterController extends Controller
{

    public function index(FilterDataTable $dataTable)
    {
        $filters = $this->filterData();
        $phases = Phase::get(['id', 'name']);
        $statuses = Status::get(['id', 'name']);
        $reporters = User::where('role', 'admin')->orderBy('name', 'asc')->get(['id', 'name']);
        $assigned_employees = User::where('role', 'employee')->orderBy('name', 'asc')->get(['id', 'name']);
        $clients = Client::orderBy('name', 'asc')->get(['id', 'name']);
        return $dataTable->with('filters', $filters)->render('pages.filter.index', compact('phases', 'statuses',
            'reporters', 'assigned_employees', 'clients'));
    }

    private function filterData()
    {
        return QueryBuilder::for(Task::class)
            ->allowedFilters([
                'id',
                'title',
                'status.id',
                'phase.id',
                'reporter.id',
                'assigned.id',
                'client.id',
                AllowedFilter::callback('created_at_from', function ($query, $value) {
                    $query->whereDate('created_at', '>=', $value);
                }),
                AllowedFilter::callback('created_at_to', function ($query, $value) {
                    $query->whereDate('created_at', '<=', $value);
                }),
            ])
            ->get();
    }


}
