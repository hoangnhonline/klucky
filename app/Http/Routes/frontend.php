<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['namespace' => 'Frontend'], function()
{
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
    Route::get('/co-cau-giai.html', ['as' => 'co-cau-giai', 'uses' => 'HomeController@coCauGiai']);
    Route::get('/the-le.html', ['as' => 'the-le', 'uses' => 'HomeController@theLe']);
    Route::get('/huong-dan.html', ['as' => 'huong-dan', 'uses' => 'HomeController@huongDan']);
    Route::get('/lien-he.html', ['as' => 'contact', 'uses' => 'HomeController@contact']);
    Route::get('/get-content', ['as' => 'get-content', 'uses' => 'HomeController@getContent']);
    Route::get('/check-no', ['as' => 'check-no', 'uses' => 'HomeController@checkNo']);
    Route::post('/send-contact', ['as' => 'send-contact', 'uses' => 'HomeController@sendContact']);
});

