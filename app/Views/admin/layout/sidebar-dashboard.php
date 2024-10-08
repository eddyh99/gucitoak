<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
           <img class="img-fluid" src="<?= BASE_URL ?>assets/img/logo.png" width="100" alt="logo guci toak">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item <?= @$active_dash?>">
            <a href="<?= BASE_URL ?>dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle "></i>
                <div data-i18n="Analytics" class="text-center">Dashboard</div>
            </a>
        </li>

        <!-- <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Setup</span>
        </li> -->
        <li class="menu-item setup <?= @$menuactive_setup ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Account Settings" class="text-center">Setup Data</div>
            </a>
        </li>

      <li class="menu-item master <?= @$menuactive_master ?>">
            <a href="javascript:void(0);" class="menu-link  menu-toggle">
                <i class="menu-icon tf-icons bx bx-layer-plus"></i>
                <div data-i18n="Account Settings"  class="text-center">Master Data</div>
            </a>
        </li>

        <li class="menu-item persediaan <?= @$menuactive_persediaan ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div data-i18n="Account Settings" class="text-center">Persediaan Barang</div>
            </a>
        </li>
    </ul>
</aside>

<div class="sub-menu setup">
    <ul class="ul-sub-menu">
        <li class="menu-item">
            <a href="<?= BASE_URL ?>user/tambah_user" class="menu-link-inside d-flex justify-content-start align-items-center px-4 py-2">
                <i class="menu-icon fs-5 tf-icons bx bx-plus-circle px-2"></i>
                <div data-i18n="User" style="font-size: 12px;">Tambah User</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= BASE_URL ?>user" class="menu-link-inside d-flex justify-content-start align-items-center px-4 py-2">
                <i class="menu-icon fs-5 tf-icons bx bx-list-ol px-2"></i>
                <div data-i18n="User" style="font-size: 12px;">List User</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= BASE_URL ?>sales/tambah_sales" class="menu-link-inside d-flex  justify-content-start align-items-center px-4 py-2">
                <i class="menu-icon fs-5 tf-icons bx bx-plus-circle px-2"></i>
                <div data-i18n="Sales" style="font-size: 12px;">Tambah Sales</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= BASE_URL ?>sales" class="menu-link-inside d-flex  justify-content-start align-items-center px-4 py-2">
                <i class="menu-icon fs-5 tf-icons bx bx-list-ol px-2"></i>
                <div data-i18n="Sales" style="font-size: 12px;">List Sales</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= BASE_URL ?>kategori/tambah_kategori" class="menu-link-inside d-flex  justify-content-start align-items-center px-4 py-2">
                <i class="menu-icon fs-5 tf-icons bx bx-plus-circle px-2"></i>
                <div data-i18n="Kategori" style="font-size: 12px;">Tambah Kategori</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= BASE_URL ?>kategori" class="menu-link-inside d-flex  justify-content-start align-items-center px-4 py-2">
                <i class="menu-icon fs-5 tf-icons bx bx-list-ol px-2"></i>
                <div data-i18n="Kategori" style="font-size: 12px;">List Kategori</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= BASE_URL ?>satuan/tambah_satuan" class="menu-link-inside d-flex  justify-content-start align-items-center px-4 py-2">
            <i class="menu-icon fs-5 tf-icons bx bx-plus-circle px-2"></i>
                <div data-i18n="Satuan" style="font-size: 12px;">Tambah Satuan</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= BASE_URL ?>satuan" class="menu-link-inside d-flex  justify-content-start align-items-center px-4 py-2">
            <i class="menu-icon fs-5 tf-icons bx bx-list-ol px-2"></i>
                <div data-i18n="Satuan" style="font-size: 12px;">List Satuan</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= BASE_URL ?>barang/tambah_barang" class="menu-link-inside d-flex  justify-content-start align-items-center px-4 py-2">
                <i class="menu-icon fs-5 tf-icons bx bx-plus-circle px-2"></i>
                <div data-i18n="Barang" style="font-size: 12px;">Tambah Barang</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= BASE_URL ?>barang" class="menu-link-inside d-flex  justify-content-start align-items-center px-4 py-2">
                <i class="menu-icon fs-5 tf-icons bx bx-list-ol px-2"></i>
                <div data-i18n="Barang" style="font-size: 12px;">List Barang</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= BASE_URL ?>suplier/tambah_suplier" class="menu-link-inside d-flex  justify-content-start align-items-center px-4 py-2">
            <i class="menu-icon fs-5 tf-icons bx bx-plus-circle px-2"></i>
                <div data-i18n="Supplier" style="font-size: 12px;">Tambah Supplier</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= BASE_URL ?>suplier" class="menu-link-inside d-flex  justify-content-start align-items-center px-4 py-2">
            <i class="menu-icon fs-5 tf-icons bx bx-list-ol px-2"></i>
                <div data-i18n="Supplier" style="font-size: 12px;">List  Supplier</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= BASE_URL ?>pelanggan/tambah_pelanggan" class="menu-link-inside d-flex  justify-content-start align-items-center px-4 py-2">
                <i class="menu-icon fs-5 tf-icons bx bx-plus-circle px-2"></i>
                <div data-i18n="Pelanggan" style="font-size: 12px;">Tambah Pelanggan</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= BASE_URL ?>pelanggan" class="menu-link-inside d-flex  justify-content-start align-items-center px-4 py-2">
                <i class="menu-icon fs-5 tf-icons bx bx-list-ol px-2"></i>
                <div data-i18n="Pelanggan" style="font-size: 12px;">List Pelanggan</div>
            </a>
        </li>
    </ul>
