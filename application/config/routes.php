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
$route['forum/showJotting/(:num)'] = 'forum/showJotting/$1';

$route['aboutUs'] = 'welcome/aboutUs';
$route['contactUs'] = 'welcome/contactUs';

$route['food/(:num)'] = 'food/index/$1';
$route['food/detail/(:num)'] = 'food/detail/$1';

$route['news/(:num)'] = 'news/index/$1';
$route['news/detail/(:num)'] = 'news/detail/$1';

$route['admin/news/(:num)/(:any)'] = 'admin/news/index/$1/$2';
$route['admin/news/(:num)'] = 'admin/news/index/$1';

$route['admin/scenicView/(:num)/(:any)'] = 'admin/scenicView/index/$1/$2';
$route['admin/scenicView/(:num)'] = 'admin/scenicView/index/$1';

$route['admin/scenicArea/(:num)/(:any)'] = 'admin/scenicArea/index/$1/$2';
$route['admin/scenicArea/(:num)'] = 'admin/scenicArea/index/$1';

$route['admin/food/(:num)/(:any)'] = 'admin/food/index/$1/$2';
$route['admin/food/(:num)'] = 'admin/food/index/$1';

$route['admin/distributor/(:num)/(:any)'] = 'admin/distributor/index/$1/$2';
$route['admin/distributor/(:num)'] = 'admin/distributor/index/$1';

$route['admin/accommodationCategory/(:num)/(:any)'] = 'admin/accommodationCategory/index/$1/$2';
$route['admin/accommodationCategory/(:num)'] = 'admin/accommodationCategory/index/$1';

$route['admin/accommodation/(:num)/(:any)'] = 'admin/accommodation/index/$1/$2';
$route['admin/accommodation/(:num)'] = 'admin/accommodation/index/$1';

$route['admin/jotting/(:num)/(:any)'] = 'admin/jotting/index/$1/$2';
$route['admin/jotting/(:num)'] = 'admin/jotting/index/$1';

$route['default_controller'] = 'Welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
