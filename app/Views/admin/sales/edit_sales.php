<?php if(!empty(session('failed'))): ?>
    <div id="failedtoast" class="bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1000">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Error</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?= session('failed')?>
        </div>
    </div>
<?php endif;?>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-4 order-1">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <a href="<?= BASE_URL?>sales" class="me-2">
                                <i class="bx bx-chevron-left fs-2"></i>
                                Back
                            </a>
                            <h5 class="mb-1">Edit Sales</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= BASE_URL ?>sales/ubah_sales" method="POST">
                                <input type="hidden" name="idsales" value="<?=$sales->id?>">
                                <div class="mb-3">
                                    <label class="form-label" for="username">Nama Sales</label>
                                    <div class="input-group input-group-merge">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="sales"
                                            placeholder="John_Doe"
                                            name="sales"
                                            value="<?=$sales->namasales?>"
                                        />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="nama">Alamat</label>
                                    <div class="input-group input-group-merge">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="alamat"
                                            placeholder="Jl. HOS Cokroaminoto...."
                                            name="alamat"
                                            value="<?=$sales->alamat?>"
                                        />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="password">Kota</label>
                                    </div>
                                    <div class="input-group input-group-merge">
                                        <input
                                            type="text"
                                            id="kota"
                                            class="form-control"
                                            name="kota"
                                            placeholder="Badung"
                                            value="<?=$sales->kota?>"
                                        />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="nama">telp</label>
                                    <div class="input-group input-group-merge">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="telp"
                                            placeholder="08225455222"
                                            name="telp"
                                            value="<?=$sales->telp?>"
                                        />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="nama">Omzet</label>
                                    <div class="input-group input-group-merge">
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="omzet"
                                            placeholder="100000000"
                                            name="omzet"
                                            value="<?=$sales->omzet?>"
                                        />
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Data</button>
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