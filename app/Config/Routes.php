<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('crearcliente', 'Client::viewCreateClient',['as'=>'view_createclient']);

//routes crear order
$routes->get('crearpedido', 'Order::viewCreateOrder',['as'=>'view_createorder']);
$routes->post('crearpedido', 'Order::viewCreateOrderFinish',['as'=>'view_createorder_finish']);
$routes->post('createpedido', 'Order::createOrder',['as'=>'create_order']);

$routes->post('addproduct', 'Order::addProductToListOrder',['as'=>'addproductlistorder']);
$routes->post('deleteproduct', 'Order::deleteProductToListOrder',['as'=>'deleteproductlistorder']);


//routes prueba
$routes->get('cart', 'Order::cart');
$routes->get('d', 'Order::d');

//routes of ajax
$routes->get('/productofcategory', 'Product::ajaxProductOfCategory');
$routes->get('/ingredientsofproduct', 'Product::ajaxProductRecipe');



//routes of pictures
$routes->add('/public/admin/dist/img/menu', '', ['as' => 'img-menu']);

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
