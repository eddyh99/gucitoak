<style>
    #table_list .group {
        background-color: #696cff !important;
    }

    #table_list .group td {
        color: white !important;
    }
</style>


<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
    $(document).ready(function() {
        setTimeout(() => {
            $("#failedtoast").toast('show')
            $("#successtoast").toast('show')
        }, 0)
        $('.barangselect2').select2({
            placeholder: "Pilih Barang",
            allowClear: true,
        });

        $('.salesselect2').select2({
            placeholder: "Pilih Sales",
            allowClear: true,
            theme: "bootstrap",
            width: "100%"
        });
    });

    var groupColumn = 0;
    let cols = [{
            "data": "namasales"
        }, // Column 0
        {
            "data": "namabarang"
        } // Column 1
    ];
    if (role == 'admin') {
        cols.push({
            "data": null,
            "mRender": function(data, type, full, meta) {
                var del = `<a href="<?= BASE_URL ?>barang/hapus_barang/${encodeURI(btoa(full.id))}" class="del-data">
                                    <i class="bx bx-trash bx-md fs-5 text-danger"></i>
                              </a>`;
                return `${del}`;
            }
        }, )
    }
    $("#table_list").DataTable({
        "ajax": {
            "url": "<?= BASE_URL ?>sales/list_all_salesbarang",
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