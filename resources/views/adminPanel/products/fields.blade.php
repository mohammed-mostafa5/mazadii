<!-- Photo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('photo', __('models/products.fields.photo').':') !!}
    {{-- {!! Form::file('photo[]', null, ['class' => 'form-control', 'multiple' => 'multiple']) !!} --}}

    <input type="file" name="photo[]" class="form-control" multiple>
</div>


<ul class="nav nav-pills mb-1" id="pills-tab" role="tablist">

    @foreach ( config('langs') as $locale => $name)

    <li class="nav-item">
        <a class="nav-link {{request('languages') == $locale ?'active':''}}" id="{{$name}}-tab" data-toggle="pill" href="#{{$name}}" role="tab" aria-controls="{{$name}}" aria-selected="{{ request('languages') == $locale  ? 'true' : 'false'}}">{{$name}}</a>
    </li>


    @endforeach
</ul>


<div class="tab-content" id="pills-tabContent">

    @foreach ( config('langs') as $locale => $name)

    <div class="tab-pane fade {{request('languages') == $locale ?'show active':''}}" id="{{$name}}" role="tabpanel" aria-labelledby="{{$name}}-tab">

        <!-- Name Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('name', __('models/products.fields.name').':') !!}
            {!! Form::text($locale . '[name]', isset($product)? $product->translate($locale)->name : '' , ['class'
            => 'form-control']) !!}
        </div>

        <!-- Description Field -->
        <div class="form-group col-sm-12 col-lg-6">
            {!! Form::label('description', __('models/products.fields.description').':') !!}
            {!! Form::textarea($locale . '[description]', isset($product)? $product->translate($locale)->name : '' ,
            ['class' => 'form-control']) !!}
        </div>

    </div>

    @endforeach

    <!-- Category Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('name', __('models/products.fields.category_name').':') !!}

        <select name="category_id" id="type" class="form-control">
            <option value="" class="text-secondary">Select Category</option>
            @forelse ($categories as $parent)
            <option value="{{ $parent->id }}" {{ isset($product)? $product->category_id == $parent->id? 'selected' : '' : ''  }}>{{ $parent->name }}
            </option>
            @if (isset($category->children))
            @foreach ( $parent->children as $child)
            <option value="{{ $child->id }}" {{ isset($product)? $product->category_id == $child->id? 'selected' : '' : ''  }}>-- {{ $child->name }}
            </option>
            @endforeach
            @endif
            @empty

            @endforelse
        </select>


    </div>



    <!-- Status Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('status', __('models/categories.fields.status').':') !!}

        <label class="radio-inline">
            {!! Form::radio('status', "1", 'active') !!} active
        </label>

        <label class="radio-inline">
            {!! Form::radio('status', "0", null) !!} inactive
        </label>
    </div>

    <!-- start Price Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('start_price', __('models/products.fields.start_price').':') !!}
        {!! Form::number('start_price', null, ['class' => 'form-control start_price']) !!}
    </div>


    <br>
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('adminPanel.products.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
    </div>

    <script>

    </script>
