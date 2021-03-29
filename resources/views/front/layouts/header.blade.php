<body>
	<!-- main container of all the page elements -->
	<div id="wrapper">
		<!-- Page Loader -->
    <div id="pre-loader" class="loader-container">
      <div class="loader">
        <img src="{{asset('fronts/images/svg/rings.svg')}}" alt="loader">
      </div>
    </div>
		<!-- W1 start here -->
		<div class="w1">
<!-- mt header style4 start here -->
<header id="mt-header" class="style4">
				<!-- mt bottom bar start here -->
				<div class="mt-bottom-bar">
					<div class="container-fluid">
						<div class="row">
							<div class="col-xs-12">
								<!-- mt logo start here -->
								<div class="mt-logo"><a href="#"><img src="{{asset('fronts/images/mt-logo.png')}}" alt="schon"></a></div>
								<!-- mt icon list start here -->
								<ul class="mt-icon-list">
									<li class="hidden-lg hidden-md">
										<a href="#" class="bar-opener mobile-toggle">
											<span class="bar"></span>
											<span class="bar small"></span>
											<span class="bar"></span>
										</a>
									</li>
									<li><a href="#" class="icon-magnifier"></a></li>
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
										<a href="#" class="cart-opener">
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
														<a href="#" class="img"><img src="{{asset('fronts/images/sq/product4_img/GANNEDNI.jpg')}}" alt="image" class="img-responsive"></a>
														<div class="mt-h">
															<span class="mt-h-title"><a href="#">GANNEDNI</a></span>
															<span class="price">QR 599,00</span>
															<span class="mt-h-title">Qty: 1</span>
														</div>
														<a href="#" class="close fa fa-times"></a>
													</div><!-- cart row end here -->
													<!-- cart row start here -->
													<div class="cart-row">
														<a href="#" class="img"><img src="{{asset('fronts/images/sq/product5_img/AZRAG.jpg')}}" alt="image" class="img-responsive"></a>
														<div class="mt-h">
															<span class="mt-h-title"><a href="#">AZRAG</a></span>
															<span class="price">QR 599,00</span>
															<span class="mt-h-title">Qty: 1</span>
														</div>
														<a href="#" class="close fa fa-times"></a>
													</div><!-- cart row end here -->
													<!-- cart row start here -->
													<div class="cart-row">
														<a href="#" class="img"><img src="{{asset('fronts/images/sq/product6_img/bawadi_web_SITE-31.jpg')}}" alt="image" class="img-responsive"></a>
														<div class="mt-h">
															<span class="mt-h-title"><a href="#">LOTION- UNISEX</a></span>
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
												</div><!-- mt side widget end here -->
											</div>
											<!-- mt drop sub end here -->
										</div><!-- mt drop end here -->
										<span class="mt-mdropover"></span>
									</li>
									<li>
										<a href="#" class="bar-opener side-opener">
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
								</nav>
								<!-- mt icon list end here -->
							</div>
						</div>
					</div>
				</div>
				<!-- mt bottom bar end here -->
				<span class="mt-side-over"></span>
			</header><!-- mt header style4 end here -->

			<!-- mt side menu start here -->
			<div class="mt-side-menu">
				<!-- mt holder start here -->
				<div class="mt-holder">
					<a href="#" class="side-close"><span></span><span></span></a>
					<strong class="mt-side-title">MY ACCOUNT</strong>
					<!-- mt side widget start here -->
					<div class="mt-side-widget">
						<header>
							<span class="mt-side-subtitle">SIGN IN</span>
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
					<!-- mt side widget end here -->
					<div class="or-divider"><span class="txt">or</span></div>
					<!-- mt side widget start here -->
					<div class="mt-side-widget">
						<header>
							<span class="mt-side-subtitle">CREATE NEW ACCOUNT</span>
							<p>Create your very own account</p>
						</header>
						<form action="#">
							<fieldset>
								<input type="text" placeholder="Username or email address" class="input">
								<button type="submit" class="btn-type1">Register</button>
							</fieldset>
						</form>
					</div>
					<!-- mt side widget end here -->
				</div>
				<!-- mt holder end here -->
			</div><!-- mt side menu end here -->
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