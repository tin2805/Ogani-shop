<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

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

//FrontEnd
Route::get('/', [HomeController::class, 'index']);
Route::get('/', [HomeController::class, 'homepage']);
Route::get('/shop-grid', [HomeController::class, 'shop_grid']);
Route::get('/show-login', [HomeController::class, 'show_login']);
Route::post('/login', [HomeController::class, 'login']);
Route::get('/show-register', [HomeController::class, 'show_register']);
Route::post('/register', [HomeController::class, 'register']);
Route::get('/shop-detail/{product_id}', [HomeController::class, 'shop_detail']);
Route::get('/shop-cart', [CartController::class, 'shop_cart']);
Route::get('/blog', [HomeController::class, 'show_blog']);
Route::get('/checkout', [HomeController::class, 'show_checkout']);
Route::get('/contact', [HomeController::class, 'show_contact']);
    //Product
    Route::get('/shop-grid/{category_id}', [HomeController::class, 'sort_by_cate']);
    //Cart
    Route::post('/save-cart', [CartController::class, 'save_cart']);
    Route::get('/delete-to-cart/{rowId}', [CartController::class, 'delete_to_cart']);
    Route::post('/update-cart', [CartController::class, 'update_cart']);

//BackEnd
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/show-login', [AdminController::class, 'show_login']);
Route::post('/admin/login', [AdminController::class, 'login']);
Route::get('/admin/show-register', [AdminController::class, 'show_register']);
Route::post('/admin/register', [AdminController::class, 'register']);
Route::get('/admin/logout', [AdminController::class, 'logout']);
    //Categories
    Route::get('/admin/add-category', [AdminController::class, 'add_category']);
    Route::post('/admin/save-category', [AdminController::class, 'save_category']);
    Route::get('/admin/show-category', [AdminController::class, 'show_category']);
    Route::get('/admin/update-status/{category_id}', [AdminController::class, 'update_status']);
    Route::get('/admin/edit-category/{category_id}', [AdminController::class, 'edit_category']);
    Route::post('/admin/update-category/{category_id}', [AdminController::class, 'update_category']);
    Route::get('/admin/delete-category/{category_id}', [AdminController::class, 'delete_category']);
    //Product
    Route::get('/admin/add-product', [ProductController::class, 'add_product']);
    Route::get('/admin/show-product', [ProductController::class, 'show_product']);
    Route::post('/admin/save-product', [ProductController::class, 'save_product']);
    Route::get('/admin/edit-product/{product_id}', [ProductController::class, 'edit_product']);
    Route::post('/admin/update-product/{product_id}', [ProductController::class, 'update_product']);
    Route::get('/admin/update-product-status/{product_id}', [ProductController::class, 'update_status_product']);
    Route::get('/admin/update-product-feature/{product_id}', [ProductController::class, 'update_feature_product']);
    Route::get('/admin/delete-product/{product_id}', [ProductController::class, 'delete_product']);