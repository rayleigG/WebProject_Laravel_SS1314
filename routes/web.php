<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SlideshowController;
use App\Http\Controllers\UserController;
//use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//HomePage
Route::redirect('/register', '/login');
Route::redirect('/resetpassword', '/login');
Route::get('/re', [HomeController::class, 'resetPassword'])->name('resetPassword');
Route::post('/re', [HomeController::class, 'resetPasswordPost'])->name('resetPasswordPost');
Route::get('/', [HomeController::class, 'index'])->name('user.index');
Route::get('/shop', [HomeController::class, 'shop'])->name('user.shop');
Route::get('/product-detail/{id}', [ProductController::class, 'productDetail'])->name('product.detail');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
//logout
Route::get('/user/logout', [HomeController::class, 'logoutUser'])->name('user.logout');
//end logout
//AdminSite
Route::middleware(['auth', 'admin'])->prefix('/wp-admin')->group(function () {
    Route::get('/', [AdminController::class, 'indexAdmin'])->name('home');
    Route::get('/config', [AdminController::class, 'setting'])->name('config');
    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::post('/product-add', [ProductController::class, 'addProduct'])->name('add.product');
    Route::get('/product/toggle/{id}/{action}', [ProductController::class, 'toggleProduct'])->name('admin.toggleProduct');
    Route::post('/product-update', [ProductController::class, 'updateProduct'])->name('update.product');
    Route::get('/product/delete/{id}/', [ProductController::class, 'deleteProduct'])->name('admin.deleteProduct');
    Route::get('/user', [AdminController::class, 'user'])->name('user');
    Route::get('/category', [AdminController::class, 'category'])->name('category');
    Route::post('/category-add', [ProductController::class, 'addCategory'])->name('add.category');
    Route::post('/category-update', [ProductController::class, 'updateCategory'])->name('update.category');
    Route::get('/category/toggle/{id}/{action}', [ProductController::class, 'toggleCategory'])->name('admin.toggleCategory');
    Route::get('/page', [AdminController::class, 'page'])->name('page');
    //Slideshow
    Route::get('/slideshow', [SlideshowController::class, 'index'])->name('slideshow');
    Route::get('/slideshow/toggle/{id}/{action}', [SlideshowController::class, 'toggleSlideshow'])->name('toggleSlideshow');
    Route::get('/slideshow/reorder/{id}/{action}', [SlideshowController::class, 'reorderSlideshow'])->name('reorderSlideshow');
    Route::get('/slideshow/delete/{id}/', [SlideshowController::class, 'deleteSlideshow'])->name('admin.deleteSlideshow');
    Route::post('/slideshow/add', [SlideshowController::class, 'addSlideshow'])->name('admin.addSlideshow');
    Route::post('/slideshow/edit', [SlideshowController::class, 'editSlideshow'])->name('admin.editSlideshow');
    Route::get('/getslideshow', [SlideshowController::class, 'getslideshow'])->name('admin.getSlideshow');
    //Route::get('/slideshow/form', [SlideshowController::class, 'showFomSlideshow'])->name('admin.showFomSlideshow');
    //Route::get('/insertProduct', [SlideshowController::class, 'insertProduct'])->name('admin.insertProduct');
     //End Slideshow
    //Login and registerF
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::post('/register', [AdminController::class, 'registerPost'])->name('register');
    Route::get('/register', [AdminController::class, 'register'])->name('register');
});
//Login and Register
Route::get('/login', [AdminController::class, 'login'])->name('login'); // Login form
Route::post('/login', [AdminController::class, 'loginPost'])->name('loginPost'); // Login submission
// Route::get('/login-user', [UserController::class, 'loginUser'])->name('loginUser'); // Login form
// Route::post('/login-user', [UserController::class, 'loginPostUser'])->name('loginUser'); // Login submission
Route::post('/register-user', [UserController::class, 'registerUserPost'])->name('registerUser');
Route::get('/register-user', [UserController::class, 'registerUser'])->name('registerUser');
//Localization
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});
//End Localization
//Add to cart
Route::post('/removeProductFromCart', [HomeController::class, 'remove_cart'])->name('removeFromCart');
Route::post('/add_tocard/{id}', [HomeController::class, 'cart'])->name('shoppingCart');
Route::get('/cart', [HomeController::class, 'getProductsInCart']);
Route::get('/cart-ajax', [HomeController::class, 'getProductsInCartAjax']);
Route::get('/get-product-info', [HomeController::class, 'getProductInfoAjax']);
//End add to cart


//Payment with paypal sandbox
Route::post('/payment/charge', [PaymentController::class, 'charge'])->name('payment.charge');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/error', [PaymentController::class, 'error'])->name('payment.error');






