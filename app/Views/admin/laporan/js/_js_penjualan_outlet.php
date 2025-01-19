<!-- Button Export Datatables -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>


<script>
$(function () { 
    setTimeout(() => {
          $("#failedtoast").toast('show')
          $("#successtoast").toast('show')
    }, 0)
});    

var table=$('#table_list').DataTable({
        "scrollX": false,
        "dom": 'lBfrtip',
        "buttons": [
              {
                    extend: 'pdf',
              }
              , 
              'excel'
        ],
        "lengthMenu": [
              [ 10, 25, 50, -1 ],
              [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
	"ajax": {
		"url": "<?= BASE_URL ?>laporan/get_penjualan_outlet",
		"type": "POST",
		"data": function(d) {
            d.id = $('#pelanggan').val();
        },
		"dataSrc":function (data){
			console.log(data);
			return data;							
		}
	},
        "columns": [
		{ data: 'namabarang'},
        { data: 'jan'},
        { data: 'feb'},
        { data: 'mar'},
        { data: 'apr'},
        { data: 'mei'},
        { data: 'jun'},
        { data: 'jul'},
        { data: 'aug'},
        { data: 'sep'},
        { data: 'okt'},
        { data: 'nov'},
        { data: 'des'}
	],
  });

  function detailbarang(idb) {
      console.log(idb);
        $.get("<?=BASE_URL?>penjualan/list_barang/" + idb, function(data, status) {
            let mdata = JSON.parse(data);
            let html = '';
            console.log(mdata);
        
             mdata.forEach(item => {
                // Ensure harga is a valid number before formatting
                let harga = parseFloat(item.harga);
                let jumlah = parseInt(item.jumlah);
                let total = jumlah * harga;
    
                // Format harga and total to IDR format
                let hargaFormatted = harga.toLocaleString("id-ID");
                let totalFormatted = total.toLocaleString("id-ID");
    
                // Construct the HTML for each row
                html += `
                    <tr>
                        <td>${item.namabarang}</td>
                        <td>${jumlah}</td>
                        <td>${hargaFormatted}</td>
                        <td>${totalFormatted}</td>
                    </tr>
                `;
            });
        
            // Insert rows into the table body
            $('#modalDataBody').html(html);
            $("#detailbarang").modal('show');
        });
    };
  
  $("#lihat").on("click",function(){
     table.ajax.reload(); 
  });
  
</script>