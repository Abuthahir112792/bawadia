@extends('front.layouts.app')

@section('title')
    {{ __('BAWADI | HOME') }}
@stop
@section('header')
@include('front.layouts.header')
@stop
@section('content')
<!-- mt main slider start here -->
<div class="mt-main-slider">
				<!-- slider banner-slider start here -->
				<div class="slider banner-slider">
					<!-- holder start here -->
					<div class="holder text-center" style="background-image: url(../fronts/images/sq/banner/banner1.jpg);">
						<div class="container">
							<div class="row">
								<div class="col-xs-12">
									<div class="text centerize"> 
										<strong class="title" style="color: #ffffff;">FURNITURE DESIGNS IDEAS</strong>
										<h1 style="color: #00269a;">AZRAG</h1>
										<h2 style="color: #ffffff;">BAKHOOR - UNISEX</h2>
										<div class="txt">
											<p style="color: #ffffff;">Consectetur adipisicing elit. Beatae accusamus, optio, repellendus inventore</p>
										</div>
										<a href="{{route('front.product')}}" class="shop" style="color: #00269a;">shop now</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- holder end here -->

					<!-- holder start here -->
					<div class="holder text-center" style="background-image: url(../fronts/images/sq/banner/banner2.jpg);">
						<div class="container">
							<div class="row">
								<div class="col-xs-12">
									<div class="text right">
										<strong class="title" style="color: #ffffff;">FURNITURE DESIGNS IDEAS</strong>
										<h1 style="color: #00269a;">GANNEDNI</h1>
										<h2 style="color: #ffffff;">EAU DE PAFUM</h2>
										<div class="txt">
											<p style="color: #ffffff;">Consectetur adipisicing elit. Beatae accusamus, optio, repellendus inventore</p>
										</div>
										<a href="{{route('front.product')}}" class="shop" style="color: #00269a;">shop now</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- holder end here -->
					
					<!-- holder start here -->
					<div class="holder text-center" style="background-image: url(../fronts/images/sq/banner/banner3.jpg);">
						<div class="container">
							<div class="row">
								<div class="col-xs-12">
									<div class="text">
										<strong class="title" style="color: #ffffff;">FURNITURE DESIGNS IDEAS</strong>
										<h1 style="color: #00269a;">MUSK</h1>
										<h2 style="color: #ffffff;"> EAU DE PAFUM- UNISEX</h2>
										<div class="txt">
											<p style="color: #ffffff;">Consectetur adipisicing elit. Beatae accusamus, optio, repellendus inventore</p>
										</div>
										<a href="{{route('front.product')}}" class="shop" style="color: #00269a;">shop now</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- holder end here -->
				</div>
				<!-- slider regular end here -->
			</div><!-- mt main slider end here -->
			<!-- mt main start here -->
			<main id="mt-main">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<!-- banner frame start here -->
							<div class="banner-frame">
								<!-- banner-1 start here -->
								<div class="banner-1 wow fadeInLeft" data-wow-delay="0.4s">
									<img alt="image description" src="{{asset('fronts/images/sq/home_img480/bawadi_web_products_size-36.jpg')}}">
									<div class="holder">
										<h2  style="color: #ffffff;">EAU DE PAFUM <br>SEMOUK</h2>
										<div class="txts">
											<a class="btn-shop" href="{{route('front.product')}}">
												<span  style="color: #ffffff;">shop now</span>
												<i class="fa fa-angle-right"></i>
											</a>
										</div>
									</div>
								</div>
								<!-- banner-1 end here -->

								<!-- banner-box first start here -->
								<div class="banner-box first">
									<!-- banner-2 start here -->
									<div class="banner-2 wow fadeInUp" data-wow-delay="0.4s">
										<img alt="image description" src="{{asset('fronts/images/sq/home_img225/bawadi_web_products_size-38.jpg')}}">
										<div class="holder">
											<h2 style="color: #ffffff;">CONCENTRATED PERFUME OIL <br>AZRAG</h2>
											<span class="price" style="color: #ffffff;">QR 129.00</span>
										</div>
									</div>
									<!-- banner-2 end here -->

									<!-- banner-3 start here -->
									<div class="banner-3 right wow fadeInDown" data-wow-delay="0.4s">
										<img alt="image description" src="{{asset('fronts/images/sq/home_img225/bawadi_web_products_size-39.jpg')}}">
										<div class="holder">
											<h2 style="color: #ffffff;">EAU DE PAFUM- UNISEX <br>OUD</h2>
											<a href="{{route('front.product')}}" class="shop" style="color: #ffffff;">SHOP NOW</a>
										</div>
									</div>
									<!-- banner-3 end here -->
								</div>
								<!-- banner-box first end here -->

								<!-- banner-4 start here -->
								<div class="banner-4 hidden-sm wow fadeInRight" data-wow-delay="0.4s">
									<img alt="image description" src="{{asset('fronts/images/sq/home_img480/bawadi_web_products_size-37.jpg')}}">
									<div class="holder">
										<h2 style="color: #ffffff;">EAU DE PAFUM- FEMALE <br>ALGHEED</h2>
										<span class="price" style="color: #ffffff;">QR 129.00</span>
										<a class="btn-shop add" href="{{route('front.product')}}">
											<span style="color: #ffffff;">shop now</span>
											<i class="fa fa-angle-right"></i>
										</a>
									</div>
								</div>
								<!-- banner-4 end here -->
							</div>
							<!-- banner frame end here -->
							<!-- mt producttabs start here -->
							<div class="mt-producttabs wow fadeInUp" data-wow-delay="0.4s">
								<!-- producttabs start here -->
								<ul class="producttabs">
									<li><a href="#tab1" class="active"  style="color: #00269a;">FEATURED</a></li>
									<li><a href="#tab2"  style="color: #00269a;">LATEST</a></li>
									<li><a href="#tab3"  style="color: #00269a;">BEST SELLER</a></li>
								</ul>
								<!-- producttabs end here -->
								<div class="tab-content text-center">
									<div id="tab1">
										<!-- tabs slider start here -->
										<div class="tabs-slider">
											<!-- slide start here -->
											<div class="slide">
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product1_img/AZRAG.jpg')}}" alt="image description"></a>
																<span class="caption">
																	<span class="new">NEW</span>
																</span>
																<ul class="mt-stars">
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star-o"></i></li>
																</ul>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">AZRAG</a></strong>
														<span class="price">QR <span>287,00</span></span>
													</div>
												</div><!-- mt product1 center end here -->
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product2_img/AZRAG.jpg')}}" alt="image description"></a>
																<ul class="mt-stars">
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star-o"></i></li>
																</ul>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">AZRAG</a></strong>
														<span class="price">QR <span>287,00</span></span>
													</div>
												</div>
												<!-- mt product1 center end here -->
											</div>
											<!-- slide end here -->
											<!-- slide start here -->
											<div class="slide">
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product3_img/ALGHEED.jpg')}}" alt="image description"></a>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">ALGHEED</a></strong>
														<span class="price">QR <span>399,00</span></span>
													</div>
												</div><!-- mt product1 center end here -->
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product4_img/GANNEDNI.jpg')}}" alt="image description"></a>
																<span class="caption">
																	<span class="off">15% Off</span>
																</span>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">GANNEDNI</a></strong>
														<span class="price">QR <span>399,00</span></span>
													</div>
												</div>
												<!-- mt product1 center end here -->
											</div>
											<!-- slide end here -->
											<!-- slide start here -->
											<div class="slide">
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product5_img/AZRAG.jpg')}}" alt="image description"></a>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">AZRAG</a></strong>
														<span class="price">QR <span>198,00</span></span>
													</div>
												</div><!-- mt product1 center end here -->
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product6_img/bawadi_web_SITE-31.jpg')}}" alt="image description"></a>
																<ul class="mt-stars">
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star-o"></i></li>
																</ul>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">LOTION- UNISEX</a></strong>
														<span class="price">QR <span>198,00</span></span>
													</div>
												</div>
												<!-- mt product1 center end here -->
											</div>
											<!-- slide end here -->
											<!-- slide start here -->
											<div class="slide">
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product7_img/bawadi_web_SITE-21.jpg')}}" alt="image description"></a>
																<span class="caption">
																	<span class="off">15% Off</span>
																	<span class="new">NEW</span>
																</span>
																<ul class="mt-stars">
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star-o"></i></li>
																</ul>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">MUATTAR - UNISEX</a></strong>
														<span class="price">QR <span>200,00</span></span>
													</div>
												</div><!-- mt product1 center end here -->
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product6_img/bawadi_web_SITE-32.jpg')}}" alt="image description"></a>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">LOTION- UNISEX</a></strong>
														<span class="price">QR <span>200,00</span></span>
													</div>
												</div>
												<!-- mt product1 center end here -->
											</div>
											<!-- slide end here -->
											<!-- slide start here -->
											<div class="slide">
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product5_img/MUSK.jpg')}}" alt="image description"></a>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">MUSK</a></strong>
														<span class="price">QR <span>200,00</span></span>
													</div>
												</div><!-- mt product1 center end here -->
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product4_img/HAIBAH.jpg')}}" alt="image description"></a>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">HAIBAH</a></strong>
														<span class="price">QR <span>200,00</span></span>
													</div>
												</div>
												<!-- mt product1 center end here -->
											</div>
											<!-- slide end here -->
											<!-- slide start here -->
											<div class="slide">
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product3_img/ARAM.jpg')}}" alt="image description"></a>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">ARAM</a></strong>
														<span class="price">QR <span>399,00</span></span>
													</div>
												</div><!-- mt product1 center end here -->
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product2_img/MUSK.jpg')}}" alt="image description"></a>
																<span class="caption">
																	<span class="off">15% Off</span>
																</span>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">MUSK</a></strong>
														<span class="price">QR <span>399,00</span></span>
													</div>
												</div>
												<!-- mt product1 center end here -->
											</div>
											<!-- slide end here -->
										</div>
										<!-- tabs slider end here -->
									</div>
									<div id="tab2">
										<!-- tabs slider start here -->
										<div class="tabs-slider">
											<!-- slide start here -->
											<div class="slide">
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product1_img/MUSK.jpg')}}" alt="image description"></a>
																<ul class="mt-stars">
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star-o"></i></li>
																</ul>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">MUSK</a></strong>
														<span class="price">QR <span>287,00</span></span>
													</div>
												</div>
												<!-- mt product1 center end here -->
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product2_img/OUD.jpg')}}" alt="image description"></a>
																<span class="caption">
																	<span class="new">NEW</span>
																</span>
																<ul class="mt-stars">
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star-o"></i></li>
																</ul>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">OUD</a></strong>
														<span class="price">QR <span>287,00</span></span>
													</div>
												</div><!-- mt product1 center end here -->
											</div>
											<!-- slide end here -->
											<!-- slide start here -->
											<div class="slide">
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product3_img/JEFOUL.jpg')}}" alt="image description"></a>
																<span class="caption">
																	<span class="off">15% Off</span>
																</span>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">JEFOUL</a></strong>
														<span class="price">QR <span>399,00</span></span>
													</div>
												</div>
												<!-- mt product1 center end here -->
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product4_img/KARAM.jpg')}}" alt="image description"></a>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">KARAM</a></strong>
														<span class="price">QR <span>399,00</span></span>
													</div>
												</div><!-- mt product1 center end here -->
											</div>
											<!-- slide end here -->
											<!-- slide start here -->
											<div class="slide">
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product5_img/TAIF.jpg')}}" alt="image description"></a>
																<ul class="mt-stars">
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star-o"></i></li>
																</ul>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">TAIF</a></strong>
														<span class="price">QR <span>198,00</span></span>
													</div>
												</div>
												<!-- mt product1 center end here -->
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product6_img/bawadi_web_SITE-34.jpg')}}" alt="image description"></a>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">LOTION- UNISEX</a></strong>
														<span class="price">QR <span>198,00</span></span>
													</div>
												</div><!-- mt product1 center end here -->
											</div>
											<!-- slide end here -->
											<!-- slide start here -->
											<div class="slide">
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product7_img/bawadi_web_SITE-24.jpg')}}" alt="image description"></a>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">MUATTAR - UNISEX</a></strong>
														<span class="price">QR <span>200,00</span></span>
													</div>
												</div>
												<!-- mt product1 center end here -->
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product6_img/bawadi_web_SITE-35.jpg')}}" alt="image description"></a>
																<span class="caption">
																	<span class="off">15% Off</span>
																	<span class="new">NEW</span>
																</span>
																<ul class="mt-stars">
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star-o"></i></li>
																</ul>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">LOTION- UNISEX</a></strong>
														<span class="price">QR <span>200,00</span></span>
													</div>
												</div><!-- mt product1 center end here -->
											</div>
											<!-- slide end here -->
											<!-- slide start here -->
											<div class="slide">
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product5_img/WALAH.jpg')}}" alt="image description"></a>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">WALAH</a></strong>
														<span class="price">QR <span>200,00</span></span>
													</div>
												</div>
												<!-- mt product1 center end here -->
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product4_img/SEMOUK.jpg')}}" alt="image description"></a>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">SEMOUK</a></strong>
														<span class="price">QR <span>200,00</span></span>
													</div>
												</div><!-- mt product1 center end here -->
											</div>
											<!-- slide end here -->
											<!-- slide start here -->
											<div class="slide">
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product3_img/TARFAH.jpg')}}" alt="image description"></a>
																<span class="caption">
																	<span class="off">15% Off</span>
																</span>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">TARFAH</a></strong>
														<span class="price">QR <span>399,00</span></span>
													</div>
												</div>
												<!-- mt product1 center end here -->
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product2_img/WALAH.jpg')}}" alt="image description"></a>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">WALAH/a></strong>
														<span class="price">QR <span>399,00</span></span>
													</div>
												</div><!-- mt product1 center end here -->
											</div>
											<!-- slide end here -->
										</div>
										<!-- tabs slider end here -->
									</div>
									<div id="tab3">
										<!-- tabs slider start here -->
										<div class="tabs-slider">
											<!-- slide start here -->
											<div class="slide">
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product1_img/WALAH.jpg')}}" alt="image description"></a>
																<span class="caption">
																	<span class="new">NEW</span>
																</span>
																<ul class="mt-stars">
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star-o"></i></li>
																</ul>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">WALAH</a></strong>
														<span class="price">QR <span>287,00</span></span>
													</div>
												</div><!-- mt product1 center end here -->
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product7_img/bawadi_web_SITE-24.jpg')}}" alt="image description"></a>
																<ul class="mt-stars">
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star-o"></i></li>
																</ul>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">MUATTAR - UNISEX</a></strong>
														<span class="price">QR <span>287,00</span></span>
													</div>
												</div>
												<!-- mt product1 center end here -->
											</div>
											<!-- slide end here -->
											<!-- slide start here -->
											<div class="slide">
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product6_img/bawadi_web_SITE-33.jpg')}}" alt="image description"></a>
																<span class="caption">
																	<span class="off">15% Off</span>
																</span>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">LOTION- UNISEX</a></strong>
														<span class="price">QR <span>399,00</span></span>
													</div>
												</div>
												<!-- mt product1 center end here -->
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product5_img/TAIF.jpg')}}" alt="image description"></a>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">TAIF</a></strong>
														<span class="price">QR <span>399,00</span></span>
													</div>
												</div><!-- mt product1 center end here -->
											</div>
											<!-- slide end here -->
											<!-- slide start here -->
											<div class="slide">
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product4_img/NAKHWA.jpg')}}" alt="image description"></a>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">NAKHWA</a></strong>
														<span class="price">QR <span>198,00</span></span>
													</div>
												</div><!-- mt product1 center end here -->
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product3_img/LABAIH.jpg')}}" alt="image description"></a>
																<ul class="mt-stars">
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star-o"></i></li>
																</ul>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">LABAIH</a></strong>
														<span class="price">QR <span>198,00</span></span>
													</div>
												</div>
												<!-- mt product1 center end here -->
											</div>
											<!-- slide end here -->
											<!-- slide start here -->
											<div class="slide">
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product2_img/TAIF.jpg')}}" alt="image description"></a>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">TAIF</a></strong>
														<span class="price">QR <span>200,00</span></span>
													</div>
												</div>
												<!-- mt product1 center end here -->
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product1_img/TAIF.jpg')}}" alt="image description"></a>
																<span class="caption">
																	<span class="off">15% Off</span>
																	<span class="new">NEW</span>
																</span>
																<ul class="mt-stars">
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star"></i></li>
																	<li><i class="fa fa-star-o"></i></li>
																</ul>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">TAIF</a></strong>
														<span class="price">QR <span>200,00</span></span>
													</div>
												</div><!-- mt product1 center end here -->
											</div>
											<!-- slide end here -->
											<!-- slide start here -->
											<div class="slide">
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product7_img/bawadi_web_SITE-23.jpg')}}" alt="image description"></a>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">MUATTAR - UNISEX</a></strong>
														<span class="price">QR <span>200,00</span></span>
													</div>
												</div><!-- mt product1 center end here -->
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product6_img/bawadi_web_SITE-33.jpg')}}" alt="image description"></a>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">LOTION- UNISEX</a></strong>
														<span class="price">QR <span>200,00</span></span>
													</div>
												</div>
												<!-- mt product1 center end here -->
											</div>
											<!-- slide end here -->
											<!-- slide start here -->
											<div class="slide">
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product5_img/OUD.jpg')}}" alt="image description"></a>
																<span class="caption">
																	<span class="off">15% Off</span>
																</span>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">OUD</a></strong>
														<span class="price">QR <span>399,00</span></span>
													</div>
												</div>
												<!-- mt product1 center end here -->
												<!-- mt product1 center start here -->
												<div class="mt-product1 mt-paddingbottom20">
													<div class="box">
														<div class="b1">
															<div class="b2">
																<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product4_img/KARAM.jpg')}}" alt="image description"></a>
																<ul class="links">
																	<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
																	<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
																	<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="txt">
														<strong class="title"><a href="{{route('front.product')}}">KARAM</a></strong>
														<span class="price">QR <span>399,00</span></span>
													</div>
												</div><!-- mt product1 center end here -->
											</div>
											<!-- slide end here -->
										</div>
										<!-- tabs slider end here -->
									</div>
								</div>
							</div>
							<!-- mt producttabs end here -->
						</div>
					</div>
				</div>
				<!-- mt bestseller start here -->
				<div class="mt-bestseller bg-grey text-center wow fadeInUp" data-wow-delay="0.4s">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 mt-heading text-uppercase">
								<h2 class="heading"  style="color: #00269a;">BEST SELLER</h2>
								<p>EXCEPTEUR SINT OCCAECAT</p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<div class="bestseller-slider">
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 large">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product1_img/AZRAG.jpg')}}" alt="image description"></a>
														<span class="caption">
															<span class="best-price">Best Price</span>
														</span>
														<ul class="links add">
															<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i></a></li>
															<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="{{route('front.product')}}">AZRAG AL BAWADI</a></strong>
												<span class="price">QR <span>399,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 large">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product2_img/AZRAG.jpg')}}" alt="image description"></a>
														<ul class="links add">
															<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i></a></li>
															<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="{{route('front.product')}}">AZRAG AL BAWADI</a></strong>
												<span class="price">QR <span>599,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 large">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product3_img/ALGHEED.jpg')}}" alt="image description"></a>
														<ul class="links add">
															<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i></a></li>
															<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="{{route('front.product')}}">ALGHEED AL BAWADI</a></strong>
												<span class="price">QR <span>200,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 large">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product4_img/GANNEDNI.jpg')}}" alt="image description"></a>
														<span class="caption">
															<span class="best-price">Best Price</span>
														</span>
														<ul class="links add">
															<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i></a></li>
															<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="{{route('front.product')}}">GANNEDNI AL BAWADI</a></strong>
												<span class="price">QR <span>399,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 large">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product5_img/AZRAG.jpg')}}" alt="image description"></a>
														<ul class="links add">
															<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i></a></li>
															<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="{{route('front.product')}}">AZRAG AL BAWADI</a></strong>
												<span class="price">QR <span>599,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 large">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product6_img/bawadi_web_SITE-31.jpg')}}" alt="image description"></a>
														<span class="caption">
															<span class="off">15% Off</span>
														</span>
														<ul class="links add">
															<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i></a></li>
															<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="{{route('front.product')}}">LOTION- UNISEX</a></strong>
												<span class="price">QR <span>200,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 large">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="{{route('front.product')}}"><img src="{{asset('fronts/images/sq/product7_img/bawadi_web_SITE-21.jpg')}}" alt="image description"></a>
														<span class="caption">
															<span class="off">15% Off</span>
														</span>
														<ul class="links add">
															<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i></a></li>
															<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="{{route('front.product')}}">MUATTAR - UNISEX</a></strong>
												<span class="price">QR <span>200,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- mt bestseller start here -->
				<div class="mt-smallproducts wow fadeInUp" data-wow-delay="0.4s">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm">
								<h3 class="heading"  style="color: #00269a;">Hot Sale</h3>
								<!-- mt product4 start here -->
								<div class="mt-product4 mt-paddingbottom20">
									<div class="img">
										<a href="{{route('front.product')}}"><img alt="image description" src="{{asset('fronts/images/sq/product1_img/AZRAG.jpg')}}"></a>
									</div>
									<div class="text">
										<div class="frame">
											<strong><a href="{{route('front.product')}}">AZRAG</a></strong>
											<ul class="mt-stars">
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star-o"></i></li>
											</ul>
										</div>
										<del class="off">QR 75,00</del>
										<span class="price">QR 55,00</span>
									</div>
								</div><!-- mt product4 end here -->
								<!-- mt product4 start here -->
								<div class="mt-product4 mt-paddingbottom20">
									<div class="img">
										<a href="{{route('front.product')}}"><img alt="image description" src="{{asset('fronts/images/sq/product2_img/AZRAG.jpg')}}"></a>
									</div>
									<div class="text">
										<div class="frame">
											<strong><a href="{{route('front.product')}}">AZRAG</a></strong>
										</div>
										<del class="off">QR 75,00</del>
										<span class="price">QR 55,00</span>
									</div>
								</div><!-- mt product4 end here -->
								<!-- mt product4 start here -->
								<div class="mt-product4 mt-paddingbottom20">
									<div class="img">
										<a href="{{route('front.product')}}"><img alt="image description" src="{{asset('fronts/images/sq/product3_img/ALGHEED.jpg')}}"></a>
									</div>
									<div class="text">
										<div class="frame">
											<strong><a href="{{route('front.product')}}">ALGHEED</a></strong>
											<ul class="mt-stars">
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star-o"></i></li>
											</ul>
										</div>
										<del class="off">QR 75,00</del>
										<span class="price">QR 55,00</span>
									</div>
								</div><!-- mt product4 end here -->
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm">
								<h3 class="heading"  style="color: #00269a;">Featured Products</h3>
								<!-- mt product4 start here -->
								<div class="mt-product4 mt-paddingbottom20">
									<div class="img">
										<a href="{{route('front.product')}}"><img alt="image description" src="{{asset('fronts/images/sq/product4_img/GANNEDNI.jpg')}}"></a>
									</div>
									<div class="text">
										<div class="frame">
											<strong><a href="{{route('front.product')}}">GANNEDNI</a></strong>
										</div>
										<del class="off">QR 75,00</del>
										<span class="price">QR 33,00</span>
									</div>
								</div><!-- mt product4 end here -->
								<!-- mt product4 start here -->
								<div class="mt-product4 mt-paddingbottom20">
									<div class="img">
										<a href="{{route('front.product')}}"><img alt="image description" src="{{asset('fronts/images/sq/product5_img/AZRAG.jpg')}}"></a>
									</div>
									<div class="text">
										<div class="frame">
											<strong><a href="{{route('front.product')}}">AZRAG</a></strong>
										</div>
										<span class="price">QR 55,00</span>
									</div>
								</div><!-- mt product4 end here -->
								<!-- mt product4 start here -->
								<div class="mt-product4 mt-paddingbottom20">
									<div class="img">
										<a href="{{route('front.product')}}"><img alt="image description" src="{{asset('fronts/images/sq/product6_img/bawadi_web_SITE-31.jpg')}}"></a>
									</div>
									<div class="text">
										<div class="frame">
											<strong><a href="{{route('front.product')}}">LOTION- UNISEX</a></strong>
										</div>
										<del class="off">QR 75,00</del>
										<span class="price">QR 55,00</span>
									</div>
								</div><!-- mt product4 end here -->
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomxs">
								<h3 class="heading"  style="color: #00269a;">Sale Products</h3>
								<!-- mt product4 start here -->
								<div class="mt-product4 mt-paddingbottom20">
									<div class="img">
										<a href="{{route('front.product')}}"><img alt="image description" src="{{asset('fronts/images/sq/product7_img/bawadi_web_SITE-21.jpg')}}"></a>
									</div>
									<div class="text">
										<div class="frame">
											<strong><a href="{{route('front.product')}}">MUATTAR - UNISEX</a></strong>
										</div>
										<del class="off">QR 75,00</del>
										<span class="price">QR 55,00</span>
									</div>
								</div><!-- mt product4 end here -->
								<!-- mt product4 start here -->
								<div class="mt-product4 mt-paddingbottom20">
									<div class="img">
										<a href="{{route('front.product')}}"><img alt="image description" src="{{asset('fronts/images/sq/product1_img/MUSK.jpg')}}"></a>
									</div>
									<div class="text">
										<div class="frame">
											<strong><a href="{{route('front.product')}}">MUSK</a></strong>
											<ul class="mt-stars">
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star-o"></i></li>
											</ul>
										</div>
										<span class="price">QR 55,00</span>
									</div>
								</div><!-- mt product4 end here -->
								<!-- mt product4 start here -->
								<div class="mt-product4 mt-paddingbottom20">
									<div class="img">
										<a href="{{route('front.product')}}"><img alt="image description" src="{{asset('fronts/images/sq/product2_img/MUSK.jpg')}}"></a>
									</div>
									<div class="text">
										<div class="frame">
											<strong><a href="{{route('front.product')}}">MUSK</a></strong>
										</div>
										<del class="off">QR 75,00</del>
										<span class="price">QR 55,00</span>
									</div>
								</div><!-- mt product4 end here -->
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3">
								<h3 class="heading"  style="color: #00269a;">Top Rated Products</h3>
								<!-- mt product4 start here -->
								<div class="mt-product4 mt-paddingbottom20">
									<div class="img">
										<a href="{{route('front.product')}}"><img alt="image description" src="{{asset('fronts/images/sq/product3_img/ARAM.jpg')}}"></a>
									</div>
									<div class="text">
										<div class="frame">
											<strong><a href="{{route('front.product')}}">ARAM</a></strong>
											<ul class="mt-stars">
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star-o"></i></li>
											</ul>
										</div>
										<del class="off">QR 75,00</del>
										<span class="price">QR 55,00</span>
									</div>
								</div><!-- mt product4 end here -->
								<!-- mt product4 start here -->
								<div class="mt-product4 mt-paddingbottom20">
									<div class="img">
										<a href="{{route('front.product')}}"><img alt="image description" src="{{asset('fronts/images/sq/product4_img/HAIBAH.jpg')}}"></a>
									</div>
									<div class="text">
										<div class="frame">
											<strong><a href="{{route('front.product')}}">HAIBAH</a></strong>
											<ul class="mt-stars">
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star-o"></i></li>
											</ul>
										</div>
										<del class="off">QR 75,00</del>
										<span class="price">QR 55,00</span>
									</div>
								</div><!-- mt product4 end here -->
								<!-- mt product4 start here -->
								<div class="mt-product4 mt-paddingbottom20">
									<div class="img">
										<a href="{{route('front.product')}}"><img alt="image description" src="{{asset('fronts/images/sq/product5_img/MUSK.jpg')}}"></a>
									</div>
									<div class="text">
										<div class="frame">
											<strong><a href="{{route('front.product')}}">MUSK</a></strong>
											<ul class="mt-stars">
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star-o"></i></li>
											</ul>
										</div>
										<del class="off">QR 75,00</del>
										<span class="price">QR 55,00</span>
									</div>
								</div><!-- mt product4 end here -->
							</div>
						</div>
					</div>
				</div><!-- mt bestseller end here -->
			</main><!-- mt main end here -->
	@stop
@section('javascript')

@stop
@section('footer')
@include('front.layouts.footer')
@stop
