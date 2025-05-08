<!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 order-0">
                    <div id="map" style="height: 400px; width: 100%; margin-bottom: 20px;display:none;"></div>
                </div>
                <div class="col-lg-12 mb-4 order-1">
                    <div class="card border-expat w-100">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">Location</h5>
                            <div class="row mb-4">
                                <label class="fw-bold col-1">Sales</label>
                                <div class="col-3">
                                <select name="barang" id="sales" class="form-select form-select">
                                    <?php foreach ($sales as $s) : ?>
                                        <option value="<?= $s->id ?>"><?= $s->namasales ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" name="tgl" id="tgl" value="<?=date("Y-m-d")?>" />
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-primary" id="lihat">Lihat</button>
                                    <button class="btn px-1" id="save"><img src="<?= BASE_URL ?>assets/img/icons/118856_floppy_media_icon.png" alt="Home Icon" width="30" height="30"></button>
                                    <button class="btn px-0" id="del"><img src="<?= BASE_URL ?>assets/img/icons/118794_process_stop_icon.png" alt="Home Icon" width="30" height="30"></button>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                    </tr>
                                </thead>
                                <tbody id="location-table-body">
                                </tbody>
                            </table>
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