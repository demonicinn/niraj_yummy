<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

//...
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\PreferencesController;
use App\Http\Controllers\Api\RestaurantsController;
use App\Http\Controllers\Api\RestaurantMenusController;
use App\Http\Controllers\Api\RestaurantReviewsController;
use App\Http\Controllers\Api\GroupsController;



   
Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});
         
Route::middleware('auth:sanctum')->group( function () {
    
    //user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //Profile
    Route::controller(ProfileController::class)->group(function () {
        Route::group(['prefix' => 'profile'], function(){
            //...
            Route::post('/', 'profile');
            Route::post('/password', 'password');
        });
    });


    //preferences
    Route::controller(PreferencesController::class)->group(function () {
        Route::group(['prefix' => 'preferences'], function(){
            //...
            Route::get('/', 'index');
            Route::post('/store', 'store');
        });
    });

    //restaurants
    Route::controller(RestaurantsController::class)->group(function () {
        Route::group(['prefix' => 'restaurants'], function(){
            //...
            Route::get('/', 'index');
            Route::post('/store', 'store');

            //...
            Route::get('/menu', 'menu');
            Route::post('/menu/store', 'menuStore');
        });
    });

    //restaurants menu
    Route::controller(RestaurantMenusController::class)->group(function () {
        Route::group(['prefix' => 'restaurants/menu'], function(){
            //...
            Route::post('/', 'index');
            Route::post('/store', 'store');
        });
    });

    //restaurants reviews
    Route::controller(RestaurantReviewsController::class)->group(function () {
        Route::group(['prefix' => 'restaurants/reviews'], function(){
            //...
            Route::post('/', 'index');
            Route::post('/store', 'store');
        });
    });

    //restaurants reviews
    Route::controller(GroupsController::class)->group(function () {
        Route::group(['prefix' => 'groups'], function(){
            //...
            Route::get('/', 'index');
            Route::post('/add', 'addUser');
            Route::post('/create', 'store');
            Route::get('/{code}/magic', 'magic');
            Route::get('/{group}', 'show');
        });
    });
    
    
});