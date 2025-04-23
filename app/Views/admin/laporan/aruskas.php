<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-1">
                <div class="card w-100">
                    <div class="card-body">

                        <div class="row form-group">
                            <label class="col-form-label col-sm-1">Bulan</label>
                            <div class="col-sm-2">
                                <select name="bulan" id="bulan" class="form-control">
                                    <option value="1" <?php echo (date("m") == 1) ? "selected" : "" ?>>Januari</option>
                                    <option value="2" <?php echo (date("m") == 2) ? "selected" : "" ?>>Februari</option>
                                    <option value="3" <?php echo (date("m") == 3) ? "selected" : "" ?>>Maret</option>
                                    <option value="4" <?php echo (date("m") == 4) ? "selected" : "" ?>>April</option>
                                    <option value="5" <?php echo (date("m") == 5) ? "selected" : "" ?>>Mei</option>
                                    <option value="6" <?php echo (date("m") == 6) ? "selected" : "" ?>>Juni</option>
                                    <option value="7" <?php echo (date("m") == 7) ? "selected" : "" ?>>Juli</option>
                                    <option value="8" <?php echo (date("m") == 8) ? "selected" : "" ?>>Agustus</option>
                                    <option value="9" <?php echo (date("m") == 9) ? "selected" : "" ?>>September</option>
                                    <option value="10" <?php echo (date("m") == 10) ? "selected" : "" ?>>Oktober</option>
                                    <option value="11" <?php echo (date("m") == 11) ? "selected" : "" ?>>November</option>
                                    <option value="12" <?php echo (date("m") == 12) ? "selected" : "" ?>>Desember</option>
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <input type="text" name="tahun" id="tahun" class="form-control" value="<?= date("Y") ?>">
                            </div>
                            <div class="col-2">
                                <button class="btn btn-primary" id="lihat">Lihat</button>
                            </div>
                        </div>


                        <div class="card mt-4 shadow-sm border-0">
                            <div class="card-body bg-white rounded-3">
                                <h5 class="card-title text-primary mb-4 fw-semibold">Resume</h5>

                                <div class="mb-4 pb-2 border-bottom">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-muted mb-1">Total Penjualan (Uang Masuk)</p>
                                            <h4 id="notajual" class="fw-bold text-success mb-0"></h4>
                                        </div>
                                        <i class="fas fa-receipt text-primary fs-4"></i>
                                    </div>
                                </div>

                                <div class="mb-4 pb-2 border-bottom">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-muted mb-1">Total Pembelian (Uang Keluar)</p>
                                            <h4 id="notabeli" class="fw-bold text-danger mb-0"></h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 pb-2 border-bottom">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-muted mb-1">Biaya Gaji</p>
                                            <h4 id="totalgaji" class="fw-bold text-danger mb-0"></h4>
                                        </div>
                                        <button class="btn btn-sm btn-outline-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#detailgaji">
                                            <i class="fas fa-info-circle me-1"></i> Detail
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-muted mb-1">Biaya Lain-lain</p>
                                            <h4 id="totalbiaya" class="fw-bold text-danger mb-0"></h4>
                                        </div>
                                        <button class="btn btn-sm btn-outline-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#detailbiaya">
                                            <i class="fas fa-info-circle me-1"></i> Detail
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-light border-0 rounded-bottom-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Laba / Rugi</span>
                                    <span id="labarugi" class="fw-bold fs-5"></span>
                                </div>
                            </div>
                        </div>

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


<!-- modal gaji -->
<div class="modal fade" id="detailgaji" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gaji</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="modalgaji" class="table table-striped w-100">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Gaji Pokok</th>
                            <th>Uang Harian</th>
                            <th>Insentif</th>
                            <th>Komisi</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
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

<!-- modal gaji -->
<div class="modal fade" id="detailbiaya" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Biaya lain-lain</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="modalbiaya" class="table table-striped w-100">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
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