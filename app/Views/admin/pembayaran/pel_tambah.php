<div id="successtoast" class="bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1000">
    <div class="toast-header">
        <i class="bx bx-bell me-2"></i>
        <div class="me-auto fw-semibold">Berhasil</div>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        Cicilan nota sudah lunas.
    </div>
</div>
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

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-1">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <a href="<?= BASE_URL ?>pembayaran/pelanggan" class="me-2">
                            <i class="bx bx-chevron-left fs-2"></i>
                            Kembali
                        </a>
                        <h5 class="mb-1">Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <form id="frmCicilan" action="<?= BASE_URL ?>pembayaran/inputCicilan_pelanggan" method="POST">
                            <div class="row row-cols-2">
                                <div class="mb-3">
                                    <label class="form-label" for="barang">No Nota</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="nonota" name="nonota" placeholder="Masukkan Nota" class="form-control" value="<?= old('nonota') ?>" required>
                                        <button type="button" id="search" class="btn btn-primary">Cari</button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="barang">Tanggal Nota</label>
                                    <div class="input-group input-group-merge">
                                        <input id="tgl" type="date" value="<?= date("m/d/Y") ?>" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="barang">Outlet</label>
                                    <div class="input-group input-group-merge">
                                        <input id="pelanggan" type="text" name="pelanggan" class="form-control" value="<?= old('pelanggan') ?>" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="expired">Pembayaran</label>
                                    <div class="input-group input-group-merge">
                                        <input id="metode" type="text" name="metode" class="form-control" value="<?= old('metode') ?>" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="barang">Amount</label>
                                    <div class="input-group input-group-merge">
                                        <input type="number" name="amount" id="cicil" placeholder="Masukkan Nominal" class="form-control" value="<?= old('amount', 0) ?>"  disabled required>
                                        <button type="button" id="select-notaretur" class="btn btn-primary" disabled>Pilih</button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="barang">Keterangan</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" name="keterangan" id="keterangan" class="form-control" value="<?= old('keterangan') ?>" disabled required>
                                    </div>
                                </div>
                                <div hidden>
                                    <div class="mb-3">
                                        <label class="form-label" for="barang">Nota Jual</label>
                                        <div class="input-group input-group-merge">
                                            <input type="number" name="notajual" id="notajual" placeholder="Masukkan Nominal" class="form-control" value="<?= old('notajual') ?>" readonly required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="barang">Nota Retur</label>
                                        <div class="input-group input-group-merge">
                                            <input type="number" name="nonotaretur" id="nonotaretur" placeholder="Masukkan Nominal" class="form-control" readonly required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="barang">Total Cicilan</label>
                                        <div class="input-group input-group-merge">
                                            <input type="number" name="t_cicilan" id="t_cicilan" placeholder="Masukkan Nominal" class="form-control" value="<?= old('t_cicilan') ?>" readonly required>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>

                        <button type="button" id="submit" class="btn btn-primary" disabled>Simpan</button>
                    </div>

                    <div id="list-cicilan" class="col-lg-12 mb-4 order-1 d-none">
                        <div class="card border-expat w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between my-3">
                                    <h5 class="card-title fw-semibold">Daftar Cicilan</h5>
                                </div>
                                <table id="table_list" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nonota</th>
                                            <th>Tanggal Pembayaran</th>
                                            <th>Nominal</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" style="text-align: right;">Total:</td>
                                            <td class="total"></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
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

<!-- Modal Nota Retur -->
<div class="modal fade" id="notaretur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Nota Retur</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table id="nota_retur" class="table table-bordered w-100">
          <thead>
            <tr>
              <th>Nonota</th>
              <th>Nominal</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
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