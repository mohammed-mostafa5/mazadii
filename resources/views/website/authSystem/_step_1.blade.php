<div class="form-group col-12 text-center">
    <h2>@lang('lang.register_title')</h2>
    <p class="text-primary">@lang('lang.register_paragraph_1')</p>
</div>


<div class="form-group col-6">
    <input class="form-control @error('first_name') is-invalid @enderror" type="text" name="first_name" placeholder="* @lang('lang.first_name')"
        value="{{old('first_name')}}">

    @error('first_name')  <b class="invalid-feedback">{{ $message }}</b> @enderror
</div>

<div class="form-group col-6">
    <input class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name" placeholder="* @lang('lang.last_name')"
        value="{{old('last_name')}}">

    @error('last_name')  <b class="invalid-feedback">{{ $message }}</b> @enderror
</div>

<div class="form-group col-6">
    <input class="form-control @error('username') is-invalid @enderror" type="text" name="username" placeholder="* @lang('lang.username')"
        value="{{old('username')}}">

    @error('username')  <b class="invalid-feedback">{{ $message }}</b> @enderror
</div>


