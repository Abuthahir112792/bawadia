@extends('front.layouts.app')

@section('title')
    {{ __('BAWADI | HOME') }}
@stop
@section('header')
@include('front.layouts.header')
@stop
@section('content')
 <!-- Main of the Page -->
 <main id="mt-main">
        <!-- Mt Content Banner of the Page -->
        <section class="mt-contact-banner" style="background-image: url(../fronts/images/sq/banner/banner2.jpg);">
          <div class="container">
            <div class="row">
              <div class="col-xs-12 text-center">
                <h1 style="color: #00269a;">login</h1>
                <nav class="breadcrumbs">
                  <ul class="list-unstyled">
                    <li><a href="{{route('front.homes')}}">home <i class="fa fa-angle-right"></i></a></li>
                    <li>login</li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <!-- Mt Content Banner of the Page end -->
        <!-- Mt About Section of the Page -->
        <section class="mt-about-sec" style="padding-bottom: 0;">
          <div class="container">
            <div class="row">
              <div class="col-xs-12">
                <div class="txt">
                  <h2 style="color: #00269a;">login</h2>
                  <p>Morbi in erat malesuada, sollicitudin massa at, tristique nisl. Maecenas id eros scelerisque, vulputate tortor quis, efficitur arcu sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Umco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit sse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat <strong>Vestibulum sit amet metus euismod, condimentum lectus id, ultrices sem.</strong></p>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Mt About Section of the Page -->
        <!-- Mt Detail Section of the Page -->
        <section class="mt-detail-sec toppadding-zero">
          <div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-8 col-sm-push-2">
                <div class="holder" style="margin: 0;">
                    <div class="mt-side-widget">
                      <header>
                        <h2 style="margin: 0 0 5px;">SIGN IN</h2>
                        <p>Welcome back! Sign in to Your Account</p>
                      </header>
                      <form action="#">
                        <fieldset>
                          <input type="text" placeholder="Username or email address" class="input">
                          <input type="password" placeholder="Password" class="input">
                          <div class="box">
                            <span class="left"><input class="checkbox" type="checkbox" id="check1"><label for="check1">Remember Me</label></span>
                            <a href="#" class="help">Help?</a>
                          </div>
                          <button type="submit" class="btn-type1">Login</button>
                        </fieldset>
                      </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Mt Detail Section of the Page end -->
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <!-- banner frame start here -->
              <div class="banner-frame toppadding-zero">
                <!-- banner 5 white start here -->
                <div class="banner-5 white wow fadeInLeft" data-wow-delay="0.4s">
                  <img src="{{asset('fronts/images/sq/product1_img/AZRAG.jpg')}}" alt="image description">
                  <div class="holder">
                    <div class="texts">
                      <strong class="title">AZRAG</strong>
                      <h3 style="color: #333333;"><strong>New</strong> Collection</h3>
                      <p style="color: #333333;">Consectetur adipisicing elit. Beatae accusamus, optio, repellendus inventore</p>
                      <span class="price-add" style="color: #333333;">QR 79.00</span>
                    </div>
                  </div>
                </div><!-- banner 5 white end here -->
                <!-- banner 6 white start here -->
                
                <!-- banner box two start here -->
                <div class="banner-box two">
                  <!-- banner 7 right start here -->
                  <div class="banner-7 right wow fadeInUp" data-wow-delay="0.4s">
                    <img src="{{asset('fronts/images/sq/home_img480/bawadi_web_products_size-36.jpg')}}" alt="image description">
                    <div class="holder">
                      <h2 style="color: #ffffff;"><strong>AZRAG</strong></h2>
                      <ul class="mt-stars">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                      </ul>
                      <div class="price-tag">
                        <span class="price" style="color: #ffffff;">QR 99.00</span>
                        <a class="shop-now" href="{{route('front.productdetails')}}" style="color: #ffffff;">SHOP NOW</a>
                      </div>
                    </div>
                  </div><!-- banner 7 right end here -->
                  <!-- banner 8 start here -->
                  <div class="banner-8 wow fadeInDown" data-wow-delay="0.4s">
                    <img src="{{asset('fronts/images/sq/home_img480/bawadi_web_products_size-37.jpg')}}" alt="image description">
                    <div class="holder">
                      <h2 style="color: #ffffff;"><strong>GANNEDNI</strong></h2>
                      <ul class="mt-stars">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                      </ul>
                      <div class="price-tag">
                        <span class="price-off" style="color: #ffffff;">QR 129.00</span>
                        <span class="price" style="color: #ffffff;">QR 99.00</span>
                        <a class="btn-shop" href="{{route('front.productdetails')}}">
                          <span style="color: #ffffff;">HURRY UP!</span> 
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </div>
                  </div><!-- banner 8 start here -->
                </div>
              </div><!-- banner frame end here -->
            </div>
          </div>
        </div>
      </main><!-- Main of the Page end -->
	@stop
@section('javascript')

@stop
@section('footer')
@include('front.layouts.footer')
@stop
