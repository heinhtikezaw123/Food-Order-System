<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;

//for pizza order system


    Route::redirect('/', 'loginPage', 301);
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');




Route::middleware(['auth'])->group(function () {

    //dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    //admin
    Route::middleware(['admin_auth'])->group(function () {

        //categoary
        Route::prefix('category')->group(function () {
            Route::get('list',[CategoryController::class,'list'])->name('category#list');
            Route::get('createPage',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('create',[CategoryController::class,'create'])->name('category#create');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
            Route::post('update',[CategoryController::class,'update'])->name('category#update');
        });

        //admin account
        Route::prefix('admin')->group(function () {
            //password
            Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('password/change',[AdminController::class,'changePassword'])->name('admin#changePassword');

            //account details and edit
            Route::get('details',[AdminController::class,'details'])->name('admin#details');
            Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
            Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');

            //admin lists
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
            Route::post('change/{id}',[AdminController::class,'change'])->name('admin#change');
        });

        //products
        Route::prefix('products')->group(function () {
            Route::get('list',[ProductController::class,'list'])->name('product#list');
            Route::get('create',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('create',[ProductController::class,'create'])->name('product#create');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('details/{id}',[ProductController::class,'details'])->name('product#details');
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
            Route::post('update',[ProductController::class,'update'])->name('product#update');
        });

        //orders
        Route::prefix('order')->group(function () {
            Route::get('list',[OrderController::class,'orderList'])->name('admin#orderList');
            Route::get('change/status',[OrderController::class,'orderChangeStatus'])->name('admin#orderChangeStatus');
            Route::get('ajax/change/status',[OrderController::class,'ajaxChangeStatus'])->name('admin#ajaxChangeStatus');
            Route::get('listInfo/{orderCode}',[OrderController::class,'listInfo'])->name('admin#listInfo');
        });

         //user lists
         Route::prefix('user')->group(function () {
            Route::get('list',[UserController::class,'userList'])->name('admin#userList');
            Route::get('change/userRole',[UserController::class,'changeUserRole'])->name('admin#changeUserRole');
        });

         //admi change role
         Route::prefix('ajax')->group(function () {
            Route::get('change/adminRole',[AjaxController::class,'changeAdminRole'])->name('admin#changeAdminRole');
        });

        //contact from users
        Route::get('userContact/list/page',[AdminController::class,'userContactListPage'])->name('admin#userContactListPage');
        Route::get('userContact/delete/page/{id}',[AdminController::class,'userContactDelete'])->name('admin#userContactDelete');
    });

    //user
    //home
    Route::group(['prefix'=>'user','middleware' => 'user_auth'],function() {
        Route::get('/homePage',[UserController::class,'home'])->name('user#home');
        Route::get('/filter/{id}',[UserController::class,'filter'])->name('user#filter');
        Route::get('/history',[UserController::class,'history'])->name('user#history');

        Route::prefix('pizza')->group(function () {
            Route::get('details/{id}',[UserController::class,'pizzaDetails'])->name('user#pizzaDetails');
        });

        Route::prefix('cart')->group(function () {
            Route::get('list',[UserController::class,'cartList'])->name('user#cartList');
        });

        Route::prefix('password')->group(function () {
            Route::get('change',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('change',[Enter::class,'changePassword'])->name('user#changePassword');
        });

        Route::prefix('accouont')->group(function () {
            Route::get('change',[UserController::class,'accountChangePage'])->name('user#accountChangePage');
            Route::post('change/{id}',[UserController::class,'accountChange'])->name('user#accountChange');
        });

        Route::prefix('ajax')->group(function () {
            Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
            Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
            Route::get('clearCart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
            Route::get('clear/current/product',[AjaxController::class,'clearCurrentProduct'])->name('ajax#clearCurrentProduct');
            Route::get('increase/viewCount',[AjaxController::class,'increaseViewCount'])->name('ajax#increaseViewCount');
        });

        //contact
        Route::get('contact/page',[UserController::class,'userContact'])->name('user#contactPage');
        Route::post('create/contact/page',[UserController::class,'createUserContact'])->name('user#createUserContact');
    });


});

Route::get('webTesting',function() {
    $data = [
        'message' => 'this is web testing message'
    ];
    return response()->json($data, 200);
});






