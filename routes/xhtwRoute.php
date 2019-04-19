<?php

// Route::get('/', function () {
//     return File::get(public_path() . '/index.html');
// });

Route::get('/', 'HomeController@index');

// $debug_ip_array = array(
//     '210.61.134.72',
//     '10.10.50.50',
//     '180.204.163.119',
// );

// Route::get('fan-fiction/190227/notice', 'EventController@FBPaintingNotice');

// if (in_array($_SERVER["REMOTE_ADDR"], $debug_ip_array)):
Route::get('fan-fiction/190227', 'EventController@FBPainting');
Route::get('fan-fiction/190227/notice', 'EventController@FBPaintingNotice');
Route::get('fan-fiction/190227/vote', 'EventController@FBPaintingVote');
Route::get('fan-fiction/190227/getVote', 'EventController@FBPaintingGetVote');
Route::get('fan-fiction/190227/info/{id}', 'EventController@FBPaintingInfo');
Route::get('fan-fiction/190227/{type}', 'EventController@FBPainting');
// endif;
