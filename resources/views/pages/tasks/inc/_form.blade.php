@csrf
<div class="form-row" @if(app()->getLocale() == 'ar') dir="ltr" @else dir="rtl" @endif >
    @foreach(\App\Models\Task::$translatableData as $item => $lang)
        @foreach(LaravelLocalization::getSupportedLanguagesKeys() as $key_of_lang)
            @if($lang['type'] == 'text')
                <div class="col-md-6 mx-auto" @if($key_of_lang == 'ar') dir="rtl" @else dir="ltr" @endif >
                    <label class="form-label">{{__('tasks.'.$item.'_'.$key_of_lang)}}</label>
                    <input type="{{$lang['type']}}" class="form-control my-2" name="{{$item}}_{{$key_of_lang}}"
                           value="{{old($item.'_'.$key_of_lang, isset($task) ? $task->getTranslation($item, $key_of_lang) : null)}}"
                    >
                    @error($item.'_'.$key_of_lang)
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            @elseif($lang['type'] == 'textarea')
                <div class="col-md-6 mx-auto " @if($key_of_lang == 'ar') dir="rtl" @else dir="ltr" @endif >
                    <label class="form-label">{{__('tasks.'.$item.'_'.$key_of_lang)}}</label>
                    <textarea type="{{$lang['type']}}" class="form-control my-2" name="{{$item}}_{{$key_of_lang}}"
                    > {{old($item.'_'.$key_of_lang, isset($task) ? $task->getTranslation($item, $key_of_lang) : null)}}</textarea>
                    @error($item.'_'.$key_of_lang)
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            @endif
        @endforeach
    @endforeach
</div>
<div class="form-row">
    <div class="col-md-6 mb-4 mx-auto">
        <label for="fullName"> {{__('tasks.link')}}</label>
        <input type="text" name="link" class="form-control" id="fullName" placeholder=""
               value="{{old('link', isset($task)?$task->link:'')}}">
        @error('link')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    @if(isset($task))
        <div class="col-md-6 mb-4 mx-auto">
            <label for="fullName"> {{__('tasks.delivery_date')}}</label>
            <input id="dateTimeFlatpickr" name="delivery_date" class="form-control flatpickr flatpickr-input active"
                   type="text" placeholder="Select Date.." readonly="readonly"
                   value="{{old('delivery_date', isset($task)?$task->delivery_date:'')}}">
            @error('delivery_date')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    @endif

    <div class="col-md-6 mb-4 mx-auto">
        <label for="fullName"> {{__('tasks.status')}}</label>
        <select name="status_id" class="form-control">
            @foreach($statuses as $status)
                <option
                    value="{{$status->id}}" {{old('status_id', isset($task)?$task->status_id:'') == $status->id ? 'selected' : ''}}>
                    {{$status->name}}
                </option>
            @endforeach
        </select>
        @error('status_id')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="col-md-6 mb-4 mx-auto">
        <label for="fullName"> {{__('tasks.phase')}}</label>
        <select name="phase_id" class="form-control">
            @foreach($phases as $phase)
                <option
                    value="{{$phase->id}}" {{old('phase_id', isset($task)?$task->phase_id:'') == $phase->id ? 'selected' : ''}}>
                    {{$phase->name}}
                </option>
            @endforeach
        </select>
        @error('phase_id')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    @if(auth()->user()->isAdmin())
        <div class="col-md-6 mb-4 mx-auto">
            <label for="fullName"> {{__('tasks.payment_status')}}</label>
            <select name="payment_status" class="form-control">
                <option
                    value="unpaid" {{old('payment_status', isset($task)?$task->payment_status:'') == 'unpaid' ? 'selected' : ''}}>{{__('tasks.not_paid')}}</option>
                <option
                    value="paid" {{old('payment_status', isset($task)?$task->payment_status:'') == 'paid' ? 'selected' : ''}}>{{__('tasks.paid')}}</option>
            </select>
            @error('payment_status')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="col-md-6 mb-4 mx-auto">
            <label for="fullName"> {{__('tasks.assigned')}}</label>
            <select name="assigned_id" class="form-control">
                <option value="">{{__('tasks.select_employee')}}</option>
                @foreach($users as $user)
                    <option
                        value="{{$user->id}}" {{old('assigned_id', isset($task)?$task->assigned_id:'') == $user->id ? 'selected' : ''}}>
                        {{$user->name}}
                    </option>
                @endforeach
            </select>
            @error('assigned_id')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="col-md-6 mb-4 mx-auto">
            <label for="client_name">{{__('tasks.client')}}</label>
            <input type="text" name="client_name" class="form-control" id="client_name" placeholder=""
                   value="{{old('client_name', isset($task) ? $task->client->name : '')}}">
            <input type="hidden" name="client_id" id="client_id"
                   value="{{ old('client_id', isset($task) ? $task->client_id : '') }}">
            <div id="client_search_results"></div>
            @error('client_name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="col-md-6 mb-4 ml-auto">
            <label for="client_phone">{{__('tasks.client_phone')}}</label>
            <input type="text" name="client_phone" class="form-control" id="client_phone" placeholder=""
                   value="{{old('client_phone', isset($task)?$task->client->phone:'')}}">
            @error('client_phone')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

    @endif
</div>
<div class="col-md-12 p-1 mb-4 mx-auto">
    <button class="btn btn-primary submit-fn mt-2" type="submit">{{__('shared.save')}}</button>
</div>
<script src="{{asset('AdminAssets/assets/js/my-js/client-ajax.js')}}"></script>




