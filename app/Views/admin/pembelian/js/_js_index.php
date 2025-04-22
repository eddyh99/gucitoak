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

$('#tgl').daterangepicker({
    endDate: moment(),
    ranges: {
       'Today': [moment(), moment()],
       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
       'This Month': [moment().startOf('month'), moment().endOf('month')],
       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
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
		"url": "<?= BASE_URL ?>pembelian/get_allpembelian",
		"type": "POST",
		"data": function(d) {
            d.tanggal = $('#tgl').val();
        },
		"dataSrc":function (data){
			console.log(data);
			return data;							
		}
	},
        "columns": [
		{ data: 'namasuplier' },
		{ data: 'nonota' },
		{ data: 'tanggal' },
		{ data: 'amount',
            render: function(data, type, row) {
                let total = (row.amount - row.discount) + (row.ppn * (row.amount - row.discount));
                return $.fn.dataTable.render.number('.', ',', 0, '').display(total);
            } 
        },
		{ data: null,
		    render: function (data, type, row) {
                    var detail = `<a href="#" onclick='detailbarang("`+encodeURI(btoa(data.id))+`")'>
                                                <img src="<?= BASE_URL ?>assets/img/icons/118864_important_emblem_icon.png" alt="Home Icon" width="20" height="20">
                                          </a>`;
                    return `${detail}`;
                }
		},
	],
  });
  
  $("#lihat").on("click",function(){
     table.ajax.reload(); 
  });
  
  function detailbarang(idb) {
      console.log(idb);
        $.get("<?=BASE_URL?>pembelian/list_barang/" + idb, function(data, status) {
            let mdata = JSON.parse(data);
            let html = '';
            // console.log(mdata);
            let ppn = parseFloat(mdata[0].ppn *100);
            let diskon = parseFloat(mdata[0].discount);
            
            let diskonFormatted = diskon.toLocaleString("id-ID");
            let ppnFormatted = ppn.toLocaleString("id-ID");
        
             mdata.forEach(item => {
                // Ensure harga is a valid number before formatting
                let harga = parseFloat(item.harga);
                let jumlah = parseInt(item.jumlah);
                let total = parseFloat(item.totalharga);

    
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
            $("#ppn").text(ppnFormatted + '%');
            $("#diskon").text(diskonFormatted);
        
            // Insert rows into the table body
            $('#modalDataBody').html(html);
            $("#detailbarang").modal('show');
        });
    };
</script>