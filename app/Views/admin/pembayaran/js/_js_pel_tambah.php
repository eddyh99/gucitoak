<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/2.1.8/api/sum().js"></script>


<script>
    $(function() {
        setTimeout(() => {
            $("#failedtoast").toast('show')
        }, 0)
    });

    $("#search").on("click", function(e) {
        const nonota = $("#nonota").val();

        $.ajax({
            url: "<?= BASE_URL ?>pembayaran/cekNota_pelanggan/" + nonota,
            type: "GET",
            success: function(response) {
                try {
                    let mdata = JSON.parse(response);
                    console.log(mdata);

                    $("#tgl").val(mdata.tanggal);
                    $("#pelanggan").val(mdata.namapelanggan);
                    $("#metode").val(mdata.method);
                    $("#notajual").val(mdata.notajual);
                    $("#t_cicilan").val(mdata.totalcicilan);
                    $("#cicil").prop("disabled", mdata.isLunas == 1);
                    $("#select-notaretur").prop("disabled", mdata.isLunas == 1);
                    $("#keterangan").prop("disabled", mdata.isLunas == 1);

                    if (mdata.isLunas == 1) {
                        $("#list-cicilan").addClass('d-none')
                        $(function() {
                            setTimeout(() => {
                                $("#successtoast").toast('show')
                            }, 0)
                        });
                        $("#submit").prop("disabled", true);
                    } else {
                        table.ajax.reload();
                        $("#submit").prop("disabled", false);
                        $("#list-cicilan").removeClass('d-none')

                    }

                } catch (error) {
                    console.log("Error parsing JSON:", error);
                }
            }
        });
    })


    var table = $('#table_list').DataTable({
        "scrollX": false,
        "dom": 'lBfrtip',
        "buttons": [],
        "lengthMenu": [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        "ajax": {
            "url": "<?= BASE_URL ?>pembayaran/getCicilan_pelanggan/",
            "type": "GET",
            "data": function(d) {
                d.nota = encodeURI(btoa($("#nonota").val()));
            },
            "dataSrc": function(data) {
                console.log(data);
                return data ?? [];
            }
        },
        "columns": [{
                data: 'nonota'
            },
            {
                data: 'tanggal'
            },
            {
                data: 'amount'
            },
            {
                data: 'keterangan'
            }
        ],
        "footerCallback": function(row, data, start, end, display) {
            var api = this.api();
            var totalAmount = api.column(2).data().reduce(function(a, b) {
                return a + (parseFloat(b) || 0);
            }, 0);
            $(api.column(2).footer()).html(totalAmount || '');
        }
    });

    $("#submit").on('click', function() {
        $("#frmCicilan").submit();
    })

    var table_notaretur = $('#nota_retur').DataTable({
        "scrollX": false,
        "dom": 'lBfrtip',
        "buttons": [],
        "lengthMenu": [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        "ajax": {
            "url": "<?= BASE_URL ?>retur/listnota_returpel/",
            "type": "GET",
            "dataSrc": function(data) {
                console.log(data);
                return data ?? [];
            }
        },
        "columns": [{
                data: 'nonota'
            },
            {
                data: 'nominal'
            },
            { data: null,
		    render: function (data, type, row) {
                var print = `<button class="btn btn-sm btn-warning">select</button>`;
                    return print;
                }
		},
        ]
    });

    $('#select-notaretur').on('click', function() {
        $("#notaretur").modal('show');
    })
</script>