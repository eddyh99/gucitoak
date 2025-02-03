<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/2.1.8/api/sum().js"></script>

<script>
    function alertSwal(message) {
        Swal.fire({
            title: "Peringatan!",
            text: message,
            icon: "error",
            showConfirmButton: false,
            customClass: {
                popup: 'btn-primary'
            }
        });
        setTimeout(() => {
            $(".swal2-container").css("z-index", "9999");
        }, 100);
    }

    $("#sales").select2({
        placeholder: "--- PILIH SALES ---"
    });
    
    $("#pelanggan").select2({
        placeholder: "--- PILIH PELANGGAN ---",
        allowClear: true
    });

    $("#pembayaran").on("change",function(){
        if ($(this).val()=="tempo"){
            $("#tempo").show();
        }else{
            $("#tempo").hide();
        }
    });
    
    $('#pelanggan').on('change', function () {
        const selectedOption = $(this).find('option:selected');
        const maxNota = parseInt(selectedOption.data('maxnota'));
        const countNota = parseInt(selectedOption.data('totalnotacount'));
        const plafon = parseInt(selectedOption.data('plafon'));
        const totalNotaValue = parseInt(selectedOption.data('totalnotavalue'));

        if (countNota >= maxNota && plafon==0) {
            alertSwal('Pelanggan harus membayar nota sebelumnya karena melebihi jumlah max nota.');
            $(this).val(null).trigger('change');
        }

        if (totalNotaValue >= plafon && maxNota==0) {
            alertSwal('Pelanggan harus membayar nota sebelumnya karena total nota melebihi plafon.');
            $(this).val(null).trigger('change');
        }
    });
    
    var table = $('#preview_stok').DataTable({
        "scrollX": true,
        "lengthMenu": [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
		"ajax": {
			"url": "<?= BASE_URL ?>penjualan/get_list_stokbarang",
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
            $(api.table().footer()).find('td.total').html(totalSum.toLocaleString("ID"));
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
            if ($("#pelanggan").val().trim() == "") {
                alertSwal('Silahkan pilih pelanggan terlebih dahulu');
                return;
            }
            
            const selectedOption = $("#pelanggan").find('option:selected');
            const hargaNota = selectedOption.data('harganota');
            console.log("Selected hargaNota:", hargaNota); // Debugging step
            
            $.ajax({
                url: "<?= BASE_URL ?>opname/detailbarcode/" + barcodeValue,
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
                            if (hargaNota=="Harga 1"){
                                $("#harga").val(mdata.harga1);
                            }else if (hargaNota=="Harga 2"){
                                $("#harga").val(mdata.harga2);
                            }else if (hargaNota=="Harga 3"){
                                $("#harga").val(mdata.harga3);
                            }

                            $("#stokModal").modal("show");
                        } else {
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
        $("#harga").val(null);
        $("#barang").val(null); 
        $("#barcode").val(null);
        $("#expired").val(null);
        $("#stok").val(null);
        $(".preview-expdate").text(null)
    });


    // On Click pilih simpam preview stok
    $("#simpanpreviewstok").on("click", function(e) {
        // Initial Variable
        const barcode = $("#barcode").val();
        const expired = $("#expired").val();
        const namabrg = $("#barang").val();
        const harga   = $("#harga").val();
        const validationstok = $("#stok");
        validationstok.prop('required',true);
        const jml = $("#stok").val();
        
        
        // Check jika stok kosong akan tidak refresh page
        if (stok !== "" && barang !== "" && barcode !== "") {
            e.preventDefault();
            if (jml>parseInt(stok)){
                alertSwal("Harap periksa jumlah, karena stok tersisa : "+stok);
                return;
            }
            
            if (jml<6){
                alertSwal('Minimum pembelian 6');
                return;
            }
            
            let mdata = {
                "barcode": barcode, 
                "barang": namabrg,
                "expdate": expired,
                "jml"    : jml,
                "harga"  : harga,
                "total"  : parseInt(jml*harga)
            }
            
             console.log(mdata);

            $.ajax({
                url: `<?= BASE_URL ?>penjualan/save_stok_session`,
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
            alertSwal('Data tidak boleh kosong');
        }

    });

    // Event listener for delete button
    $('#preview_stok').on('click', '.delete-row', function () {
        var barcode = $(this).data('barcode');
        
        // Confirmation dialog
        if (confirm('Apakah akan membatalkan barang ini?')) {
            // Perform AJAX call to delete item
            $.ajax({
                url: "<?= BASE_URL ?>penjualan/delete_stok_session",
                type: "POST",
                data: { barcode: barcode },
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.success) {
                        alertSwal('Item deleted successfully!');
                        table.ajax.reload(); // Reload the table data
                    } else {
                        alertSwal('Failed to delete item: ' + result.message);
                    }
                },
                error: function(xhr, status, error) {
                    alertSwal('An error occurred: ' + error);
                }
            });
        }
    });


    $("#clearallstok").on("click", function(){
        $.ajax({
            url: `<?= BASE_URL ?>penjualan/clear_stok_session`,
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
    

</script>