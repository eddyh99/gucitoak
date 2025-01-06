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
</script>