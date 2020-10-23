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
Route::get('logout', 'Auth\LoginController@logout');
Route::get('/dashboard', 'Controller@dashboard');

//STUDENT
Route::get('/editor/{url}', 'Controller@openDoc')->name('editor');
Route::get('/parse/{url}', 'Controller@parseDoc')->name('parse');
Route::post('submit_autosave','Controller@submit_autosave');
Route::post('post_foreign_words','Controller@skripdownForeignWords');
Route::post('post_editor_update','Controller@editor_update');
Route::post('post_propose_advisor','Controller@proposeAdvisor');
Route::post('post_submit_repository','Controller@submitRepository');
Route::post('post_submit_revision','Controller@submitRevision');
Route::post('post_read_message','Controller@readMessage');

//LECTURER
Route::get('/history-bimbingan', 'Controller@historyBimbingan');
Route::post('accsubmit', 'Controller@acceptSubmit');
Route::post('accthesis', 'Controller@acceptThesis');
Route::post('rejthesis', 'Controller@rejectThesis');
Route::post('progthesis', 'Controller@progresThesis');
Route::post('exampass','Controller@exam');

//DEPARTMENT
Route::get('/thesis-topic', 'Controller@historyBimbingan');
Route::post('plagcheck','Controller@plagiarismCheck');
Route::post('plagconf','Controller@plagiarismConf');
Route::post('deptpass','Controller@deptPassword');
Route::post('initexam','Controller@initExaminer');

//UNIVERSITY
