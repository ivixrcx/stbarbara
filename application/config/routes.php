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
$route['default_controller'] = 'account';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// user
$route['users'] = 'account/users';
$route['user/(:num)'] = 'account/get_user_view/$1';
$route['create/user'] = 'account/create_user_view';
$route['update/user/(:num)'] = 'account/update_view/$1';

// purchase order
$route['purchase-orders'] = 'purchaseorder/purchase_order_view';
$route['purchase-order/(:num)'] = 'purchaseorder/get_purchase_order_view/$1';
$route['create/purchase-order'] = 'purchaseorder/create_purchase_order_view';
$route['update/purchase-order/(:num)'] = 'purchaseorder/update_purchase_order_view/$1';

// purchase order item
$route['purchase-order-items/(:num)'] = 'purchaseorder/purchase_order_item_view/$1';
$route['create/purchase-order-item/(:num)'] = 'purchaseorder/create_purchase_order_item_view/$1';
$route['update/purchase-order-item/(:num)'] = 'purchaseorder/update_purchase_order_item_view/$1';

// user module category
$route['module-category'] = 'usermodulecategory/list_view';
$route['create/module-category'] = 'usermodulecategory/create_view';
$route['update/module-category/(:num)'] = 'usermodulecategory/update_view/$1';

// user modules
$route['module-category/(:num)'] = 'usermodule/list_view/$1';
$route['create/module/(:num)'] = 'usermodule/create_view/$1';
$route['update/module/(:num)'] = 'usermodule/update_view/$1';
$route['assign/user-modules/(:num)'] = 'usermodule/assign_user_module_view/$1';

// project
$route['projects'] = 'project/list_view';
$route['create/project'] = 'project/create_view';
$route['update/project/(:num)'] = 'project/update_view/$1';

// supplier
$route['suppliers'] = 'supplier/list_view';
$route['create/supplier'] = 'supplier/create_view';
$route['update/supplier/(:num)'] = 'supplier/update_view/$1';

// house
$route['houses'] = 'house/list_view';
$route['view/house'] = 'house/create_view';
$route['create/house'] = 'house/create_view';
$route['update/house/(:num)'] = 'house/update_view/$1';

// warehouse
$route['warehouses'] = 'warehouse/list_view';
$route['view/warehouse/(:any)'] = 'stock/list_view/$1';
$route['create/warehouse'] = 'warehouse/create_view';
$route['update/warehouse/(:num)'] = 'warehouse/update_view/$1';

// stock
$route['create/stock-in'] = 'stock/create_stock_in_view';
$route['create/stock-out'] = 'stock/create_stock_in_view';