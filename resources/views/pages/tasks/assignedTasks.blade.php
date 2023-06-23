@extends('inc.master')

@section('title')
    {{__('tasks-history.tasks_history')}}
@endsection


@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    {{--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">--}}
@endpush

@section('content')
    <div class="middle-content container-xxl p-0">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="card-title">{{__('tasks-history.tasks_history')}}</h2>
                    </div>
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
