<!-- Id Field -->
{{-- <div class="form-group">
    {!! Form::label('id', __('models/categoryProduct.fields.id').':') !!}
    <span>{{ $category->id }}</span>
</div> --}}

<!-- Photo Field -->
<div class="form-group">
    {!! Form::label('photo', __('models/categoryProduct.fields.photo').':') !!}
    <span><img src="{{asset("uploads/images/thumbnail/$category->photo")}}" alt="{{$category->name}}"></span>
</div>

@foreach ( config('langs') as $locale => $name)
    <!-- Name Field -->
    <div class="form-group">
        {!! Form::label('name', $name . ' ' . __('models/categoryProduct.fields.name').':') !!}
        <span>{{ $category->translate($locale)->name }}</span>

    </div>
@endforeach



<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/categoryProduct.fields.type').':') !!}
    <span>{{ $category->parent_id == null ? 'Parent' : 'Child' }}</span>
</div>
<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/categoryProduct.fields.status').':') !!}
    <span>{{ $category->status ? 'Active' : 'Inactive' }}</span>
</div>

