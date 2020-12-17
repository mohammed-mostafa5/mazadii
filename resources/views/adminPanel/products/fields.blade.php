<!-- start Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', __('models/products.fields.category_id').':') !!}
    {!! Form::select('category_id', $categories, $product->category_id, ['class' => 'form-control']) !!}
</div>

<!-- start Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_bid_price', __('models/products.fields.start_price').':') !!}
    {!! Form::number('start_bid_price', null, ['class' => 'form-control']) !!}
</div>

<!-- min bid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('min_bid_price', __('models/products.fields.min_bid_price').':') !!}
    {!! Form::number('min_bid_price', null, ['class' => 'form-control']) !!}
</div>


<br>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('models/products.fields.approve'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.products.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>

<script>

</script>
