@extends('inc.master')

@section('title')
    {{__('tasks.edit_task')}}
@endsection

@push('css')
    <link href="{{asset('AdminAssets')}}/plugins/flatpickr/flatpickr.css" rel="stylesheet" type="text/css">
    <link href="{{asset('AdminAssets')}}/plugins/noUiSlider/nouislider.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('AdminAssets')}}/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('AdminAssets')}}/plugins/flatpickr/custom-flatpickr.css" rel="stylesheet" type="text/css">
    <link href="{{asset('AdminAssets')}}/plugins/noUiSlider/custom-nouiSlider.css" rel="stylesheet" type="text/css">
    <link href="{{asset('AdminAssets')}}/plugins/bootstrap-range-Slider/bootstrap-slider.css" rel="stylesheet" type="text/css">
@endpush


@section('content')
    <div class="middle-content container-xxl p-0">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="card-title">{{__('tasks.edit_task')}}</h2>
                    </div>
                    <form method="post" action="{{route('task.update', $task)}}">
                        @method('PUT')
                        @include('pages.tasks.inc._form')
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection


@push('js')
    <script src="{{asset('AdminAssets')}}/assets/js/scrollspyNav.js"></script>.
    <script src="{{asset('AdminAssets')}}/plugins/flatpickr/flatpickr.js"></script>
    <script src="{{asset('AdminAssets')}}/plugins/noUiSlider/nouislider.min.js"></script>

    <script src="{{asset('AdminAssets')}}/plugins/flatpickr/custom-flatpickr.js"></script>
    <script src="{{asset('AdminAssets')}}/plugins/noUiSlider/custom-nouiSlider.js"></script>
    <script src="{{asset('AdminAssets')}}/plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->

    <script>
        var f2 = flatpickr(document.getElementById('dateTimeFlatpickr'), {
            enableTime: false,
            dateFormat: "Y-m-d",
        });
    </script>
@endpush





