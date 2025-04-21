<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
    $(document).ready(function() {
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
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        "ajax": {
            "url": "<?= BASE_URL ?>stok/get_list_stokbarang",
            "type": "POST",
            "dataSrc": function(data) {
                console.log(data);
                return data;
            }
        },
        "columns": [{
                data: 'barcode'
            },
            {
                data: 'expdate'
            },
            {
                data: 'barang'
            },
            {
                data: 'stok'
            },
            {
                data: null,
                render: function(data, type, full, meta) {
                    const del = `<button onclick="delete_stok_barang('${full.kodebrg}', '${full.barcode}')" class="del-data btn">
                                                <img src="<?= BASE_URL ?>assets/img/icons/118794_process_stop_icon.png" alt="Home Icon" width="20" height="20">
                                          </button>`;
                    return del
                }
            },
        ],
    });


    // On Keydown scan barcode menampilkan modal
    $("#barcode").on("keypress", function(e) {
        if (e.which === 13) { // Check if Enter key is pressed
            if ($("#barang").val() == "") {
                alert("Silahkan pilih barang terlebih dahulu");
                return;
            }
            if ($.trim($(this).val()) != "") {
                const barcode = $(this).val();

                // Extract the last 6 digits for the date
                const lastSix = barcode.slice(-6);
                const day = lastSix.slice(0, 2);
                const month = lastSix.slice(2, 4);
                const year = lastSix.slice(4, 6);

                // Format as d/m/Y
                const formattedDate = `${day}/${month}/20${year}`;

                // Display or use the formatted date
                $("#hiddenexpdate").val(formattedDate);
                $(".preview-expdate").text(formattedDate);
                $("#stokModal").modal("show");
            }
        }
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
        const kodebrg = $("#barang").val();
        const barang = $("#barang").select2('data')[0].text;
        const validationstok = $("#stok");
        validationstok.prop('required', true);
        const stok = $("#stok").val();


        // Check jika stok kosong akan tidak refresh page
        if (stok !== "" && hiddenexpdate !== "" && barang !== "" && barcode !== "") {
            e.preventDefault();

            let mdata = {
                "kodebrg": kodebrg,
                "barcode": barcode,
                "expdate": hiddenexpdate,
                "barang": barang,
                "stok": stok
            }

            console.log(mdata);

            $.ajax({
                url: `<?= BASE_URL ?>stok/save_stok_session`,
                type: "POST",
                data: {
                    data: mdata
                },
                success: function(response) {
                    console.log(response);
                    table.ajax.reload();
                    $("#stokModal").modal("toggle");
                    $("#barcode").val(null);
                    $("#stok").val(null);
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


    $("#clearallstok").on("click", function() {
        $.ajax({
            url: `<?= BASE_URL ?>stok/clear_stok_session`,
            type: "POST",
            success: function(response) {
                table.ajax.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
            }
        });
    })

    function delete_stok_barang(kodebrg, barcode) {
        const mdata = {
            "kodebrg": kodebrg,
            "barcode": barcode
        }
        console.log(mdata);
        $.ajax({
            url: `<?= BASE_URL ?>stok/clear_stok_session_item`,
            type: "POST",
            data: {
                data: mdata
            },
            success: function(response) {
                table.ajax.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
            }
        });
    }

    $("#submit").on("click", function() {
        window.location = "<?= BASE_URL ?>stok/savestok";
    })
    console.log(<?= json_encode(session()->get('stokbarang')) ?>);
</script>