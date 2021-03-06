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

Route::get('/', 'WelcomeController@index');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('dashboard/articles/{articles}/confirm', ['as' => 'article.confirm', 'uses' => 'ArticleController@confirm']);
Route::resource('dashboard/article', 'ArticleController');

//Route::post('comment', ['as' => 'comment.store', 'uses' => 'CommentController@store']);
Route::post('comment', ['as' => 'comment.store', 'uses' => 'CommentController@store']);