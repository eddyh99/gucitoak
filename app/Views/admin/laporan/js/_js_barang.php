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

var table=$('#table_list').DataTable({
        "scrollX": true,
        "dom": 'lBfrtip',
        "buttons": [
              {
                    extend: 'pdf',
                    exportOptions: {
                          columns: "th:not(:last-child)" //remove last column in pdf
                    }
              }
              , 
              'excel'
        ],
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
		{ data: 'nama_barang' },
        { data: 'kategori' },
        { data: 'min' },
        { data: 'stok' },
        { data: 'harga_jual' },
        { data: 'harga_beli' },
	],
  });
  
  $("#lihat").on("click",function(){
     table.ajax.reload(); 
  });
  
</script>