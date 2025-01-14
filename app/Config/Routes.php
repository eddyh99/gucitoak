<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('/pembayaran/pelanggan/tambah', 'Pembayaran::pelanggan_tambah');
$routes->get('/pembayaran/suplier/tambah', 'Pembayaran::suplier_tambah');