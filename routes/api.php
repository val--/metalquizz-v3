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

// Login & registration
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/authenticated', function () {
    return true;
});
Route::post('register', 'RegisterController@register');
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout');

// List questions
Route::get('questions', 'API\QuestionController@index');
// List questions randomly
Route::get('questions_random', 'QuestionController@index_random');
// List single question
Route::get('question/{id}', 'QuestionController@show');
// List a random question
Route::get('question', 'QuestionController@show_random');
// Create new question
Route::post('question', 'QuestionController@store');
// Update question
Route::put('question', 'QuestionController@store');
// Delete question
Route::delete('question/{id}', 'QuestionController@destroy');