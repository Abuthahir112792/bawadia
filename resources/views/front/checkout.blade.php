@extends('front.layouts.app')

@section('title')
    {{ __('BAWADI | HOME') }}
@stop
@section('content')
<body>
  <!-- main container of all the page elements -->  
  <div id="wrapper">
    <!-- Page Loader -->
    <div id="pre-loader" class="loader-container">
      <div class="loader">
        <img src="{{asset('fronts/images/svg/rings.svg')}}" alt="loader">
      </div>
    </div>
    <div class="w1">
      <!-- mt -header style14 start from here -->
      <header class="style14" id="mt-header">
        <!-- mt top bar start from here -->
        <div class="mt-top-bar">
          <div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-6 hidden-xs">
                <span class="tel"> <i class="fa fa-phone" aria-hidden="true"></i> +1 (555) 333 22 11</span>
              </div>
              <div class="col-xs-12 col-sm-6 text-right">
                <!-- mt top lang start from here -->  
                
                <!-- mt top lang end from here -->  
                <span class="account"><a href="{{route('front.customerlogin')}}">Login</a> or <a href="{{route('front.customerregister')}}">Create Account</a></span>
              </div>
            </div>
          </div>
        </div><!-- mt top bar end here -->
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <!-- mt bottom bar start from here -->
              <div class="mt-bottom-bar">
                <!-- mt logo start from here -->
                <div class="mt-logo"><a href="#"><img alt="schon" src="{{asset('fronts/images/mt-logo.png')}}"></a></div>
                <!-- mt icon list start from here -->
                <ul class="mt-icon-list">
                  <li><a class="icon-magnifier" href="#"></a></li>
                  <li class="drop">
										<a href="#" class="icon-heart cart-opener"><span style="margin-bottom: -3px;" class="num">3</span></a>
										<!-- mt drop start here -->
										<div class="mt-drop">
											<!-- mt drop sub start here -->
											<div class="mt-drop-sub">
												<!-- mt side widget start here -->
												<div class="mt-side-widget">
													<!-- cart row start here -->
													<div class="cart-row">
														<a href="#" class="img"><img src="{{asset('fronts/images/sq/product1_img/AZRAG.jpg')}}" alt="image" class="img-responsive"></a>
														<div class="mt-h">
															<span class="mt-h-title"><a href="#">AZRAG</a></span>
															<span class="price">QR 599,00</span>
														</div>
														<a href="#" class="close fa fa-times"></a>
													</div><!-- cart row end here -->
													<!-- cart row start here -->
													<div class="cart-row">
														<a href="#" class="img"><img src="{{asset('fronts/images/sq/product4_img/NAKHWA.jpg')}}" alt="image" class="img-responsive"></a>
														<div class="mt-h">
															<span class="mt-h-title"><a href="#">NAKHWA</a></span>
															<span class="price">QR 599,00</span>
														</div>
														<a href="#" class="close fa fa-times"></a>
													</div><!-- cart row end here -->
													<!-- cart row start here -->
													<div class="cart-row">
														<a href="#" class="img"><img src="{{asset('fronts/images/sq/product3_img/ALGHEED.jpg')}}" alt="image" class="img-responsive"></a>
														<div class="mt-h">
															<span class="mt-h-title"><a href="#">ALGHEED</a></span>
															<span class="price">QR 599,00</span>
														</div>
														<a href="#" class="close fa fa-times"></a>
													</div><!-- cart row end here -->
													<!-- cart row total start here -->
													<div class="cart-btn-row">
														<a href="{{route('front.wishlist')}}" class="btn-type2">ALL ITEM</a>
														<a href="{{route('front.shoppingcart')}}" class="btn-type3">ADD TO CART</a>
													</div>
													<!-- cart row total end here -->
												</div><!-- mt side widget end here -->
											</div>
											<!-- mt drop sub end here -->
										</div><!-- mt drop end here -->
										<span class="mt-mdropover"></span>
									</li>
                  <li class="drop">
                    <a class="cart-opener" href="#">
                      <span class="icon-handbag"></span>
                      <span class="num">3</span>
                    </a>
                      <!-- mt drop start here -->
                    <div class="mt-drop">
                      <!-- mt drop sub start here -->
                      <div class="mt-drop-sub">
                        <!-- mt side widget start here -->
                        <div class="mt-side-widget">
                          <!-- cart row start here -->
                          <div class="cart-row">
                            <a href="#" class="img"><img src="{{asset('fronts/images/sq/product1_img/AZRAG.jpg')}}" alt="image" class="img-responsive"></a>
                            <div class="mt-h">
                              <span class="mt-h-title"><a href="#">AZRAG</a></span>
                              <span class="price">QR 599,00</span>
                              <span class="mt-h-title">Qty: 1</span>
                            </div>
                            <a href="#" class="close fa fa-times"></a>
                          </div><!-- cart row end here -->
                          <!-- cart row start here -->
                          <div class="cart-row">
                            <a href="#" class="img"><img src="{{asset('fronts/images/sq/product2_img/MUSK.jpg')}}" alt="image" class="img-responsive"></a>
                            <div class="mt-h">
                              <span class="mt-h-title"><a href="#">MUSK</a></span>
                              <span class="price">QR 599,00</span>
                              <span class="mt-h-title">Qty: 1</span>
                            </div>
                            <a href="#" class="close fa fa-times"></a>
                          </div><!-- cart row end here -->
                          <!-- cart row start here -->
                          <div class="cart-row">
                            <a href="#" class="img"><img src="{{asset('fronts/images/sq/product3_img/JEFOUL.jpg')}}" alt="image" class="img-responsive"></a>
                            <div class="mt-h">
                              <span class="mt-h-title"><a href="#">JEFOUL</a></span>
                              <span class="price">QR 599,00</span>
                              <span class="mt-h-title">Qty: 1</span>
                            </div>
                            <a href="#" class="close fa fa-times"></a>
                          </div><!-- cart row end here -->
                          <!-- cart row total start here -->
                          <div class="cart-row-total">
                            <span class="mt-total">Sub Total</span>
                            <span class="mt-total-txt">QR 799,00</span>
                          </div>
                          <!-- cart row total end here -->
                          <div class="cart-btn-row">
														<a href="{{route('front.shoppingcart')}}" class="btn-type2">VIEW CART</a>
														<a href="{{route('front.checkout')}}" class="btn-type3">CHECKOUT</a>
													</div>
                        </div>
                        <!-- mt side widget end here -->
                      </div>
                      <!-- mt drop sub end here -->
                    </div><!-- mt drop end here -->
                    <span class="mt-mdropover"></span>
                  </li>
                  <li class="hidden-md hidden-lg">
                    <a href="#" class="bar-opener big mobile-toggle">
                      <span class="bar"></span>
                      <span class="bar small"></span>
                      <span class="bar"></span>
                    </a>
                  </li>
                </ul><!-- mt icon list end here -->
                <!-- navigation start here -->
                <nav id="nav">
									<ul>
										<li><a href="{{route('front.homes')}}">HOME</a></li>
										<li><a href="{{route('front.aboutus')}}">ABOUT US</a></li>
										<li class="droplink"><a  href="{{route('front.product')}}">PRODUCTS <i class="fa fa-angle-down" aria-hidden="true"></i></a>
											<div class="subnav-content">
											<ul >
												<li><a href="{{route('front.productdetails')}}">WALAH</a></li>
												<li><a href="{{route('front.productdetails')}}">NAKHWA</a></li>
												<li><a href="{{route('front.productdetails')}}">JEFOUL</a></li>
												<li><a href="{{route('front.productdetails')}}">MUSK</a></li>
												<li><a href="{{route('front.productdetails')}}">AZRAG</a></li>
												<li><a href="{{route('front.productdetails')}}">LOTION- UNISEX</a></li>
												<li><a href="{{route('front.productdetails')}}">MUATTAR - UNISEX</a></li>
												<li><a href="{{route('front.productdetails')}}">OUD</a></li>
												<li><a href="{{route('front.productdetails')}}">TAIF</a></li>
												<li><a href="{{route('front.productdetails')}}">ALGHEED</a></li>
												<li><a href="{{route('front.productdetails')}}">KARAM</a></li>
											</ul>
											</div>
										</li>
										<li><a href="{{route('front.contactus')}}">CONTACT US</a></li>
									</ul>
								</nav><!-- navigation end here -->
              </div><!-- mt bottom bar end here -->
            </div>
          </div>
        </div>
        <span class="mt-side-over"></span>
      </header><!-- mt -header style14 end here -->
      <!-- mt search popup start here -->
      <div class="mt-search-popup">
        <div class="mt-holder">
          <a href="#" class="search-close"><span></span><span></span></a>
          <div class="mt-frame">
            <form action="#">
              <fieldset>
                <input type="text" placeholder="Search...">
                <span class="icon-microphone"></span>
                <button class="icon-magnifier" type="submit"></button>
              </fieldset>
            </form>
          </div>
        </div>
      </div><!-- mt search popup end here -->
