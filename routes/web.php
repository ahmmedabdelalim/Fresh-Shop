<?php

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
        });
        

    

    
    });


    
    

