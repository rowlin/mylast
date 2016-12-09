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
Route::get('today', 'HomeController@start');
Route::get('/tomorrow', 'HomeController@tomorrow');
Route::get('/later', 'HomeController@later');
Route::get('/all', 'HomeController@all');


    Auth::routes();
    Route::post('/like','LikeController@like')->name('like') ;
    Route::post('/adduser','UserController@adduser')->name('add_user');
    Route::get('/comment/{id?}','CommentController@index')->where(['id' => '[0-9]*'])->name('view_comment');
    Route::post('comment/create', 'CommentController@create')->name('comment.create');


Route::group(['middleware => web'], function() {
    Route::get('/admin', [
        'uses' => 'AdminController@admin',
        'as' => 'admin',
        'middleware' => 'roles',
        'roles'=> 'User'
    ]);


    Route::post('/admin/assign', [
        'uses' => 'AdminController@postAdminAssignRoles',
        'as' => 'admin.assign',
        'middleware' => 'roles',
        'roles'=> 'User'
    ]);

    Route::get('/home', [
        'uses' => 'HomeController@index',
        'as' => 'home',
        'middleware' => 'roles',
        'roles' => 'User'
    ]);

    Route::get('/profile', [
        'uses' => 'UserController@profile',
        'as' =>'profile',
        'middleware' => 'roles',
        'roles' => 'User'
    ]);

    Route::get('/profile/edit', [
        'uses' => 'UserController@edit',
        'as' =>'profile.edit',
        'middleware' => 'roles',
        'roles' => 'User'
    ]);


    Route::post('/profile/update', [
        'uses' => 'UserController@update',
        'as' =>'profile.update',
        'middleware' => 'roles',
        'roles' => 'User'
    ]);


    Route::get('/profile/{id}/ban', [
        'uses' => 'UserController@ban',
        'as' =>'profile.ban',
        'middleware' => 'roles',
        'roles' => 'Admin'
    ]);






});

Route::resource('ticket', 'TicketController');
