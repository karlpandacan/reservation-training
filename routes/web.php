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

$router->post('login', ['uses' => 'UserController@login']);
$router->get('logout', ['uses' => 'UserController@logout']);

// $router->get('users', ['uses' => 'UserController@index']); //show all
// $router->get('users/create', ['uses' => 'UserController@create']); //create form
$router->post('users', ['uses' => 'UserController@store']); //save or add from create
$router->get('users/{id}', ['uses' => 'UserController@show']); //show user by id
// $router->get('users/{id}/edit', ['uses' => 'UserController@edit']); //edit form by id
$router->put('users/{id}', ['uses' => 'UserController@update']); //save edit by id (PUT/Patch)
// $router->patch('users/{id}', ['uses' => 'UserController@update']); //save edit by id (PUT/Patch)
$router->delete('users/{id}', ['uses' => 'UserController@destroy']); //delete by id
$router->post('users/{id}/update-password', ['uses' => 'UserController@updatePassword']);


$router->post('applications', ['uses' => 'ApplicationController@store']);
$router->get('applications/{id}', ['uses' => 'ApplicationController@show']);
$router->put('applications/{id}', ['uses' => 'ApplicationController@update']);
$router->delete('applications/{id}', ['uses' => 'ApplicationController@delete']);
