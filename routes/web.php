<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});


//Articles Route
$app->get('/articles', 'ArticleController@index');
$app->get('/articles/{id:[0-9]+}', 'ArticleController@show');
$app->post('/articles', 'ArticleController@store');
$app->put('/articles/{id:[0-9]+}', 'ArticleController@edit');
$app->delete('/articles/{id:[0-9]+}', 'ArticleController@destroy');


//Categories Route
$app->get('/categories', 'CategorieController@index');
$app->get('/categories/{id:[0-9]+}', 'CategorieController@show');
$app->post('/categories', 'CategorieController@store');
$app->put('/categories/{id:[0-9]+}', 'CategorieController@edit');
$app->delete('/categories/{id:[0-9]+}', 'CategorieController@destroy');

