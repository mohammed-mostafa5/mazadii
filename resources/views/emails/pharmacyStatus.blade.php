@component('mail::message')

<!-- Id Field -->
<div class="form-group">
  {!! Form::label('id', __('models/orders.fields.id').':') !!}
  <span>{{ $details->id }}</span>
</div>


<!-- Pharmacy Id Field -->
<div class="form-group">
  {!! Form::label('pharmacy_id', __('models/orders.fields.pharmacy_id').':') !!}
  <span>{{ $details->pharmacy->name }}</span>
</div>

<!-- Status Field -->
<div class="form-group">
  {!! Form::label('status', __('models/orders.fields.status').':') !!}
  <span>
    @switch($details->status)
    @case(0) New @break
    @case(1) Delivered @break
    @case(2) Received @break
    @default
    @endswitch</span>
</div>

<!-- Created at Field -->
<div class="form-group">
  {!! Form::label('created_at', __('models/orders.fields.created_at').':') !!}
  <span>
    {{$details->created_at}}</span>
</div>

<!-- all total Field -->
<div class="form-group">
  {!! Form::label('sub_total', __('models/orders.fields.sub_total').':') !!}
  <span>$ {{$details->alltotal}}</span>
</div>
<!-- Discount Field -->
<div class="form-group">
  {!! Form::label('discount', __('models/orders.fields.discount').':') !!}
  @php $totlaDiscount = 0 @endphp
  @if ($details->code)
  @php $totlaDiscount = $details->alltotal * $details->value / 100 @endphp

  <span>Code : {{$details->code ?? ''}} value : {{$details->value ?? ''}}%</span>
  @else
  <span>Not have discount</span>

  @endif
</div>
<!-- total Field -->
<div class="form-group">
  {!! Form::label('total', __('models/orders.fields.total').':') !!}
  <span> $ {{ $details->alltotal - $totlaDiscount}}</span>
</div>
<!-- total Field -->
<div class="form-group">
  Products :
  <hr>
  @forelse ($details->products as $product)
  Name : {{$product->name ?? ''}}
  Price : {{$product->price()}}
  Quantity : {{ $product->pivot->quantity }}
  Total : {{ $product->pivot->quantity * $product->price() }}
  <hr>
  @empty

  @endforelse
</div>
@endcomponent