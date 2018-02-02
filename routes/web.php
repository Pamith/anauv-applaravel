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
use App\ParentCategory;

Route::get('/', 'HomeController@mainpage')->name('homepage');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('login/facebook', 'OAuth\SocialLoginController@FacebookRedircet');
Route::get('login/facebook/retrieve', 'OAuth\SocialLoginController@FacebookCallback');
Route::post('login/social', 'OAuth\SocialLoginController@SocialCallback');
Route::post('getlocation', 'locationController@GetAddress');
Route::post('getlatlong', 'locationController@GetLatLong');
Route::get('/addBussiness', ['middleware' => 'guest',function()
{
            $cat = ParentCategory::where('parent_id',0)->get();
            return View::make('retailers.addretailer')
            ->with('cat',$cat);
}])->name('addRetailer');

Route::post('/addRetailer','retailers\RetailerController@AddRetailer')->name('processRetailer');

    Route::group(array('prefix' => 'retailer','middleware'=>'retailerRole'), function()
    {        
        Route::get('/',[ 'middleware' =>'profilecheck', 'uses'=>'retailers\RetailerController@gettingRetailerData'])->name('RetailerDashboard');          
        
        Route::get('your-offers', function()
        {
            return View::make('retailers.yourOffers');
        });
        
        Route::get('createoffers', 'retailers\RetailerController@createoffers');
        Route::post('createoffers','retailers\OfferController@AddOffer')->name('AddOffer');
    });

    Route::group(array('prefix' => 'user','middleware'=>'userRole'), function()
    {        
        Route::get('/',[ 'middleware' => 'profilecheck','uses'=>'users\UserController@gettingUserData'])->name('UserDashboard');
        
        Route::get('edit', ['uses' => 'users\UserController@UserDataEdit']);

        Route::get('interests',['uses' => 'users\UserController@listInterests']);
            
        Route::post('edit', ['uses' => 'users\UserController@updateUserData'])->name('editUser');

        Route::post('interests', ['uses'=>'users\UserController@addUserInterests']);

        
        Route::get('posts/create', function()
        {
            return View::make('user.posts-create');
        });
    });
    Route::group(array('prefix' => 'admin'), function()
    {        
        Route::get('/', function()
        {
            return View::make('admin.AdminDashboard');
        })->name('AdminDashboard');

        Route::get('/addcategory', function()
        {
            return View::make('admin.addCategory');
        })->name('AddCategory');

        Route::post('/addCategory','shop\CategoryController@addCategory')
                   ->name('processCategory');
        
        Route::get('posts', function()
        {
            return View::make('admin.posts');
        });

        
        Route::get('posts/create', function()
        {
            return View::make('admin.posts-create');
        });
    });
    Route::group(array('prefix'=>'shop','middleware'=>'userRole'),function(){
        Route::get('/','shop\HomeController@ShopHome')->name('shop');
        Route::post('/filters','shop\HomeController@filter');
        Route::post('/sendcoupon','shop\CouponController@SendCouponCode');
        Route::get('/category/{id}','shop\CategoryController@CategoryPageListing');
        Route::post('/requestOffer','shop\HomeController@RequestOffer');

    });



