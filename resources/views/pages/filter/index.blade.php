@extends('inc.master')

@section('title')
    {{__('filter.Report')}}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
@endpush

@section('content')
    <div class="middle-content container-xxl p-0">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="card-title">{{__('filter.Report')}}</h2>
                    </div>
                    <form id="filter-form" action="{{route('filter.index')}}" method="get">
                        <div class="row">
                            <div class="form-group col-3">
                                <label for="task_name">{{__('tasks.title')}}</label>
                                <input type="text" class="form-control" id="task_name"
                                       value="{{ old('filter[title]', request()->get('filter')['title'] ?? null) }}"
                                       name="filter[title]">
                            </div>

                            <div class="form-group col-3">
                                <label for="task_name">{{__('tasks.status')}}</label>
                                <select class="form-control" id="status" name="filter[status.id]">
                                    <option value="">{{__('actions.select_one_of')}}</option>
                                    @foreach($statuses as $status)
                                        <option
                                            value="{{ $status->id }}"
                                            {{ old('filter[status.id]', request()->get('filter')['status.id'] ?? null) == $status->id ? 'selected' : '' }}>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-3">
                                <label for="task_name">{{__('filter.From')}}</label>
                                <input type="date" class="form-control" id="start_date"
                                       value="{{ old('filter[created_at_from]', request()->get('filter')['created_at_from'] ?? null) }}"
                                       name="filter[created_at_from]">
                            </div>

                            <div class="form-group col-3">
                                <label for="task_name">{{__('filter.To')}}</label>
                                <input type="date" class="form-control" id="end_date"
                                       value="{{ old('filter[created_at_to]', request()->get('filter')['created_at_to'] ?? null) }}"
                                       name="filter[created_at_to]">
                            </div>

                            <div class="form-group col-3">
                                <label for="task_name">{{__('tasks.phase')}}</label>
                                <select class="form-control" id="phase_id" name="filter[phase.id]">
                                    <option value="">{{__('actions.select_one_of')}}</option>
                                    @foreach($phases as $phase)
                                        <option
                                            value="{{ $phase->id }}"
                                            {{ old('filter[phase.id]', request()->get('filter')['phase.id'] ?? null) == $phase->id ? 'selected' : '' }}>
                                        {{ $phase->name }}
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-3">
                                <label for="task_name">{{__('tasks.reporter')}}</label>
                                <select class="form-control" id="reporter_id" name="filter[reporter.id]">
                                    <option value="">{{__('actions.select_one_of')}}</option>
                                    @foreach($reporters as $reporter)
                                        <option
                                            value="{{ $reporter->id }}"
                                            {{ old('filter[reporter.id]', request()->get('filter')['reporter.id'] ?? null) == $reporter->id ? 'selected' : '' }}>
                                        {{ $reporter->name }}
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-3">
                                <label for="task_name">{{__('tasks.assigned')}}</label>
                                <select class="form-control" id="assigned_employee" name="filter[assigned.id]">
                                    <option value="">{{__('actions.select_one_of')}}</option>
                                    @foreach($assigned_employees as $assigned_employee)
                                        <option
                                            value="{{ $assigned_employee->id }}"
                                            {{ old('filter[assigned.id]', request()->get('filter')['assigned.id'] ?? null) == $assigned_employee->id ? 'selected' : '' }}>
                                        {{ $assigned_employee->name }}
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-3">
                                <label for="task_name">{{__('tasks.client')}}</label>
                                <select class="form-control" id="client_id" name="filter[client.id]">
                                    <option value="">{{__('actions.select_one_of')}}</option>
                                    @foreach($clients as $client)
                                        <option
                                            value="{{ $client->id }}"
                                            {{ old('filter[client.id]', request()->get('filter')['client.id'] ?? null) == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }}
                                    @endforeach
                                </select>
                            </div>


                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <button id="filter-submit" type="submit"
                                    class="btn btn-outline-info">{{__('filter.Filter')}}</button>
                            <a href="{{ route('filter.index') }}" id="filter-reset"
                               class=" btn btn-outline-danger">{{__('filter.Reset')}}</a>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    {!! $dataTable->table(['class' => 'table table-striped dt-table-hover dataTable']) !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {{$dataTable->scripts()}}
    <script src="{{ asset('assetsAdmin') }}/src/plugins/src/filepond/filepond.min.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->

@endpush

