@extends('website.layouts.app')

@section('content')

<div class="ps-page--single ps-page--vendor">

    <section class="ps-store-list">
        <div class="container">
            {{-- <div class="ps-section__header">
                <h3>{{ ucfirst( request('type') ) . ' Name: ' . request('search') }} </h3>
        </div> --}}
        <div class="ps-section__content">
            <div class="ps-section__search row">
                <div class="col-md-4">
                    <div class="form-group">

                        <form action="{{route('website.search')}}" method="GET">
                            @csrf
                            <input type="hidden" name="type" value="{{ request('type') }}">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <select class="ps-select" name="sort" data-placeholder="Sort Items">
                                <option value="created_at-DESC"
                                    {{ request('sort') == 'created_at-DESC' ? 'selected' : '' }}>
                                    @lang('lang.sort-by-latest')
                                </option>
                                <option value="regular_price-ASC"
                                    {{ request('sort') == 'regular_price-ASC' ? 'selected' : '' }}>
                                    @lang('lang.sort-by-price-low')</option>
                                <option value="regular_price-DESC"
                                    {{ request('sort') == 'regular_price-DESC' ? 'selected' : '' }}>
                                    @lang('lang.sort-by-price-high')</option>
                            </select>
                            <input type="submit" value="@lang('lang.sort')" class="ps-btn">
                        </form>
                    </div>
                </div>
            </div>
            <div class="row pb-35">
                @if ( request()->filled('type') )

                @include('includes.product',['products' => $products])
                @endif

            </div>
        </div>
</div>
</section>
</div>

@endsection
