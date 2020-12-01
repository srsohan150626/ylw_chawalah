<?php

Route::get('/','HomeController@index');

Route::group(['namespace' => 'AdminControllers', 'prefix' => 'admin'], function () {
    Route::get('/login', 'AdminController@login');
    Route::post('/checkLogin', 'AdminController@checkLogin');
    
});

Route::group(['namespace' => 'AdminControllers', 'middleware' => 'auth', 'prefix' => 'admin'], function () {
    //log out
    Route::get('/logout', 'AdminController@logout');
  //  Route::get('/dashboard/{reportBase}', 'AdminController@dashboard');
    Route::get('/dashboard', 'AdminController@dashboard');
});


Route::group(['prefix' => 'admin/media', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
    Route::get('/display', 'MediaController@display');
    Route::get('/add', 'MediaController@add');
    Route::post('/uploadimage', 'MediaController@fileUpload');
    Route::post('/delete', 'MediaController@deleteimage');
    Route::get('/detail/{id}', 'MediaController@detailimage');
    Route::get('/refresh', 'MediaController@refresh');
    Route::post('/regenerateimage', 'MediaController@regenerateimage');
});



Route::group(['prefix' => 'admin/categories', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
    Route::get('/display', 'CategoriesController@display');
    Route::get('/add', 'CategoriesController@add');
    Route::post('/add', 'CategoriesController@insert');
    Route::get('/edit/{id}', 'CategoriesController@edit');
    Route::post('/update', 'CategoriesController@update');
    Route::post('/delete', 'CategoriesController@delete');
    Route::get('/filter', 'CategoriesController@filter');
});


Route::group(['prefix' => 'admin/menuitems', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
    Route::get('/display', 'MenuItemsController@display');
    Route::get('/add', 'MenuItemsController@add');
    Route::post('/add', 'MenuItemsController@insert');
    Route::get('/edit/{id}', 'MenuItemsController@edit');
    Route::post('/update', 'MenuItemsController@update');
    Route::post('/delete', 'MenuItemsController@delete');
    Route::get('/filter', 'MenuItemsController@filter');
    Route::get('/addons/display/{id}', 'MenuItemsController@filter');

    Route::group(['prefix' => 'extras'], function () {
        Route::get('/display', 'ExtrasController@display');
        Route::get('/add', 'ExtrasController@add');
        Route::post('/add', 'ExtrasController@insert');
        Route::get('/edit/{id}', 'ExtrasController@edit');
        Route::post('/update', 'ExtrasController@update');
        Route::post('/delete', 'ExtrasController@delete');
        Route::get('/filter', 'ExtrasController@filter');
        
    });
    Route::group(['prefix' => 'attach/addons'], function () {
        Route::get('/display/{id}', 'MenuItemsController@additemaddons');
            Route::post('/add', 'MenuItemsController@addnewitemaddons');
            Route::post('/edit', 'MenuItemsController@editdefaultattribute');
            Route::post('/update', 'MenuItemsController@updatedefaultattribute');
            Route::post('/deletedefaultattributemodal', 'MenuItemsController@deletedefaultattributemodal');
            Route::post('/delete', 'MenuItemsController@deletedefaultattribute');
    });
    

});
