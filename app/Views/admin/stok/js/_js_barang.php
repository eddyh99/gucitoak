<!-- Button Export Datatables -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<style>
    .low-stock {
        background-color: #FFB6C1 !important; /* Red background for low stock */
    }

    .low-stock td {
        color: white !important; /* White text color for all cells in low stock rows */
    }
</style>



<script>
    $(function () { 
        setTimeout(() => {
            $("#failedtoast").toast('show')
            $("#successtoast").toast('show')
        }, 0);
    });     
  
    $('#table_list').DataTable({
        "scrollX": true,
        "dom": 'Bfrtip',
        "buttons": [
            {
                extend: 'pdfHtml5',
                text: 'PDF',
                className: 'pdf-red', // Apply custom red style
            },
            {
                extend: 'excelHtml5',
                text: 'Excel',
                className: 'excel-green', // Apply custom green style
            },
        ],
        "ajax": {
            "url": "<?= BASE_URL ?>stok/list_all_stokbarang",
            "type": "POST",
            "dataSrc": function (data) {
                console.log(data);
                return data;							
            }
        },
        "columns": [
            { data: 'nama_barang' },
            { data: 'kategori' },
            { data: 'stok' },
            { 
                data: null,
                render: function (data, type, row) {
                    var detail = `<a href="#" onclick='detailharga("`+encodeURI(btoa(data.kodebrg))+`")'>
                                                <i class="bx bx-detail bx-md fs-5 text-black"></i>
                                          </a>`;
                    return `${detail}`;
                }
            },
        ],
        "rowCallback": function(row, data, index) {
            // Check if stok is less than or equal to min
            if (parseInt(data.stok) <= parseInt(data.min)) {
                $(row).addClass('low-stock');
            }
        }
    });
    
    function detailharga(idbarang) {
        $.get("<?=BASE_URL?>stok/list_barcode/" + idbarang, function(data, status) {
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
                        <td>${item.jumlah}</td>
                    </tr>
                `;
            });
        
            // Insert rows into the table body
            $('#modalDataBody').html(html);
            $("#detailbarcode").modal('show');
        });
    };

</script>
