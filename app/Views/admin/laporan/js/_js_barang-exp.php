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
    const BASE_URL = "<?= BASE_URL ?>";

    var table = $('#table_list').DataTable({
        "scrollX": false,
        "dom": 'lBfrtip',
        "buttons": [
            {
                extend: 'pdfHtml5',
                className: 'pdf-red',
                text: '<img src="<?= BASE_URL ?>assets/img/icons/118861_printer_icon.png" alt="add" class="me-2" width="20" height="20"> PDF'
            },
            {
                    extend: 'excelHtml5',
                   text: '<img src="<?= BASE_URL ?>assets/img/icons/118918_edit_copy_icon.png" alt="add" class="me-2" width="20" height="20"> Excel',
                    className: 'excel-green', // Apply custom green style
                  },
        ],
        "lengthMenu": [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        "ajax": {
            "url": BASE_URL + "laporan/get_barang_expired",
            "type": "POST",
            "data": function (d) {
                d.id = $('#kategori').val();
            },
            "dataSrc": function (data) {
                return data;
            }
        },
        "columns": [
            { data: 'nama_barang' },
            { data: 'barcode' },
            { data: 'expired' },
            { data: 'stok' }
        ],
    });
    
    /**
     * Convert all image URLs in DataTables to Base64 before exporting PDF
     */

    $("#lihat").on("click", function() {
        table.ajax.reload();
    });
</script>