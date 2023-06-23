<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('AdminAssets/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('AdminAssets/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('AdminAssets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('AdminAssets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('AdminAssets/assets/js/app.js')}}"></script>
@include('sweetalert::alert')
<script>
    $(document).ready(function () {
        App.init();
    });
</script>
<script src="{{asset('AdminAssets/assets/js/custom.js')}}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{asset('AdminAssets/plugins/apex/apexcharts.min.js')}}"></script>
<script src="{{asset('AdminAssets/assets/js/dashboard/dash_2.js')}}"></script>
@if(app()->getLocale() == 'ar')
    <script>
        const forms_dir = document.forms
        for (let i = 0; i < forms_dir.length; i++) {
            forms_dir[i].style.textAlign = 'right'
        }
        const all_select = document.querySelectorAll('select');
        for (let i = 0; i < forms_dir.length; i++) {
            all_select[i].style.padding = `8px 24px`
        }
    </script>
@endif
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@stack('js')
