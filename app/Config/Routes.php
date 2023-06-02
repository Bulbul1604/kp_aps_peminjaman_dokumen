<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeController::index');

$routes->group('', ['filter' => 'usersAuth'], function ($routes) {
   // Dashboard
   $routes->get('dashboard', 'DashboardController::index');

   // Data Karyawan
   $routes->get('karyawan', 'EmployeeController::index');

   // Data Peminjaman
   $routes->get('transaksi', 'TransactionController::index');
   $routes->get('transaksi/show/(:segment)', 'TransactionController::show/$1');
   $routes->get('transaksi/add', 'TransactionController::add');
   $routes->post('transaksi/save', 'TransactionController::save');
   $routes->get('transaksi/edit/(:segment)', 'TransactionController::edit/$1');
   $routes->post('transaksi/update/(:segment)', 'TransactionController::update/$1');
   $routes->get('transaksi/print/(:segment)', 'TransactionController::print/$1');

   // Rubah kata sandi
   $routes->get('change-password', 'AuthController::changePassword');
   $routes->post('change-password/(:segment)', 'AuthController::changePasswordVerif/$1');
});

$routes->post('login', 'AuthController::loginVerif');
$routes->post('register', 'AuthController::registerVerif');
$routes->get('logout', 'AuthController::logout');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
   require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
