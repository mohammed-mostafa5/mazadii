<header class="header header--standard header--technology app-header" data-sticky="false">
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="dc-helpnum">
                        <span>CALL US NOW: +20 100 500 7080</span>
                    </div>
                    <div class="dc-rightarea">

                        <a href="#"><i class="fa fa-facebook-f"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-youtube"></i></a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header__content">
        <div class="container">
            <div class="header__content-left">
                <a class="ps-logo" href="{{ route('website.home') }}">
                    <img src="{{ asset('uploads/images/original/'.$settings->where('key', 'logo')->first()->value) }}" alt="{{$settings->where('key', 'site_name')->first()->value}}">
                </a>
            </div>

            <div class="header__content-center">
                <nav class="navigation">
                    <div class="container">
                        <ul class="menu menu--technology">
                            <li class="menu-item-has-children">

                                <a href="#">Services</a><span class="sub-toggle"></span>

                                <ul class="sub-menu">
                                    <li class="current-menu-item">
                                        <a href="#">Nutrition</a>
                                    </li>
                                    <li class="current-menu-item">
                                        <a href="#">Medication</a>
                                    </li>
                                    <li class="current-menu-item">
                                        <a href="#">Condition</a>
                                    </li>
                                </ul>

                            </li>

                            <li><a href="{{route('website.shop.products')}}">Shop</a></li>
                            <li><a href="{{route('website.blogs')}}"></i>Blog</a></li>
                            <li><a href="{{route('website.about')}}">About Us</a></li>
                            <li><a href="#">Our Vets</a></li>
                            <li><a href="{{route('website.contact')}}">Contact Us</a></li>
                            <li>
                                @auth
                                <a href="#" title="My Basket">
                                    <div class="ps-cart--mini">
                                        <a class="header__extra" href="{{route('usersPanel.cart')}}">
                                            <i class="fa fa-shopping-bag fa-lg"></i>
                                            <span>
                                                <i class="count-cart">{{count($userAuth->cartProduct())}}</i>
                                            </span>
                                        </a>
                                    </div>
                                    @else
                                    <div class="ps-cart--mini">
                                        <a class="header__extra" href="#" readonly>
                                            <i class="fa fa-shopping-bag fa-lg"></i>
                                            <span>
                                                <i class="count-cart">0</i>
                                            </span>
                                        </a>
                                    </div>
                                    @endauth
                                </a>
                            </li>

                            @php
                            $url = url()->full();
                            if (Route::currentRouteName() == 'website.home' ) {
                            $ar = str_replace('en','ar',$url);
                            $en = str_replace('ar','en',$url);
                            }else {
                            $ar = str_replace('/en'.'/','/ar'.'/',$url);
                            $en = str_replace('/ar'.'/','/en'.'/',$url);
                            }

                            @endphp

                            <li>
                                <span class="text-light">|</span>

                                @if (request()->segment(1) == 'en')
                                <a href="{{$ar}}"><img width="20" src="{{asset('img/flag/ar.png')}}" alt=""> ع</a>
                                @elseif (request()->segment(1) == 'ar')
                                <a href="{{$en}}"><img width="20" src="{{asset('img/flag/en.png')}}" alt=""> En</a>
                                @endif
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>

            <div class="mobile-btns">
                <a href="#"><img src="{{asset('uploads/images/original/google-play-button.png')}}" alt="android-app"></a>
                <a href="#"><img src="{{asset('uploads/images/original/Aleefak_iOS.png')}}" alt="ios-app"></a>
            </div>

            <div class="header__content-right">

                <div class="header__actions">
                    @auth
                    @if (false)

                    {{-- notifications icon --}}
                    <a class="header__extra" href="{{route('usersPanel.notifications')}}">
                        <i class="icon-alarm-ringing"></i>
                        <span>
                            <i class="notification_count">
                                {{count($userAuth->notification())}}
                            </i>
                        </span>
                    </a>
                    </li>

                    @php
                    $url = url()->full();
                    if (Route::currentRouteName() == 'website.home' ) {
                    $ar = str_replace('en','ar',$url);
                    $en = str_replace('ar','en',$url);
                    }else {
                    $ar = str_replace('/en'.'/','/ar'.'/',$url);
                    $en = str_replace('/ar'.'/','/en'.'/',$url);
                    }

                    @endphp

                    <li>
                        <span class="text-light">|</span>

                        @if (request()->segment(1) == 'en')
                        <a href="{{$ar}}"><img width="20" src="{{asset('img/flag/ar.png')}}" alt=""> ع</a>
                        @elseif (request()->segment(1) == 'ar')
                        <a href="{{$en}}"><img width="20" src="{{asset('img/flag/en.png')}}" alt=""> En</a>
                        @endif
                    </li>

                    </ul>
                </div>
                </nav>
            </div>

            <div class="mobile-btns">
                <a href="#"><img src="{{asset('uploads/images/original/google-play-button.png')}}" alt="android-app"></a>
                <a href="#"><img src="{{asset('uploads/images/original/Aleefak_iOS.png')}}" alt="ios-app"></a>
            </div>

            <div class="header__content-right">

                <div class="header__actions">
                    @auth
                    @if (false)

                    {{-- notifications icon --}}
                    <a class="header__extra" href="{{route('usersPanel.notifications')}}">
                        <i class="icon-alarm-ringing"></i>
                        <span>
                            <i class="notification_count">
                                {{count($userAuth->notification())}}
                            </i>
                        </span>
                    </a>
                    <a class="header__extra" href="{{route('usersPanel.showWishlist')}}">
                        <i class="icon-heart"></i>
                        <span>
                            <i class="count-wishlist">
                                {{count($userAuth->whishlistProduct())}}
                            </i>
                        </span>
                    </a>
                    <div class="ps-cart--mini">
                        <a class="header__extra" href="{{route('usersPanel.showCart')}}">
                            <i class="icon-bag2"></i>
                            <span>
                                <i class="count-cart">{{count($userAuth->cartProduct())}}</i>
                            </span>
                        </a>
                    </div>

                    @endif
                    @endauth

                    <div class="ps-block--user-header">

                        @auth
                        <ul>
                            <li class="nav-item dropdown">
                                <a class="nav-link font-weight-bold text-capitalize text-dark" style="margin-right: 10px" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    {{ $userAuth->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    {{-- <a class="dropdown-item {{ Request::segment(3) == '' || Request::segment(3) == 'setting' ? 'active' : '' }} " --}}
                                    <a class="dropdown-item" href="{{route('usersPanel.dashboard')}}">
                                        <i class="icon-user"></i> @lang('lang.dashboard')
                                    </a>

                                    <a class="dropdown-item" href="{{route('usersPanel.invoices')}}">
                                        <i class="icon-papers"></i> @lang('lang.my-orders')
                                    </a>

                                    <a class="dropdown-item" href="{{route('usersPanel.cart')}}">
                                        <i class="icon-store"></i> @lang('lang.my-cart')
                                    </a>

                                    <a class="dropdown-item" href="{{route('usersPanel.wishlist')}}">
                                        <i class="icon-heart"></i> @lang('lang.my-wishlist')
                                    </a>

                                    <a class="dropdown-item" href="{{route('logout')}}">
                                        <i class="icon-power-switch"></i>@lang('lang.logout')
                                    </a>
                                </div>

                                @endif
                                @endauth

                                <div class="ps-block--user-header">

                                    @auth
                                    <ul>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link font-weight-bold text-capitalize text-dark" style="margin-right: 10px" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                                {{ $userAuth->name }}
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                {{-- <a class="dropdown-item {{ Request::segment(3) == '' || Request::segment(3) == 'setting' ? 'active' : '' }} " --}}
                                                <a class="dropdown-item" href="{{route('usersPanel.dashboard')}}">
                                                    <i class="icon-user"></i> @lang('lang.dashboard')
                                                </a>

                                                <a class="dropdown-item" href="{{route('usersPanel.invoices')}}">
                                                    <i class="icon-papers"></i> @lang('lang.my-orders')
                                                </a>

                                                <a class="dropdown-item" href="{{route('usersPanel.cart')}}">
                                                    <i class="icon-store"></i> @lang('lang.my-cart')
                                                </a>

                                                <a class="dropdown-item" href="{{route('usersPanel.wishlist')}}">
                                                    <i class="icon-heart"></i> @lang('lang.my-wishlist')
                                                </a>

                                                <a class="dropdown-item" href="{{route('logout')}}">
                                                    <i class="icon-power-switch"></i>@lang('lang.logout')
                                                </a>

                                            </div>
                                        </li>
                                    </ul>
                                    @else

                                    {{-- <div class="ps-block__left">
                                        <div class="user-img">
                                            <img src="https://ozooma.net/aleefak/wp-content/themes/doctreat/images/user.png" alt="">
                                        </div>
                                    </div>
                                    <div class="ps-block__right" style="margin: auto 0px;">
                                        <a href="{{ route('login') }}" class="login-btn">@lang('lang.login') </a>
                                    <a href="{{ route('registerForm') }}" class="register-btn">@lang('lang.register')</a>
                                </div> --}}

                                @endauth
                    </div>
                    @endauth
                    @guest

                    <div class="ps-block__right" style="margin: auto 0px;">
                        <a href="{{ route('login') }}" class="login-btn">@lang('lang.login') </a>
                        <a href="{{ route('registerForm') }}" class="register-btn">@lang('lang.register')</a>
                    </div>

                    @endguest
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    {{-- <nav class="navigation">
            <div class="container">
                <ul class="menu menu--technology">
                    <li><a href="{{ route('website.home') }}"><i class="icon-home"></i> @lang('lang.home')</a></li>
    <li><a href="{{ route('website.how-it-works') }}"><i class="icon-blog"></i>
            @lang('lang.how-it-works')</a>
    </li>
    <li><a href="{{ route('website.blogs') }}"><i class="icon-blog"></i> @lang('lang.articles')</a></li>
    <li><a href="{{ route('website.contact') }}"><i class="icon-phone"></i> @lang('lang.contact')</a></li>

    @php
    $url = url()->full();
    if (Route::currentRouteName() == 'website.home' ) {
    $ar = str_replace('en','ar',$url);
    $en = str_replace('ar','en',$url);
    }else {
    $ar = str_replace('/en'.'/','/ar'.'/',$url);
    $en = str_replace('/ar'.'/','/en'.'/',$url);
    }

    @endphp
    <li><span class="text-light">|</span>
        @if (request()->segment(1) == 'en')
        <a href="{{$ar}}"><img width="20" src="{{asset('img/flag/ar.png')}}" alt=""> ع</a>
        @elseif (request()->segment(1) == 'ar')
        <a href="{{$en}}"><img width="20" src="{{asset('img/flag/en.png')}}" alt=""> En</a>
        @endif
    </li>

    </ul>
    </div>
    </nav> --}}
</header>
<!-- End Navbar -->
