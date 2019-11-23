<?php

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


Route::middleware(['visitors'])->group(function () {
    /*
     * Namespace : Login
     */
    Route::group(['namespace' => 'Login'], function () {
        /*
         * Login Routes
         */
        Route::group(['prefix' => ''], function () {
            Route::get('/', 'LoginController@login')->name('login');
            Route::post('/login', 'LoginController@postLogin')->name('postLogin');
        });

        /*
         * Activation by email Routes
         */
        Route::group(['prefix' => 'activation'], function () {
            Route::get('/{email}/{activationcode}', 'ActivationController@activateUser');
        });

        /*
         * Forgot Password Routes
         */
        Route::group(['prefix' => 'forgotpassword'], function () {
            Route::get('/', 'ForgetPasswordController@forgotPasword')->name('forgotpassword');
            Route::post('/', 'ForgetPasswordController@postForgotPassword')->name('postForgotpassword');
        });

        /*
         * Reset Routes
         */
        Route::group(['prefix' => 'reset'], function () {
            Route::get('/{email}/{code}', 'ForgetPasswordController@resetPassword')->name('resetPassword');
            Route::post('/{email}/{code}', 'ForgetPasswordController@postResetPassword')->name('postResetPassword');
        });
    });
    /* -- End of Namespace : Login group -- */
});


Route::middleware(['authcheck'])->group(function () {
    Route::get('/ss', function() {})->name('home');
    //change password routes
    Route::get('user/change-password', 'UserController@changePasswordForm')->name('user.changePassword.form');
    Route::post('user/change-password', 'UserController@changePassword')->name('user.changePassword');

    Route::get('/logout', 'Login\\LoginController@logout')->name('logout');
});

Route::middleware(['adminCheck'])->group(function () {

});

Route::middleware(['HRCheck'])->group(function () {
    Route::resource('users', 'UserController');
    Route::get('users/inactive/{id}', 'UserController@inactive')->name('users.inactive');
    Route::get('users/active/{id}', 'UserController@active')->name('users.active');
});
