<?php if (!empty(session('failed'))): ?>
    <div id="failedtoast" class="bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1000">
        <div class="toast-header">
            <i class="bx bx-x me-2"></i>
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
                    <div class="card-header d-flex justify-content-end align-items-center">
                        <h5 class="mb-1">Hak Akses Pengguna</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= BASE_URL ?>hakakses/give_akses" method="POST">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="sales">Nama Pengguna</label>
                                        <select class="userselect2" id="user" name="user" data-user=<?= base64_encode(json_encode($users)) ?> onchange="handleChange()">
                                            <?php foreach($users as $user){?>
                                                <option value="<?= $user->id ?>"><?= $user->username?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 fw-bold">
                                    DAFTAR MENU :
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="setup">Setup Data</label>
                                        <select class="setupselect2 form-control" multiple="multiple" id="setup" name="setup[]">
                                            <?php foreach($submenu_setup as $setup){?>
                                                <option value="<?= $setup ?>"><?= str_replace('_', ' ', $setup)?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="setup">Persediaan</label>
                                        <select class="setupselect2 form-control" multiple="multiple" id="persediaan" name="persediaan[]">
                                            <?php foreach($submenu_persediaan as $persediaan){?>
                                                <option value="<?= $persediaan ?>"><?= str_replace('_', ' ', $persediaan)?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="setup">Transaksi</label>
                                        <select class="transaksiselect2 form-control" multiple="multiple" id="transaksi" name="transaksi[]">
                                            <?php foreach($submenu_transaksi as $transaksi){?>
                                                <option value="<?= $transaksi ?>"><?= str_replace('_', ' ', $transaksi)?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="setup">Laporan</label>
                                        <select class="setupselect2 form-control" multiple="multiple" id="laporan" name="laporan[]">
                                            <?php foreach($submenu_laporan as $laporan){?>
                                                <option value="<?= $laporan ?>"><?= str_replace('_', ' ', $laporan)?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
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