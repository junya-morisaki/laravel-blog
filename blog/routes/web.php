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
//ＨＴＴＰメソッド修正する！！！！！！！！！！！！！！！！！！！！！！！！！！！！
Route::get('/','PostController@index');

Auth::routes();

Route::get('/home', 'PostController@index')->name('home');


Route::get('/post/edit', 'PostController@edit')->middleware('auth')->name('post.edit');
Route::post('/post', 'PostController@post')->middleware('auth')->name('post');
Route::get('/post/list', 'PostController@getall')->name('post.list');
Route::get('/post/content/{post_id}', 'PostController@getone')->name('post.content');
Route::get('/post/category/{category}','PostController@category')->name('post.category');
Route::get('/post/timeline','PostController@timeline')->middleware('auth')->name('post.timeline');
Route::get('/post/search','PostController@search')->name('post.search');

Route::get('/comment/{post_id}', 'CommentController@edit')->middleware('auth')->name('commentEdit');
Route::post('/comment/{post_id}', 'CommentController@post')->middleware('auth')->name('commentPost');

//ajax
Route::post('/fav/{post_id}', 'FavController@on')->middleware('auth')->name('favon');
Route::delete('/fav/{post_id}', 'FavController@off')->middleware('auth')->name('favoff');

Route::get('/fav/show','FavController@show')->middleware('auth')->name('fav.show');
Route::get('/fav/rank/{span}','FavController@rank')->middleware('auth')->name('fav.rank');

Route::post('/follow/on/{user_id}', 'FollowController@follow')->middleware('auth')->name('follow');
Route::post('/follow/off/{user_id}', 'FollowController@unfollow')->middleware('auth')->name('unfollow');
Route::get('/follow/show/{user_id}/{param}', 'FollowController@show')->middleware('auth')->name('follow.show');

Route::get('/user/prof/{user_id}','UserController@show')->middleware('auth')->name('user.prof');
Route::get('/user/edit/image','UserController@editImage')->middleware('auth')->name('user.editImage');
Route::post('/user/edit/image','UserController@postImage')->middleware('auth')->name('user.postImage');
Route::get('/user/edit/prof','UserController@editProf')->middleware('auth')->name('user.editProf');
Route::post('/user/edit/prof','UserController@postProf')->middleware('auth')->name('user.postImage');
Route::get('/user/posts/{user_id}','UserController@showPost')->middleware('auth')->name('user.posts');

Route::get('/message','MessageController@show')->middleware('auth')->name('message');



Route::group(['prefix' => 'admin'], function() {
Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
  Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.login');
  Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');

  Route::get('/', 'Admin\HomeController@index')->name('admin.home');
  Route::get('/home', 'Admin\HomeController@index')->name('admin.home');

  Route::get('register', 'Admin\Auth\RegisterController@showRegisterForm')->name('admin.register');
  Route::post('register', 'Admin\Auth\RegisterController@register')->name('admin.register');

  Route::get('/edit/{user_id}', 'Admin\MessageController@edit')->name('admin.edit');
  Route::post('/edit/{user_id}', 'Admin\MessageController@store')->name('admin.store');

});