</div>

<div class="sub-menu master">
    <ul class="ul-sub-menu">
        <li class="menu-item">
            <a href="<?= BASE_URL ?>sales/assign_sales" class="menu-link-inside d-flex  justify-content-start align-items-center px-4 py-2">
                <i class="menu-icon fs-5 tf-icons bx bx-plus-circle px-2"></i>
                <div data-i18n="Assign Sales" style="font-size: 12px;">Assign Sales</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= BASE_URL ?>sales/list_assign_sales" class="menu-link-inside d-flex  justify-content-start align-items-center px-4 py-2">
                <i class="menu-icon fs-5 tf-icons bx bx-list-ol px-2"></i>
                <div data-i18n="Assign Sales" style="font-size: 12px;">List Assign Sales</div>
            </a>
        </li>
    </ul>
</div>

<div class="sub-menu persediaan">
    <ul class="ul-sub-menu">
        <li class="menu-item">
            <a href="<?= BASE_URL ?>stok" class="menu-link-inside d-flex  justify-content-start align-items-center px-4 py-2">
                <i class="menu-icon fs-5 tf-icons bx bx-plus-circle px-2"></i>
                <div data-i18n="User" style="font-size: 12px;">Tambah Stok</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= BASE_URL ?>stok" class="menu-link-inside d-flex  justify-content-start align-items-center px-4 py-2">
                <i class="menu-icon fs-5 tf-icons bx bx-list-ol px-2"></i>
                <div data-i18n="User" style="font-size: 12px;">List Stok</div>
            </a>
        </li>
        <li class="menu-item ">
            <a href="<?= BASE_URL ?>opname" class="menu-link-inside d-flex  justify-content-start align-items-center px-4 py-2">
                <i class="menu-icon fs-5 tf-icons bx bx-box px-2"></i>
                <div data-i18n="Stok Opname" style="font-size: 12px;">Stok Opname</div>
            </a>
        </li>
        <li class="menu-item <?= @$stokopnamekonfirm_active ?>">
            <a href="<?= BASE_URL ?>opname/konfirm" class="menu-link-inside d-flex  justify-content-start align-items-center px-4 py-2">
                <i class="menu-icon fs-5 tf-icons bx bx-check-shield px-2"></i>
                <div data-i18n="Konfirm Opname" style="font-size: 12px;">Konfirm Opname</div>
            </a>
        </li>
        <li class="menu-item <?= @$stokmutasi_active ?>">
            <a href="<?= BASE_URL ?>pelanggan" class="menu-link-inside d-flex  justify-content-start align-items-center px-4 py-2">
                <i class="menu-icon fs-5 tf-icons bx bx-list-ol px-2"></i>
                <div data-i18n="Mutasi Stok" style="font-size: 12px;">Mutasi Stok</div>
            </a>
        </li>
    </ul>
</div>

<div class="layout-page">
    <!-- Navbar -->
    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input
                type="text"
                class="form-control border-0 shadow-none"
                placeholder="Search..."
                aria-label="Search..."
                />
            </div>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <span class="avatar-initial rounded-circle bg-label-warning">AP</span>
                        <!-- <img src="<?= BASE_URL ?>assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" /> -->
                    </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                <div class="avatar avatar-online">
                                    <span class="avatar-initial rounded-circle bg-label-warning">AP</span>
                                </div>
                                </div>
                                <div class="flex-grow-1">
                                <span class="fw-semibold d-block">Ari Pramana</span>
                                <small class="text-muted">Admin</small>
                                </div>
                            </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bx bx-cog me-2"></i>
                                <span class="align-middle">Settings</span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="auth/logout">
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