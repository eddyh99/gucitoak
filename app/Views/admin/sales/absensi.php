<?php if (!empty(session('failed'))): ?>
    <div id="failedtoast" class="bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1000">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Error</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?= session('failed') ?>
        </div>
    </div>
<?php endif; ?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row justify-content-center">
            <div class="col-lg-8 mb-4 order-1">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-white">
                            <i class="bx bx-user-check me-2 "></i>Absensi Sales
                        </h5>
                        <span class="badge bg-white text-primary"><?= date('l, d F Y') ?></span>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="avatar avatar-xl bg-primary rounded-circle d-flex align-items-center justify-content-center mt-2">
                                <i class="bx bx-qr-scan fs-1 text-white"></i>
                            </div>
                            <h4 class="mb-2">Scan Barcode Absensi</h4>
                            <p class="text-muted">Masukkan kode barcode atau scan menggunakan scanner</p>
                        </div>
                        
                        <form id="frmabsensi" method="POST">
                            <div class="row">
                                <div class="col-md-8 mx-auto">
                                    <div class="input-group input-group-lg mb-3 shadow-sm">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="bx bx-barcode text-primary"></i>
                                        </span>
                                        <input name="barcode" id="barcode" type="text" 
                                            class="form-control border-0 py-3" 
                                            placeholder="SLSXX-<?= date('Ymd') ?>-XXXX" 
                                            maxlength="20"
                                            style="background-color: #f8f9fa;">
                                        <button type="submit" class="btn btn-primary px-4">
                                            <i class="bx bx-check-circle me-2"></i>Verify
                                        </button>
                                    </div>
                                    <div class="text-center mt-2">
                                        <small class="text-muted">Format: SLSXX-YYYYMMDD-XXXX</small>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-light text-center py-3">
                        <small class="text-danger">Pastikan barcode valid</small>
                    </div>
                </div>
<!--                 
                <div class="text-center mt-4">
                    <button class="btn btn-outline-secondary me-2">
                        <i class="bx bx-help-circle me-1"></i> Bantuan
                    </button>
                    <button class="btn btn-outline-primary">
                        <i class="bx bx-history me-1"></i> Riwayat Absensi
                    </button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- / Content -->
    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">
        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
                ©
                <?= date('Y') ?>
                , made with
                <a href="#" target="_blank" class="footer-link fw-bolder">Softwarebali.com</a>
            </div>
        </div>
    </footer>
    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->

</div>