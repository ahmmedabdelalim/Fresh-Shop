<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
//use Mcamara\LaravelLocalization\LaravelLocalization;

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




Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return 'not allowed';
})->name('NotAllowed');

/////////////
/////////*************** routes for crude controller *************

Route::group(['prefix' =>  LaravelLocalization::setLocale(),'middleware' =>
    [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
    function () {
        Route::group(['prefix' => 'offers'], function () {
        
        Route::get('create', [App\Http\Controllers\CrudController::class, 'create']);
        Route::post('store' , [App\Http\Controllers\CrudController::class, 'store'])->name('offers.store');

        // route for select data from db 
        Route::get('all',[App\Http\Controllers\CrudController::class, 'getAllOffer']);

        // route for edit data 
        Route::get('edit/{offer_id}',[App\Http\Controllers\CrudController::class, 'editOffer']);
        Route::post('update/{offer_id}' , [App\Http\Controllers\CrudController::class, 'updateoffer'])->name('offers.update');
        Route::get('delete/{offer_id}' , [App\Http\Controllers\CrudController::class, 'delete'])->name('offers.delete');
        });
        

    

    
    });

    ///////// ajax route /////////////////// 
    Route::group(['prefix' => 'ajaxoffers'], function () {
        
        Route::get('create', [App\Http\Controllers\OfferController::class, 'create']);
        Route::post('store' , [App\Http\Controllers\OfferController::class, 'store'])->name('ajax.offers.store');
        Route::get('all' , [App\Http\Controllers\OfferController::class, 'all'])->name('ajax.offers.all');
        Route::post('delete' , [App\Http\Controllers\OfferController::class, 'delete'])->name('ajax.offers.delete');
        Route::get('edit/{offer_id}',[App\Http\Controllers\OfferController::class, 'editoffer'])->name('ajax.offers.edit');
        Route::post('update' , [App\Http\Controllers\OfferController::class, 'updateoffer'])->name('ajax.offers.update');

    });
  ///////////// end of ajax///////////



    //////////// start of  authentication and guards ////////
    Route::group(['middleware' => 'CheckAge' ], function () {
    
    Route::get('adult',[App\Http\Controllers\Auth\CustomAuthController::class, 'adult'])->name('adult');
    
    });

    Route::get('site',[App\Http\Controllers\Auth\CustomAuthController::class, 'site'])->middleware('auth:web')->name('site');
    Route::get('admin',[App\Http\Controllers\Auth\CustomAuthController::class, 'admin'])->middleware('auth:admin')->name('admin');
        
    Route::get('admin/login',[App\Http\Controllers\Auth\CustomAuthController::class, 'adminlogin']) ->name('admin.login');
    Route::post('admin/login',[App\Http\Controllers\Auth\CustomAuthController::class, 'checkadmin'])->name('save.admin.login');
        
        


     //////////// end of  authentication and guards ////////

    ############## relation

    Route::get('hasone',[App\Http\Controllers\RelationController::class, 'hasOneRelation']);
    Route::get('Reversehasone',[App\Http\Controllers\RelationController::class, 'ReverseHasOne']);
    Route::get('gethasphone',[App\Http\Controllers\RelationController::class, 'gethasphone']);
    Route::get('getwithcondition',[App\Http\Controllers\RelationController::class, 'getwithcondition']);



