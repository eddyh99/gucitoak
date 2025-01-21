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
                    const baseURL = "<?= BASE_URL ?>"
                    console.log(`${baseURL}assets/img/produk/${data}`);
                    // Tampilkan gambar produk
                    return data ?
                        `<img src="${baseURL}assets/img/produk/${encodeURIComponent(data)}" alt="Produk" style="width: 50px; height: 50px;">` :
                        `<img src="${baseURL}assets/img/no-image.png" alt="Default" style="width: 50px; height: 50px;">`
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