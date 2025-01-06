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
      
      $('#table_list').DataTable({
            "scrollX": true,
		"ajax": {
			"url": "<?= BASE_URL ?>opname/listopname",
			"type": "POST",
			"dataSrc":function (data){
				console.log(data);
				return data;							
			}
		},
            "columns": [
			{ data: 'nama_barang' },
			{ data: 'kategori' },
			{ data: 'stok' },
			{ data: null, "mRender": function(data, type, full, meta) {
                    return parseInt(data.stok)+parseInt(data.riil)			    
			    }
			},
			{ 
                data: null,
                render: function (data, type, row) {
                    var detail = `<a href="#" onclick='detailbarcode("`+encodeURI(btoa(data.kodebrg))+`")'>
                                                <i class="bx bx-detail bx-md fs-5 text-primary"></i>
                                          </a>`;
                    return `${detail}`;
                }
            },
		],
      });
      
    function detailbarcode(idbarang) {
        $.get("<?=BASE_URL?>opname/list_barcode/" + idbarang, function(data, status) {
            let mdata = JSON.parse(data);
            let html = '';
        
            mdata.forEach(item => {
                // Convert exp_date to a Date object and format it
                let dateParts = item.exp_date.split('-'); // Split y-m-d format
                let formattedDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2])
                    .toLocaleDateString('en-GB'); // Format to d/m/y
    
                html += `
                    <tr>
                        <td>${item.barcode}</td>
                        <td>${formattedDate}</td>
                        <td>${item.system_stok}</td>
                        <td>${item.riil}</td>
                        <td>${item.keterangan}</td>
                    </tr>
                `;
            });
        
            // Insert rows into the table body
            $('#modalDataBody').html(html);
            $("#detailbarcode").modal('show');
        });
    };
      
</script>