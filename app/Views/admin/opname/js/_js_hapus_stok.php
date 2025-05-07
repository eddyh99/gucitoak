<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
      
    var table = $('#preview_stok').DataTable({
        "scrollX": true,
        "lengthMenu": [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
		"ajax": {
			"url": "<?= BASE_URL ?>stok/get_list_stokbarang",
			"type": "POST",
			"dataSrc":function (data){
				console.log(data);
				return data;							
			}
		},
        "columns": [
			{ data: 'barcode' },
			{ data: 'expdate' },
			{ data: 'barang' },
			{ data: 'jml' },
			{ data: 'alasan' },
		],
      });

    let stok=0;
    $("#barcode").on("keypress", function(e){
        if (e.which === 13) { // Check if Enter key is pressed
            let barcodeValue = $(this).val(); // Store the barcode value here
            
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
        $("#barang").val(null); 
        $("#alasan").val(null); 
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
        const alasan  = $("#alasan").val();
        const validationstok = $("#stok");
        validationstok.prop('required',true);
        const jml = $("#stok").val();
        
        
        // Check jika stok kosong akan tidak refresh page
        if (stok !== "" && barang !== "" && barcode !== "") {
            e.preventDefault();
            if (jml>parseInt(stok)){
                alert("Harap periksa jumlah, karena stok tersisa : "+stok);
                return;
            }
            
            let mdata = {
                "barcode": barcode, 
                "barang": namabrg,
                "expdate": expired,
                "jml"    : jml,
                "alasan" : alasan
            }
            
             console.log(mdata);

            $.ajax({
                url: `<?= BASE_URL ?>stok/save_stok_session`,
                type: "POST",
                data: {data: mdata},
                success: function (response) {
                    console.log(response);
                    table.ajax.reload();
                    $("#stokModal").modal("hide");
                    $("#alasan").val(null); 
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


    $("#clearallstok").on("click", function(){
        $.ajax({
            url: `<?= BASE_URL ?>stok/clear_stok_session`,
            type: "POST",
            success: function (response) {
                table.ajax.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
            }
        });
    })
    
    $("#submit").on("click", function(){
        window.location="<?= BASE_URL ?>opname/savestok";
    })
</script>