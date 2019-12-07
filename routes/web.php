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

$router->get('/', function () {
    return view('page.home');
});

$router->post('/domains', [
    'as' => 'domains.store', 'uses' => 'DomainController@store'
]);

$router->get('/domains/{id}', [
    'as' => 'domains.show', 'uses' => 'DomainController@show'
]);

#Route::post('/domains', 'DomainController@store')
    #->name('domains.store');

#Route::post('/domains/{id}', 'DomainController@show')
    #->name('domains.show');

#Log::debug('привет');
/*
$router->get('/', function () use ($router) {
    return $router->app->version();
});
*/
