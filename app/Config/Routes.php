<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'UserController::display');
$routes->get('/display', 'UserController::display');


$routes->get('/dashboard','AdminController::dashboard');
$routes->get('/panggil_antrian','AdminController::panggil_antrian');
$routes->get('ambil_antrian','UserController::ambil_antrian');
$routes->get('lihat_antrian','UserController::lihat_antrian');

$routes->post('antrian/pelayanan', 'UserController::ambilPelayanan');

$routes->post('antrian/perekaman', 'UserController::ambilPerekaman');
 

$routes->get('cetakPelayanan', 'CetakController::cetakPelayanan');
$routes->get('cetakPerekaman', 'CetakController::cetakPerekaman');


$routes->post('antrian/ambil_antrian_ajax', 'UserController::ambil_antrian_ajax');


// Login

$routes->get('login', 'LoginController::index');  // Menampilkan halaman login
$routes->post('login/authenticate', 'LoginController::authenticate');  // Proses autentikasi login



