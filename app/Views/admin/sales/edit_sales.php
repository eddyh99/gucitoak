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
                            <form action="<?= BASE_URL ?>sales/ubah_sales" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="idsales" value="<?=$sales->id?>">
                                <?php if ($sales->avatar): ?>
                                    <img class="img-preview img-fluid col-sm-5 d-block mb-3 mx-auto" src="<?= BASE_URL . 'assets/img/avatars/' . $sales->avatar ?>">
                                    <input type="hidden" name="avatar_lama" value="<?= $sales->avatar ?>">
                                <?php else: ?>
                                    <img class="img-preview img-fluid col-sm-5 d-block mx-auto">
                                <?php endif; ?>
                                <div class="row row-cols-3">
                                <div class="mb-3">
                                        <label class="form-label" for="avatar">Foto sales</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                            type="file"
                                            class="form-control"
                                            id="avatar"
                                            placeholder="Foto Barang"
                                            name="avatar"
                                            accept=".jpg,.png,jpeg,.webp"
                                            onchange="previewImage()"
                                            />
                                        </div>
                                        <small class="text-danger d-block mt-1">*Kosongi jika tidak ingin mengubah</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="sales">Nama Sales</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                required
                                                class="form-control"
                                                id="sales"
                                                placeholder="Nama Sales"
                                                name="sales"
                                                value="<?=$sales->namasales?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="alamat">Alamat</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                required
                                                class="form-control"
                                                id="alamat"
                                                placeholder="Alamat"
                                                name="alamat"
                                                value="<?=$sales->alamat?>"
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
                                                required
                                                id="kota"
                                                class="form-control"
                                                name="kota"
                                                placeholder="Kota"
                                                value="<?=$sales->kota?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="telp">telp</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                required
                                                class="form-control"
                                                id="telp"
                                                placeholder="Telphone"
                                                name="telp"
                                                value="<?=$sales->telp?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="omzet">Omzet</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                required
                                                class="form-control price-input"
                                                id="omzet"
                                                placeholder="Omzet"
                                                name="omzet"
                                                value="<?=$sales->omzet?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="omzet">Gaji Pokok</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control price-input"
                                                id="gapok"
                                                placeholder="Gaji Pokok"
                                                name="gapok"
                                                value="<?=$sales->gajipokok?>"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="omzet">Komisi (%)</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control price-input"
                                                id="komisi"
                                                placeholder="Komisi"
                                                name="komisi"
                                                value="<?=$sales->komisi*100?>"
                                                required
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
