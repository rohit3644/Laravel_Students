<?php

use Illuminate\Support\Facades\Route;



Route::get('/list', 'StudentController@listing');
Route::view('/add', 'add');
Route::post('/add', 'StudentController@add');
Route::get('/delete/{id}', 'StudentController@delete');
Route::get('/edit/{id}', 'StudentController@edit');
Route::post('edit', 'StudentController@update');
Route::get('/', 'StudentController@index');
