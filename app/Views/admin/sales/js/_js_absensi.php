<script>
    $('#frmabsensi').on('submit', function(e) {
        e.preventDefault(); // Mencegah form reload halaman
        const barcode = $("#barcode");

        if (!barcode.val() || barcode.val().length < 19) {
            return alertSwal('Barcode tidak valid!');
        }

        sendAbsensiForm('checkin');

    });

    function sendAbsensiForm(type) {
        var formData = $("form").serialize() + "&type=" + type;
        $.ajax({
            url: "<?= BASE_URL ?>sales/process_absensi",
            type: 'POST',
            data: formData,
            success: function(response) {
                console.log(response);

                if (!response.valid || !response.checkin) {
                    return alertSwal(response.message);
                }
                if (response.show_checkout_confirmation) {
                    return confirmCheckout();
                }

                alertSwal(response.message, 'success');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alertSwal('Terjadi kesalahan saat melakukan absensi')
            }
        });
    }


    function alertSwal(message, status = 'error') {
        Swal.fire({
            title: "Absensi",
            text: message,
            icon: status,
            showConfirmButton: false,
            customClass: {
                popup: 'btn-primary'
            }
        });
        setTimeout(() => {
            $(".swal2-container").css("z-index", "9999");
        }, 100);
    }

    function confirmCheckout() {
        // Menampilkan SweetAlert konfirmasi
        Swal.fire({
            title: 'Konfirmasi Checkout',
            text: 'Alerady checkin, checkout now?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Checkout!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                sendAbsensiForm('checkout');
            }
        });
    }
</script>