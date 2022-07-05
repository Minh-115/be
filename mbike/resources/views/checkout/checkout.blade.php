@extends('layouts.master')
@section('title')
<title>Thanh toán</title>
@endsection()
@section('css')
<link rel='stylesheet' href="{{asset('home/home.css')}}">	
@endsection()

@section('js')
<link rel='stylesheet' href="{{asset('home/home.js')}}">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection()

@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

		

			<div class="register-req">
				
							<?php
							use Illuminate\Support\Facades\Session;
							$customer_id = Session::get('customer_id');							
							if(!empty($customer_id)){
								$customer_name = Session::get('name');
								?>
								<p> Xin chào <?php echo $customer_name ?> </p>
							<?php }														
							?>														
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					
					<div class="col-sm-10 clearfix">
						<div class="bill-to">
							<p>Điền thông tin nhận hàng</p>
							<div class="form-one">
								<form action="{{URL::to('/save_checkout_customer')}}" method="POST">
									{{csrf_field()}}
									<input type="text" name="shipping_name" placeholder="Họ và Tên">
									<input type="text" name="shipping_email" placeholder="Email*">
									<input type="text" name="shipping_phone" placeholder="SĐT">
									<input type="text" name="shipping_address" placeholder="Địa chỉ *">
									<input type="hidden" name="customer_id" value="{{$customer_id}}">

									<textarea name="shipping_note"  placeholder="Những lưu ý của bạn về đơn hàng" rows="10">										
									</textarea>
									<input type="submit" value="Gửi" name="send" class="btn btn-primary btn-sm ">
									@if(session('success'))
											{{session('success')}}
									@endif
									
								</form>
							</div>
						
						</div>
					</div>
									
				</div>
			</div>
			<div class="review-payment">
				<h2>Xem lại giỏ hàng</h2>
			</div>
			<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<?php
use Gloudemans\Shoppingcart\Facades\Cart;
				$content=Cart::content();
				echo '<pre>';
			
				echo '</pre>';

				?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Sản Phẩm</td>
							<td class="description">Mô tả</td>
							<td class="quantity">Số luọng</td>
							<td class="price">Giá</td>
						
							<td></td>
						</tr>
					</thead>
					<tbody>
            @foreach($content as $c1)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{$c1->options->image}} " style="height:100px;width:150px;" alt="">{{$c1->name}}</a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$c1->name}}</h4>
								<p>{{$c1->id}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">				
									<input name="qty" type="number" value="{{$c1->qty}}" />									
								</div>
							</td>
							<td class="cart_price">
								<p>{{number_format($c1->subtotal,0,',','.')}}</p>
							</td>
							
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete/'.$c1->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
            @endforeach
					
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<form action="{{URL::to('/order_place')}}" method="post">
				{{csrf_field()}}
			<div class="row">			
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng tiền: <span>{{Cart::priceTotal(0,',','.')}}</span></li>
												
						</ul>
										
					</div>
					<div class="payment-options ">
					<span>
						<label><input type="checkbox" value="Thẻ ATM" name="payment_option"> Trả bằng thẻ ATM</label>
					</span>
					<span>
						<label><input type="checkbox" value="Tiền mặt" name="payment_option"> Tiền mặt</label>
					</span>
					<input type="submit" value="Đặt hàng" name="send_order_place" class="btn btn-default check_out">
				</div>
				</div>
			</div>
			</form>
			<form action="{{URL::to('/vnpay_payment')}}" method="post">
				{{csrf_field()}}
			<input type="submit" value="Thanh toán VNPAY" name="redirect" class="btn btn-default check_out">

			</form>
		</div>
	</section><!--/#do_action-->
    
    <!-- /.content -->
  </div>
			
			
		</div>
	</section> <!--/#cart_items-->

	


@endsection

