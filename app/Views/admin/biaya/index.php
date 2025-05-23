<?php
if(!empty(session('failed'))): ?>
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

<?php if(!empty($_SESSION['success'])): ?>
    <div id="successtoast" class="bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1000">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Berhasil</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?= session('success')?>
        </div>
    </div>
<?php endif;?>
 <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-12 order-0">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12 mb-2">
                            <div class="card">
                                <div class="card-body">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                                    <img src="<?= BASE_URL ?>assets/img/icons/plus.png" alt="add" class="me-2" width="20" height="20"> Input Biaya
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-4 order-1">
                    <div class="card w-100">
                        <div class="card-body">

                        <div class="row form-group">
                				<label class="col-form-label col-sm-1">Bulan</label>
                				<div class="col-sm-2">
                				    <select name="bulan" id="bulan" class="form-control">
                				        <option value="1" <?php echo (date("m")==1) ? "selected":"" ?> >Januari</option>
                				        <option value="2" <?php echo (date("m")==2) ? "selected":"" ?> >Februari</option>
                				        <option value="3" <?php echo (date("m")==3) ? "selected":"" ?> >Maret</option>
                				        <option value="4" <?php echo (date("m")==4) ? "selected":"" ?> >April</option>
                				        <option value="5" <?php echo (date("m")==5) ? "selected":"" ?> >Mei</option>
                				        <option value="6" <?php echo (date("m")==6) ? "selected":"" ?> >Juni</option>
                				        <option value="7" <?php echo (date("m")==7) ? "selected":"" ?> >Juli</option>
                				        <option value="8" <?php echo (date("m")==8) ? "selected":"" ?> >Agustus</option>
                				        <option value="9" <?php echo (date("m")==9) ? "selected":"" ?> >September</option>
                				        <option value="10" <?php echo (date("m")==10) ? "selected":"" ?> >Oktober</option>
                				        <option value="11" <?php echo (date("m")==11) ? "selected":"" ?> >November</option>
                				        <option value="12" <?php echo (date("m")==12) ? "selected":"" ?> >Desember</option>
                				    </select>
                				</div>
                				<div class="col-sm-1">
                				    <input type="text" name="tahun" id="tahun" class="form-control" value="<?=date("Y")?>">
                				</div>
                                <div class="col-2">
                                    <button class="btn btn-primary" id="lihat">Lihat</button>
                                </div>
                            </div>

                            <h5 class="card-title fw-semibold mb-4 mt-3">Daftar Biaya</h5>
                            <table id="table_list" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Deskripsi</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
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

<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="stokModalLabel">Catat Biaya</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASE_URL ?>biaya/simpan" method="POST">
            <div class="modal-body py-1">
            <div class="mt-2">
                <label for="tanggal">Pilih Tanggal:</label>
                    <div class="input-group input-group-merge">
                        <input
                            type="date"
                            class="form-control"
                            placeholder="Tanggal"
                            name="tanggal"
                            autocomplete="off"
                            value="<?= date('Y-m-d') ?>"/>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="input-group input-group-merge">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Deskripsi"
                            name="deskripsi"
                            autocomplete="off"
                            value="<?= old('deskripsi') ?>"/>

                    </div>
                </div>
                <div class="mt-2">
                    <div class="input-group input-group-merge">
                        <input
                            type="number"
                            class="form-control"
                            placeholder="Nominal"
                            name="nominal"
                            autocomplete="off"
                            value="<?= old('nominal') ?>"/>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="batalstok" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" id="simpanpreviewstok" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
