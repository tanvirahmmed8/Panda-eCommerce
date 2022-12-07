<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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

// Route::get('/mail', function () {
//     return view('email.newadminadd');
// });

Route::get('/', [ForntendController::class, 'index'])->name('index');
Route::get('/about-us', [ForntendController::class, 'about'])->name('about');
Route::get('/cart', [ForntendController::class, 'cart'])->name('cart');
Route::get('/checkout', [ForntendController::class, 'checkout'])->name('checkout');
Route::post('/checkoutpost', [ForntendController::class, 'checkoutpost'])->name('checkoutpost');
Route::post('/getcitylist', [ForntendController::class, 'getcitylist'])->name('getcitylist');
Route::get('/shop', [ForntendController::class, 'shop'])->name('shop');
Route::get('/search-category/{id}', [ForntendController::class, 'search_category'])->name('search.category');
Route::get('/contact-us', [ForntendController::class, 'contact'])->name('contact');
Route::post('/contact-post', [ForntendController::class, 'contact_post'])->name('contact.post');
Route::get('/login-register', [ForntendController::class, 'login_register'])->name('login.register');
Route::get('/team', [ForntendController::class, 'team']);
Route::post('/team/post', [ForntendController::class, 'teampost']);
Route::get('/team/edit/{id}', [ForntendController::class, 'teamedit']);
Route::post('/team/update/{id}', [ForntendController::class, 'teamupdate']);
Route::get('/team/delete/{id}', [ForntendController::class, 'teamdelete']);
Route::get('/team/restore/{id}', [ForntendController::class, 'teamrestore']);
Route::get('/team/forcedelete/{id}', [ForntendController::class, 'teamforcedelete']);
// ptoduct view
Route::get('/single-product/{id}', [ForntendController::class, 'single_product'])->name('single.product');
Route::get('/test', [ForntendController::class, 'test'])->name('test');


// Auth::routes();
Auth::routes(['register' => false]);
// HomeController start
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified']);
Route::post('/profileupdate', [HomeController::class, 'profileupdate'])->name('profileupdate')->middleware(['auth', 'verified']);

// ProfileController Start
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
Route::post('/profile/photo/upload', [ProfileController::class, 'profilephotoupload'])->name('profile.photo.upload');
Route::post('/cover/photo/upload', [ProfileController::class, 'coverphoto'])->name('cover.photo.upload');
Route::post('/password/change', [ProfileController::class, 'password_change'])->name('password.change');

// CustomerController
Route::post('/customer/login', [CustomerController::class, 'customer_login'])->name('customer.login');
Route::post('/customer/login/modal', [CustomerController::class, 'customer_login_modal'])->name('customer.login.modal');
Route::post('/customer/register', [CustomerController::class, 'customer_register'])->name('customer.register');
Route::get('/download/invoice/{id}', [CustomerController::class, 'download_invoice'])->name('download.invoice');

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

// VendorController Start
Route::get('vendor/registration', [VendorController::class, 'vendor_registration'])->name('vendor.registration');
Route::post('vendor/registration', [VendorController::class, 'vendor_registration_post'])->name('vendor.registration.post');
Route::get('vendor/login', [VendorController::class, 'vendor_login'])->name('vendor.login');
Route::post('vendor/login', [VendorController::class, 'vendor_login_post'])->name('vendor.login.post');
// VendorController end

// Only vendor can see this route start
Route::middleware(['vendor'])->group(function () {
    Route::get('vendor/order/{id}', [VendorController::class, 'vendor_order'])->name('vendor.order');
    Route::post('order/status/change/{id}', [VendorController::class, 'order_status'])->name('order.status');
    Route::resource('/product', ProductController::class);
    Route::resource('/coupon', CouponController::class);
    Route::get('product/inventory/{product}', [ProductController::class, 'inventory'])->name('inventory');
    Route::post('product/inventory/add/{product}', [ProductController::class, 'addinventory'])->name('addinventory');
    Route::resource('/variation', VariationController::class);
});
// Only vendor can see this route end


// Only admin can see this route start
Route::middleware(['admin'])->group(function () {
    //HomeController start
    Route::get('/users', [HomeController::class, 'users'])->name('users');
    Route::post('addnew/admin', [HomeController::class, 'addnew_admin'])->name('addnew.admin');
    Route::post('vendor/action/change/{id}', [HomeController::class, 'vendor_action_change'])->name('vendor.action.change');
    //HomeController end
    //BrandController start
    Route::resource('/brand', BrandController::class);
    Route::post('/brand/changestatus/{id}', [BrandController::class, 'change_status'])->name('change.status');
    //BrandController end
    // CategoryController start
    Route::resource('/category', CategoryController::class);
    Route::get('/category/restore/{id}', [CategoryController::class, 'categoryrestore'])->name('category.restore');
    Route::get('/category/force/{id}', [CategoryController::class, 'forcedelete'])->name('category.forcedelete');
    //CategoryController end
    //PolicyController start
    Route::resource('/policy', PolicyController::class);
    Route::post('/policy/changestatus/{id}', [PolicyController::class, 'change_policy_status'])->name('change.policy.status');
    //PolicyController end
    //Shipping
    Route::resource('/shipping', ShippingController::class);
});
// Only admin can see this route end


// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::get('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END


Route::controller(StripeController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});
