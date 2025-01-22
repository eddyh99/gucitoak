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
                exportOptions: {
                    columns: "th:not(:last-child)" //remove last column in pdf
                }
            },
            'excel'
        ],
        "lengthMenu": [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        "ajax": {
            "url": "<?= BASE_URL ?>penggajian/get_listGaji",
            "type": "POST",
            "data": function(d) {
                d.bulan = $('#bulan').val();
                d.tahun = $('#tahun').val();
            },
            "dataSrc": function(data) {
                console.log(data);
                return data;
            }
        },
        "columns": [{
                data: 'namasales'
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