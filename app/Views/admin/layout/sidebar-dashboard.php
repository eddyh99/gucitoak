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
              <!-- <i class="bx bx-home me-2"></i> -->
              <img src="<?= BASE_URL ?>assets/img/icons/118770_home_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
              <span>Dashboard</span>
            </a>
          </h2>
        </div>
        <!-- Setup Data -->
        <?php if ($isAdmin || isset($akses->setup)): ?>
        
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSetup" aria-expanded="false" aria-controls="collapseSetup">
                <img src="<?= BASE_URL ?>assets/img/icons/118868_emblem_system_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                    <span>Setup Data</span>
                </button>
              </h2>
              <div id="collapseSetup" class="accordion-collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php if ($isAdmin || $hasPermission(Menu::DAFTAR_PENGGUNA, 'setup')): ?>
                        <li class="menu-item <?= $user_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>user" class="menu-link-inside d-flex justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118828_system_users_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="User" style="font-size: 12px;">Daftar Pengguna</div>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if ($isAdmin): ?>
                        <li class="menu-item <?= $hakakses_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>hakakses" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118795_lock_screen_system_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="Assign Sales" style="font-size: 12px;">Hak Akses</div>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if ($isAdmin || $hasPermission(Menu::DAFTAR_SALES, 'setup')): ?>
                        <li class="menu-item <?= $sales_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>sales" class="menu-link-inside d-flex justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118828_system_users_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="Sales" style="font-size: 12px;">Daftar Sales</div>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if ($isAdmin || $hasPermission(Menu::ABSENSI_SALES, 'setup')): ?>
                        <li class="menu-item <?= $absensi_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>sales/absensi" class="menu-link-inside d-flex justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118828_system_users_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="Sales" style="font-size: 12px;">Absensi Sales</div>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if ($isAdmin || $hasPermission(Menu::DAFTAR_SUPLIER, 'setup')): ?>
                        <li class="menu-item <?= $supplier_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>suplier" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118828_system_users_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="Supplier" style="font-size: 12px;">Daftar Supplier</div>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if ($isAdmin || $hasPermission(Menu::DAFTAR_PELANGGAN, 'setup')): ?>
                        <li class="menu-item <?= $pelanggan_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>pelanggan" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/outlet.ico" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="Pelanggan" style="font-size: 12px;">Daftar Outlet</div>
                            </a>
                        </li>
                    <?php endif ?>
                    <hr>
                    <?php if ($isAdmin || $hasPermission(Menu::DAFTAR_KATEGORI, 'setup')): ?>
                        <li class="menu-item <?= $kategori_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>kategori" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118825_manager_system_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="Kategori" style="font-size: 12px;">Daftar Kategori</div>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if ($isAdmin || $hasPermission(Menu::DAFTAR_SATUAN, 'setup')): ?>
                        <li class="menu-item <?= $satuan_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>satuan" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118825_manager_system_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="Satuan" style="font-size: 12px;">Daftar Satuan</div>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if ($isAdmin || $hasPermission(Menu::DAFTAR_BARANG, 'setup')): ?>
                        <li class="menu-item <?= $barang_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>barang" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118825_manager_system_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="Barang" style="font-size: 12px;">Daftar Barang</div>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if ($isAdmin || $hasPermission(Menu::DAFTAR_BARANG_SALES, 'setup')): ?>
                        <li class="menu-item <?= $assignsales_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>sales/list_assign_sales" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118825_manager_system_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="Assign Sales" style="font-size: 12px;">Daftar Barang Sales</div>
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
                    <!-- <i class="bx bx-package me-2"></i> -->
                    <img src="<?= BASE_URL ?>assets/img/icons/118888_generic_package_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                    <span>Persediaan</span>
                </button>
              </h2>
              <div id="collapsePersediaan" class="accordion-collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php if ($isAdmin || $hasPermission(Menu::INPUT_STOK, 'persediaan')): ?>
                        <li class="menu-item <?= $inputstok_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>stok/tambah_stokbarang" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118777_add_list_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="User" style="font-size: 12px;">Input Stok Awal</div>
                            </a>
                        </li>
                    <?php endif ?>
        
                    <?php if ($isAdmin || $hasPermission(Menu::PENYESUAIAN_STOK, 'persediaan')): ?>
                        <li class="menu-item <?= $stokopname_active ?? '' ?> ">
                            <a href="<?= BASE_URL ?>opname" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118842_preferences_system_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="Stok Opname" style="font-size: 12px;">Penyesuaian Stok</div>
                            </a>
                        </li>
                    <?php endif ?>
                    <hr>
        
                    <?php if ($isAdmin || $hasPermission(Menu::STOK_BARANG, 'persediaan')): ?>
                        <li class="menu-item <?= $stokbarang_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>stok" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118861_printer_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="User" style="font-size: 12px;">Stok Barang</div>
                            </a>
                        </li>
                    <?php endif ?>
        
                    <?php if ($isAdmin || $hasPermission(Menu::CONFIRM_OPNAME, 'persediaan')): ?>
                        <li class="menu-item <?= $stokopnamekonfirm_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>opname/konfirm" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118864_important_emblem_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="Konfirm Opname" style="font-size: 12px;">Konfirm Opname</div>
                            </a>
                        </li>
                    <?php endif ?>
        
                    <?php if ($isAdmin || $hasPermission(Menu::CONFIRM_DISPOSE, 'persediaan')): ?>
                        <li class="menu-item <?= @$stokdisposekonfirm_active ?>">
                            <a href="<?= BASE_URL ?>dispose/konfirm" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118864_important_emblem_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="Konfirm Opname" style="font-size: 12px;">Konfirm Dispose</div>
                            </a>
                        </li>
                    <?php endif ?>
        
                    <?php if ($isAdmin || $hasPermission(Menu::HAPUS_STOK, 'persediaan')): ?>
                        <li class="menu-item <?= @$hapusstok_active ?>">
                            <a href="<?= BASE_URL ?>opname/hapusstok" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118794_process_stop_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
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
                    <!-- <i class="bx bx-basket me-2"></i> -->
                    <img src="<?= BASE_URL ?>assets/img/icons/43419_bar_chart_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                    <span>Transaksi</span>
                </button>
              </h2>
              <div id="collapseTransaksi" class="accordion-collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                        <?php if ($isAdmin || $hasPermission(Menu::PEMBELIAN, 'transaksi')): ?>
                            <li class="menu-item <?= $trx_pembelian ?? '' ?>">
                                <a href="<?= BASE_URL ?>pembelian" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <img src="<?= BASE_URL ?>assets/img/icons/chart.png" alt="Home Icon" class="me-2" width="24" height="24">
                                    <div data-i18n="Pembelian Barang" style="font-size: 12px;">Pembelian</div>
                                </a>
                            </li>
                        <?php endif ?>
        
                        <?php if ($isAdmin || $hasPermission(Menu::RETUR_SUPLIER, 'transaksi')): ?>
                            <li class="menu-item <?= $trx_retursup ?? '' ?>">
                                <a href="<?= BASE_URL ?>retur/suplier" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <img src="<?= BASE_URL ?>assets/img/icons/118801_refresh_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                                    <div data-i18n="Retur Supplier" style="font-size: 12px;">Retur Supplier</div>
                                </a>
                            </li>
                        <?php endif ?>
                        <hr>
        
                        <?php if ($isAdmin || $hasPermission(Menu::PENJUALAN, 'transaksi')): ?>
                            <li class="menu-item <?= $trx_penjualan ?? '' ?>">
                                <a href="<?= BASE_URL ?>penjualan" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <img src="<?= BASE_URL ?>assets/img/icons/chart.png" alt="Home Icon" class="me-2" width="24" height="24">
                                    <div data-i18n="Penjualan" style="font-size: 12px;">Penjualan</div>
                                </a>
                            </li>
                        <?php endif ?>
        
                        <?php if ($isAdmin || $hasPermission(Menu::RETUR_PELANGGAN, 'transaksi')): ?>
                            <li class="menu-item <?= $trx_returpel ?? '' ?>">
                                <a href="<?= BASE_URL ?>retur/pelanggan" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <img src="<?= BASE_URL ?>assets/img/icons/118801_refresh_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                                    <div data-i18n="Penjualan" style="font-size: 12px;">Retur Outlet</div>
                                </a>
                            </li>
                        <?php endif ?>
                        <hr>
        
                        <?php if ($isAdmin || $hasPermission(Menu::PEMBAYARAN_PELANGGAN, 'transaksi')): ?>
                            <li class="menu-item <?= $trx_pembayaranpel ?? '' ?>">
                                <a href="<?= BASE_URL ?>pembayaran/pelanggan" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <img src="<?= BASE_URL ?>assets/img/icons/cash-out.png" alt="Home Icon" class="me-2" width="24" height="24">
                                    <div data-i18n="Penjualan" style="font-size: 12px;">Pembayaran Outlet</div>
                                </a>
                            </li>
                        <?php endif ?>
        
                        <?php if ($isAdmin || $hasPermission(Menu::PEMBAYARAN_SUPLIER, 'transaksi')): ?>
                            <li class="menu-item <?= $trx_pembayaransup ?? '' ?>">
                                <a href="<?= BASE_URL ?>pembayaran/suplier" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <img src="<?= BASE_URL ?>assets/img/icons/cash-out.png" alt="Home Icon" class="me-2" width="24" height="24">
                                    <div data-i18n="Penjualan" style="font-size: 12px;">Pembayaran Suplier</div>
                                </a>
                            </li>
                        <?php endif ?>

                        <?php if ($isAdmin || $hasPermission(Menu::BIAYA, 'transaksi')): ?>
                        <li class="menu-item <?= $trx_biaya ?? '' ?>">
                                <a href="<?= BASE_URL ?>biaya" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                                <img src="<?= BASE_URL ?>assets/img/icons/cash-out.png" alt="Home Icon" class="me-2" width="24" height="24">
                                    <div data-i18n="Penjualan" style="font-size: 12px;">Pencatatan Biaya</div>
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
                    <!-- <i class="bx bx-purchase-tag-alt me-2"></i> -->
                    <img src="<?= BASE_URL ?>assets/img/icons/118903_spreadsheet_office_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                    <span>Laporan</span>
                </button>
              </h2>
              <div id="collapseLaporan" class="accordion-collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                <?php if ($isAdmin || $hasPermission(Menu::LAP_ABSENSI_SALES, 'laporan')): ?>
                <li class="menu-item <?= $salesactivity_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>laporan/aktivitas_sales" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118828_system_users_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="Laporan" style="font-size: 12px;">Aktivitas Sales</div>
                            </a>
                    </li>
                    <?php endif ?>
                    <?php if ($isAdmin || $hasPermission(Menu::LAP_ABSENSI_SALES, 'laporan')): ?>
                <li class="menu-item <?= $salestracker_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>location" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118828_system_users_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="Laporan" style="font-size: 12px;">Sales Tracker</div>
                            </a>
                    </li>
                    <?php endif ?>
                    <?php if ($isAdmin || $hasPermission(Menu::LAP_ABSENSI_SALES, 'laporan')): ?>
                <li class="menu-item <?= $recordloc_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>location/record" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118828_system_users_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="Laporan" style="font-size: 12px;">Record Location</div>
                            </a>
                    </li>
                    <?php endif ?>
                <?php if ($isAdmin || $hasPermission(Menu::BARANG_EXPIRED, 'laporan')): ?>
                <li class="menu-item <?= $barangexp_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>laporan/barangexp" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118911_document_open_icon.png" alt="Home Icon" class="me-2" width="24" height="24"> 
                                <div data-i18n="Laporan" style="font-size: 12px;">Barang Expired</div>
                            </a>
                    </li>
                    <?php endif ?>
                    <?php if ($isAdmin || $hasPermission(Menu::STOK_MIN_BARANG, 'laporan')): ?>
                        <li class="menu-item <?= $stokminbrg_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>laporan/barang" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118927_network_server_icon.png" alt="Home Icon" class="me-2" width="24" height="24"> 
                                <div data-i18n="Laporan" style="font-size: 12px;">Stok Min Barang</div>
                            </a>
                        </li>
                    <?php endif ?>
        
                    <?php if ($isAdmin || $hasPermission(Menu::MUTASI_STOK, 'laporan')): ?>
                        <li class="menu-item <?= $mutasistok_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>laporan/mutasistok" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118824_windows_preferences_system_icon.png" alt="Home Icon" class="me-2" width="24" height="24"> 
                                <div data-i18n="Laporan" style="font-size: 12px;">Mutasi Stok</div>
                            </a>
                        </li>
                    <?php endif ?>
        
                    <?php if ($isAdmin || $hasPermission(Menu::PENJUALAN_SUMMARY, 'laporan')): ?>
                        <li class="menu-item <?= $penjualan_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>laporan/penjualan" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118805_text_accessories_editor_icon.png" alt="Home Icon" class="me-2" width="24" height="24"> 
                                <div data-i18n="Laporan" style="font-size: 12px;">Penjualan</div>
                            </a>
                        </li>
                    <?php endif ?>

                    <?php if ($isAdmin || $hasPermission(Menu::PENJUALAN_OUTLET, 'laporan')): ?>
                        <li class="menu-item <?= $penjualanoutlet_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>laporan/penjualan_outlet" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118811_calendar_office_icon.png" alt="Home Icon" class="me-2" width="24" height="24"> 
                                <div data-i18n="Laporan" style="font-size: 12px;">Penjualan Outlet</div>
                            </a>
                        </li>
                    <?php endif ?>
        
                    <?php if ($isAdmin || $hasPermission(Menu::PEMBELIAN_SUMMARY, 'laporan')): ?>
                        <li class="menu-item <?= $pembelian_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>laporan/pembelian" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118805_text_accessories_editor_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="Laporan" style="font-size: 12px;">Pembelian</div>
                            </a>
                        </li>
                    <?php endif ?>
        <hr>
                    <?php if ($isAdmin || $hasPermission(Menu::LAP_RETUR_SUPLIER, 'laporan')): ?>
                        <li class="menu-item <?= $retursup_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>laporan/retursup" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118801_refresh_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="Laporan" style="font-size: 12px;">Retur Suplier</div>
                            </a>
                        </li>
                    <?php endif ?>
        
                    <?php if ($isAdmin || $hasPermission(Menu::LAP_RETUR_PELANGGAN, 'laporan')): ?>
                        <li class="menu-item <?= $returpel_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>laporan/returpel" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118801_refresh_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="Laporan" style="font-size: 12px;">Retur Outlet</div>
                            </a>
                        </li>
                    <?php endif ?>

                    <?php if ($isAdmin || $hasPermission(Menu::LAP_RETUR_PELANGGAN_MONTHLY, 'laporan')): ?>
                    <li class="menu-item <?= $returpelm_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>laporan/returpel_monthly" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118801_refresh_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="Laporan" style="font-size: 12px;">Retur Outlet <small><b>(Bulanan)</b></small></div>
                            </a>
                        </li>
                    <?php endif ?>

                    <?php if ($isAdmin || $hasPermission(Menu::HUTANG_SUPLIER, 'laporan')): ?>
                    <li class="menu-item <?= $hutangsuplier_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>laporan/hutang_suplier" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/cash-out.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="Laporan" style="font-size: 12px;">Hutang Suplier</div>
                            </a>
                    </li>
                    <?php endif ?>

                    <?php if ($isAdmin || $hasPermission(Menu::HUTANG_SUPLIER, 'laporan')): ?>
                    <li class="menu-item <?= $hutangoutlet_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>laporan/hutang_outlet" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/cash-out.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="Laporan" style="font-size: 12px;">Hutang Outlet</div>
                            </a>
                    </li>
                    <?php endif ?>

                    <?php if ($isAdmin || $hasPermission(Menu::LAP_BIAYA, 'laporan')): ?>
                    <li class="menu-item <?= $biaya_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>laporan/biaya" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/cash-out.png" alt="Home Icon" class="me-2" width="24" height="24">
                                <div data-i18n="Laporan" style="font-size: 12px;">Biaya</div>
                            </a>
                    </li>
                    <?php endif ?>
                    
                    <hr>
                    <?php if ($isAdmin || $hasPermission(Menu::OMZET_OUTLET, 'laporan')): ?>
                        <li class="menu-item <?= $omzetoutlet_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>laporan/omzet_outlet" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/chart-2.png" alt="Home Icon" class="me-2" width="24" height="24"> 
                                <div data-i18n="Laporan" style="font-size: 12px;">Omzet Outlet</div>
                            </a>
                        </li>
                    <?php endif ?>

                    <?php if ($isAdmin || $hasPermission(Menu::LAP_LABARUGI, 'laporan')): ?>
                    <li class="menu-item <?= $pnl_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>laporan/pnl" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/chart-2.png" alt="Home Icon" class="me-2" width="24" height="24"> 
                                <div data-i18n="Laporan" style="font-size: 12px;">Laba Rugi</div>
                            </a>
                        </li>
                    <?php endif ?>

                        <?php if ($isAdmin || $hasPermission(Menu::LAP_ARUSKAS, 'laporan')): ?>
                        <li class="menu-item <?= $aruskas_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>laporan/aruskas" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/chart-2.png" alt="Home Icon" class="me-2" width="24" height="24"> 
                                <div data-i18n="Laporan" style="font-size: 12px;">Arus Kas</div>
                            </a>
                        </li>
                        <?php endif ?>
        
                    <?php if ($isAdmin || $hasPermission(Menu::OUTLET_IDLE, 'laporan')): ?>
                        <li class="menu-item <?= $outletidle_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>laporan/outlet_idle" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118937_battery_caution_icon.png" alt="Home Icon" class="me-2" width="24" height="24"> 
                                <div data-i18n="Laporan" style="font-size: 12px;">Outlet Idle</div>
                            </a>
                        </li>
                    <?php endif ?>
        
                    <?php if ($isAdmin || $hasPermission(Menu::KATALOG, 'laporan')): ?>
                        <li class="menu-item <?= $katalog_active ?? '' ?>">
                            <a href="<?= BASE_URL ?>laporan/katalog" class="menu-link-inside d-flex  justify-content-start align-items-center px-3 py-2">
                            <img src="<?= BASE_URL ?>assets/img/icons/118911_document_open_icon.png" alt="Home Icon" class="me-2" width="24" height="24"> 
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
                    <!-- <i class="bx bx-money me-2"></i> -->
                    <img src="<?= BASE_URL ?>assets/img/icons/dollar.png" alt="Home Icon" class="me-2" width="24" height="24">
                    <span>Gaji</span>
                </a>
              </h2>
            </div>
        <?php endif ?>

        <?php if ($isSales): ?>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <a href="<?= BASE_URL ?>sales/barang_sales" class="accordion-button">
            <img src="<?= BASE_URL ?>assets/img/icons/118825_manager_system_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                <span>Daftar Barang</span>
            </a>
          </h2>
        </div>
        <?php endif ?>
    
        <?php if ($isSales): ?>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <a href="<?= BASE_URL ?>laporan/omzet_sales" class="accordion-button">
            <img src="<?= BASE_URL ?>assets/img/icons/dollar.png" alt="Home Icon" class="me-2" width="24" height="24">
                <span>Laporan Omzet</span>
            </a>
          </h2>
        </div>
        <?php endif ?>
    
        <?php if ($isSales): ?>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <a href="<?= BASE_URL ?>laporan/slipgaji" class="accordion-button">
                <img src="<?= BASE_URL ?>assets/img/icons/dollar.png" alt="Home Icon" class="me-2" width="24" height="24">
                    <span>Slip Gaji</span>
                </a>
              </h2>
            </div>
        <?php endif ?>
        <?php if ($isSales): ?>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <a href="<?= BASE_URL ?>mobile/profile" class="accordion-button">
                <img src="<?= BASE_URL ?>assets/img/icons/118828_system_users_icon.png" alt="Home Icon" class="me-2" width="24" height="24">
                    <span>Profile</span>
                </a>
              </h2>
            </div>
        <?php endif ?>
      </div>
    </ul>
</aside>

<div class="layout-page">
<?php if(isset($session['role'])): ?>
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
<?php endif ?>
    <!-- / Navbar -->