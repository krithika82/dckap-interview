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

/*Add & Edit & Delete Category module*/
Route::get('/','CategoryController@manageCategory')->name('category-tree-view');
Route::post('add-category','CategoryController@addCategory')->name('add.category');
Route::post('editmodule','CategoryController@editmodule');
Route::get('deletemodule/{id}','CategoryController@destroy');
/*Add & Edit & Delete testcase*/
Route::post('add-testcase','CategoryController@storetask')->name('add.testcase');
Route::get('gettestcase/{id}','CategoryController@viewtestcase');
Route::post('edittestcase/{id}','CategoryController@edittestcase');
Route::get('deletetestcase/{id}','CategoryController@deleteTestcase');
/*Download File*/
Route::get('Download/{id}','CategoryController@download');