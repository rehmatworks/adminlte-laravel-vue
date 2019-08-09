<?php
Auth::routes();
Route::get('home', function() {
    return redirect('/');
});
Route::post('signout', function() {
    Auth::logout();
});
Route::any('/{any}', 'SpaController')->where('any', '.*')->middleware('auth');
