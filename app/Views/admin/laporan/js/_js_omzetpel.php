<script>
    $(document).ready(function() {
        const chart = new ApexCharts(document.querySelector("#chart"), {
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
        });
        chart.render();

        function updateChart(idp) {
            $.get(`<?= BASE_URL ?>laporan/get_omzetpel/${idp}`, function(data) {
                const mdata = data ? JSON.parse(data) : {};
                chart.updateSeries([{
                    name: 'sales',
                    data: Object.values(mdata).map(Number)
                }]);
                chart.updateOptions({
                    xaxis: {
                        categories: Object.keys(mdata)
                    }
                });
            }).fail(() => {
                console.error("Gagal mengambil data dari server");
                chart.updateSeries([{
                    name: 'sales',
                    data: []
                }]);
                chart.updateOptions({
                    xaxis: {
                        categories: []
                    }
                });
            });
        }

        updateChart($("#pelanggan").val());
        $("#lihat").on("click", () => updateChart($("#pelanggan").val()));
    });
</script>