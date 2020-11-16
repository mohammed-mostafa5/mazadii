@extends('website.layouts.app')
@section('meta')
<meta name="keywords" content="{{isset($page->metas)? $page->metas->keywords : ''}}">
<meta name="title" content="{{isset($page->metas)? $page->metas->title : ''}}">
<meta name="description" content="{{isset($page->metas)? $page->metas->title : ''}}">
@endsection

@section('content')
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
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                <div class="main-page-wrapper">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 ">
                        <div class="dc-sectionhead dc-text-center">
                            <div class="dc-sectiontitle">
                                <h2>
                                    <span>Make A Smart Choice</span> Take A Right Step <em>For Your Life</em>
                                </h2>
                            </div>
                            <div class="dc-description">
                                <p>Lorem ipsum dolor amet consectetur adipisicing eliteiuim sete eiusmod tempor incididunt ut labore etnalom dolore magna aliqua udiminimate veniam quis norud.</p>
                            </div>
                        </div>
                    </div>

                    <div class="dc-welcome-holder dc-bksteps">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 float-left">
                            <div class="dc-welcomecontent">
                                <figure class="dc-welcomeimg"><img src="https://ozooma.net/aleefak/wp-content/uploads/2019/08/img-01-1.jpg" alt="Search Best Online"></figure>
                                <div class="dc-title">
                                    <h3><span>Search Best Online</span>Professional</h3>
                                </div>
                                <div class="dc-description">
                                    <p>Amet consectetur adipisicing eliteiuim sete eiuode tempor incididunt.&nbsp;</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 float-left">
                            <div class="dc-welcomecontent">
                                <figure class="dc-welcomeimg"><img src="https://ozooma.net/aleefak/wp-content/uploads/2019/08/img-02-1.jpg" alt="Get Instant"></figure>
                                <div class="dc-title">
                                    <h3><span>Get Instant</span>Appointment</h3>
                                </div>
                                <div class="dc-description">
                                    <p>Amet consectetur adipisicing eliteiuim sete eiuode tempor incididunt.&nbsp;</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 float-left">
                            <div class="dc-welcomecontent">
                                <figure class="dc-welcomeimg"><img src="https://ozooma.net/aleefak/wp-content/uploads/2019/08/img-03.jpg" alt="Leave Your"></figure>
                                <div class="dc-title">
                                    <h3><span>Leave Your</span>Feedback</h3>
                                </div>
                                <div class="dc-description">
                                    <p>Amet consectetur adipisicing eliteiuim sete eiuode tempor incididunt.&nbsp;</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <section class="blue-sec sec-pad">
        <div class="container">
            <div class="row">
                <div class="dc-sc-how-it-work dc-haslayout dynamic-secton-547509">
                    <div class="dc-haslayout dc-workholder" style="">
                        <div class="container">
                            <div class="row justify-content-center align-self-center">
                                <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                    <div class="dc-sectionhead dc-text-center">
                                        <div class="dc-sectiontitle">
                                            <h2>
                                                <span>We Made It Simple</span> How It <em>Works?</em>
                                            </h2>
                                        </div>
                                        <div class="dc-description">
                                            <p>Lorem ipsum dolor amet consectetur adipisicing eliteiuim sete eiusmod tempor incididunt ut labore etnalom dolore magna aliqua udiminimate veniam quis norud.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dc-haslayout dc-workdetails-holder">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="dc-workdetails ">
                                        <div class="dc-workdetail">
                                            <figure><img src="https://ozooma.net/aleefak/wp-content/uploads/2019/08/img-01-3.png" alt="Search Best Online"></figure>
                                        </div>
                                        <div class="dc-title">
                                            <span>Search Best Online</span>
                                            <h3>Professional</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="dc-workdetails dc-workdetails-border">
                                        <div class="dc-workdetail">
                                            <figure><img src="https://ozooma.net/aleefak/wp-content/uploads/2019/08/img-02-4.png" alt="SGet Instant"></figure>
                                        </div>
                                        <div class="dc-title">
                                            <span>SGet Instant</span>
                                            <h3>Appointment</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="dc-workdetails dc-workdetails-bordertwo">
                                        <div class="dc-workdetail">
                                            <figure><img src="https://ozooma.net/aleefak/wp-content/uploads/2019/08/img-03-3.png" alt="Leave Your"></figure>
                                        </div>
                                        <div class="dc-title">
                                            <span>Leave Your</span>
                                            <h3>Feedback</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>


    </section>




    <section class=" sec-pad">
        <div class="container">
            <div class="row">
                <div class=" dc-team dc-haslayout  dynamic-secton-87235">

                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                        <div class="dc-sectionhead dc-text-center">
                            <div class="dc-sectiontitle">
                                <h2>
                                    <span>Talent Behind Curtain</span> Meet <em>Our Team</em>
                                </h2>
                            </div>
                            <div class="dc-description">
                                <p>Lorem ipsum dolor amet consectetur adipisicing eliteiuim sete eiusmod tempor incididunt ut labore etnalom dolore magna aliqua udiminimate veniam quis norud.</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="dc-ourteamholder">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 float-left">
                        <div class="dc-ourteam">
                            <figure class="dc-ourteamimg"><img src="https://ozooma.net/aleefak/wp-content/uploads/2019/11/team03.jpg" alt="Maryland Nicolosi"></figure>
                            <div class="dc-ourteamcontent">
                                <div class="dc-title">
                                    <a href="#">Founder, C.E.O</a>
                                    <h3><a href="#">Maryland Nicolosi</a></h3>
                                </div>
                                <ul class="dc-simplesocialicons dc-socialiconsborder">
                                    <li class="dc-facebook"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li class="dc-twitter"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li class="dc-linkedin"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li class="dc-googleplus"><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                    <li class="dc-youtube"><a href="#"><i class="fab fa-youtube"></i></a></li>
                                    <li class="dc-instagram"><a href="#"><i class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 float-left">
                        <div class="dc-ourteam">
                            <figure class="dc-ourteamimg"><img src="https://ozooma.net/aleefak/wp-content/uploads/2019/11/team01.jpg" alt="Lawerence Scarborough"></figure>
                            <div class="dc-ourteamcontent">
                                <div class="dc-title">
                                    <a href="#">Marketing Manager</a>
                                    <h3><a href="#">Lawerence Scarborough</a></h3>
                                </div>
                                <ul class="dc-simplesocialicons dc-socialiconsborder">
                                    <li class="dc-facebook"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li class="dc-twitter"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li class="dc-linkedin"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li class="dc-googleplus"><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                    <li class="dc-youtube"><a href="#"><i class="fab fa-youtube"></i></a></li>
                                    <li class="dc-instagram"><a href="#"><i class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 float-left">
                        <div class="dc-ourteam">
                            <figure class="dc-ourteamimg"><img src="https://ozooma.net/aleefak/wp-content/uploads/2019/11/team02.jpg" alt="Lucien Grindstaff"></figure>
                            <div class="dc-ourteamcontent">
                                <div class="dc-title">
                                    <a href="#">Administrator</a>
                                    <h3><a href="#">Lucien Grindstaff</a></h3>
                                </div>
                                <ul class="dc-simplesocialicons dc-socialiconsborder">
                                    <li class="dc-facebook"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li class="dc-twitter"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li class="dc-linkedin"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li class="dc-googleplus"><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                    <li class="dc-youtube"><a href="#"><i class="fab fa-youtube"></i></a></li>
                                    <li class="dc-instagram"><a href="#"><i class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>




    <section class="blue-sec sec-pad">
        <div class="container">
            <div class="row">
                <div class="dc-feedback dc-testimonials-holder dc-haslayout dynamic-secton-108893">
                    <div class="dc-testimonials">



                        <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                            <div class="dc-testimonials-head">
                                <div class="dc-heart">
                                    <span class="dc-hearticon"><i class="fa fa-heart"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">

                            <div class="">
                                <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                                    <!-- Carousel Slides / Quotes -->
                                    <div class="carousel-inner text-center">
                                        <!-- Quote 1 -->
                                        <div class="item active">
                                            <blockquote>
                                                <div class="row">
                                                    <div class="col-md-12 ">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                                            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. !</p>
                                                        <small>Someone famous</small>
                                                    </div>
                                                </div>
                                            </blockquote>
                                        </div>
                                        <!-- Quote 2 -->
                                        <div class="item">
                                            <blockquote>
                                                <div class="row">
                                                    <div class="col-sm-8 col-sm-offset-2">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                                            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
                                                        <small>Someone famous</small>
                                                    </div>
                                                </div>
                                            </blockquote>
                                        </div>
                                        <!-- Quote 3 -->
                                        <div class="item">
                                            <blockquote>
                                                <div class="row">
                                                    <div class="col-sm-8 col-sm-offset-2">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                                            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. .</p>
                                                        <small>Someone famous</small>
                                                    </div>
                                                </div>
                                            </blockquote>
                                        </div>
                                    </div>
                                    <!-- Bottom Carousel Indicators -->
                                    <ol class="carousel-indicators">
                                        <li data-target="#quote-carousel" data-slide-to="0" class="active"><img class="img-responsive " src="https://s3.amazonaws.com/uifaces/faces/twitter/mantia/128.jpg" alt="">
                                        </li>
                                        <li data-target="#quote-carousel" data-slide-to="1"><img class="img-responsive" src="https://s3.amazonaws.com/uifaces/faces/twitter/adhamdannaway/128.jpg" alt="">
                                        </li>
                                        <li data-target="#quote-carousel" data-slide-to="2"><img class="img-responsive" src="https://s3.amazonaws.com/uifaces/faces/twitter/brad_frost/128.jpg" alt="">
                                        </li>
                                    </ol>

                                    <!-- Carousel Buttons Next/Prev -->
                                    <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
                                    <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
                                </div>

                            </div>

                        </div>


                    </div>
                </div>

            </div>

        </div>


    </section>




    <section class=" sec-pad">
        <div class="container">
            <div class="row">
                <div class=" dc-team dc-haslayout  dynamic-secton-87235">

                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                        <div class="dc-sectionhead dc-text-center">
                            <div class="dc-sectiontitle">
                                <h2>
                                    <span>We Are Proud Of Our Clients</span> Emerging <em>Clients</em>
                                </h2>
                            </div>
                            <div class="dc-description">
                                <p>Lorem ipsum dolor amet consectetur adipisicing eliteiuim sete eiusmod tempor incididunt ut labore etnalom dolore magna aliqua udiminimate veniam quis norud.</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 float-left">
                    <div class="dc-clientslogo">
                        <ul>
                            <li>
                                <a href="#"><img src="https://ozooma.net/aleefak/wp-content/uploads/2019/11/1.png" alt="Client1 "></a>
                            </li>
                            <li>
                                <a href="#"><img src="https://ozooma.net/aleefak/wp-content/uploads/2019/11/4.png" alt="Client1 "></a>
                            </li>
                            <li>
                                <a href="#"><img src="https://ozooma.net/aleefak/wp-content/uploads/2019/11/7.png" alt="Client1 "></a>
                            </li>
                            <li>
                                <a href="#"><img src="https://ozooma.net/aleefak/wp-content/uploads/2019/11/6.png" alt="Client1 "></a>
                            </li>
                            <li>
                                <a href="#"><img src="https://ozooma.net/aleefak/wp-content/uploads/2019/11/5.png" alt="Client1 "></a>
                            </li>
                            <li>
                                <a href="#"><img src="https://ozooma.net/aleefak/wp-content/uploads/2019/11/3.png" alt="Client1 "></a>
                            </li>
                            <li>
                                <a href="#"><img src="https://ozooma.net/aleefak/wp-content/uploads/2019/11/2.png" alt="Client1 "></a>
                            </li>
                            <li>
                                <a href="#"><img src="https://ozooma.net/aleefak/wp-content/uploads/2019/11/8.png" alt="Client1 "></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>



</main>


@endsection
