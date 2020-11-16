{{-- @extends('website.layouts.app')

@section('meta')
<meta name="keywords" content="{{isset($page->metas)? $page->metas->keywords : ''}}">
<meta name="title" content="{{isset($page->metas)? $page->metas->title : ''}}">
<meta name="description" content="{{isset($page->metas)? $page->metas->description : ''}}">
@endsection

@section('content')
<div class="clearfix"></div>
<section id="slider-wrap">
    <div id="slider">
        <div class="rev_slider_wrapper banner-section">

            <div class="rev_slider banner-slider">
                <ul>
                    @foreach ($slider as $slide)

                    <li data-transition="random" data-slotamount="{{$slide->id}}" data-masterspeed="500" class="slide-{{$slide->id}}">
                        <img src="{{asset('uploads/images/original/' . $slide->photo)}}" alt="banner" data-bgfit="cover" data-bgposition="center 36%" data-bgrepeat="no-repeat">

                        <div data-endspeed="800" data-easing="easeOutCirc" data-start="800" data-speed="700" data-y="150" data-x="152" class="tp-caption sft banner-heading ">
                            {!! $slide->content !!}
                        </div>
                    </li>
                    @endforeach
                    <div class="clearfix"></div>

                </ul>
            </div>
        </div>
    </div>
</section>

<main>

    <section class="intro">
        <div class="container">
            <div class="row">
                <div class="intro-box clearfix">
                    <div class="col-md-6 col-xs-12">

                        {!! $paragraphes[0]->text !!}

                        <div class="elementor-button-wrapper">
                            <a href="{{route('website.about')}}" class="green-btn">
                                <span class="elementor-button-text">{{__('lang.about')}}</span>
                                <i aria-hidden="true" class="fas fa-angle-right"></i>
                            </a>
                        </div>
                    </div>

                </div>

            </div>

        </div>


    </section>

    <section class="">
        <div class="container">
            <div class="row">
                <div class="pet-box clearfix" style="border: none; padding-top: 0">
                    <div class="col-md-6 col-xs-12">
                        <h1 class="title">Pet Shop</h1>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <img class="dog-img" src="{{asset('uploads/images/original/line.jpg')}}">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="market">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-xs-12">
                    <ul class="nav nav-tabs" id="myTab1" role="tablist">
                        <li class="nav-item active">
                            <a class="nav-link " id="home-tab1" data-toggle="tab" href="#home1" role="tab" aria-controls="home" aria-selected="true">NEW ARRIVAL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab1" data-toggle="tab" href="#profile1" role="tab" aria-controls="profile" aria-selected="false">BEST SELLER</a>
                        </li>


                    </ul>

                    <div class="tab-content clearfix" id="myTabContent">
                        <div class="tab-pane fade in active" id="home1" role="tabpanel" aria-labelledby="home-tab1">
                            @foreach ($products as $product)

                            <div class="articles-wrapper">
                                <div class="item-img">
                                    <a href="{{route('website.shop.product', $product->id)}}">
                                        <img src="{{asset('uploads/images/original/'.$product->photo_1)}}">
                                    </a>
                                </div>

                                <div class="item-info">

                                    <h4>{{$product->name}}</h4>
                                    <div>
                                        <span style="color: #9cc914; font-size: 20px; font-weight: 600;">{{$product->price()}} @lang('lang.currency') </span><br>

                                        <span style="color: #777;">@lang('lang.brand'):</span>

                                        <span style="color: #000; font-weight: 600;">{{$product->brand->text}}</span><br>

                                        <span style="color: #777;">@lang('lang.size'):</span>
                                        <span style="color: #000; font-weight: 600;">{{$product->size->text}}</span><br>

                                        <span class="" style="color: #777;">@lang('lang.weight'):</span>
                                        <span style="color: #000; font-weight: 600;">{{$product->weight->text}}</span><br>

                                        <span class="" style="color: #777;">@lang('lang.color'):</span>
                                        <span style="color: #000; font-weight: 600;">{{$product->color->text}}</span><br>
                                    </div>
                                </div>

                            </div>

                            @endforeach

                        </div>

                        <div class="tab-pane fade" id="profile1" role="tabpanel" aria-labelledby="profile-tab1">

                            @foreach ($bestSeller as $product)

                            <div class="articles-wrapper">
                                <div class="item-img">
                                    <a href="{{route('website.shop.product', $product->id)}}">
                                        <img src="{{asset('uploads/images/original/'.$product->photo_1)}}">
                                    </a>
                                </div>

                                <div class="item-info">

                                    <h4>{{$product->name}}</h4>
                                    <div>
                                        <span style="color: #9cc914; font-size: 20px; font-weight: 600;">{{$product->price()}} @lang('lang.currency') </span><br>

                                        <span style="color: #777;">@lang('lang.brand'):</span>

                                        <span style="color: #000; font-weight: 600;">{{$product->brand->text}}</span><br>

                                        <span style="color: #777;">@lang('lang.size'):</span>
                                        <span style="color: #000; font-weight: 600;">{{$product->size->text}}</span><br>

                                        <span class="" style="color: #777;">@lang('lang.weight'):</span>
                                        <span style="color: #000; font-weight: 600;">{{$product->weight->text}}</span><br>

                                        <span class="" style="color: #777;">@lang('lang.color'):</span>
                                        <span style="color: #000; font-weight: 600;">{{$product->color->text}}</span><br>
                                    </div>
                                </div>

                            </div>

                            @endforeach

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blogs">
        <div class="container-fluid no-pd">
            <div class="row">
                <div class="col-md-6 col-xs-12">

                    <img src="{{asset('uploads/images/original/'.$images[0]->photo)}}">

                </div>

                <div class="col-md-3 col-xs-12">
                    <div class="main-blog">
                        {!! $paragraphes[1]->text !!}
                        <div class="border-div">
                            <a href="{{route('website.blogs')}}">
                                Read More <i aria-hidden="true" class="fas fa-chevron-circle-right"></i>
                            </a>
                        </div>
                    </div>


                </div>

                <div class="col-md-3 col-xs-12">
                    <div class="posts">
                        <ul>
                            @foreach ($blogs as $blog)

                            <li>
                                <a href="{{route('website.blog', $blog->id)}}">{{$blog->title}}</a>
                            </li>

                            @endforeach
                        </ul>

                    </div>


                </div>
            </div>
        </div>
    </section>

</main>

@endsection --}}


Home Page

<a href="{{route('login')}}">Login</a>
<a href="{{route('registerForm')}}">Register</a>
<a href="{{route('logout')}}">Logout</a>
