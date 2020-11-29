<?php

Route::get('/', 'Web\IndexController@index');
Route::get('/menulist', 'Web\MenulistController@menulist');
Route::get('/menulist/{slug}', 'Web\MenulistController@itemDetail');
