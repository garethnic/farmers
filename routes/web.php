<?php

Route::get('/', function () {
    return view('index');
});

Route::group(['prefix' => 'api'], function () {
    Route::post('/save-subscription', 'SubscriptionController@store');
    Route::post('/remove-subscription', 'SubscriptionController@destroy');
    //Route::get('/send-notifications', 'SubscriptionController@sendNotifications');
    Route::post('/create-new-year', 'CurrentYearController@newYear');
    Route::post('/add-new-assault', 'CurrentYearController@newAssault');
    Route::post('/add-new-murder', 'CurrentYearController@newMurder');

    Route::get('/get-data', 'CurrentYearController@getData');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
