@extends('inc.master')

@section('title', 'Home')


@section('content')
    <div class="row layout-top-spacing">
        {{--        status--}}
        @foreach($status as $key => $value)
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                <div class="widget widget-five">
                    <div class="widget-content">
                        <div class="header">
                            <div class="header-body">
                                <h6>{{$key}}</h6>
                            </div>
                        </div>
                        <div class="w-content">
                            <div class="">
                                <p class="task-left">{{$value}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{--    end staus--}}
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="widget-four">
                <div class="widget-heading">
                    <h5 class="@if(app()->getLocale() === 'ar') text-right @endif">{{__('actions.doing')}} </h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-4 @if(app()->getLocale() === 'ar') rtl @endif">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('tasks.title')}}
                            <th> {{__('tasks.assigned')}} </th>
                            <th> {{__('tasks.phase')}} </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasksDoing as $task)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$task->title}}</td>
                                <td>{{$task->assigned->name}}</td>
                                <td>{{$task->phase->name}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="widget-four">
                <div class="widget-heading">
                    <h5 class="@if(app()->getLocale() === 'ar') text-right @endif">{{__('actions.todo')}} </h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-4">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('tasks.title')}}
                            <th> {{__('tasks.assigned')}} </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasksToDo as $task)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$task->title}}</td>
                                <td>{{$task->assigned->name}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection


@push('js')
    @if(app()->getLocale() === 'ar')
        <script>
            const tables_dir = document.querySelectorAll('table');
            for (let i = 0; i < tables_dir.length; i++) {
                tables_dir[i].style.textAlign = 'right'
            }
        </script>
    @endif
@endpush

