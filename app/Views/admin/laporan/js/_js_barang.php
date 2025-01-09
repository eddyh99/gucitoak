<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
      $(function () { 
            setTimeout(() => {
                  $("#failedtoast").toast('show')
                  $("#successtoast").toast('show')
            }, 0)
      });      


      $('#table_list').DataTable({
            "scrollX": true,
            "dom": 'lBfrtip',
            "buttons": [],
            "lengthMenu": [
                  [ 10, 25, 50, -1 ],
                  [ '10 rows', '25 rows', '50 rows', 'Show all' ]
            ],
		"ajax": {
			"url": "<?= BASE_URL ?>laporan/get_barang",
			"type": "POST",
			"dataSrc":function (data){
				console.log(data);
				return data;							
			}
		},
            "columns": [
			{ data: 'namabarang' },
			{ data: 'namakategori' },
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
                  { data: 'harga_beli' },
		],
      });

</script>