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



Route::get('blog/{slug}','BlogController@getSingle')->name('blog.single');

Route::get('blog','BlogController@getIndex')->name('blog.index');


Route::get('/contact','PagesController@getContact');

Route::post('contact','PagesController@postContact');


Route::get('/about','PagesController@getAbout');


Route::get('/','PagesController@getIndex');

Route::resource('posts','PostController');

//comments
Route::post('comments/{post_id}',['uses'=>'CommentsController@store','as'=>'comments.store']);

//categories
Route::resource('categories','CategoryController',['except'=>['create']]);

//tags
Route::resource('tags','Tagcontroller',['except'=>['create']]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
