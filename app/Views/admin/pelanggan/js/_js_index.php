<script>
      $(function () { 
            setTimeout(() => {
                  $("#failedtoast").toast('show')
                  $("#successtoast").toast('show')
            }, 0)
      });      
      $('#table_list').DataTable({
            "scrollX": true,
		"ajax": {
			"url": "<?= BASE_URL ?>pelanggan/list_all_pelanggan",
			"type": "POST",
			"dataSrc":function (data){
				console.log(data);
				return data;							
			}
		},
            "columns": [
			{ data: 'namapelanggan' },
			{ data: 'pemilik' },
			{ data: 'alamat' },
			{ data: 'kota' },
			{ data: 'telp' },
			{ data: 'plafon' },
			{ 
                   data: null, "mRender": function(data, type, full, meta) {
                              var edit = `<a href="<?= BASE_URL ?>pelanggan/edit_pelanggan/${encodeURI(btoa(full.id))}">
                                                <i class="bx bx-edit bx-md fs-5 text-black"></i>
                                          </a>`;
                              var del = `<a href="<?= BASE_URL ?>pelanggan/hapus_pelanggan/${encodeURI(btoa(full.id))}">
                                                <i class="bx bx-trash bx-md fs-5 text-danger"></i>
                                          </a>`;
                              return `${edit} ${del}`;
                        } 
                  },
		],
      });
</script>