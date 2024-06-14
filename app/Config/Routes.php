<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/product', 'Products::index');
$routes->get('/product/create', 'Products::createProduct');
$routes->get('/product/(:segment)/edit', 'Products::editProduct/$1/edit');
$routes->get('/product/(:segment)/detail', 'Products::detailProduct/$1/detail');
$routes->post('/product/save', 'Products::saveProduct');
$routes->post('/product/update/(:num)', 'Products::updateProduct/$1');
$routes->post('/product/updatestock', 'Products::updateProductStock');
$routes->delete('/product/(:num)', 'Products::deleteProduct/$1');

$routes->get('/categories', 'Categories::index');
$routes->get('/categories/create', 'Categories::createCategories');
$routes->get('/categories/(:segment)/detail', 'Categories::detailCategories/$1/detail');
$routes->get('/categories/(:segment)/edit', 'Categories::editCategories/$1/edit');
$routes->post('/categories/save', 'Categories::saveCategory');
$routes->post('/categories/update/(:num)', 'Categories::udpateCategory/$1');
$routes->delete('/categories/(:num)', 'Categories::deleteCategory/$1');

$routes->get('/orders', 'Orders::index');
$routes->get('/orders/create', 'Orders::createOrder');
$routes->post('/orders/addToCart', 'Orders::addToCart');
$routes->post('/orders/clearCart', 'Orders::clearCart');
$routes->post('/orders/removeFromCart', 'Orders::removeFromCart');
$routes->post('/orders/checkout', 'Orders::checkout');
$routes->get('/orders/(:segment)/detail', 'Orders::orderDetail/$1/detail');
