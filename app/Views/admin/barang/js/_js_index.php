<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
            $('.kategoriselect2').select2({
                  placeholder: "Pilih Kategori",
                  allowClear: true,
                  theme: "bootstrap", 
                  width: "100%"
            });
            $('.satuanselect2').select2({
                  placeholder: "Pilih Satuan",
                  allowClear: true,
                  theme: "bootstrap", 
                  width: "100%"
            });
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
			"url": "<?= BASE_URL ?>barang/list_all_barang",
			"type": "POST",
			"dataSrc":function (data){
				console.log(data);
				return data;							
			}
		},
            "columns": [
			{ data: 'namabarang' },
			{ data: 'namakategori' },
			{ data: 'namasatuan' },
			{ data: 'stokmin' },
                  { 
                   data: "harga1", 
                   "mRender": function(data, type, full, meta) {
                        if (type === 'display') {
                            return parseFloat(data).toLocaleString('en-US', {
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            });
                        }
                        return data;
                    } 
                  },
                  { 
                   data: "harga2", 
                   "mRender": function(data, type, full, meta) {
                        if (type === 'display') {
                            return parseFloat(data).toLocaleString('en-US', {
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            });
                        }
                        return data;
                    } 
                  },
			{ 
                   data: "harga3", 
                   "mRender": function(data, type, full, meta) {
                        if (type === 'display') {
                            return parseFloat(data).toLocaleString('en-US', {
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            });
                        }
                        return data;
                    } 
                  },
			{ data: 'disc_pct' },
                  { 
                   data: "disc_fxd", 
                   "mRender": function(data, type, full, meta) {
                        if (type === 'display') {
                            return parseFloat(data).toLocaleString('en-US', {
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            });
                        }
                        return data;
                    } 
                  },
			{ 
                        data: null, "mRender": function(data, type, full, meta) {
                              var detail = `<a href="#" onclick='detailharga("`+encodeURI(btoa(full.id))+`")'>
                                                <i class="bx bx-detail bx-md fs-5 text-primary"></i>
                                          </a>`;
                              var edit = `<a href="<?= BASE_URL ?>barang/edit_barang/${encodeURI(btoa(full.id))}">
                                                <i class="bx bx-edit bx-md fs-5 text-black"></i>
                                          </a>`;
                              var del = `<a href="<?= BASE_URL ?>barang/hapus_barang/${encodeURI(btoa(full.id))}" class="del-data">
                                                <i class="bx bx-trash bx-md fs-5 text-danger"></i>
                                          </a>`;
                              return `${detail} ${edit} ${del}`;
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
	
	function detailharga(idbarang){
	    $.get("<?=BASE_URL?>barang/list_harga/" + idbarang, function(data, status) {
            let mdata = JSON.parse(data);
            let html = '';
        
            mdata.forEach(item => {
                html += `
                    <tr>
                        <td>${item.tanggal}</td>
                        <td>${Number(item.harga1).toLocaleString('id-ID')}</td>
                        <td>${Number(item.harga2).toLocaleString('id-ID')}</td>
                        <td>${Number(item.harga3).toLocaleString('id-ID')}</td>
                        <td>${item.disc_fxd}</td>
                        <td>${(item.disc_pct * 100).toFixed(2)}%</td>
                    </tr>
                `;
            });
        
            // Insert rows into the table body
            $('#modalDataBody').html(html);
            $("#detailharga").modal('show');
        });


	}
</script>