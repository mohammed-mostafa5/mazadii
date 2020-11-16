<div class="form-group col-12 text-center">
    <h2>@lang('lang.register_title')</h2>
    <p class="text-primary">@lang('lang.register_paragraph_2')</p>
    @if (request()->session()->has('display_name'))
        <p class="text-danger">{{session('display_name')}}</p>
        <input type="hidden" name="email" value="{{session('email')}}">
    @endif

</div>

<div class="form-group col-12">
    @php  $countries = ['egypt' => 'Egypt'];  @endphp

    <select name="location" class="form-control" placeholder="* @lang('lang.select_location')">
        @foreach ($countries as $country)
            <option value="{{$country}}">{{$country}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-6">

    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password"
        placeholder="* @lang('lang.password')">
    @error('password')  <b class="invalid-feedback">{{ $message }}</b> @enderror

</div>

<div class="form-group col-6">

    <input class="form-control" type="password" name="password_confirmation"
        placeholder="* @lang('lang.confirm-password')">
</div>

<div class="form-group col-12 row">
    <h3 class="radio-inline col-12">Start As</h3>

    <label class="radio-inline col-6" style="border:1px solid #ddd">
        {!! Form::radio('start_as', "Vet", 'active') !!} Vet
    </label>

    <label class="radio-inline col-6"  style="border:1px solid #ddd">
        {!! Form::radio('start_as', "Owner Pet", null) !!} Owner Pet
    </label>

    @error('start_as')  <b class="invalid-feedback">{{ $message }}</b> @enderror
</div>

<div class="form-group col-12 row">
    <input type="checkbox" name="agree_conditions_at" value="agree"> By checking this box you are agree Aleefak <a href="{{ route('website.terms-and-conditions') }}">@lang('lang.terms')</a>

    @error('agree_conditions_at')  <b class="invalid-feedback">{{ $message }}</b> @enderror
</div>
