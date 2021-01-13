<!-- Title Field -->
<div class="form-group show">
    {!! Form::label('title', __('models/rules.fields.title').':') !!}
    <p>{{ $rule->title }}</p>
</div>

<!-- Description Field -->
<div class="form-group show">
    {!! Form::label('description', __('models/rules.fields.description').':') !!}
    <p>{{ $rule->description }}</p>
</div>

<!-- Created At Field -->
<div class="form-group show">
    {!! Form::label('created_at', __('models/rules.fields.created_at').':') !!}
    <p>{{ $rule->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group show">
    {!! Form::label('updated_at', __('models/rules.fields.updated_at').':') !!}
    <p>{{ $rule->updated_at }}</p>
</div>
