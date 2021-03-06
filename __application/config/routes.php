<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'frontend';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Routing Core
$route['dashboard'] = 'backend';
$route['dashboard-in'] = 'login';
$route['dashboard-out'] = 'login/logout';
$route['backoffice-grid/(:any)'] = 'backend/get_grid/$1';
$route['backoffice-form/(:any)'] = 'backend/get_form/$1';

// Modul Core
$route['login'] = 'frontend/logtemp';
$route['register'] = 'login/registrasiuser';
$route['register-step2/(:any)'] = 'frontend/registrasiuser2/$1';
$route['register-step3/(:any)'] = 'frontend/registrasiuser3/$1';
$route['register-step3'] = 'frontend/registrasiuser3';
$route['submit-step1-register'] = 'login/submitregistrasi';
$route['submit-step2-register'] = 'login/submitregistrasi';
$route['submit-requestcode'] = 'login/submitregistrasi';
$route['activate/(:any)/(:any)/(:any)'] = 'login/aktivasiuser/$1/$2/$3';
$route['forgotpassword'] = 'login/forgotpasssss';
$route['submit-forgot'] = 'login/submitforgotpass';

$route['message-submit'] = 'login/messagesubmit';

$route['dashboardapp'] = 'backend/modul/dashboard/main';

$route['propertymanager'] = 'backend/modul/property/main';
$route['propertymanager-form'] = 'backend/modul/property/form';
$route['property-edit/(:any)'] = 'backend/test/$1';
$route['submit-property'] = 'backend/simpandata/property';
$route['delete-property'] = 'backend/simpandata/property_delete';

$route['servicemanager'] = 'backend/modul/service/main';
$route['detaillayananaktif'] = 'backend/modul/service/detail';
$route['request-services-form'] = 'backend/modul/service/request_services';
$route['request-detail-services'] = 'backend/modul/service/detail_request_services';
$route['request-summary-services'] = 'backend/modul/service/summary_services';
$route['request-summary-package'] = 'backend/modul/service/summary_services_package';
$route['submit-services'] = 'backend/modul/service/submit_services';
$route['getunitsize'] = 'backend/modul/service/unitsizebro';
$route['getschedule'] = 'backend/modul/service/dataschedule';
$route['schedule-detail'] = 'backend/modul/service/scheduledetail';
$route['getsetting'] = 'backend/modul/service/datasetting';
$route['setting-kalendar'] = 'backend/simpandata/settingkalendar';
$route['remove-setting-kalendar'] = 'backend/simpandata/removesettingkalendar';

$route['billing'] = 'backend/modul/billing/independent';
$route['billing-detail'] = 'backend/modul/billing/independent_detail';
$route['submit-confirmation'] = 'backend/simpandata/submit_confirmation';

$route['user-profile'] = 'backend/modul/user/profile_setting';
$route['submit-update-profile'] = 'backend/simpandata/submit_update_profile';
$route['change-password'] = 'backend/modul/user/change_password';
$route['submit-change-password'] = 'backend/simpandata/submit_change_password';

$route['update-register'] = 'backend/modul/user/update_register';
$route['submit-verification-profile'] = 'backend/simpandata/submit_verification_profile';

$route['sitemap'] = 'frontend/getdisplay/sitemap';
$route['karir'] = 'frontend/getdisplay/karir';
$route['kebijakan-perusahaan'] = 'frontend/getdisplay/kebijakan_perusahaan';
$route['syarat-ketentuan'] = 'frontend/getdisplay/syarat_ketentuan';
$route['faq'] = 'frontend/getdisplay/faq';


/*
$route['submit-services-package'] = 'backend/modul/property/submit_services_package';

/*
$route['transaction-package'] = 'backend/modul/transaction/package';
$route['transaction-package-detail'] = 'backend/modul/transaction/package_detail';

/*
$route['listingmanagement'] = 'backend/modul/listingmanagement/main';
$route['reservation-detail'] = 'backend/modul/listingmanagement/reservationdetail';
$route['getdetailkalendar'] = 'backend/modul/listingmanagement/kalendardetail';


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



