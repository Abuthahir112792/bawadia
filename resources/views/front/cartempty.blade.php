@extends('front.layouts.app')

@section('title')
    {{ __('CART | PRECIOUS TRADING COMPANY') }}
@stop

@section('content')
<!-- Page Title -->
<body class="shop-account">
		<div class="offcanvas open">
			<div class="offcanvas-wrap">
				<div class="offcanvas-user clearfix">
					<a class="offcanvas-user-wishlist-link" href="tel:+974 33001656">
						<i class="fa fa-mobile" style="color: #ffffff;"></i> +974 33001656
					</a>
					<a class="offcanvas-user-account-link" href="mailto:admin@preciousqatar.com">
						<i class="fa fa-envelope" style="color: #ffffff;"></i> admin@preciousqatar.com
					</a>
				</div>
				<nav class="offcanvas-navbar">
					<ul class="offcanvas-nav">
						<li class="menu-item-has-children dropdown">
							<a href="{{route('front.home')}}" class="dropdown-hover">Home <span class="caret"></span></a>
							
						</li>
						<li><a href="{{route('front.about-us')}}">About us</a></li>
															
						<li class="menu-item-has-children dropdown">
							<a href="{{route('front.product')}}" class="dropdown-hover">Product <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li id="menu-item-10433" class="menu-item-has-children dropdown-submenu">
									<a href="{{route('front.shop')}}">FOOD AND BEVERAGE <span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href="{{route('front.shop')}}">Rice</a></li>
										<li><a href="{{route('front.shop')}}">Cashews</a></li>
									</ul>
								</li>
								<li class="menu-item-has-children dropdown-submenu">
									<a href="{{route('front.shop')}}">HEALTH AND HYGIENE <span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href="{{route('front.shop')}}">Health Care</a></li>
										<li><a href="{{route('front.shop')}}">Hygiene Products</a></li>
									</ul>
								</li>
								<li class="menu-item-has-children dropdown-submenu">
									<a href="{{route('front.product')}}">PRODUCTS <span class="caret"></span></a>
									<ul class="dropdown-menu">
									@forelse($getproduct_list as $key => $getproduct_lists)
										<li><a href="{{ route('front.productdetails', ['product_id' => $getproduct_lists->id]) }}">{{ $getproduct_lists->companyproduct_name }}</a></li>
									@empty
										<li>No Product</li>
									@endforelse
									</ul>
								</li>
								
							</ul>
						</li>
						<li><a href="{{route('front.project')}}">Project</a></li>
						<li class="menu-item-has-children dropdown">
							<a href="{{route('front.shop')}}" class="dropdown-hover">Shop <span class="caret"></span></a>
							<ul class="dropdown-menu">
							@foreach($subcatmenu as $key => $subcatmobilemenu)
								<li class="menu-item-has-children dropdown-submenu">
								<a href="{{ route('front.shop', ['category' => $subcatmobilemenu->id,'brand' => $subcatmobilemenu->brand_id]) }}" data-id="{{ $subcatmobilemenu->id }}" data-select="{{ $subcatmobilemenu->brand_id }}" class="category_id"><img src="{{ $subcatmobilemenu->categoryimage }}" alt="" width="20" height="20"/> {{$subcatmobilemenu->name}}<span class="caret"></span></a>
									<ul class="dropdown-menu">
									@foreach($subcatmobilemenu->subcategory as $subcategorymobile)
										<li><a href="{{ route('front.shop', ['subcategory' => $subcategorymobile->id,'category' => $subcategorymobile->category_id,'brand' => $subcategorymobile->brand_id]) }}" data-id="{{ $subcategorymobile->id }}" data-select="{{ $subcategorymobile->brand_id }}"  data-type="{{ $subcategorymobile->category_id }}"class="subcategory_id"><img src="{{ $subcategorymobile->sub_category_image }}" alt="" width="20" height="20"/> {{ $subcategorymobile->sub_category_name }}</a></li>
									@endforeach		
									</ul>
								</li>
							@endforeach	
							</ul>
						</li>
						<li><a href="{{route('front.contact-us')}}">Contact Us</a></li>
						
					</ul>
				</nav>
				<div class="offcanvas-widget">
					<div class="widget social-widget">
						<div class="social-widget-wrap social-widget-none">
							<a href="https://www.facebook.com/pg/precioustradingqatar/posts/" title="Facebook" target="_blank">
								<i class="fa fa-facebook facebook-bg-hover"></i>
							</a>
							<a href="https://instagram.com/precioustradingcompany?igshid=179d0mmjfb3ve" title="Instagram" target="_blank">
								<i class="fa fa-instagram instagram-bg-hover"></i>
							</a>
							<a href="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3609.698150794638!2d51.581746!3d25.2134!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe275e7032dc548c2!2sPrecious%20Trading%20Company!5e0!3m2!1sen!2sqa!4v1610285057101!5m2!1sen!2sqa" title="map" target="_blank">
								<i class="fa fa-map-marker google-plus-bg-hover"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="wrapper" class="wide-wrap">
			<div class="offcanvas-overlay"></div>
      <header class="header-type-classic">
				<div class="topbar">
					<div class="container topbar-wap">
						<div class="row">
							<div class="col-sm-6">
								<div class="left-topbar">
									<div class="topbar-social">
										<a href="https://www.facebook.com/pg/precioustradingqatar/posts/" title="Facebook" target="_blank">
											<i class="fa fa-facebook facebook-bg-hover"></i>
										</a>
										<a href="https://instagram.com/precioustradingcompany?igshid=179d0mmjfb3ve" title="Instagram" target="_blank">
											<i class="fa fa-instagram instagram-bg-hover"></i>
										</a>
										<a href="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3609.698150794638!2d51.581746!3d25.2134!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe275e7032dc548c2!2sPrecious%20Trading%20Company!5e0!3m2!1sen!2sqa!4v1610285057101!5m2!1sen!2sqa" title="map" target="_blank">
											<i class="fa fa-map-marker google-plus-bg-hover"></i>
										</a>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="right-topbar">
									<div class="user-wishlist">
										<a href="tel:+974 33001656"><i class="fa fa-mobile" style="color: #ffffff;"></i>+974 33001656</a>
									</div>
									<div class="user-login">
										<ul class="nav top-nav">
											<li class="menu-item">
												<a href="tel:+974 66751995"><i class="fa fa-phone" style="color: #ffffff;"></i>+974 66751995</a>
											</li>
										</ul>
									</div>
									<div class="language-switcher">
										<div class="wpml-languages disabled">
											<a class="active" href="mailto:admin@preciousqatar.com" >
												<i class="fa fa-envelope" style="color: #ffffff;"></i>admin@preciousqatar.com
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="navbar-container">
					<div class="navbar navbar-default  navbar-scroll-fixed">
						<div class="navbar-default-wrap" style="background-color: #ffffff;">
							<div class="container">
								<div class="row">
									<div class="col-md-12 navbar-default-col">
										<div class="navbar-wrap">
											<div class="navbar-header">
												<button type="button" class="navbar-toggle">
													<span class="sr-only">Toggle navigation</span>
													<span class="icon-bar bar-top"></span>
													<span class="icon-bar bar-middle"></span>
													<span class="icon-bar bar-bottom"></span>
												</button>
												<a class="navbar-search-button search-icon-mobile" href="#">
													<i class="fa fa-search"></i>
												</a>
												<a class="cart-icon-mobile" href="{{route('front.cartview')}}">
													<i class="elegant_icon_bag"></i><span id="item_count">0</span>
												</a>
												<a class="navbar-brand" href="{{route('front.home')}}">
													<img class="logo" alt="The DMCS" src="{{asset('front/images/logo-transparent.png')}}">
													<img class="logo-fixed" alt="The DMCS" src="{{asset('front/images/logo-fixed.png')}}">
													<img class="logo-mobile" alt="The DMCS" src="{{asset('front/images/logo-mobile.png')}}">
												</a>
											</div>
											<nav class="collapse navbar-collapse primary-navbar-collapse">
												<ul class="nav navbar-nav primary-nav">
													<li class="menu-item-has-children dropdown">
														<a href="{{route('front.home')}}" class="dropdown-hover">
															<span class="underline">Home</span> <span class="caret"></span>
														</a>
														
													</li>
													<li><a href="{{route('front.about-us')}}">About us</a></li>
													<li class="menu-item-has-children megamenu megamenu-fullwidth dropdown">
														<a href="{{route('front.product')}}" class="dropdown-hover">
															<span class="underline">Product</span> <span class="caret"></span>
														</a>
														<ul class="dropdown-menu">
															<li class="menu-item-has-children mega-col-3 dropdown-submenu">
																<h3 class="megamenu-title">
																	FOOD AND BEVERAGE<span class="caret"></span>
																</h3>
																<ul class="dropdown-menu">
																	<li><a href="{{route('front.shop')}}">Rice</a></li>
																	<li><a href="{{route('front.shop')}}">Cashews</a></li>
																</ul>
															</li>
															<li class="menu-item-has-children mega-col-3 dropdown-submenu">
																<h3 class="megamenu-title">
																	HEALTH AND HYGIENE <span class="caret"></span>
																</h3>
																<ul class="dropdown-menu">
																	<li><a href="{{route('front.shop')}}">Health Care</a></li>
																	<li><a href="{{route('front.shop')}}">Hygiene Products</a></li>
																</ul>
															</li>
															<li class="menu-item-has-children mega-col-3 dropdown-submenu">
																<h3 class="megamenu-title">
																	PRODUCTS <span class="caret"></span>
																</h3>
																<ul class="dropdown-menu">
																@forelse($getproduct_list as $key => $getproduct_lists)
																	<li><a href="{{ route('front.productdetails', ['product_id' => $getproduct_lists->id]) }}">{{ $getproduct_lists->companyproduct_name }}</a></li>
																@empty
																	<li>No Product</li>
																@endforelse
																</ul>
															</li>
															
														</ul>
													</li>
													<li><a href="{{route('front.project')}}">Project</a></li>
													<li class="menu-item-has-children megamenu megamenu-fullwidth dropdown">
														<a href="{{route('front.shop')}}" class="dropdown-hover">
															<span class="underline">shop</span> <span class="caret"></span>
														</a>
														<ul class="dropdown-menu">
														<div class="products-masonry-wrap">
														<ul class="products masonry-products row masonry-wrap" style="height:500px;overflow: scroll;">
														@foreach($subcatmenu as $key => $subcatmenudetails)
														<li class="product masonry-item col-md-3 col-sm-6 maecenas nulla">
														<figcaption>
																	<div class="shop-loop-product-info">
																		<div class="info-title">
																			<h3 class="product_title"><a href="{{ route('front.shop', ['category' => $subcatmenudetails->id,'brand' => $subcatmenudetails->brand_id]) }}" data-id="{{ $subcatmenudetails->id }}" data-select="{{ $subcatmenudetails->brand_id }}" class="category_id"><img src="{{ $subcatmenudetails->categoryimage }}" alt="" width="20" height="20"/> {{$subcatmenudetails->name}}</a></h3>
																		</div>
																		
																			<div class="info-price">
																				<span class="price" style="text-align:left">
																				@foreach($subcatmenudetails->subcategory as $subcategory)
																					<span class="amount"><a href="{{ route('front.shop', ['subcategory' => $subcategory->id,'category' => $subcategory->category_id,'brand' => $subcategory->brand_id]) }}" data-id="{{ $subcategory->id }}" data-select="{{ $subcategory->brand_id }}"  data-type="{{ $subcategory->category_id }}"class="subcategory_id"><img src="{{ $subcategory->sub_category_image }}" alt="" width="20" height="20"/> {{ $subcategory->sub_category_name }}</a></span><br><br>
																				@endforeach	
																				</span>
																			</div>
																	</div>
														</figcaption>
														</li>
														@endforeach
														</ul>
														</div>
														</ul>
													</li>
													<li><a href="{{route('front.contact-us')}}">Contact Us</a></li>
													
													<li class="navbar-search">
														<a class="navbar-search-button" href="#">
															<i class="fa fa-search"></i>
														</a>
													</li>
													<li class="navbar-minicart navbar-minicart-nav">
														<a class="minicart-link" href="{{route('front.cartview')}}">
															<span class="minicart-icon">
																<i class="minicart-icon-svg elegant_icon_bag"></i>
																<span>0</span>
															</span>
														</a>
														
													</li>
												</ul>
											</nav>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="header-search-overlay hide">
							<div class="container">
								<div class="header-search-overlay-wrap">
								<form class="searchform" action="{{ route('front.shop') }}">
										<input type="search" class="searchinput" name="search" value="" placeholder="SearchProduct..."/>
										<input type="submit" class="searchsubmit hidden" name="submit" value="Search"/>
									</form>
									<button type="button" class="close">
										<span aria-hidden="true" class="fa fa-times"></span>
										<span class="sr-only">Close</span>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
			<div class="heading-container">
				<div class="container heading-standar">
					<div class="page-breadcrumb">
						<ul class="breadcrumb">
							<li><span><a href="#" class="home"><span>Home</span></a></span></li>
							<li><span>Cart</span></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="content-container">
				<div class="container">
					<div class="row">
						<div class="col-md-12 main-wrap">
							<div class="main-content">
								<div class="shop">
									<p class="cart-empty">Your cart is currently empty.</p>
									<p class="return-to-shop">
										<a class="button wc-backward" href="{{route('front.shop')}}">Return To Shop</a>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-widget">
				<div class="container">
					<div class="footer-widget-wrap">
						<div class="row">
						<div class="footer-widget-col col-md-4 col-sm-6">
								<div class="widget widget_text">
									<h3 class="widget-title"><span>The Store</span></h3>
									<div class="textwidget">
										<p><i class="fa fa-map-marker"></i> PRECIOUS TRADING COMPANY WLL.<br>
											P.O. Box : 207282<br>  
											Showroom No. 6 Bldg، Street No. 15,<br>
											Barwa Village, Doha-Qatar</p>
										<p><i class="fa fa-phone"></i><a href="tel:+974 66751995">+974 66751995</a>, <a href="tel:+974 44322711">+974 44322711</a></p>
										<p><i class="fa fa-print"></i><a href="tel:+974 44322911">+974 44322911</a></p>
										<p><i class="fa fa-mobile"></i><a href="tel:+974 33001656">+974 33001656</a> / <a href="tel:+974 66751995">+974 66751995</a> / <a href="tel:+974 33831498">+974 33831498</a></p>
										<p>
											<i class="fa fa-envelope"></i><a href="mailto:admin@preciousqatar.com">admin@preciousqatar.com</a>
										</p>
										<p>
											<i class="fa fa-envelope"></i><a href="mailto:sales@preciousqatar.com">sales@preciousqatar.com</a>
										</p>
										
									</div>
								</div>
							</div>
							<div class="footer-widget-col col-md-2 col-sm-6">
								<div class="widget widget_nav_menu">
									<h3 class="widget-title"><span>Quick Link</span></h3>
									<ul class="menu">
										<li><a href="{{route('front.home')}}">Home</a></li>
										<li><a href="{{route('front.about-us')}}">About Us</a></li>
										<li><a href="{{route('front.product')}}">Product</a></li>
										<li><a href="{{route('front.project')}}">Project</a></li>
										<li><a href="{{route('front.shop')}}">Shop</a></li>
										<li><a href="{{route('front.contact-us')}}">Contact Us</a></li>
									</ul>
								</div>
							</div>
							<div class="footer-widget-col col-md-2 col-sm-6">
								<div class="widget widget_nav_menu">
									<h3 class="widget-title"><span>Help</span></h3>
									<ul class="menu">
										<li><a href="{{route('front.home')}}">Privacy</a></li>
										<li><a href="{{route('front.home')}}">Terms and Conditions</a></li>
										<li><a href="{{route('front.home')}}">Social Responsibility</a></li>
										<li><a href="{{route('front.home')}}">Shipping Policy</a></li>
										<li><a href="{{route('front.home')}}">Return Policy</a></li>
									</ul>
								</div>
							</div>
							<div class="footer-widget-col col-md-4 col-sm-6">
								<div class="widget widget_text">
									<h3 class="widget-title"><span>Location</span></h3>
									<div class="textwidget">
									<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3609.698150794638!2d51.581746!3d25.2134!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe275e7032dc548c2!2sPrecious%20Trading%20Company!5e0!3m2!1sen!2sqa!4v1610285057101!5m2!1sen!2sqa" width="300" height="265" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer id="footer" class="footer">
				<div class="footer-info">
					<div class="container">
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="footer-info-logo">
									<a href="#"><img alt="The DMCS" src="{{ asset('front/images/footer-logo.png')}}" style="height: 82px;"></a>
								</div>
								<div class="copyright text-center">Copyright right © 2020 PRECIOUS TRADING COMPANY WLL Theme. All Rights Reserved.</div>
								<div class="footer-social">
										<a href="https://www.facebook.com/pg/precioustradingqatar/posts/" title="Facebook" target="_blank">
											<i class="fa fa-facebook facebook-bg-hover"></i>
										</a>
										<a href="https://instagram.com/precioustradingcompany?igshid=179d0mmjfb3ve" title="Instagram" target="_blank">
											<i class="fa fa-instagram instagram-bg-hover"></i>
										</a>
										<a href="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3609.698150794638!2d51.581746!3d25.2134!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe275e7032dc548c2!2sPrecious%20Trading%20Company!5e0!3m2!1sen!2sqa!4v1610285057101!5m2!1sen!2sqa" title="map" target="_blank">
											<i class="fa fa-map-marker google-plus-bg-hover"></i>
										</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>
		
</body>
@stop


