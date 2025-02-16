<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('/dispose/konfirm', 'Opname::konfirm_dispose');
$routes->get('/pembayaran/pelanggan/tambah', 'Pembayaran::pelanggan_tambah');
$routes->get('/pembayaran/suplier/tambah', 'Pembayaran::suplier_tambah');
$routes->get('/slipgaji', 'Penggajian::slipgaji');