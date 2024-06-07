<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/product', 'Products::index');
$routes->get('/product/create', 'Products::createProduct');
$routes->post('/product/save', 'Products::saveProduct');

$routes->get('/categories', 'Categories::index');
$routes->get('/categories/create', 'Categories::createcategories');
$routes->post('/categories/save', 'Categories::saveCategory');
