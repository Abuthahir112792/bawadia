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
// Route::get('/foo', function () {
//     Artisan::call('storage:link');
//     });

Route::post('/payment', 'Dashboard\SadadController@sadadPayment');   //sadad Payment 
Route::post('/callback', 'Dashboard\SadadController@sadadResponse');   //sadad response 

Route::get('/', function () {
    return redirect()->route('front.homes');
});
Route::namespace('Front')->group(function(){
    Route::get('homes','HomeController@index')->name('front.homes');
    Route::get('aboutus','HomeController@aboutus')->name('front.aboutus');
    Route::get('contactus','HomeController@contactus')->name('front.contactus');
    Route::get('product','HomeController@product')->name('front.product');
    Route::get('productdetails','HomeController@productdetails')->name('front.productdetails');
    Route::get('shoppingcart','HomeController@shoppingcart')->name('front.shoppingcart');
    Route::get('checkout','HomeController@checkout')->name('front.checkout');
    Route::get('wishlist','HomeController@wishlist')->name('front.wishlist');
    Route::get('customerregister','HomeController@customerregister')->name('front.customerregister');
    Route::get('customerlogin','HomeController@customerlogin')->name('front.customerlogin');
    Route::get('changeproductsize/{product_size?}','HomeController@product_size');
 });

Route::get('/bawadicms', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('verified');
Route::get('/logoutuser', 'UserController@logout');

// Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/passwordchange', 'UserController@passwordchange');

//resources
Route::prefix('/app')->group(function () {
    Route::resource('/setting', 'Dashboard\SettingController');
    Route::resource('/user', 'UserController');
    Route::resource('/category', 'Dashboard\CategoryController');
    Route::resource('/subcategory', 'Dashboard\SubcategoryController');
    Route::resource('/branch', 'Dashboard\BranchController');
    Route::resource('/product', 'Dashboard\ProductController');
    Route::resource('/customer', 'Dashboard\CustomerController');
    Route::resource('/shipping', 'Dashboard\ShippingController');
    Route::resource('/order', 'Dashboard\OrderController');
    Route::resource('/orderstatus', 'Dashboard\OrderStatusController');
    Route::resource('/page', 'Dashboard\PageController');
    Route::resource('/cuisine', 'Dashboard\CuisineController');
    Route::resource('/tag', 'Dashboard\TagController');
    Route::resource('/ingredient', 'Dashboard\IngredientController');
    Route::resource('/ingredient_category', 'Dashboard\IngredientCategoryController');
    Route::resource('/delivery', 'Dashboard\DeliveryController');
    Route::resource('/review', 'Dashboard\ReviewController');
    Route::resource('/tablebooking', 'Dashboard\TableBookingController');  
    Route::resource('/messbooking', 'Dashboard\MessBookingController'); 
    Route::resource('/getday', 'Dashboard\DayController');      
    Route::resource('/firebase', 'Dashboard\FirebaseTokenController'); 
    Route::resource('/folder', 'Dashboard\ImageFolderController');
    Route::resource('/image', 'Dashboard\ImageController');
    Route::resource('/banner', 'Dashboard\BannerController');
    Route::resource('/print', 'Dashboard\PrintController');
    Route::post('/branch_update', 'Dashboard\ProductController@branchUpdate');
    Route::post('/firebase_login', 'UserController@firebaseLogin');
    Route::resource('/group', 'Dashboard\GroupController');
    Route::resource('/contactus', 'Dashboard\ContactusController');
    Route::resource('/coupon', 'Dashboard\CouponController');
});

Route::prefix('/app/report')->group(function () {

    Route::get('/order', 'Dashboard\ReportController@order');
    Route::get('/earning', 'Dashboard\ReportController@earning');
    Route::get('/commission', 'Dashboard\ReportController@commission');
    Route::get('/activitylog', 'Dashboard\ReportController@activitylog');
    
});
//extra data getting
Route::get('/app/userlog', 'UserController@getUserLog');
Route::get('/app/gettablebooking', 'Dashboard\TableBookingController@tablebooking');  
Route::get('/app/getproduct', 'Dashboard\MessBookingController@getproduct');

//dashboard
Route::get('app/dashboard', 'Dashboard\DashboardController@index');
Route::get('app/categories', 'Dashboard\CategoryController@categories');
Route::get('app/subcategories', 'Dashboard\SubcategoryController@subcategories');
Route::get('app/products', 'Dashboard\ProductController@products');
Route::post('app/branch_by_category', 'Dashboard\BranchController@branch_by_category');
Route::post('app/branch_by_subcategory', 'Dashboard\BranchController@branch_by_subcategory');
Route::post('app/subcategory_by_category', 'Dashboard\SubcategoryController@subcategory_by_category');


//setting
Route::post('/app/updateUser','UserController@updateUser');
Route::get('/app/profile', 'UserController@profile');
Route::post('/app/changepassword', 'UserController@changePass');
Route::post('/app/avatar','UserController@avatar');
Route::post('/app/logo','Dashboard\SettingController@logo');
//Staff
Route::post('/app/login', 'UserController@login');
Route::get('/app/auth', 'UserController@profile')->middleware('auth:api');
Route::post('/app/staff/complete', 'Staff\StaffController@complete')->middleware('auth:api');
Route::post('/app/staff/updateagent', 'Staff\StaffController@updateAgent');

//staff resources
Route::get('/home', 'HomeController@dashboard')->name('home');
Route::resource('/test', 'TestController');
Route::resource('/app/testproduct', 'API\IngredientController');

Route::any('/{slug}/{child}', [
    'uses' => 'HomeController@dashboard',
 ])->middleware('verified');
 Route::any('/{slug}/{child}/{sub}', [
    'uses' => 'HomeController@dashboard',
 ])->middleware('verified');
 Route::any('/{slug}/{child}/{sub}/{id}', [
    'uses' => 'HomeController@dashboard',
 ])->middleware('verified');

