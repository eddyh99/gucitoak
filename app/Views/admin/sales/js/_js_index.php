<!-- Button Export Datatables -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>


<script>
      $(function () { 
            setTimeout(() => {
                  $("#failedtoast").toast('show')
                  $("#successtoast").toast('show')
            }, 0)
      });      

      $('#table_list').DataTable({
            "scrollX": true,
            "dom": 'lBfrtip',
            "buttons": [
                  {
                        extend: 'pdf',
                        exportOptions: {
                              columns: "th:not(:last-child)" //remove last column in pdf
                        }
                  }
                  , 
                  'excel'
            ],
            "lengthMenu": [
                  [ 10, 25, 50, -1 ],
                  [ '10 rows', '25 rows', '50 rows', 'Show all' ]
            ],
		"ajax": {
			"url": "<?= BASE_URL ?>sales/list_all_sales",
			"type": "POST",
			"dataSrc":function (data){
				return data;							
			}
		},
            "columns": [
			{ data: 'namasales' },
			{ data: 'telp' },
			{ data: 'omzet',render: $.fn.dataTable.render.number(",", ".", 0, ""), className: 'text-end',},
			{ data: 'gajipokok',render: $.fn.dataTable.render.number(",", ".", 0, ""), className: 'text-end',},
			{ data: 'komisi',render: function(data, type, row) {
                return (data * 100).toFixed(0) + '%';
            }},
			{ 
                   data: null, "mRender": function(data, type, full, meta) {
                              var edit = `<a href="<?= BASE_URL ?>sales/edit_sales/${encodeURI(btoa(full.id))}">
                                                <i class="bx bx-edit bx-md fs-5 text-black"></i>
                                          </a>`;
                              var del = `<a href="<?= BASE_URL ?>sales/hapus_sales/${encodeURI(btoa(full.id))}" class="del-data">
                                                <i class="bx bx-trash bx-md fs-5 text-danger"></i>
                                          </a>`;
                              return `${edit} ${del}`;
                        } 
                  },
		],
      });

      $(document).on("click", ".del-data", function(e){
		e.preventDefault();
		let url_href = $(this).attr('href');
		Swal.fire({
			text:"Apakah anda yakin menghapus data ini?",
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