<a href="{{route('phase.edit',$phase)}}" class="btn btn-primary mr-2" data-toggle="tooltip"
   data-placement="top" title="{{__('shared.edit')}}">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
         class="feather feather-edit-3">
        <path d="M12 20h9"></path>
        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
    </svg>
</a>

{{--<form id="delete" action="{{route('phase.destroy',$phase)}}" method="post" class="d-inline-block">--}}
{{--    @csrf--}}
{{--    @method('DELETE')--}}
{{--    <a href="javascript:void(0);" onclick="this.closest('form').submit();return false;"--}}
{{--       class="btn btn-danger mr-2" data-toggle="tooltip"--}}
{{--       data-placement="top" title="{{__('shared.delete')}}">--}}
{{--        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"--}}
{{--             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"--}}
{{--             class="feather feather-trash-2">--}}
{{--            <polyline points="3 6 5 6 21 6"></polyline>--}}
{{--            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>--}}
{{--            <line x1="10" y1="11" x2="10" y2="17"></line>--}}
{{--            <line x1="14" y1="11" x2="14" y2="17"></line>--}}
{{--        </svg>--}}
{{--    </a>--}}
{{--</form>--}}
