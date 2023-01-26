<?php

use App\Http\Middleware\RedirectIfNotAdminAuth;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Admin', 'prefix'=>"admin" ],function () {

    Route::get('/login','AuthController@login');
    Route::post('/login','AuthController@postlogin');
    Route::get('/logout','AuthController@logout');
    
    Route::group(['middleware'=>"RedirectIfNotAdminAuth"],function()
    {
        Route::get('/','DashboardController@show');
        Route::resource('/supplier', 'SupplierController');
        Route::resource('/brand', 'BrandController');
        Route::resource('/category', 'CategoryController');
        Route::resource('/product', 'ProductController');
        Route::resource('/product-transaction', 'ProductAddTransactionController');
    });
    });
