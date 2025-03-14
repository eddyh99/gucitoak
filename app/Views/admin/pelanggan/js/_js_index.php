<!-- Button Export Datatables -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<style>

.excel-green {
        background-color: #28a745 !important; /* Excel green */
        border-color: #218838 !important; /* Slightly darker green for border */
        color: white !important;
    }

.pdf-red {
    background-color: #dc3545 !important; /* PDF red */
    border-color: #bd2130 !important; /* Slightly darker red for border */
    color: white !important;
}
</style>

<script>
      $(function() {
            setTimeout(() => {
                  $("#failedtoast").toast('show')
                  $("#successtoast").toast('show')
            }, 0)
      });
      let cols = [{
                  data: 'namapelanggan'
            },
            {
                  data: 'pemilik'
            },
            {
                  data: 'alamat'
            },
            {
                  data: 'telp'
            },
            {
                  data: null,
                  "mRender": function(data, type, full, meta) {
                        let gmaps = '-';
                        if (full.latitude && full.longitude) {
                              gmaps = `<a href="https://www.google.com/maps/place/${full.latitude},${full.longitude}" target="_blank">
                                                <i class="bx bx-link-external bx-md fs-5 text-primary"></i>
                                          </a>`;
                        }
                        return gmaps;
                  }
            }
      ]

      if (role == 'admin') {
            cols.push({
                  data: 'harga'
            }, {
                  data: "plafon",
                  "mRender": function(data, type, full, meta) {
                        if (type === 'display') {
                              return parseFloat(data).toLocaleString('en-US', {
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 0
                              });
                        }
                        return data;
                  }
            }, {
                  data: 'maxnota'
            }, {
                  data: null,
                  "mRender": function(data, type, full, meta) {
                        var edit = `<a href="<?= BASE_URL ?>pelanggan/edit_pelanggan/${encodeURI(btoa(full.id))}">
                                                <img src="<?= BASE_URL ?>assets/img/icons/pencil.png" alt="Home Icon" width="30" height="30">
                                          </a>`;
                        var del = `<a href="<?= BASE_URL ?>pelanggan/hapus_pelanggan/${encodeURI(btoa(full.id))}" class="del-data">
                                                <img src="<?= BASE_URL ?>assets/img/icons/118794_process_stop_icon.png" alt="Home Icon" width="20" height="20">
                                          </a>`;
                        return `${edit} ${del}`;
                  }
            })
      }

      $('#table_list').DataTable({
            "scrollX": true,
            "dom": 'lBfrtip',
            "buttons": [{
                        extend: 'pdf',
                        className: 'pdf-red',
                        text: '<img src="<?= BASE_URL ?>assets/img/icons/118861_printer_icon.png" alt="add" class="me-2" width="20" height="20"> PDF',
                        exportOptions: {
                              columns: "th:not(:last-child)" //remove last column in pdf
                        }
                  },
                   {
                    extend: 'excelHtml5',
                   text: '<img src="<?= BASE_URL ?>assets/img/icons/118918_edit_copy_icon.png" alt="add" class="me-2" width="20" height="20"> Excel',
                    className: 'excel-green', // Apply custom green style
                  },
            ],
            "lengthMenu": [
                  [10, 25, 50, -1],
                  ['10 rows', '25 rows', '50 rows', 'Show all']
            ],
            "ajax": {
                  "url": "<?= BASE_URL ?>pelanggan/list_all_pelanggan",
                  "type": "POST",
                  "dataSrc": function(data) {
                        console.log(data);
                        return data;
                  }
            },
            "columns": cols
      });

      $(document).on("click", ".del-data", function(e) {
            e.preventDefault();
            let url_href = $(this).attr('href');
            Swal.fire({
                  text: "Apakah anda yakin menghapus data ini?",
                  type: "warning",
                  position: 'center',
                  showCancelButton: true,
                  confirmButtonText: "Hapus",
                  cancelButtonText: "Batal",
                  confirmButtonColor: '#FA896B',
                  closeOnConfirm: true,
                  showLoaderOnConfirm: true,
                  reverseButtons: true
            }).then((result) => {
                  if (result.isConfirmed) {
                        document.location.href = url_href;
                  }
            })
      });
</script>