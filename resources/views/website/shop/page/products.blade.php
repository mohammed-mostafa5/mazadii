@extends('website.layouts.app')

@section('content')

{{-- <div class="ps-breadcrumb">
    <div class="ps-container">
        <ul class="breadcrumb">
            <li><a href="{{route('website.home')}}">@lang('lang.home')</a></li>
            <li>@lang('lang.shop')</li>
        </ul>
    </div>
</div> --}}
<div class="ps-page--shop" id="shop-sidebar">
    <div class="container">
        <div class="ps-layout--shop">
            <div class="ps-layout__left">
                @include($path_includes.'categories-sidebar')
            </div>
            <div class="ps-layout__right">
                <div class="ps-shopping ps-tab-root">
                    <div class="ps-shopping__header">
                        <p><strong> {{ $products->count() }}</strong> @lang('lang.products-found')</p>
                        <div class="ps-shopping__actions">
                            <form action="{{url()->full()}}" method="GET">
                                <select class="ps-select" name="sort" data-placeholder="Sort Items">
                                    <option value="created_at-DESC"
                                        {{ request('sort') == 'created_at-DESC' ? 'selected' : '' }}>
                                        @lang('lang.sort-by-latest')
                                    </option>
                                    <option value="regular_price-ASC"
                                        {{ request('sort') == 'regular_price-ASC' ? 'selected' : '' }}>
                                        @lang('lang.sort-by-price-low')
                                    </option>
                                    <option value="regular_price-DESC"
                                        {{ request('sort') == 'regular_price-DESC' ? 'selected' : '' }}>
                                        @lang('lang.sort-by-price-high')
                                    </option>
                                </select>
                                <button type="submit" class="ps-btn">@lang('lang.sort')</button>
                            </form>
                        </div>
                    </div>
                    <div class="ps-tabs">
                        <div class="ps-tab active" id="tab-1">
                            <div class="ps-shopping-product">
                                <div class="row">
                                    @include($path_includes.'product',['products' => $products])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
