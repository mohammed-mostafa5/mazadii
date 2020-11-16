@extends('website.layouts.app')
@section('meta')
<meta name="keywords" content="{{$article->title ?? ''}}">
<meta name="title" content="{{$article->title ?? ''}}">
<meta name="description" content="{!! $article->body ?? ''!!}">
@endsection
@section('content')

<div class="ps-page--blog">
    <div class="ps-post--detail ps-post--parallax">
        <div class="ps-post__header bg--parallax"
            style="background: url('')">
            <div class="container">
                {{-- <h1>{{$article->title ?? ''}}</h1> --}}
                <h1>Title</h1>
                <p>20-02-2020 / By Ahmed Abdullah</p>
            </div>
        </div>
        <div class="container">
            <div class="ps-post__content">
                {{-- {!! $article->body ?? ''!!} --}}
                Body
            </div>
            <div class="ps-post__footer">
                <div class="ps-post__social">

                    <style>
                        .ps-post--detail .ps-post__social a {
                            position: relative;
                            display: inline-block;
                            width: 35px !important;
                            height: 45px;
                            margin-right: 0px !important;
                            vertical-align: top;
                        }
                    </style>
                    <!-- AddToAny BEGIN -->
                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                        {{-- <a class="a2a_dd" href="https://www.addtoany.com/share"></a> --}}
                        <a class="a2a_button_facebook"></a>
                        <a class="a2a_button_whatsapp"></a>
                        <a class="a2a_button_twitter"></a>
                        <a class="a2a_button_outlook_com"></a>
                        <a class="a2a_button_sms"></a>
                        <a class="a2a_button_pocket"></a>
                        <a class="a2a_button_email"></a>
                        <a class="a2a_button_reddit"></a>
                    </div>
                    <script async src="https://static.addtoany.com/menu/page.js"></script>
                    <!-- AddToAny END -->
                    {{-- <a class="facebook" href="#"><i class="fa fa-facebook"></i></a><a class="twitter" href="#"><i class="fa fa-twitter"></i></a><a class="google" href="#"><i class="fa fa-google-plus"></i></a><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a><a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a> --}}
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        {{-- <div class="ps-related-posts">
            <h3>{{request()->segment(2) == 'article' || request()->segment(2) == 'articles'?  __('lang.latest-articles') : __('lang.latest-syndicate-news')}}
            </h3>
            <div class="row">

                @forelse ($topArticles as $article)
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 ">
                    <div class="ps-post">
                        <div class="ps-post__thumbnail">
                            <a class="ps-post__overlay" href="{{ route('website.article', $article->id) }}"></a><img
                                src="{{ asset('uploads/images/thumbnail/' . $article->photo) }}"
                                alt="{{ $article->title ?? '' }}">
                        </div>
                        <div class="ps-post__content">
                            <div class="ps-post__top">
                                <div class="ps-post__meta">
                                </div>
                                <a class="ps-post__title"
                                    href="{{ route('website.article', $article->id) }}">{{ $article->title ?? '' }}</a>
                            </div>
                            <div class="ps-post__bottom">
                                <p>{{$article->created_at->diffForHumans() ?? ''}} / @lang('lang.by')
                                    {{$article->user->userable->name ?? ''}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @empty

                @endforelse
            </div>
        </div> --}}
    </div>
</div>

@endsection
