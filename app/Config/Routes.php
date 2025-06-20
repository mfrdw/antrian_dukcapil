<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/display', 'UserController::display');


$routes->get('/dashboard','AdminController::dashboard');
$routes->get('/panggil_antrian','AdminController::panggil_antrian');
$routes->get('get-antrian', 'AdminController::getAntrian');
$routes->get('/get-antrian2', 'AdminController::getAntrian2');
$routes->post('update_status/(:num)', 'AdminController::addLoket/$1');
$routes->get('/get-role-loket', 'AdminController::getRoleLoket');




$routes->get('ambil_antrian','UserController::ambil_antrian');
$routes->get('lihat_antrian','UserController::lihat_antrian');

$routes->post('antrian/pelayanan', 'UserController::ambilPelayanan');

$routes->post('antrian/perekaman', 'UserController::ambilPerekaman');
 

$routes->get('cetakPelayanan/(:num)', 'CetakController::cetakPelayanan/$1');
$routes->get('cetakPerekaman/(:num)', 'CetakController::cetakPerekaman/$1');

$routes->get('get-data', 'UserController::getData');



// Login

$routes->get('/', 'LoginController::index');  
$routes->post('login/authenticate', 'LoginController::authenticate');
$routes->get('/logout', 'LoginController::logout');