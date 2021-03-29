@extends('front.layouts.app')

@section('title')
    {{ __('PROJECT | PRECIOUS TRADING COMPANY') }}
@stop

@section('content')
<body>
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
			<header class="header-type-classic header-absolute header-transparent">
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
													<img class="logo" alt="The DMCS" src="../front/images/logo-transparent.png">
													<img class="logo-fixed" alt="The DMCS" src="../front/images/logo-fixed.png">
													<img class="logo-mobile" alt="The DMCS" src="../front/images/logo-mobile.png">
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
      <div class="heading-container heading-resize heading-no-button">
				<div class="heading-background heading-parallax bg-2">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="heading-wrap">
									<div class="page-title">
										<h1>Summer</h1>
										<div class="page-breadcrumb">
											<ul class="breadcrumb">
												<li><span><a class="home" href="#"><span>Home</span></a></span></li>
												<li><span>Product</span></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row home-default-about">
									<div class="col-sm-12">
										<div class="container">
											<div class="row welcome">
												<div class="col-sm-12">
													<h2 class="text-center custom_heading">
														{{ $getparproject_list->project_name }}
													</h2>
													<div class="separator content_element separator_align_center sep_width_10 sep_border_width_2 sep_pos_align_center separator_no_text sep_color_black">
														<span class="sep_holder sep_holder_l">
															<span class="sep_line"></span>
														</span>
														<span class="sep_holder sep_holder_r">
															<span class="sep_line"></span>
														</span>
													</div>
													<div class="content_element">
														
													</div>
													
												</div>
											</div>
										</div>
										<div class="container">
											<div class="row offers">
												<div class="col-sm-6">
													<div class="content_element align_center">
														<div class="single_image-wrapper box_border_grey">
															<img width="571" height="485" src="{{ $getparproject_list->image[0]->image}}" alt="home-bg"/>
														</div>
													</div>
												</div>
												<div class="col-sm-6 offer-text">
													<h2 class="custom_heading">{{ $getparproject_list->project_name }}</h2>
													<div class="content_element">
														<p>
														{{ $getparproject_list->project_description }}
														</p>
													</div>
													
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
						<div class="col-md-12 main-wrap">
							<div class="main-content">
								<div class="row section-collection">
									<div class="col-sm-12">
									<div class="row inner">
											<div class="col-sm-2"></div>
											<div class="col-sm-8">
												<h2 class="text-center custom_heading">Related Images</h2>
												<div class="separator content_element separator_align_center sep_width_10 sep_border_width_2 sep_pos_align_center separator_no_text sep_color_black">
													<span class="sep_holder sep_holder_l">
														<span class="sep_line"></span>
													</span>
													<span class="sep_holder sep_holder_r">
														<span class="sep_line"></span>
													</span>
												</div>
												
											</div>
											<div class="col-sm-2"></div>
										</div>
										<div class="caroufredsel product-slider" data-scroll-fx="" data-speed="" data-easing="" data-visible-min="1" data-scroll-item="" data-responsive="1" data-infinite="1" data-autoplay="1">
											<div class="caroufredsel-wrap">
												<div class="shop columns-4">
													<ul class="products columns-4" data-columns="4">
                         							 @forelse($getprojectdetail_list as $key => $getprojectdetail_lists)
														<li class="product">
															<div class="product-container">
																<figure>
																	<div class="product-wrap">
																		<div class="product-images">
																			<div class="shop-loop-thumbnail">
                                                                                <img style="height:300px;width:500px;object-fit:cover;" src="{{ $getprojectdetail_lists->image }}" alt="Product-3"/>
                                                                            </div>
                                                                            
																		</div>
																	</div>
																	<figcaption>
																		
																	</figcaption>
																</figure>
															</div>
														</li>
                            								@empty
															<li>No Product</li>
															@endforelse
													</ul>
												</div>
												<a href="#" class="caroufredsel-prev"></a>
												<a href="#" class="caroufredsel-next"></a>
											</div>
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
		<div class="modal fade user-login-modal" id="userloginModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<form id="userloginModalForm">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">
								<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
							</button>
							<h4 class="modal-title">Login</h4>
						</div>
						<div class="modal-body">
							<div class="user-login-facebook">
								<button class="btn-login-facebook" type="button">
									<i class="fa fa-facebook"></i>Sign in with Facebook
								</button>
							</div>
							<div class="user-login-or"><span>or</span></div>
							<div class="form-group">
								<label>Username</label>
								<input type="text" id="username" name="log" required class="form-control" value="" placeholder="Username">
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" id="password" required value="" name="pwd" class="form-control" placeholder="Password">
							</div>
							<div class="checkbox clearfix">
								<div class="form-flat-checkbox pull-left">
									<input type="checkbox" name="rememberme" id="rememberme" value="forever"><i></i>&nbsp;Remember Me
								</div>
								<span class="lostpassword-modal-link pull-right">
									<a href="#lostpasswordModal" data-rel="lostpasswordModal">Lost your password?</a>
								</span>
							</div>
						</div>
						<div class="modal-footer">
							<span class="user-login-modal-register pull-left">
								<a data-rel="registerModal" href="#">Not a Member yet?</a>
							</span>
							<button type="submit" class="btn btn-default btn-outline">Sign in</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="modal fade user-register-modal" id="userregisterModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<form id="userregisterModalForm">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">
								<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
							</button>
							<h4 class="modal-title">Register account</h4>
						</div>
						<div class="modal-body">
							<div class="user-login-facebook">
								<button class="btn-login-facebook" type="button">
									<i class="fa fa-facebook"></i>Sign in with Facebook
								</button>
							</div>
							<div class="user-login-or"><span>or</span></div>
							<div class="form-group">
								<label>Username</label>
								<input type="text" name="user_login" required class="form-control" value="" placeholder="Username">
							</div>
							<div class="form-group">
								<label for="user_email">Email</label>
								<input type="email" id="user_email" name="user_email" required class="form-control" value="" placeholder="Email">
							</div>
							<div class="form-group">
								<label for="user_password">Password</label>
								<input type="password" id="user_password" required value="" name="user_password" class="form-control" placeholder="Password">
							</div>
							<div class="form-group">
								<label for="user_password">Retype password</label>
								<input type="password" id="cuser_password" required value="" name="cuser_password" class="form-control" placeholder="Retype password">
							</div>
						</div>
						<div class="modal-footer">
							<span class="user-login-modal-link pull-left">
								<a data-rel="loginModal" href="#loginModal">Already have an account?</a>
							</span>
							<button type="submit" class="btn btn-default btn-outline">Register</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="modal fade user-lostpassword-modal" id="userlostpasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<form id="userlostpasswordModalForm">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">
								<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
							</button>
							<h4 class="modal-title">Forgot Password</h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label>Username or E-mail:</label>
								<input type="text" name="user_login" required class="form-control" value="" placeholder="Username or E-mail">
							</div>
						</div>
						<div class="modal-footer">
							<span class="user-login-modal-link pull-left">
								<a data-rel="loginModal" href="#loginModal">Already have an account?</a>
							</span>
							<button type="submit" class="btn btn-default btn-outline">Sign in</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="modal fade shop product-quickview" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
		    	<div class="modal-content">
		    		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		    		<div class="modal-body">
		    			<div class="product-quickview-content">
							<div class="row">
								<div class="col-sm-6">
									<div class="single-product-images">
										<div class="single-product-images-slider">
											<img width="800" height="850" src="images/product/product-detail/product-1.jpg" alt="Product-1">
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="summary entry-summary">
										<h1 class="product_title entry-title">Cras rhoncus duis viverra</h1>
										<div class="shop-product-rating">
											<div class="star-rating">
												<span style="width:80%"></span>
											</div>
											<a href="#reviews" class="shop-review-link">(<span class="count">1</span> customer review)</a>
										</div>
										<p class="price">
											<span class="amount">$12.00</span>–<span class="amount">$23.00</span>
										</p>
										<div class="product-excerpt">
											<p>
												Proin malesuada enim nulla, nec bibendum justo vestibulum non. Duis et ipsum convallis, bibendum enim a, hendrerit diam. Praesent tellus mi, vehicula et risus eget, laoreet tristique tortor. Fusce id metus eget nibh imperdiet fermentum non in metus.
											</p>
										</div>
										<div class="product-actions res-color-attr">
											<form class="cart">
												<div class="product-options-outer">
													<div class="variation_form_section">
														<div class="product-options icons-lg">
															<table class="variations-table">
																<tbody>
																	<tr>
																		<td><label>Color</label></td>
																		<td>
																			<div class="select-option swatch-wrapper">
																				<a href="#" title="Green" class="swatch-color green">Green</a>
																			</div>
																			<div class="select-option swatch-wrapper selected">
																				<a href="#" title="Red" class="swatch-color red">Red</a>
																			</div>
																			<div class="select-option swatch-wrapper">
																				<a href="#" title="White" class="swatch-color white">White</a>
																			</div>
																		</td>
																	</tr>
																	<tr>
																		<td><label>Size</label></td>
																		<td>
																			<div class="select-option swatch-wrapper selected">
																				<a href="#" title="Extra Large" class="swatch-anchor">
																					<img src="images/sizes/XL.jpg" alt="thumbnail" width="35" height="35"/>
																				</a>
																			</div>
																			<div class="select-option swatch-wrapper">
																				<a href="#" title="Extra Extra Large" class="swatch-anchor">
																					<img src="images/sizes/XXL.jpg" alt="thumbnail" width="35" height="35"/>
																				</a>
																			</div>
																			<div class="select-option swatch-wrapper">
																				<a href="#" title="Medium" class="swatch-anchor">
																					<img src="images/sizes/M.jpg" alt="thumbnail" width="35" height="35"/>
																				</a>
																			</div>
																			<div class="select-option swatch-wrapper">
																				<a href="#" title="Small" class="swatch-anchor">
																					<img src="images/sizes/S.jpg" alt="thumbnail" width="35" height="35"/>
																				</a>
																			</div>
																		</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												<div class="single_variation_wrap">
													<div class="single_variation">
														<span class="price"><span class="amount">$20.00</span></span>
													</div>
													<div class="variations_button">
														<div class="quantity">
															<input type="number" name="quantity" value="1" title="Qty" class="input-text qty text" size="4">
														</div>
														<button type="submit" class="button">Add to cart</button>
													</div>
												</div>
											</form>
										</div>
										<div class="yith-wcwl-add-to-wishlist">
											<a href="#" class="add_to_wishlist">
												Add to Wishlist
											</a>
										</div>
										<div class="product_meta">
											<span class="sku_wrapper">SKU: <span class="sku">N/A</span></span>
											<span class="posted_in">Category: <a href="#">Aliquam</a></span>
											<span class="tagged_as">Tags: <a href="#">Men</a>, <a href="#">Women</a></span>
											<span class="posted_in">Brand: <a href="#">Adesso</a>, <a href="#">Carvela</a>.</span>
										</div>
										<div class="share-links">
											<div class="share-icons">
												<span class="facebook-share">
													<a href="#" title="Share on Facebook"><i class="fa fa-facebook"></i></a>
												</span>
												<span class="twitter-share">
													<a href="#" title="Share on Twitter"><i class="fa fa-twitter"></i></a>
												</span>
												<span class="google-plus-share">
													<a href="#" title="Share on Google +"><i class="fa fa-google-plus"></i></a>
												</span>
												<span class="linkedin-share">
													<a href="#" title="Share on Linked In"><i class="fa fa-linkedin"></i></a>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

</body>
@stop

