@extends('layouts.admin')
@section('title')
<title>Chi tiết đơn hàng</title>
@endsection
@section('content')

<div class="content-wrapper">
@include('partials.content-header',['name' => 'Chi tiết','key'=>'đơn hàng'])
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <a href="" class="btn btn-success float-right m-2">Add</a>
       
          </div>
          <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Giá</th>                                                      
              </tr>             
            </thead>

            <tbody>
             @foreach($order_by_id as $order_by_id1)
              <tr>
                <td>{{$order_by_id1->product_name}}</td> 
                <td>{{$order_by_id1->product_sales_quantity}}</td>
                <td>{{$order_by_id1->product_price}}</td>               
              </tr>
             @endforeach
            </tbody>
      
          </table>
          </div>
          <div class="col-md-12">
         
          </div>

          
          
        
        </div>
      </div>
    </div>
  </div>
  @endsection