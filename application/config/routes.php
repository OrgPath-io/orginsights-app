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
$route['default_controller'] = 'home';
$route['selfassessment/(:any)'] = 'selfassessment/index/$1';
$route['thirdparty/(:any)'] = 'thirdparty/index/$1';
$route['report/(:any)'] = 'report/index/$1';
$route['report/(:any)/(:any)'] = 'report/index/$1/$2';
$route['savemessage/(:any)'] = 'savemessage/index/$1';
$route['finalreport/(:any)'] = 'finalreport/index/$1';
$route['finalreporte/(:any)'] = 'finalreporte/index/$1';
$route['finalreportd/(:any)'] = 'finalreportd/index/$1';
$route['finalreportc/(:any)'] = 'finalreportc/index/$1';
$route['finalreportperc/(:any)'] = 'finalreportperc/index/$1';
$route['report360/(:any)'] = 'report360/index/$1';
$route['report360/(:any)/(:any)'] = 'report360/index/$1/$2';
$route['showpdf/(:any)/(:any)/(:any)'] = 'showpdf/index/$1/$2/$3';
$route['reportvalidation/(:any)'] = 'reportvalidation/index/$1';
$route['report360validation/(:any)'] = 'report360validation/index/$1';
$route['review/(:any)'] = 'review/index/$1';
$route['orgreport/(:any)'] = 'orgreport/index/$1';
$route['orgreport/(:any)/(:any)'] = 'orgreport/index/$1/$2';
$route['additionalreport/(:any)'] = 'additionalreport/index/$1';
$route['additionalreport/(:any)/(:any)'] = 'additionalreport/index/$1/$2';
$route['orgreports/(:any)'] = 'orgreports/index/$1';
$route['orgreports/(:any)/(:any)'] = 'orgreports/index/$1/$2';
$route['additionalreports/(:any)'] = 'additionalreports/index/$1';
$route['additionalreports/(:any)/(:any)'] = 'additionalreports/index/$1/$2';
$route['reports360/(:any)'] = 'reports360/index/$1';
$route['reports360/(:any)/(:any)'] = 'reports360/index/$1/$2';
$route['test/(:any)'] = 'test/index/$1';
$route['test/(:any)/(:any)'] = 'test/index/$1/$2';
$route['industryreport/(:any)'] = 'industryreport/index/$1';
$route['industryreport/(:any)/(:any)'] = 'industryreport/index/$1/$2';
$route['industryreports/(:any)'] = 'industryreports/index/$1';
$route['industryreports/(:any)/(:any)'] = 'industryreports/index/$1/$2';
$route['industryreport/(:any)'] = 'industryreport/index/$1';
$route['industryreport/(:any)/(:any)'] = 'industryreport/index/$1/$2';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
