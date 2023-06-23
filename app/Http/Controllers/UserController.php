<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Traits\UserTrait;
use App\Models\User;

class UserController extends Controller
{
    use UserTrait;

    private $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.index');
    }

    public function create()
    {
        return view('pages.admin.create');
    }

    public function store(StoreUserRequest $request)
    {
        $this->fillData($request, $this->userModel);
        toast(__('alert.add_success', ['item' => 'New User']), 'success');
        return redirect()->route('admin.index');
    }

    public function edit(User $user)
    {
        return view('pages.admin.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->fillData($request, $user);
        toast(__('alert.update_success', ['item' => 'User']), 'success');
        return redirect()->route('admin.index');
    }

    public function destroy(User $user)
    {
        $this->handelDeleteUser($user);
        return redirect()->route('admin.index');
    }

}
