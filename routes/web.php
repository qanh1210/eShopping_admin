<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/',[
        'as' => 'login.getLogin',
        'uses' => 'App\Http\Controllers\AdminController@getLogin'
]);

Route::post('/home',[
    'as' => 'login.postLogin',
    'uses' => 'App\Http\Controllers\AdminController@postLogin'
]);

Route::get('/home',function(){
    return view('home');
});

Route::prefix('admins')->group(function(){
    //categories
    Route::prefix('categories')->group(function () {
        Route::get('/list_categories',[
            'as' => 'categories.index',
            'uses' => 'App\Http\Controllers\CategoryController@index'
        ]);

        Route::get('/create',[
            'as' => 'categories.create',
            'uses' => 'App\Http\Controllers\CategoryController@create'
        ]);

        Route::post('/store',[
            'as' => 'categories.store',
            'uses' => 'App\Http\Controllers\CategoryController@store'
        ]);

        Route::get('/edit/{id}',[
            'as' => 'categories.edit',
            'uses' => 'App\Http\Controllers\CategoryController@edit'
        ]);

        Route::get('/delete/{id}',[
            'as' => 'categories.delete',
            'uses' => 'App\Http\Controllers\CategoryController@delete'
        ]);

        Route::post('/update/{id}',[
            'as' => 'categories.update',
            'uses' => 'App\Http\Controllers\CategoryController@update'
        ]);
    });


    //menus
    Route::prefix('menus')->group(function () {
        Route::get('/',[
            'as' => 'menus.index',
            'uses' => 'App\Http\Controllers\MenuController@index'
        ]);

        Route::get('/create',[
            'as' => 'menus.create',
            'uses' => 'App\Http\Controllers\MenuController@create'
        ]);

        Route::post('/store',[
            'as' => 'menus.store',
            'uses' => 'App\Http\Controllers\MenuController@store'
        ]);

        Route::get('/edit/{id}',[
            'as' => 'menus.edit',
            'uses' => 'App\Http\Controllers\MenuController@edit'
        ]);

        Route::get('/delete/{id}',[
            'as' => 'menus.delete',
            'uses' => 'App\Http\Controllers\MenuController@delete'
        ]);

        Route::post('/update/{id}',[
            'as' => 'menus.update',
            'uses' => 'App\Http\Controllers\MenuController@update'
        ]);
    });

    //products
    Route::prefix('product')->group(function(){
        Route::get('/',[
            'as' => 'product.index',
            'uses' => 'App\Http\Controllers\AdminProductController@index'
        ]);

        Route::get('/create',[
            'as' => 'product.create',
            'uses' => 'App\Http\Controllers\AdminProductController@create'
        ]);

        Route::post('/store',[
            'as' => 'product.store',
            'uses' => 'App\Http\Controllers\AdminProductController@store'
        ]);

        Route::get('/edit/{id}',[
            'as' => 'product.edit',
            'uses' => 'App\Http\Controllers\AdminProductController@edit'
        ]);

        Route::post('/update/{id}',[
            'as' => 'product.update',
            'uses' => 'App\Http\Controllers\AdminProductController@update'
        ]);

        Route::get('/delete/{id}',[
            'as' => 'product.delete',
            'uses' => 'App\Http\Controllers\AdminProductController@delete'
        ]);
    });

    //slider
    Route::prefix('slider')->group(function(){
        Route::get('/',[
            'as' => 'slider.index',
            'uses' => 'App\Http\Controllers\AdminSliderController@index'
        ]);

        Route::get('/create',[
            'as' => 'slider.create',
            'uses' => 'App\Http\Controllers\AdminSliderController@create'
        ]);

        Route::post('/store',[
            'as' => 'slider.store',
            'uses' => 'App\Http\Controllers\AdminSliderController@store'
        ]);

        Route::get('/edit/{id}',[
            'as' => 'slider.edit',
            'uses' => 'App\Http\Controllers\AdminSliderController@edit'
        ]);

        Route::post('/update/{id}',[
            'as' => 'slider.update',
            'uses' => 'App\Http\Controllers\AdminSliderController@update'
        ]);

        Route::get('/delete/{id}',[
            'as' => 'slider.delete',
            'uses' => 'App\Http\Controllers\AdminSliderController@delete'
        ]);
    });

    //setting
    Route::prefix('setting')->group(function(){
        Route::get('/',[
            'as' => 'setting.index',
            'uses' => 'App\Http\Controllers\AdminSettingController@index'
        ]);

        Route::get('/create',[
            'as' => 'setting.create',
            'uses' => 'App\Http\Controllers\AdminSettingController@create'
        ]);

        Route::post('/store',[
            'as' => 'setting.store',
            'uses' => 'App\Http\Controllers\AdminSettingController@store'
        ]);

        Route::get('/edit/{id}',[
            'as' => 'setting.edit',
            'uses' => 'App\Http\Controllers\AdminSettingController@edit'
        ]);

        Route::post('/update/{id}',[
            'as' => 'setting.update',
            'uses' => 'App\Http\Controllers\AdminSettingController@update'
        ]);

        Route::get('/delete/{id}',[
            'as' => 'setting.delete',
            'uses' => 'App\Http\Controllers\AdminSettingController@delete'
        ]);
    });
});

