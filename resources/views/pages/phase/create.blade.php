@extends('inc.master')

@section('title')
    {{__('phases.create_phase')}}
@endsection



@section('content')
    <div class="middle-content container-xxl p-0">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="card-title">{{__('phases.add_new_phase')}}</h2>
                    </div>
                    <form method="post" action="{{route('phase.store')}}">
                        @include('pages.phase.inc._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection




