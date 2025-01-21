<script>
    var options = {
        chart: {
            type: 'line',
            height: 400
        },
        series: [{
            name: 'sales',
            data: []
        }],
        xaxis: {
            categories: []
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    
    // Render grafik
    chart.render();
    
    $("#lihat").on("click",function(){
        const idPelanggan = $("#pelanggan").val();
        console.log(idPelanggan);
        $.get("<?=BASE_URL?>laporan/get_omzetpel/" + idPelanggan, function(data, status) {
            console.log(data);
            if (data) {

                const mdata = JSON.parse(data);
                // Format data sesuai kebutuhan ApexCharts
                const bulan = Object.keys(mdata);  // Data kategori (bulan-tahun)
                const penjualan = Object.values(mdata).map(Number);

                // Update data grafik
                chart.updateSeries([{
                    name: 'sales',
                    data: penjualan
                }]);

                chart.updateOptions({
                    xaxis: {
                        categories: bulan
                    }
                });
            } else {
                console.error("Gagal mengambil data dari server");
            }
        })
    });
</script>
