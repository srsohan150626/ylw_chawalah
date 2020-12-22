<?php

Route::get('/','HomeController@index');
Route::get('/fastfood','HomeController@fastfood' );
Route::get('/menucategory','HomeController@list');
// Route::get('/menu/{id}','HomeController@menudetails');
Route::get('/menu/{id}/{slug}','HomeController@menudetailsnew');
Route::get('/menulist/{id}','HomeController@menulist');

Route::group(['namespace' => 'Web'], function () {
    Route::get('/drinks','DrinksHomeController@index');
    // Route::get('/menulistdrinks/{id}','DrinksHomeController@menulist');
    // Route::get('/menudrinks/{id}/{slug}','DrinksHomeController@menudetails');
    Route::get('/menudrinks/{id}','DrinksHomeController@menudetails');
    Route::get('/menu3','MenuThirdController@index');
    Route::get('/menulist3/{id}','MenuThirdController@menulist');
    Route::get('/menu3/{id}/{slug}','MenuThirdController@menudetails');
});

Route::group(['namespace' => 'AdminControllers', 'prefix' => 'admin'], function () {
    Route::get('/login', 'AdminController@login')->name('login');
    Route::post('/checkLogin', 'AdminController@checkLogin');
    
});

Route::group(['namespace' => 'AdminControllers', 'middleware' => 'auth', 'prefix' => 'admin'], function () {
    //log out
    Route::get('/logout', 'AdminController@logout');
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
    Route::get('/display', 'MenuItemsController@display')->name('menuitems.display');
    Route::get('/add', 'MenuItemsController@add');
    Route::post('/add', 'MenuItemsController@insert');
    Route::get('/edit/{id}', 'MenuItemsController@edit');
    Route::post('/update', 'MenuItemsController@update');
    Route::post('/delete', 'MenuItemsController@delete');
    Route::get('/filter', 'MenuItemsController@filter');
    Route::get('/addons/display/{id}', 'MenuItemsController@filter');

    // Route::group(['prefix' => 'extras'], function () {
    //     Route::get('/display', 'ExtrasController@display');
    //     Route::get('/add', 'ExtrasController@add');
    //     Route::post('/add', 'ExtrasController@insert');
    //     Route::get('/edit/{id}', 'ExtrasController@edit');
    //     Route::post('/update', 'ExtrasController@update');
    //     Route::post('/delete', 'ExtrasController@delete');
    //     Route::get('/filter', 'ExtrasController@filter');
        
    // });
    // Route::group(['prefix' => 'attach/addons'], function () {
    //     Route::get('/display/{id}', 'MenuItemsController@additemaddons');
    //         Route::post('/add', 'MenuItemsController@addnewitemaddons');
    //         Route::post('/edit', 'MenuItemsController@editdefaultattribute');
    //         Route::post('/update', 'MenuItemsController@updatedefaultattribute');
    //         Route::post('/deletedefaultattributemodal', 'MenuItemsController@deletedefaultattributemodal');
    //         Route::post('/delete', 'MenuItemsController@deletedefaultattribute');
    // });
    

});

Route::group(['prefix' => 'admin/admin', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
    Route::get('/profile', 'AdminController@profile');
    Route::post('/update', 'AdminController@update');
    Route::post('/updatepassword', 'AdminController@updatepassword');
});
Route::group(['prefix' => 'admin/hometexts', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
         Route::get('/display', 'HomeTextController@display');
        Route::get('/add', 'HomeTextController@add');
        Route::post('/add', 'HomeTextController@insert');
        Route::get('/edit/{id}', 'HomeTextController@edit');
        Route::post('/update', 'HomeTextController@update');
        Route::post('/delete', 'HomeTextController@delete');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
//admin managements
Route::get('/admins', 'AdminController@admins')->middleware('view_manage_admin');
Route::get('/addadmins', 'AdminController@addadmins')->middleware('add_manage_admin');
Route::post('/addnewadmin', 'AdminController@addnewadmin')->middleware('add_manage_admin');
Route::get('/editadmin/{id}', 'AdminController@editadmin')->middleware('edit_manage_admin');
Route::post('/updateadmin', 'AdminController@updateadmin')->middleware('edit_manage_admin');
Route::post('/deleteadmin', 'AdminController@deleteadmin')->middleware('delete_manage_admin');

//admin managements
Route::get('/manageroles', 'AdminController@manageroles')->middleware('manage_role');
Route::get('/addrole/{id}', 'AdminController@addrole')->middleware('manage_role');
Route::post('/addnewroles', 'AdminController@addnewroles')->middleware('manage_role');
Route::get('/addadmintype', 'AdminController@addadmintype')->middleware('add_admin_type');
Route::post('/addnewtype', 'AdminController@addnewtype')->middleware('add_admin_type');
Route::get('/editadmintype/{id}', 'AdminController@editadmintype')->middleware('edit_admin_type');
Route::post('/updatetype', 'AdminController@updatetype')->middleware('edit_admin_type');
Route::post('/deleteadmintype', 'AdminController@deleteadmintype')->middleware('delete_admin_type');

});