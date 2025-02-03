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
                            <a href="<?= BASE_URL?>pelanggan" class="me-2">
                                <i class="bx bx-chevron-left fs-2"></i>
                                Back
                            </a>
                            <h5 class="mb-1">Tambah Pelanggan</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= BASE_URL ?>pelanggan/tambah_proccess" method="POST">
                                <div class="row row-cols-3">

                                    <div class="mb-3">
                                        <label class="form-label" for="pelanggan">Nama Toko</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="pelanggan"
                                                placeholder="Nama Toko"
                                                name="pelanggan"
                                                required
                                                value="<?= set_value('pelanggan') ?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="pemilik">Pemilik</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="pemilik"
                                                placeholder="Pemilik"
                                                name="pemilik"
                                                required
                                                value="<?= set_value('pemilik') ?>"
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
                                                required
                                                value="<?= set_value('alamat') ?>"
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
                                                required
                                                value="<?= set_value('kota') ?>"
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
                                                placeholder="Telphone"
                                                name="telp"
                                                maxlength="13"
                                                required
                                                value="<?= set_value('telp') ?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="plafon">Gmaps</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="gmaps"
                                                placeholder="Link gmaps"
                                                name="gmaps"
                                                value="<?= set_value('gmaps') ?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="harga">Jenis Harga</label>
                                        <select name="harga" class="form-select" id="harga">
                                            <option value="Harga 1" selected>Harga 1</option>
                                            <option value="Harga 2">Harga 2</option>
                                            <option value="Harga 3">Harga 3</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="plafon">Plafon</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control price-input"
                                                id="plafon"
                                                placeholder="Plafon"
                                                name="plafon"
                                                value="<?= set_value('plafon') ?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="plafon">Max Invoice</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control price-input"
                                                id="maxnota"
                                                placeholder="Max Invoice"
                                                name="maxnota"
                                                value="<?= set_value('maxnota') ?>"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
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
