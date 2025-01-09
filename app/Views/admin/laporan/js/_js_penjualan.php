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
        "scrollX": false,
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
		"url": "<?= BASE_URL ?>laporan/get_penjualan",
		"type": "POST",
		"data": function(d) {
            d.bulan = $('#bulan').val();
            d.tahun = $('#tahun').val();
        },
		"dataSrc":function (data){
			console.log(data);
			return data;							
		}
	},
        "columns": [
		{ data: 'nonota' },
		{ data: 'namapelanggan' },
		{ data: 'tanggal' },
		{ data: 'namasales' },
		{ data: 'amount' },
            { data: null,
		    render: function (data, type, row) {
                    var detail = `<a href="#" onclick='detailbarang("`+encodeURI(btoa(data.nonota))+`")'>
                                                <i class="bx bx-detail bx-md fs-5 text-primary"></i>
                                          </a>`;
                    return `${detail}`;
                }
		},
	],
    "footerCallback": function(row, data, start, end, display) {
        var api = this.api();
        var totalAmount = api.column(4).data().reduce(function(a, b) {
            return a + (parseFloat(b) || 0);
        }, 0);
        $(api.column(4).footer()).html(totalAmount || '');
    }
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