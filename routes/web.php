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

$router->get('/', function () use ($router) {
    return $router->app->version();
});



/**
 * Display details
 */
$router->get('getUserPost', 'DetailsController@getUserPost');
$router->get('getUserRole', 'DetailsController@getUserRole');
$router->get('getRoleUser', 'DetailsController@getRoleUser');
$router->get('getPostById/{id}', 'DetailsController@getPostById');
$router->get('getCommentsById/{id}', 'DetailsController@getCommentsById');



/**
 * Create new records
 * 
 */

$router->get('createUser', 'ActionsController@createUser');
$router->get('createPostByUser/{name}', 'ActionsController@createPostByUser');
$router->get('createComment', 'ActionsController@createComment');
$router->get('createComments', 'ActionsController@createComments');
$router->get('saveAssociate', 'ActionsController@saveAssociate');
