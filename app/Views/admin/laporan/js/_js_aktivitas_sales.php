<!-- Button Export Datatables -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>


<script>
    var table = $('#table_list').DataTable({
        "scrollX": false,
        "dom": 'lBfrtip',
        "buttons": [{
                extend: 'pdf',
                className: 'pdf-red',
                text: '<img src="<?= BASE_URL ?>assets/img/icons/118861_printer_icon.png" alt="add" class="me-2" width="20" height="20"> PDF',
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
            "url": "<?= BASE_URL ?>laporan/getabsensi_sales",
            "type": "POST",
            "data": function(d) {
                d.bulan = $('#bulan').val();
                d.tahun = $('#tahun').val();
                d.sales = $('#sales').val();
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
                data: 'checkin',
                className: 'text-center'
            },
            {
                data: 'checkout',
                defaultContent: '-',
                className: 'text-center'
            },
            {
                data: 'jamkerja',
                render: function(data, type, row) {
                    let totalDetik = parseInt(data) || 0;

                    let jam = Math.floor(totalDetik / 3600);
                    let sisaDetik = totalDetik % 3600;
                    let menit = Math.floor(sisaDetik / 60);
                    let detik = sisaDetik % 60;

                    return `${jam} jam ${menit} menit ${detik} detik`;
                }
            }
        ],
        footerCallback: function(row, data, start, end, display) {
            var api = this.api();

            // Total semua jamkerja
            var totalDetik = data.reduce(function(total, row) {
                return total + (parseInt(row.jamkerja) || 0);
            }, 0);

            // Konversi ke jam, menit, detik
            var jam = Math.floor(totalDetik / 3600);
            var sisaDetik = totalDetik % 3600;
            var menit = Math.floor(sisaDetik / 60);
            var detik = sisaDetik % 60;

            // Format tampilan
            var hasil = `${jam} jam ${menit} menit ${detik} detik`;

            // Tampilkan ke footer kolom ke-4 (index ke-3)
            $(api.column(3).footer()).html(hasil);
        }
    });

    $("#lihat").on("click", function() {
        table.ajax.reload();
    });
</script>