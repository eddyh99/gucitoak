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


    $('#table_list').DataTable({
        "scrollX": false,
        "dom": 'lBfrtip',
        "buttons": [{
                extend: 'pdfHtml5',
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
                exportOptions: {
                    columns: "th:not(:last-child)" //remove last column in pdf
                }
            },
        ],
        "scrollCollapse": true,
        "ajax": {
            "url": "<?= BASE_URL ?>pembayaran/get_pembayaran_pel",
            "type": "POST",
            "dataSrc": function(data) {
                console.log(data);
                return data;
            }
        },
        "columns": [{
                data: 'nonota'
            },
            {
                data: 'namapelanggan'
            },
            {
                data: 'tanggal'
            },
            {
                data: null,
                render: function(data, type, row) {
                    var sisaCicilan = row.notajual - row.cicilan;
                    return sisaCicilan.toLocaleString("id-ID");
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    var detail = `<a href="#" onclick='detailCicilan_pelanggan("` + encodeURI(btoa(data.nonota)) + `")'>
                                                <img src="<?= BASE_URL ?>assets/img/icons/118864_important_emblem_icon.png" alt="Home Icon" width="20" height="20">
                                          </a>`;
                    return `${detail}`;
                }
            }
        ],
    });

    function detailCicilan_pelanggan(idb) {
        console.log(idb);
        $.get("<?= BASE_URL ?>pembayaran/getCicilan_pelanggan/?nota=" + idb, function(data, status) {
            let mdata = JSON.parse(data);
            let html = '';
            console.log(mdata);

            mdata.forEach(item => {
                // Ensure harga is a valid number before formatting
                let amount = parseFloat(item.amount);
                let jumlah = parseInt(item.jumlah);

                // Format harga and total to IDR format
                let amountFormatted = amount.toLocaleString("id-ID");

                // Construct the HTML for each row
                html += `
                    <tr>
                        <td>${amountFormatted}</td>
                        <td>${item.tanggal}</td>
                        <td>${item.keterangan}</td>
                    </tr>
                `;
            });

            // Insert rows into the table body
            $('#modalDataBody').html(html);
            $("#detailcicilan").modal('show');
        });
    };
</script>