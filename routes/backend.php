<?php

use Illuminate\Support\Facades\Route;

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
define('PAGINATION_COUNT',10);
// زيها زي الي تحت بس الفرق انا عملت auth علشان مش اي حد يدخل غير الادمن
Route::group(['namespace' => 'Admins', 'middleware' => 'auth:admin'], function () {
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');



    ################################## begin languages ##########################
    Route::group(['prefix'=>'languages'],function()
    {
        Route::get('/', 'LanguagesController@index')->name('admin.languages');
        Route::get('/create', 'LanguagesController@create')->name('admin.languages.create');
        Route::post('/store', 'LanguagesController@store')->name('admin.languages.store');
        Route::get('/edit/{id}', 'LanguagesController@edit')->name('admin.languages.edit');
        Route::post('/update/{id}', 'LanguagesController@update')->name('admin.languages.update');
        Route::get('/delete/{id}', 'LanguagesController@destroy')->name('admin.languages.delete');


    });

    ################################# end languages #############################





    ################################## begin main_categories ##########################
    Route::group(['prefix'=>'main_categories'],function()
    {
        Route::get('/', 'MainCategoriesController@index')->name('admin.main_categories');
        Route::get('/create', 'MainCategoriesController@create')->name('admin.main_categories.create');
        Route::post('/store', 'MainCategoriesController@store')->name('admin.main_categories.store');
        Route::get('/edit/{id}', 'MainCategoriesController@edit')->name('admin.main_categories.edit');
        Route::post('/update/{id}', 'MainCategoriesController@update')->name('admin.main_categories.update');
        Route::get('/delete/{id}', 'MainCategoriesController@destroy')->name('admin.main_categories.delete');

        Route::get('/changeStatus/{id}', 'MainCategoriesController@changeStatus')->name('admin.main_categories.changeStatus');

    });

    ################################# end main_categories #############################




    ################################## begin sub_categories ##########################
    Route::group(['prefix'=>'sub_categories'],function()
    {
        Route::get('/', 'SubCategoriesController@index')->name('admin.sub_categories');
        Route::get('/create', 'SubCategoriesController@create')->name('admin.sub_categories.create');
        Route::post('/store', 'SubCategoriesController@store')->name('admin.sub_categories.store');
        Route::get('/edit/{id}', 'SubCategoriesController@edit')->name('admin.sub_categories.edit');
        Route::post('/update/{id}', 'SubCategoriesController@update')->name('admin.sub_categories.update');
        Route::get('/delete/{id}', 'SubCategoriesController@destroy')->name('admin.sub_categories.delete');

        Route::get('/changeStatus/{id}', 'SubCategoriesController@changeStatus')->name('admin.sub_categories.changeStatus');

    });

    ################################# end sub_categories #############################



    ################################## begin vendors ##########################
    Route::group(['prefix'=>'vendors'],function()
    {
        Route::get('/', 'VendorsController@index')->name('admin.vendors');
        Route::get('/create', 'VendorsController@create')->name('admin.vendors.create');
        Route::post('/store', 'VendorsController@store')->name('admin.vendors.store');
        Route::get('/edit/{id}', 'VendorsController@edit')->name('admin.vendors.edit');
        Route::post('/update/{id}', 'VendorsController@update')->name('admin.vendors.update');
        Route::get('/delete/{id}', 'VendorsController@destroy')->name('admin.vendors.delete');
        Route::get('/changeStatus/{id}', 'VendorsController@changeStatus')->name('admin.vendors.changeStatus');



    });

    ################################# end vendors #############################



});

//
//Route::get('/admin', function () {
//    return view('admin.dashboard');
//});


Route::group(['namespace' => 'Admins', 'middleware' => 'guest:admin'], function () {

    //prefix -->  admin --> add it in routeserverproviders
    Route::get('login', 'LoginController@getLogin')->name('get.admin.login');
    Route::post('login', 'LoginController@login')->name('admin.login');
});

 #########################test  file helper function #################
//Route::get('test-helpers',function ()
//////{
//////      return show_name();
//////});
///
///
/// ###########################
///
