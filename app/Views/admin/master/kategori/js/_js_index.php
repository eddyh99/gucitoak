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
                                                <img src="<?= BASE_URL ?>assets/img/icons/118794_process_stop_icon.png" alt="Home Icon" width="20" height="20">
                                          </a>`;
                              return `${edit} ${del}`;
                        } 
                  },
		],
      });
</script>