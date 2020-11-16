@extends('website.layouts.app')

@section('content')
<div class="ps-page--simple">
    <div class="ps-section--shopping ps-shopping-cart">
        <div class="container">
            <div class="ps-section__header">
                <h1>@lang('lang.checkout')</h1>
            </div>
            <div class="ps-section__content">
                <div class="table-responsive">
                    <table class="table ps-table--shopping-cart">
                        <thead>
                            <tr>
                                <th>@lang('lang.product-name')</th>
                                <th>@lang('lang.price')</th>
                                <th>@lang('lang.quantity')</th>
                                <th>@lang('lang.total')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp

                            @forelse ($products as $product)
                            <tr>

                                <td>
                                    <div class="ps-product--cart">
                                        <div class="ps-product__thumbnail">
                                            <a href="{{route('website.shop.product', $product->id)}}">
                                                <img src="{{asset("uploads/images/thumbnail/". $product->product->photo)}}" alt="{{$product->name}}">
                                            </a>
                                        </div>
                                        <div class="ps-product__content">
                                            <a href="{{ route('website.shop.product', $product->id )}}">{{$product->name ?? ''}}</a>
                                            <p>@lang('lang.sold-by'):<strong>{{$product->distributor->name ?? ''}}</strong>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="price">
                                    $ {{$product->price}}
                                </td>
                                <td>
                                    <div class="form-group--number">
                                        <p>{{ $product->quantity }}</p>
                                    </div>
                                </td>
                                <td class="total-{{$product->id}}">{{ $product->total }}
                                </td>
                            </tr>

                            @php $total += $product->total; @endphp

                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="ps-section__cart-actions">
                    <a class="ps-btn" href="{{ route('usersPanel.cart') }}">
                        <i class="icon-arrow-left"></i> @lang('lang.back-to-cart')
                    </a>
                    <a class="ps-btn" href="{{ route('usersPanel.checkout') }}">
                        <i class="icon-sync"></i> @lang('lang.update-checkout')
                    </a>

                </div>
            </div>
            <div class="ps-section__footer">
                <div class="row">
                    {{-- <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                        <figure>
                            <figcaption>Coupon Discount</figcaption>
                            <div class="form-group">
                                <input class="form-control" type="text" name="code" placeholder="" id="CouponCode">
                                <div class="resultCouponCode"></div>
                            </div>
                            <div class="form-group">
                                <button class="ps-btn ps-btn--outline" id="applyCouponCode" resultAjax=".resultCouponCode" hrefAjax="{{ route('usersPanel.couponValidation') }}">Apply</button>
                </div>
                </figure>
            </div> --}}
            {{-- <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                        <figure>
                            <figcaption>Calculate shipping</figcaption>
                            <div class="form-group">
                                <select class="ps-select">
                                    <option value="1">America</option>
                                    <option value="2">Italia</option>
                                    <option value="3">Vietnam</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Town/City">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Postcode/Zip">
                            </div>
                            <div class="form-group">
                                <button class="ps-btn ps-btn--outline">Update</button>
                            </div>
                        </figure>
                    </div> --}}
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12  m-auto">
                <div class="ps-block--shopping-total">
                    <div class="ps-block__header">
                        <p>@lang('lang.subtotal') <span id="subTotalOrder">{{ $total }}</span> <span>$</span></p>
                    </div>
                    <div class="ps-block__content">
                        <ul class="ps-block__product">
                            <li>
                                <h5>@lang('lang.discount') <i id="discountValue">0</i> %</h5>
                            </li>
                        </ul>
                        <h3>@lang('lang.total')
                            <span id="totalOrder">{{$total}}</span>
                            <span> $ </span>
                        </h3>
                    </div>
                </div>

                <form action="{{ route('usersPanel.orders.order') }}" method="POST">
                {{-- <form action="#" method="POST"> --}}
                    @csrf
                    <input type="hidden" name="code" id="CouponCode2">
                    {{-- <input type="hidden" name="company_id" value="{{isset($products) ? $product->company_id : ''}}">
                    --}}
                    <input type="hidden" name="distributor_id"
                        value="{{isset($products) ? $product->distributor_id : ''}}">
                    <button class="ps-btn ps-btn--fullwidth">@lang('lang.proceed-to-checkout')</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@section('scripts')
<script>
    // ajaxBtnAction
      $(document).ready(function(){
            $("#applyCouponCode").click(function(){

                var url = $(this).attr('hrefAjax');
                var resultAjax = $(this).attr('resultAjax');
                var code = $('#CouponCode').val();
                var total = $('#subTotalOrder').html();

                $.ajax({
                    type: "GET",
                    url: url,
                    data: {code:code},
                    success: function(result){
                        if(result.type == 1){

                            $(resultAjax).html(result.result);
                            $('#discountValue').html(result.discount);
                            var totalDiscount = total * result.discount / 100;
                            $('#totalOrder').html(total - totalDiscount);
                            $('#CouponCode2').val(code);
                        }else{

                            $(resultAjax).html(result.result);
                            $('#discountValue').html(0);
                            $('#totalOrder').html( total );
                            $('#CouponCode2').val('');
                        }
                    }});
            });

        });
</script>
@endsection
