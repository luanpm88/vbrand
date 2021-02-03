<?php

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
#Route::auth();
/*
Route::get('/', function () {
    return view('welcome');
}); 
*/

Route::get('/policy', function () {
    return view('policy');
});

// Store Backend
Route::namespace('Client')->group(function () {
	// Product
	Route::get('/client/products/image/{id}', 'ProductController@image');
	Route::post('/client/products/list', 'ProductController@list');
    Route::get('/client/products', 'ProductController@index');

	// Open Platform Connection
	Route::get('client/connection', 'ConnectionController@index');
	Route::get('client/connection/connect', 'ConnectionController@connect');
	Route::get('client/connection/get-products', 'ConnectionController@getProducts');
	Route::match(['get', 'post'], 'client/connection/lazada/sync', 'ConnectionController@lazadaSync');
	Route::post('client/connection/lazada/sync/close', 'ConnectionController@lazadaSyncClose');

	// Message
	Route::get('client/messages', 'MessageController@index');
});



Route::get('locale/{locale}', function ($locale){
	if (! in_array($locale, ['en', 'vn', 'cn'])) {
        abort(400);
    }
    Session::put('locale', $locale);
    App::setLocale($locale);
    return redirect()->back();
});


Route::get('sitemap.xml', 'SitemapController@index');
Route::get('sitemap-posts.xml', 'SitemapController@posts');
Route::get('sitemap-products.xml', 'SitemapController@products');
Route::get('sitemap-category.xml', 'SitemapController@categories');
Route::get('sitemap-tags.xml', 'SitemapController@tags');



/*
	my profile
*/

Route::prefix('member')->middleware(['auth'])->group(function(){
	Route::get('/', 'MemberController@dashboard')->name('member');
	Route::get('/profile', 'MemberController@dashboard')->name('profile');
	Route::post('/', 'MemberController@dashboard_update');
	Route::get('dashboard', 'MemberController@dashboard');

	Route::get('password', 'MemberController@password');
	Route::post('password', 'MemberController@changepassword');

	Route::get('alert', 'MemberController@alert');
	Route::get('alert/{id}', 'MemberController@alert_details');
	Route::post('alert/{id}', 'MemberController@alert_store');

	Route::get('account', 'MemberController@accountsetting');
	Route::post('account', 'MemberController@alert_store');

	Route::get('package', 'MemberController@package')->name('fontend.packagelist');
	Route::post('package', 'MemberController@package_store');

	Route::get('promotion', 'MemberController@promotion');
	Route::get('voucher', 'MemberController@voucher');
	Route::get('statistical', 'MemberController@statistical');
	Route::get('customer', 'MemberController@customer');
	
	
	Route::get('order/show/{id}', 'OrdersController@details_user_order');
	Route::get('order/del/{id}', 'OrdersController@destroy_user_order');

	Route::get('payment', 'OrdersController@list_user_order')->name('fontent.userorders');;
	Route::post('paymentmaker', 'OrdersController@make_new_orders');
	Route::get('orderpayment/{id}', 'OrdersController@make_payment')->name('orderspayment');
	Route::post('orderpayment/{id}', 'OrdersController@make_update_orders')->name('updateorders');

	Route::post('payment-handle/{id}', 'PayPalsdkController@paymentHandle')->name('payment.PayPalsdk');
	Route::get('payment-success/{id}', 'PayPalsdkController@paymentSuccess')->name('payment.PayPalsuccess');
	Route::get('payment-cancel/{id}', 'PayPalsdkController@paymentCancel')->name('payment.PayPacancel');


	Route::get('domain', 'MemberController@domain');
	Route::post('domain', 'MemberController@domain_store');
	Route::post('domain/seek', 'MemberController@domain_seek');

	Route::get('email', 'MemberController@email');
	Route::post('email', 'MemberController@email_store');

	Route::get('template', 'MemberController@template')->name('fontend.templatelist');

	Route::get('template/{slug}', 'MemberController@template_details');
	Route::post('template/{slug}', 'MemberController@template_details_store');

	Route::post('template', 'MemberController@template_store');  

	Route::get('card', 'MemberController@card');

	Route::get('cart', 'MemberController@cart');
	Route::post('cart', 'MemberController@cart_update');


	Route::prefix('products')->group(function(){
		Route::get('/', 'MemberController@index')->name('backend.listProducts');
		Route::get('show/{id}', 'MemberController@show');
		Route::get('add', 'MemberController@create');
		Route::post('add', 'MemberController@store');
		Route::post('switchproduct', 'MemberController@switchproduct');
		Route::post('switchproducthot', 'MemberController@switchproducthot');
		Route::get('edit/{id}', 'MemberController@edit');
		Route::post('edit/{id}', 'MemberController@update');
		Route::get('del/{id}', 'MemberController@destroy');

		
		Route::get('payment', 'MemberController@payment');

	});

});

