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
      
      $(document).ready(function(){	
            $('.produkselect2').select2({
                  placeholder: "Select Staff",
                  allowClear: true,
            });
      });
      $('#table_list').DataTable({
            "scrollX": true,
            "dom": 'Bfrtip',
            "buttons": [
                'excel', 'pdf',
            ],
		"ajax": {
			"url": "<?= BASE_URL ?>stok/list_all_stokbarang",
			"type": "POST",
			"dataSrc":function (data){
				console.log(data);
				return data;							
			}
		},
            "columns": [
			{ data: 'namabarang' },
			{ data: 'kategori' },
			{ data: 'stokmin' },
			{ data: 'harga1' },
			// { data: 'harga2' },
			// { data: 'disc_pct' },
			// { data: 'disc_fxd' },
			// { 
            //     data: null, "mRender": function(data, type, full, meta) {
            //         var edit = `<a href="<?= BASE_URL ?>barang/edit_barang/${encodeURI(btoa(full.id))}">
            //                         <i class="bx bx-edit bx-md fs-5 text-black"></i>
            //                     </a>`;
            //         var del = `<a href="<?= BASE_URL ?>barang/hapus_barang/${encodeURI(btoa(full.id))}">
            //                         <i class="bx bx-trash bx-md fs-5 text-danger"></i>
            //                     </a>`;
            //         return `${edit} ${del}`;
            //     } 
            // },
		],
      });
</script>