 <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-4 order-1">
                    <div class="card w-100">
                        <div class="card-body">
                            <!-- <div class="row form-group">
                				<label class="col-form-label col-sm-1">Kategori</label>
                				<div class="col-sm-2">
                				    <select name="kategori" id="kategori" class="form-control">
                                      
                				    </select>
                				</div>
                                <div class="col-2">
                                    <button class="btn btn-primary" id="lihat">Lihat</button>
                                </div>
                            </div> -->
                            <h5 class="card-title fw-semibold mb-4 mt-3">Barang Expired</h5>
                            <div id="chart"></div>
                            <table id="table_list" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Barcode</th>
                                        <th>Exp.Date</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <!-- <tfoot class="total-row">
                                    <td colspan="4" class="text-end fw-bold">Total</td>
                                    <td id="total_amount" class="fw-bold"></td>
                                    <td></td>
                                </tfoot> -->
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
