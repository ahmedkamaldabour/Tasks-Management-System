<?php

namespace App\Http\Controllers;

use App\DataTables\SingleTaskHistoryDataTable;
use App\DataTables\TaskDataTable;
use App\DataTables\UserTasksDataTable;
use App\Http\Requests\task\StoreTaskRequest;
use App\Http\Requests\task\UpdateTaskRequest;
use App\Http\Services\LocalizationService;
use App\Http\Traits\TaskTrait;
use App\Models\Client;
use App\Models\Phase;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Str;
use function array_merge;
use function compact;
use function request;
use function toast;

class TaskController extends Controller
{
    use TaskTrait;

    private $taskModel;
    private $userModel;
    private $phaseModel;
    private $statusModel;
    private $clientModel;


    public function __construct(Task   $taskModel, User $userModel,
                                Phase  $phaseModel, Status $statusModel,
                                Client $clientModel)
    {
        $this->middleware('inject_userId')->only(['store', 'update']);
        $this->taskModel = $taskModel;
        $this->userModel = $userModel;
        $this->phaseModel = $phaseModel;
        $this->statusModel = $statusModel;
        $this->clientModel = $clientModel;
    }

    public function index(TaskDataTable $dataTable)
    {
        return $dataTable->render('pages.tasks.index');
    }
    public function create()
    {
        return view('pages.tasks.create', $this->dataNeededForTask());
    }
    public function show(Task $task, SingleTaskHistoryDataTable $dataTable)
    {
        $task->load('taskHistory');
        $statuses = $this->statusModel->get(['id', 'name']);
        $phases = $this->phaseModel->orderBy('step')->get(['id', 'name']);
        $employees = $this->userModel->where('role', 'employee')->get(['id', 'name']);
        return $dataTable->with('id', $task->id)
            ->render('pages.tasks.show', compact('task', 'statuses', 'phases', 'employees'));
    }
    public function store(StoreTaskRequest $request)
    {
        $client = $this->getClient($request);
        $localization_data = LocalizationService::getLocalizationDataAsArray(Task::$translatableData, $request);
        $this->taskModel::create(array_merge($localization_data,
            $request->validated() + ['uuid' => (string)Str::uuid()] +
            ['reporter_id' => $request->user_id] + ['client_id' => $client->id ?? $request->client_id]
        ));
        toast(__('alert.add_success', ['item' => 'Task']), 'success');
        return redirect()->route('task.index');
    }
    public function edit(Task $task)
    {
        return view('pages.tasks.edit', $this->dataNeededForTask($task));
    }
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $client = $this->getClient($request);
        Task::$originalAttributes = $task->getAttributes();
        $localization_data = LocalizationService::getLocalizationDataAsArray(Task::$translatableData, $request);
        $task->update(array_merge($localization_data,
            $request->validated() + ['reporter_id' => $request->user_id] + ['client_id' => $client->id ?? $request->client_id]
        ));
        toast(__('alert.update_success', ['item' => 'Task']), 'success');
        return redirect()->route('task.index');
    }
    public function destroy(Task $task)
    {
        $task->delete();
        toast(__('alert.delete_success', ['item' => 'Task']), 'success');
        return redirect()->route('task.index');
    }
    public function getEmployeeTasks(UserTasksDataTable $dataTable, User $user)
    {
        return $dataTable->with('id', $user->id)->render('pages.tasks.employeeTasks', compact('user'));
    }
    public function changeStatusPhaseAndEmployeeOfTask(Task $task)
    {
        $this->validate(request(), [
            'status_id' => 'required|exists:statuses,id',
            'phase_id' => 'required|exists:phases,id',
            'assigned_id' => 'required|exists:users,id'
        ]);
        Task::$originalAttributes = $task->getAttributes();
        $task->update([
            'status_id' => request()->status_id,
            'phase_id' => request()->phase_id,
            'assigned_id' => request()->assigned_id
        ]);
        return response()->json(['message' => 'Task updated successfully']);
    }
    public function getPhaseStatusAndEmployeeOfTask(Task $task)
    {
        return response()->json([
            'phase_id' => $task->phase_id,
            'status_id' => $task->status_id,
            'assigned_id' => $task->assigned_id
        ]);
    }



}
