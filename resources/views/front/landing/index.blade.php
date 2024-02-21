<!DOCTYPE html>

<html class="no-js" lang="">



<head>

    <meta charset="utf-8" />

    <meta http-equiv="x-ua-compatible" content="ie=edge" />

    <title>{{ Helper::admininfo()->website_title }}</title>

    <meta name="description" content="" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="shortcut icon" type="image/x-icon" href="{{ Helper::admininfo()->favicon }}" />

    <link rel="stylesheet" href="{{ asset('storage/app/public/landing/css/bootstrap.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('storage/app/public/landing/css/lineicons.css') }}" />

    <link rel="stylesheet" href="{{ asset('storage/app/public/landing/css/tiny-slider.css') }}" />

    <link rel="stylesheet" href="{{ asset('storage/app/public/landing/css/animate.css') }}" />

    <link rel="stylesheet" href="{{ asset('storage/app/public/landing/css/main.css') }}" />

</head>



<body>

    <div class="preloader">

        <div class="loader">

            <div class="spinner">

                <div class="spinner-container">

                    <div class="spinner-rotator">

                        <div class="spinner-left">

                            <div class="spinner-circle"></div>

                        </div>

                        <div class="spinner-right">

                            <div class="spinner-circle"></div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <header class="header">

        <div class="navbar-area">

            <div class="container">

                <div class="row align-items-center">

                    <div class="col-lg-12">

                        <nav class="navbar navbar-expand-lg">

                            <a class="navbar-brand" href="index.html">

                                <img src="{{ Helper::image_path($settingdata->logo) }}" alt="Logo" />

                            </a>

                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                                <span class="toggler-icon"></span>

                                <span class="toggler-icon"></span>

                                <span class="toggler-icon"></span>

                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">

                                <ul id="nav" class="navbar-nav ms-auto">

                                    <li class="nav-item">

                                        <a class="page-scroll active" href="#home">Home</a>

                                    </li>

                                    <li class="nav-item">

                                        <a class="page-scroll active" href="#partners">Partners</a>

                                    </li>

                                    <li class="nav-item">

                                        <a class="page-scroll" href="#features">Features</a>

                                    </li>

                                    <li class="nav-item">

                                        <a class="page-scroll" href="#about">About</a>

                                    </li>

                                    <li class="nav-item">

                                        <a class="page-scroll" href="#pricing">Pricing</a>

                                    </li>

                                    <li class="nav-item">

                                        <a class="page-scroll" href="#testimonials">Clients</a>

                                    </li>

                                    <li class="nav-item">

                                        <a href="{{ route('home') }}">Login</a>

                                    </li>

                                </ul>

                            </div>

                        </nav>

                    </div>

                </div>

            </div>

        </div>

    </header>

    <section id="home" class="hero-section">

        <div class="container">

            <div class="row align-items-center position-relative">

                <div class="col-lg-6">

                    <div class="hero-content">

                        <h1 class="wow fadeInUp" data-wow-delay=".4s">

                            Ordering on WhatsApp Supercharged!

                        </h1>

                        <p class="wow fadeInUp" data-wow-delay=".6s">

                            Leverage WhatsApp as platform to accept orders. Create a digital menu for your Restaurant or

                            Bar. Share with your clients and let them order via Mobile

                        </p>

                        <a href="#partners" class="scroll-bottom">

                            <i class="lni lni-arrow-down"></i></a>

                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="hero-img wow fadeInUp" data-wow-delay=".5s">

                        <img src="{{ asset('storage/app/public/landing/img/hero-img.png') }}" alt="" class="w-100" />

                    </div>

                </div>

            </div>

        </div>

    </section>



    <section id="partners" class="pricing-section store-partners pt-120">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-xxl-5 col-xl-6 col-lg-8 col-md-9">

                    <div class="section-title text-center mb-35">

                        <h2 class="mb-25 wow fadeInUp" data-wow-delay=".2s">

                            Our Partners

                        </h2>

                    </div>

                </div>

            </div>

            <div class="tab-content" id="pills-tabContent">

                <div class="row">

                    @foreach($users as $user)

                    <div class="col-sm-6 col-md-4 col-lg-3 text-center mb-3">

                        <div class="partner">

                            <div class="icon">

                                <a href="{{ URL::to($user->slug)}}" class="mb-2" target="_blank">

                                    <img src="{{Helper::webinfo(@$user->id)->image}}" height="100" alt="{{$user->name}}" srcset="">

                                </a>

                            </div>

                        </div>

                        <strong><a href="{{ URL::to($user->slug)}}" target="_blank">{{$user->name}}</a></strong>

                    </div>

                    @endforeach

                </div>

            </div>

        </div>

    </section>

    <section id="features" class="feature-section pt-120">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-4 col-md-8 col-sm-10">

                    <div class="single-feature">

                        <div class="icon">

                            <i class="lni lni-mobile"></i>

                        </div>

                        <div class="content">

                            <h3>Create your menu</h3>

                            <p>

                                Create your menu directly on our platform. Update anytime. Easy And Simple.

                            </p>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4 col-md-8 col-sm-10">

                    <div class="single-feature">

                        <div class="icon">

                            <i class="lni lni-support"></i>

                        </div>

                        <div class="content">

                            <h3>Ordering via chat</h3>

                            <p>

                                You will receive the order on your WhatsApp. Continue the chat and finalize order

                            </p>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4 col-md-8 col-sm-10">

                    <div class="single-feature">

                        <div class="icon">

                            <i class="lni lni-wallet"></i>

                        </div>

                        <div class="content">

                            <h3>Payment methods</h3>

                            <p>

                                Accept Cash on Deliver or get paid directly via payment link. 20+ payment methods

                                available.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <div class="row justify-content-center">

                <div class="col-lg-4 col-md-8 col-sm-10">

                    <div class="single-feature">

                        <div class="icon">

                            <i class="lni lni-cart-full"></i>

                        </div>

                        <div class="content">

                            <h3>Jump start to ordering</h3>

                            <p>

                                Just create your menu, and next thing you know, is receiving orders on your phone via

                                WhatsApp.

                            </p>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4 col-md-8 col-sm-10">

                    <div class="single-feature">

                        <div class="icon">

                            <i class="lni lni-bar-chart"></i>

                        </div>

                        <div class="content">

                            <h3>Views & orders analytics</h3>

                            <p>

                                Get detailed report about your orders and earning. Track your business as it grows with

                                us.

                            </p>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4 col-md-8 col-sm-10">

                    <div class="single-feature">

                        <div class="icon">

                            <i class="lni lni-users"></i>

                        </div>

                        <div class="content">

                            <h3>Know your customers</h3>

                            <p>

                                You are creating a direct bound with your customers. Loyal customer, will know where to

                                find you next time.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <section id="about" class="about-section pt-150">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-xl-6 col-lg-6">

                    <div class="about-img">

                        <video class="w-45" autoplay muted loop>

                            <source src="{{ asset('storage/app/public/landing/img/phone.mp4') }}" type="video/mp4">

                        </video>

                        <img src="{{ asset('storage/app/public/landing/img/about-left-shape.svg') }}" alt="" class="shape shape-1" />

                        <img src="{{ asset('storage/app/public/landing/img/left-dots.svg') }}" alt="" class="shape shape-2" />

                    </div>

                </div>

                <div class="col-xl-6 col-lg-6">

                    <div class="about-content">

                        <div class="section-title mb-30">

                            <h2 class="mb-25 wow fadeInUp" data-wow-delay=".2s">

                                For Customers ordering

                            </h2>

                            <p class="wow fadeInUp" data-wow-delay=".4s">

                                The customer can find the link to the menu of the restaurant on Social platforms, word

                                of mouth via friend or if they scan the QR. After they make their order with the online

                                menu, they are able to send the order directly to Restaurant's WhatsApp.

                            </p>



                            <h2 class="mt-3 mb-25 wow fadeInUp" data-wow-delay=".2s">

                                For Restaurant owners

                            </h2>

                            <p class="wow fadeInUp" data-wow-delay=".4s">

                                The process starts when they hear a new message sound on their WhatsApp. They, or a

                                trained bot can ask questions for details for order and delivery address. The restaurant

                                can also inform how much time will take to deliver the order.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>



    <section id="pricing" class="pricing-section pt-120">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-xxl-5 col-xl-6 col-lg-8 col-md-9">

                    <div class="section-title text-center mb-35">

                        <h2 class="mb-25 wow fadeInUp" data-wow-delay=".2s">

                            WhatsApp Ordering Pricing

                        </h2>

                        <p class="wow fadeInUp" data-wow-delay=".4s">

                            14-day money back guarantee. Risk-free, you can cancel at anytime.

                        </p>

                    </div>

                </div>

            </div>

            <div class="tab-content" id="pills-tabContent">

                <div class="row justify-content-center">

                    @foreach ($plans as $plan)

                    <div class="col-lg-4 col-md-8 col-sm-10">

                        <div class="single-pricing">

                            <div class="pricing-header">

                                <h1 class="price">{{ Helper::currency_format($plan->price, 1) }}</h1>

                                <h3 class="package-name">{{ $plan->name }}</h3>

                                <p>{{ $plan->description }}</p>

                            </div>

                            <div class="content">

                                <ul>

                                    <li><i class="lni lni-checkmark active"></i>

                                        @if ($plan->item_unit == -1)

                                        {{ trans('labels.item_unlimited') }}

                                        @else

                                        {{ $plan->item_unit }} {{ trans('labels.item_limit') }}

                                        @endif

                                    </li>



                                    <li><i class="lni lni-checkmark active"></i>

                                        @if ($plan->item_unit == -1)

                                        {{ trans('labels.order_unlimited') }}

                                        @else

                                        {{ $plan->order_limit }} {{ trans('labels.order_limit') }}

                                        @endif

                                    </li>



                                    <?php

                                    $myString = $plan->features;

                                    $myArray = explode(',', $myString);

                                    ?>

                                    @foreach ($myArray as $features)

                                    <li><i class="lni lni-checkmark active"></i> {{ $features }}</li>

                                    @endforeach

                                </ul>

                            </div>

                            <div class="pricing-btn">

                                <a href="{{ URL::to('/admin/register') }}" class="main-btn btn-hover border-btn">Get Start</a>

                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>

            </div>

        </div>

    </section>

    <section id="testimonials" class="testimonial-section">

        <div class="container">

            <div class="section-title text-center">

                <h2 class="mb-30">What our customers says</h2>

            </div>

            <div class="testimonial-active-wrapper">

                <div class="shapes">

                    <img src="{{ asset('storage/app/public/landing/img/testimonial-shape.svg') }}" alt="" class="shape shape-1" />

                    <img src="{{ asset('storage/app/public/landing/img/testimonial-dots.svg') }}" alt="" class="shape shape-2" />

                </div>

                <div class="testimonial-active">

                    <div class="single-testimonial">

                        <div class="row">

                            <div class="col-xl-5 col-lg-5">

                                <div class="testimonial-img">

                                    <img src="{{ asset('storage/app/public/landing/img/testimonial-1.jpeg') }}" class="w-100" alt="" />

                                    <div class="quote">

                                        <i class="lni lni-quotation"></i>

                                    </div>

                                </div>

                            </div>

                            <div class="col-xl-6 offset-xl-1 col-lg-6 offset-lg-1">

                                <div class="content-wrapper">

                                    <div class="content">

                                        <p>

                                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr,

                                            sed dinonumy eirmod tempor invidunt ut labore et dolore

                                            magna aliquyam erat, sed diam voluptua. At vero eos et

                                            accusam et justo duo dolores et ea rebum. Stet clita

                                            kasd gubergren, no sea takimata sanctus est Lorem.

                                        </p>

                                    </div>

                                    <div class="info">

                                        <h4>Jonathon Smith</h4>

                                        <p>Developer and Youtuber</p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="single-testimonial">

                        <div class="row">

                            <div class="col-xl-5">

                                <div class="testimonial-img">

                                    <img src="{{ asset('storage/app/public/landing/img/testimonial-2.jpeg') }}" class="w-100" alt="" />

                                    <div class="quote">

                                        <i class="lni lni-quotation"></i>

                                    </div>

                                </div>

                            </div>

                            <div class="col-xl-6 offset-xl-1">

                                <div class="content-wrapper">

                                    <div class="content">

                                        <p>

                                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr,

                                            sed dinonumy eirmod tempor invidunt ut labore et dolore

                                            magna aliquyam erat, sed diam voluptua. At vero eos et

                                            accusam et justo duo dolores et ea rebum. Stet clita

                                            kasd gubergren, no sea takimata sanctus est Lorem.

                                        </p>

                                    </div>

                                    <div class="info">

                                        <h4>Gray Simon</h4>

                                        <p>UIX Designer and Developer</p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="single-testimonial">

                        <div class="row">

                            <div class="col-xl-5">

                                <div class="testimonial-img">

                                    <img src="{{ asset('storage/app/public/landing/img/testimonial-3.jpeg') }}" class="w-100" alt="" />

                                    <div class="quote">

                                        <i class="lni lni-quotation"></i>

                                    </div>

                                </div>

                            </div>

                            <div class="col-xl-6 offset-xl-1">

                                <div class="content-wrapper">

                                    <div class="content">

                                        <p>

                                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr,

                                            sed dinonumy eirmod tempor invidunt ut labore et dolore

                                            magna aliquyam erat, sed diam voluptua. At vero eos et

                                            accusam et justo duo dolores et ea rebum. Stet clita

                                            kasd gubergren, no sea takimata sanctus est Lorem.

                                        </p>

                                    </div>

                                    <div class="info">

                                        <h4>Michel Smith</h4>

                                        <p>Traveler and Vloger</p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>



    <footer class="footer">

        <div class="container">

            <div class="widget-wrapper">

                <div class="row">

                    <div class="col-xl-2 col-lg-2 col-md-6">



                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6">

                        <div class="footer-widget">

                            <div class="logo mb-30">

                                <h1 class="text-white">WhatsApp Ordering!</h1>

                            </div>

                            <p class="desc mb-30 text-white">

                                Ordering on WhatsApp Supercharged!

                            </p>

                            <ul class="socials text-white">

                                {{ Helper::admininfo()->copyright }}

                            </ul>

                        </div>

                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-6">



                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-6">



                    </div>

                </div>

            </div>

        </div>

    </footer>

    <a href="#" class="scroll-top btn-hover">

        <i class="lni lni-chevron-up"></i>

    </a>

    <script src="{{ asset('storage/app/public/landing/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('storage/app/public/landing/js/tiny-slider.js') }}"></script>

    <script src="{{ asset('storage/app/public/landing/js/wow.min.js') }}"></script>

    <script src="{{ asset('storage/app/public/landing/js/main.js') }}"></script>

</body>



</html>