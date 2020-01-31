<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();
//Route::get('/register', 'Auth\RegisterController@showRegistrationForm');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/challenges', 'ChallengeController@index')->name('user.challenges');
Route::post('/submissions', 'SubmissionController@submitFlag')->name('user.challenges.submit');

Route::prefix('admin')->group(function() {
    Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/challenges', 'ChallengeController@manage')->name('admin.challenges')->middleware('auth:admin');
    Route::post('/challenges/update', 'ChallengeController@update')->name('admin.challenges.update')->middleware('auth:admin');
    Route::post('/challenges/delete', 'ChallengeController@delete')->name('admin.challenges.delete')->middleware('auth:admin');
    Route::get('/submissions/get/{id}', 'SubmissionController@getSubmissions')->where('id', '[0-9]+')
                ->name('admin.submissions.get')->middleware('auth:admin');
});
