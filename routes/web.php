<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/login','App\Http\Controllers\HomeController@index')->name('login');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');
Route::get('/show/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('show');

Route::get('/','App\Http\Controllers\HomepageController@home')->name('homepage');

Route::group(['prefix' => '/profile'], function(){
    Route::get('/{id}','App\Http\Controllers\ProfileController@show')->name('profile');
    
    Route::get('edit/{id}','App\Http\Controllers\ProfileController@edit')->name('edit_profile');
    Route::post('update/{id}','App\Http\Controllers\ProfileController@update')->name('update_profile');

    Route::delete('delete/{id}','App\Http\Controllers\ProfileController@delete')->name('delete_profile');
});

Route::group(['prefix' => '/post'], function(){

    Route::get('/create','App\Http\Controllers\PostController@create')->name('create_post');
    Route::post('/store','App\Http\Controllers\PostController@store')->name('store_post');

    Route::get('/show','App\Http\Controllers\PostController@show')->name('show_post');
    Route::get('/open/{id}','App\Http\Controllers\PostController@open')->name('open_post');

    Route::get('/edit/{id}','App\Http\Controllers\PostController@edit')->name('edit_post');
    Route::patch('/update/{id}','App\Http\Controllers\PostController@update')->name('update_post');

    Route::delete('/delete/{id}', 'App\Http\Controllers\PostController@delete')->name('delete_post');

    
    Route::post('/add_comment/{id}','App\Http\Controllers\CommentController@add')->name('comment_post');
    Route::post('/{id}/like','App\Http\Controllers\PostController@like')->name('like_post');
    Route::post('{id}/share','App\Http\Controllers\PostController@share')->name('share_post');
});

Route::group(['prefix' => '/admin'], function(){

    Route::get('/users','App\Http\Controllers\AdminController@index')->name('show_users');
    
    Route::patch('/changerole/{id}','App\Http\Controllers\AdminController@role')->name('change_role');

    Route::delete('/banuser/{id}','App\Http\Controllers\AdminController@ban')->name('ban_user');    
});

Route::group(['prefix'=> '/tag','middleware' => ['admin'] ],function(){
    Route::get('/create','App\Http\Controllers\TagController@create')->name('create_tag');
    Route::post('/store','App\Http\Controllers\TagController@store')->name('save_tag');

    Route::get('/show','App\Http\Controllers\TagController@index')->name('show_tags');
    Route::get('/show/{id}','App\Http\Controllers\TagController@each_tag')->name('show_tag');
    
    Route::get('/edit/{id}','App\Http\Controllers\TagController@edit')->name('edit_tag');
    Route::patch('/update/{id}','App\Http\Controllers\TagController@update')->name('update_tag');

    Route::delete('/delete/{id}','App\Http\Controllers\TagController@delete')->name('delete_tag');
});

 