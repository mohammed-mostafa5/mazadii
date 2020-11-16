@forelse ($products as $product)
{{-- {{dd($product)}} --}}

<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6 ">
    <div class="ps-product">
        <div class="ps-product__thumbnail" style="height: 160px"><a href="{{route('website.shop.product',$product->id)}}">
                <img src="{{asset('uploads/images/original/' . $product->photo_1)}}" alt="{{$product->name ?? ''}}" onerror="this.onerror=null;this.src={{asset('uploads/images/thumbnail/notfound_0.png')}};">
            </a>

            {{-- <img src="{{asset('uploads/images/thumbnail/' . $product->photo)}}" alt="{{$product->name ?? ''}}"
            onerror="this.onerror=null;this.src={{asset('uploads/images/thumbnail/notfound_0.png')}};"></a> --}}

            @if ($product->sale_price && $product->end_offer > now())
            <div class="ps-product__badge">@lang('lang.offer')</div>
            @endif
            @if (true)
            <ul class="ps-product__actions">
                @auth
                @if (true)
                <li>
                    <a id="product-cart-{{$product->id}}" class="ajaxBtnAction" resultAjax="#product-cart-{{$product->id}}" hrefAjax="{{ route('usersPanel.cart.addOrRemove', $product->id )}}" data-toggle="tooltip" data-placement="top">
                        @if ($product->is_in_cart)
                        <i class="fa fa-cart-arrow-down fa-lg text-danger"></i>
                        @else
                        <i class="icon-bag2"></i>
                        @endif
                    </a>
                </li>
                <li>
                    <a id="product-{{$product->id}}" resultAjax="#product-{{$product->id}}" class="ajaxBtnAction" data-toggle="tooltip" data-placement="top" hrefAjax="{{ route('usersPanel.addToWishlist', $product->id )}}">

                        @if ($product->is_fav)
                        <i class="fa fa-heart text-danger"></i>
                        @else
                        <i class="fa fa-heart-o"></i>
                        @endif
                    </a>
                </li>
                @endif
                @endauth


                <li>
                    <a href="{{ route('website.shop.product', $product->id) }}" data-toggle="tooltip" data-placement="top">
                        <i class="icon-eye"></i>
                    </a>
                </li>
            </ul>
            @endif
        </div>

        <div class="ps-product__container"><a class="ps-product__vendor" href="#">{{$product->distributor->name ?? ''}}</a>
            <div class="ps-product__content"><a class="ps-product__title" href="{{route('website.shop.product',$product->id)}}">{{$product->name ?? ''}}</a>


            </div>
            <div class="ps-product__content hover"><a class="ps-product__title" href="{{route('website.shop.product',$product->id)}}">{{$product->name ?? ''}}</a>

            </div>
        </div>
    </div>
</div>

@empty

@endforelse

{{ $products->links() }}
