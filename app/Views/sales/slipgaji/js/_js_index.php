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
            }
        ],
    });

    $("#lihat").on("click", function() {
        table.ajax.reload();
    });
</script>