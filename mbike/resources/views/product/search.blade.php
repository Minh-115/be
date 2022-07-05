@extends('layouts.master')
@section('title')
<title>Home Page</title>
@endsection()

@section('css')
<link rel='stylesheet' href="{{asset('home/home.css')}}">	
@endsection()

@section('js')
<link rel='stylesheet' href="{{asset('home/home.js')}}">
@endsection()

@section('content')
<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Kết quả tìm kiếm</h2>
						@foreach($search_product as $search_products)
						<a href="{{URL::to('/detail/'.$search_products->id)}}">							
						<div class="col-sm-3">
							<div class="product-image-wrapper">
						
								<div class="single-products">
							<form action="{{URL::to('/save_cart')}}" method="post">
							{{csrf_field()}}
										<div class="productinfo text-center" style="width: 400px;height: 550px;">
											<img src="{{$search_products->feature_image_path}}" alt="" style="width:200px;height: 250px;" />
											<h2>{{number_format($search_products->price)}} VND</h2>
											<p>{{$search_products->name}}</p>
											<input name="product_id_hidden" type="hidden" value="{{$search_products->id}}" />
											<button type="submit" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
										</div>	
										</form>	
										<form action="{{URL::to('/save_cart')}}" method="post">	
										{{csrf_field()}}																					
										<div class="product-overlay">
										<a href="{{URL::to('/detail/'.$search_products->id)}}">	
											<div class="overlay-content">
												<h2>{{number_format($search_products->price)}} VND</h2>
												<p>{{$search_products->name}}</p>
									<input name="qty" type="hidden" value="1" />

												<input name="product_id_hidden" type="hidden" value="{{$search_products->id}}" />
												<button type="submit" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
											</div>
											</a>
										</div>
										</form>	
								</div>
								</form>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>
						</a>
						@endforeach						
					</div><!--features_items-->
@endsection()