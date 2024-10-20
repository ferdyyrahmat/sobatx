<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');


//Landing App
//Login
$routes->get('/', 'Front::index');
$routes->get('/landing', 'Front::landing');
$routes->get('/user-login', 'Front::user_select');
//Register
$routes->get('/register/', 'Front::register_page');
$routes->get('/register/peternak', 'Register::register_peternak');
$routes->post('/registering-account-peternak', 'Register::registering_account_peternak');
$routes->get('/register/user', 'Register::register_user');
$routes->post('/registering-account-user', 'Register::registering_account_user');

$routes->get('/aktivasi-akun/(:alphanum)', 'Register::aktivasi_akun/$1');
$routes->get('/batalkan-akun/(:alphanum)', 'Register::batalkan_akun/$1');

//PETERNAK
//Login
$routes->get('/peternak/', 'Peternak::login_peternak_page');
$routes->post('/peternak/login-auth', 'Peternak::login_checker');
$routes->get('/peternak/login-auth-google', 'Peternak::login_checker_google');
$routes->get('/peternak/logout', 'Peternak::logout');

//Dashboard
$routes->get('/peternak/dashboard', 'Peternak::dashboard_peternak');
$routes->get('/peternak/tentang-kami', 'Peternak::tentang_kami_peternak');
$routes->get('/peternak/pemberitahuan', 'Peternak::pemberitahuan_peternak');
$routes->get('/peternak/profil', 'Peternak::profil_peternak');

$routes->get('/peternak/m/mulai-usaha', 'Peternak::mulai_usaha_peternak');
$routes->get('/peternak/detail-paket/(:alphanum)', 'Peternak::detail_usaha_peternak/$1');
$routes->get('/peternak/pengajuan', 'Peternak::status_pengajuan_peternak');
$routes->get('/peternak/pelatihan', 'Peternak::pelatihan_usaha_peternak');
$routes->get('/peternak/produk-s', 'Peternak::produk_saya_usaha_peternak');
$routes->get('/peternak/produk-s/add', 'Peternak::tambah_produk_saya_usaha_peternak');
$routes->get('/peternak/produk-s/edit/(:alphanum)', 'Peternak::edit_produk_saya_usaha_peternak/$1');
$routes->post('/peternak/simpan-produk', 'Peternak::simpan_produk_saya_usaha_peternak');
$routes->post('/peternak/update-produk', 'Peternak::update_produk_saya_usaha_peternak');
$routes->get('/peternak/produk-s/hapus/(:alphanum)', 'Peternak::hapus_produk_saya_usaha_peternak/$1');
$routes->get('/peternak/toko-s', 'Peternak::toko_saya_usaha_peternak');
$routes->get('/peternak/tambah-rekening', 'Peternak::tambah_rekening');
$routes->post('/peternak/simpan-rekening', 'Peternak::simpan_rekening');
$routes->get('/peternak/hapus-rekening/(:alphanum)', 'Peternak::hapus_rekening/$1');
$routes->post('/peternak/simpan-toko', 'Peternak::buat_toko_peternak');
$routes->get('/peternak/aktivasi-toko/(:alphanum)', 'Peternak::aktivasi_toko/$1');

//PENGGUNA
//Login
$routes->get('/user/', 'User::login_user_page');
$routes->post('/user/login-auth', 'User::login_checker');
$routes->get('/user/login-auth-google', 'User::login_checker_google');
$routes->get('/user/logout', 'User::logout');

//Dashboard
$routes->get('/user/dashboard', 'User::dashboard_user');
$routes->get('/user/tentang-kami', 'User::tentang_kami_pengguna');
$routes->get('/user/pemberitahuan', 'User::pemberitahuan_pengguna');
$routes->get('/user/profil', 'User::profil_pengguna');
$routes->get('/user/edit/(:alphanum)', 'User::edit_profil_pengguna');

//Marketlace
$routes->get('/user/marketplace', 'Marketplace::marketplace_user');
$routes->get('/user/marketplace/product-1', 'Marketplace::detail_product_marketplace');
$routes->get('/user/checkout', 'Marketplace::checkout_product_marketplace');
$routes->get('/user/checkout/alamat', 'Marketplace::checkout_alamat');

