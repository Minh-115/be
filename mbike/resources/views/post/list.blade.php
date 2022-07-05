@extends('layouts.master')
@section('title')
<title>Bài viết</title>
@endsection()

@section('css')
<link rel='stylesheet' href="{{asset('home/home.css')}}">	
@endsection()

@section('js')
<link rel='stylesheet' href="{{asset('home/home.js')}}">

@endsection()

@section('content')
	<!--slider-->
	@include('home.components.slider')
	<!--/slider-->
	<section>
		<div class="container">
			<div class="row">
				@include('components.sliderbar')
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Danh sách bài viết</h2>
						
					@foreach($posts as $post)
                    <a href="{{URL::to('/post_detail/'.$post->post_id)}}">
                        <div class="product-image-wrapper">
                            <div class="single-product">
                                @csrf
							
                                   <div class="row">
                                   <div class="col-md-3"><img src="{{$post->image_path}}" style="width:150px;height: 100px;" ></div>
                                    <div class="col-md-6"> <p>{{$post->post_title}}</p></div>
                                   </div>
									<input name="post_id_hidden" type="hidden" value="{{$post->post_id}}" />
									
                                   
                               
                               
                            </div>
                            <input type="button" value="Xem bài viết"  style="float:right" >
                        </div>
                        </a>
							@endforeach	
					</div><!--features_items-->
				
					
				</div>
			</div>
		</div>
	</section>
	
	<!-- Latest compiled and minified CSS -->

@endsection()
    
