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
			"url": "<?= BASE_URL ?>suplier/list_all_suplier",
			"type": "POST",
			"dataSrc":function (data){
				console.log(data);
				return data;							
			}
		},
            "columns": [
			{ data: 'namasuplier' },
			{ data: 'alamat' },
			{ data: 'kota' },
			{ data: 'telp' },
			{ data: 'norek' },
			{ data: 'namabank' },
			{ data: 'anbank' },
			{ 
                   data: null, "mRender": function(data, type, full, meta) {
                              var edit = `<a href="<?= BASE_URL ?>suplier/edit_suplier/${encodeURI(btoa(full.id))}">
                                                <i class="bx bx-edit bx-md fs-5 text-black"></i>
                                          </a>`;
                              var del = `<a href="<?= BASE_URL ?>suplier/hapus_suplier/${encodeURI(btoa(full.id))}">
                                                <i class="bx bx-trash bx-md fs-5 text-danger"></i>
                                          </a>`;
                              return `${edit} ${del}`;
                        } 
                  },
		],
      });
</script>