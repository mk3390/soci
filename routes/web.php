<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->group([ 'prefix' => 'auth'], function ($router){
    $router->group(['middleware' => ['guest:api']], function ($router) {
        $router->post('login', 'AuthController@login');
        $router->post('signup', 'AuthController@signup');
    });
    $router->group(['middleware' => 'auth:api'], function($router) {
        $router->get('logout', 'AuthController@logout');
        $router->post('getuser', 'AuthController@getUser');
    });
});

$router->group(['middleware' => 'auth:api'], function($router) {
    $router->get('list', 'PostController@index');
    $router->get('search/{keyword}', 'AuthController@search');
    $router->post('post', 'PostController@store');
    $router->post('comment', 'CommentController@store');
    $router->post('reaction', 'ReactionController@store');
    $router->post('follow', 'FollowingController@store');
    $router->post('approve', 'FollowingController@approve');
    $router->post('reject', 'FollowingController@reject');
    $router->post('block', 'BlockController@store');
});

$router->get('/', function () use ($router) {
    return $router->app->version();
});
