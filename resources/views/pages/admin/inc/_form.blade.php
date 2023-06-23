@csrf
<div class="form-row">
    @foreach(\App\Models\User::$translatableData as $item => $lang)
        @foreach(LaravelLocalization::getSupportedLanguagesKeys() as $key_of_lang)
            @if($lang['type'] == 'text')
                <div class="col-md-8 mx-auto">
                    <label class="form-label">{{__('users.'.$item.'_'.$key_of_lang)}}</label>
                    <input type="{{$lang['type']}}" class="form-control my-2" name="{{$item}}_{{$key_of_lang}}"
                           value="{{old($item.'_'.$key_of_lang, isset($user) ? $user->getTranslation($item, $key_of_lang) : null)}}"
                        {{--                           placeholder="{{__('phase.'.$item.'_'. $key_of_lang)}}"--}}
                    >
                    @error($item.'_'.$key_of_lang)
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            @endif
        @endforeach
    @endforeach
</div>
<div class="form-row">
    <div class="col-md-8 mb-4 mx-auto">
        <label for="e_mail">{{__('users.email')}}</label>
        <input type="email" name="email" class="form-control" id="e_mail"
               value="{{old('email', isset($user)?$user->email:'')}}">
        @error('email')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="col-md-8 mb-4 mx-auto">
        <label for="password">{{__('users.password')}}</label>
        <input type="password" name="password" class="form-control" id="password">
        @error('password')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="col-md-8 mb-4 mx-auto">
        <label for="role">{{__('users.role')}}</label>
        <div id="select_menu" class="form-group mb-4">
            <select class="custom-select" name="role" id="role">
                <option value="">{{__('users.select_role')}}</option>
                <option
                    value="employee" {{old('role')=='employee'?'selected':''}} {{isset($user)&&$user->role=='employee'?'selected':''}}>
                    {{__('users.employee')}}
                </option>
                <option
                    value="admin" {{old('role')=='admin'?'selected':''}} {{isset($user)&&$user->role=='admin'?'selected':''}}>
                    {{__('users.admin')}}
                </option>
            </select>
        </div>
        @error('role')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
<div class="col-md-8 p-1 mb-4 mx-auto">
    <button class="btn btn-primary submit-fn mt-2" type="submit">{{__('shared.save')}}</button>
</div>
