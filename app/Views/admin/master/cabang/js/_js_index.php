<script>
      $('#table_list_cabang').DataTable({
            "scrollX": true,
		"ajax": {
			"url": "<?= BASE_URL ?>cabang/list_all_cabang",
			"type": "POST",
			"dataSrc":function (data){
				console.log(data);
				return data;							
			}
		},
            "columns": [
			{ data: 'namacabang' },
			{ data: 'alamat' },
			{ data: 'lat' },
			{ data: 'long' },
			{ 
                   data: null, "mRender": function(data, type, full, meta) {
                              var edit = `<a href="<?= BASE_URL ?>cabang/edit_cabang/${encodeURI(btoa(full.cabang))}">
                                                <i class="bx bx-edit bx-md fs-5 text-black"></i>
                                          </a>`;
                              var del = `<a href="<?= BASE_URL ?>cabang/hapus_cabang/${encodeURI(btoa(full.cabang))}">
                                                <i class="bx bx-trash bx-md fs-5 text-danger"></i>
                                          </a>`;
                              return `${edit} ${del}`;
                        } 
                  },
		],
      });
</script>