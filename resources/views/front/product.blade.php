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
				<!-- Mt Contact Banner of the Page -->
				<section class="mt-contact-banner style4 wow fadeInUp" data-wow-delay="0.4s" style="background-image: url(../fronts/images/sq/banner/banner2.jpg);">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 text-center">
								<h1 style="color: #00269a;">PRODUCTS</h1>
								<!-- Breadcrumbs of the Page -->
								<nav class="breadcrumbs">
									<ul class="list-unstyled">
										<li><a href="{{route('front.homes')}}">Home <i class="fa fa-angle-right"></i></a></li>
										<li><a href="{{route('front.product')}}">Products <i class="fa fa-angle-right"></i></a></li>
										
									</ul>
								</nav><!-- Breadcrumbs of the Page end -->
							</div>
						</div>
					</div>
				</section><!-- Mt Contact Banner of the Page end -->
				<div class="container">
					<div class="row">
						<!-- sidebar of the Page start here -->
						<aside id="sidebar" class="col-xs-12 col-sm-4 col-md-3 wow fadeInLeft" data-wow-delay="0.4s">
							<!-- shop-widget filter-widget of the Page start here -->
							<section class="shop-widget filter-widget bg-grey">
								<h2>FILTER</h2>
								<span class="sub-title">Filter by Branch</span>
								<!-- nice-form start here -->
								<ul class="list-unstyled nice-form">
								@forelse($branchdata as $key => $allbranchdata)
									<li>
										<label for="check-1">
											<input id="check-1" type="checkbox">
											<span class="fake-input"></span>
											<a href="{{ route('front.product', ['branch_id' => $allbranchdata->id]) }}">
											<span class="fake-label">{{ $allbranchdata->name }}</span>
											</a>
										</label>
										<span class="num">2</span>
									</li>
									@empty
									<li>
										<label for="check-1">
											<input id="check-1" type="checkbox">
											<span class="fake-input"></span>
											<span class="fake-label">No Branches Found</span>
										</label>
									</li>
								@endforelse
								</ul><!-- nice-form end here -->
								<span class="sub-title">Filter by Price</span>
								<div class="price-range">
									<div class="range-slider">
										<span class="dot"></span>
										<span class="dot dot2"></span>
									</div>
									<span class="price">Price &nbsp;   QR 10  &nbsp;  -  &nbsp;   QR 599</span>
									<a href="#" class="filter-btn">Filter</a>
								</div>
							</section><!-- shop-widget filter-widget of the Page end here -->
							<!-- shop-widget of the Page start here -->
							<section class="shop-widget">
								<h2>CATEGORIES</h2>
								<!-- category list start here -->
								<ul class="list-unstyled category-list">
								@forelse($categorydata as $key => $allcategorydata)
									<li>
										<a href="{{ route('front.product', ['category_id' => $allcategorydata->id,'branch_id' => $branch_id]) }}">
											<span class="name">{{ $allcategorydata->name }}</span>
										</a>
									</li>
									@empty
									<li>
										<a href="#">
											<span class="name">No Category Found</span>
											
										</a>
									</li>	
								@endforelse	
								</ul><!-- category list end here -->
							</section><!-- shop-widget of the Page end here -->
							<!-- shop-widget of the Page start here -->
							<section class="shop-widget">
								<h2>SUBCATEGORIES</h2>
								<!-- category list start here -->
								<ul class="list-unstyled category-list">
								@forelse($subcategorydata as $key => $allsubcategorydata)
									<li>
										<a href="{{ route('front.product', ['subcategory_id' => $allsubcategorydata->id,'branch_id' => $branch_id]) }}">
											<span class="name">{{ $allsubcategorydata->sub_category_name }}</span>
											
										</a>
									</li>
									@empty
									<li>
										<a href="#">
											<span class="name">No SubCategory Found</span>
											
										</a>
									</li>	
								@endforelse	
								</ul><!-- category list end here -->
							</section><!-- shop-widget of the Page end here -->
						</aside><!-- sidebar of the Page end here -->
						<div class="col-xs-12 col-sm-8 col-md-9 wow fadeInRight" data-wow-delay="0.4s">
							<!-- mt shoplist header start here -->
							<header class="mt-shoplist-header">
								<!-- btn-box start here -->
								<div class="btn-box">
									<ul class="list-inline">
										<li>
											<a href="#" class="drop-link">
												Default Sorting <i aria-hidden="true" class="fa fa-angle-down"></i>
											</a>
											<div class="drop">
												<ul class="list-unstyled">
													<li><a href="#">ASC</a></li>
													<li><a href="#">DSC</a></li>
													<li><a href="#">Price</a></li>
													<li><a href="#">Relevance</a></li>
												</ul>
											</div>
										</li>
										<li><a class="mt-viewswitcher" href="#"><i class="fa fa-th-large" aria-hidden="true"></i></a></li>
										<li><a class="mt-viewswitcher" href="#"><i class="fa fa-th-list" aria-hidden="true"></i></a></li>
									</ul>
								</div><!-- btn-box end here -->
								<!-- mt-textbox start here -->
								<div class="mt-textbox">
									<p>Showing  <strong>1–9</strong> of  <strong>65</strong> results</p>
									<p>View   <a href="#">9</a> / <a href="#">18</a> / <a href="#">27</a> / <a href="#">All</a></p>
								</div><!-- mt-textbox end here -->
							</header><!-- mt shoplist header end here -->
							<!-- mt productlisthold start here -->
							<ul class="mt-productlisthold list-inline">
								
								@forelse($allproduct as $key => $allproductdetails)
								<li>
									<!-- mt product start here -->
									<div class="product-3 marginzero">
										<!-- img start here -->
										<div class="img">
											<img alt="image description" src="{{ $allproductdetails->image[0]->src }}">
										</div>
										<!-- txt start here -->
										<div class="txt">
										@if($allproductdetails->id == $allproductdetails->branch->product_id)
										<span class="price">{{ $allproductdetails->branch->id }}</span>
										@endif	
											
										
										</div>
										<!-- color start here -->
										
										
										<!-- links start here -->
										<ul class="links">
											<li><a href="{{route('front.shoppingcart')}}"><i class="icon-handbag"></i></a></li>
											<li><a href="{{route('front.wishlist')}}"><i class="icomoon icon-heart-empty"></i></a></li>
											<li><a href="{{ route('front.productdetails', ['product_id' => $allproductdetails->id,'branch_id' => $branch_id]) }}"><i class="icomoon fa fa-eye"></i></a></li>
										</ul>
									</div><!-- mt product 3 end here -->
								</li>
								@empty
								<h3 class="title" style="text-align: center">No Products found</h3>
								@endforelse
							</ul><!-- mt productlisthold end here -->
							<!-- mt pagination start here -->
							<nav class="mt-pagination">
								<ul class="list-inline">
								
								</ul>
							</nav><!-- mt pagination end here -->
						</div>
					</div>
				</div>
			</main><!-- mt main end here -->
	@stop
@section('javascript')

@stop
@section('footer')
@include('front.layouts.footer')
@stop
