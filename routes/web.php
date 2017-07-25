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


//Article Route
$app->get('/article', 'ArticleController@index');
$app->get('/article/{id:[0-9]+}', 'ArticleController@show');
$app->post('/article', 'ArticleController@store');
$app->put('/article/{id:[0-9]+}', 'ArticleController@edit');
$app->delete('/article/{id:[0-9]+}', 'ArticleController@destroy');


