<script>
      $('#table_list_kategori').DataTable({
            "scrollX": true,
		"ajax": {
			"url": "<?= BASE_URL ?>kategori/list_all_kategori",
			"type": "POST",
			"dataSrc":function (data){
				console.log(data);
				return data;							
			}
		},
            "columns": [
			{ data: 'kategori' },
			{ 
                   data: null, "mRender": function(data, type, full, meta) {
                              var edit = `<a href="<?= BASE_URL ?>kategori/edit_kategori/${encodeURI(btoa(full.kategori))}">
                                                <i class="bx bx-edit bx-md fs-5 text-black"></i>
                                          </a>`;
                              var del = `<a href="<?= BASE_URL ?>kategori/hapus_kategori/${encodeURI(btoa(full.kategori))}">
                                                <i class="bx bx-trash bx-md fs-5 text-danger"></i>
                                          </a>`;
                              return `${edit} ${del}`;
                        } 
                  },
		],
      });
</script>