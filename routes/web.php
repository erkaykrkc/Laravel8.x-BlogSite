<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/', function () {
    return view('home.index');
});

Route::get("/home",[HomeController::class,'index'])->name('home');

/* Admin Routes */
Route::get("/admin",[\App\Http\Controllers\Admin\HomeController::class,'index'])->name('admin_home')->middleware('auth');
Route::get("/admin/login",[HomeController::class,'login'])->name('admin_login');
Route::post("/admin/logincheck",[HomeController::class,'logincheck'])->name('admin_logincheck');
Route::get("/admin/logout",[HomeController::class,'logout'])->name('admin_logout');

/* Admin - Category Route */

Route::middleware('auth')->prefix('admin')->group(function(){
    Route::get('/',[\App\Http\Controllers\Admin\HomeController::class,'index'])->name('admin_home');

    Route::get('/category',[\App\Http\Controllers\Admin\CategoryController::class,'index'])->name('admin_category');
    Route::get('/category/add',[\App\Http\Controllers\Admin\CategoryController::class,'add'])->name('admin_category_add');
    Route::post('/category/create',[\App\Http\Controllers\Admin\CategoryController::class,'create'])->name('admin_category_create');
    Route::get('/category/edit/{id}',[\App\Http\Controllers\Admin\CategoryController::class,'edit'])->name('admin_category_edit');
    Route::post('/category/update/{id}',[\App\Http\Controllers\Admin\CategoryController::class,'update'])->name('admin_category_update');
    Route::get('/category/delete/{id}',[\App\Http\Controllers\Admin\CategoryController::class,'destroy'])->name('admin_category_delete');
    Route::get('/category/show',[\App\Http\Controllers\Admin\CategoryController::class,'show'])->name('admin_category_show');

    /* Blog Routes */

    Route::prefix('blog')->group(function(){    
    Route::get('/',[\App\Http\Controllers\Admin\BlogController::class,'index'])->name('admin_blogs');
    Route::get('/create',[\App\Http\Controllers\Admin\BlogController::class,'create'])->name('admin_blog_add');
    Route::post('/store',[\App\Http\Controllers\Admin\BlogController::class,'store'])->name('admin_blog_store');
    Route::get('/edit/{id}',[\App\Http\Controllers\Admin\BlogController::class,'edit'])->name('admin_blog_edit');
    Route::post('/update/{id}',[\App\Http\Controllers\Admin\BlogController::class,'update'])->name('admin_blog_update');
    Route::get('/delete/{id}',[\App\Http\Controllers\Admin\BlogController::class,'destroy'])->name('admin_blog_delete');
    Route::get('/show',[\App\Http\Controllers\Admin\BlogController::class,'show'])->name('admin_blog_show');
    });

});


