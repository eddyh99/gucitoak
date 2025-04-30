<script>
    var groupColumn = 0;
    let cols = [{
            "data": "namasales"
        }, // Column 0
        {
            "data": "namabarang"
        } // Column 1
    ];
    
    $("#table_list").DataTable({
        "ajax": {
            "url": "<?= BASE_URL ?>sales/listbarang_bysales",
            "type": "POST",
            "dataSrc": function(data) {
                console.log(data);
                return data;
            }
        },
        "columns": cols,
        "columnDefs": [{
                "visible": false,
                "targets": groupColumn
            } // Hide the grouping column
        ],
        "order": [
            [groupColumn, 'asc']
        ],
        "drawCallback": function(settings) {
            var api = this.api();
            var rows = api.rows({
                page: 'current'
            }).nodes();
            var last = null;

            api.column(groupColumn, {
                page: 'current'
            }).data().each(function(group, i) {
                if (last !== group) {
                    $(rows).eq(i).before(
                        '<tr class="group"><td colspan="2">Sales : ' + group + '</td></tr>'
                    );
                    last = group;
                }
            });
        }
    });
</script>