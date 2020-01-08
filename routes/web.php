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

$router->get('/', ['as' => 'page.welcome', function () {
    return view('page.welcome');
}]);

$router->get('/', ['as' => 'page.main', function () {
    return view('page.main', ['error' => '']);
}]);

$router->get('/domains', [
    'as' => 'domains.index', 'uses' => 'DomainController@index'
]);

$router->post('/domains', [
    'as' => 'domains.store', 'uses' => 'DomainController@store'
]);

$router->get('/domains/{id}', [
    'as' => 'domains.show', 'uses' => 'DomainController@show'
]);
