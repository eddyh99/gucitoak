<?php

use App\Enums\Menu; ?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="<?= BASE_URL ?>" class="app-brand-link">
            <img class="img-fluid" src="<?= BASE_URL ?>assets/img/logo.png" alt="logo guci toak">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <div class="accordion" id="accordionExample">
        <!-- Dashboard -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <a href="<?= BASE_URL ?>dashboard" class="accordion-button">
              <i class="bx bx-home me-2"></i>
              <span>Dashboard</span>
            </a>
          </h2>
        </div>
        <!-- Setup Data -->
        <?php if ($isAdmin || isset($akses->setup)): ?>
        
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSetup" aria-expanded="false" aria-controls="collapseSetup">
                    <i class="bx bx-cog me-2"></i>
                    <span>Setup Data</span>
                </button>
              </h2>
              <div id="collapseSetup" class="accordion-collapse <?= isset($menuactive_setup) ? 'show' : 'collapse' ?>" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php if ($isAdmin || $hasPermission(Menu::DAFTAR_PENGGUNA, 'setup')): ?>
                        <li class="menu-item <?= isset($user_active) ? 'active' : '' ?>">
                            <a href="<?= BASE_URL ?>user" class="menu-link-inside d-flex justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-list-ol"></i>
                                <div data-i18n="User" style="font-size: 12px;">Daftar Pengguna</div>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if ($isAdmin || $hasPermission(Menu::DAFTAR_SALES, 'setup')): ?>
                        <li class="menu-item">
                            <a href="<?= BASE_URL ?>sales" class="menu-link-inside d-flex justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-list-ol"></i>
                                <div data-i18n="Sales" style="font-size: 12px;">Daftar Sales</div>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if ($isAdmin || $hasPermission(Menu::DAFTAR_SUPLIER, 'setup')): ?>
                        <li class="menu-item">
                            <a href="<?= BASE_URL ?>suplier" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-list-ol"></i>
                                <div data-i18n="Supplier" style="font-size: 12px;">Daftar Supplier</div>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if ($isAdmin || $hasPermission(Menu::DAFTAR_PELANGGAN, 'setup')): ?>
                        <li class="menu-item">
                            <a href="<?= BASE_URL ?>pelanggan" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-list-ol"></i>
                                <div data-i18n="Pelanggan" style="font-size: 12px;">Daftar Pelanggan</div>
                            </a>
                        </li>
                    <?php endif ?>
                    <hr>
                    <?php if ($isAdmin || $hasPermission(Menu::DAFTAR_KATEGORI, 'setup')): ?>
                        <li class="menu-item">
                            <a href="<?= BASE_URL ?>kategori" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-list-ol"></i>
                                <div data-i18n="Kategori" style="font-size: 12px;">Daftar Kategori</div>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if ($isAdmin || $hasPermission(Menu::DAFTAR_SATUAN, 'setup')): ?>
                        <li class="menu-item">
                            <a href="<?= BASE_URL ?>satuan" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-list-ol"></i>
                                <div data-i18n="Satuan" style="font-size: 12px;">Daftar Satuan</div>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if ($isAdmin || $hasPermission(Menu::DAFTAR_BARANG, 'setup')): ?>
                        <li class="menu-item">
                            <a href="<?= BASE_URL ?>barang" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-list-ol"></i>
                                <div data-i18n="Barang" style="font-size: 12px;">Daftar Barang</div>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if ($isAdmin || $hasPermission(Menu::DAFTAR_BARANG_SALES, 'setup')): ?>
                        <li class="menu-item">
                            <a href="<?= BASE_URL ?>sales/list_assign_sales" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-list-ol"></i>
                                <div data-i18n="Assign Sales" style="font-size: 12px;">Daftar Barang Sales</div>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if ($isAdmin): ?>
                        <li class="menu-item">
                            <a href="<?= BASE_URL ?>hakakses" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-list-ol"></i>
                                <div data-i18n="Assign Sales" style="font-size: 12px;">Hak Akses</div>
                            </a>
                        </li>
                    <?php endif ?>
                </div>
              </div>
            </div>
        <?php endif ?>
    
        <?php if ($isAdmin || isset($akses->persediaan)): ?>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePersediaan" aria-expanded="false" aria-controls="collapsePersediaan">
                    <i class="bx bx-package me-2"></i>
                    <span>Persediaan</span>
                </button>
              </h2>
              <div id="collapsePersediaan" class="accordion-collapse <?= isset($menuactive_persediaan) ? 'active' : 'collapse' ?>" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php if ($isAdmin || $hasPermission(Menu::INPUT_STOK, 'persediaan')): ?>
                        <li class="menu-item <?= isset($stokbarang_active) ? 'active' : '' ?>">
                            <a href="<?= BASE_URL ?>stok/tambah_stokbarang" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-plus-circle"></i>
                                <div data-i18n="User" style="font-size: 12px;">Input Stok Awal</div>
                            </a>
                        </li>
                    <?php endif ?>
        
                    <?php if ($isAdmin || $hasPermission(Menu::PENYESUAIAN_STOK, 'persediaan')): ?>
                        <li class="menu-item ">
                            <a href="<?= BASE_URL ?>opname" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-box"></i>
                                <div data-i18n="Stok Opname" style="font-size: 12px;">Penyesuaian Stok</div>
                            </a>
                        </li>
                    <?php endif ?>
                    <hr>
        
                    <?php if ($isAdmin || $hasPermission(Menu::STOK_BARANG, 'persediaan')): ?>
                        <li class="menu-item">
                            <a href="<?= BASE_URL ?>stok" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-list-ol"></i>
                                <div data-i18n="User" style="font-size: 12px;">Stok Barang</div>
                            </a>
                        </li>
                    <?php endif ?>
        
                    <?php if ($isAdmin || $hasPermission(Menu::CONFIRM_OPNAME, 'persediaan')): ?>
                        <li class="menu-item <?= @$stokopnamekonfirm_active ?>">
                            <a href="<?= BASE_URL ?>opname/konfirm" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-check-shield"></i>
                                <div data-i18n="Konfirm Opname" style="font-size: 12px;">Konfirm Opname</div>
                            </a>
                        </li>
                    <?php endif ?>
        
                    <?php if ($isAdmin || $hasPermission(Menu::CONFIRM_DISPOSE, 'persediaan')): ?>
                        <li class="menu-item <?= @$stokopnamekonfirm_active ?>">
                            <a href="<?= BASE_URL ?>dispose/konfirm" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-check-shield"></i>
                                <div data-i18n="Konfirm Opname" style="font-size: 12px;">Konfirm Dispose</div>
                            </a>
                        </li>
                    <?php endif ?>
        
                    <?php if ($isAdmin || $hasPermission(Menu::HAPUS_STOK, 'persediaan')): ?>
                        <li class="menu-item <?= @$hapusstok_active ?>">
                            <a href="<?= BASE_URL ?>opname/hapusstok" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-list-ol"></i>
                                <div data-i18n="Penghapusan Stok" style="font-size: 12px;">Penghapusan Stok</div>
                            </a>
                        </li>
                    <?php endif ?>
                </div>
              </div>
            </div>
        <?php endif ?>
    
        <?php if ($isAdmin || isset($akses->transaksi)): ?>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTransaksi" aria-expanded="false" aria-controls="collapseTransaksi">
                    <i class="bx bx-basket me-2"></i>
                    <span>Transaksi</span>
                </button>
              </h2>
              <div id="collapseTransaksi" class="accordion-collapse <?= isset($menuactive_transaksi) ? 'active' : 'collapse' ?>" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                        <?php if ($isAdmin || $hasPermission(Menu::PEMBELIAN, 'transaksi')): ?>
                            <li class="menu-item">
                                <a href="<?= BASE_URL ?>pembelian" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                    <i class="menu-icon fs-5 tf-icons bx bx-basket"></i>
                                    <div data-i18n="Pembelian Barang" style="font-size: 12px;">Pembelian</div>
                                </a>
                            </li>
                        <?php endif ?>
        
                        <?php if ($isAdmin || $hasPermission(Menu::RETUR_SUPLIER, 'transaksi')): ?>
                            <li class="menu-item">
                                <a href="<?= BASE_URL ?>retur/suplier" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                    <i class="menu-icon fs-5 tf-icons bx bx-basket"></i>
                                    <div data-i18n="Retur Supplier" style="font-size: 12px;">Retur Supplier</div>
                                </a>
                            </li>
                        <?php endif ?>
                        <hr>
        
                        <?php if ($isAdmin || $hasPermission(Menu::PENJUALAN, 'transaksi')): ?>
                            <li class="menu-item">
                                <a href="<?= BASE_URL ?>penjualan" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                    <i class="menu-icon fs-5 tf-icons bx bx-basket"></i>
                                    <div data-i18n="Penjualan" style="font-size: 12px;">Penjualan</div>
                                </a>
                            </li>
                        <?php endif ?>
        
                        <?php if ($isAdmin || $hasPermission(Menu::RETUR_PELANGGAN, 'transaksi')): ?>
                            <li class="menu-item">
                                <a href="<?= BASE_URL ?>retur/pelanggan" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                    <i class="menu-icon fs-5 tf-icons bx bx-basket"></i>
                                    <div data-i18n="Penjualan" style="font-size: 12px;">Retur Pelanggan</div>
                                </a>
                            </li>
                        <?php endif ?>
                        <hr>
        
                        <?php if ($isAdmin || $hasPermission(Menu::PEMBAYARAN_PELANGGAN, 'transaksi')): ?>
                            <li class="menu-item">
                                <a href="<?= BASE_URL ?>pembayaran/pelanggan" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                    <i class="menu-icon fs-5 tf-icons bx bx-basket"></i>
                                    <div data-i18n="Penjualan" style="font-size: 12px;">Pembayaran Pelanggan</div>
                                </a>
                            </li>
                        <?php endif ?>
        
                        <?php if ($isAdmin || $hasPermission(Menu::PEMBAYARAN_SUPLIER, 'transaksi')): ?>
                            <li class="menu-item">
                                <a href="<?= BASE_URL ?>pembayaran/suplier" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                    <i class="menu-icon fs-5 tf-icons bx bx-basket"></i>
                                    <div data-i18n="Penjualan" style="font-size: 12px;">Pembayaran Suplier</div>
                                </a>
                            </li>
                        <?php endif ?>
                </div>
              </div>
            </div>
        <?php endif ?>
        <?php if ($isAdmin || isset($akses->laporan)): ?>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLaporan" aria-expanded="false" aria-controls="collapseLaporan">
                    <i class="bx bx-purchase-tag-alt me-2"></i>
                    <span>Laporan</span>
                </button>
              </h2>
              <div id="collapseLaporan" class="accordion-collapse <?= isset($menuactive_laporan) ? 'active' : 'collapse' ?>" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php if ($isAdmin || $hasPermission(Menu::STOK_MIN_BARANG, 'laporan')): ?>
                        <li class="menu-item">
                            <a href="<?= BASE_URL ?>laporan/barang" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-purchase-tag-alt"></i>
                                <div data-i18n="Laporan" style="font-size: 12px;">Stok Min Barang</div>
                            </a>
                        </li>
                    <?php endif ?>
        
                    <?php if ($isAdmin || $hasPermission(Menu::MUTASI_STOK, 'laporan')): ?>
                        <li class="menu-item">
                            <a href="<?= BASE_URL ?>laporan/mutasistok" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-purchase-tag-alt"></i>
                                <div data-i18n="Laporan" style="font-size: 12px;">Mutasi Stok</div>
                            </a>
                        </li>
                    <?php endif ?>
        
                    <?php if ($isAdmin || $hasPermission(Menu::PENJUALAN_SUMMARY, 'laporan')): ?>
                        <li class="menu-item">
                            <a href="<?= BASE_URL ?>laporan/penjualan" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-purchase-tag-alt"></i>
                                <div data-i18n="Laporan" style="font-size: 12px;">Penjualan</div>
                            </a>
                        </li>
                    <?php endif ?>
        
                    <?php if ($isAdmin || $hasPermission(Menu::PEMBELIAN_SUMMARY, 'laporan')): ?>
                        <li class="menu-item">
                            <a href="<?= BASE_URL ?>laporan/pembelian" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-purchase-tag-alt"></i>
                                <div data-i18n="Laporan" style="font-size: 12px;">Pembelian</div>
                            </a>
                        </li>
                    <?php endif ?>
        
                    <?php if ($isAdmin || $hasPermission(Menu::LAP_RETUR_SUPLIER, 'laporan')): ?>
                        <li class="menu-item">
                            <a href="<?= BASE_URL ?>laporan/retursup" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-purchase-tag-alt"></i>
                                <div data-i18n="Laporan" style="font-size: 12px;">Retur Suplier</div>
                            </a>
                        </li>
                    <?php endif ?>
        
                    <?php if ($isAdmin || $hasPermission(Menu::LAP_RETUR_PELANGGAN, 'laporan')): ?>
                        <li class="menu-item">
                            <a href="<?= BASE_URL ?>laporan/returpel" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-purchase-tag-alt"></i>
                                <div data-i18n="Laporan" style="font-size: 12px;">Retur Pelanggan</div>
                            </a>
                        </li>
                    <?php endif ?>
                    <hr>
                    <?php if ($isAdmin || $hasPermission(Menu::OMZET_OUTLET, 'laporan')): ?>
                        <li class="menu-item">
                            <a href="<?= BASE_URL ?>laporan/omzet_outlet" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-purchase-tag-alt"></i>
                                <div data-i18n="Laporan" style="font-size: 12px;">Omzet Outlet</div>
                            </a>
                        </li>
                    <?php endif ?>
        
                    <?php if ($isAdmin || $hasPermission(Menu::OUTLET_IDLE, 'laporan')): ?>
                        <li class="menu-item">
                            <a href="<?= BASE_URL ?>laporan/outlet_idle" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-purchase-tag-alt"></i>
                                <div data-i18n="Laporan" style="font-size: 12px;">Outlet Idle</div>
                            </a>
                        </li>
                    <?php endif ?>
        
                    <?php if ($isAdmin || $hasPermission(Menu::PENJUALAN_OUTLET, 'laporan')): ?>
                        <li class="menu-item">
                            <a href="<?= BASE_URL ?>laporan/penjualan_outlet" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-purchase-tag-alt"></i>
                                <div data-i18n="Laporan" style="font-size: 12px;">Penjualan Outlet</div>
                            </a>
                        </li>
                    <?php endif ?>
        
                    <?php if ($isAdmin || $hasPermission(Menu::KATALOG, 'laporan')): ?>
                        <li class="menu-item">
                            <a href="<?= BASE_URL ?>laporan/katalog" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <i class="menu-icon fs-5 tf-icons bx bx-purchase-tag-alt"></i>
                                <div data-i18n="Laporan" style="font-size: 12px;">Katalog</div>
                            </a>
                        </li>
                    <?php endif ?>
                </div>
              </div>
            </div>
        <?php endif ?>
    
        <!-- gaji -->
        <?php if ($isAdmin || isset($akses->penggajian)): ?>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <a href="<?= BASE_URL ?>penggajian" class="accordion-button">
                    <i class="bx bx-money me-2"></i>
                    <span>Gaji</span>
                </a>
              </h2>
            </div>
        <?php endif ?>
    
        <?php if (!$isAdmin): ?>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <a href="<?= BASE_URL ?>laporan/omzet_sales" class="accordion-button">
                <i class="bx bx-money me-2"></i>
                <span>Laporan Omzet</span>
            </a>
          </h2>
        </div>
        <?php endif ?>
    
        <?php if (!$isAdmin): ?>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <a href="<?= BASE_URL ?>laporan/slipgaji" class="accordion-button">
                    <i class="bx bx-money me-2"></i>
                    <span>Slip Gaji</span>
                </a>
              </h2>
            </div>
        <?php endif ?>
      </div>
    </ul>
</aside>

<div class="layout-page">
    <!-- Navbar -->
    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <span class="avatar-initial rounded-circle bg-label-warning">A</span>
                            <!-- <img src="<?= BASE_URL ?>assets/img/avatars/1.png" alt class="w-px-30 h-auto rounded-circle" /> -->
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <span class="avatar-initial rounded-circle bg-label-warning">A</span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block"><?= $session['role'] == 'sales' ?  $session['namasales'] : $session['username'] ?></span>
                                        <small class="text-muted"><?= $session['role'] ?></small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?= BASE_URL ?>auth/logout">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            </ul>
        </div>
    </nav>
    <!-- / Navbar -->