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
                                                <img src="<?= BASE_URL ?>assets/img/icons/pencil.png" alt="Home Icon" width="30" height="30">
                                          </a>`;
                              var del = `<a href="<?= BASE_URL ?>cabang/hapus_cabang/${encodeURI(btoa(full.cabang))}">
                                                <img src="<?= BASE_URL ?>assets/img/icons/118794_process_stop_icon.png" alt="Home Icon" width="20" height="20">
                                          </a>`;
                              return `${edit} ${del}`;
                        } 
                  },
		],
      });
</script>