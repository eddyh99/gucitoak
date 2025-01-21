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
                            <a href="<?= BASE_URL?>barang" class="me-2">
                                <i class="bx bx-chevron-left fs-2"></i>
                                Back
                            </a>
                            <h5 class="mb-1">Edit Barang</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= BASE_URL ?>barang/ubah_barang" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="idbarang" value="<?= $barang->id ?>">
                                
                                    <div class="mb-3">
                                        <label class="form-label" for="foto">Foto Barang</label>
                                        <?php if ($barang->foto): ?>
                                        <img class="img-fluid d-block" src="<?= BASE_URL . 'assets/img/produk/' . $barang->foto ?>" alt="Foto Barang">
                                        <input type="hidden" name="foto_lama" value="<?= $barang->foto ?>">
                                        <?php endif; ?>
                                        <small class="text-danger d-block mb-1">*Kosongi jika tidak ingin mengubah</small>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="file"
                                                class="form-control"
                                                id="foto"
                                                placeholder="Foto Barang"
                                                name="foto"
                                                accept=".jpg,.png,jpeg,.webp"
                                            />
                                        </div>
                                    </div>
                                <div class="row row-cols-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="namabarang">Nama Barang</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="namabarang"
                                                placeholder="Nama Barang"
                                                name="namabarang"
                                                value="<?= $barang->namabarang; ?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="kategori">Kategori</label>
                                        <select class="kategoriselect2" id="kategori" name="kategori" >
                                            <?php foreach($kategori as $key => $kt): ?>
                                                <option value="<?= $kt->id;?>" <?= ($barang->id_kategori == $kt->id) ? "selected" : ""?>><?= $kt->namakategori; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="satuan">Satuan</label>
                                        <select class="satuanselect2" id="satuan" name="satuan" >
                                            <?php foreach($satuan as $key => $st): ?>
                                                <option value="<?= $st->id; ?>" <?= ($barang->id_satuan == $st->id) ? "selected" : ""?>><?= $st->namasatuan; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="stokmin">Stok Min</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="stokmin"
                                                placeholder="Stok Min"
                                                name="stokmin"
                                                value="<?= $barang->stokmin?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="harga1">Harga 1</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control price-input"
                                                id="harga1"
                                                placeholder="Harga 1"
                                                name="harga1"
                                                value="<?= $barang->harga1?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="harga2">Harga 2</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control price-input"
                                                id="harga2"
                                                placeholder="Harga 2"
                                                name="harga2"
                                                value="<?= $barang->harga2?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="harga3">Harga 3</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control price-input"
                                                id="harga3"
                                                placeholder="Harga 3"
                                                name="harga3"
                                                value="<?= $barang->harga3?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="discount_pct">Discount (%)</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control disc-input"
                                                id="discount_pct"
                                                placeholder="Discount (%)"
                                                name="discount_pct"
                                                value="<?= $barang->disc_pct?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="discount_fxd">Discount (Fixed)</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="text"
                                                class="form-control price-input"
                                                id="discount_fxd"
                                                placeholder="Discount (Fixed)"
                                                name="discount_fxd"
                                                value="<?= $barang->disc_fxd?>"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Edit Data</button>
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
