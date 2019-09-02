<?php

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['web', 'auth']], function() {
    Route::get('/home', function() {
        if(Auth::user()->admin == 0) {
            return view('member.member-home');
        } else {
            $users['users'] = \App\User::all();
            return view('admin.admin-home', $users);
        }
    });
});

Route::group(['middleware' => ['web', 'auth']], function() {
    Route::resource('book', 'BookController');
    Route::resource('user', 'UserController');
    Route::resource('transaction', 'TransactionController');
});