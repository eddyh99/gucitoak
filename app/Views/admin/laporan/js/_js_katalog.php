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
        "scrollX": false,
        "dom": 'lBfrtip',
        "buttons": [{
                extend: 'pdf',
                exportOptions: {
                    // This will allow you to customize the export
                    format: {
                        body: function(data, row, column, node) {
                            if (column === 0) {
                                return data.match(/<img.*?src=["'](.*?)["']/)[1];
                            }
                            return data;
                        }
                    }
                },
                customize: function(doc) {
                    let tableBody = doc.content[1].table.body;

                    tableBody.forEach(function(row, index) {
                        if (index > 0) {
                            let img = row[0].text;
                            if (img) {
                                row[0] = {
                                    image: img,
                                    width: 80
                                };
                            }
                        }
                    });
                }
            },
            'excel'
        ],
        "lengthMenu": [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        "ajax": {
            "url": "<?= BASE_URL ?>laporan/get_katalog",
            "type": "POST",
            "data": function(d) {
                d.id = $('#kategori').val();
            },
            "dataSrc": function(data) {
                console.log(data);
                return data;
            }
        },
        "columns": [{
                data: 'foto',
                render: function(data, type, row) {
                    return `<img src="${data}" alt="Produk" style="width: 50px; height: 50px;">`
                }
            },
            {
                data: 'namabarang'
            },
            {
                data: 'barcode'
            },
            {
                data: 'namakategori'
            },
            {
                data: 'harga1'
            }
        ],
    });

    $("#lihat").on("click", function() {
        table.ajax.reload();
    });
</script>