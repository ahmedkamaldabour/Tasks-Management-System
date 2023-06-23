<?php

namespace App\Observers;

use App\Models\Task;
use App\Models\TaskHistory;
use Illuminate\Support\Facades\Auth;
use function array_diff_assoc;

class StoreTaskHistoryObserver
{

    public function updated(Task $task): void
    {
        $originalAttributes = Task::$originalAttributes;
        $updatedAttributes = $task->getAttributes();
        $changedAttributes = array_diff_assoc($updatedAttributes, $originalAttributes);
        if (!empty($changedAttributes)) {
            foreach ($changedAttributes as $key => $value) {
                if ($key == 'updated_at') {
                    continue;
                }
                TaskHistory::create([
                    'task_id' => $task->id,
                    'changed_column' => $key,
                    'old_value' => $originalAttributes[$key] ?? 'no value',
                    'new_value' => $value,
                    'user_id' => auth()->id(),
                ]);
            }
        }
    }

}
