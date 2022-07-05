<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminRoleController;

use App\Http\Controllers\SliderAdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/admin', [LoginController::class,'home'])->name('home');
Route::get('/login', [LoginController::class,'login'])->name('get-login');//not
Route::post('/login',[LoginController::class,'postLogin'])->name('post-login');
Route::get('/register',[LoginController::class,'register'])->name('get-register');
Route::post('/register',[LoginController::class,'postRegister'])->name('post-register');
Route::get('/logout',[LoginController::class,'logout'])->name('get-logout');
Route::prefix('category')->middleware('AdminRole')->group(function () {
    Route::get('/',[CategoryController::class,'index'])->name('categories.indexx');
    Route::get('/create',[CategoryController::class,'create'])->name('categories.create');
    Route::post('/store',[CategoryController::class,'store'])->name('categories.store');
    Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('categories.edit');
    Route::post('/update/{id}',[CategoryController::class,'update'])->name('categories.update');
    Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('categories.delete');

});
Route::prefix('menu')->group(function () {
    Route::get('/',[MenuController::class,'index'])->name('menus.index');
    Route::get('/create',[MenuController::class,'create'])->name('menus.create');
    Route::post('/store',[MenuController::class,'store'])->name('menus.store');
    Route::get('/edit/{id}',[MenuController::class,'edit'])->name('menus.edit');
    Route::post('/update/{id}',[MenuController::class,'update'])->name('menus.update');
    Route::get('/delete/{id}',[MenuController::class,'delete'])->name('menus.delete');
});
Route::prefix('product')->group(function () {
    Route::get('/',[ProductController::class,'index'])->name('products.index');
    Route::get('/create',[ProductController::class,'create'])->name('products.create');
    Route::post('/store',[ProductController::class,'store'])->name('products.store');
    Route::get('/edit/{id}',[ProductController::class,'edit'])->name('products.edit');
    Route::post('/update/{id}',[ProductController::class,'update'])->name('products.update');
    Route::get('/delete/{id}',[ProductController::class,'delete'])->name('products.delete');
});

// Slider
Route::prefix('slider')->group(function () {
    Route::get('/',[SliderAdminController::class,'index'])->name('sliders.index');
    Route::get('/create',[SliderAdminController::class,'create'])->name('sliders.create');
    Route::post('/store',[SliderAdminController::class,'store'])->name('sliders.store');
    Route::get('/edit/{id}',[SliderAdminController::class,'edit'])->name('sliders.edit');
    Route::post('/update/{id}',[SliderAdminController::class,'update'])->name('sliders.update');
    Route::get('/delete/{id}',[SliderAdminController::class,'delete'])->name('sliders.delete');
});

// Post
Route::prefix('post')->group(function () {
    Route::get('/',[PostController::class,'index'])->name('posts.index');
    Route::get('/create',[PostController::class,'create'])->name('posts.create');
    Route::post('/store',[PostController::class,'store'])->name('posts.store');
    Route::get('/edit/{id}',[PostController::class,'edit'])->name('posts.edit');
    Route::post('/update/{id}',[PostController::class,'update'])->name('posts.update');
    Route::get('/delete/{id}',[PostController::class,'delete'])->name('posts.delete');
});
// User
Route::prefix('user')->middleware('AdminRole')->group(function () {
    Route::get('/',[AdminUserController::class,'index'])->name('users.index');
    Route::get('/create',[AdminUserController::class,'create'])->name('users.create');
    Route::post('/store',[AdminUserController::class,'store'])->name('users.store');
    Route::get('/edit/{id}',[AdminUserController::class,'edit'])->name('users.edit');
    Route::post('/update/{id}',[AdminUserController::class,'update'])->name('users.update');
    Route::get('/delete/{id}',[AdminUserController::class,'delete'])->name('users.delete');
});


//product
Route::get('/', 'HomeController@index');
Route::get('/test', 'HomeController@test');
Route::get('/detail/{id}', 'HomeController@detail');
//search product
Route::post('/search', 'HomeController@search');

//commnent
Route::post('/load_comment', 'ProductController@load_comment');
Route::post('/send_comment', 'ProductController@send_comment');

//cart
Route::post('/save_cart', 'CartController@save_cart');
Route::get('/delete/{rowId}', 'CartController@deleteCart');
Route::get('/addToCart/{id}', 'CartController@addToCart');
Route::get('/showcart', 'CartController@showcart');

//checkout
Route::get('/login_checkout', 'CheckoutController@login_checkout');
Route::get('/logout_checkout', 'CheckoutController@logout_checkout');
Route::post('/login_customer', 'CheckoutController@login_customer');
Route::post('/add_customer', 'CheckoutController@add_customer');
Route::get('/checkout', 'CheckoutController@checkout');
Route::post('/payment', 'CheckoutController@payment');
Route::post('/vnpay_payment', 'CheckoutController@vnpay_payment');
Route::post('/order_place', 'CheckoutController@order_place');
Route::post('/save_checkout_customer', 'CheckoutController@save_checkout_customer');
//order
Route::get('/manage_order','CheckoutController@manage_order');
Route::get('/view_order/{id}','CheckoutController@view_order');
Route::get('/shipped/{id}','CheckoutController@shipped');

// Post
Route::get('/list_post','PostController@list_post');
Route::get('/post_detail/{id}', 'PostController@post_detail');




Route::get('/category/{slug}/{id}',[]);
Route::get('/category/{slug}/{id}',[CategoryController::class,'product'])->name('categories.index');