Route::get('web-design', function () {    return view('fontend.webdesign'); });
Route::get('domain-hosting', function () {    return view('fontend.webdesign'); });
Route::get('email-marketing', function () {    return view('fontend.webdesign'); });
Route::get('zalo-marketing', function () {    return view('fontend.webdesign'); });
Route::get('facebook-marketing', function () {    return view('fontend.webdesign'); });
Route::get('youtube-marketing', function () {    return view('fontend.webdesign'); });
Route::get('marketing', function () {    return view('fontend.webdesign'); });
Route::get('other-marketing', function () {    return view('fontend.webdesign'); });
Route::get('applocation', function () {    return view('fontend.applocation'); });

// Route::get('policy', function () {    return view('fontend.policy'); });
Route::get('partner', function () {    return view('fontend.partner'); });
Route::get('recruitment', function () {    return view('fontend.recruitment'); });


Route::get('/demo', 'TrangchuController@demo')->name('demo');
Route::post('/emailsend', 'TrangchuController@sendemail');

Route::get('aboutus', 'TrangchuController@aboutus')->name('aboutus'); 
Route::get('/', 'TrangchuController@index')->name('home');
Route::get('/home', 'TrangchuController@index')->name('home');
//Route::get('/home', 'HomeController@index')->name('backend.home');


Route::get('/search', 'SearchController@index')->name('fontend.search');
Route::post('/search', 'SearchController@search');
//	Route::post('search', 'ProductsController@search')->name('search');

Route::get('/dang-ky', 'UserController@reg_show')->name('fontend.reg_step');
Route::post('/dang-ky', 'UserController@reg_register');


Route::get('/confirm_password', 'UserController@register_show_4_password_againt')->name('fontend.reg_step4_confirm_password'); // click comfim

Route::get('/confirm', 'UserController@register_show_4')->name('fontend.reg_step4'); // click comfim
Route::post('/confirm', 'UserController@_register_4');
Route::get('/finished', 'UserController@_register_successful')->name('fontend.reg_succ');

Route::get('/resend', 'UserController@resend_show')->name('fontend.reg_resesend_code');
Route::post('/resend', 'UserController@resend_code');

Route::get('/quen-mat-khau', 'UserController@forget_password')->name('fontend.paswordforget');
Route::post('/quen-mat-khau', 'UserController@get_password');

Route::get('/activeaccount', 'UserController@account_active')->name('fontend.active');
Route::post('/activeaccount', 'UserController@active_do_active');

Auth::routes();

Route::get('payment-status',array('as'=>'payment.status','uses'=>'PaymentController@paymentInfo'));
Route::get('payment',array('as'=>'payment','uses'=>'PaymentController@payment'));
Route::get('payment-cancel', function () {	return 'Payment has been canceled'; });

Route::get('/active', function () { return view('fontend.user.active');})->name('active');
Route::post('/active', 'UserController@doactive')->name('active');
Route::post('/getactive', 'UserController@sendactive')->name('getactive');

Route::get('/profile', 'UserController@profile')->name('fontend.profile');
Route::post('/profile', 'UserController@update_profile');

Route::get('/exchange/$from/$to', 'UserController@get_exchange_rate')->name('exchange_rate');
Route::get('/wallet', 'UserController@_log_1')->name('wallet'); 

Route::get('/products/{slug}', 'ProductsController@show_detail_slug')->name('product.detail');
Route::get('category/{slug}', 'ProductsController@product_slug_category')->name('product.category');
/*
	Cart management
*/
Route::get('contact', 'TrangchuController@contact')->name('contact');
Route::post('contact', 'TrangchuController@sendcontact');
Route::get('posts', 'PostsController@post_of_all')->name('posts.all');
Route::get('posts/{id}', 'PostsController@show_detail')->name('posts.detail');

