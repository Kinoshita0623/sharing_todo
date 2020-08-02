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

Auth::routes();

Route::get('/me', 'UserController@getMe');
Route::get('/me/todos/{?page}', 'TodoController@todos');


Route::post('/groups', 'GroupController@store');

Route::get('/groups/{group_id}/members/{page?}', 'GroupController@members');

Route::get('/groups/{group_id}/invitations/{page?}', 'GroupInvitationController@invitations');
Route::post('/groups/{group_id}/invitations', 'GroupInvitationController@inviteUser');

Route::get('/groups/{group_id}', 'GroupController@get');

Route::get('/groups/{group_id}/todos/{?page}', 'TodoController@groupsTodos');

Route::get('/groups/{group_id}/todos/{todo_id}', 'TodoController@get');






