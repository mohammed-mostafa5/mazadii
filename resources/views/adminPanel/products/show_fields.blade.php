<div class="photos row">
    <!-- Photo Field -->
    <div class="form-group  col-md-4">
        {!! Form::label('photo', __('models/products.fields.photo').':') !!}

        <span><img src="{{asset("uploads/images/thumbnail/$product->photo_1")}}" alt="{{$product->name}}" width="200"></span>
    </div>
    <!-- Photo Field -->
    <div class="form-group  col-md-4">

        <span><img src="{{asset("uploads/images/thumbnail/$product->photo_2")}}" alt="{{$product->name}}" width="200"></span>
    </div>
    <!-- Photo Field -->
    <div class="form-group  col-md-4">

        <span><img src="{{asset("uploads/images/thumbnail/$product->photo_3")}}" alt="{{$product->name}}" width="200"></span>
    </div>
</div>

<!-- Video Field -->
<div class="form-group show">
    {!! Form::label('video', __('models/products.fields.video').':') !!}
    <span>{!! $product->video_html !!}</span>
</div>

<!-- Barcode Field -->
<div class="form-group show">
    {!! Form::label('sku', __('models/products.fields.sku').':') !!}
    <span>{{ $product->sku }}</span>
</div>


@foreach ( config('langs') as $locale => $name)

<!-- Category Field -->
<div class="form-group show">
    {!! Form::label('id', $name .' ' . __('models/products.fields.category_name').':') !!}
    <span>{{ $product->category->parentCategory->translate($locale)->name ?? ''}} - {{ $product->category->translate($locale)->name ?? ''}}</span>
</div>


<!-- Name Field -->
<div class="form-group show">
    {!! Form::label('name', $name .' ' . __('models/products.fields.name').':') !!}
    <span>{{ $product->translate($locale)->name }}</span>
</div>

<!-- Description Field -->
<div class="form-group show">
    {!! Form::label('description', $name .' ' . __('models/products.fields.description').':') !!}
    <span>{{ $product->translate($locale)->description }}</span>
</div>


@if (isset($product->style))
<!-- style Field -->
<div class="form-group show">
    {!! Form::label('style', $name .' ' . __('models/products.fields.style').':') !!}
    <span>{{$product->style->translateOrNew($locale)->text}}</span>
</div>
@endif
@if (isset($product->brand))
<!-- brand Field -->
<div class="form-group show">
    {!! Form::label('brand', $name .' ' . __('models/products.fields.brand').':') !!}
    <span>{{$product->brand->translateOrNew($locale)->text}}</span>
</div>
@endif

@endforeach

@if (isset($product->color))
<!-- color Field -->
<div class="form-group show">
    {!! Form::label('color', __('models/products.fields.color').':') !!}
    {{-- <span>{{$product->color->translateOrNew($locale)->text}}</span> --}}
    <div class="color" style="width: 25px; height:25px; border: 2px solid #ddd; background-color: {{$product->color->translateOrNew('en')->text}}"></div>
</div>
@endif

@if (isset($product->size))
<!-- Bundle Field -->
<div class="form-group show">
    {!! Form::label('size', __('models/products.fields.size').':') !!}
    <span>{{$product->size->text}}</span>
</div>
@endif
@if (isset($product->weight))
<!-- Bundle Field -->
<div class="form-group show">
    {!! Form::label('weight', __('models/products.fields.weight').':') !!}
    <span>{{$product->weight->text}}</span>
</div>
@endif
<!-- Regular Price Field -->
<div class="form-group show">
    {!! Form::label('regular_price', __('models/products.fields.regular_price').':') !!}
    <span>{{ $product->regular_price ?? '' }}</span>
</div>

<!-- Sale Price Field -->
<div class="form-group show">
    {!! Form::label('sale_price', __('models/products.fields.sale_price').':') !!}
    <span>{{ $product->sale_price ?? '' }}</span>
</div>

<!-- Bundle Field -->
<div class="form-group show">
    {!! Form::label('is_bundle', __('models/products.fields.is_bundle').':') !!}
    <span>{{$product->is_bundle ? 'Yes' : 'No'}}</span>
</div>


<!-- Created At Field -->
<div class="form-group show">
    {!! Form::label('created_at', __('models/products.fields.created_at').':') !!}
    <span>{{ $product->created_at }}</span>
</div>

<!-- Updated At Field -->
<div class="form-group show">
    {!! Form::label('updated_at', __('models/products.fields.updated_at').':') !!}
    <span>{{ $product->updated_at }}</span>
</div>



{{-- <table class="table table-hover table-bordered w-50 float-left table-sm text-capitalize text-center">
    <thead>
        <tr>
            <th scope="col" class="bg-primary">{!! Form::label('name', __('models/pharmacies.fields.name').':') !!}</th>
            <th scope="col" class="bg-primary">{!! Form::label('price', __('lang.price').':') !!}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($product->distributors as $distributor)
        <tr>
            <td>{{$distributor->name}}</td>
<td>{{$distributor->pivot->price}}</td>
</tr>
@empty

@endforelse
</tbody>
</table> --}}
<div class=" clearfix"></div>
