<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    @yield('meta')
    <title>{{ config('app.name') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{asset('website/css/bootstrap.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('website/css/style.css')}}" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('website/css/font-awesome.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('website/css/font-awesome5.css')}}" />
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="icon" href="https://ozooma.net/aleefak/wp-content/uploads/2020/08/Aleefak-Favicon-65x65.png" sizes="32x32" />
    <link rel="icon" href="{{ asset('uploads/images/original/'.$settings->where('key', 'favicon')->first()->value) }}" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('uploads/images/original/'.$settings->where('key', 'favicon')->first()->value) }}" />
    <meta name="msapplication-TileImage" content="{{ asset('uploads/images/original/'.$settings->where('key', 'favicon')->first()->value) }}" />

    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('website/css/jquery.datetimepicker.css')}}" />
    <link href="{{asset('website/css/bootsnav.css')}}" rel="stylesheet">
    <link href="{{asset('website/assets/revolution-slider/css/settings.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('website/css/owl.carousel.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('website/css/owl.theme.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('website/css/owl.transitions.css')}}" />
    <script type="text/javascript" src="{{asset('website/js/modernizr-2.6.2.min.js')}}"></script>
    @yield('links')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! htmlScriptTagJsApi() !!}
    <link rel="shortcut icon" href="{{ asset('uploads/images/original/'.$settings->where('key', 'favicon')->first()->value) }}">

    <!--Files arabic Styles-->
    @if (request()->segment(1) == 'ar')
    <link rel="stylesheet" href="{{asset('website/css/rtl.css')}}">
    @else
    @endif
    @php
    $primaryBg = $settings->where('key', 'primary_bg')->first()->value;
    $primaryHover = $settings->where('key', 'primary_hover')->first()->value;
    @endphp

    <style>
        :root {
            --white: #fff;

            --primary-bg: <?php echo $primaryBg ?>;

            --primary-hover: <?php echo $primaryHover ?>;

            /* --primary-border: #678804;
                --primary-shadow: #2a380183;
                --secondary-bg: coral;
                --secondary-hover: coral;
                --secondary-border: coral;
                --secondary-shadow: coral;
                --primary: red; */
        }
    </style>

</head>

<body>

    @include('website.layouts.header')
    @yield('content')
    @include('website.layouts.footer')




    <script src="{{asset('website/js/jquery-3.1.0.min.js')}}" type="text/jscript"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="{{asset('website/js/bootstrap.js')}}" type="text/jscript"></script>
    <script src="{{asset('website/assets/revolution-slider/js/jquery.themepunch.plugins.min.js')}}"></script>
    <script src="{{asset('website/assets/revolution-slider/js/jquery.themepunch.revolution.js')}}"></script>
    <script src="{{asset('website/assets/js/site.js')}}"></script>
    <script src="{{asset('website/js/bootsnav.js')}}"></script>

    <script>
        $(".dc-forgot-password").click(function() {
                $(".do-login-form").hide();
                $(".do-forgot-password-form").show();
            });


            $(".dc-show-login").click(function() {
                $(".do-forgot-password-form").hide();
                $(".do-login-form").show();
            });
    </script>

    <script>
        $(window).preloader({ delay: 1500 });
    </script>
    <script>
        // ajaxBtnAction
            $(document).ready(function(){
                $(".ajaxBtnAction").click(function(){

                    var url = $(this).attr('hrefAjax');
                    var resultAjax = $(this).attr('resultAjax');

                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(result){

                            Swal.fire({
                                title: result.msg,
                                icon: result.iconAlert,
                            });

                            $(resultAjax).html(result.icon)
                            $(result.for).html(result.count)
                    }});
                });

                $(".ajaxAddToCart").click(function(){

                    var url = $(this).attr('hrefAjax');
                    var resultAjax = $(this).attr('resultAjax');
                    var distributorID = $(this).attr('distributorID');

                    $.ajax({
                        type: "GET",
                        url: url,
                        data: {distributor_id:distributorID},
                        success: function(result){

                            Swal.fire({
                                title: result.msg,
                                icon: result.iconAlert,
                            });

                            $(resultAjax).html(result.icon)
                            $(result.for).html(result.count)
                    }});
                });

                $(".quantity").on('change' ,function(){
                    // qua  ntity-up
                    // var targetID = $(this).attr('targetID');
                    // var productID = $(this).attr('productID');
                    var url = $(this).attr('quantityUrl');
                    var targetVal = $(this).val();
                    var id = $(this).attr('id');

                    $.ajax({
                        type: "GET",
                        url: url,
                        data: {quantity:targetVal},
                        success: function(result){
                            $('.total-' + id).html(result.total);
                            $('.quantity-' + id).html(targetVal);
                        }});



                });

            });
    </script>

    <script>
        // ajaxBtnAction
            // function incrments() {
            //     quantity-up
            //     var targetID = $(this).attr('targetID');
            //     var targetVal = $(targetID).val();
            //     $(targetID).val(++targetVal);
            //     alert(targetID);

            // }

    </script>
    @auth

    <audio id="NotificationAudio" src="{{asset('uploads/audio/audio_file.mp3')}}">
    </audio>
    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
    <script>
        $(document).ready(function(){

                        // Enable pusher logging - don't include this in production
                        Pusher.logToConsole = true;

                        var pusher = new Pusher('70e04be25ef5a9f0f25a', {
                            cluster: 'mt1',
                            forceTLS: true,
                            // sound : 'default',


                        });

                        var channel = pusher.subscribe('notifications-admin');
                        channel.bind('{{$typeUser ?? ''}}', function(data) {
                            // alert(JSON.stringify(data));
                            var count = $('.notification_count').html();
                            var html = $('.notification_html').html();

                            $('.notification_count').html(++count);
                            $('.notification_html').html(data.data + html);

                            var audio = document.getElementById("NotificationAudio");
                            audio.play();
                        });

                    });
    </script>

    <script>
        // $(document).ready(function(){

                //     $('img').onerror( function() {
                //         $(this).attr('src', 'uploads/images/thumbnail/1587069738_82586.jpg');
                //     });

                // });
    </script>
    @if (auth()->user()->type == '1')
    <script>
        $( document ).ready(function() {
                    $('.q-modal.fade').fadeIn().addClass('show');
                    $('.close').click(function(){
                        $('.q-modal.fade').fadeOut().removeClass('show');
                    });
                });
    </script>
    @endif
    @endauth

    @yield('scripts')
    <script>
        // onerror=
            $(document).ready(function(){
                $('img').attr('onerror',"this.onerror=null;this.src='{{asset('uploads/images/thumbnail/notfound_0.png')}}';")
            });
    </script>
</body>

</html>
