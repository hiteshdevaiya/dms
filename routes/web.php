<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

//Auth::routes();
//Language Translation
// Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

// Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

// //Update User Details
// Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
// Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
// Auth::routes();
Route::get('/clear', function() {
	Artisan::call('cache:clear');
	Artisan::call('route:clear');
	Artisan::call('config:clear');
	Artisan::call('view:clear');
	return "All cleared";
});

/*********************************************************************************
 *********************************************************************************
 *
 *                                      ADMIN
 *
 *********************************************************************************
 ********************************************************************************/

## Authentication Routes
Route::group([ 'prefix' => 'admin','namespace'=> 'App\Http\Controllers\Admin' ], function () {
	Route::get('/', 'Login@getLogin')->name('getLogin');				//	Show Login Form
	Route::get('/login', 'Login@getLogin')->name('getLogin');			//	Show Login Form
	Route::post('/login', 'Login@postLogin')->name('login');			//	Check Login
	Route::get('/logout', 'Login@getLogout')->name('logout');			//	LogOut
	Route::get('/forgotpassword', 'Login@getForgotPassword')->name('getForgotPassword');
	Route::post('/forgotpassword', 'Login@postForgotPassword')->name('forgotpassword');
	Route::get('/new-password/{id}', 'Login@newPassword');
	Route::post('/confirm-new-password', 'Login@postConfirmNewPassword')->name('confirm-new-password');
});

Route::post('/admin/checkemailexist', 'App\Http\Controllers\Validation@checkemailexist')->name('admin.checkemailexist'); // Get
Route::post('/admin/checkpassword', 'App\Http\Controllers\Validation@checkpassword')->name('admin.checkpassword'); // Check Current Password
Route::post('/admin/checkuseremailexist', 'App\Http\Controllers\Validation@checkuseremailexist')->name('admin.checkuseremailexist');
Route::post('/admin/checkdevoteemobileexist', 'App\Http\Controllers\Validation@checkdevoteemobileexist')->name('admin.checkdevoteemobileexist');

Route::post('/getstate','App\Http\Controllers\Validation@getstate')->name('getstate'); // Get City using Country ID
Route::post('/getcity','App\Http\Controllers\Validation@getcity')->name('getcity'); // Get City using State ID
Route::post('/getmultiplestate','App\Http\Controllers\Validation@getmultiplestate')->name('getmultiplestate'); // Get City using Country ID
Route::post('/getmultiplecity','App\Http\Controllers\Validation@getmultiplecity')->name('getmultiplecity'); // Get City using State ID
Route::post('dropdown/country/states-options', 'App\Http\Controllers\Validation@getStatesOptions');
Route::post('dropdown/country/cities-options', 'App\Http\Controllers\Validation@getCitiesOptions');
Route::post('copyotheraddress', 'App\Http\Controllers\Validation@copyotheraddress');



