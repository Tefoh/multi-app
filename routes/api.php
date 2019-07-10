<?php

use Illuminate\Http\Request;

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

Route::group(['namespace' => 'API'], function () {

    Route::apiResources([
        'user'      => 'UserController',
        'project'   => 'ProjectController',
    ]);

    Route::get('categories', 'CategoryController@index');

    Route::get('profile', 'ProfileController@index');
    Route::patch('profile', 'ProfileController@update');

    Route::get('search/{model}', 'SearchController@index');

    Route::post('proposal/{project}/', 'ProposalController@store');

    Route::post('accept-proposal', 'AcceptProposalController@store');
    Route::delete('accept-proposal/{project}', 'AcceptProposalController@destroy');
});
