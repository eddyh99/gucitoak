<?php
// Pengecekan role di sini
$role = session()->get('logged_user')['role'];
?>

<?php if (!empty(session('success'))): ?>
    <div id="successtoast" class="bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1000">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Berhasil</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?= session('success') ?>
        </div>
    </div>
<?php endif; ?>


<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card card-border-shadow-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar me-4 ">
                                <span class="avatar-initial p-3 rounded bg-label-primary"><i class="bx bxs-truck bx-lg"></i></span>
                            </div>
                            <h4 class="mb-0">42</h4>
                        </div>
                        <p class="mb-2">On route vehicles</p>
                        <p class="mb-0">
                            <span class="text-heading fw-medium me-2">+18.2%</span>
                            <span class="text-muted">than last week</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card card-border-shadow-warning h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar me-4">
                                <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-error bx-lg"></i></span>
                            </div>
                            <h4 class="mb-0">8</h4>
                        </div>
                        <p class="mb-2">Vehicles with errors</p>
                        <p class="mb-0">
                            <span class="text-heading fw-medium me-2">-8.7%</span>
                            <span class="text-muted">than last week</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card card-border-shadow-warning h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar me-4">
                                <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-error bx-lg"></i></span>
                            </div>
                            <h4 class="mb-0">8</h4>
                        </div>
                        <p class="mb-2">Vehicles with errors</p>
                        <p class="mb-0">
                            <span class="text-heading fw-medium me-2">-8.7%</span>
                            <span class="text-muted">than last week</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card card-border-shadow-warning h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar me-4">
                                <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-error bx-lg"></i></span>
                            </div>
                            <h4 class="mb-0">8</h4>
                        </div>
                        <p class="mb-2">Vehicles with errors</p>
                        <p class="mb-0">
                            <span class="text-heading fw-medium me-2">-8.7%</span>
                            <span class="text-muted">than last week</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <?php if ($role == 'admin') : ?>
                    <div class="col-lg-6 mb-4 order-1">
                        <div class="card border-expat w-100">
                            <div class="card-body">
                                <h5 class="card-title fw-semibold mb-4">Stok Min Barang</h5>
                                <table id="table_list" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Barang</th>
                                            <th>Kategori</th>
                                            <th>Min</th>
                                            <th>Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4 order-1">
                        <div class="card border-expat w-100">
                            <div class="card-body">
                                <h5 class="card-title fw-semibold mb-4">Pembayaran Pelanggan</h5>
                                <table id="pembayaran_pelanggan" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Tanggal</th>
                                            <th>Tempo</th>
                                            <th>Sisa Cicilan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4 order-1">
                        <div class="card border-expat w-100">
                            <div class="card-body">
                                <h5 class="card-title fw-semibold mb-4">Pembayaran Suplier</h5>
                                <table id="pembayaran_suplier" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Tanggal</th>
                                            <th>Tempo</th>
                                            <th>Sisa Cicilan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
        <!-- / Content -->

        <?php if ($role == 'admin') : ?>
            <!-- Modal -->
            <div class="modal fade" id="detailcicilan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Cicilan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nominal</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody id="modalDataBody">
                                    <!-- Data will be inserted here -->
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                    ©
                    <?= date('Y') ?>
                    , made with
                    <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">Softwarebali.com</a>
                </div>
            </div>
        </footer>
        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->

</div>