<script>      
      $('#table_list_user').DataTable({
            "scrollX": true,
		"ajax": {
			"url": "<?= BASE_URL ?>user/list_all_user",
			"type": "POST",
			"dataSrc":function (data){
				return data;							
			}
		},
            "columns": [
			{ data: 'username' },
			{ data: 'namalengkap' },
			{ data: 'role' },
			{ 
                   data: null, "mRender": function(data, type, full, meta) {
                              var edit = `<a href="<?= BASE_URL ?>user/edit_user/${encodeURI(btoa(full.username))}">
                                                <img src="<?= BASE_URL ?>assets/img/icons/pencil.png" alt="Home Icon" width="30" height="30">
                                          </a>`;
                              var del = `<a href="<?= BASE_URL ?>user/hapus_user/${encodeURI(btoa(full.username))}">
                                                <img src="<?= BASE_URL ?>assets/img/icons/118794_process_stop_icon.png" alt="Home Icon" width="20" height="20">
                                          </a>`;
                              return `${edit} ${del}`;
                        } 
                  },
		],
      });
</script>