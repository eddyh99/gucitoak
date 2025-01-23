<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
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
        handleChange();

    });

    function handleChange() {
        const userId = $("#user").val();
        const data = JSON.parse(atob($('#user').data('user')));
        const selectedUser = data.find(user => user.id == userId)
        if (selectedUser.role == 'admin') {
            // Pilih semua opsi di dropdown
            $('#laporan, #persediaan, #transaksi, #setup').each(function() {
                $(this).val($(this).find('option').map(function() {
                    return $(this).val();
                }).get()).trigger('change');
            });

        } else {
            const akses = JSON.parse(selectedUser.akses) || {};
            // aech menus
            $('#setup').val(akses['setup']).trigger('change');
            $('#persediaan').val(akses['persediaan']).trigger('change');
            $('#transaksi').val(akses['transaksi']).trigger('change');
            $('#laporan').val(akses['laporan']).trigger('change');
        }
    }
</script>