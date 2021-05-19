<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('categories/{token?}', 'Api\ApiController@getCategories')->name('categories');
Route::get('applicability_list/{token?}', 'Api\ApiController@getApplicabilityList')->name('applicability_list');
Route::get('document_types/{token?}', 'Api\ApiController@getDocumentTypes')->name('document_types');
Route::get('departments/{token?}', 'Api\ApiController@getDepartments')->name('departments');
Route::get('/get_filtered_documents/{token?}/{subject?}/{category?}/{applicability?}/{document_type?}/{department?}', 'Api\ApiController@getFilteredDocuments')->name('get_filtered_documents');

Route::get('/get_document_info_by_id_api/{token?}/{document_id?}', 'Api\ApiController@getDocumentInfoById')->name('get_document_info_by_id_api');