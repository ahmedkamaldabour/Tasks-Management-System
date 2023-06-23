<div class="text-center">
    <button type="button" class="btn btn-secondary move-btn mr-2" data-toggle="modal" data-target="#exampleModal"
            data-id="{{ $task->id }}">
        {{ __('shared.move') }}
    </button>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card" @if(app()->getLocale() == 'ar') style="text-align: right" @endif>
                    <div class="card-header">
                        <h2 class="card-title">{{ __('tasks.modify_status_phase') }}</h2>
                    </div>
                    <div class="card-body">
                        <form method="post" id="updateTaskForm" action="{{ route('task.updateStatusPhaseAndEmployee', $task) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="status">{{ __('tasks.status') }}</label>
                                <select name="status_id" id="status" class="form-control">
                                    @foreach($statuses as $status)
                                        <option
                                            value="{{ $status->id }}"
                                            {{$task->status_id == $status->id ? 'selected' : ''}}>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="phase">{{ __('tasks.phase') }}</label>
                                <select name="phase_id" id="phase" class="form-control">
                                    @foreach($phases as $phase)
                                        <option
                                            value="{{ $phase->id }}"
                                            {{$task->phase_id == $phase->id ? 'selected' : ''}}>
                                            {{ $phase->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="assigned">{{ __('tasks.assigned') }}</label>
                                <select name="assigned_id" id="assigned" class="form-control">
                                    @foreach($employees as $employee)
                                        <option
                                            value="{{ $employee->id }}"
                                            {{$task->assigned_id == $employee->id ? 'selected' : ''}}>
                                            {{ $employee->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> {{__('shared.close')}}
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.move-btn').click(function () {
            var actionUrl;
            let phaseId;
            let statusId;
            const taskId = $(this).data('id');
            console.log(taskId);
            $('#updateTaskForm').attr('data-id', taskId);
            actionUrl = '{{ route("task.updateStatusPhaseAndEmployee", ":taskId") }}';
            actionUrl = actionUrl.replace(':taskId', taskId);
            $('#updateTaskForm').attr('action', actionUrl);
            //pass the task id to the modal form select options to be used in the ajax request
            $('#status').attr('data-task-id', taskId);
            $('#phase').attr('data-task-id', taskId);
            $('#assigned').attr('data-task-id', taskId);
            $url = '{{ route('task.getPhaseStatusAndEmployeeOfTask', ':taskId') }}';
            //get the current phase and status of the task
            $.ajax({
                url: $url.replace(':taskId', taskId),
                type: 'GET',
                data: {
                    taskId: taskId
                },
                success: function (data) {
                    phaseId = data.phase_id;
                    statusId = data.status_id;
                    assignedId = data.assigned_id;
                    $('#status').val(statusId);
                    $('#phase').val(phaseId);
                    $('#assigned').val(assignedId);
                }
            });
        });
        $('#status, #phase, #assigned').change(function () {
            var formData = $('#updateTaskForm').serialize();
            $.ajax({
                url: $('#updateTaskForm').attr('action'),
                type: 'PUT',
                data: formData,
            });
        });
        $('.modal-footer button[data-dismiss="modal"]').click(function () {
            reloadDataTable();
        });
        $('.modal').on('click', function (e) {
            if (e.target === this) {
                reloadDataTable();
            }
        });
        function reloadDataTable() {
            $('.table-striped').DataTable().ajax.reload();
        }
    });
</script>

