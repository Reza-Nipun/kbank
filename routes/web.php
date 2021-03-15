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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'UserController@index')->name('users');
Route::get('/new_account_requests', 'UserController@newAccountRequests')->name('new_account_requests');
Route::get('/edit_user/{id}', 'UserController@editNewAccountRequest')->name('edit_user');
Route::post('/update_user/{id}', 'UserController@updateUserAccount')->name('update_user');

Route::get('/applicability_list', 'ApplicabilityController@index')->name('applicability_list');
Route::get('/add_applicability', 'ApplicabilityController@create')->name('add_applicability');
Route::post('/save_applicability', 'ApplicabilityController@store')->name('save_applicability');
Route::get('/edit_applicability/{id}', 'ApplicabilityController@editApplicability')->name('edit_applicability');
Route::post('/update_applicability/{id}', 'ApplicabilityController@updateApplicability')->name('update_applicability');

Route::get('/category_list', 'CategoryController@index')->name('category_list');
Route::get('/add_category', 'CategoryController@create')->name('add_category');
Route::post('/save_category', 'CategoryController@store')->name('save_category');
Route::get('/edit_category/{id}', 'CategoryController@editCategory')->name('edit_category');
Route::post('/update_category/{id}', 'CategoryController@updateCategory')->name('update_category');

Route::get('/document_type_list', 'DocumentTypeController@index')->name('document_type_list');
Route::get('/add_document_type', 'DocumentTypeController@create')->name('add_document_type');
Route::post('/save_document_type', 'DocumentTypeController@store')->name('save_document_type');
Route::get('/edit_document_type/{id}', 'DocumentTypeController@editDocumentType')->name('edit_document_type');
Route::post('/update_document_type/{id}', 'DocumentTypeController@updateDocumentType')->name('update_document_type');

Route::get('/documents', 'DocumentController@index')->name('documents');
Route::get('/view_document/{id}', 'DocumentController@viewDocument')->name('view_document');
Route::get('/add_document', 'DocumentController@create')->name('add_document');
Route::post('/save_document', 'DocumentController@store')->name('save_document');
Route::post('/get_document_info_by_id', 'DocumentController@getDocumentInfoById')->name('get_document_info_by_id');
Route::get('/document_detail_list/{reference_code}', 'DocumentController@getDocumentDetailList')->name('document_detail_list');