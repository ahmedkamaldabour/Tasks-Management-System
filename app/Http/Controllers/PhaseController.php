<?php

namespace App\Http\Controllers;

use App\DataTables\PhaseDataTable;
use App\Http\Requests\phase\PhaseRequest;
use App\Http\Traits\PhaseTrait;
use App\Models\Phase;
use App\Models\User;
use function toast;

class PhaseController extends Controller
{
    use PhaseTrait;

    private $phaseModel;
    private $userModel;

    public function __construct(Phase $phaseModel, User $userModel)
    {
        $this->phaseModel = $phaseModel;
        $this->userModel = $userModel;
    }

    public function index(PhaseDataTable $dataTable)
    {
        return $dataTable->render('pages.phase.index');
    }

    public function create()
    {
        $users = $this->userModel->get(['id', 'name']);
        return view('pages.phase.create', compact('users'));
    }

    public function store(PhaseRequest $request)
    {
        $this->fillData($request, $this->phaseModel);
        toast(__('alert.add_success', ['item' => 'Phase']), 'success');
        return redirect()->route('phase.index');
    }

    public function edit(Phase $phase)
    {
        return view('pages.phase.edit', compact('phase'));
    }

    public function update(PhaseRequest $request, Phase $phase)
    {
        $this->fillData($request, $phase);
        toast(__('alert.update_success', ['item' => 'Phase']), 'success');
        return redirect()->route('phase.index');
    }

}
