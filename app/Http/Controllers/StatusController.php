<?php

namespace App\Http\Controllers;

use App\DataTables\StatusDataTable;
use App\Http\Requests\status\StatusRequest;
use App\Http\Traits\StatusTrait;
use App\Models\Status;

class StatusController extends Controller
{
    use StatusTrait;
    private $statusModel;
    public function __construct(Status $statusModel)
    {
        $this->statusModel = $statusModel;
    }
    public function index(StatusDataTable $dataTable)
    {
        return $dataTable->render('pages.status.index');
    }
    public function create()
    {
        return view('pages.status.create');
    }
    public function store(StatusRequest $request)
    {
        $this->fillData($request, $this->statusModel);
        toast(__('alert.add_success', ['item' => 'Status']), 'success');
        return redirect()->route('status.index');
    }
    public function edit(Status $status)
    {
        return view('pages.status.edit', compact('status'));
    }
    public function update(StatusRequest $request, Status $status)
    {
        $this->fillData($request, $status);
        toast(__('alert.update_success', ['item' => 'Status']), 'success');
        return redirect()->route('status.index');
    }


}
