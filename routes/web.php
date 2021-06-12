<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Controllers\CartController;
use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\User\UserDashboardComponent;
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
Route::get('/cart/add/{product_id}', [CartController::class, 'addToCart'])->name('cart.store');
Route::get('/cart/delete/{cart_product_id}', [CartController::class, 'deleteFromCart'])->name('cart.delete');



// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
//For User
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
        Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard');
});
//For Admin
Route::middleware(['auth:sanctum', 'verified','authadmin'])->group(function(){
        Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
        Route::get('/admin/categories', AdminCategoryComponent::class)->name('admin.categories');
        Route::get('/admin/category/add', AdminAddCategoryComponent::class)->name('admin.addcategory');
        Route::get('/admin/category/edit/{category_slug}', AdminEditCategoryComponent::class)->name('admin.editcategory');
        Route::get('/admin/products',AdminProductComponent::class )->name('admin.products');
        Route::get('admin/product/add', AdminAddProductComponent::class)->name('admin.addproduct');
});
