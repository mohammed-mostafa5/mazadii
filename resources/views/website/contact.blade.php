@extends('website.layouts.app')
@section('meta')
<meta name="keywords" content="{{isset($page->metas)? $page->metas->keywords : ''}}">
<meta name="title" content="{{isset($page->metas)? $page->metas->title : ''}}">
<meta name="description" content="{{isset($page->metas)? $page->metas->title : ''}}">
@endsection
@section('content')

<div class="ps-page--single" id="contact-us">

    <div class="ps-contact-info">
        <div class="container">
            {{-- Showing Validation Errors --}}
            @if(count($errors) > 0)
            <div class="row pb-30">
                <div class="col-md-4 col-md-offset-4 error alert-danger m-auto p-5">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            {{-- End Showing Validation Errors --}}
            <div class="ps-section__header">
                <h3>@lang('lang.contact-title')</h3>
            </div>
            <div class="ps-section__content">

                <div class="row">
                    @forelse ($informations as $info)
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 ">
                            <div class="ps-block--contact-info">
                                <h4>{{ $info->name ?? ''}}</h4>
                                <p>{!! $info->value ?? '' !!}</p>
                            </div>
                        </div>
                    @empty
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 ">
                            <div class="ps-block--contact-info">
                                <h4>Contact Directly</h4>
                                <p><a href="#">contact@martfury.com</a><span>(+004) 912-3548-07</span></p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 ">
                            <div class="ps-block--contact-info">
                                <h4>Head Quater</h4>
                                <p><span>17 Queen St, Southbank, Melbourne 10560, Australia</span></p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 ">
                            <div class="ps-block--contact-info">
                                <h4>Work With Us</h4>
                                <p><span>Send your CV to our email:</span><a href="#">career@martfury.com</a></p>
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
    <div class="ps-contact-form">
        <div class="container">
            <form class="ps-form--contact-us" action="{{route('website.contact.post')}}" method="post">
                @csrf
                <h3>@lang('lang.contact-form-title')</h3>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                        <div class="form-group">
                            <input class="form-control" name="name" type="text" placeholder="@lang('lang.name') *">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                        <div class="form-group">
                            <input class="form-control" name="email" type="text" placeholder="@lang('lang.email') *">
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <div class="form-group">
                            <input class="form-control" name="subject" type="text"
                                placeholder="@lang('lang.subject') *">
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="5"
                                placeholder="@lang('lang.message')"></textarea>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <div class="form-group">
                            {!! htmlFormSnippet() !!}
                        </div>
                    </div>
                </div>
                <div class="form-group submit">
                    <button class="ps-btn">@lang('lang.send')</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="dc-breadcrumbarea" style="background:#ffffff">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ol class="dc-breadcrumb">
                    <li class="dc-item-home"><a href="https://ozooma.net/aleefak" title="Home">Home</a></li>
                    <li class="dc-item-current dc-item-117"><span class="dc-bread-current bread-117"> About Us</span></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<main id="dc-main" class="dc-main dc-haslayout">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="dc-welcomecontent">
                    <div class="dc-title">
                        <h3>
                            <span>Always Get In Touch</span>Our Contact Details
                        </h3>
                    </div>
                    <div class="dc-description dc-paddingr">
                        <p>We are happy to hear form you and ready for any kind of support,</p>
                        <p>Just contact us</p>
                    </div>
                    <div class="dc-contactinfo dc-floatclear">
                        <ul>
                            <li><span><span class="fa fa-map-marker"></span>6 Qunswa El Ghory – First SettlementNew Cairo – Cairo – Egypt.</span>
                            </li>
                            <li><span class="fa fa-envelope"></span>info@aleefak.com</li>
                            <li><span class="fa fa-phone"></span>+20 100 500 7080</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xs-12">
                <iframe frameborder="0" scrolling="no" marginheight="0" height="360px" marginwidth="0" src="https://maps.google.com/maps?q=Cairo%20%E2%80%93%20Egypt&amp;t=m&amp;z=10&amp;output=embed&amp;iwloc=near" aria-label="Cairo – Egypt"></iframe>
            </div>

            <div class="clearfix"></div>

            <div class="contact-form">
                <div class="col-12 col-sm-12 col-md-8 col-md-offset-2 sec-pad">
                    <div class="dc-sectionhead dc-text-center dc-pnone">
                        <div class="dc-sectiontitle">
                            <h2>
                                <span>Get In Touch With Us</span> Say <em>Hello To Us</em>
                            </h2>
                        </div>
                        <div class="dc-description">
                            <p>Lorem ipsum dolor amet consectetur adipisicing eliteiuim sete eiusmod tempor incididunt ut labore etnalom dolore magna aliqua udiminimate veniam quis norud.</p>
                        </div>
                    </div>
                    <div class="dc-form dc-floatclear dc-form-first">
                        <div role="form" class="wpcf7" id="wpcf7-f219-p1404-o1" lang="en-US" dir="ltr">
                            <form class="wpcf7-form init"  novalidate="novalidate" action="{{route('website.contact.post')}}" method="post">
                                @csrf
                                <h3>@lang('lang.contact-form-title')</h3>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                        <div class="form-group">
                                            <input class="form-control" name="name" type="text" placeholder="@lang('lang.name') *">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                        <div class="form-group">
                                            <input class="form-control" name="email" type="text" placeholder="@lang('lang.email') *">
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                        <div class="form-group">
                                            <input class="form-control" name="subject" type="text"
                                                placeholder="@lang('lang.subject') *">
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                        <div class="form-group">
                                            <textarea class="form-control" name="message" rows="5"
                                                placeholder="@lang('lang.message')"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                        <div class="form-group">
                                            {!! htmlFormSnippet() !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group submit">
                                    <button class="ps-btn">@lang('lang.send')</button>
                                </div>
                            </form>

                            {{-- <form action="#" method="post" class="wpcf7-form init" novalidate="novalidate">
                                <div style="display: none;">
                                    <input type="hidden" name="_wpcf7" value="219">
                                    <input type="hidden" name="_wpcf7_version" value="5.2.1">
                                    <input type="hidden" name="_wpcf7_locale" value="en_US">
                                    <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f219-p1404-o1">
                                    <input type="hidden" name="_wpcf7_container_post" value="1404">
                                    <input type="hidden" name="_wpcf7_posted_data_hash" value="">
                                </div>
                                <div class="form-row">
                                    <div class=" col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <span class="wpcf7-form-control-wrap text-621"><input type="text" name="text-621" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" aria-required="true" aria-invalid="false" placeholder="Your Name*"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class=" col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <span class="wpcf7-form-control-wrap email-322"><input type="email" name="email-322" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email form-control" aria-required="true" aria-invalid="false" placeholder="Your Email*"></span>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class=" col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <span class="wpcf7-form-control-wrap textarea-718"><textarea name="textarea-718" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required form-control" aria-required="true" aria-invalid="false" placeholder="Type Your Query*"></textarea></span>
                                        </div>


                                        <p><input type="submit" value="Send Now" class="wpcf7-form-control wpcf7-submit btn dc-btns btn-block dc-btnactive"><span class="ajax-loader"></span></p>

                                        <div class="wpcf7-response-output" role="alert" aria-hidden="true"></div>
                                    </div>
                                </div>
                            </form> --}}
                        </div>
                    </div>
                </div>


            </div>


        </div>



    </div>
</main>
@endsection
