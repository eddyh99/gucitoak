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

    $('#tgl').daterangepicker({
        endDate: moment(),
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

    var table = $('#table_list').DataTable({
        "scrollX": false,
        "dom": 'lBfrtip',
        "buttons": [{
                extend: 'pdf',
                className: 'pdf-red',
                        text: '<img src="<?= BASE_URL ?>assets/img/icons/118861_printer_icon.png" alt="add" class="me-2" width="20" height="20"> PDF',
                exportOptions: {
                    columns: "th:not(:last-child)" //remove last column in pdf
                }
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
            "url": "<?= BASE_URL ?>laporan/get_pembelian",
            "type": "POST",
            "data": function(d) {
                d.tanggal = $('#tgl').val();
                d.barang = $('#barang').val();
            },
            "dataSrc": function(data) {
                console.log(data);
                return data;
            }
        },
        "columns": [{
                data: 'namasuplier'
            },
            {
                data: 'nonota'
            },
            {
                data: 'tanggal'
            },
            { data: 'amount',
            render: function(data, type, row) {
                let total = (row.amount - row.discount) + (row.ppn * (row.amount - row.discount));
                return $.fn.dataTable.render.number('.', ',', 0, '').display(total);
            } },
            {
                data: null,
                render: function(data, type, row) {
                    var detail = `<a href="#" onclick='detailbarang("` + encodeURI(btoa(data.id)) + `")'>
                                                <img src="<?= BASE_URL ?>assets/img/icons/118864_important_emblem_icon.png" alt="Home Icon" width="20" height="20">
                                          </a>`;
                    return `${detail}`;
                }
            },
        ],
        "footerCallback": function(row, data, start, end, display) {
            var api = this.api();
            var totalAmount = data.reduce(function(total, row) {
                let netto = (row.amount - row.discount);
                let totalRow = netto + (row.ppn * netto);
                return total + totalRow;
            }, 0);
            $(api.column(3).footer()).html(totalAmount.toLocaleString('en-US', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }) || '');
        }
    });

    function detailbarang(idb) {
        console.log(idb);
        $.get("<?= BASE_URL ?>pembelian/list_barang/" + idb, function(data, status) {
            let mdata = JSON.parse(data);
            let html = '';
            console.log(mdata);
            let ppn = parseFloat(mdata[0].ppn *100);
            let diskon = parseFloat(mdata[0].discount);
            
            let diskonFormatted = diskon.toLocaleString("id-ID");
            let ppnFormatted = ppn.toLocaleString("id-ID");

            mdata.forEach(item => {
                // Ensure harga is a valid number before formatting
                let harga = parseFloat(item.harga);
                let diskon = parseFloat(item.discount);
                let ppn = parseFloat(item.ppn * 100);
                let totalHarga = parseFloat(item.totalharga);
                let jumlah = parseInt(item.jumlah);

                // Format harga and total to IDR format
                let hargaFormatted = harga.toLocaleString("id-ID");
                let diskonFormatted = diskon.toLocaleString("id-ID");
                let ppnFormatted = ppn.toLocaleString("id-ID");
                let totalFormatted = totalHarga.toLocaleString("id-ID");

                // Construct the HTML for each row
                html += `
                    <tr>
                        <td>${item.namabarang}</td>
                        <td>${jumlah}</td>
                        <td>${hargaFormatted}</td>
                        <td>${totalFormatted}</td>
                    </tr>
                `;
            });

            $("#ppn").text(ppnFormatted + '%');
            $("#diskon").text(diskonFormatted);
            
            // Insert rows into the table body
            $('#modalDataBody').html(html);
            $("#detailbarang").modal('show');
        });
    };

    $("#lihat").on("click", function() {
        table.ajax.reload();
    });
</script>