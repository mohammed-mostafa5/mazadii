<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/packages.fields.id').':') !!}
    <p>{{ $package->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/packages.fields.name').':') !!}
    <p>{{ $package->name }}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', __('models/packages.fields.price').':') !!}
    <p>{{ $package->price }}</p>
</div>

<!-- Duration Field -->
<div class="form-group">
    {!! Form::label('duration', __('models/packages.fields.duration').':') !!}
    <p>{{ $package->duration }}</p>
</div>

