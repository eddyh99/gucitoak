<?php
// Pengecekan role di sini
$role = session()->get('logged_user')['role'] ?? null;
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
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <?php if ($role == 'superadmin' || $role == 'admin') : ?>
                    <div class="col-lg-6 mb-4 order-1">
                        <div class="card border-expat w-100">
                        <div class="card-header bg-primary pb-2">
                            <h5 class="card-title text-white">Stok Min Barang</h5>
                        </div>
                            <div class="card-body mt-2">
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
                        <div class="card-header bg-primary pb-2">
                            <h5 class="card-title text-white">Pembayaran Outlet</h5>
                        </div>
                            <div class="card-body mt-2">
                                <table id="pembayaran_pelanggan" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
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
                        <div class="card-header bg-primary pb-2">
                            <h5 class="card-title text-white">Pembayaran Suplier</h5>
                        </div>
                            <div class="card-body mt-2">
                                <table id="pembayaran_suplier" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
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

                    <?php if ($role != 'superadmin' || $role != 'admin') : ?>
                    <div class="col-lg-6 mb-4 order-1">
                        <div class="card border-expat w-100">
                        <div class="card-header bg-primary pb-2">
                            <h5 class="card-title text-white">Penjualan Bulan Ini</h5>
                        </div>
                            <div class="card-body mt-2" style="overflow: auto;">
                                <table id="omzet_sales" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nonota</th>
                                            <th>Tanggal</th>
                                            <th>Komisi</th>
                                            <th>Nominal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot class="fw-bold">
                                        <tr>
                                            <td colspan="3" style="text-align: right;">Total Omzet:</td>
                                            <td class="total"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php endif ?>
            </div>
        </div>
        <!-- / Content -->

        <?php if ($role == 'superadmin' || $role == 'admin') : ?>
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><img src="<?= BASE_URL ?>assets/img/icons/118788_media_playback_stop_icon.png" alt="Home Icon" width="20" height="20">Close</button>
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