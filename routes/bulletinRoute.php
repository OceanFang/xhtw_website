<?php

Route::group(['prefix' => 'bulletin'], function () {

    Route::match(['get', 'post'], '/', 'BulletinController@index');
    Route::match(['get', 'post'], '/list/{id}', 'BulletinController@list');
    Route::match(['get', 'post'], '/info/{id}', 'BulletinController@info');
});
