<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {
    return view('auth.login');
})->middleware(['guest']);


Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');

require __DIR__.'/auth.php';


// Route::get('/',[
//     'as' => 'login.getLogin',
//     'uses' => 'App\Http\Controllers\AdminController@getLogin'
// ]);

// Route::post('/home',[
// 'as' => 'login.postLogin',
// 'uses' => 'App\Http\Controllers\AdminController@postLogin'
// ]);

// Route::get('/home',function(){
// return view('home');
// });

Route::prefix('admins')->group(function(){
//categories
    Route::prefix('categories')->group(function () {
        Route::get('/list_category',[
            'as' => 'categories.index',
            'uses' => 'App\Http\Controllers\CategoryController@index',
            'middleware' => 'can:list-category'
        ]);

        Route::get('/create',[
            'as' => 'categories.create',
            'uses' => 'App\Http\Controllers\CategoryController@create',
            'middleware' => 'can:add-category'
        ]);

        Route::post('/store',[
            'as' => 'categories.store',
            'uses' => 'App\Http\Controllers\CategoryController@store'
        ]);

        Route::post('/store_new_parent',[
            'as' => 'categories.store_new_parent',
            'uses' => 'App\Http\Controllers\CategoryController@storeNewParent'
        ]);

        Route::get('/edit/{id}',[
            'as' => 'categories.edit',
            'uses' => 'App\Http\Controllers\CategoryController@edit',
            'middleware' => 'can:edit-category'
        ]);

        Route::get('/delete/{id}',[
            'as' => 'categories.delete',
            'uses' => 'App\Http\Controllers\CategoryController@delete',
            'middleware' => 'can:delete-category'
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

    //user
    Route::prefix('users')->group(function(){
        Route::get('/',[
            'as' => 'users.index',
            'uses' => 'App\Http\Controllers\AdminUserController@index'
        ]);

        Route::get('/create',[
            'as' => 'users.create',
            'uses' => 'App\Http\Controllers\AdminUserController@create'
        ]);


        Route::post('/store',[
            'as' => 'users.store',
            'uses' => 'App\Http\Controllers\AdminUserController@store'
        ]);

        Route::get('/edit/{id}',[
            'as' => 'users.edit',
            'uses' => 'App\Http\Controllers\AdminUserController@edit'
        ]);

        Route::post('/update/{id}',[
            'as' => 'users.update',
            'uses' => 'App\Http\Controllers\AdminUserController@update'
        ]);

        Route::get('/delete/{id}',[
            'as' => 'users.delete',
            'uses' => 'App\Http\Controllers\AdminUserController@delete'
        ]);

        Route::get('/reset-password/{id}',[
            'as' => 'users.reset-password',
            'uses' => 'App\Http\Controllers\AdminUserController@showFormResetPassword'
        ]);
        Route::post('/reset-password/{id}',[
            'as' => 'users.save_reset-password',
            'uses' => 'App\Http\Controllers\AdminUserController@resetPassword'
        ]);

        Route::get('/profile',[
            'as' => 'users.profile',
            'uses' => 'App\Http\Controllers\AdminUserController@profile'
        ]);
        Route::post('/change-password',[
            'as' => 'users.change-password',
            'uses' => 'App\Http\Controllers\AdminUserController@changePassword'
        ]);
    });

    //Roles
    Route::prefix('roles')->group(function(){
        Route::get('/',[
            'as' => 'roles.index',
            'uses' => 'App\Http\Controllers\AdminRoleController@index'
        ]);

        Route::get('/create',[
            'as' => 'roles.create',
            'uses' => 'App\Http\Controllers\AdminRoleController@create'
        ]);


        Route::post('/store',[
            'as' => 'roles.store',
            'uses' => 'App\Http\Controllers\AdminRoleController@store'
        ]);

        Route::get('/edit/{id}',[
            'as' => 'roles.edit',
            'uses' => 'App\Http\Controllers\AdminRoleController@edit'
        ]);

        Route::post('/update/{id}',[
            'as' => 'roles.update',
            'uses' => 'App\Http\Controllers\AdminRoleController@update'
        ]);

        Route::get('/delete/{id}',[
            'as' => 'roles.delete',
            'uses' => 'App\Http\Controllers\AdminRoleController@delete'
        ]);
    });

});
