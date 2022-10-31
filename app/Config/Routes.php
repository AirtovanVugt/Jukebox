<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/create/(:alphanum)', 'Home::createAccountPage/$1');
$routes->get('/inloggen', 'Home::index');
$routes->get('/playlist', 'playlist::Homepage');
$routes->get('/setInSession/(:alphanum)', 'session::setInSession/$1');
$routes->get('/removeInSession/(:alphanum)', 'session::removeInSession/$1');
$routes->post('/createPlaylist', 'session::setInPlaylist');
$routes->get('/deletePlaylist/(:alphanum)', 'playlist::deletePlaylist/$1');
$routes->post('/changPlaylisname', 'playlist::changePlaylistname');
$routes->get('/oneGenre/(:alphanum)', 'session::oneGenre/$1');
$routes->get('/removesongInPlaylist/(:alphanum)', 'playlist::removesongInPlaylist/$1');
$routes->get('/showSong/(:alphanum)', 'playlist::song/$1');
$routes->get('/setsongInPlaylist/(:alphanum)/(:alphanum)', 'playlist::setsonginPlaylist/$1/$2');
$routes->get("/deleteSong/(:alphanum)", "playlist::deleteSong/$1");
$routes->get('/uitloggen', 'Home::uitloggen');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
