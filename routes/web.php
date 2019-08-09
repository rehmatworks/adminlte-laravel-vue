<?php
Route::post('signout', function() {
    Auth::logout();
});
Route::get('auth', function() {
    return redirect(url('auth/login'));
});
Route::post('/auth/login', 'Auth\LoginController@login');
Route::post('/auth/register', 'Auth\RegisterController@register');
Route::any('/auth/{any}', 'SpaController@auth')->where('any', '.*')->middleware('guest');
Route::any('/{any}', 'SpaController@dashboard')->where('any', '.*')->middleware('auth');
