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


$route['profil'] = 'home/profil';
$route['avatar'] = 'home/upload_avatar';
$route['update_profil'] = 'home/update_profil';



$route['pelajaran'] = 'pelajaran/data_pelajaran';
$route['tambah_pelajaran'] = 'pelajaran/tambah_pelajaran';
$route['delete_pelajaran/(:any)'] = 'pelajaran/delete_pelajaran/$1';
$route['edit_pelajaran/(:any)'] = 'pelajaran/edit_pelajaran/$1';
$route['set_active_pelajaran/(:any)'] = 'pelajaran/set_active/$1';



$route['users'] = 'user/data_user';
$route['users/(:any)'] = 'user/data_user/$1';
$route['set_active_user/(:any)'] = 'user/set_active/$1';
$route['delete_user/(:any)'] = 'user/delete_user/$1';
$route['edit_user/(:any)'] = 'user/edit_user/$1';

$route['add_pertanyaan'] = 'home/add_pertanyaan';
$route['pertanyaan'] = 'home/data_pertanyaan';

$route['data_pertanyaan'] = 'Pertanyaan/data_pertanyaan';
$route['delete_pertanyaan/(:any)'] = 'Pertanyaan/delete_pertanyaan/$1';
$route['detail_pertanyaan/(:any)'] = 'Pertanyaan/detail_pertanyaan/$1';


