<?php

use Illuminate\Support\Facades\Route;


// Issues Routes
Route::post('issues/{id}/delete', 'IssueController@delete')->name('issues.delete');
Route::resource('issues', 'IssueController')->except(['destroy', 'show']);

// Manager Routes
Route::resource('managers', 'ManagerController')->except(['destroy', 'show']);
Route::post('managers/{id}/delete', 'ManagerController@delete')->name('managers.delete');
Route::get('managers/admin/edit-admin', 'ManagerController@editAdmin')->name('managers.edit_admin');

// Judge Routes
Route::resource('judges', 'JudgeController')->except(['destroy', 'show']);
Route::post('judges/{id}/delete', 'JudgeController@delete')->name('judges.delete');
