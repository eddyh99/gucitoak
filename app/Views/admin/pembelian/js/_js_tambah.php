<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/2.1.8/api/sum().js"></script>


<script>
    $("#suplier").select2({
        placeholder: "--- PILIH SUPLIER ---"
    });

    $(function() {
        setTimeout(() => {
            $("#failedtoast").toast('show')
            $("#successtoast").toast('show')
        }, 0);

        $('#listbarang').select2({
            placeholder: "Pilih Barang",
            allowClear: true,
            theme: "bootstrap",
            width: "100%",
            dropdownParent: $('#newbarcode') 
        });
    });

    function alertError(message) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: message
        });
    }
    

    $("#pembayaran").on("change",function(){
        if ($(this).val()=="tempo"){
            $("#tempo").show();
        }else{
            $("#tempo").hide();
        }
    });

    $('#ppn, #diskon').on('input', function() {
        let subtotalText = $('#subtotal').text().trim();

        // Ubah format angka dengan menghapus titik ribuan dan mengganti koma desimal
        let subtotal = parseFloat(subtotalText.replace(/\./g, '').replace(',', '.')) || 0;
        let disc = parseFloat($('#diskon').val()) || 0;
        let percent = parseFloat($('#ppn').val()) || 0; // Pastikan ini berupa angka

        // Validasi max 100% dan min 0%
        if (percent > 100) {
            percent = 100;
            $('#ppn').val(100);
        } else if (percent < 0) {
            percent = 0;
            $('#ppn').val(0);
        }

        // Hitung PPN
        let ppn = ((subtotal - disc) * percent) / 100;

        // Hitung Total
        let total = subtotal - disc + ppn;

        // Set hasil dengan 2 angka desimal
        $('#hasil_ppn').val(ppn);
        $('#total').val(total);
    });

    var table = $('#preview_stok').DataTable({
        "scrollX": true,
        "lengthMenu": [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
		"ajax": {
			"url": "<?= BASE_URL ?>pembelian/get_list_stokbarang",
			"type": "POST",
			"dataSrc":function (data){
				console.log(data);
				return data;							
			}
		},
		"drawCallback": function () {
            var api = this.api();
    
            // Use the sum() plugin to calculate the sum of the 'total' column
            var totalSum = api.column(5, { page: 'current' }).data().sum();
    
            // Update the footer with the total sum
            $(api.table().footer()).find('td.subtotal').html(totalSum.toLocaleString("ID"));
        },
        "columns": [
			{ data: 'barcode' },
			{ data: 'expdate' },
			{ data: 'barang' },
			{ data: 'jml' },
			{ data: 'harga',render: $.fn.dataTable.render.number( '.', ',','', '' ) },
			{ data: 'total',render: $.fn.dataTable.render.number( '.', ',','', '' ) },
			{ 
                data: null, 
                render: function(data, type, row) {
                    return `<button class="btn btn-danger btn-sm delete-row" data-barcode="${row.barcode}">Delete</button>`;
                }
            }
		],
      });

    let stok=0;
    $("#barcode").on("keypress", function(e){
        if (e.which === 13) { // Check if Enter key is pressed
            let barcodeValue = $(this).val(); // Store the barcode value here
            
            if (barcodeValue.length < 18 || barcodeValue.length > 19) {
                return alertError("Barcode tidak valid!");
            }
            
            $.ajax({
                url: "<?= BASE_URL ?>pembelian/detailbarcode/" + barcodeValue,
                type: "POST",
                success: function (response) {
                    try {
                        let mdata = JSON.parse(response);
                        console.log("Parsed mdata:", mdata);
                        
                        // Check if mdata is defined and has the expected properties
                        if (mdata && mdata.nama_barang && mdata.stok) {
                            let barcode = barcodeValue;
                            stok=mdata.stok;
                            console.log("Stok:", mdata.stok);
                            
                            // Extract the last 6 digits for the date
                            const lastSix = barcode.slice(-6);
                            const day = lastSix.slice(0, 2);
                            const month = lastSix.slice(2, 4);
                            const year = lastSix.slice(4, 6);
            
                            // Format as d/m/y
                            const formattedDate = `${day}/${month}/${year}`;
                            
                            // You can now use mdata values as needed
                            $("#barang").val(mdata.nama_barang);
                            $("#expired").val(formattedDate);
                            $('#harga').val(mdata.harga);
                            $("#stokModal").modal("show");
                        } else {
                            if(mdata.newbarcode) {
                                return barcodeConfimartion(mdata.namabarang);
                            }

                            alertError('Barcode not found');
                            console.log("Unexpected response structure:", mdata);
                        }
                    } catch (error) {
                        console.log("Error parsing JSON:", error);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("AJAX Error:", textStatus);
                }
            });
        }
    });




    // On Click pilih batal tambah stok set semua null input
    $("#batalstok").on("click", function() {
        // Set semua null
        $("#barang").val(null); 
        $("#barcode").val(null);
        $("#expired").val(null);
        $("#stok").val(null);
        $("#harga").val(null);
        $(".preview-expdate").text(null)
    });


    // On Click pilih simpam preview stok
    $("#simpanpreviewstok").on("click", function(e) {
        // Initial Variable
        const barcode = $("#barcode").val();
        const expired = $("#expired").val();
        const namabrg = $("#barang").val();
        const validationstok = $("#stok");
        validationstok.prop('required',true);
        const jml = $("#stok").val();
        const harga = $("#harga").val();
        
        
        // Check jika stok kosong akan tidak refresh page
        if (stok !== "" && barang !== "" && barcode !== "") {
            e.preventDefault();

            let mdata = {
                "barcode": barcode, 
                "barang": namabrg,
                "expdate": expired,
                "jml"    : jml,
                "harga": harga,
                "total": parseInt(harga*jml),
            }
            
             console.log(mdata);

            $.ajax({
                url: `<?= BASE_URL ?>pembelian/save_stok_session`,
                type: "POST",
                data: {data: mdata},
                success: function (response) {
                    console.log(response);
                    table.ajax.reload();
                    $("#stokModal").modal("hide");
                    $("#harga").val(null); 
                    $("#barang").val(null); 
                    $("#barcode").val(null);
                    $("#expired").val(null);
                    $("#stok").val(null);
                    stok=0;
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus);
                }
            });
            
        } else {
            e.preventDefault();
            alert("Data tidak boleh kosong")
        }

    });

    // Event listener for delete button
    $('#preview_stok').on('click', '.delete-row', function () {
        var barcode = $(this).data('barcode');
        
        // Confirmation dialog
        if (confirm('Apakah akan membatalkan barang ini?')) {
            // Perform AJAX call to delete item
            $.ajax({
                url: "<?= BASE_URL ?>pembelian/delete_stok_session",
                type: "POST",
                data: { barcode: barcode },
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.success) {
                        alert('Item deleted successfully!');
                        table.ajax.reload(); // Reload the table data
                    } else {
                        alert('Failed to delete item: ' + result.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        }
    });


    $("#clearallstok").on("click", function(){
        $.ajax({
            url: `<?= BASE_URL ?>pembelian/clear_stok_session`,
            type: "POST",
            success: function (response) {
                table.ajax.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
            }
        });
    });
    
    $("#submit").on('click', function(){
        $("#frmjual").submit();
    })

    function barcodeConfimartion(title = 'unknown') {
    Swal.fire({
        title: title,
        text: "Ingin membuat barcode baru untuk barang ini?",
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then(async (result) => {
        if (result.isConfirmed) {
            $("#newbarcodex").val($("#barcode").val());
            try {                
                await getListBarang();
                $("#newbarcode").modal("show");
            } catch (error) {
                alert(error);
            }
        }
    });

    async function getListBarang() {
        return new Promise ((resolve, reject) => {
            $.ajax({
                url: '<?= BASE_URL ?>barang/list_all_barang',
                method: 'GET',
                success: function(response) {
                    // Menghapus semua opsi yang ada sebelumnya
                    const data = JSON.parse(response);
            
                    $('#listbarang').empty();
    
                    // Menambahkan opsi default lagi
                    $('#listbarang').append('<option value="" readonly>--Pilih Barang--</option>');
    
                    // Mengisi select dengan data yang diterima dari server
                    $.each(data, function(index, item) {
                        $('#listbarang').append('<option value="' + item.id + '">' + item.namabarang + '</option>');
                    });

                    resolve();
                },
                error: function() {
                    reject('Terjadi kesalahan saat mengambil list barang.');
                }
            });
        })
    }
}
    

</script>