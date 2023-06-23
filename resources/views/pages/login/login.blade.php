<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Login Page</title>
    <link rel="icon" type="image/x-icon" href="{{asset('AdminAssets')}}/assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{asset('AdminAssets')}}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset('AdminAssets/')}}/assets/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset('AdminAssets')}}/assets/css/authentication/form-2.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('AdminAssets')}}/assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminAssets')}}/assets/css/forms/switches.css">
</head>
<body class="form">


<div class="form-container outer">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">
                    <h1 class="">{{__('actions.sign_in')}}</h1>
                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div>
                    @endif
                    <form class="text-left" method="post" action="{{route('login')}}">
                        @csrf
                        <div class="form">
                            <div id="email" class="field-wrapper input">
                                <label for="email">{{__('actions.email')}}</label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="email" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <input id="email" name="email" type="email" class="form-control" placeholder="e.g admin@admin.com"
                                       value="{{old('email')}}" >
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div id="password-field" class="field-wrapper input mb-2">
                                <div class="d-flex justify-content-between">
                                    <label for="password">{{__('actions.password')}} </label>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-lock">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                                <input id="password" name="password" type="password" class="form-control"
                                       placeholder="Aa#">
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" id="toggle-password" class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </div>
                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary"
                                            value="">{{__('actions.login')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('AdminAssets')}}/assets/js/libs/jquery-3.1.1.min.js"></script>
<script src="{{asset('AdminAssets')}}/bootstrap/js/popper.min.js"></script>
<script src="{{asset('AdminAssets')}}/bootstrap/js/bootstrap.min.js"></script>
@include('sweetalert::alert')

<!-- END GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('AdminAssets')}}/assets/js/authentication/form-2.js"></script>

</body>
</html>
