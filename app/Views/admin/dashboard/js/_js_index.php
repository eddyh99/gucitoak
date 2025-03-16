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
        "scrollY": '180px',
        "scrollCollapse": true,
        "dom": 'Bfrtip',
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
        "scrollY": '180px',
        "scrollCollapse": true,
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
            { data: null,
            render: function (data, type, row) {
                var sisaCicilan = row.notajual - row.cicilan;
                return sisaCicilan.toLocaleString("id-ID");
            }},
            { data: null,
		    render: function (data, type, row) {
                    var detail = `<a href="#" onclick='detailCicilan_pelanggan("`+encodeURI(btoa(data.nonota))+`")'>
                                                <img src="<?= BASE_URL ?>assets/img/icons/118864_important_emblem_icon.png" alt="Home Icon" width="20" height="20">
                                          </a>`;
                    return `${detail}`;
                }
		}
        ],
    });

    $('#pembayaran_suplier').DataTable({
        "scrollX": true,
        "dom": 'Bfrtip',
        "scrollY": '180px',
        "scrollCollapse": true,
        "ajax": {
            "url": "<?= BASE_URL ?>pembayaran/get_pembayaran_sup",
            "type": "POST",
            "dataSrc": function (data) {
                console.log(data);
                return data;							
            }
        },
        "columns": [
            { data: 'namasuplier' },
            { data: null,
            render: function (data, type, row) {
                var sisaCicilan = row.notabeli - row.cicilan;
                return sisaCicilan.toLocaleString("id-ID");
            }},
            { data: null,
		    render: function (data, type, row) {
                    var detail = `<a href="#" onclick='detailCicilan_suplier("`+encodeURI(btoa(data.nonota))+`")'>
                                                <img src="<?= BASE_URL ?>assets/img/icons/118864_important_emblem_icon.png" alt="Home Icon" width="20" height="20">
                                          </a>`;
                    return `${detail}`;
                }
		}
        ],
    });

    $('#omzet_sales').DataTable({
        "scrollX": false,
        "dom": 'Bfrtip',
        "ajax": {
            "url": "<?= BASE_URL ?>dashboard/get_penjualan_sales",
            "type": "POST",
            "dataSrc": function (data) {
                console.log(data);
                return data;							
            }
        },
        "columns": [
            { data: 'nonota'},
            { data: 'tanggal'},
            { data: 'komisi'},
            { data: 'nominal'},
        ],
        "footerCallback": function(row, data, start, end, display) {
            var api = this.api();
            var totalOmzet = api.column(3).data().reduce(function(a, b) {
                return a + (parseFloat(b) || 0);
            }, 0);
            $(api.column(3).footer()).html(totalOmzet.toLocaleString("id-ID") || '');
        }
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

    function detailCicilan_suplier(idb) {
      console.log(idb);
        $.get("<?= BASE_URL ?>pembayaran/getCicilan_suplier/?nota=" + idb, function(data, status) {
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