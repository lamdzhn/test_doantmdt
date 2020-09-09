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
    return view('welcome');
});

Route::group(['namespace'=>'frontend'], function () {
   Route::get('/index', 'HomeController@index')->name('fe.index');
   Route::get('/index/show_products/{category}', 'HomeController@show_products');

   Route::get('/men', 'MenController@index')->name('fe.men.index');
});

Route::group(['prefix' => 'backend', 'namespace' => 'backend'], function () {
    Route::get('/login', 'LoginController@index')->name('be.login');
    Route::post('/login/auth', 'LoginController@auth')->name('be.login.auth');

    Route::get('/index', 'HomeController@index')->name('be.index');
    Route::get('/index/logout', 'HomeController@logout')->name('be.logout');

    Route::get('/index/category', 'CategoryController@index')->name('be.category.index');
    Route::get('/index/category/create', 'CategoryController@create')->name('be.category.create');
    Route::post('/index/category/store', 'CategoryController@store')->name('be.category.store');
    Route::post('/index/category/edit/{id}', 'CategoryController@edit');
    Route::delete('/index/category/delete/{id}', 'CategoryController@delete');

    Route::get('/index/attribute', 'AttributeController@index')->name('be.attribute.index');

    Route::get('/index/product', 'ProductController@index')->name('be.product.index');
    Route::get('/index/product/create', 'ProductController@create')->name('be.product.create');
    Route::post('/index/product/create/get_attributes', 'ProductController@get_attributes');
    Route::post('/index/product/create/create_variants', 'ProductController@create_variants');
    Route::post('/index/product/store', 'ProductController@store')->name('be.product.store');

    Route::get('/index/attribute-value', 'AttributeValueController@index')->name('be.attribute_value.index');
    Route::get('/index/attribute-value/create', 'AttributeValueController@create')->name('be.attribute_value.create');
    Route::get('index/attribute-value/get_attributes', 'AttributeValueController@getAttributes');
    Route::post('/index/attribute-value/store', 'AttributeValueController@store')->name('be.attribute_value.store');

    //optional
    Route::get('/index/test', 'HomeController@test')->name('be.test');
});

