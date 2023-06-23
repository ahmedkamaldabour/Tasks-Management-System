<!DOCTYPE html>
<html lang='{{ app()->getLocale() }}' class="default-style layout-fixed layout-navbar-fixed"
      @if(app()->getLocale() == 'ar') dir="rtl" @endif >
@include('inc.head')
<body class="alt-menu sidebar-noneoverflow">
<!-- BEGIN LOADER -->
<div id="load_screen">
    <div class="loader">
        <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div>
    </div>
</div>
<!--  END LOADER -->

@include('inc.navbar')

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>

    @include('inc.sidebar')

    <!--  BEGIN CONTENT PART  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            @yield('content')
        </div>
    </div>
    <!--  END CONTENT PART  -->

    <div class="px-5">
        @include('inc.footer')
    </div>

</div>
<!-- END MAIN CONTAINER -->

@include('inc.scripts')
</body>
</html>

