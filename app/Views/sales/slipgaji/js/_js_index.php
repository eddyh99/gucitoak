<!-- Button Export Datatables -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script>
    $(function() {
        setTimeout(() => {
            $("#failedtoast").toast('show')
            $("#successtoast").toast('show')
        }, 0)
    });

    var table = $('#table_list').DataTable({
        "scrollX": true,
        "dom": 'lBfrtip',
        "buttons": [{
                extend: 'pdf',
            },
            'excel'
        ],
        "lengthMenu": [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        "ajax": {
            "url": "<?= BASE_URL ?>penggajian/getGaji_sales",
            "type": "POST",
            "data": function(d) {
                d.tahun = $('#tahun').val();
            },
            "dataSrc": function(data) {
                console.log(data);
                return data;
            }
        },
        "columns": [{
                data: 'bulan',
                orderData: [1]
            },
            {
                data: 'gajipokok'
            },
            {
                data: 'uangharian'
            },
            {
                data: 'insentif'
            },
            {
                data: 'komisi'
            },
            {
            data: null,
                render: function (data, type, row) {
                    // kalkulasi total
                    var total = parseInt(row.gajipokok || 0) + parseInt(row.uangharian || 0) +
                                parseFloat(row.insentif || 0) + parseInt(row.komisi || 0);
                    return total.toFixed(2);
                }
            },
            {
                data: 'status'
            },
            { data: null,
		    render: function (data, type, row) {
                    var detail = `<a href="#" onclick='detailInvoice("`+encodeURI(btoa(data.detailnota))+`")'>
                                                <i class="bx bx-detail bx-md fs-5 text-primary"></i>
                                          </a>`;
                    return `${detail}`;
                }
		    }
        ],
    });

    $("#lihat").on("click", function() {
        table.ajax.reload();
    });

    function detailInvoice(nonota) {
        console.log(nonota);
        bulan = $('#tahun').val() + '-' + $('#bulan').val();
        $.get("<?=BASE_URL?>penggajian/get_penjualan_byNota/" + nonota , function(data, status) {
            let mdata = JSON.parse(data);
            let html = '';
            console.log(mdata);
        
             mdata.forEach(item => {
                // Ensure harga is a valid number before formatting
                let nominal = parseInt(item.nominal);
                let komisi = parseFloat(item.komisi);
    
                // Format harga and total to IDR format
                let nominalFormatted = nominal.toLocaleString("id-ID");
                let komisiFormatted = komisi.toLocaleString("id-ID");
    
                // Construct the HTML for each row
                html += `
                    <tr>
                        <td>${item.nonota}</td>
                        <td>${item.tanggal}</td>
                        <td>${nominalFormatted}</td>
                        <td>${komisiFormatted}</td>
                    </tr>
                `;
            });
        
            // Insert rows into the table body
            $('#modalDataBody').html(html);
            $("#detailInvoice").modal('show');
        });
    }
</script>