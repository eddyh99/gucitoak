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
                  $("#successtoast").toast('show')
            }, 0)
      });
      
     $('#table_list').DataTable({
        "scrollX": true,
        "dom": 'Bfrtip',
        "buttons": [
            'excel', 'pdf',
        ],
        "ajax": {
            "url": "<?= BASE_URL ?>dashboard/list_all_stokbarang",
            "type": "POST",
            "dataSrc": function (data) {
                console.log(data);
                return data;							
            }
        },
        "columns": [
            { data: 'nama_barang' },
            { data: 'kategori' },
            { data: 'min' },
            { data: 'stok' },
        ],
        "rowCallback": function(row, data, index) {
            // Check if stok is less than or equal to min
            if (parseInt(data.stok) <= parseInt(data.min)) {
                $(row).addClass('low-stock');
            }
        }
    });

    $('#pembayaran_pelanggan').DataTable({
        "scrollX": true,
        "dom": 'Bfrtip',
        "buttons": [
            'excel', 'pdf',
        ],
        "ajax": {
            "url": "<?= BASE_URL ?>pembayaran/get_pembayaran_pel",
            "type": "POST",
            "dataSrc": function (data) {
                console.log(data);
                return data;							
            }
        },
        "columns": [
            { data: 'namapelanggan' },
            { data: 'tanggal' },
            { data: 'tempo' },
            { data: null,
            render: function (data, type, row) {
                // Menghitung sisa cicilan
                var sisaCicilan = row.notajual - row.cicilan;
                return sisaCicilan; // Mengembalikan hasil perhitungan
            }},
            { data: null,
		    render: function (data, type, row) {
                    var detail = `<a href="#" onclick='detailCicilan_suplier("`+encodeURI(btoa(data.nonota))+`")'>
                                                <i class="bx bx-detail bx-md fs-5 text-primary"></i>
                                          </a>`;
                    return `${detail}`;
                }
		}
        ],
    });

    function detailCicilan_suplier(idb) {
      console.log(idb+'s');
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