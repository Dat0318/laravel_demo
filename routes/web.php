<?php

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
Route::get('/admin', 'Admin\LoginController@index')->name('admin');
Route::post('/admin','Admin\LoginController@postLogin')->name('admin');
//Tạo Router theo Group của từng phần trong Admin
Route::name('admin.')->prefix('admin')->middleware('adminLogin')->group(function(){
	
	Route::name('dashboard.')->prefix('dashboard')->group(function() {
		Route::get('/', 'Admin\DashboardController@index')->name('index');
	});	
	//Tạo Router cho product trong Admin
	Route::name('product.')->prefix('product')->group(function() {
		Route::get('/', 'Admin\ProductsController@index')->name('index');
		Route::get('/restore', 'Admin\ProductsController@showRestore')->name('showRestore');
		Route::get('/restore/{id}', 'Admin\ProductsController@restore')->name('restore');
		Route::get('/create', 'Admin\ProductsController@create')->name('create');
		Route::post('/store', 'Admin\ProductsController@store')->name('store');
		Route::get('/edit/{id}', 'Admin\ProductsController@edit')->name('edit');
		Route::post('/update/{id}', 'Admin\ProductsController@update')->name('update');
		Route::get('/destroy/{id}', 'Admin\ProductsController@destroy')->name('destroy');
		Route::get('/destroyAll/{id}', 'Admin\ProductsController@destroyAll')->name('destroyAll');
		Route::get('/destroyImage/{id}', 'Admin\ProductsController@destroyImage')->name('destroyImage');
		Route::get('/destroyMainImage/{id}', 'Admin\ProductsController@destroyMainImage')->name('destroyMainImage');
	});

	//Tạo Router cho comments trong Admin
	Route::name('comment.')->prefix('comment')->group(function() {
		Route::get('/', 'Admin\CommentsController@index')->name('index');
		Route::get('/show/{id}', 'Admin\CommentsController@show')->name('show');
		Route::get('/destroy/{id}/{productId}', 'Admin\CommentsController@destroy')->name('destroy');
	});	

	//Tạo Router cho categories trong Admin
	Route::name('category.')->prefix('category')->group(function() {
		Route::get('/', 'Admin\CategoriesController@index')->name('index');
		Route::get('/show/{id}', 'Admin\CategoriesController@show')->name('show');
		Route::get('/create', 'Admin\CategoriesController@create')->name('create');
		Route::post('/store', 'Admin\CategoriesController@store')->name('store');
		Route::get('/edit/{id}', 'Admin\CategoriesController@edit')->name('edit');
		Route::post('/update/{id}', 'Admin\CategoriesController@update')->name('update');
		Route::get('/destroy/{id}', 'Admin\CategoriesController@destroy')->name('destroy');
	});

	//Tạo Router cho users trong Admin
	Route::name('user.')->prefix('user')->group(function() {
		Route::get('/', 'Admin\UsersController@index')->name('index');
		Route::get('/restore', 'Admin\UsersController@showRestore')->name('showRestore');
		Route::get('/restore/{id}', 'Admin\UsersController@restore')->name('restore');
		Route::get('/create', 'Admin\UsersController@create')->name('create');
		Route::post('/store', 'Admin\UsersController@store')->name('store');
		Route::get('/edit/{id}', 'Admin\UsersController@edit')->name('edit');
		Route::post('/update/{id}', 'Admin\UsersController@update')->name('update');
		Route::get('/destroy/{id}', 'Admin\UsersController@destroy')->name('destroy');
		Route::get('/destroyAll/{id}', 'Admin\UsersController@destroyAll')->name('destroyAll');
	});

	//Tạo Router cho orders trong Admin
	Route::name('order.')->prefix('order')->group(function() {
		Route::get('/', 'Admin\OrdersController@index')->name('index');
		Route::get('/show/{id}', 'Admin\OrdersController@show')->name('show');
		Route::get('/create', 'Admin\OrdersController@create')->name('create');
		Route::post('/store', 'Admin\OrdersController@store')->name('store');
		Route::get('/edit/{id}', 'Admin\OrdersController@edit')->name('edit');
		Route::post('/update/{id}', 'Admin\OrdersController@update')->name('update');
		Route::get('/destroy/{id}', 'Admin\OrdersController@destroy')->name('destroy');
	});

	//Tạo Router cho slides trong Admin
	Route::name('slide.')->prefix('slide')->group(function() {
		Route::get('/', 'Admin\SlidesController@index')->name('index');
		Route::get('/show/{id}', 'Admin\SlidesController@show')->name('show');
		Route::get('/create', 'Admin\SlidesController@create')->name('create');
		Route::post('/store', 'Admin\SlidesController@store')->name('store');
		Route::get('/edit/{id}', 'Admin\SlidesController@edit')->name('edit');
		Route::post('/update/{id}', 'Admin\SlidesController@update')->name('update');
		Route::get('/destroy/{id}', 'Admin\SlidesController@destroy')->name('destroy');
	});

	//Tạo Router cho slides trong Admin
	Route::name('stock.')->prefix('stock')->group(function() {
		Route::get('/', 'Admin\StocksController@index')->name('index');
		Route::get('/create/{id}', 'Admin\StocksController@create')->name('create');
		Route::get('/show/{id}', 'Admin\StocksController@show')->name('show');
		Route::post('/store', 'Admin\StocksController@store')->name('store');
		Route::get('/edit/{id}', 'Admin\StocksController@edit')->name('edit');
		Route::post('/update/{id}', 'Admin\StocksController@update')->name('update');
		Route::get('/destroy/{id}', 'Admin\StocksController@destroy')->name('destroy');
	});

	//Tạo Router cho Account Admin
	Route::name('account.')->prefix('account')->group(function() {
		Route::get('/index/{id}', 'Admin\AccountController@getAccount')->name('index');
		Route::post('/update/{id}', 'Admin\AccountController@update')->name('update');
		Route::get('/changePassword/{id}','Admin\AccountController@getChangePassword')->name('changePassword');
		Route::post('/changePassword/{id}','Admin\AccountController@postChangePassword')->name('changePassword');
		Route::get('/logout', 'Admin\AccountController@logout')->name('logout');
	});
});

