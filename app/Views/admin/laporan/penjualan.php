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
                				<label class="col-form-label col-sm-1">Bulan</label>
                				<div class="col-sm-2">
                				    <select name="bulan" id="bulan" class="form-control">
                				        <option value="1" <?php echo (date("m")==1) ? "selected":"" ?> >Januari</option>
                				        <option value="2" <?php echo (date("m")==2) ? "selected":"" ?> >Februari</option>
                				        <option value="3" <?php echo (date("m")==3) ? "selected":"" ?> >Maret</option>
                				        <option value="4" <?php echo (date("m")==4) ? "selected":"" ?> >April</option>
                				        <option value="5" <?php echo (date("m")==5) ? "selected":"" ?> >Mei</option>
                				        <option value="6" <?php echo (date("m")==6) ? "selected":"" ?> >Juni</option>
                				        <option value="7" <?php echo (date("m")==7) ? "selected":"" ?> >Juli</option>
                				        <option value="8" <?php echo (date("m")==8) ? "selected":"" ?> >Agustus</option>
                				        <option value="9" <?php echo (date("m")==9) ? "selected":"" ?> >September</option>
                				        <option value="10" <?php echo (date("m")==10) ? "selected":"" ?> >Oktober</option>
                				        <option value="11" <?php echo (date("m")==11) ? "selected":"" ?> >November</option>
                				        <option value="12" <?php echo (date("m")==12) ? "selected":"" ?> >Desember</option>
                				    </select>
                				</div>
                				<div class="col-sm-1">
                				    <input type="text" name="tahun" id="tahun" class="form-control" value="<?=date("Y")?>">
                				</div>
                                <div class="col-sm-2">
                				    <select name="sales" id="sales" class="form-control">
                              <option value="">Semua Sales</option>
                                        <?php foreach ($sales as $s) : ?>
                                            <option value="<?= $s->id ?>"><?= $s->namasales ?></option>
                                        <?php endforeach; ?>
                				    </select>
                				</div>
                                <div class="col-2">
                                    <button class="btn btn-primary" id="lihat">Lihat</button>
                                </div>
                            </div>
                            <h5 class="card-title fw-semibold mb-4 mt-3">Mutasi Penjualan</h5>
                            <table id="table_list" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No. Nota</th>
                                        <th>Outlet</th>
                                        <th>Tanggal</th>
                                        <th>Sales</th>
                                        <th>Nominal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot class="total-row">
                                    <td colspan="4" class="text-end fw-bold">Total</td>
                                    <td id="total_amount" class="fw-bold"></td>
                                    <td></td>
                                </tfoot>
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


<!-- Modal -->
<div class="modal fade" id="detailbarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Penjualan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Nama Barang</th>
              <th>Jumlah</th>
              <th>Harga</th>
              <!-- <th>Diskon</th>
              <th>PPN</th> -->
              <th>Total</th>
            </tr>
          </thead>
          <tbody id="modalDataBody">
            <!-- Data will be inserted here -->
          </tbody>
          <tfoot>
            <tr>
                <td class="text-end" colspan="3">PPN:</td>
                <td id="ppn"></td>
            </tr>
            <tr>
                <td class="text-end" colspan="3">Diskon:</td>
                <td id="diskon"></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><img src="<?= BASE_URL ?>assets/img/icons/118788_media_playback_stop_icon.png" alt="Home Icon" width="20" height="20">Close</button>
      </div>
    </div>
  </div>
</div>
