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
                  data: 'username'
            },
            {
                  data: 'role'
            }
      ]
      if (role == 'superadmin' || role == 'admin') {
            cols.push({
                  data: null,
                  "mRender": function(data, type, full, meta) {
                        var edit = `<a href="<?= BASE_URL ?>user/edit_user/${encodeURI(btoa(full.id))}">
                                                <i class="bx bx-edit bx-md fs-5 text-white"></i>
                                          </a>`;
                        var del = `<a href="<?= BASE_URL ?>user/hapus_user/${encodeURI(btoa(full.id))}/${encodeURI(btoa(full.username))}" class="del-data">
                                                <img src="<?= BASE_URL ?>assets/img/icons/118794_process_stop_icon.png" alt="Home Icon" width="20" height="20">
                                          </a>`;
                        return `${edit} ${data.username !== 'superadmin' ? del : ''}`;
                  }
            }, )
      }
      $('#table_list_user').DataTable({
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
                  "url": "<?= BASE_URL ?>user/list_all_user",
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