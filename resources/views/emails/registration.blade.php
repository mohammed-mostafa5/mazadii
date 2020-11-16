@component('mail::message')
{{-- <!-- Id Field -->
<div class="form-group">
    {!! Form::label('status', __('models/users.fields.status').':') !!}
    <span>
        @switch($user->status)
        @case(1) Approved @break
        @case(2) Rejected @break
        @default Pending
        @endswitch
    </span>
</div> --}}

<!-- user Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/users.fields.name').':') !!}
    <span>{{ $user->first_name }} {{$user->last_name}}</span>
</div>

<!-- username Field -->
<div class="form-group">
    {!! Form::label('username', __('models/users.fields.username').':') !!}
    <span>{{ $user->username }}</span>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', __('models/users.fields.email').':') !!}
    <span>{{ $user->email }}</span>
</div>

<!-- password Field -->
<div class="form-group">
    {!! Form::label('password', __('models/users.fields.password').':') !!}
    <span>{{ $passwordValue }}</span>
</div>

<!-- code Field -->
<div class="form-group">
    {!! Form::label('code', __('models/users.fields.code').':') !!}
    <span>{{ $user->code }}</span>
</div>

<!-- Phone Field -->
<div class="form-group">
    {!! Form::label('phone', __('models/users.fields.phone').':') !!}
    <span>{{ $user->phone }}</span>
</div>



@endcomponent
