@extends('inc.master')

@section('title')
    {{__('profile.my_profile')}}
@endsection



@section('content')
    <div class="middle-content container-xxl p-0">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="card-title">{{__('profile.my_profile')}}</h2>
                    </div>
                    <div class="card-body">
                        <div class="row text-center" style="margin-top: 20px;">
                            <div class="col-lg-12 col-md-12">
                                <div class="user-profile layout-spacing">
                                    <div class="widget-content widget-content-area">
                                        <div class="user-info-list">
                                            <div class="">
                                                <ul class="contacts-block list-unstyled">
                                                    <li class="contacts-block__item">
                                                        <span
                                                            class="contacts-block__description">{{__('profile.profile_name')}}</span>
                                                        <a href="javascript:void(0);"
                                                           class="contacts-block__link">{{auth()->user()->name}}</a>
                                                    </li>
                                                    <li class="contacts-block__item">
                                                        <span
                                                            class="contacts-block__description">{{__('profile.profile_email')}}</span>
                                                        <a href="javascript:void(0);"
                                                           class="contacts-block__link">{{auth()->user()->email}}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form method="post" action="{{route('profile.change-password')}}">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-8 p-1 mb-4 mx-auto">
                                <label for="current_password">{{__('profile.current_password')}}</label>
                                <input type="password" class="form-control" id="current_password"
                                       name="current_password">
                                @error('current_password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-8 p-1 mb-4 mx-auto">
                                <label for="password">{{__('profile.new_password')}}</label>
                                <input type="password" class="form-control" id="password" name="password">
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-8 p-1 mb-4 mx-auto">
                                <label
                                    for="confirm_password">{{__('profile.confirm_password')}}</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                       name="password_confirmation">
                                @error('password_confirmation')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-8 p-1 mb-4 mx-auto">
                                <button class="btn btn-primary submit-fn mt-2"
                                        type="submit">{{__('shared.save')}}</button>
                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection




