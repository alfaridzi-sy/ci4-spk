<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//Routes khusus admin
$routes->get('/', 'Home::index');
$routes->get('/mainpage', 'Pages::index');
$routes->get('/calculationcheck', 'Pages::calculationcheck');
// Route Kriteria
$routes->get('/criteria/tambahdata', 'Kriteria::tambahdata');
$routes->get('/criteria/edit/(:num)', 'Kriteria::edit/$1');
$routes->post('/criteria/updatedata/(:num)', 'Kriteria::updatedata/$1');
$routes->post('/criteria/simpandata', 'Kriteria::simpandata');
$routes->delete('/criteria/(:num)', 'Kriteria::delete/$1');
$routes->get('/criteria', 'Kriteria::index');
// Route Industri
$routes->get('/industry/tambahdata', 'Industri::tambahdata');
$routes->get('/industry/edit/(:num)', 'Industri::edit/$1');
$routes->post('/industry/updatedata/(:num)', 'Industri::updatedata/$1');
$routes->post('/industry/simpandata', 'Industri::simpandata');
$routes->post('/Dynamic/Action/(:any)/(:any)', 'Dynamic::Action/$1/$2');
$routes->delete('/industry/delete/(:num)', 'Industri::delete/$1');
$routes->get('/industry/notifikasi', 'Industri::notifikasi');
$routes->get('/industry', 'Industri::index');

$routes->get('/lihat-request-industri-kepdis/(:num)', 'Industri::lihatrequest/$1');
$routes->get('/confirm-industry-req','Industri::confirmreq');
// Routes Kategori
$routes->get('/category/tambahdata', 'Kategori::tambahdata');
$routes->get('/category/edit/(:num)', 'Kategori::edit/$1');
$routes->post('/category/updatedata/(:num)', 'Kategori::updatedata/$1');
$routes->post('/category/simpandata', 'Kategori::simpandata');
$routes->delete('/category/(:num)', 'Kategori::delete/$1');
$routes->get('/category', 'Kriteria::index');
// $routes->get('/criteria/(:segment)', 'Kriteria::tesdbtertentu/$1'); //ambil nilai dari tabel masuk ke tombol
//Routes Perhitungan
$routes->get('/calculation', 'Kalkulasi::index');
$routes->get('/calculation/entropy', 'Kalkulasi::entropy');
$routes->get('/calculation/moora', 'Kalkulasi::moora');
$routes->get('/notifikasi-hitung','Kalkulasi::lamanrequest');
// Routes Hasil Perankingan
$routes->get('/ranking', 'Ranking::index');
// $routes->get('/notifikasi-ranking', 'Ranking::lamanrequest');

// Routes Pengelolaan Data Pengguna
$routes->get('/pengguna', 'Pengguna::index');
$routes->get('/pengguna/tambahdata', 'Pengguna::tambahdata');
$routes->get('/pengguna/edit/(:num)', 'Pengguna::edit/$1');
$routes->get('/pengguna/updatedata/(:num)', 'Pengguna::updatedata/$1');
$routes->post('/pengguna/tambah', 'Pengguna::tambah');
$routes->delete('pengguna/(:num)', 'Pengguna::hapusdata/$1');
//Route Request Administrator
$routes->get('/request-industri', 'Request::req_page_industry');
$routes->get('/request-industri-kepdis', 'Request::req_page_industry_kepala_dinas');
$routes->get('/request-industri-pengguna', 'Request::req_page_industry_pengguna');
$routes->get('/request-hitung', 'Request::req_page_calculation');
$routes->get('/request-ranking-admin', 'Request::req_page_ranking');
$routes->get('/request-ranking-kepdis', 'Request::req_page_ranking_kepala_dinas');
$routes->get('/request-ranking-pengguna', 'Request::req_page_ranking_pengguna');
$routes->get('/request-data','Request::requestalldata_kepala_dinas');
$routes->get('/view-request/(:num)', 'Request::view_req/$1');
$routes->post('/confirm-request', 'Request::confirm_req');


///Routes Khusus Seluruh Pengguna
$routes->get('/login', 'LoginRegist::index');
$routes->get('/register', 'LoginRegist::register');
$routes->post('/user/login', 'LoginRegist::login');
$routes->post('/user/register', 'LoginRegist::registerakun');
$routes->post('/logout','LoginRegist::logout');
$routes->post('/logout-kepdis','LoginRegist::logout_kepdis');
$routes->post('/logout-user','LoginRegist::logout_user');

// Routes Khusus Pengguna
$routes->get('/lamanutamapengguna','User::index');
$routes->get('/ceklayak','User::lamanceklayak');
$routes->get('/infoindustry','User::lamaninfoindustri');
$routes->get('/infoakun','User::lamaninfoakun');
// Routes kelola laman informasi industri
$routes->get('/notifikasi-pengguna','User::notifikasi');
$routes->get('/tambah-data','User::tambahdata');

//Routes Khusus Kepala Dinas
$routes->get('/cekhitung','Kepdis::lamancekhitung');
$routes->get('/cekranking','Kepdis::lamancekranking');
$routes->get('/cekindustri','Kepdis::lamancekindustri');
$routes->get('/lamanutamakepdis','Kepdis::index');
$routes->get('/hitung-kepdis-entropy','KalkulasiKepdis::entropy');


// $routes->get('/request-industri-kepdis','Kepdis::lamanrequestindustri');
// $routes->get('/request-hitung-kepdis','Kepdis::lamanrequestperhitungan');
// $routes->get('/request-ranking-kepdis','Kepdis::lamanrequestperankingan');
// $routes->get('/request-data','Kepdis::requestalldata');
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
