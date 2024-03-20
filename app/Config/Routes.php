<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
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

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Mahasiswa::index');

$routes->group('mahasiswa', ['filter' => 'cekloginmhs'], function($routes) {
	$routes->get('dashboard', 'Mahasiswa::dashboard');
	$routes->get('dosen', 'Mahasiswa::dosen');
	$routes->get('matkul', 'Mahasiswa::matkul');
	$routes->get('nilai', 'Mahasiswa::nilai');
});

$routes->group('admin', ['filter' => 'cekloginadm'], function($routes) {
	$routes->get('dashboard', 'Admin::dashboard');	
});
// CRUD Dosen
$routes->group('dosen', ['filter' => 'cekloginadm'], function($routes) {
	$routes->get('', 'Dosen::index');
	$routes->get('index', 'Dosen::index');
	$routes->get('delete', 'Dosen::delete');
	$routes->post('insert', 'Dosen::insert');
	$routes->get('update', 'Dosen::update');
});
// CRUD Mahasiswa
$routes->group('mahasiswa', ['filter' => 'cekloginadm'], function($routes) {
	$routes->get('show', 'Mahasiswa::show');
	$routes->get('delete', 'Mahasiswa::delete');
	$routes->post('insert', 'Mahasiswa::insert');
	$routes->get('update', 'Mahasiswa::update');
});	
// CRUD Mata Kuliah
$routes->group('matkul', ['filter' => 'cekloginadm'], function($routes) {
	$routes->get('', 'Matkul::index');
	$routes->get('index', 'Matkul::index');
	$routes->get('delete', 'Matkul::delete');
	$routes->post('insert', 'Matkul::insert');
	$routes->get('update', 'Matkul::update');
});	
// CRUD Nilai
$routes->group('nilai', ['filter' => 'cekloginadm'], function($routes) {
	$routes->get('', 'Nilai::index');
	$routes->get('index', 'Nilai::index');
	$routes->get('delete', 'Nilai::delete');
	$routes->post('insert', 'Nilai::insert');
	$routes->get('update', 'Nilai::update');
});	
// CRUD Ruangan
$routes->group('ruangan', ['filter' => 'cekloginadm'], function($routes) {
	$routes->get('', 'Ruangan::index');
	$routes->get('index', 'Ruangan::index');
	$routes->get('delete', 'Ruangan::delete');
	$routes->post('insert', 'Ruangan::insert');
	$routes->get('update', 'Ruangan::update');
});	
// CRUD Jadwal
$routes->group('jadwal', ['filter' => 'cekloginadm'], function($routes) {
	$routes->get('', 'Jadwal::index');
	$routes->get('index', 'Jadwal::index');
	$routes->get('delete', 'Jadwal::delete');
	$routes->post('insert', 'Jadwal::insert');
	$routes->get('update', 'Jadwal::update');
});	




/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
