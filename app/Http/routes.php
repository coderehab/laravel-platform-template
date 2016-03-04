<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

Route::group(['middleware' => ['api']], function (){

    Route::group(['prefix' => 'api/v1'],function(){
        Route::resource('products', 'Api\ProductRestController');
        Route::resource('companies', 'Api\CompanyRestController');
        Route::resource('categories', 'Api\CategoryRestController');
        Route::resource('orders', 'Api\OrderRestController');
    });
});

Route::group(['middleware' => ['web']], function (){

    Route::auth();

    Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
        Route::get('/dashboard',array('as'=>'dashboard', 'uses'=>'UserController@index'));
        Route::resource('product', 'Product\ProductController');
        Route::resource('category', 'Product\CategoryController');
        Route::resource('variation', 'Product\VariationController');
        Route::resource('offer', 'Product\OfferController');
        Route::resource('order', 'Order\OrderController');
        Route::resource('company', 'CompanyController');
        Route::resource('account', 'AccountController');

        Route::get('/product/{id}/menu/add', ['as' => 'admin.product.appendtomenu', 'uses' => 'Product\ProductController@append_to_menu']);
        Route::get('/product/{id}/menu/remove', ['as' => 'admin.product.removefrommenu', 'uses' => 'Product\ProductController@remove_from_menu']);
        Route::get('/product/{id}/toggleactive', ['as' => 'admin.product.toggleactive', 'uses' => 'Product\ProductController@toggle_active']);
        Route::group(['middleware' => ['permission:manage_allergens']], function() {
             Route::resource('allergen','Product\AllergenController');
        });
        Route::post('/order/{id}/complete', ['as' => 'admin.order.complete', 'uses' => 'Order\OrderController@complete']);
    });


    Route::get('/', function(){
        return Redirect::to('/admin/dashboard');
    });

});

