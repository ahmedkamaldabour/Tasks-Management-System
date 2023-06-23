@extends('inc.master')

@section('title')
    {{__('users.edit_user')}}
@endsection

@section('content')
    <div class="middle-content container-xxl p-0">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="card-title">{{__('users.edit_user')}}</h2>
                    </div>
                    <form method="post" action="{{route('admin.update',$user)}}">
                        @method('PUT')
                        @include('pages.admin.inc._form')
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection




