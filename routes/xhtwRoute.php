<?php

Route::get('/', function () {
    return File::get(public_path() . '/index.html');
});

// Route::get('/', 'HomeController@index');
