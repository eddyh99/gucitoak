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
                                                <i class="bx bx-edit bx-md fs-5 text-black"></i>
                                          </a>`;
                              var del = `<a href="<?= BASE_URL ?>user/hapus_user/${encodeURI(btoa(full.username))}">
                                                <i class="bx bx-trash bx-md fs-5 text-danger"></i>
                                          </a>`;
                              return `${edit} ${del}`;
                        } 
                  },
		],
      });
</script>