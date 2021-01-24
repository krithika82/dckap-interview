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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/','CategoryController@manageCategory')->name('category-tree-view');
Route::post('add-category','CategoryController@addCategory')->name('add.category');
Route::post('add-testcase','CategoryController@storetask')->name('add.testcase');
Route::post('editmodule','CategoryController@editmodule');
Route::get('Download/{id}','CategoryController@download');
Route::get('gettestcase/{id}','CategoryController@viewtestcase');

Route::post('edittestcase/{id}','CategoryController@edittestcase');

Route::get('deletetestcase/{id}','CategoryController@deleteTestcase');
Route::get('deletemodule/{id}','CategoryController@destroy');