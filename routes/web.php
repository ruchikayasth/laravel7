<?php

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

Route::get('/', function () {
    return view('registration');
});

Route::get('pdfview',array('as'=>'pdfview','uses'=>'RegistrationControll@pdfview'));

Route::get('generate-pdf','RegistrationControll@generatePDF')->name('generatePDF');
Route::get('/', 'RegistrationControll@index')->name('index');
Route::post('/store', 'RegistrationControll@create')->name('create');
Route::get('/delete/{id}', 'RegistrationControll@delete')->name('delete');

Route::post('api/fetch-states', 'RegistrationControll@fetchState')->name('fetchState');
Route::post('api/fetch-cities', 'RegistrationControll@fetchCity')->name('fetchCity');
