<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ab\DashboardController;
use App\Http\Controllers\Ab\ProfileController;
use App\Http\Controllers\Ab\UsersController;
use App\Http\Controllers\Ab\RestaurantsController;


use App\Http\Middleware\EnsureUserRole;



Route::get('/migrate-fresh', function() {
	Artisan::call('migrate:fresh');
	return "migrate fresh";
});

Route::get('/storage', function() {
	Artisan::call('storage:link');
	return "storage";
});

Route::get('/optimize', function() {
	Artisan::call('optimize:clear');
	return "Data optimized";
});



/* ab routes */

Route::group(['middleware' => ['auth', 'verified']], function () {


    Route::group(['prefix' => 'ab'], function(){

        
        //Dashboard
        Route::controller(DashboardController::class)->group(function () {

            Route::get('/', 'dashboard')->name('ab');
            Route::get('/dashboard', 'dashboard')->name('ab.dashboard');
        });


        //Profile
        Route::group(['prefix' => 'profile'], function(){
            Route::controller(ProfileController::class)->group(function () {

                Route::get('/', 'index')->name('ab.profile');
                Route::put('/update', 'update')->name('ab.profile.update');

                //Password
                Route::group(['prefix' => 'password'], function(){
                    Route::get('/', 'password')->name('ab.profile.password');
                    Route::post('/changed', 'changePassword')->name('ab.profile.password.update');

                });
            });
        });



        //users
        Route::controller(UsersController::class)->group(function () {
            Route::group(['prefix' => 'users'], function(){
                Route::get('/', 'index')->name('ab.users');
                Route::match(['get', 'patch'], '/{user}/edit', 'edit')->name('ab.users.edit');
                Route::delete('/{user}/delete', 'delete')->name('ab.users.delete');
                Route::get('/{user}', 'show')->name('ab.users.show');
            });
        });
        

        //Restaurants
        Route::controller(RestaurantsController::class)->group(function () {
            Route::group(['prefix' => 'restaurants'], function(){
                Route::get('/', 'index')->name('ab.restaurants');
                Route::get('/{restaurant}', 'show')->name('ab.restaurants.show');
                Route::get('/{restaurant}/reviews', 'reviews')->name('ab.restaurants.reviews');
            });
        });

        
        
    });



    Route::get('/', function () {
        return redirect()->route('ab');
    });

});