//Status Pesanan
$routes->get('/user/status-pesanan/(:alphanum)', 'User::status_pesanan/$1');
$routes->get('/user/riwayat-pesanan/(:alphanum)', 'User::riwayat_pesanan/$1');


//MarketPlace
$routes->get('/peternak/marketplace', 'Marketplace::marketplace_user');
$routes->get('/peternak/marketplace/product-1', 'Marketplace::detail_product_marketplace');

$routes->post('/marketplace/product/search', 'Marketplace::search_item');
$routes->post('/marketplace/product/load', 'Marketplace::load_product');
$routes->post('/marketplace/product/add-favorite/(:alphanum)', 'Marketplace::add_favorite/$1');

$routes->get('/marketplace/product/detail/(:alphanum)', 'Marketplace::detail_product_marketplace/$1');
$routes->get('/marketplace/load/favorite', 'Marketplace::load_fav');

$routes->get('/marketplace/pesanan-saya/(:alphanum)', 'Marketplace::pesanan_saya/$1');

//Checkout Step
$routes->get('/marketplace/checkout/alamat', 'Marketplace::checkout_alamat');
$routes->get('/marketplace/checkout/alamat/input', 'Marketplace::checkout_alamat_input');
$routes->post('/marketplace/save/alamat', 'Marketplace::save_checkout_alamat');
$routes->get('/marketplace/alamat/selected/(:alphanum)', 'Marketplace::pilih_alamat_checkout');

$routes->post('/marketplace/checkout/(:alphanum)', 'Marketplace::checkout_1/$1');
$routes->post('/marketplace/update-total-bayar/(:alphanum)', 'Marketplace::update_total_bayar/$1');
$routes->get('/marketplace/checkout/proses/(:alphanum)', 'Marketplace::checkout_product_marketplace/$1');
$routes->get('/marketplace/buat-pesanan/(:alphanum)', 'Marketplace::buat_pesanan/$1');
$routes->get('/marketplace/detail-pesanan/(:alphanum)', 'Marketplace::detail_pesanan/$1');
$routes->get('/marketplace/kelola-pesanan', 'Marketplace::kelola_pesanan');
$routes->get('/marketplace/detail-pesanan-toko/(:alphanum)', 'Marketplace::detail_pesanan_toko/$1');
$routes->post('/marketplace/kirim-pesanan/(:alphanum)', 'Marketplace::kirim_pesanan/$1');
$routes->get('/marketplace/terima-pesanan/(:alphanum)', 'Marketplace::terima_pesanan/$1');

//BeliPaket
$routes->get('/beli-paket/(:alphanum)', 'Peternak::beli_paket_peternak/$1');

//ADMIN
$routes->get('/admin/', 'Admin::index');
$routes->post('/admin/checking', 'Admin::login_checker');
$routes->get('/admin/logout-admin', 'Admin::logout');
$routes->get('/admin/dashboard', 'Admin::dashboard_admin');
//ADMIN PETERNAK
$routes->get('/admin/master-peternak', 'Admin::master_peternak');
$routes->get('/admin/detail-peternak/(:alphanum)', 'Admin::view_peternak/$1');
$routes->get('/admin/edit-peternak/(:alphanum)', 'Admin::edit_peternak/$1');
$routes->post('/admin/update-peternak', 'Admin::update_peternak');
//ADMIN PENGGUNA
$routes->get('/admin/master-pengguna', 'Admin::master_pengguna');
$routes->get('/admin/detail-pengguna/(:alphanum)', 'Admin::view_pengguna/$1');
$routes->get('/admin/edit-pengguna/(:alphanum)', 'Admin::edit_pengguna/$1');
$routes->post('/admin/update-pengguna', 'Admin::update_pengguna');
//ADMIN TOKO
$routes->get('/admin/master-toko', 'Admin::master_toko');
$routes->post('/admin/simpan-toko', 'Admin::simpan_toko');
$routes->get('/admin/detail-toko/(:alphanum)', 'Admin::view_toko/$1');
$routes->get('/admin/edit-toko/(:alphanum)', 'Admin::edit_toko/$1');
$routes->post('/admin/update-toko', 'Admin::update_toko');
//Admin Paket
$routes->get('/admin/master-paket', 'Admin::master_paket');
$routes->get('/admin/pkt/detail/(:alphanum)', 'Admin::detail_data_paket/$1');
$routes->get('/admin/input-paket', 'Admin::input_data_paket');
$routes->post('/admin/simpan-paket', 'Admin::simpan_data_paket');
$routes->get('/admin/edit-paket/(:alphanum)', 'Admin::edit_data_paket/$1');
$routes->post('/admin/update-paket', 'Admin::update_data_paket');
$routes->get('/admin/hapus-paket/(:alphanum)', 'Admin::hapus_data_paket/$1');
$routes->get('/admin/verifying-paket/(:alphanum)/(:alphanum)', 'Admin::setujui_paket/$1/$2');
//Admin Produk
$routes->get('/admin/master-produk', 'Admin::master_produk');
//Admin Pesanan
$routes->get('/admin/master-pesanan-berlangsung', 'Admin::master_pesanan_berlangsung');

