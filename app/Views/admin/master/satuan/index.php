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

<?php if(!empty(session('success'))): ?>
    <div id="successtoast" class="bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1000">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold"><?= session('success')?></div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
<?php endif;?>
 
 <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-2 col-md-2 order-0">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12 mb-2">
                            <div class="card">
                                <div class="card-body d-flex justify-content-center">
                                    <a href="<?= BASE_URL?>satuan/tambah_satuan" class="btn btn-primary d-flex align-items-center">
                                        <i class="tf-icons bx bx-plus"></i> Satuan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="<?= BASE_URL?>assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded"/>
                                        </div>
                                        <div class="dropdown">
                                            <button
                                                class="btn p-0"
                                                type="button"
                                                id="cardOpt3"
                                                data-bs-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            >
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Profit</span>
                                    <h5 class="card-title mb-2">Rp 132.628.234</h5>
                                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12 mb-2">
                        <div class="card">
                            <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="<?= BASE_URL?>assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded"/>
                                </div>
                                <div class="dropdown">
                                    <button
                                        class="btn p-0"
                                        type="button"
                                        id="cardOpt6"
                                        data-bs-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                    >
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                    </div>
                                </div>
                            </div>
                            <span>Sales</span>
                            <h3 class="card-title text-nowrap mb-1">$4,679</h3>
                            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 mb-4 order-1">
                    <div class="card border-expat w-100">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">List Satuan</h5>
                            <table id="table_list_satuan" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Satuan</th>
                                        <th>Action</th>
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
