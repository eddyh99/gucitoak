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
                            <a href="<?= BASE_URL?>user" class="me-2">
                                <i class="bx bx-chevron-left fs-2"></i>
                                Back
                            </a>
                            <h5 class="mb-1">Tambah Pengguna</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= BASE_URL ?>user/tambah_proccess" method="POST">
                                <div class="row row-cols-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="username">Username atau Email</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="username"
                                                placeholder="Username atau Email"
                                                name="username"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3 form-password-toggle">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="password"
                                                id="password"
                                                class="form-control"
                                                name="password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password"
                                                value="<?= old('password') ?>"
                                            />
                                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Pilih Role</label>
                                        <select class="form-select" name="role" id="role" aria-label="Default select Role">
                                            <option value="superadmin">Superadmin</option>
                                            <option value="admin">Admin</option>
                                            <option value="sales">Sales</option>
                                        </select>
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
                                                value="<?= set_value('gapok') ?>"
                                                required />
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
                                                value="<?= set_value('komisi') ?>"
                                                required />
                                        </div>
                                    </div>
                                </div>
                                <button type="submit"  class="btn btn-primary d-flex align-items-center">
    <img src="<?= BASE_URL ?>assets/img/icons/118856_floppy_media_icon.png" alt="Floppy Disk" class="me-2" width="20" height="20">
    Simpan Data</button>
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
