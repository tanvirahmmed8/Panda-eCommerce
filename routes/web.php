<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ForntendController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\VariationController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

// Forntend routes start
Route::controller(ForntendController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/about-us', 'about')->name('about');
    Route::get('/cart', 'cart')->name('cart');
    Route::get('/checkout', 'checkout')->name('checkout');
    Route::post('/checkoutpost', 'checkoutpost')->name('checkoutpost');
    Route::post('/getcitylist', 'getcitylist')->name('getcitylist');
    Route::get('/shop', 'shop')->name('shop');
    Route::get('/search-category/{id}', 'search_category')->name('search.category');
    Route::get('/contact-us', 'contact')->name('contact');
    Route::post('/contact-post', 'contact_post')->name('contact.post');
    Route::get('/login-register', 'login_register')->name('login.register')->middleware(['guest']);
    // ptoduct view
    Route::get('/single-product/{id}', 'single_product')->name('single.product');
});

// CustomerController
Route::controller(CustomerController::class)->group(function () {
    Route::post('/customer/login', 'customer_login')->name('customer.login');
    Route::post('/customer/login/modal', 'customer_login_modal')->name('customer.login.modal');
    Route::post('/customer/register', 'customer_register')->name('customer.register');
    Route::get('/download/invoice/{id}',  'download_invoice')->name('download.invoice');
});

// VendorController Start
Route::controller(VendorController::class)->group(function () {
    Route::get('vendor/registration', 'vendor_registration')->name('vendor.registration')->middleware(['guest']);
    Route::post('vendor/registration', 'vendor_registration_post')->name('vendor.registration.post');
    Route::get('vendor/login', 'vendor_login')->name('vendor.login')->middleware(['guest']);
    Route::post('vendor/login', 'vendor_login_post')->name('vendor.login.post');
});
Route::post('/rating', [RatingController::class, 'rating'])->name('rating');
// Auth::routes();
Auth::routes(['register' => false]);
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified']);
Route::post('/profileupdate', [HomeController::class, 'profileupdate'])->name('profileupdate')->middleware(['auth', 'verified']);

// Forntend routes end

//backend routs start
Route::middleware(['auth','admin_vendor'])->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'profile')->name('profile');
        Route::post('/profile/photo/upload', 'profilephotoupload')->name('profile.photo.upload');
        Route::post('/cover/photo/upload', 'coverphoto')->name('cover.photo.upload');
        Route::post('/password/change', 'password_change')->name('password.change');
    });
});
// Only vendor can see this route start
Route::middleware(['auth','vendor'])->group(function () {
    Route::controller(VendorController::class)->group(function () {
        Route::get('vendor/order/{id}', 'vendor_order')->name('vendor.order');
        Route::post('order/status/change/{id}', 'order_status')->name('order.status');
        Route::get('vendor/trash/index', 'trash')->name('vendor.trash.index');
        Route::get('vendor/wallet', 'vendor_wallet')->name('vendor.wallet');
        Route::post('vendor/withdraw', 'vendor_withdraw')->name('vendor.withdraw');
        Route::post('vendor/withdraw/request', 'withdraw_request')->name('withdraw.request');
        Route::get('vendor/applyforpromotion/{product}', 'applyforpromotion')->name('vendor.applyforpromotion');
        Route::post('vendor/applyfor/banner', 'apply_banner')->name('vendor.apply_banner');
        Route::post('vendor/applyfor/promotion', 'apply_promotion')->name('vendor.apply_promotion');
    });

    Route::resource('/coupon', CouponController::class);
    Route::resource('/variation', VariationController::class);
    Route::resource('/product', ProductController::class);

    Route::controller(ProductController::class)->group(function () {
        Route::get('product/restore/{product}', 'restore')->name('restore');
        Route::get('product/image/add/{product}', 'product_image_add')->name('product.image.add');
        Route::post('product/image/post/{product}', 'product_image_post')->name('product.image.post');
        Route::get('product/image/delete/{id}', 'product_image_delete')->name('product.image.delete');
        Route::get('product/inventory/{product}', 'inventory')->name('inventory');
        Route::post('product/inventory/add/{product}', 'addinventory')->name('addinventory');
    });
});
// Only vendor can see this route end

// Only admin can see this route start
Route::middleware(['auth','admin'])->group(function () {
    Route::controller(ForntendController::class)->group(function(){
        Route::get('/team', 'team')->name('team');
        Route::post('/team/post', 'teampost')->name('team.post');
        Route::get('/team/edit/{id}', 'teamedit');
        Route::post('/team/update/{id}', 'teamupdate');
        Route::get('/team/delete/{id}', 'teamdelete');
        Route::get('/team/restore/{id}', 'teamrestore');
        Route::get('/team/forcedelete/{id}', 'teamforcedelete');
    });
    //HomeController start
    Route::controller(HomeController::class)->group(function(){
        Route::get('/users', 'users')->name('users');
        Route::post('addnew/admin', 'addnew_admin')->name('addnew.admin');
        Route::post('vendor/action/change/{id}', 'vendor_action_change')->name('vendor.action.change');
        Route::get('/withdrawal/admin', 'withdrawal_admin')->name('withdrawal.admin');
        Route::post('/withdrawal/status/change', 'withdrawal_status_change')->name('withdrawal.status_change');
        Route::get('/promotion/request', 'promotion_request')->name('promotion.request');
        Route::get('/promotion/request/{id}', 'promotion_status_change')->name('promotion.promotion_status_change');
        Route::delete('/promotion/delete/{id}', 'promotion_delete')->name('promotion.delete');
    });
    Route::controller(SettingController::class)->group(function(){
        Route::get('/setting/genarel', 'setting_genarel')->name('setting.genarel');
        Route::post('/setting/genarel/save', 'setting_genarel_save')->name('setting.genarel.save');
        Route::get('/setting/logo', 'setting_logo')->name('setting.logo');
        Route::post('/setting/logo_update', 'logo_update')->name('setting.logo.update');
    });
    Route::resource('/brand', BrandController::class);
    Route::post('/brand/changestatus/{id}', [BrandController::class, 'change_status'])->name('change.status');
    Route::resource('/category', CategoryController::class);
    Route::get('/category/restore/{id}', [CategoryController::class, 'categoryrestore'])->name('category.restore');
    Route::get('/category/force/{id}', [CategoryController::class, 'forcedelete'])->name('category.forcedelete');
    Route::resource('/policy', PolicyController::class);
    Route::post('/policy/changestatus/{id}', [PolicyController::class, 'change_policy_status'])->name('change.policy.status');
    //Shipping
    Route::resource('/shipping', ShippingController::class);
});
// Only admin can see this route end

// SSLCOMMERZ Start
Route::controller(SslCommerzPaymentController::class)->group(function(){
    Route::get('/pay', 'index');
    Route::post('/pay-via-ajax', 'payViaAjax');
    Route::post('/success', 'success');
    Route::post('/fail', 'fail');
    Route::post('/cancel', 'cancel');
    Route::post('/ipn', 'ipn');
});
//SSLCOMMERZ END


Route::controller(StripeController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

// Email veryfacition
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
