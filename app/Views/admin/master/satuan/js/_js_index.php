<script>
      $('#table_list_satuan').DataTable({
            "scrollX": true,
		"ajax": {
			"url": "<?= BASE_URL ?>satuan/list_all_satuan",
			"type": "POST",
			"dataSrc":function (data){
				console.log(data);
				return data;							
			}
		},
            "columns": [
			{ data: 'satuan' },
			{ 
                   data: null, "mRender": function(data, type, full, meta) {
                              var edit = `<a href="<?= BASE_URL ?>satuan/edit_satuan/${encodeURI(btoa(full.satuan))}">
                                                <img src="<?= BASE_URL ?>assets/img/icons/pencil.png" alt="Home Icon" width="30" height="30">
                                          </a>`;
                              var del = `<a href="<?= BASE_URL ?>satuan/hapus_satuan/${encodeURI(btoa(full.satuan))}">
                                                <img src="<?= BASE_URL ?>assets/img/icons/118794_process_stop_icon.png" alt="Home Icon" width="20" height="20">
                                          </a>`;
                              return `${edit} ${del}`;
                        } 
                  },
		],
      });
</script>