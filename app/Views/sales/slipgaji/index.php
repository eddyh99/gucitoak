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
                <div class="col-lg-12 mb-4 order-1">
                    <div class="card w-100">
                        <div class="card-body">
                        <div class="row form-group">
                				<label class="col-form-label col-sm-1">Tahun</label>

                				<div class="col-sm-1">
                				    <input type="text" name="tahun" id="tahun" class="form-control" value="<?=date("Y")?>">
                				</div>
                                <div class="col-2">
                                    <button class="btn btn-primary" id="lihat">Lihat</button>
                                </div>
                            </div>
                            <h5 class="card-title fw-semibold mb-4 mt-3">Gaji Saya</h5>
                            <table id="table_list" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Bulan</th>
                                        <th>Gaji Pokok</th>
                                        <th>Uang Harian</th>
                                        <th>Insentif</th>
                                        <th>Komisi</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
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

        <!-- Modal -->
        <div class="modal fade" id="detailInvoice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Daftar Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                <thead>
                    <tr>
                    <th>Nota</th>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                    <th>Komisi</th>
                    </tr>
                </thead>
                <tbody id="modalDataBody">
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

