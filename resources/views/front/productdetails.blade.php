@extends('front.layouts.app')

@section('title')
    {{ __('BAWADI | HOME') }}
@stop
@section('header')
@include('front.layouts.header')
@stop
@section('content')
<!-- mt main start here -->
<main id="mt-main">
				<!-- Mt Product Detial of the Page -->
				<section class="mt-product-detial wow fadeInUp" data-wow-delay="0.4s">
					<div class="container">
						<div class="row">
							<div class="col-xs-12">
								<!-- Slider of the Page -->
								<div class="slider">
									<!-- Comment List of the Page -->
									<ul class="list-unstyled comment-list">
										<li><a href="#"><i class="fa fa-heart"></i>27</a></li>
										<li><a href="#"><i class="fa fa-comments"></i>12</a></li>
										<li><a href="#"><i class="fa fa-share-alt"></i>14</a></li>
									</ul>
									<!-- Comment List of the Page end -->
									<!-- Product Slider of the Page -->
									<div class="product-slider">
									@foreach($productdetailsdata->image as $key => $image_details)
										<div class="slide">
											<img src="{{ $image_details->src }}" alt="image descrption">
										</div>
										@endforeach	
									</div>
									<!-- Product Slider of the Page end -->
									<!-- Pagg Slider of the Page -->
									<ul class="list-unstyled slick-slider pagg-slider">
									@foreach($productdetailsdata->image as $key => $image_details)
										<li><div class="img"><img src="{{ $image_details->src }}" alt="image description"></div></li>
									@endforeach	
									</ul>
									<!-- Pagg Slider of the Page end -->
								</div>
								<!-- Slider of the Page end -->
								<!-- Detail Holder of the Page -->
								<div class="detial-holder">
									<!-- Breadcrumbs of the Page -->
									<ul class="list-unstyled breadcrumbs">
										<li><a href="#">{{ $productdetailsdata->info[0]->name }} <i class="fa fa-angle-right"></i></a></li>
										<li>Products</li>
									</ul>
									<!-- Breadcrumbs of the Page end -->
									<h2 style="color: #00269a;">{{ $productdetailsdata->info[0]->name }}</h2>
									<!-- Rank Rating of the Page -->
									<div class="rank-rating">
										<span class="total-price">Reviews (12)</span>
										<ul class="list-unstyled rating-list">
											<li><a href="#"><i class="fa fa-star"></i></a></li>
											<li><a href="#"><i class="fa fa-star"></i></a></li>
											<li><a href="#"><i class="fa fa-star"></i></a></li>
											<li><a href="#"><i class="fa fa-star-o"></i></a></li>
										</ul>
									</div>
									<!-- Rank Rating of the Page end -->
									<div class="text-holder">
									
										<span class="price productprice">QR {{ $productpricedata[0]->price }}</span>
										
									</div>
									<!-- Product Form of the Page -->
									<form action="#" class="product-form" style="margin-bottom: 40px">
										<fieldset>
										<input type="hidden" id="productoriginalprice" class="productoriginalprice" value="{{ $productpricedata[0]->price }}">
										@if($productdetailsdata->size_type == 'many')
											<div class="row-val">
												<label for="product_size">Size</label>
												<select id="product_size" class="product_size">
												@foreach($productpricedata as $price_details)
												<option value="{{ $price_details->id }}">{{ $price_details->tag }}</option>
												@endforeach
												</select>
											</div>
										@endif	
											<div class="row-val">
												<label for="qty">qty</label>
												<input type="number" id="qty" class="qty" value="1">
											</div>
											<div class="row-val">
												<label for="totalamount">Total</label>
												<label class="totalamount">QR {{ $productpricedata[0]->price }}</label>
												
												
											</div><br><br><br>
											<div class="row-val">
												<button type="submit">ADD TO CART</button>
											</div>
										</fieldset>
									</form>
									<div class="txt-wrap">
										<p>{{ $productdetailsdata->info[0]->description }}</p>
									</div>
									<!-- Product Form of the Page end -->
									<ul class="list-unstyled list">
										<li><a href="#"><i class="fa fa-share-alt"></i>SHARE</a></li>
										<li><a href="#"><i class="fa fa-exchange"></i>COMPARE</a></li>
										<li><a href="{{route('front.wishlist')}}"><i class="fa fa-heart"></i>ADD TO WISHLIST</a></li>
									</ul>
								</div>
								<!-- Detail Holder of the Page end -->
							</div>
						</div>
					</div>
				</section><!-- Mt Product Detial of the Page end -->
				<div class="product-detail-tab wow fadeInUp" data-wow-delay="0.4s">
					<div class="container">
						<div class="row">
							<div class="col-xs-12">
								<ul class="mt-tabs text-center text-uppercase">
									<li><a href="#tab1">DESCRIPTION</a></li>
									<li><a href="#tab2">INFORMATION</a></li>
									<li><a href="#tab3" class="active">REVIEWS (12)</a></li>
								</ul>
								<div class="tab-content">
									<div id="tab1">
										<p>Koila is a chair designed for restaurants and food lovers in general. Designed in collaboration with restaurant professionals, it ensures comfort and an ideal posture, as there are armrests on both sides of the chair. </p>
										<p>Koila is a seat designed for restaurants and gastronomic places in general. Designed in collaboration with professional of restaurants and hotels field, this armchair is composed of a curved shell with a base in oak who has pinched the back upholstered in fabric or leather. It provides comfort and holds for ideal sitting position,the arms may rest on the sides ofthe armchair. <br>Solid oak construction.<br> Back in plywood (2  faces oak veneer) or upholstered in fabric, leather or eco-leather.<br> Seat upholstered in fabric, leather or eco-leather. <br> H 830 x L 585 x P 540 mm.</p>
									</div>
									<div id="tab2">
										<p>Koila is a chair designed for restaurants and food lovers in general. Designed in collaboration with restaurant professionals, it ensures comfort and an ideal posture, as there are armrests on both sides of the chair. </p>
										<p>Koila is a seat designed for restaurants and gastronomic places in general. Designed in collaboration with professional of restaurants and hotels field, this armchair is composed of a curved shell with a base in oak who has pinched the back upholstered in fabric or leather. It provides comfort and holds for ideal sitting position,the arms may rest on the sides ofthe armchair. <br>Solid oak construction.<br> Back in plywood (2  faces oak veneer) or upholstered in fabric, leather or eco-leather.<br> Seat upholstered in fabric, leather or eco-leather. <br> H 830 x L 585 x P 540 mm.</p>
									</div>
									<div id="tab3">
										<div class="product-comment">
											<div class="mt-box">
												<div class="mt-hold">
													<ul class="mt-star">
														<li><i class="fa fa-star"></i></li>
														<li><i class="fa fa-star"></i></li>
														<li><i class="fa fa-star"></i></li>
														<li><i class="fa fa-star-o"></i></li>
													</ul>
													<span class="name">John Wick</span>
													<time datetime="2016-01-01">09:10 Nov, 19 2016</time>
												</div>
												<p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit sse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non</p>
											</div>
											<div class="mt-box">
												<div class="mt-hold">
													<ul class="mt-star">
														<li><i class="fa fa-star"></i></li>
														<li><i class="fa fa-star"></i></li>
														<li><i class="fa fa-star-o"></i></li>
														<li><i class="fa fa-star-o"></i></li>
													</ul>
													<span class="name">John Wick</span>
													<time datetime="2016-01-01">09:10 Nov, 19 2016</time>
												</div>
												<p>Usmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit sse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non</p>
											</div>
											<form action="#" class="p-commentform">
												<fieldset>
													<h2>Add  Comment</h2>
													<div class="mt-row">
														<label>Rating</label>
														<ul class="mt-star">
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star-o"></i></li>
															<li><i class="fa fa-star-o"></i></li>
														</ul>
													</div>
													<div class="mt-row">
														<label>Name</label>
														<input type="text" class="form-control">
													</div>
													<div class="mt-row">
														<label>E-Mail</label>
														<input type="text" class="form-control">
													</div>
													<div class="mt-row">
														<label>Review</label>
														<textarea class="form-control"></textarea>
													</div>
													<button type="submit" class="btn-type4">ADD REVIEW</button>
												</fieldset>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- related products start here -->
				<div class="related-products wow fadeInUp" data-wow-delay="0.4s">
					<div class="container">
						<div class="row">
							<div class="col-xs-12">
							<h2 style="color: #00269a;">RELATED PRODUCTS</h2>
								<div class="row">
									<div class="col-xs-12">
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="{{route('front.productdetails')}}"><img src="{{asset('fronts/images/sq/product1_img/AZRAG.jpg')}}" alt="image description"></a>
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
												<strong class="title"><a href="{{route('front.productdetails')}}">AZRAG</a></strong>
												<span class="price">QR <span>287,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="{{route('front.productdetails')}}"><img src="{{asset('fronts/images/sq/product2_img/MUSK.jpg')}}" alt="image description"></a>
														<ul class="links">
															<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="{{route('front.productdetails')}}">MUSK</a></strong>
												<span class="price">QR <span>399,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="{{route('front.productdetails')}}"><img src="{{asset('fronts/images/sq/product3_img/JEFOUL.jpg')}}" alt="image description"></a>
														<ul class="links">
															<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="{{route('front.productdetails')}}">JEFOUL</a></strong>
												<span class="price">QR <span>198,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="{{route('front.productdetails')}}"><img src="{{asset('fronts/images/sq/product4_img/NAKHWA.jpg')}}" alt="image description"></a>
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
												<strong class="title"><a href="{{route('front.productdetails')}}">NAKHWA</a></strong>
												<span class="price">QR <span>200,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="{{route('front.productdetails')}}"><img src="{{asset('fronts/images/sq/product5_img/WALAH.jpg')}}" alt="image description"></a>
														<ul class="links">
															<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="{{route('front.productdetails')}}">WALAH</a></strong>
												<span class="price">QR <span>200,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
								</div>
							</div>
						</div>
					</div><!-- related products end here -->
				</div>
			</main><!-- mt main end here -->
	@stop
	@section('javascript')
 <script>
 $(document).on('change','.product_size',function(e){
        
        var product_size = $(this).val();
		var qty = $('.qty').val();
            $.ajax({
            type        : 'GET',
            url         : APP_URL + '/changeproductsize/'+product_size,
            cache : false,
            processData: false
        }).done(function(response) {
            $('.productprice').text('QR'+' '+ response.data.price)
			$('.productoriginalprice').val(response.data.price)
			$('.totalamount').text('QR'+' '+ response.data.price*qty)
        });
       
    });
 </script>

 <script>
 $(document).on('change','.qty',function(e){
            var qty = $(this).val();
			
            var price = $('.productoriginalprice').val();

            $('.totalamount').text('QR'+' '+ price*qty);
            
    });

    $(document).on('keyup','.qty',function(e){
			var qty = $(this).val();
			
            var price = $('.productoriginalprice').val();

            $('.totalamount').text('QR'+' '+ price*qty);
    });
	</script>
    @stop
@section('footer')
@include('front.layouts.footer')
@stop
