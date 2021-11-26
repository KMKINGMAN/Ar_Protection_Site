<?php

use Illuminate\Support\Facades\Route;

Route::get('/','WelcomeController@index')->name('welcome');


Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

// Check players
Route::get('/check-players','WelcomeController@checkPlayers')->name('check-players');
Route::post('check-players', 'WelcomeController@search')->name('check-players.search');
Route::get('test', 'TestController@test');
