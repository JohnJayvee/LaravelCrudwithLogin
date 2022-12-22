<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get(
    '/home',
    ['uses' => 'HomeController@home', 'as' => 'home']
);

Route::get(
    '/admin/home',
    ['uses' => 'HomeController@home', 'as' => 'admin.home', 'middleware' => 'adminAuth']
);

//*====================================[Routes for Auth]====================================//

Route::group([
    'as' => "auth.",
    'namespace' => "Auth",


], function () {

    Route::get(
        'register',
        'RegisterController@register'
    );
    Route::post(
        'register',
        ['uses' => 'RegisterController@storeUser', 'as' => 'register']
    );

    Route::get(
        'login',
        ['uses' => 'LoginController@login', 'as' => 'login']
    );
    Route::post(
        'login',
        'LoginController@authenticate'
    );
    Route::get(
        'logout',
        ['uses' => 'LoginController@logout', 'as' => 'logout']
    );

    Route::get(
        'forget-password',
        'ForgotPasswordController@getEmail'
    );
    Route::post(
        'forget-password',
        'ForgotPasswordController@postEmail'
    );

    Route::get(
        'reset-password/{token}',
        'ResetPasswordController@getPassword'
    );

    Route::post(
        'reset-password',
        'ResetPasswordController@updatePassword'
    );

    Route::get(
        '/changePassword',
        ['uses' => 'ChangePasswordController@index', 'as' => 'changePassword']
    );
    Route::post(
        '/changePassword',
        ['uses' => 'ChangePasswordController@storeNewPassword', 'as' => 'storeNewPassword']
    );
});
//!====================================[End of Auth]====================================//





Route::group([
    'as' => "customer.",
    // 'middleware' => "auth"
], function () {

    Route::get(
        '/customers',
        ['uses' => 'CustomerController@index', 'as' => 'index']
    );

    Route::get(
        '/customer/edit/{id}',
        ['uses' => 'CustomerController@edit', 'as' => 'edit']
    );

    Route::post(
        '/customer/store/',
        ['uses' => 'CustomerController@store', 'as' => 'store']
    );

    Route::PUT(
        '/customer/update/{id}',
        ['uses' => 'CustomerController@update', 'as' => 'update']
    );

    Route::delete(
        '/customer/{id}',
        ['uses' => 'CustomerController@destroy', 'as' => 'destroy']
    );
});