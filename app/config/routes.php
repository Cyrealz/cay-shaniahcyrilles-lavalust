<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/** @var object $router **/

$router->any('/', 'AuthController::login');

$router->any('/login', 'AuthController::login');
$router->get('/logout', 'AuthController::logout');

foreach ([
    '/api/v1/health' => 'ApiController::health',
    '/api/v1/auth/login' => 'ApiController::login',
    '/api/v1/auth/register' => 'ApiController::register',
    '/api/v1/auth/logout' => 'ApiController::logout',
    '/api/v1/auth/refresh' => 'ApiController::refresh',
    '/api/v1/me' => 'ApiController::profile',
    '/api/v1/users' => 'ApiController::list',
    '/api/v1/users/create' => 'ApiController::create',
    '/api/v1/users/{id}' => 'ApiController::update',
    '/api/v1/users/{id}/delete' => 'ApiController::delete',
    '/api/v1/products' => 'ApiController::products',
    '/api/v1/products/create' => 'ApiController::product_create',
    '/api/v1/products/{id}' => 'ApiController::product_update',
    '/api/v1/products/{id}/delete' => 'ApiController::product_delete',
] as $api_route => $api_handler) {
    $router->any($api_route, $api_handler);
}

if (defined('IS_CLI') && IS_CLI) {
    $router->get('/migration/migrate', 'MigrationController::migrate');
    $router->get('/migration/create/{migration_class}', 'MigrationController::create_migration');
    $router->get('/migration/rollback', 'MigrationController::rollback');
    $router->get('/migration/rollback-all', 'MigrationController::rollback_all');
    $router->get('/migration/refresh', 'MigrationController::refresh');
    $router->get('/migration/status', 'MigrationController::status');
}

$router->group(['middleware' => 'AuthMiddleware'], function ($router) {
    $router->get('/product/display', 'ProductController::read');
    $router->any('/product/create', 'ProductController::create');
    $router->any('/product/edit/{id}', 'ProductController::edit');
    $router->get('/product/delete/{id}', 'ProductController::delete');

    $router->get('/products', 'ProductController::read');
    $router->any('/products/create', 'ProductController::create');
    $router->any('/products/edit/{id}', 'ProductController::edit');
    $router->get('/products/delete/{id}', 'ProductController::delete');
});