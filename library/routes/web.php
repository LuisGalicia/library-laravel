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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/book', 'BookController@index')->name('book.show');
Route::get('/getBook', 'BookController@show')->name('book.all');
Route::post('/saveBook', 'BookController@store')->name('book.store');
Route::delete('/deleteBook/{id}', 'BookController@destroy')->name('book.destroy');
Route::put('/editBook/{id}', 'BookController@update')->name('book.update');
Route::put('/editUserBook/{id}', 'BookController@editUser')->name('book.edituser');
Route::put('/changeAvailable/{id}', 'BookController@changeAvailable')->name('book.change');


Route::get('/category', 'CategoryController@index')->name('category.show');
Route::get('/getCategory', 'CategoryController@show')->name('category.all');
Route::post('/saveCategory', 'CategoryController@store')->name('category.store');

Route::get('/guest', 'GuestController@index')->name('guest.show');
Route::get('/getGuest', 'GuestController@show')->name('guest.all');
Route::post('/saveGuest', 'GuestController@store')->name('guest.store');
