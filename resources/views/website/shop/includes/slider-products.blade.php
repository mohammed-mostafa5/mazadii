<div class="ps-section__content">
    <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000"
        data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2"
        data-owl-item-sm="3" data-owl-item-md="4" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000"
        data-owl-mousedrag="on">

        @forelse ($products as $product)
        <div class="ps-product ps-product--inner">
            <div class="ps-product__thumbnail">
                <a href="{{ route('website.shop.product', $product->id) }}"><img
                        src="{{asset('uploads/images/thumbnail/' . $product->photo ?? '')}}"
                        alt="{{$product->name ?? ''}}" onerror="this.onerror=null;this.src='{{asset('uploads/images/thumbnail/notfound_0.png')}}';"></a>
                @if ($product->sale_price && $product->end_offer > now())
                <div class="ps-product__badge">@lang('lang.offer')</div>
                @endif
                @if (false)

                <ul class="ps-product__actions">

                    @auth
                    @if (auth()->user()->type == 1)
                    <li>
                        <a id="product-cart-{{$product->id}}" class="ajaxBtnAction"
                            resultAjax="#product-cart-{{$product->id}}"
                            hrefAjax="{{ route('pharmacyPanel.addToCart', $product->id )}}" data-toggle="tooltip"
                            data-placement="top">
                            @if ($product->is_in_cart)
                            <i class="fa fa-cart-arrow-down fa-lg text-danger"></i>
                            @else
                            <i class="icon-bag2"></i>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a id="product-{{$product->id}}" resultAjax="#product-{{$product->id}}" class="ajaxBtnAction"
                            hrefAjax="{{ route('pharmacyPanel.addToWishlist', $product->id )}}">
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
                        <a href="{{ route('website.shop.product', $product->id) }}" data-toggle="tooltip"
                            data-placement="top">
                            <i class="icon-eye"></i>
                        </a>
                    </li>
                </ul>
                @endif
            </div>
            <div class="ps-product__container">

                <div class="ps-product__content"><a class="ps-product__title"
                        href="{{ route('website.shop.product', $product->id) }}">{{$product->name ?? ''}}</a>
                </div>
            </div>
        </div>
        @empty
        @lang("lang.$msg")
        @endforelse

    </div>
</div>
