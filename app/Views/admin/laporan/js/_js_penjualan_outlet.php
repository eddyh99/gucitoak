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
                    className: 'pdf-red',
                        text: '<img src="<?= BASE_URL ?>assets/img/icons/118861_printer_icon.png" alt="add" class="me-2" width="20" height="20"> PDF'
              }
              , 
              {
                    extend: 'excelHtml5',
                   text: '<img src="<?= BASE_URL ?>assets/img/icons/118918_edit_copy_icon.png" alt="add" class="me-2" width="20" height="20"> Excel',
                    className: 'excel-green', // Apply custom green style
                  },
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
            d.tahun = $('#tahun').val();
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
  
  $("#lihat").on("click",function(){
     table.ajax.reload(); 
  });
  
</script>