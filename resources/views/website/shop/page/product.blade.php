@extends('website.layouts.app')

@section('content')
<div class="ps-page--product">
    <div class="ps-container">
        <div class="ps-page__container">
            <div class="ps-page__left">
                <div class="ps-product--detail ps-product--fullwidth">
                    <div class="ps-product__header">
                        <div class="ps-product__thumbnail" data-vertical="true">
                            <figure>
                                <div class="ps-wrapper">
                                    <div class="ps-product__gallery" data-arrow="false">
                                        <div class="item">
                                            <a href="{{asset('uploads/images/thumbnail/' . $product->photo)}}">
                                                <img src="{{asset('uploads/images/original/' . $product->photo)}}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </figure>
                        </div>
                        <div class="ps-product__info">
                            <h1>{{$product->name ?? ''}}</h1>
                            <div class="ps-product__meta">
                                <div class="ps-product__rating">
                                    <select class="ps-rating" data-read-only="true">
                                        @for ($i = 1; $i <= $product->avgReview(); $i++)
                                            <option value="1">{{$i}}</option>
                                            @endfor
                                            @for ($i = $product->avgReview(); $i < 5; $i++) <option value="2">{{$i}}</option>
                                                @endfor
                                    </select>
                                    <span>({{$product->reviews->count()}} review)</span>
                                </div>
                            </div>

                            @if ($product->sale_price)
                                <h4 class="ps-product__price sale">${{$product->sale_price}} <del>${{$product->regular_price}}</del></h4>
                            @else
                                <h4 class="ps-product__price">${{$product->regular_price}}</h4>
                            @endif

                            <div class="ps-product__desc pb-4">
                                {{ Str::limit($product->description, 200) }}
                            </div>


                            <div class="ps-product__variations">

                                @if ($product->type)
                                    <figure>
                                        <figcaption>Color: {{$product->color->text}}</figcaption>
                                        <figcaption>Size: {{$product->size->text}}</figcaption>
                                        <figcaption>Style: {{$product->style->text}}</figcaption>
                                    </figure>
                                @else

                                @endif
                            </div>
                            @auth
                            <div class="ps-product__shopping">
                                <figure>
                                    <figcaption>Quantity</figcaption>
                                    <div class="form-group--number">
                                        <input class="form-control" type="number" placeholder="1">
                                    </div>
                                </figure>
                                <a id="product-cart-{{$product->id}}" class="ajaxBtnAction btn btn-primary text-white" resultAjax="#product-cart-{{$product->id}}" hrefAjax="{{ route('usersPanel.cart.addOrRemove', $product->id )}}" data-toggle="tooltip" data-placement="top">
                                    @if ($product->is_in_cart)
                                    <div class="btn-primary">
                                        <i class="fa fa-cart-arrow-down fa-lg text-danger"></i>
                                    </div>
                                    @else
                                    <i class="icon-bag2"></i>
                                    @endif
                                </a>
                                <div class="ps-product__actions">
                                    <span>
                                        <a id="product-{{$product->id}}" resultAjax="#product-{{$product->id}}" class="ajaxBtnAction" hrefAjax="{{ route('usersPanel.addToWishlist', $product->id )}}">
                                            @if ($product->is_fav)
                                            <i class="fa fa-heart text-danger"></i>
                                            @else
                                            <i class="fa fa-heart-o"></i>
                                            @endif
                                        </a>
                                    </span>
                                </div>
                            </div>
                            @endauth
                            <div class="ps-product__specification">
                                <p><strong>SKU:</strong> {{$product->sku}}</p>
                                <p class="categories"><strong> @lang('lang.categories'):</strong><a href="{{ route('website.shop.category', $product->category->id) }}">{{$product->category->name}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="ps-product__content ps-tab-root">

                        <ul class="ps-tab-list">
                            <li class="active"><a href="#tab-1">@lang('lang.description')</a></li>
                            <li><a href="#tab-4">Reviews ({{$product->reviews->count()}})</a></li>
                        </ul>

                        <div class="ps-tabs">
                            <div class="ps-tab container active" id="tab-1">
                                <div class="ps-document">
                                    {!! $product->description !!}
                                </div>
                            </div>
                            <div class="ps-tab container" id="tab-4">
                                <div class="row">

                                    @auth
                                    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 ">
                                        <form class="ps-form--review" action="{{route('website.shop.reviewProduct', $product->id )}}" method="POST">
                                            <h4>Submit Your Review</h4>

                                            <div class="form-group form-group__rating">
                                                <label>Your rating of this product</label>
                                                <select class="ps-rating" data-read-only="false" name="rate">
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <textarea name="comment" class="form-control" rows="6" placeholder="Write your review here"></textarea>
                                            </div>

                                            <div class="form-group submit">
                                                <button class="ps-btn">Submit Review</button>
                                            </div>
                                            @csrf
                                        </form>
                                    </div>
                                    @endauth

                                    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12 text-center">
                                        <div class="ps-block--average-rating">
                                            <div class="ps-block__header">
                                                <h3>{{$product->avgReview() ?? '0'}}</h3>
                                                <select class="ps-rating" data-read-only="true">
                                                    @for ($i = 1; $i <= $product->avgReview(); $i++)
                                                        <option value="1">{{$i}}</option>
                                                        @endfor
                                                        @for ($i = $product->avgReview(); $i < 5; $i++) <option value="2">{{$i}}</option>
                                                            @endfor
                                                </select>
                                                <span>({{$product->reviews->count()}} review)</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="reviews d-block">
                                        <div class="ps-post-comments">
                                            @foreach ($product->reviews as $review)

                                            <div class="ps-block--comment">
                                                <div class="ps-block__content">
                                                    <h5>{{$review->display_name}}</h5>
                                                    <div class="ps-block--average-rating">
                                                        <div class="ps-block__header">
                                                            <select class="ps-rating" data-read-only="true">
                                                                    @for ($i = 1; $i <= $review->pivot->rate; $i++)
                                                                        <option value="1">{{$i}}</option>
                                                                    @endfor
                                                                    @for ($i = $review->pivot->rate; $i < 5; $i++)
                                                                        <option value="2">{{$i}}</option>
                                                                    @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <p>{{$review->pivot->comment}}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="ps-page__right">
                <aside class="widget widget_product widget_features">
                    <p><i class="icon-network"></i> Shipping worldwide</p>
                    <p><i class="icon-3d-rotate"></i> Free 7-day return if eligible, so easy</p>
                    <p><i class="icon-receipt"></i> Supplier give bills for this product.</p>
                    <p><i class="icon-credit-card"></i> Pay online or when receiving goods</p>
                </aside>
            </div>
        </div>
    </div>
</div>
@endsection
