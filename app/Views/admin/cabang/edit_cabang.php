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
                            <a href="<?= BASE_URL?>cabang" class="me-2">
                                <i class="bx bx-chevron-left fs-2"></i>
                                Back
                            </a>
                            <h5 class="mb-1">Edit Cabang</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= BASE_URL ?>cabang/ubah_proccess" method="POST">
                                <input type="hidden" name="idcabang" value="<?= base64_encode($cabang->id); ?>">
                                <div class="row row-cols-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="cabang">Nama Cabang</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="cabang"
                                                placeholder="Nama Cabang"
                                                name="cabang"
                                                value="<?= $cabang->namacabang; ?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="alamat">Alamat</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="alamat"
                                                placeholder="Alamat"
                                                name="alamat"
                                                value="<?= $cabang->alamat; ?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="lat">Latitude</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="lat"
                                                placeholder="Latitude"
                                                name="lat"
                                                value="<?= $cabang->lat; ?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="long">Longitude</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="long"
                                                placeholder="Longitude"
                                                name="long"
                                                value="<?= $cabang->long; ?>"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <small>Tips mencari Latitude dan Longitude<a target="_blank" href="https://support.google.com/maps/answer/18539?hl=en&co=GENIE.Platform%3DDesktop"> click disini</a></small><br><br>
                                <button type="submit"  class="btn btn-primary d-flex align-items-center">
    <img src="<?= BASE_URL ?>assets/img/icons/118856_floppy_media_icon.png" alt="Floppy Disk" class="me-2" width="20" height="20">
    Edit Data</button>
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