Route::get('/','PageController@getHome')->name('index');
Route::name('home.')->prefix('home')->group(function(){
		// Router gọi đến trang chủ của website
		Route::get('/','PageController@getHome')->name('index');

		// Router gọi đến ProductType của website
		Route::get('/product_type/{id}','PageController@getProductType')->name('productType');

		// Router gọi đến xem chi tiết Product của website
		Route::get('/productDetail/{id}','PageController@getProduct')->name('productDetail');

		// Router gọi đến xem page giới thiệu của website
		Route::get('/about','PageController@getAbout')->name('about');

		// Router gọi đến xem page liên hệ của website
		Route::get('/contact','PageController@getContact')->name('contact');

		//Route xử lý giỏ hàng
		Route::get('/showShoppingCart','CartController@showCart')->name('showShoppingCart');
		Route::post('/shoppingCart','CartController@addToCart')->name('shoppingCart');
		Route::post('/updateCart','CartController@updateCart')->name('updateCart');
		Route::get('/removeCart/{rowId}','CartController@removeCart')->name('removeCart');

		// Router gọi đến xử lý trang đặt hàng của website
		Route::get('/checkout','PageController@getCheckout')->name('checkout');
		Route::post('/checkout','PageController@postCheckout')->name('checkout');
		Route::get('/checkoutSuccess','PageController@getCheckoutSuccess')->name('checkoutSuccess');
		Route::get('/checkoutError','PageController@getCheckoutError')->name('checkoutError');

		// Router gọi đến trang login của website
		Route::get('/login','PageController@getLogin')->name('login');
		Route::post('/login','PageController@postLogin')->name('login');

		// Router gọi đến trang đăng ký của website
		Route::get('/register','PageController@getRegister')->name('register');
		Route::post('/register','PageController@postRegister')->name('register');
		Route::get('/userActivation/{token}','PageController@userActivation')->name('userActivation');

		// Router gọi đến trang search của website
		Route::get('/search','PageController@getSearch')->name('search');

		// Router gọi đến đăng xuất của website
		Route::get('/logout','PageController@getLogout')->name('logout');

		// Router gọi đến add comment của website
		Route::post('/store/{id}', 'Admin\CommentsController@store')->name('store');

		// Router gọi đến phần account
		Route::get('/account/{id}','AccountController@getAccount')->name('account');
		Route::post('/updateAccount/{id}','AccountController@update')->name('updateAccount');
		Route::get('/changePassword/{id}','AccountController@getChangePassword')->name('changePassword');
		Route::post('/changePassword/{id}','AccountController@postChangePassword')->name('changePassword');
		Route::get('/historyOrder/{id}','AccountController@getHistoryOrder')->name('historyOrder');
		Route::get('/historyOrderDetail/{idOrder}/{id}','AccountController@getHistoryOrderDetail')->name('historyOrderDetail');

});
