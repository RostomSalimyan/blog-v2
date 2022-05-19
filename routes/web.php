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

Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/post/{slug}', 'App\Http\Controllers\HomeController@show')->name('post.show');
Route::get('/tag/{slug}', 'App\Http\Controllers\HomeController@tag')->name('tag.show');
Route::get('/category/{slug}', 'App\Http\Controllers\HomeController@category')->name('category.show');
Route::post('/subscribe', 'App\Http\Controllers\SubsController@subscribe');
Route::get('/verify/{token}', 'App\Http\Controllers\SubsController@verify');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', 'App\Http\Controllers\AuthController@Logout');
    Route::get('/profile', 'App\Http\Controllers\ProfileController@index');
    Route::post('/profile', 'App\Http\Controllers\ProfileController@store');
    Route::post('/comment', 'App\Http\Controllers\CommentsController@store');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', 'App\Http\Controllers\AuthController@registerForm');
    Route::post('/register', 'App\Http\Controllers\AuthController@register');
    Route::get('/login', 'App\Http\Controllers\AuthController@LoginForm')->name('login');
    Route::post('/login', 'App\Http\Controllers\AuthController@Login');
});


Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'admin'], function () {
    Route::get('/', 'DashboardController@index');
    Route::resource('/categories', 'CategoriesController');
    Route::resource('/tags', 'TagsController');
    Route::resource('/users', 'UsersController');
    Route::resource('/posts', 'PostsController');
    Route::get('/comments', 'CommentsController@index');
    Route::get('/comments/toggle/{id}', 'CommentsController@toggle');
    Route::delete('comments/{id}/destroy', 'CommentsController@destroy')->name('comments.destroy');
    Route::resource('/subscribers', 'SubscribersController');
});



