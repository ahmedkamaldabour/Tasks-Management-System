@extends('inc.master')

@section('title', __('tasks.show_task'))

@push('css')
    <!-- Include Cork Dashboard CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assetsAdmin/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assetsAdmin/css/responsive.dataTables.min.css') }}">
@endpush

@section('content')
    <div class="container pt-5">
        <div class="row" >
            <div class="col-lg-6"  >
                <div class="card h-100" @if(app()->getLocale() == 'ar') style="text-align: right" @endif >
                    <div class="card-header">
                        <h2 class="card-title">{{ __('tasks.show_task') }}</h2>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><strong> {{__('tasks.title')}} : </strong>
                            {{$task->title }}</h5>
                        <p class="card-text"><strong> {{__('tasks.description')}} : </strong>
                            {{$task->description }}</p>
                        <p class="card-text">
                            <strong>{{__('tasks.link')}}: </strong>
                            <a href="{{ $task->link }}" target="_blank" style="color: blue; text-decoration: yellow;">{{$task->link}}</a>
                        </p>
                        <p class="card-text"><strong> {{__('tasks.reporter')}} : </strong>
                            {{$task->reporter->name }}</p>
                        <p class="card-text"><strong> {{__('tasks.assigned')}} : </strong>
                            {{$task->assigned->name }}</p>
                        <p class="card-text"><strong> {{__('tasks.client')}} : </strong>
                            {{$task->client->name }}</p>
                        <p class="card-text"><strong> {{__('tasks.delivery_date')}} : </strong>
                            {{$task->delivery_date }}</p>
                        <p class="card-text"><strong> {{__('shared.created_at')}} : </strong>
                            {{$task->created_at->format('Y-m-d') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card h-100" @if(app()->getLocale() == 'ar') style="text-align: right" @endif>
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
                                            value="{{ $status->id }}" {{ old('status_id', isset($task) ? $task->status_id : '') == $status->id ? 'selected' : '' }}>
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
                                            value="{{ $phase->id }}" {{ old('phase_id', isset($task) ? $task->phase_id : '') == $phase->id ? 'selected' : '' }}>
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
                                            value="{{ $employee->id }}" {{ old('assigned_id', isset($task) ? $task->assigned_id : '') == $employee->id ? 'selected' : '' }}>
                                            {{ $employee->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title"
                            @if(app()->getLocale() == 'ar') style="text-align: right" @endif >
                            {{ __('tasks-history.task_history') }}</h2>
                    </div>
                    <div class="card-body">
                        {!! $dataTable->table(['class' => 'table table-striped dt-table-hover dataTable']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- Include DataTables JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {{$dataTable->scripts()}}
    <script src="{{ asset('assetsAdmin') }}/src/plugins/src/filepond/filepond.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#status, #phase, #assigned').change(function () {
                var formData = $('#updateTaskForm').serialize();
                $.ajax({
                    url: $('#updateTaskForm').attr('action'),
                    type: 'PUT',
                    data: formData,
                    success: function (response) {
                        $('.table-striped').DataTable().ajax.reload();
                    }
                });
            });
        });
    </script>

@endpush

