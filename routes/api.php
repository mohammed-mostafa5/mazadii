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

Route::get('test', 'HomeController@test');

Route::post('register', 'HomeController@register');
Route::post('login', 'HomeController@login');

Route::get('home', 'HomeController@home');


Route::post('send-contact', 'HomeController@sendContactMessage');
Route::post('newsletter', 'HomeController@newsletter');


Route::get('categories', 'HomeController@categories');
Route::get('products', 'HomeController@products');
Route::get('products/{id}', 'HomeController@product');


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['auth:api']], function () {

    Route::post('logout', 'HomeController@logout');
    Route::post('create-product', 'HomeController@createProduct');
    Route::post('add-bid/{id}', 'HomeController@addBid');
});
