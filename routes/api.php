<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
Route::get('register-rules', 'HomeController@registerRules');
Route::get('approved-users-count', 'HomeController@approvedUsersCount');

Route::get('home', 'HomeController@home');
Route::get('reviews', 'HomeController@reviews');


Route::post('send-contact', 'HomeController@sendContactMessage');
Route::post('newsletter', 'HomeController@newsletter');


Route::get('categories', 'HomeController@categories');
Route::get('products', 'HomeController@products');
Route::get('products/{id}', 'HomeController@product');

Route::get('faqs', 'HomeController@faqs');
Route::get('rules', 'HomeController@rules');
Route::get('informations', 'HomeController@informations');
Route::get('pages/{id}', 'HomeController@pages');
Route::get('metas', 'HomeController@metas');
Route::get('our-inventory', 'HomeController@ourInventory');

Route::post('forgotPassword', '\App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail');


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['auth:api']], function () {

    Route::post('logout', 'HomeController@logout');

    // Dashboard
    Route::post('create-product', 'HomeController@createProduct');
    Route::post('add-bills', 'HomeController@addBills');
    Route::post('add-bid/{id}', 'HomeController@addBid');

    Route::get('current-user-bids', 'HomeController@currentUserBids');
    Route::get('pending-user-bids', 'HomeController@pendingUserBids');
    Route::get('finished-user-bids', 'HomeController@finishedUserBids');

    Route::get('upcoming-my-bids', 'HomeController@upcomingMyBids');
    Route::get('current-my-bids', 'HomeController@currentMyBids');
    Route::get('past-my-bids', 'HomeController@pastMyBids');

    Route::get('winning-bids', 'HomeController@winningBids');

    Route::post('add-or-remove-favourites/{id}', 'HomeController@addOrRemoveFavourites');
    Route::get('my-favourites', 'HomeController@myFavourites');


    Route::get('dashboard', 'HomeController@dashboard');

    Route::post('update-personal-information', 'HomeController@updatePersonalInformation');
    Route::post('update-password', 'HomeController@updatePassword');


    Route::post('add-review/{id}', 'HomeController@addReview');

    Route::post('charge-balance', 'HomeController@chargeBalance');
    Route::get('transactions', 'HomeController@transactions');

    Route::post('subscription', 'HomeController@subscription');
});
