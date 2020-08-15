<?php

use App\Http\Controllers\Front\FirstController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//use Mcamara\LaravelLocalization\LaravelLocalization;
use  Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('login',function()
{
    return view('login');
});

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/',function()
{
return view('welcome');
});
Route::get('/dashboard',function()
{
    return 'hhhhhhhh not adualt';
})->name('not.adult');

// Route::get('/redirect/{service}','SocialController@redirect');

// Route::get('/callback/{service}','SocialController@callback');

Route::group(['prefix' =>LaravelLocalization::setLocale(),	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ] ], function () {
    Route::group(['prefix' =>'offers'], function () {
        Route::get('create','CrudController@create') ;
        Route::post('store','CrudController@store')->name('offers.store');
        
        Route::get('edit/{offer_id}','CrudController@editOffer') ;
        Route::post('update/{offer_id}','CrudController@updateOffer')->name('offers.update');
        Route::get('delete/{offer_id}','CrudController@delete')->name('offers.delete');

        
        Route::get('all','CrudController@getAllOffers')->name('offers.all') ;

        Route::get('youtube','CrudController@getVideo' )->middleware('auth');
});
});


    
Route::group(['prefix' => 'ajax-offers'], function () {
    Route::get('create', 'OfferController@create');
    Route::post('store', 'OfferController@store')->name('ajax.offers.store');
    Route::get('all', 'OfferController@all')->name('ajax.offers.all');
    Route::post('delete', 'OfferController@delete')->name('ajax.offers.delete');
    Route::get('edit/{offer_id}', 'OfferController@edit')->name('ajax.offers.edit');
    Route::post('update', 'OfferController@Update')->name('ajax.offers.update');
});
    

#################################################
Route::group(['middleware' => 'CheckAge','namespace'=>'Auth'], function () {
    Route::get('adults','CustomeAuthController@adualt')->name('adult');

});



##################################################

Route::get('site', 'Auth\CustomeAuthController@site')->middleware('auth:web')-> name('site');
Route::get('admin', 'Auth\CustomeAuthController@admin')->middleware('auth:admin') -> name('admin');

 Route::get('admin/login', 'Auth\CustomeAuthController@adminLogin')-> name('admin.login');
Route::post('admin/login', 'Auth\CustomeAuthController@checkAdminLogin')-> name('save.admin.login');