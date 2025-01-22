<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function() {
        setTimeout(() => {
            $("#failedtoast").toast('show')
        }, 0)
    });

    $("#sales").select2({
        placeholder: "--- PILIH SALES ---"
    });

    function handleChange() {
        const id = $("#sales").val();
        const uangharian = parseInt($("#uangharian").val()) || 0;
        const insentif = parseInt($("#insentif").val()) || 0;

        $.get("<?= BASE_URL ?>sales/get_sales_report?id=" + id, function(data, status) {
            let mdata = JSON.parse(data);
            const gajipokok = parseInt(mdata.gajipokok) || 0;
            const komisi = parseFloat(mdata.komisi) || 0;

            $('#gajipokok').val(gajipokok);
            $('#komisi').val(komisi);
            $('#detailnota').val(mdata.detailnota);
            $("#totalgaji").html(gajipokok + komisi + uangharian + insentif);
        });

    }

    $("#uangharian, #insentif").on("keyup", function () {
        const gajipokok = parseInt($("#gajipokok").val()) || 0;
        const komisi = parseFloat($("#komisi").val()) || 0;
        const uangharian = parseInt($("#uangharian").val()) || 0;
        const insentif = parseInt($("#insentif").val()) || 0;

        $("#totalgaji").html(gajipokok + komisi + uangharian + insentif);
    });

    $("#submit").on('click', function() {
        $("#frmGaji").submit();
    })
</script>