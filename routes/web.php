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

Route::get('/', function () {
    return redirect(route('home'));
});


/**
 * Login, Logout & Register Routes
 */
Route::get('login', 'User\Auth\AuthController@showLoginForm')->name('show.login')->middleware('guest');
Route::post('login', 'User\Auth\AuthController@login')->name('user.login');
Route::post('register','User\Auth\AuthController@register')->name('user.register');
Route::post('logout', 'User\Auth\AuthController@logout')->name('user.logout');


/**
 * Verification Email Routes
 */
Route::get('user/verification/{token}', 'User\Auth\AuthController@verify');
Route::get('user/verification-resend','User\Auth\AuthController@resendToken')->name('resend.email');
Route::get('user/verification', 'User\Auth\AuthController@showVerifiyNotice')->name('email.verification');


/**
 * Reset Passwords
 */
Route::get('user/resetpassword','User\Auth\AuthController@showResetPassword')->name('show.reset.password');
Route::post('user/resetpassword', 'User\Auth\AuthController@sendResetPasswordToken')->name('send.reset.password');
Route::get('user/resetpassword/{token}','User\Auth\AuthController@showResetPasswordForm')->name('show.reset.password.form');
Route::post('user/resetpassword/form','User\Auth\AuthController@resetPassword')->name('reset.password');


/**
 * Main User Interface Routes
 */
Route::get('home', 'User\HomeController@index')->name('home');
Route::get('profile','User\HomeController@profile')->name('profile')->middleware('auth');
Route::get('product', 'User\HomeController@product')->name('product');

/**
 * Detail Product
 */
Route::get('product/detail/{id}','User\HomeController@productDetail')->name('detail.product');

/**
 * Cart Routes
 */
Route::get('cart/add/{id}', 'User\CartController@add')->name('add.to.cart');
Route::get('check-out','User\CartController@checkout')->name('checkout')->middleware(['auth', 'custom-verified']);
Route::get('cart-reset','User\CartController@destroy')->name('destroy.cart');


/**
 * API Check Ongkir
 */
Route::post('check-out', 'User\CartController@checkOngkir')->name('cek.ongkir');

/**
 * Transaksi
 */
Route::post('transaction-proggress', 'User\CartController@prosesBeli')->name('transaksi.beli');



/**
 * Transaction order List
 */
Route::get('order-list','User\HomeController@showOrder')->name('show.order');
Route::get('transaction-cancel/{id}','User\HomeController@cancelOrder')->name('cancel.order');
Route::get('transaction-detail/{id}','User\HomeController@transactionDetail')->name('detail.order');


/**
 * Upload Bukti Pembayaran
 */
Route::post('transaction-detail','User\HomeController@UploadBukit')->name('upload.bukti');

/**
 * Review Product setelah sampai
 */
Route::get('give-review/{id}','User\HomeController@reviewForm')->name('show.review');
Route::post('give-review','User\HomeController@postReview')->name('post.review');


/**
 * FLUSH ALL SESSION (WARNING USE!)
 */
Route::get('flush',function(){
    Session::flush();
    return redirect()->route('home');
})->name('session.flush');

Route::post('markRead','User\HomeController@markRead');



/**
 * All Admin Routes Start Here
 */

Route::prefix('admin')->group(function () {
    Route::get('login', 'Admin\Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('login','Admin\Auth\AdminLoginController@login')->name('admin.login');

    Route::get('dashboard','Admin\AdminDashboardController@index')->name('admin.dashboard');
    
    Route::post('logout', 'Admin\Auth\AdminLoginController@logout')->name('admin.logout');

    Route::resource('product','Admin\ProductController');
    Route::resource('courier','Admin\CourierController')->middleware('auth:admin');
    Route::resource('category','Admin\ProductCategoriesController')->middleware('auth:admin');
    Route::resource('discount','Admin\DiscountController')->middleware('auth:admin');

    /**
     * Transakasi Route
     */
    Route::get('transaksi','Admin\AllController@showTransaction')->name('index.transaksi');
    Route::get('transaksi/show/{id}','Admin\AllController@DetailTransaction')->name('show.detail.transaksi');
    Route::post('transaksi/update','Admin\AllController@updateDetailTransaction')->name('update.detail');


    /**
     * Review
     */
    Route::get('reviews','Admin\AllController@showReview')->name('show.reviews');
    Route::get('reviews/balas/{id}','Admin\AllController@balasReview')->name('balas.reviews');
    Route::post('reviews/balas','Admin\AllController@postResponse')->name('post.response');


    /**
     * Report
     */

    Route::get('/monthly_chart','Admin\AdminDashboardController@monthly_chart')->name('monthly.chart');
    Route::get('/yearly_chart','Admin\AdminDashboardController@yearly_chart')->name('yearly.chart');
    Route::get('/daily_chart','Admin\AdminDashboardController@daily_chart')->name('daily.chart');


    Route::post('/markReadAdmin','Admin\AdminDashboardController@markReadAdmin')->name('admin.read.notif');

});