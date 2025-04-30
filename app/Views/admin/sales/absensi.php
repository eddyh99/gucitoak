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
        <div class="row">
            <div class="col-lg-12 mb-4 order-1">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <!-- <a href="<?= BASE_URL ?>stok" class="me-2">
                                <i class="bx bx-chevron-left fs-2"></i>
                                Kembali
                            </a> -->
                        <h5 class="mb-1">Absensi Sales</h5>
                    </div>
                    <div class="card-body">
                        <form id="frmabsensi" method="POST">
                            <div class="row">
                                <div class="input-group mb-3">
                                    <input name="barcode" id="barcode" type="text" class="form-control" placeholder="SLSXX-<?= date('Ymd') ?>-XXXX" maxlength="20" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2"> <button type="submit" class="btn btn-primary d-flex align-items-center">
                                            Check
                                        </button></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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