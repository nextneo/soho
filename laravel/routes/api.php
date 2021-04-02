<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api'], function ($router) {
    Route::get('menu', 'MenuController@index');

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('register', 'AuthController@register'); 

    Route::resource('notes', 'NotesController');

    Route::resource('resource/{table}/resource', 'ResourceController');
    
    Route::group(['middleware' => 'admin'], function ($router) {

        Route::resource('mail'        , 'MailController');
        Route::get('prepareSend/{id}' , 'MailController@prepareSend')->name('prepareSend');
        Route::post('mailSend/{id}'   , 'MailController@send')->name('mailSend');

        Route::resource('bread',  'BreadController');   //create BREAD (resource)

        Route::prefix('users')->group(function () { 
            Route::get('/'        , 'UsersController@index')->name('users.index');
            Route::get('/edit'    , 'UsersController@edit')->name('users.edit');
            Route::get('/show'    , 'UsersController@show')->name('users.show');            
            Route::get('/delete' , 'UsersController@delete')->name('users.delete');
            Route::post('/store'  , 'UsersController@store')->name('users.store');
            Route::post('/update' , 'UsersController@update')->name('users.update');
        });
        // Route::resource('departments', 'DepartmentsController')->except( ['create'] );

        Route::prefix('departments')->group(function () { 
            Route::get('/'        , 'DepartmentsController@index')->name('departments.index');
            Route::get('/edit'    , 'DepartmentsController@edit')->name('departments.edit');
            Route::get('/show'    , 'DepartmentsController@show')->name('departments.show');            
            Route::get('/delete' , 'DepartmentsController@delete')->name('departments.delete');
            Route::post('/store'  , 'DepartmentsController@store')->name('departments.store');
            Route::post('/update' , 'DepartmentsController@update')->name('departments.update');
        });
        // blocks
        Route::prefix('blocks')->group(function () { 
            Route::get('/'        , 'BlocksController@index')->name('blocks.index');
            Route::get('/edit'    , 'BlocksController@edit')->name('blocks.edit');
            Route::get('/show'    , 'BlocksController@show')->name('blocks.show');
            Route::get('/delete'  , 'BlocksController@delete')->name('blocks.delete');
            Route::post('/store'  , 'BlocksController@store')->name('blocks.store');
            Route::post('/update' , 'BlocksController@update')->name('blocks.update');
        });	

		Route::prefix('apartments')->group(function () { 
            Route::get('/'        , 'ApartmentsController@index')->name('apartments.index');
            Route::get('/edit'    , 'ApartmentsController@edit')->name('apartments.edit');
            Route::get('/show'    , 'ApartmentsController@show')->name('apartments.show');            
            Route::get('/delete' , 'ApartmentsController@delete')->name('apartments.delete');
            Route::post('/store'  , 'ApartmentsController@store')->name('apartments.store');
            Route::post('/update' , 'ApartmentsController@update')->name('apartments.update');
        });

        Route::prefix('menu/menu')->group(function () { 
            Route::get('/'        , 'MenuEditController@index')->name('menu.menu.index');
            Route::get('/create'  , 'MenuEditController@create')->name('menu.menu.create');
            Route::post('/store'  , 'MenuEditController@store')->name('menu.menu.store');
            Route::get('/edit'    , 'MenuEditController@edit')->name('menu.menu.edit');
            Route::post('/update' , 'MenuEditController@update')->name('menu.menu.update');
            Route::get('/delete'  , 'MenuEditController@delete')->name('menu.menu.delete');
        });
        Route::prefix('menu/element')->group(function () { 
            Route::get('/'            , 'MenuElementController@index')->name('menu.index');
            Route::get('/move-up'     , 'MenuElementController@moveUp')->name('menu.up');
            Route::get('/move-down'   , 'MenuElementController@moveDown')->name('menu.down');
            Route::get('/create'      , 'MenuElementController@create')->name('menu.create');
            Route::post('/store'      , 'MenuElementController@store')->name('menu.store');
            Route::get('/get-parents' , 'MenuElementController@getParents');
            Route::get('/edit'        , 'MenuElementController@edit')->name('menu.edit');
            Route::post('/update'     , 'MenuElementController@update')->name('menu.update');
            Route::get('/show'        , 'MenuElementController@show')->name('menu.show');
            Route::get('/delete'      , 'MenuElementController@delete')->name('menu.delete');
        });
        Route::prefix('media')->group(function ($router) {
            Route::get('/',                 'MediaController@index')->name('media.folder.index');
            Route::get('/folder/store',     'MediaController@folderAdd')->name('media.folder.add');
            Route::post('/folder/update',   'MediaController@folderUpdate')->name('media.folder.update');
            Route::get('/folder',           'MediaController@folder')->name('media.folder');
            Route::post('/folder/move',     'MediaController@folderMove')->name('media.folder.move');
            Route::post('/folder/delete',   'MediaController@folderDelete')->name('media.folder.delete');;

            Route::post('/file/store',      'MediaController@fileAdd')->name('media.file.add');
            Route::get('/file',             'MediaController@file');
            Route::post('/file/delete',     'MediaController@fileDelete')->name('media.file.delete');
            Route::post('/file/update',     'MediaController@fileUpdate')->name('media.file.update');
            Route::post('/file/move',       'MediaController@fileMove')->name('media.file.move');
            Route::post('/file/cropp',      'MediaController@cropp');
            Route::get('/file/copy',        'MediaController@fileCopy')->name('media.file.copy');

            Route::get('/file/download',    'MediaController@fileDownload');
        });

        Route::resource('roles',        'RolesController');
        Route::get('/roles/move/move-up',      'RolesController@moveUp')->name('roles.up');
        Route::get('/roles/move/move-down',    'RolesController@moveDown')->name('roles.down');
    });
});

