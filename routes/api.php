<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', 'Api\AuthController@login')->name('login');
    Route::get('get-user-info', 'Api\AuthController@getUserInfo')->name('getUserInfo');
    Route::get('logout', 'Api\AuthController@logout')->name('logout');
    Route::post('find-password', 'Api\AuthController@findPassword')->name('findPassword');
    Route::post('sign-up', 'Api\AuthController@signUp')->name('signUp');
    Route::post('update-user-info', 'Api\AuthController@updateUserInfo')->name('updateUserInfo');
    Route::post('update-avatar', 'Api\AuthController@updateAvatar')->name('updateAvatar');

    // Route::get('email/resend', 'Api\VerificationController@resend')->name('verification.resend');
    // Route::get('email/verify/{id}/{hash}', 'Api\VerificationController@verify')->name('verification.verify');
});

Route::group(['middleware' => 'api', 'prefix' => 'product'], function ($router) {
    Route::get('index', 'Api\ProductController@index')->name('index');
    Route::post('add', 'Api\ProductController@add')->name('add');
    Route::get('find/{id}', 'Api\ProductController@find')->name('find');
    Route::post('update', 'Api\ProductController@update')->name('update');
    Route::get('delete/{id}', 'Api\ProductController@delete')->name('delete');
});
