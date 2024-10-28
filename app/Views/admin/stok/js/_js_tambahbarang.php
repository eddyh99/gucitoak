<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
      
    $(document).ready(function(){	
        $('.barangselect2').select2({
            placeholder: "Pilih Barang",
            allowClear: true,
            theme: "bootstrap", 
            width: "100%"
        });
    });

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
			{ data: 'barcode' },
			{ data: 'barcode' },
			{ data: 'barcode' },
			{ data: 'barcode' },
		],
      });

    // On Change pilih barang menampilkan modal
    $("#barang").on("change", function() {
        // console.log( this.value );
        $("#stokModal").modal("show");
        const barcode = $("#barcode").val();

        // Assign expdate last 4 number dari barcode
        $("#hiddenexpdate").val(barcode.slice(-4));
        $(".preview-expdate").text(barcode.slice(-4));
        console.log(barcode.slice(-4) + "EXPDATE BARANG ONCHANGE");
        
    });

    // On Keydown scan barcode menampilkan modal
    $("#barcode").on("keydown", function() {
        // console.log( this.value );
        $("#stokModal").modal("show");
    });

    // On Click pilih batal tambah stok set semua null input
    $("#batalstok").on("click", function() {
        // Set semua null
        $("#barang").val(null).trigger("change"); 
        $("#barcode").val(null);
        $("#hiddenexpdate").val(null);
        $("#stok").val(null);
        $(".preview-expdate").text(null)
    });


    // On Click pilih simpam preview stok
    $("#simpanpreviewstok").on("click", function(e) {
        // Initial Variable
        const barcode = $("#barcode").val();
        const hiddenexpdate = $("#hiddenexpdate").val();
        const barang = $("#barang").val();
        const validationstok = $("#stok");
        validationstok.prop('required',true);
        const stok = $("#stok").val();

        
        // Check jika stok kosong akan tidak refresh page
        if (stok !== "" && hiddenexpdate !== "" && barang !== "" && barcode !== "") {
            e.preventDefault();
            
            let mdata = {
                "barcode": barcode, 
                "expdate": hiddenexpdate,
                "barang": barang,
                "stok": stok
            }

            $.ajax({
                url: `<?= BASE_URL ?>stok/save_stok_session`,
                type: "POST",
                data: {data: mdata},
                success: function (response) {
                    console.log(response);
                    table.ajax.reload();
                    $("#stokModal").modal("toggle");
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
</script>