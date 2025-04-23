
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
                        <a href="<?= BASE_URL ?>penggajian" class="me-2">
                            <i class="bx bx-chevron-left fs-2"></i>
                            Kembali
                        </a>
                        <h5 class="mb-1">Gaji <?= $_GET['user'] ?></h5>
                    </div>
                    <div class="card-body">
                        <form id="frmGaji" action="<?= BASE_URL ?>penggajian/input_gaji/<?= $_GET['user'] ?>" method="POST">
                            <div class="row row-cols-2">
                                <input type="hidden" name="user_type" value="<?= $_GET['user'] ?>">
                                <div class="mb-3">
                                    <label class="form-label" for="expired"><?= $_GET['user'] ?></label>
                                    <div class="input-group input-group-merge">
                                        <select name="sales" id="sales" class="form-select" onchange="handleChange()" required>
                                            <option></option>
                                            <?php foreach ($user as $dt) { ?>
                                                <option value="<?= $dt->id ?>"><?= $dt->namasales ?? $dt->username ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="barang">Bulan</label>
                                    <div class="input-group input-group-merge">
                                        <input id="bulan" name="bulan" type="text" value="<?= date("Y-m") ?>" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="barang">Gaji Pokok</label>
                                    <div class="input-group input-group-merge">
                                        <input id="gajipokok" type="number" name="gajipokok" class="form-control" value="<?= old('gajipokok') ?>" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="expired">Uang Harian</label>
                                    <div class="input-group input-group-merge">
                                        <input id="uangharian" type="text" name="uangharian" class="form-control" value="<?= old('uangharian', 0) ?>">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="barang">Insentif</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" name="insentif" id="insentif" insentif="Masukkan Nominal" class="form-control" value="<?= old('insentif', 0) ?>">
                                    </div>
                                </div>
                                <div class="mb-3 <?= $_GET['user'] == 'admin' ? 'invisible' : '' ?>">
                                    <label class="form-label" for="barang">Komisi</label>
                                    <div class="input-group input-group-merge">
                                        <input type="number" name="komisi" id="komisi" class="form-control" value="<?= old('komisi') ?>" readonly <?= $_GET['user'] == 'admin' ? 'disabled' : '' ?>>
                                    </div>
                                </div>
                                <div class="mb-3" hidden>
                                    <label class="form-label" for="barang">Detail Nota</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" name="detailnota" id="detailnota" class="form-control" value="<?= old('detailnota',) ?>" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold fs-6" for="barang">Total Gaji : <span id="totalgaji">0.00</span></label>
                                </div>

                            </div>
                        </form>

                        <button type="button" id="submit" class="btn btn-primary d-flex align-items-center">
    <img src="<?= BASE_URL ?>assets/img/icons/118856_floppy_media_icon.png" alt="Floppy Disk" class="me-2" width="20" height="20">
    Simpan</button>
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
