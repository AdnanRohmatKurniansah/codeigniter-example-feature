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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'AuthController/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['auth/register'] = 'AuthController/register';
$route['dashboard'] = 'DashboardController/index';
$route['logout'] = 'DashboardController/logout';

$route['dashboard/product'] = 'ProductController/index';
$route['dashboard/product/create'] = 'ProductController/create';
$route['dashboard/product/edit/(:num)'] = 'ProductController/edit/$1';
$route['dashboard/product/delete/(:num)'] = 'ProductController/destroy/$1';
$route['dashboard/product/search'] = 'ProductController/search';

$route['dashboard/product/category'] = 'CategoryController/index';
$route['dashboard/product/category/create'] = 'CategoryController/create';
$route['dashboard/product/category/edit/(:num)'] = 'CategoryController/edit/$1';
$route['dashboard/product/category/delete/(:num)'] = 'CategoryController/destroy/$1';

$route['dashboard/member'] = 'MemberController/index';
$route['dashboard/member/create'] = 'MemberController/create';
$route['dashboard/member/edit/(:num)'] = 'MemberController/edit/$1';
$route['dashboard/member/delete/(:num)'] = 'MemberController/destroy/$1';
$route['dashboard/member/export'] = 'MemberController/export';
$route['dashboard/member/import'] = 'MemberController/import';


$route['dashboard/transaction'] = 'TransactionController/index';
$route['dashboard/transaction/create'] = 'TransactionController/create';
$route['dashboard/transaction/report'] = 'TransactionController/printPdf';