//Peternak Admin
    //Peternak Admin Login
    $routes->get('/admin/login-peternak', 'Admin::login_peternak_admin');
    $routes->post('/admin/cek-login-admin', 'Admin::login_checker_admin');
    $routes->get('qe', 'Admin::login_checker_google');
    $routes->get('/admin/logout-peternak', 'Admin::logout_admin');
    $routes->get('/admin/dashboard-peternak', 'Admin::dashboard_admin_peternak');
        //Peternak Admin Produk
    $routes->get('/admin/produk-saya-peternak', 'Admin::produk_saya_peternak');
    $routes->get('/admin/tambah-produk-peternak', 'Admin::tambah_produk_peternak');
    $routes->post('/admin/simpan-produk', 'Admin::simpan_produk_peternak');
    $routes->get('/admin/detail-produk-peternak/(:alphanum)', 'Admin::detail_produk_peternak/$1');
    $routes->get('/admin/edit-produk-peternak/(:alphanum)', 'Admin::edit_produk_peternak/$1');
    $routes->post('/admin/update-produk-peternak', 'Admin::update_produk_peternak');
    $routes->get('/admin/hapus-produk/(:alphanum)', 'Admin::hapus_produk_peternak/$1');
        //Peternak Admin Toko
    $routes->get('/admin/toko-saya-peternak', 'Admin::toko_usaha_peternak');
    $routes->post('/admin/simpan-toko-peternak', 'Admin::buat_toko');
    $routes->get('/admin/aktivasi-toko-peternak/(:alphanum)', 'Admin::aktivasi_toko_admin/$1');
    $routes->get('/admin/tambah-rekening-peternak', 'Admin::tambah_rekening_admin');
    $routes->post('/admin/simpan-rekening-peternak', 'Admin::simpan_rekening_admin');
    $routes->get('/admin/hapus-rekening-peternak/(:alphanum)', 'Admin::hapus_rekening_admin/$1');
        //Peternak Admin Pesanan
    $routes->get('/admin/pesanan-masuk-peternak', 'Admin::pesanan_masuk_peternak');
    $routes->post('/admin/update-pesanan-peternak/(:alphanum)', 'Admin::update_pesanan/$1');
    $routes->get('/admin/pesanan-berlangsung-peternak', 'Admin::pesanan_berlangsung_peternak');
    $routes->get('/admin/riwayat-pesanan-peternak', 'Admin::riwayat_pesanan_peternak');
    // Akhir Peternak Admin

//404-page
$routes->get('/404-page', 'Front::page_404');
$routes->get('/success-page', 'Front::page_success');


//RajaOngkir
$routes->post('/rajaongkir/provinsi', 'RajaOngkir::provinsi');
$routes->post('/rajaongkir/kota', 'RajaOngkir::kota');
$routes->post('/rajaongkir/ekspedisi', 'RajaOngkir::ekspedisi');
$routes->post('/rajaongkir/paket', 'RajaOngkir::paket');
