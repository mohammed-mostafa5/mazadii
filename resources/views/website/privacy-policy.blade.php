@extends('website.layouts.app')
@section('meta')
<meta name="keywords" content="{{isset($page->metas)? $page->metas->keywords : ''}}">
<meta name="title" content="{{isset($page->metas)? $page->metas->title : ''}}">
<meta name="description" content="{{isset($page->metas)? $page->metas->title : ''}}">
@endsection
@section('content')

<div class="ps-page--single">

    <div class="ps-faqs">
        <div class="container">
            <div class="ps-section__header">
                <h1>{{ $page->name ?? '' }}</h1>
            </div>
            <div class="ps-section__content">
                {!! $page->content ?? '' !!}
            </div>
        </div>
    </div>

    <div class="ps-call-to-action">
        <div class="container">
            <h3>@lang('lang.how-it-works-footer')<a href="{{ route('website.contact') }}"> @lang('lang.contact')</a>
            </h3>
        </div>
    </div>
</div>

@endsection
