<!--  BEGIN TOPBAR  -->
@php use App\Models\User; @endphp
@php
    $currentRoute = Route::currentRouteName();
    $isRtl = (app()->getLocale() === 'ar') ? true : false;
@endphp
<div class="topbar-nav header navbar" role="banner">
    <nav id="topbar">
        <ul class="list-unstyled menu-categories" id="topAccordion">
            <li class="menu single-menu {{ $currentRoute=='home' ? 'active' : '' }}">
                <a href="{{route('home')}}">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span>{{__('actions.Dashboard')}} </span>
                    </div>
                </a>
            </li>
            <li class="menu single-menu {{ $currentRoute=='task.index' ||  $currentRoute=='task.create' ? 'active' : '' }}">
                <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-cpu">
                            <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                            <rect x="9" y="9" width="6" height="6"></rect>
                            <line x1="9" y1="1" x2="9" y2="4"></line>
                            <line x1="15" y1="1" x2="15" y2="4"></line>
                            <line x1="9" y1="20" x2="9" y2="23"></line>
                            <line x1="15" y1="20" x2="15" y2="23"></line>
                            <line x1="20" y1="9" x2="23" y2="9"></line>
                            <line x1="20" y1="14" x2="23" y2="14"></line>
                            <line x1="1" y1="9" x2="4" y2="9"></line>
                            <line x1="1" y1="14" x2="4" y2="14"></line>
                        </svg>
                        <span>{{__('actions.tasks')}} </span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-chevron-down">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </a>
                <ul class="collapse submenu list-unstyled" id="app" data-parent="#topAccordion"
                    @if($isRtl) style="left: auto; right: 0;" @endif
                >
                    <li>
                        <a href="{{route('task.index')}}"> {{__('actions.all_tasks')}} </a>
                    </li>
                    @if(request()->user()->isAdmin())
                        <li>
                            <a href="{{route('task.create')}}"> {{__('actions.add_new_task')}} </a>
                        </li>
                    @endif
                </ul>
            </li>
            @if(request()->user()->isAdmin())
                <li class="menu single-menu {{ $currentRoute=='client.phases' ? 'active' : '' }} ">
                    <a href="{{ route('client.phases') }}">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-clipboard">
                                <path
                                    d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                            </svg>
                            <span>{{__('actions.clients')}} </span>
                        </div>
                    </a>
                </li>
                <li class="menu single-menu {{ $currentRoute=='phase.index' ||  $currentRoute=='phase.create' ? 'active' : '' }} ">
                    <a href="{{route('phase.index')}}">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-box">
                                <path
                                    d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                <line x1="12" y1="22.08" x2="12" y2="12"></line>
                            </svg>
                            <span>{{__('actions.all_phases')}} </span>
                        </div>
                    </a>
                </li>
                <li class="menu single-menu {{ $currentRoute=='status.index' ||  $currentRoute=='status.create' ? 'active' : '' }} ">
                    <a href="{{ route('status.index') }}">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-clipboard">
                                <path
                                    d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                            </svg>
                            <span>{{__('actions.all_status')}} </span>
                        </div>
                    </a>
                </li>
                <li class="menu single-menu {{ $currentRoute=='admin.index' ||  $currentRoute=='admin.create' ? 'active' : '' }} ">
                    <a href="#uiKit" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-zap">
                                <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                            </svg>
                            <span>{{__('actions.admins_employees')}} </span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-chevron-down">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="uiKit" data-parent="#topAccordion"
                        @if($isRtl) style="left: auto; right: 0;" @endif
                    >
                        <li>
                            <a href="{{route('admin.index')}}"> {{__('actions.all_users')}} </a>
                        </li>
                        <li>
                            <a href="{{route('admin.create')}}"> {{__('actions.add_new_user')}} </a>
                        </li>
                    </ul>
                </li>
                <li class="menu single-menu {{ $currentRoute == 'filter.index'? 'active' : '' }} ">
                    <a href="{{route('filter.index')}}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-layout">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="3" y1="9" x2="21" y2="9"></line>
                                <line x1="9" y1="21" x2="9" y2="9"></line>
                            </svg>
                            <span>{{__('filter.Report')}} </span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-chevron-down">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </a>
                </li>
            @endif
            <li class="menu single-menu {{ $currentRoute=='task-history.index'? 'active' : '' }}">
                <a href="{{route('task-history.index')}}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-clipboard">
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                        </svg>
                        <span>{{__('actions.all_changes_on_tasks')}} </span>
                    </div>
                </a>
            </li>
        </ul>
    </nav>
</div>
<!--  END TOPBAR  -->