## Dashboard
Route::group([ 'prefix' => 'admin','namespace'=> 'App\Http\Controllers\Admin', 'middleware' => ['admin'] ], function () {
	Route::get('/dashboard','Dashboard@index')->name('dashboard');
	## Settings
	Route::group(['prefix'=>'profile'], function () {
		Route::get('/', 'Profile@getAccountSettings')->name('profile');
		Route::post('/', 'Profile@updateAccountSettings')->name('update_profile');
		Route::get('/change-password', 'Profile@getChangePassword');
		Route::post('/change-password', 'Profile@postChangePassword')->name('change-password');
	});


	## User
	Route::group([ 'prefix' => 'users', 'middleware' => ['admin'] ], function () {
		Route::get('/','User@index')->name('users');
		Route::get('/add','User@Add')->name('users.add');
		Route::get('/edit/{id}','User@Edit')->name('users.edit');
		Route::match(['get','post'],'/action/{action}/{_id}','User@Action')->name('users.action');
		Route::post('/multiple_delete','User@multiple_delete')->name('users.multiple_delete');
		Route::post('/delete_user_image','User@delete_user_image')->name('devotee.delete_user_image');
	});

	## Devotee
	Route::group([ 'prefix' => 'devotees', 'middleware' => ['admin'] ], function () {
		Route::get('/','Devotee@index')->name('devotee');
		Route::get('/add','Devotee@Add')->name('devotee.add');
		Route::get('/edit/{id}','Devotee@Edit')->name('devotee.edit');
		Route::get('/view/{id}','Devotee@View')->name('devotee.view');
		Route::match(['get','post'],'/action/{action}/{_id}','Devotee@Action')->name('devotee.action');
		Route::post('/multiple_delete','Devotee@multiple_delete')->name('devotee.multiple_delete');
		Route::post('/export','Devotee@Export')->name('devotee.export');
		Route::post('/import','Devotee@Import')->name('devotee.import');
		Route::get('/download-devotee-sample','Devotee@downloadSample')->name('devotee.downloadSample');
		Route::post('/delete_devotee_image','Devotee@delete_devotee_image')->name('devotee.delete_devotee_image');
		Route::post('/multiple_assign_category','Devotee@multiple_assign_category')->name('devotee.multiple_assign_category');

	});

    ## Category
	Route::group([ 'prefix' => 'categories', 'middleware' => ['admin'] ], function () {
		Route::get('/','Category@index')->name('categories');
		Route::get('/add','Category@Add')->name('categories.add');
		Route::get('/edit/{id}','Category@Edit')->name('categories.edit');
		Route::match(['get','post'],'/action/{action}/{_id}','Category@Action')->name('categories.action');
		Route::post('/multiple_delete','Category@multiple_delete')->name('categories.multiple_delete');
	});


	## Country
	Route::group([ 'prefix' => 'countries', 'middleware' => ['admin'] ], function () {
		Route::get('/','Country@index')->name('countries');
		Route::get('/add','Country@Add')->name('countries.add');
		Route::get('/edit/{id}','Country@Edit')->name('countries.edit');
		Route::match(['get','post'],'/action/{action}/{_id}','Country@Action')->name('countries.action');
		Route::post('/multiple_delete','Country@multiple_delete')->name('countries.multiple_delete');
	});

	## State
	Route::group([ 'prefix' => 'states', 'middleware' => ['admin'] ], function () {
		Route::get('/','State@index')->name('states');
		Route::get('/add','State@Add')->name('states.add');
		Route::get('/edit/{id}','State@Edit')->name('states.edit');
		Route::match(['get','post'],'/action/{action}/{_id}','State@Action')->name('states.action');
		Route::post('/multiple_delete','State@multiple_delete')->name('states.multiple_delete');
	});

	## City
	Route::group([ 'prefix' => 'cities', 'middleware' => ['admin'] ], function () {
		Route::get('/','City@index')->name('cities');
		Route::get('/add','City@Add')->name('cities.add');
		Route::get('/edit/{id}','City@Edit')->name('cities.edit');
		Route::match(['get','post'],'/action/{action}/{_id}','City@Action')->name('cities.action');
		Route::post('/multiple_delete','City@multiple_delete')->name('cities.multiple_delete');
	});

});


##################################Front route ####################################
## Authentication Routes
Route::group(['namespace'=> 'App\Http\Controllers\Front' ], function () {
    Route::get('/', 'Login@frontLogin')->name('front.login');				//	Show Login Form
    Route::get('/login', 'Login@frontLogin')->name('front.login');			//	Show Login Form
    Route::post('/login', 'Login@frontPostLogin')->name('front.login');			//	Check Login
    Route::get('/logout', 'Login@frontLogout')->name('front.logout');			//	LogOut
    Route::get('/verify-otp', 'Login@verifyOtp')->name('front.verify.otp');			//	Show Login Form
    Route::post('/verify-otp/check', 'Login@verifyOtpCheck')->name('front.verify.otp.check');			//	Check Login
    Route::get('/forgotpassword', 'Login@getForgotPassword')->name('front.getForgotPassword');
	Route::post('/forgotpassword', 'Login@postForgotPassword')->name('front.forgotpassword');
	Route::get('/new-password/{id}', 'Login@newPassword')->name('front.new.password');
	Route::post('/confirm-new-password', 'Login@postConfirmNewPassword')->name('front.confirm.password');

    Route::get('/sgvp','App\Http\Controllers\Front\Devotee@Add')->name('front.devotee.add');
    Route::match(['get','post'],'/front/devotee/action/{action}/{_id}','App\Http\Controllers\Front\Devotee@Action')->name('front.devotee.action');
});
