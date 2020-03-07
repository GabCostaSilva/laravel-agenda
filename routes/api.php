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

Route::post('/contacts', 'ContactsController@store');
Route::get('/contacts/search', 'ContactsController@search');
Route::get('/contacts', 'ContactsController@index');
Route::get('/contacts/{uuid}', 'ContactsController@show');
