<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminAddCouponComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminAddProductImageComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminCouponsComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdminEditCouponComponent;
use App\Http\Livewire\Admin\AdminEditProductComponent;
use App\Http\Livewire\Admin\AdminEditProductImageComponent;
use App\Http\Livewire\Admin\AdminOrderComponent;
use App\Http\Livewire\Admin\AdminOrderDetailsComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\Admin\AdminProductImageComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\User\UserOrderDetailsComponent;
use App\Http\Livewire\User\UserOrdersComponent;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/all-products', [ProductController::class, 'showProducts'])->name("showProducts");
Route::get('/category/{cat}/{alias}', [ProductController::class, 'show'])->name("showProduct");
Route::get('/category/{cat}', [ProductController::class, 'showCategory'])->name("showCategory");
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product_id}', [CartController::class, 'addToCart'])->name('cart.store');
Route::get('/cart/delete/{cart_product_id}', [CartController::class, 'deleteFromCart'])->name('cart.delete');
Route::get('/cart/cleat', [CartController::class, 'clearCart'])->name('clearCart');
Route::post('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/couponapply', [CouponController::class, 'applyCoupon'])->name('applyCoupon');
Route::post('/couponcancel', [CouponController::class, 'cancelCoupon'])->name('cancelCoupon');
Route::post('/order/place', [CheckoutController::class, 'placeOrder'])->name('order.place');
Route::get('/checkout/card', [CheckoutController::class, 'card'])->name('order.checkout');
Route::post('/checkout/card/proceed/{order_id}', [CheckoutController::class, 'proceed_payment'])->name('proceed.payment');
Route::get('/thankyou', [CheckoutController::class, 'thank'])->name('thankyou');




// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
//For User
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
        Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard');

        Route::get('/user/orders', UserOrdersComponent::class)->name('user.orders');
        Route::get('/user/orders/{order_id}', UserOrderDetailsComponent::class)->name('user.orderdetails');
});
//For Admin
Route::middleware(['auth:sanctum', 'verified','authadmin'])->group(function(){
        Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
        
        
        Route::get('/admin/categories', AdminCategoryComponent::class)->name('admin.categories');
        Route::get('/admin/category/add', AdminAddCategoryComponent::class)->name('admin.addcategory');
        Route::get('/admin/category/edit/{category_slug}', AdminEditCategoryComponent::class)->name('admin.editcategory');
        
        
        Route::get('/admin/products',AdminProductComponent::class )->name('admin.products');
        Route::get('admin/product/add', AdminAddProductComponent::class)->name('admin.addproduct');
        Route::get('/admin/product/edit/{product_alias}', AdminEditProductComponent::class)->name('admin.editproduct');
        
        
        Route::get('/admin/product-images', AdminProductImageComponent::class)->name('admin.productimages');
        Route::get('/admin/product-image/add', AdminAddProductImageComponent::class)->name('admin.addproductimage');
        Route::get('/admin/product-image/edit/{product_image_id}', AdminEditProductImageComponent::class)->name('admin.editproductimage');
        
        
        Route::get('/admin/coupons', AdminCouponsComponent::class)->name('admin.coupons');
        Route::get('/admin/coupon/add', AdminAddCouponComponent::class)->name('admin.addcoupon');
        Route::get('/admin/coupon/edit/{coupon_id}', AdminEditCouponComponent::class)->name('admin.editcoupon');
        
        
        Route::get('/admin/orders/', AdminOrderComponent::class)->name('admin.orders');
        Route::get('/admin/orders/{order_id}', AdminOrderDetailsComponent::class)->name('admin.orderdetails');
});
