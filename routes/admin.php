<?php

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    // $exitCode = Artisan::call('config:cache');
});

Route::get('/phpinfo', function () {
    phpinfo();
});
  
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
        Route::get('/display', 'MediaController@display')->middleware('view_media');
        Route::get('/add', 'MediaController@add')->middleware('add_media');
        Route::post('/updatemediasetting', 'MediaController@updatemediasetting')->middleware('edit_media');
        Route::post('/uploadimage', 'MediaController@fileUpload')->middleware('add_media');
        Route::post('/delete', 'MediaController@deleteimage')->middleware('delete_media');
        Route::get('/detail/{id}', 'MediaController@detailimage')->middleware('view_media');
        Route::get('/refresh', 'MediaController@refresh');
        Route::post('/regenerateimage', 'MediaController@regenerateimage')->middleware('add_media');
    });

   

    Route::group(['prefix' => 'admin/categories', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'CategoriesController@display')->middleware('view_categories');
        Route::get('/add', 'CategoriesController@add')->middleware('add_categories');
        Route::post('/add', 'CategoriesController@insert')->middleware('add_categories');
        Route::get('/edit/{id}', 'CategoriesController@edit')->middleware('edit_categories');
        Route::post('/update', 'CategoriesController@update')->middleware('edit_categories');
        Route::post('/delete', 'CategoriesController@delete')->middleware('delete_categories');
        Route::get('/filter', 'CategoriesController@filter')->middleware('view_categories');
    });


    Route::group(['prefix' => 'admin/menuitems', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'MenuItemsController@display')->middleware('view_product');
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

  

    Route::group(['prefix' => 'admin/admin', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/profile', 'AdminController@profile');
        Route::post('/update', 'AdminController@update');
        Route::post('/updatepassword', 'AdminController@updatepassword');
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

        Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    });



