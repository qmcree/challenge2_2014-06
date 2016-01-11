<?php

Route::get('/', 'ReportController@showResults');
Route::post('/', 'ReportController@generate');