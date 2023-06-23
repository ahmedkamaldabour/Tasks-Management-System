<?php

namespace App\Http\Traits;

use App\Models\Task;
use function auth;

trait HomeTrait
{
    private function taskStatusStatistics()
    {
        return Task::employee()->selectRaw('status_id, count(*) as count')->with('status:id,name')
            ->groupBy('status_id')->get()->pluck('count', 'status.name')->toArray();
    }

    private function tasksToDo()
    {
        return Task::employee()->with('assigned:id,name')->where('status_id', 1)->get();
    }

    private function tasksToDoing()
    {
        return Task::employee()->with('assigned:id,name')->where('status_id', 2)
            ->with('phase:id,name')
            ->get();
    }

}
