<div class="form-group col-12 text-center">
    <h2>@lang('lang.register_title')</h2>
    <p class="text-primary">@lang('lang.register_paragraph_1')</p>
</div>


<div class="form-group col-6">
    <input class="form-control @error('verify_code') is-invalid @enderror" 
            type="text" 
            name="verify_code" 
            placeholder="* @lang('lang.verify_code')"
            value="{{old('verify_code')}}">

    <p>
        <a href="{{ route('resendCodeToUser') }}">Resend code</a>
    </p>

    @error('verify_code')  <b class="invalid-feedback">{{ $message }}</b> @enderror
    
</div>