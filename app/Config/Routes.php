<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/product', 'Products::index');
$routes->get('/product/create', 'Products::createProduct');
$routes->get('/product/(:segment)/edit', 'Products::editProduct/$1/edit');
$routes->post('/product/save', 'Products::saveProduct');
$routes->post('/product/update/(:num)', 'Products::updateProduct/$1');

$routes->get('/categories', 'Categories::index');
$routes->get('/categories/create', 'Categories::createCategories');
$routes->get('/categories/(:segment)/edit', 'Categories::editCategories/$1/edit');
$routes->post('/categories/save', 'Categories::saveCategory');
$routes->post('/categories/update/(:num)', 'Categories::udpateCategory/$1');
