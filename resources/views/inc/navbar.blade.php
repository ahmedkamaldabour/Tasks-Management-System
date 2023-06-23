<!--  BEGIN NAVBAR  -->
<div class="header-container">
    <header class="header navbar navbar-expand-sm">
        <ul class="navbar-item flex-row">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </a>

            <a href="{{route('home')}}">
                <img class="ml-3" width="100px" src={{asset('AdminAssets/logo/logo.png')}} alt="logo">
            </a>
        </ul>

        <ul class="navbar-item flex-row p-1 m-1
            @if(app()->getLocale() == 'ar') mr-auto @else ml-auto @endif">
            @if(request()->user()->isAdmin())
            <a href="{{route('task.create')}}" class="btn btn-outline-success">{{__('tasks.create_task')}}</a>
            @endif
        </ul>

        <ul class="navbar-item flex-row nav-dropdowns">
            <li class="nav-item dropdown language-dropdown more-dropdown">
                <div class="dropdown custom-dropdown-icon">
                    <a class="dropdown-toggle btn" href="#" role="button" id="customDropdown" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        @switch(LaravelLocalization::getCurrentLocale())
                            @case('en')
                                English
                                @break
                            @case('ar')
                                عربي
                                @break
                            @default
                                <img src="{{asset('AdminAssets')}}/assets/img/us-flag.jpg" class="flag-width"
                                     alt="flag">
                        @endswitch
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round"
                             class="feather feather-chevron-down">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </a>

                    <div
                        class=" @if(app()->getLocale() == 'ar') text-right @endif dropdown-menu dropdown-menu-right animated fadeInUp"
                        aria-labelledby="customDropdown">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a class="dropdown-item" hreflang="{{ $localeCode }}"
                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">> {{ $properties['native'] }}</a>
                        @endforeach
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown user-profile-dropdown order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="user-profile-dropdown"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media">
                        <div class="media-body align-self-center">
                            <h6><span>{{__('actions.hi')}},</span> {{Auth::user()->name}}</h6>
                        </div>
                    </div>
                </a>
                <div
                    class=" @if(app()->getLocale() == 'ar') text-right @endif dropdown-menu position-absolute animated fadeInUp"
                    aria-labelledby="user-profile-dropdown">
                    <div class="">
                        <div class="dropdown-item">
                            <a class="" href="{{route('profile.index')}}">
                                <a class="" href="{{route('profile.index')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    {{__('actions.profile')}}</a>
                            </a>
                        </div>
{{--                        <div class="dropdown-item">--}}
{{--                            <a class="" href="{{route('task.employeeTasks', auth()->user()->id)}}">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"--}}
{{--                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
{{--                                     stroke-linejoin="round" class="feather feather-inbox">--}}
{{--                                    <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>--}}
{{--                                    <path--}}
{{--                                        d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>--}}
{{--                                </svg>--}}
{{--                                {{__('actions.my_tasks')}}</a>--}}
{{--                        </div>--}}
                        <form method="post" action={{route('logout')}}>
                            @csrf
                            <div class="dropdown-item">
                                <a class="" href="" onclick="this.closest('form').submit(); return false;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-log-out">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    {{__('actions.logout')}}</a>
                            </div>
                        </form>
                    </div>
                </div>

            </li>
        </ul>
    </header>
</div>
<!--  END NAVBAR  -->