<!-- Main of the Page -->
<main id="mt-main">
    <section class="mt-contact-banner mt-banner-22 wow fadeInUp" data-wow-delay="0.4s" style="background-image: url(../fronts/images/sq/banner/banner2.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <h1 class="text-center"  style="color: #00269a;">CHECK OUT</h1>
            <!-- Breadcrumbs of the Page -->
            <nav class="breadcrumbs">
              <ul class="list-unstyled">
                <li><a href="{{route('front.homes')}}">Home <i class="fa fa-angle-right"></i></a></li>
                <li>Check Out</li>
              </ul>
            </nav>
            <!-- Breadcrumbs of the Page end -->
          </div>
        </div>
      </div>
    </section>
    <!-- Mt Process Section of the Page -->
    <div class="mt-process-sec wow fadeInUp" data-wow-delay="0.4s">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <!-- Process List of the Page -->
            <ul class="list-unstyled process-list">
              <li class="active">
                <span class="counter">01</span>
                <strong class="title">Shopping Cart</strong>
              </li>
              <li class="active">
                <span class="counter">02</span>
                <strong class="title">Check Out</strong>
              </li>
              <li>
                <span class="counter">03</span>
                <strong class="title">Order Complete</strong>
              </li>
            </ul>
            <!-- Process List of the Page end -->
          </div>
        </div>
      </div>
    </div><!-- Mt Process Section of the Page end -->
    <!-- Mt Detail Section of the Page -->
    <section class="mt-detail-sec toppadding-zero wow fadeInUp" data-wow-delay="0.4s">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <h2>BILLING DETAILS</h2>
            <!-- Bill Detail of the Page -->
            <form action="#" class="bill-detail">
              <fieldset>
                <div class="form-group">
                  <select class="form-control">
                    <option value="1">Select Country</option>
                  </select>
                </div>
                <div class="form-group">
                  <div class="col">
                    <input type="text" class="form-control" placeholder="Name">
                  </div>
                  <div class="col">
                    <input type="text" class="form-control" placeholder="Last Name">
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Company Name">
                </div>
                <div class="form-group">
                  <textarea class="form-control" placeholder="Address"></textarea>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Town / City">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="State / Country">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Postcode / Zip">
                </div>
                <div class="form-group">
                  <div class="col">
                    <input type="email" class="form-control" placeholder="Email Address">
                  </div>
                  <div class="col">
                    <input type="tel" class="form-control" placeholder="Phone Number">
                  </div>
                </div>
                <div class="form-group">
                  <input type="checkbox"> Ship to a different address?
                </div>
                <div class="form-group">
                  <textarea class="form-control" placeholder="Order Notes"></textarea>
                </div>
              </fieldset>
            </form>
            <!-- Bill Detail of the Page end -->
          </div>
          <div class="col-xs-12 col-sm-6">
            <div class="holder">
              <h2>YOUR ORDER</h2>
              <ul class="list-unstyled block">
                <li>
                  <div class="txt-holder">
                    <div class="text-wrap pull-left">
                      <strong class="title">PRODUCTS</strong>
                      <span>Marvelous Modern 3 Seater       x1</span>
                      <span>Bombi Chair    x1</span>
                    </div>
                    <div class="text-wrap txt text-right pull-right">
                      <strong class="title">TOTALS</strong>
                      <span>QR 299,00</span>
                      <span>QR 532,00</span>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="txt-holder">
                    <strong class="title sub-title pull-left">CART SUBTOTAL</strong>
                    <div class="txt pull-right">
                      <span>QR 532,00</span>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="txt-holder">
                    <strong class="title sub-title pull-left">SHIPPING</strong>
                    <div class="txt pull-right">
                      <span>Free Shipping</span>
                    </div>
                  </div>
                </li>
                <li style="border-bottom: none;">
                  <div class="txt-holder">
                    <strong class="title sub-title pull-left">ORDER TOTAL</strong>
                    <div class="txt pull-right">
                      <span>QR 1299,00</span>
                    </div>
                  </div>
                </li>
              </ul>
              <h2>PAYMENT METHODS</h2>
              <!-- Panel Group of the Page -->
              <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <!-- Panel Panel Default of the Page -->
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        DIRECT BANK TRANSFER
                        <span class="check"><i class="fa fa-check"></i></span>
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                      <p>Make your payment directly into our bank account. Please use your order id as the payment reference. Your order wont be shippided until the funds have cleared in our account</p>
                    </div>
                  </div>
                </div>
                <!-- Panel Panel Default of the Page end -->
                <!-- Panel Panel Default of the Page -->
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        CHEQUE PAYMENT
                        <span class="check"><i class="fa fa-check"></i></span>
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                      <p>Make your payment directly into our bank account. Please use your order id as the payment reference. Your order wont be shippided until the funds have cleared in our account</p>
                    </div>
                  </div>
                </div>
                <!-- Panel Panel Default of the Page end -->
                <!-- Panel Panel Default of the Page -->
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        PAYPAL
                        <span class="check"><i class="fa fa-check"></i></span>
                      </a>
                    </h4>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                      <p>Make your payment directly into our bank account. Please use your order id as the payment reference. Your order wont be shippided until the funds have cleared in our account</p>
                    </div>
                  </div>
                </div>
                <!-- Panel Panel Default of the Page end -->
              </div>
              <!-- Panel Group of the Page end -->
            </div>
            <div class="block-holder">
              <input type="checkbox" checked> I’ve read &amp; accept the <a href="#">terms &amp; conditions</a>
            </div>
            <a href="#" class="process-btn" style="background-color: #00269a;">PROCEED TO CHECKOUT <i class="fa fa-check"></i></a>
          </div>
        </div>
      </div>
    </section>
    <!-- Mt Detail Section of the Page end -->
  </main><!-- Main of the Page end here -->
	@stop
@section('javascript')

@stop
@section('footer')
@include('front.layouts.footer')
@stop
