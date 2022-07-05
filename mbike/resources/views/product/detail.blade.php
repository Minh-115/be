@extends('layouts.master')
@section('title')
<title>Chi tiết sản phẩm</title>
@endsection()


@section('css')
<link rel='stylesheet' href="{{asset('home/home.css')}}">	
@endsection()

@section('js')
<link rel='stylesheet' href="{{asset('home/home.js')}}">
<script type="text/javascript">
    $(document).ready(function(){
        load_comment();
       function load_comment(){
           var product_id = $('.comment_product_id').val();
		    
           var _token=$('input[name="_token"]').val();
           $.ajax({
             url:"{{url('/load_comment')}}",
             method:"POST",
             data:{product_id:product_id,_token:_token},
             success:function(data){
               $('#comment_show').html(data);
       }
	});
	}
	$('.send_comment').click(function(){
		   var product_id = $('.comment_product_id').val();
		   var comment_name = $('.comment_name').val();
		   var comment = $('.comment').val();		   
		   var _token = $('input[name="_token"]').val();	  
		   $.ajax({
             url:"{{url('/send_comment')}}",
             method:"POST",
             data:{product_id:product_id,comment_name:comment_name,comment:comment,_token:_token},
             success:function(data){
               $('#notify_comment').html('<p class="text text_success"> ok</p>');
			    load_comment();
       }
	});
			
    }
	);
 });

</script>
@endsection()

@section('content')

<section>
		<div class="container">
			<div class="row">
                @include('components.sliderbar')												
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
            @csrf

							<div class="view-product">

                                <td>
                                    <img src=" {{$product->feature_image_path}}" alt="">
                                   
                                </td>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div>
										
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{$product->name}}</h2>
								<p>ID: {{$product->id}}</p>
								<img src="images/product-details/rating.png" alt="" />

								<form action="{{URL::to('/save_cart')}}" method="POST">
									{{csrf_field()}}
								<span>
									<span>{{number_format($product->price)}} VND</span>
									<label>Số lượng:</label>
									<input name="qty" type="number" value="1" />
									<input name="product_id_hidden" class="product_id_hidden" type="hidden" value="{{$product->id}}" />
									<button type="submit" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</span>
								</form>
								
								<p><b>Thương hiệu: </b> {{$categories->name}} </p>
						
								<a href=""><img src="images/product-details/share.jpg" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
                    @include('home.components.category_tab')
					
			
					<input type="hidden" name="product_id" value="{{$product->id}}" /> 
		
					
		<form>
			{{csrf_field()}}				

			<div id="comment_show">
			<input type="hidden" name="comment_product_id" class = "comment_product_id"   value="{{$product->id}}" /> 
			
		</div>
		</form>
		<p><b>Viết đánh giá của bạn</b></p>
		<form >
 {{csrf_field()}}
		<input type="hidden" name="comment_product_id" class = "comment_product_id"   value="{{$product->id}}" /> 

			<input  class="comment_name" name="comment_name" type="text" placeholder="Tên của bạn">	
			<textarea  class="comment" name="comment" placeholder="Nội dung bình luận" ></textarea>
		<button type="button" class="send_comment" > Gửi bình luận</button>
			<div id="notify_comment"> 

			</div>

	</form>
				

				</div>
			</div>
		</div>
	</section>

@endsection