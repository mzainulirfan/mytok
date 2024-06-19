<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index', ['filter' => 'authenticate']);
$routes->group(
    'product',
    ['filter' => 'authenticate'],
    function ($routes) {
        $routes->get('', 'Products::index');
        $routes->get('create', 'Products::createProduct');
        $routes->get('(:segment)/edit', 'Products::editProduct/$1/edit');
        $routes->get('(:segment)/detail', 'Products::detailProduct/$1/detail');
        $routes->post('save', 'Products::saveProduct');
        $routes->post('update/(:num)', 'Products::updateProduct/$1');
        $routes->post('updatestock', 'Products::updateProductStock');
        $routes->delete('(:num)', 'Products::deleteProduct/$1');
    }
);
$routes->group(
    'categories',
    ['filter' => 'authenticate'],
    function ($routes) {
        $routes->get('', 'Categories::index');
        $routes->get('create', 'Categories::createCategories');
        $routes->get('(:segment)/detail', 'Categories::detailCategories/$1/detail');
        $routes->get('(:segment)/edit', 'Categories::editCategories/$1/edit');
        $routes->post('save', 'Categories::saveCategory');
        $routes->post('update/(:num)', 'Categories::updateCategory/$1');
        $routes->delete('(:num)', 'Categories::deleteCategory/$1');
    }
);

$routes->group(
    'orders',
    ['filter' => 'authenticate'],
    function ($routes) {
        $routes->get('', 'Orders::index');
        $routes->get('create', 'Orders::createOrder');
        $routes->post('addToCart', 'Orders::addToCart');
        $routes->post('clearCart', 'Orders::clearCart');
        $routes->post('removeFromCart', 'Orders::removeFromCart');
        $routes->post('checkout', 'Orders::checkout');
        $routes->get('(:segment)/detail', 'Orders::orderDetail/$1/detail');
    }
);
// ['filter' => 'authenticate'],
$routes->group(
    'users',
    ['filter' => 'authenticate'],
    function ($routes) {
        $routes->get('', 'Users::index');
        $routes->post('save', 'Users::save');
        $routes->post('(:num)/update', 'Users::updateUser/$1/update');
        $routes->get('(:segment)/detail', 'Users::detailUser/$1/detail');
        $routes->get('(:segment)/orders', 'Users::detailUserOrder/$1/order');
        $routes->get('(:segment)/address', 'Users::detailUserAddress/$1/address');
        $routes->delete('(:num)', 'Users::deleteUser/$1');
        $routes->post('(:num)/resetpassword', 'Users::resetPassword/$1/resetpassword');
        $routes->post('(:num)/upload', 'Users::uploadPhotoUser/$1/upload');
        $routes->post('(:num)/changeusername', 'Users::changeUsername/$1/changeusername');
    }
);
$routes->group(
    'addresses',
    ['filter' => 'authenticate'],
    function ($routes) {
        $routes->post('save', 'Addresses::save');
        $routes->post('(:num)/asigntomain', 'Addresses::asignToMainAddress/$1/asigntomain');
        $routes->post('(:num)/edit', 'Addresses::editAddress/$1/edit');
        $routes->delete('(:num)', 'Addresses::deleteAddress/$1');
    }
);
$routes->group(
    'auth',
    ['filter' => 'redirectIfAuthenticated'],
    function ($routes) {
        $routes->get('', 'Auth::index');
        $routes->post('login', 'Auth::authProcess');
    }
);

$routes->get('auth/logout', 'Auth::logout', ['filter' => 'authenticate']);
$routes->post('register/save', 'RegisterUser::save', ['filter' => 'redirectIfAuthenticated']);
