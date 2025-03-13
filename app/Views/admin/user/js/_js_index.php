<!-- Button Export Datatables -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<style>
/* Ensure all text in the table is black */
#table_list_user.table-striped tbody tr:nth-of-type(odd),
#table_list_user.table-striped tbody tr:nth-of-type(odd) td {
    background-color: #008DEE; /* Light blue color */
    color: white !important; /* Force white text for odd rows */
}

#table_list_user.table-striped tbody tr:nth-of-type(even),
#table_list_user.table-striped tbody tr:nth-of-type(even) td {
    background-color: #c8c9ff; /* Light blue color */
    color: black !important; /* Force black text for even rows */
}
/* Optional: Ensure the header and other elements look consistent */
#table_list_user thead th {
    background-color: #007bff; /* Bootstrap primary blue */
    color: white; /* White text for better contrast */
}
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
      if (role == 'admin') {
            cols.push({
                  data: null,
                  "mRender": function(data, type, full, meta) {
                        var edit = `<a href="<?= BASE_URL ?>user/edit_user/${encodeURI(btoa(full.id))}">
                                                <i class="bx bx-edit bx-md fs-5 text-white"></i>
                                          </a>`;
                        var del = `<a href="<?= BASE_URL ?>user/hapus_user/${encodeURI(btoa(full.id))}/${encodeURI(btoa(full.username))}" class="del-data">
                                                <i class="bx bx-trash bx-md fs-5 text-danger"></i>
                                          </a>`;
                        return `${edit} ${data.username !== 'admin' ? del : ''}`;
                  }
            }, )
      }
      $('#table_list_user').DataTable({
            "scrollX": true,
            "dom": 'lBfrtip',
            "buttons": [{
                        extend: 'pdf',
                        className: 'pdf-red',
                        exportOptions: {
                              columns: "th:not(:last-child)" //remove last column in pdf
                        }
                  },
                  {
                    extend: 'excelHtml5',
                    text: 'Excel',
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