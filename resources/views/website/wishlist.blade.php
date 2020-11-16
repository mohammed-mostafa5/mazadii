@extends('website.layouts.app')

@section('content')
<div class="ps-page--simple">

    <div class="ps-section--shopping ps-whishlist">
        <div class="container">
            <div class="ps-section__header">
                <h1>Wishlist</h1>
            </div>
            <div class="ps-section__content">
                <div class="table-responsive">
                    <table class="table ps-table--whishlist">

                        <thead>
                            <tr>
                                <th></th>
                                <th>Product name</th>
                                <th>Unit Price</th>
                                {{-- <th>Stock Status</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                            <tr>
                                <td>
                                    <a href="{{ route('pharmacyPanel.removeProductWishlist', $product->id) }}"><i
                                            class="icon-cross"></i></a>
                                </td>
                                <td>
                                    <div class="ps-product--cart">
                                        <div class="ps-product__thumbnail"><a
                                                href="{{route('website.shop.product', $product->id)}}"><img
                                                    src="{{asset("uploads/images/thumbnail/$product->photo")}}"
                                                    alt="{{$product->name}}"></a></div>
                                        <div class="ps-product__content"><a
                                                href="{{route('website.shop.product',$product->id)}}">{{ Str::limit($product->name ?? '',50)}}</a>
                                        </div>
                                    </div>
                                </td>
                                <td class="price">
                                    ${{$product->sale_price ? $product->sale_price : $product->regular_price}}</td>
                                {{-- <td><span class="ps-tag ps-tag--in-stock">In-stock</span></td> --}}
                                <td>
                                    <a id="product-cart-{{$product->id}}" resultAjax="#product-cart-{{$product->id}}"
                                        class="ajaxBtnAction ps-btn ps-btn--gray"
                                        hrefAjax="{{ route('pharmacyPanel.addToCart', $product->id )}}">
                                        @if ($product->is_in_cart)
                                        <i class="fa fa-cart-arrow-down text-danger fa-lg"></i>
                                        @else
                                        <i class="icon-bag2"></i>
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            {{-- <tr>
                                <td><a href="#"><i class="icon-cross"></i></a></td>
                                <td>
                                    <div class="ps-product--cart">
                                        <div class="ps-product__thumbnail"><a href="{{route('website.shop.product', $product->id)}}"><img
                                src="img/products/clothing/2.jpg" alt=""></a>
                </div>
                <div class="ps-product__content"><a href="{{route('website.shop.product', $product->id)}}">Unero Military
                        Classical Backpack</a></div>
            </div>
            </td>
            <td class="price">$108.00</td>
            <td><span class="ps-tag ps-tag--in-stock">In-stock</span></td>
            <td><a class="ps-btn" href="#">Add to cart</a></td>
            </tr>
            <tr>
                <td><a href="#"><i class="icon-cross"></i></a></td>
                <td>
                    <div class="ps-product--cart">
                        <div class="ps-product__thumbnail"><a href="{{route('website.shop.product', $product->id)}}"><img
                                    src="img/products/electronic/15.jpg" alt=""></a></div>
                        <div class="ps-product__content"><a
                                href="{{route('website.shop.product', $product->id)}}">XtremepowerUS
                                Stainless Steel Tumble Cloths Dryer</a></div>
                    </div>
                </td>
                <td class="price">$508.00</td>
                <td><span class="ps-tag ps-tag--out-stock">Out-stock</span></td>
            </tr> --}}

            @empty

            @endforelse
            </tbody>

            </table>
        </div>
    </div>
</div>
</div>
</div>
@endsection
