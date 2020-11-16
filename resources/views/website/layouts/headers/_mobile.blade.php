
<!-- Navbar Mobile -->
<header class="header header--mobile technology" data-sticky="true">

    <div class="navigation--mobile">
        <div class="navigation__left">
            <a class="ps-logo" href="{{ route('login') }}"><img
                    src="{{ asset('uploads/images/original/'.$settings->where('key', 'favicon')->first()->value) }}"
                    alt=""></a>
        </div>
        <div class="navigation__right" style="margin: auto 0px;">
            <div class="header__actions">
                <div class="ps-block--user-header">
                    @auth
                    <div class="ps-block__right">
                        <a href="#">{{ $userAuth->username }}</a>
                    </div>

                    @else

                    <div class="ps-block__left"><i class="icon-user"></i></div>
                    <div class="ps-block__right">
                        <a href="{{ route('login') }}">@lang('lang.login') / </a>
                        <a href="{{ route('registerForm') }}">@lang('lang.register')</a>
                    </div>

                    @endauth
                </div>
            </div>
        </div>
    </div>
    <div class="ps-search--mobile">
        <form class="ps-form--search-mobile" action="{{ route('website.search')}}" method="GET">
            <div class="form-group--nest">
                <select class="form-control" name="type">
                    <option value="">@lang('lang.type')</option>
                    <option value="companies" {{ request('type') == 'companies' ? 'Selected' : '' }}>
                        @lang('lang.company-name')
                    </option>
                    <option value="products" {{ request('type') == 'products' ? 'Selected' : '' }}>
                        @lang('lang.product-name')</option>
                </select>
            </div>
            <input class="form-control" type="text" name="search" value="{{ request('search') }}"
                placeholder="@lang('lang.search-placeholder')">
            <button><i class="icon-magnifier"></i></button>
        </form>
    </div>
</header>
<!-- End Navbar Mobile -->
<div class="ps-panel--sidebar" id="cart-mobile">
    <div class="ps-panel__header">
        <h3>@lang('lang.shopping-cart')</h3>
    </div>
    <div class="navigation__content">
        <div class="ps-cart--mobile">
            <div class="ps-cart__content">
                <div class="ps-product--cart-mobile">
                    <div class="ps-product__thumbnail">
                        <a href="#"><img src="{{asset('websiteAsset/img/products/clothing/7.jpg')}}" alt=""></a>
                    </div>
                    <div class="ps-product__content"><a class="ps-product__remove" href="#"><i
                                class="icon-cross"></i></a><a href="product-default.html">MVMTH Classical Leather Watch
                            In Black</a>
                        <p><strong>Sold by:</strong> YOUNG SHOP</p><small>1 x $59.99</small>
                    </div>
                </div>
            </div>
            <div class="ps-cart__footer">
                <h3>Sub Total:<strong>$59.99</strong></h3>
                <figure><a class="ps-btn" href="shopping-cart.html">View Cart</a><a class="ps-btn"
                        href="checkout.html">Checkout</a></figure>
            </div>
        </div>
    </div>
</div>

<div class="navigation--list app-header">
    <div class="navigation__content">
        <a class="navigation__item ps-toggle--sidebar" href="#menu-mobile"><i class="icon-menu"></i><span>
                @lang('lang.menu')</span></a>
        <a class="navigation__item ps-toggle--sidebar" href="#search-sidebar"><i class="icon-magnifier"></i><span>
                @lang('lang.search')</span></a>
        {{-- <a class="navigation__item ps-toggle--sidebar" href="#cart-mobile"><i class="icon-bag2"></i><span>
                @lang('lang.cart')</span></a> --}}
    </div>
</div>
<div class="ps-panel--sidebar" id="search-sidebar">
    <div class="ps-panel__header">
        <form class="ps-form--search-mobile" action="index.html" method="get">
            <div class="form-group--nest">
                <div class="form-group--icon"><i class="icon-chevron-down"></i>
                    <select class="form-control" style="background-color: #fff;">
                        <option value="1">@lang('lang.type')</option>
                        <option value="1">@lang('lang.company-name')</option>
                        <option value="1">@lang('lang.product-name')</option>
                    </select>
                </div>
                <input class="form-control" type="text" placeholder="@lang('lang.search-placeholder')">
                <button><i class="icon-magnifier"></i></button>
            </div>
        </form>
    </div>
    <div class="navigation__content"></div>
</div>
<div class="ps-panel--sidebar" id="menu-mobile">
    <div class="ps-panel__header">
        <h3>@lang('lang.menu')</h3>
    </div>
    <div class="ps-panel__content">
        <ul class="menu--mobile">
            @auth

            <li class="current-menu-item menu-item-has-children">
                <img src="" alt="">
                {{-- <a
                    href="{{ route($routeProfile , $userAuth->userable_id) }}">{{ $userAuth->userable->name }}</a>
                --}}
            </li>

            @else

            <li class="current-menu-item menu-item-has-children">
                <img src="" alt="">
                <a href="{{ route('login') }}">@lang('lang.login')</a>
                <a href="{{ route('registerForm') }}">@lang('lang.register')</a>
            </li>

            @endauth
            <li class="current-menu-item menu-item-has-children">
                <a href="{{ route('website.home') }}">@lang('lang.home')</a>
            </li>

            <li class="current-menu-item menu-item-has-children">
                <a href="{{ route('website.about') }}">@lang('lang.about')</a>
            </li>

            <li class="current-menu-item menu-item-has-children">
                <a href="{{ route('website.how-it-works') }}">@lang('lang.how-it-works')</a>
            </li>

            <li class="current-menu-item menu-item-has-children">
                <a href="{{ route('website.blogs') }}">@lang('lang.articles')</a>
            </li>

            <li class="current-menu-item menu-item-has-children">
                <a href="{{ route('website.syndicate-news') }}">@lang('lang.syndicate-news')</a>
            </li>

            <li class="current-menu-item menu-item-has-children">
                <a href="{{ route('website.contact') }}">@lang('lang.contact')</a>
            </li>

            <li class="current-menu-item menu-item-has-children">
                <a href="{{ route('website.terms-and-conditions') }}">@lang('lang.terms')</a>
            </li>

            <li class="current-menu-item menu-item-has-children">
                <a href="{{ route('website.privacy-policy') }}">@lang('lang.privacy')</a>
            </li>

        </ul>
    </div>
</div>
