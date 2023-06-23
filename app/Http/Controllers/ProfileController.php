<?php

namespace App\Http\Controllers;

use App\Http\Requests\profile\ProfileRequest;
use Illuminate\Support\Facades\Hash;
use function toast;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.profile.index');
    }
    public function changePassword(ProfileRequest $request)
    {
        $user = auth()->user();
        if (! Hash::check($request->current_password, $user->password)) {
            toast(__('alert.password_not_match'), 'error');
            return redirect()->back();
        }
        $user->password = bcrypt($request->password);
        $user->save();
        toast(__('alert.password_updated'), 'success');
        return redirect()->back();
    }
}
