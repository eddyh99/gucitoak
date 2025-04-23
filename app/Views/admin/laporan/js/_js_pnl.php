<script>
    $(function() {
        const notajual = $("#notajual");
        const notabeli = $("#notabeli");
        const totalgaji = $("#totalgaji");
        const totalbiaya = $("#totalbiaya");
        const labarugi = $("#labarugi");

        get_labarugi();
        setTimeout(() => {
            $("#failedtoast").toast('show')
            $("#successtoast").toast('show')
        }, 0)


        function get_labarugi() {
            const bulan = $('#bulan').val();
            const tahun = $('#tahun').val();

            $.get(`<?= BASE_URL ?>laporan/get_labarugi?bulan=` + bulan + `&tahun=` + tahun, function(data) {
                try {
                    
                    const mdata = JSON.parse(data);
                    console.log(mdata);
                    if (!mdata?.notajual && !mdata?.notabeli) throw "Data tidak valid";

                    const jual = parseInt(mdata.notajual) || 0;
                    const beli = parseInt(mdata.notabeli) || 0;
                    const gaji = parseInt(mdata.totalgaji) || 0;
                    const biaya = parseInt(mdata.totalbiaya) || 0;
                    const rugi = jual - beli - gaji - biaya;
                    

                    notajual.text(`Rp ${jual.toLocaleString()}`);
                    notabeli.text(`Rp ${beli.toLocaleString()}`);
                    totalgaji.text(`Rp ${gaji.toLocaleString()}`);
                    totalbiaya.text(`Rp ${biaya.toLocaleString()}`);
                    labarugi
                        .text(`Rp ${ (rugi < 0 ? '' : '+') + rugi.toLocaleString()}`)
                        .removeClass("text-danger text-success")
                        .addClass(rugi < 0 ? "text-danger" : "text-success");

                } catch (error) {
                    console.log(error);
                    setDefault();
                }

            }).fail(() => {
                setDefault()
            });
        }

        function setDefault() {
            notajual.text("Rp 0");
            notabeli.text("RP 0");
            totalgaji.text("Rp 0");
            totalbiaya.text("Rp 0");
            labarugi
            .text("Rp 0")
            .removeClass("text-danger text-success");
        }


        var modalGaji = $('#modalgaji').DataTable({
            "scrollX": false,
            "lengthMenu": [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],
            "ajax": {
                "url": "<?= BASE_URL ?>penggajian/get_listGaji",
                "type": "POST",
                "data": function(d) {
                    d.bulan = $('#bulan').val();
                    d.tahun = $('#tahun').val();
                },
                "dataSrc": function(data) {
                    console.log(data);
                    return data;
                }
            },
            "columns": [{
                    data: 'namasales'
                },
                {
                    data: 'gajipokok'
                },
                {
                    data: 'uangharian'
                },
                {
                    data: 'insentif'
                },
                {
                    data: 'komisi'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        // kalkulasi total
                        var total = parseInt(row.gajipokok || 0) + parseInt(row.uangharian || 0) +
                            parseFloat(row.insentif || 0) + parseInt(row.komisi || 0);
                        return total.toLocaleString("id-ID");
                    }
                },
                {
                    data: 'status'
                }
            ],
        });

        var modalBiaya = $('#modalbiaya').DataTable({
            "scrollX": false,
            "lengthMenu": [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],
            "ajax": {
                "url": "<?= BASE_URL ?>biaya/getall_biaya",
                "type": "POST",
                "data": function(d) {
                    d.bulan = $('#bulan').val();
                    d.tahun = $('#tahun').val();
                },
                "dataSrc": function(data) {
                    console.log(data);
                    return data;
                }
            },
            "columns": [{
                    data: 'tanggal'
                },
                {
                    data: 'deskripsi'
                },
                {
                    data: 'nominal',
                    render: function(data, type, row) {
                        return $.fn.dataTable.render.number('.', ',', 0, '').display(data);
                    }
                },
            ],
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api();
                var totalAmount = api.column(2).data().reduce(function(a, b) {
                    return a + (parseFloat(b) || 0);
                }, 0);
                $(api.column(2).footer()).html(totalAmount.toLocaleString('en-US', {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }) || '');
            }
        });

        $("#lihat").on("click", function() {
            get_labarugi();
            modalGaji.ajax.reload();
            modalBiaya.ajax.reload();
        });

    });
</script>