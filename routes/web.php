<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/','HomeController@start');
Route::get('today', 'HomeController@today');
Route::get('/tomorrow', 'HomeController@tomorrow');
Route::get('/later', 'HomeController@later');


Auth::routes();

Route::group(['middleware =>web'], function() {
    Route::get('/admin', [
        'uses' => 'AdminController@admin',
        'as' => 'admin',
        'middleware' => 'roles',
        'roles'=> 'Admin'
    ]);

    Route::post('/admin/assign', [
        'uses' => 'AdminController@postAdminAssignRoles',
        'as' => 'admin.assign',
        'middleware' => 'roles',
        'roles'=> 'Admin'
    ]);

    Route::get('/home', [
        'uses' => 'HomeController@index',
        'as' => 'home',
        'roles' => ''
    ]);

    //Route::get('/ticket/create', 'TicketController@create');
    //Route::get('/ticket', 'TicketController@index');
    //Route::post('/ticket/store', 'TicketController@store');
});


Route::resource('ticket', 'TicketController');

//Route::get('/ticket','' )