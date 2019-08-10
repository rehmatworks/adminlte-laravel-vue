<?php
Route::post('signout', function() {
    Auth::logout();
});
Route::get('auth', function() {
    return redirect(url('auth/login'));
});
Route::get('/auth/new-password', 'SpaController@auth')->middleware('guest')->name('password.reset');
Route::post('/auth/login', 'Auth\LoginController@login');
Route::post('/auth/reset', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('/auth/check-token', 'UserController@check_token');
Route::post('/auth/update-password', 'Auth\ResetPasswordController@reset');
Route::post('/auth/register', 'Auth\RegisterController@register');
Route::any('/auth/{any}', 'SpaController@auth')->where('any', '.*')->middleware('guest');
Route::any('/{any}', 'SpaController@dashboard')->where('any', '.*')->middleware('auth');
