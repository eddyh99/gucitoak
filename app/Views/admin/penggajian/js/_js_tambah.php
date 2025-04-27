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

    const user = "<?= $_GET['user'] ?>";

    $("#sales").select2({
        placeholder: "--- PILIH ---"
    });

    function handleChange() {
        const id = $("#sales").val();
        const uangharian = parseInt($("#uangharian").val()) || 0;
        const insentif = parseInt($("#insentif").val()) || 0;
        let url;

        switch (user) {
            case 'sales':
                url = "<?= BASE_URL ?>sales/get_sales_report?id="
                break;
            case 'admin':
                url = "<?= BASE_URL ?>user/getpengguna_byid?id="
                break;
        }

        $.get(url + id, function(data, status) {
            let mdata = JSON.parse(data);
            const gajipokok = parseInt(mdata.gajipokok) || 0;
            const komisi = parseFloat(mdata.komisi) || 0;
            console.log(komisi);
            
            const total = gajipokok + komisi + uangharian + insentif;

            $('#gajipokok').val(formatRupiah(gajipokok));
            $('#komisi').val(komisi);
            $('#detailnota').val(mdata.detailnota);
            $("#totalgaji").html(formatRupiah(total));
        });

    }

    function formatRupiah(angka) {
        return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function getInt(id) {
        return parseInt($("#" + id).val().replace(/\./g, "")) || 0;
    }

    $("#uangharian, #insentif").on("input", function () {
        const val = getInt(this.id);
        $(this).val(formatRupiah(val));
    });

    $("#uangharian, #insentif").on("keyup", function () {
        const gajipokok = getInt("gajipokok");
        const komisi = parseFloat($("#komisi").val().replace(/\./g, "")) || 0;
        const uangharian = getInt("uangharian");
        const insentif = getInt("insentif");

        const total = gajipokok + komisi + uangharian + insentif;
        $("#totalgaji").html(formatRupiah(total));
    });

    $("#submit").on('click', function() {
        ["gajipokok", "komisi", "uangharian", "insentif"].forEach(id => {
            $("#" + id).val(getInt(id));
        });
        $("#frmGaji").submit();
    })
</script>