<?php

use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ColorsController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SizesController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
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

Route::prefix('/')->name('')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('home');
    Route::get('/about', function () {
        return view('client.pages.about');
    });
    Route::get('contact', [ClientController::class, 'contact']);
    Route::post('contact', [ClientController::class, 'storeContact'])->name('contact.us.store');
    Route::get('/blog', [NewsController::class, 'blog'])->name('blog');
    Route::get('/product-detail/{id}', [ClientController::class, 'productDetail'])->name('productDetail');
    Route::get('/shop', [ClientController::class, 'shop'])->name('shop');
    Route::get('/categories/{id}', [ClientController::class, 'categoryProducts'])->name('categoryProducts');
    Route::get('/size/{id}', [ClientController::class, 'sizeProducts'])->name('sizeProducts');
    Route::get('/color/{id}', [ClientController::class, 'colorProducts'])->name('colorProducts');
    Route::get('/searchProduct', [ClientController::class, 'searchProduct'])->name('searchProduct');
});



Route::middleware('user')->group(function () {

    //Cart Routes
    Route::get('/gift-card-list', [GiftCardController::class, 'getGiftCardList']);
    Route::post('/cart/orders', [CartController::class, 'order'])->name('cart.orders');
    Route::resource('cart', CartController::class);
    Route::get('/cart/delete/{id}', [CartController::class, 'cartDelete']);
    Route::get('/cart-product', [CartController::class, 'cartProducts']);
    Route::get('cart/addToCart/{id}', [CartController::class, 'addToCart'])->name('cart.addToCart');
    // //Order
    Route::resource('order', OrderController::class);
    // //profile
    Route::get('/profile', [ClientController::class, 'profile'])->name('profile');
    Route::post('/profile', [ClientController::class, 'updateProfile'])->name('profile-update');
    //whistList
    Route::resource('wishlist', WishlistController::class);
    Route::get('/add-wishlist/{id}', [WishlistController::class, 'addWishList'])->name('add-wishlist');
});

Route::middleware('admin')->group(function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('home.index');
    Route::resource('user', UserController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('stock', StockController::class);
    Route::resource('news', NewsController::class);
    Route::resource('colors', ColorsController::class);
    Route::resource('sizes', SizesController::class);
    Route::resource('orders', AdminOrderController::class);
});


//Auth
Route::get('register', [RegisterController::class, 'create'])->name('register.create');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');
Route::get('login', [LoginController::class, 'create'])->name('login.create');
Route::post('login', [LoginController::class, 'store'])->name('login.store');
Route::get('/logout', [LoginController::class, 'destroy']);
Route::post('check-mail-register', [RegisterController::class, 'checkMailRegister'])->name('register.checkMail');
Route::post('/product/checkCode', [ProductController::class, 'checkProductCode'])->name('product.checkCode');
Route::post('check-user-login', [LoginController::class, 'checkUserLogin'])->name('login.checkUserLogin');
//Reset pass 
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
//Post comment
Route::post('/post-comment/{id}', [ClientController::class, 'postComment'])->name('post-comment');
Route::get('get-code', [ProductController::class, 'generateCode'])->name('get-code');
