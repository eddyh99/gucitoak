 <!-- Content wrapper -->
 <div class="content-wrapper">
     <!-- Content -->
     <div class="container-xxl flex-grow-1 container-p-y">
         <div class="row">
             <div class="col-lg-12 mb-4 order-1">
                 <div class="card w-100">
                     <div class="card-body">
                         <h5 class="card-title fw-semibold mb-4 mt-3">Hutang Outket</h5>
                         <div id="chart"></div>
                         <table id="table_list" class="table table-striped" style="width:100%">
                             <thead>
                                 <tr>
                                     <th>Nonota</th>
                                     <th>Otlet</th>
                                     <th>Tanggal</th>
                                     <th>Sisa Cicilan</th>
                                     <th>Aksi</th>
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

 <div class="modal fade" id="detailcicilan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Detail Cicilan</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <table class="table table-bordered">
                     <thead>
                         <tr>
                             <th>Nominal</th>
                             <th>Tanggal</th>
                             <th>Keterangan</th>
                         </tr>
                     </thead>
                     <tbody id="modalDataBody">
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