@extends('layouts.master')
 
@section('sidebar')
    @@parent
 
    <p>This is appended to the master sidebar.</p>
@endsection
@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <!-- /.content-header -->

    <!-- Main content -->
    <section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				 
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<?php
use Gloudemans\Shoppingcart\Facades\Cart;
				$content=Cart::content();
				?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Sản Phẩm</td>
							<td class="description">Mô tả</td>
							<td class="quantity">Số lượng</td>
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
			<div class="row">			
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng tiền: <span>{{Cart::priceTotal()}}</span></li>
						
							
						</ul>
						<?php
use Illuminate\Support\Facades\Session;

							$customer_id = Session::get('customer_id');					
							if($customer_id!=NULL){
								?>
							
							<a class="btn btn-default check_out" href="{{URL::to('checkout')}}">Thanh toán</a>

								<?php
								}else
								{
									?>
								<a class="btn btn-default check_out" href="{{URL::to('login_checkout')}}">Thanh toán</a>
								<?php
								}
								?>
							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   
@endsection

