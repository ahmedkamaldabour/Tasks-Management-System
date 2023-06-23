@csrf
<div class="form-row">
    @foreach(\App\Models\Status::$translatableData as $item => $lang)
        @foreach(LaravelLocalization::getSupportedLanguagesKeys() as $key_of_lang)
            @if($lang['type'] == 'text')
                <div class="col-md-8 mx-auto">
                    <label class="form-label">{{__('status.'.$item.'_'.$key_of_lang)}}</label>
                    <input type="{{$lang['type']}}" class="form-control my-2" name="{{$item}}_{{$key_of_lang}}"
                           value="{{old($item.'_'.$key_of_lang, isset($status) ? $status->getTranslation($item, $key_of_lang) : null)}}"
{{--                           placeholder="{{__('status.'.$item.'_'. $key_of_lang)}}"--}}
                    >
                    @error($item.'_'.$key_of_lang)
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            @endif
        @endforeach
    @endforeach
</div>
<div class="col-md-8 p-1 mb-4 mx-auto">
    <button class="btn btn-primary submit-fn mt-2" type="submit">{{__('shared.save')}}</button>
</div>

