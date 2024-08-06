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
                            <a href="<?= BASE_URL?>user" class="me-2">
                                <i class="bx bx-chevron-left fs-2"></i>
                                Back
                            </a>
                            <h5 class="mb-1">Tambah User</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= BASE_URL ?>user/tambah_proccess" method="POST">
                                <div class="mb-3">
                                    <label class="form-label" for="username">Username or Email</label>
                                    <div class="input-group input-group-merge">
                                        <span id="username2" class="input-group-text">
                                            <i class="bx bx-user"></i>
                                        </span>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="username"
                                            placeholder="John_Doe"
                                            name="username"
                                        />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="nama">Nama Lengkap</label>
                                    <div class="input-group input-group-merge">
                                        <span id="nama2" class="input-group-text">
                                            <i class="bx bx-user-pin"></i>
                                        </span>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="nama"
                                            placeholder="Jhon Doe Supratman "
                                            name="nama"
                                        />
                                    </div>
                                </div>
                                <div class="mb-3 form-password-toggle">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="password">Password</label>
                                    </div>
                                    <div class="input-group input-group-merge">
                                        <span id="username2" class="input-group-text">
                                            <i class="bx bx-lock-alt"></i>
                                        </span>
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
                                    <label for="role" class="form-label">Select Role</label>
                                    <select class="form-select" name="role" id="role" aria-label="Default select Role">
                                        <option value="admin">Admin</option>
                                        <option value="kasir">Kasir</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Save User</button>
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
