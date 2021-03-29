<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/auth', 'UserController@profile')->middleware('auth:api');
Route::get('/logout', 'API\UserController@logout')->middleware('auth:api');
// forget password
Route::post('forget', 'Auth\ForgotPasswordController@getResetToken');
Route::post('avatar', 'API\UserController@avatar')->middleware('auth:api');

Route::resource('/category', 'API\CategoryController');
Route::resource('/branch', 'API\BranchController');
Route::resource('/user', 'API\UserController')->middleware('auth:api');
Route::post('/location', 'API\UserController@location')->middleware('auth:api');
Route::resource('/auth/product', 'API\ProductController')->middleware('auth:api');
Route::resource('/cart', 'API\CartController')->middleware('auth:api');
Route::get('/cartcount', 'API\CartController@count')->middleware('auth:api');
Route::resource('/favourite', 'API\FavouriteController')->middleware('auth:api');
Route::resource('/shipping', 'API\ShippingController')->middleware('auth:api');
Route::resource('/order', 'API\OrderController')->middleware('auth:api');
Route::resource('/review', 'API\ReviewController')->middleware('auth:api');
Route::resource('/firebase', 'API\FirebaseTokenController')->middleware('auth:api');
Route::resource('/banner', 'API\BannerController');
Route::resource('/page', 'API\PageController');
Route::resource('/group', 'Dashboard\GroupController');
Route::get('/setting', 'Dashboard\SettingController@index');
Route::resource('/ingredient', 'API\IngredientController');
Route::resource('/points', 'API\PointController')->middleware('auth:api');
Route::resource('/coupon', 'API\CouponController');
Route::resource('/user_coupon', 'API\UserCouponController')->middleware('auth:api');
//staff
Route::resource('/staff/order', 'API\Staff\OrderController')->middleware('auth:api');
Route::resource('/staff/delivery', 'API\Staff\DeliveryController')->middleware('auth:api');
Route::resource('/staff/user', 'API\Staff\UserController');
//devlivery
Route::resource('/delivery/order', 'API\Delivery\OrderController')->middleware('auth:api');
Route::get('/delivery/orderhistory', 'API\Delivery\OrderController@history')->middleware('auth:api');
Route::resource('/delivery/orderstatus', 'API\Delivery\OrderStatusController')->middleware('auth:api');
Route::resource('/delivery/orderpath', 'API\Delivery\OrderRiderPathController')->middleware('auth:api');
//Guest
Route::resource('/product', 'API\Guest\ProductController');

//Contactus
Route::resource('/contactus', 'API\ContactusController');