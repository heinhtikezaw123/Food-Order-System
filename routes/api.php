<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//GET
Route::get('product/list',[RouteController::class,'productList']);
Route::get('category/list',[RouteController::class,'categoryList']);
Route::get('contact/list',[RouteController::class,'contactList']);

//POST
Route::post('create/category',[RouteController::class,'createCategory']);
Route::post('create/contact',[RouteController::class,'createContact']);
Route::get('delete/category/{id}',[RouteController::class,'deleteCategory']);


// product list
// http://127.0.0.1:8000/api/product/list (GET)

//category list
// http://127.0.0.1:8000/api/category/list (GET)

//create category
// http://127.0.0.1:8000/api/create/category (POST)


