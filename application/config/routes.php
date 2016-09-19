<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Auth';
$route['404_override'] = 'Not_found';
$route['translate_uri_dashes'] = FALSE;


$route['register'] = 'Auth/daftar';
$route['login'] = 'Auth/authentication';
$route['sign_out'] = 'Auth/logout';
$route['forgot_password'] = "Auth/forgot_password";
$route['reset_password/(:any)'] = "Auth/reset_password/$1";


$route['profil'] = 'home/profil';
$route['update_password'] = 'home/update_password';
$route['avatar'] = 'home/upload_avatar';
$route['update_profil'] = 'home/update_profil';



$route['pelajaran'] = 'pelajaran/data_pelajaran';
$route['tambah_pelajaran'] = 'pelajaran/tambah_pelajaran';
$route['delete_pelajaran/(:any)'] = 'pelajaran/delete_pelajaran/$1';
$route['edit_pelajaran/(:any)'] = 'pelajaran/edit_pelajaran/$1';
$route['set_active_pelajaran/(:any)'] = 'pelajaran/set_active/$1';



$route['users'] = 'user/data_user';
$route['add_user'] = 'user/add_user';
$route['users/(:any)'] = 'user/data_user/$1';
$route['set_active_user/(:any)'] = 'user/set_active/$1';
$route['set_level_user/(:any)'] = 'user/set_level/$1';
$route['delete_user/(:any)'] = 'user/delete_user/$1';
$route['edit_user/(:any)'] = 'user/edit_user/$1';
$route['avatar_update/(:any)'] = 'user/upload_avatar/$1';
$route['member_below'] = 'user/user_child';

$route['add_pertanyaan'] = 'pertanyaan/add_pertanyaan';
$route['pertanyaan'] = 'home/data_pertanyaan';
$route['my_question'] = 'pertanyaan/pertanyaan_saya';
$route['my_answer'] = 'jawaban/jawaban_saya';

$route['data_pertanyaan'] = 'Pertanyaan/data_pertanyaan';
$route['delete_pertanyaan/(:any)'] = 'Pertanyaan/delete_pertanyaan/$1';
$route['detail_pertanyaan/(:any)'] = 'Pertanyaan/detail_pertanyaan/$1';
$route['delete_pertanyaan_saya/(:any)'] = 'Pertanyaan/delete_pertanyaan_saya/$1';
$route['edit_pertanyaan_saya/(:any)'] = 'Pertanyaan/edit_pertanyaan_saya/$1';
$route['mapel/(:any)'] = 'pertanyaan/pertanyaan_by_mapel/$1';


$route['delete_jawaban/(:any)'] = 'jawaban/delete_jawaban/$1';
$route['edit_jawaban/(:any)'] = 'jawaban/edit_jawaban/$1';
$route['upload_gambar_jawaban'] = 'jawaban/tambah_gambar_jawaban';
$route['jawab/(:any)'] = 'jawaban/insert_jawaban/$1';
$route['betul/(:any)'] = 'jawaban/betul/$1';
$route['salah/(:any)'] = 'jawaban/salah/$1';
$route['update_wids_betul/(:any)'] = 'jawaban/update_wids_betul/$1';

// $route['upload_gambar_jawaban/(:any)'] = 'jawaban/tambah_gambar_jawaban/$1';

$route['masteruser'] = 'master_user/login';


$route['data_wids/(:any)'] = 'Wids/data_wids/$1';
$route['wids_action/(:any)'] = 'Wids/wids_action/$1';

$route['voucher'] = "wids/voucher_wids";
$route['voucher/{:any}/{:any}'] = "wids/voucher_wids/$1/$2";
$route['data_sell_wids'] = "wids/data_sell_wids";
$route['data_sell_wids/(:any)/(:any)'] = "wids/data_sell_wids/$1/$2";
$route['data_sell_wids/(:any)/(:any)/(:any)'] = "wids/data_sell_wids/$1/$2/$3";

$route['add_voucher'] = "Wids/add_voucher";
$route['buy_voucher'] = "Wids/beli_voucher";
$route['sell_wids'] = "Wids/jual_wids";
$route['buy']	= 'Wids/beli_wids';


$route['loadmore'] = "Home/load_more";
$route['loadmore_mapel'] = "Pertanyaan/load_more";


$route['guide'] = "Content/panduan";
$route['about'] = "Content/tentang";


$route['data_reseller'] = "Reseller/all_reseller";
$route['add_reseller'] = "Reseller/add_reseller";
$route['list_reseller'] = "Reseller/all_reseller";
$route['delete_reseller/(:any)'] = "Reseller/delete_reseller/$1";
$route['set_active_reseller/(:any)'] = "Reseller/set_active_reseller/$1";
$route['my_voucher'] = "Wids/my_voucher";
