<?php

use Illuminate\Http\Request;

Route::get('users/signupallowed', 'UserController@signupallowed');
Route::middleware('auth:api')->group(function() {
    Route::get('users/get', 'UserController@get');
    Route::resource('users', 'UserController');
    Route::get('get-roles', 'UserController@get_roles');
    Route::get('get-notifs', 'NotificationsController@get');
    Route::post('clear-notifs/{notif?}', 'NotificationsController@clear');
    Route::get('settings', 'SettingController@get');
    Route::post('settings', 'SettingController@store');
});
