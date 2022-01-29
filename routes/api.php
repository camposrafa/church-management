<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//city, state and zip code routes
$router->get('/state', 'StateController@index');
$router->get('/state/{id}', 'StateController@show');
$router->get('/city', 'CityController@index');
$router->get('/city/{id}', 'CityController@show');
$router->get('/zipcode/{cep}', 'ZipCodeController@findZipCode');

$router->get('/church', 'ChurchController@index');
$router->post('/church', 'ChurchController@store');
$router->get('/church/{church}', 'ChurchController@show');
$router->put('/church/{church}', 'ChurchController@update');
$router->delete('/church/{church}', 'ChurchController@destroy');

$router->get('/member', 'MemberController@index');
$router->post('/member', 'MemberController@store');
$router->get('/member/{member}', 'MemberController@show');
$router->put('/member/{member}', 'MemberController@update');
$router->delete('/member/{member}', 'MemberController@destroy');

$router->post('/civil_state', 'CivilStateController@store');
$router->get('/civil_state/{civil_state}', 'CivilStateController@show');

$router->get('/occupation', 'OccupationController@index');
$router->post('/occupation', 'OccupationController@store');
$router->get('/occupation/{occupation}', 'OccupationController@show');
$router->put('/occupation/{occupation}', 'OccupationController@update');
$router->delete('/occupation/{occupation}', 'OccupationController@destroy');
