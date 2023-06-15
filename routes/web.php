<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
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
    Route::get('/user', [AdminController::class, 'user'])->name('user');
    Route::get('/category', [AdminController::class, 'category'])->name('category');
    Route::get('/page', [AdminController::class, 'page'])->name('page');
    //Slideshow
    Route::get('/slideshow', [SlideshowController::class, 'index'])->name('slideshow');
    Route::get('/slideshow/toggle/{id}/{action}', [SlideshowController::class, 'toggleSlideshow'])->name('toggleSlideshow');
    Route::get('/slideshow/reorder/{id}/{action}', [SlideshowController::class, 'reorderSlideshow'])->name('reorderSlideshow');
    Route::get('/slideshow/delete/{id}/', [SlideshowController::class, 'deleteSlideshow'])->name('admin.deleteSlideshow');
     //End Slideshow
    //Login and register
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::post('/register', [AdminController::class, 'registerPost'])->name('register');
    Route::get('/register', [AdminController::class, 'register'])->name('register');
});
//Login and Register
Route::get('/login', [AdminController::class, 'login'])->name('login'); // Login form
Route::post('/login', [AdminController::class, 'loginPost'])->name('login'); // Login submission
// Route::get('/login-user', [UserController::class, 'loginUser'])->name('loginUser'); // Login form
// Route::post('/login-user', [UserController::class, 'loginPostUser'])->name('loginUser'); // Login submission
// Route::post('/register-user', [UserController::class, 'registerUserPost'])->name('registerUser');
// Route::get('/register-user', [UserController::class, 'registerUser'])->name('registerUser');
//Localization
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});
//End Localization
//Add to cart
Route::post('/{id}', [HomeController::class, 'cart'])->name('shoppingCart');
Route::delete('/remove-from-cart/{id}', [HomeController::class, 'removeFromCart'])->name('removeFromCart');
//End add to cart
// Route::fallback(function () {
//     return redirect()->route('user.index'); // Replace 'home' with your desired route name
// });





// Route::get('/login', [AdminController::class, 'login'])->name('login'); // Login form
// Route::post('/login', [AdminController::class, 'loginPost'])->name('login'); // Login submission
// Route::get('/login-user', [UserController::class, 'loginUser'])->name('loginUser'); // Login form
// Route::post('/login-user', [UserController::class, 'loginPostUser'])->name('loginUser'); // Login submission
// Route::post('/register-user', [AdminController::class, 'registerUserPost'])->name('registerUser');
// Route::get('/register-user', [AdminController::class, 'registerUser'])->name('registerUser');

// Route::group(['middleware' => 'auth', 'prefix' => 'wp-admin'], function () {
//     //Admin page
//     Route::get('/', [HomeController::class, 'indexAdmin'])->name('home');
//     Route::get('/setting', [HomeController::class, 'indexAdmin'])->name('setting');
//     Route::get('/product', [HomeController::class, 'indexAdmin'])->name('product');
//     //End Admin page
//     //Authentication
//     Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
//     Route::post('/register', [AdminController::class, 'registerPost'])->name('register');
//     Route::get('/register', [AdminController::class, 'register'])->name('register');
//     //End Authentication
// });