Route::get('product', 'ProductsController@show')->name('product.list');
Route::get('products', 'ProductsController@show')->name('product.list');
Route::get('product/{id}', 'ProductsController@show_detail')->name('product.detail');
/*
	User managerment
*/
Route::get('cart', 'ProductsController@cart')->name('cart.list');
Route::get('cart-thank', 'ProductsController@thank')->name('cart.thank');
Route::post('add-to-cart/{id}', 'ProductsController@cart_add_product')->name('cart.addpro');
Route::get('add-to-cart/{id}', 'ProductsController@cart_add')->name('cart.add');

Route::get('checkout', 'UserController@_log_1')->name('checkout');
Route::PATCH('update-cart', 'ProductsController@cart_update')->name('cart.update');
Route::delete('remove-from-cart', 'ProductsController@cart_remove');

/*
	comments 
*/
	
/*
	review 
*/

Route::middleware(['auth'])->group(function () {
	
	Route::get('myproducts', 'ProductsController@product_list_user')->name('product.userlist');
	Route::get('myproducts/add', 'ProductsController@product_add_user')->name('product.useradd');
	Route::post('myproducts/add', 'ProductsController@product_store_user');
	Route::get('myproducts/edit/{id}', 'ProductsController@product_edit_user')->name('product.useredit');
	Route::post('myproducts/edit/{id}', 'ProductsController@product_update_user');
	Route::get('myproducts/del/{id}', 'ProductsController@product_destroy_user');

	Route::get('order/show/{id}', 'OrdersController@details_user_order');
	Route::get('order/del/{id}', 'OrdersController@destroy_user_order');

	Route::get('order', 'OrdersController@list_user_order')->name('fontend.userorders');;
	Route::post('ordermaker', 'OrdersController@make_new_orders');
	Route::get('orderpayment/{id}', 'OrdersController@make_payment')->name('orderspayment');
	Route::post('orderpayment/{id}', 'OrdersController@make_update_orders')->name('updateorders');

	Route::post('payment-handle/{id}', 'PayPalsdkController@paymentHandle')->name('payment.PayPalsdk');
	Route::get('payment-success/{id}', 'PayPalsdkController@paymentSuccess')->name('payment.PayPalsuccess');
	Route::get('payment-cancel/{id}', 'PayPalsdkController@paymentCancel')->name('payment.PayPacancel');
});
Route::get('category/{id}', 'PostsController@post_of_category')->name('posts.category');
Route::get('posts/{id}', 'PostsController@show_detail')->name('posts.detail');
/*
	Social network
*/
route::get('redirect/{driver}','Auth\LoginController@redirect_social')->name('redirect.social');
route::get('callback/{driver}', 'Auth\LoginController@callback_social')->name('callback.social');
Route::get('redirect/{driver}', 'Auth\LoginController@redirect_social')->name('login.provider');
#Route::post('admin/products/switchproduct', 'ProductsController@switchproduct');
Route::prefix('admin')->middleware(['auth','isadmin'])->group(function(){ 
	Route::get('/', 'HomeController@dashboard')->name('backend.dashboard');
	Route::get('/dashboard', 'HomeController@dashboard')->name('backend.dashboard');
	Route::post('/upload', 'HomeController@upload')->name('backend.upload');
	
	Route::get('/config', 'HomeController@config')->name('backend.config');
	Route::post('/config', 'HomeController@config_store');

	Route::get('/policy', 'HomeController@policy')->name('backend.policy');
	Route::post('/policy', 'HomeController@policy_store');

	Route::get('/aboutus', 'HomeController@aboutus')->name('backend.aboutus');
	Route::post('/aboutus', 'HomeController@aboutus_store');

	Route::get('/makesitemap', 'HomeController@makesitemap')->name('backend.makesitemap');
	Route::post('/makesitemap', 'HomeController@sitemap_build');

	Route::get('/test', 'HomeController@test')->name('backend.test');
	Route::prefix('feedback')->group(function(){
		Route::get('/', 'FeedbackController@index')->name('backend.listfeedback');
		Route::get('show/{id}', 'FeedbackController@show');
		Route::get('del/{id}', 'FeedbackController@destroy');
	});
	Route::prefix('video')->group(function(){
		Route::get('/', 'VideoController@index')->name('backend.listvideo');
		Route::get('add', 'VideoController@create');
		Route::post('add', 'VideoController@store');
		Route::get('edit/{id}', 'VideoController@edit');
		Route::post('edit/{id}', 'VideoController@update');
		Route::get('del/{id}', 'VideoController@destroy');
	});
	Route::prefix('photo')->group(function(){
		Route::get('/', 'PhotoController@index')->name('backend.listphoto');
		Route::get('add', 'PhotoController@create');
		Route::post('add', 'PhotoController@store');
		Route::get('edit/{id}', 'PhotoController@edit');
		Route::post('edit/{id}', 'PhotoController@update');
		Route::get('del/{id}', 'PhotoController@destroy');
	});
	Route::prefix('posts')->group(function(){
		Route::get('/', 'PostsController@index')->name('backend.listposts');
		Route::get('show/{id}', 'PostsController@show');
		Route::get('add', 'PostsController@create');
		Route::post('add', 'PostsController@store');
		Route::get('edit/{id}', 'PostsController@edit');
		Route::post('edit/{id}', 'PostsController@update');
		Route::get('del/{id}', 'PostsController@destroy');
	});
	Route::prefix('template')->group(function(){
		Route::get('/', 'TemplateController@index')->name('backend.listtemplate');
		Route::get('show/{id}', 'TemplateController@show');
		Route::get('add', 'TemplateController@create');
		Route::post('add', 'TemplateController@store');
		Route::get('edit/{id}', 'TemplateController@edit');
		Route::post('edit/{id}', 'TemplateController@update');
		Route::get('del/{id}', 'TemplateController@destroy');
	});	
	Route::prefix('products')->group(function(){
		Route::get('/', 'ProductsController@index')->name('backend.listProducts');
		Route::get('show/{id}', 'ProductsController@show');
		Route::get('add', 'ProductsController@create');
		Route::post('add', 'ProductsController@store');
		Route::post('switchproduct', 'ProductsController@switchproduct');
		Route::post('switchproducthot', 'ProductsController@switchproducthot');
		
		Route::get('edit/{id}', 'ProductsController@edit');
		Route::post('edit/{id}', 'ProductsController@update');
		Route::get('del/{id}', 'ProductsController@destroy');
	});
	Route::prefix('category')->group(function(){
		Route::get('/', 'CategoryController@index')->name('backend.listcategory');
		Route::get('add', 'CategoryController@create');
		Route::post('add', 'CategoryController@store');
		Route::get('edit/{id}', 'CategoryController@edit');
		Route::post('edit/{id}', 'CategoryController@update');
		Route::get('del/{id}', 'CategoryController@destroy');
		Route::post('switchhome', 'CategoryController@switchhome');
		
	});
	Route::prefix('comments')->group(function(){
		Route::get('/', 'CommentsController@index')->name('backend.listcomments');
		Route::get('active/{id}', 'CommentsController@active');
		Route::get('deactive/{id}', 'CommentsController@deactive');
		Route::get('edit/{id}', 'CommentsController@edit');
		Route::post('edit/{id}', 'CommentsController@update');
		Route::get('del/{id}', 'CommentsController@destroy');
	});
	Route::prefix('orders')->group(function(){
		Route::get('/', 'OrdersController@index')->name('backend.listorders');
		Route::get('show/{id}', 'OrdersController@show');
		Route::get('add', 'OrdersController@create');
		Route::post('add', 'OrdersController@store');
		Route::get('edit/{id}', 'OrdersController@edit');
		Route::post('edit/{id}', 'OrdersController@update');
		Route::get('del/{id}', 'OrdersController@destroy');
	});
	/*
	Route::prefix('ordersdetail')->group(function(){
		Route::get('/', 'OrdersdetailController@index')->name('backend.listordersdetail');
		Route::get('show/{id}', 'OrdersdetailController@show');
		Route::get('add', 'OrdersdetailController@create');
		Route::post('add', 'OrdersdetailController@store');
		Route::get('edit/{id}', 'OrdersdetailController@edit');
		Route::post('edit/{id}', 'OrdersdetailController@update');
		Route::get('del/{id}', 'OrdersdetailController@destroy');
	});
	*/
	Route::prefix('user')->group(function(){
		Route::get('/', 'UserController@index')->name('backend.listuser');
		Route::get('show/{id}', 'UserController@show');
		Route::get('add', 'UserController@create');
		Route::post('add', 'UserController@store');
		Route::get('edit/{id}', 'UserController@edit');
		Route::post('edit/{id}', 'UserController@update');
		Route::get('del/{id}', 'UserController@destroy');
	});
});