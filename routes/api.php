<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->group(function() {
    Route::get('user', function(Request $request) {
        return $request->user();
    });

    Route::get('get-notifs', 'NotificationsController@get');
    Route::post('clear-notifs/{notif?}', 'NotificationsController@clear');
});
