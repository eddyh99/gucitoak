<?php if (!empty(session('failed'))): ?>
    <div id="failedtoast" class="bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1000">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Error</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?= session('failed') ?>
        </div>
    </div>
<?php endif; ?>

<?php if(!empty(session('success'))): ?>
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
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <a href="<?= BASE_URL ?>stok" class="me-2">
                            <i class="bx bx-chevron-left fs-2"></i>
                            Kembali
                        </a>
                        <h5 class="mb-1">Pembelian</h5>
                    </div>
                    <div class="card-body">
                        <form id="frmjual" action="<?= BASE_URL ?>pembelian/simpanpembelian" method="POST">
                            <div class="row row-cols-2">
                                <div class="mb-3">
                                    <label class="form-label" for="barang">No Nota Suplier</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" name="nonota" placeholder="09/XII/2024" class="form-control" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="barang">Tanggal Nota</label>
                                    <div class="input-group input-group-merge">
                                        <input type="date" value="<?= date("m/d/Y") ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="expired">Suplier</label>
                                    <div class="input-group input-group-merge">
                                        <select name="suplier" id="suplier" class="form-select" required>
                                            <option></option>
                                            <?php foreach ($suplier as $dt) { ?>
                                                <option value="<?= $dt->id ?>"><?= $dt->namasuplier ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="expired">Pembayaran</label>
                                    <div class="input-group input-group-merge col-2">
                                        <select name="pembayaran" id="pembayaran" class="form-select" required>
                                            <option value="tempo">Tempo</option>
                                            <option value="cash">Cash</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3" id="tempo">
                                    <label class="form-label" for="expired">Lama</label>
                                    <div class="input-group input-group-merge">
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="lama"
                                            placeholder="30"
                                            name="lama" />
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label" for="barcode">Barcode</label>
                                    <div class="input-group input-group-merge">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="barcode"
                                            placeholder="Barcode"
                                            name="barcode"
                                            value="<?= old('barcodex') ?>"
                                            autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cols-2">
                                <div class="mb-3">
                                    <label class="form-label" for="barang">Barang</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" name="barang" id="barang" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="expired">Expired Date</label>
                                    <div class="input-group input-group-merge">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="expired"
                                            placeholder="12-11-24"
                                            name="expired"
                                            disabled />
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-12 mb-4 order-1">
                                <div class="card border-expat w-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between my-3">
                                            <h5 class="card-title fw-semibold">Preview Barang</h5>
                                            <button type="button" id="clearallstok" class="btn btn-danger d-flex align-items-center">
                                                <i class='bx bx-trash me-1'></i>
                                                <span>
                                                    Bersihkan Pembelian
                                                </span>
                                            </button>
                                        </div>
                                        <table id="preview_stok" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Barcode</th>
                                                    <th>Expired Date</th>
                                                    <th>Barang</th>
                                                    <th>Jumlah</th>
                                                    <th>Harga</th>
                                                    <th>Total</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5" style="text-align: right;">Subtotal:</td>
                                                    <td id="subtotal" class="subtotal"></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" style="text-align: right;">Diskon:</td>
                                                    <td><input type="number" id="diskon" name="diskon" class="form-control form-control-sm" placeholder="-" min="0" style="width: 145px;"></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" style="text-align: right;">PPN (%):</td>
                                                    <td>
                                                        <div class="d-flex gap-1">
                                                            <input type="number" id="ppn" name="ppn" class="form-control form-control-sm" placeholder="0%" min="0" max="100" style="width: 70px;">
                                                            <input type="number" id="hasil_ppn" class="form-control form-control-sm" placeholder="-" min="0" style="width: 70px;" readonly>
                                                        </div>
                                                    </td>
                                                    <td>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="5" style="text-align: right; font-weight: bold;">Total:</td>
                                                    <td>
                                                        <input type="number" id="total" class="form-control form-control-sm" placeholder="-" min="0" style="width: 145px;" readonly>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <button type="button" id="submit" class="btn btn-primary d-flex align-items-center">
                            <img src="<?= BASE_URL ?>assets/img/icons/118856_floppy_media_icon.png" alt="Floppy Disk" class="me-2" width="20" height="20">
                            Simpan</button>
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


<!-- Modal Stok -->
<div class="modal fade show" id="stokModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="stokModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="stokModalLabel">Masukkan Jumlah</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="preview-expdate"></h4>
                <div class="mt-3">
                    <div class="input-group input-group-merge">
                        <input
                            type="text"
                            class="form-control"
                            id="stok"
                            placeholder="Jumlah"
                            name="stok"
                            autocomplete="off" />

                    </div>
                </div>
                <div class="mt-2">
                    <div class="input-group input-group-merge">
                        <input
                            type="number"
                            class="form-control"
                            id="harga"
                            placeholder="Harga"
                            name="harga"
                            autocomplete="off" />

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="batalstok" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" id="simpanpreviewstok" class="btn btn-primary">Simpan Preview</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade show" id="newbarcode" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="stokModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="stokModalLabel">Create new barcode</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASE_URL ?>stok/savestok" method="POST">
            <div class="modal-body py-1">
                <div class="mt-1">
                    <div class="input-group input-group-merge">
                        <select class="form-control" id="listbarang" name="id_barang">
                            <option value="" readonly>--Pilih Barang--</option>
                        </select>

                    </div>
                </div>
                <div class="mt-2">
                    <div class="input-group input-group-merge">
                        <input
                            type="text"
                            class="form-control"
                            id="newbarcodex"
                            placeholder="Barcode"
                            name="barcodex"
                            autocomplete="off" readonly/>

                    </div>
                </div>
                <div class="mt-2">
                    <div class="input-group input-group-merge">
                        <input
                            type="number"
                            class="form-control"
                            id="stok"
                            placeholder="Stok"
                            name="stok"
                            autocomplete="off" />

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