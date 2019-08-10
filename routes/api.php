<?php

use Illuminate\Http\Request;

Route::middleware(['auth:api', 'throttle:500,1'])->group(function() {
    Route::get('users/get', 'UserController@get');
    Route::resource('users', 'UserController');
    Route::get('get-roles', 'UserController@get_roles');
    Route::get('get-notifs', 'NotificationsController@get');
    Route::post('clear-notifs/{notif?}', 'NotificationsController@clear');
});
