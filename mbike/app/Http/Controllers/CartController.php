<?php

namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
   public function save_cart(Request $request){
       $productId= $request->product_id_hidden;
       $qty= $request->qty;
       $cart = DB::table('products')->where('id',$productId)->first();
       $productInfo= DB::table('products')->where('id',$productId)->first(); 
       $data['id']= $cart->id;
       $data['qty']= $qty;
       $data['name']= $cart->name;
       $data['price']= $cart->price;
       $data['weight']= 1;
       $data['options']['image']= $cart->feature_image_path;
      Cart::add($data);    
     return Redirect('/showcart');
   }
   public function showcart(){        
      return view('cart.cart');
   }
   public function deleteCart($rowId){
      Cart::update($rowId,0);
      return Redirect('/showcart');
   }
  
}
