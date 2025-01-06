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
                            <a href="<?= BASE_URL?>retur/pelanggan" class="me-2">
                                <i class="bx bx-chevron-left fs-2"></i>
                                Kembali
                            </a>
                            <h5 class="mb-1">Penjualan</h5>
                        </div>
                            <div class="card-body">
                                <form id="frmjual" action="<?=BASE_URL ?>retur/simpanreturpel" method="POST" >
                                    <div class="row row-cols-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="barang">Tanggal</label>
                                            <div class="input-group input-group-merge">
                                                <input type="text"value="<?=date("d-m-Y")?>" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="expired">Pelanggan</label>
                                            <select id="pelanggan" name="pelanggan" class="form-select" required>
                                                <option></option>
                                                <?php foreach ($pelanggan as $p) : ?>
                                                    <option 
                                                        value="<?= $p->pelanggan_id; ?>"
                                                        data-maxnota="<?= $p->maxnota; ?>"
                                                        data-total-nota-count="<?= $p->total_nota_count; ?>"
                                                        data-plafon="<?= $p->plafon; ?>"
                                                        data-total-nota-value="<?= $p->total_nota_value; ?>"
                                                    >
                                                        <?= $p->namapelanggan ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
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
                                                    autocomplete="off"
                                                />
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
                                                    disabled
                                                />
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
                                                            Bersihkan Nota Retur
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
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <button type="button" id="submit" class="btn btn-primary">Simpan</button>
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
                                autocomplete="off"
                            />
                            
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