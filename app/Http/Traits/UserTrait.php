<?php

namespace App\Http\Traits;

use App\Http\Services\LocalizationService;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use function array_merge;
use function auth;
use function redirect;
use function toast;

trait UserTrait
{
    private function fillData($request, $user)
    {
        $localization_data = LocalizationService::getLocalizationDataAsArray(User::$translatableData, $request);
        $data = array_merge($localization_data, [
            'email' => $request->email,
            'password' => $request->password ?? $user->password,
            'role' => $request->role,
        ]);
        $this->userModel->updateOrCreate(['id' => $user->id], $data);
        toast(__('alert.update_success', ['item' => 'User']), 'success');
        return redirect()->route('phase.index');
    }
    private function handelDeleteUser($user)
    {
        if ($user->tasks()->count() > 0) {
            toast(__('alert.user_have_tasks'), 'error');
            return redirect()->route('admin.index');
        }
        DB::transaction(function () use ($user) {
            $taskHistory = $user->taskHistory()
                ->where('user_id', $user->id)
                ->orWhere('old_value', $user->id)
                ->orWhere('new_value', $user->id)
                ->get();
            foreach ($taskHistory as $history) {
                $history->update([
                    'old_value' => auth()->user()->id,
                    'new_value' => auth()->user()->id,
                    'user_id' => auth()->user()->id,
                ]);
            }
            $user->delete();
        });
        toast(__('alert.delete_success', ['item' => 'User']), 'success');
        return true;
    }
}
