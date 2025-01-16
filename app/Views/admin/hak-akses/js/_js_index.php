<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
        $(document).ready(function(){
        $('.userselect2').select2({
            placeholder: "Pilih Pengguna",
            allowClear: true,
            theme: "bootstrap", 
            width: "100%"
        });

        $('.setupselect2').select2({
            placeholder: "Pilih Sub Menu",
            allowClear: true
        });
        $('.persediaanselect2').select2({
            placeholder: "Pilih Sub Menu",
            allowClear: true
        });
        $('.transaksiselect2').select2({
            placeholder: "Pilih Sub Menu",
            allowClear: true
        });
        $('.laporanselect2').select2({
            placeholder: "Pilih Sub Menu",
            allowClear: true
        });
    });
</script>