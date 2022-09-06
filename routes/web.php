<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\DashboardController;

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
    return view('welcome');
});

// Route::group(
//     ['namespace' => 'Admin', 'prefix' => 'admin'],
//     function(){
//         Route::get('dashboard', 'DashboardController@index');
//     }
// );

Route::get('admin/dashboard', [DashboardController::class, 'index'])->middleware('auth');;
Route::resource('admin/categories', CategoryController::class)->middleware('auth');;
Route::resource('admin/products', ProductController::class)->middleware('auth');;
Route::get('admin/products/{productID}/images', [ProductController::class, 'images'])->middleware('auth');;
Route::get('admin/products/{productID}/add-image', [ProductController::class, 'add_image'])->middleware('auth');;
Route::post('admin/products/images/{productID}', [ProductController::class, 'upload_image'])->middleware('auth');;
Route::delete('admin/products/images/{imageID}', [ProductController::class, 'remove_image'])->middleware('auth');;

Route::resource('admin/attributes', AttributeController::class);
Route::get('admin/attributes/{attributeID}/options', [AttributeController::class, 'options'])->middleware('auth');;
Route::get('admin/attributes/{attributeID}/add-option', [AttributeController::class, 'add_option'])->middleware('auth');;
Route::post('admin/attributes/options/{attributeID}', [AttributeController::class, 'store_option'])->middleware('auth');;
Route::delete('admin/attributes/options/{optionID}', [AttributeController::class, 'remove_option'])->middleware('auth');;
Route::get('admin/attributes/options/{optionID}/edit', [AttributeController::class, 'edit_option'])->middleware('auth');;
Route::put('admin/attributes/options/{optionID}', [AttributeController::class, 'update_option'])->middleware('auth');;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
