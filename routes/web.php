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
    return view('welcome');
});

Auth::routes();

Route::get('/exel', 'Export\ExportsController@exportSubjects')->name('export.subjects');
Route::get('/exel/{study}', 'Export\ExportsController@exportStudy')->name('exels');
Route::get('/excels/{subject}', 'Export\ExportsController@exportSubjectExperiments')->name('subject.experiments');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/study', 'StudyController@index')->name('study.index');
Route::post('/study', 'StudyController@store');
Route::get('/study/create', 'StudyController@create')->name('study.create');
Route::get('/study/{study}/edit', 'StudyController@edit')->name('study.edit');
Route::put('/study/{study}', 'StudyController@update')->name('study.update');
Route::post('/study/{study}', 'StudyController@storeNew');
Route::get('/study/{study}', 'StudyController@show')->name('study.show');

Route::post('/study/task/{task}', 'TaskController@store')->name('task.store');

Route::get('/subject', 'SubjectController@index')->name('subject.index');
Route::post('/subject', 'SubjectController@store');
Route::get('/subject/create', 'SubjectController@create')->name('subject.create');
Route::get('/subject/{subject}', 'SubjectController@show')->name('subject.show');
Route::get('/subject/{subject}/edit', 'SubjectController@edit')->name('subject.edit');
Route::put('/subject/{subject}', 'SubjectController@update')->name('subject.update');

Route::get('/subject/{subject}/{task}', 'ExperimentController@show')->name('experiment.show');

Route::post('/subject/{subject}/{task}', 'ExperimentController@store')->name('experiment.store');

Route::post('/koment/{subject}/{task}', 'ExperimentController@storeComment')->name('task.comment.store');


Route::get('/search', 'SearchController@index')->name('search.index');

Route::get('/api', 'ApiController@index');
Route::get('/api/search/', 'ApiController@search');
Route::get('/api/{subject}', 'ApiController@show');


