<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes();
Route::get('/', 'Controller@dashboard')->name('home');
Route::get('/login', 'Controller@login');
Route::get('logout', 'Auth\LoginController@logout');
Route::get('/dashboard', 'Controller@dashboard');
Route::post('submit_text','Controller@submit');
Route::post('submit_autosave','Controller@submit_autosave');
Route::post('post_foreign_words','Controller@skripdownForeignWords');


//STUDENT
Route::get('/editor', 'Controller@openEditor')->name('editor');
Route::get('/editor/{url}', 'Controller@openDoc')->name('editor_url');
Route::get('/parse/{url}', 'Controller@parseDoc')->name('parse');

//LECTURER
Route::get('/history-bimbingan', 'Controller@historyBimbingan');

//DEPARTMENT
Route::get('/thesis-topic', 'Controller@historyBimbingan');

//UNIVERSITY
