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


<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <a href="index.html" class="app-brand-link gap-2">
                            <img class="img-fluid" src="<?= BASE_URL ?>assets/img/logo.png" alt="foodys Logo" data-aos="flip-up"  data-aos-duration="3000">
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-2">Welcome to Guci Toak! 👋</h4>
                    <p class="mb-4">Please sign-in to your account and start the Point of Sales Web Application</p>
                    <form id="formAuthentication" class="mb-3" action="<?= BASE_URL ?>auth/signin_proccess" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Username or Email</label>
                            <input
                                type="text"
                                class="form-control"
                                id="username"
                                name="username"
                                placeholder="Enter your username or email"
                                autofocus
                                value="<?= old('username') ?>"
                            />
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
                        <div class="my-5">
                            <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>