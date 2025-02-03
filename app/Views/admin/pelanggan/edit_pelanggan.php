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
                            <a href="<?= BASE_URL?>pelanggan" class="me-2">
                                <i class="bx bx-chevron-left fs-2"></i>
                                Back
                            </a>
                            <h5 class="mb-1">Edit Pelanggan</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= BASE_URL ?>pelanggan/ubah_pelanggan" method="POST">
                                <input type="hidden" name="idpelanggan" value="<?=$pelanggan->id?>">
                                <div class="row row-cols-3">

                                    <div class="mb-3">
                                        <label class="form-label" for="pelanggan">Nama Toko</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="pelanggan"
                                                placeholder="Nama toko"
                                                name="pelanggan"
                                                value="<?= $pelanggan->namapelanggan?>"
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
                                                value="<?=$pelanggan->pemilik?>"
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
                                                value="<?=$pelanggan->alamat?>"
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
                                                value="<?=$pelanggan->kota?>"
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
                                                value="<?=$pelanggan->telp?>"
                                                maxlength="13"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="telp">Gmaps</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="gmaps"
                                                placeholder="Link gmaps"
                                                name="gmaps"
                                                value="<?=$pelanggan->gmaps?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="harga">Jenis Harga</label>
                                        <select name="harga" class="form-select" id="harga">
                                            <option value="Harga 1" <?= ($pelanggan->harga == "Harga 1") ? "selected": ""?>>Harga 1</option>
                                            <option value="Harga 2" <?= ($pelanggan->harga == "Harga 2") ? "selected": ""?>>Harga 2</option>
                                            <option value="Harga 3" <?= ($pelanggan->harga == "Harga 3") ? "selected": ""?>>Harga 3</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="plafon">Plafon</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="number"
                                                class="form-control"
                                                id="plafon"
                                                placeholder="Plafon"
                                                name="plafon"
                                                value="<?=$pelanggan->plafon?>"
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
                                                value="<?=$pelanggan->maxnota?>"
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
