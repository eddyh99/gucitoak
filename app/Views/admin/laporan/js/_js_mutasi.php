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
		"url": "<?= BASE_URL ?>laporan/get_mutasi",
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
		{ data: 'namabarang' },
		{ data: 'awal' },
		{ data: 'masuk' },
		{ data: 'terjual' },
		{ data: 'retursup' },
		{ data: 'returpel' },
		{ data: 'sesuai' },
		{ data: 'sisa' },
	],
  });
  
  $("#lihat").on("click",function(){
     table.ajax.reload(); 
  });
  
</script>