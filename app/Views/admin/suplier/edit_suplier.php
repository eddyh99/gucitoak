<?php if(!empty(session('failed'))): ?>
    <div id="failedtoast" class="bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1000">
        <div class="toast-header">
            <i class="bx bx-x me-2"></i>
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
                            <a href="<?= BASE_URL?>suplier" class="me-2">
                                <i class="bx bx-chevron-left fs-2"></i>
                                Back
                            </a>
                            <h5 class="mb-1">Edit Suplier</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= BASE_URL ?>suplier/ubah_suplier" method="POST">
                                <input type="hidden" name="idsuplier" value="<?=$suplier->id?>">
                                <div class="row row-cols-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="suplier">Nama suplier</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="suplier"
                                                placeholder="Nama Suplier"
                                                name="suplier"
                                                value="<?=$suplier->namasuplier?>"
                                                
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="pemilik">Nama Pemilik</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="pemilik"
                                                placeholder="Nama Pemilik"
                                                name="pemilik"
                                                value="<?=$suplier->pemilik?>"
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
                                                placeholder="Alamat"
                                                name="alamat"
                                                value="<?=$suplier->alamat?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="kota">Kota</label>
                                        </div>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                id="kota"
                                                class="form-control"
                                                name="kota"
                                                placeholder="Kota"
                                                value="<?=$suplier->kota?>"
                                                
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="telp">telp</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="telp"
                                                placeholder="No Telphone"
                                                name="telp"
                                                value="<?=$suplier->telp?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="norek">No. Rek</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="norek"
                                                placeholder="No Rekening"
                                                name="norek"
                                                value="<?=$suplier->norek?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="namabank">Nama Bank</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="namabank"
                                                placeholder="Nama Bank"
                                                name="namabank"
                                                value="<?=$suplier->namabank?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="anbank">An. Bank</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="anbank"
                                                placeholder="Atas Nama Bank"
                                                name="anbank"
                                                value="<?=$suplier->anbank?>"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Edit Data</button>
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
