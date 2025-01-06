<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
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
                            $("#stok").val(mdata.stok);
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
    
    $("#btnopname").on("click",function(){
        $("#frmopname").submit();
    })
</script>