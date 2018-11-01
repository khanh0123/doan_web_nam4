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

$route['default_controller'] = 'MainController';



$route['404_override'] = 'My404';
$route['translate_uri_dashes'] = FALSE;

$route['^admin/([a-zA-Z]+)/([a-zA-Z]+)'] = '$1/$2';
$route['^admin/([a-zA-Z]+)/([a-zA-Z]+)/(:num)'] = '$1/$2/$3';

$route['logout'] = 'account/logout';
$route['changepass'] = 'account/changepass';

$route['api/login'] = 'account/apilogin';
$route['api/logout'] = 'account/apilogout';
$route['api/signup'] = 'account/apisignup';
$route['sanpham/(:num).?(:any)?'] = 'product/detail/$1.$2';
$route['sanpham/danhmuc'] = 'product/category';

$route['giohang/them'] = 'cart/add';
$route['giohang/xoa'] = 'cart/delete';
$route['giohang/capnhat'] = 'cart/update';
$route['giohang.html'] = 'cart/mycart';
$route['thanh-toan.html'] = 'cart/payment';
$route['chon-phuong-thuc-thanh-toan.html'] = 'cart/chooseMethodPayment';
$route['thong-tin-giao-hang.html'] = 'cart/checkout';
$route['xac-nhan-dat-hang.html'] = 'cart/complete';

$route['lien-he-voi-chung-toi.html'] = 'contact';
$route['lienhe/guilienhe.html'] = 'contact/usercontact';

$route['tim-kiem.html'] = 'homepage/searchProduct';

$route['quanlydonhang.html'] = 'orders/vieworders';

$route['chitietdonhang.html/(:num)'] = 'orders/viewDetailOrder/$1';
$route['huydonhang/(:num)'] = 'orders/cancelOrder/$1';




