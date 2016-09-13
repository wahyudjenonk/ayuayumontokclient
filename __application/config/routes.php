<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'backend';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Routing Core
$route['property'] = 'backend';
$route['property-in'] = 'login';
$route['property-out'] = 'login/logout';
$route['backoffice-grid/(:any)'] = 'backend/get_grid/$1';
$route['backoffice-form/(:any)'] = 'backend/get_form/$1';

// Modul Core
$route['register'] = 'login/registrasiuser';
$route['register-step2/(:any)'] = 'login/registrasiuser2/$1';
$route['submit-step1-register'] = 'login/submitregistrasi';
$route['submit-step2-register'] = 'login/submitregistrasi';
$route['activate/(:any)/(:any)/(:any)'] = 'login/aktivasiuser/$1/$2/$3';
$route['forgotpassword'] = 'login/forgotpasssss';

$route['dashboard'] = 'backend/modul/dashboard/main';



/*
$route['backoffice-combo'] = 'backend/get_combo';
$route['backoffice-simpan/(:any)/(:any)'] = 'backend/simpandata/$1/$2';
$route['backoffice-delete'] = 'backend/simpandata';
$route['backoffice-upload'] = 'backend/upload';
$route['backoffice-hapusFile'] = 'backend/hapus_file';
$route['backoffice-GetDetil'] = 'backend/get_konten';
$route['backoffice-Cetak'] = 'backend/cetak';
$route['backoffice-SetFlag'] = 'backend/set_flag';
$route['backoffice-Dashboard'] = 'backend/get_konten';
$route['backoffice-GetDataChart'] = 'backend/get_chart';
$route['backoffice-laporan/(:any)'] = 'backend/get_form/$1';

$route['kasir-lantai'] = 'backend/modul/kasir/kasir_lantai';
$route['detail-meja'] = 'backend/modul/kasir/detail_meja';
$route['detail-meja'] = 'backend/modul/kasir/detail_meja';
$route['trx-penjualan'] = "backend/simpandata/transaksi_penjualan";
$route['hapus-item'] = "backend/simpandata/hapus_item_kasir";
$route['tutup-transaksi'] = "backend/simpandata/tutup_transaksi";
$route['total-pesanan'] = "backend/modul/kasir/total_per_meja";
$route['selesai-transaksi'] = "backend/modul/kasir/selesai_transaksi";

*/

/* Routes Front End Routes */



