
<script>
    $(function() {
        setTimeout(() => {
            $("#failedtoast").toast('show')
            $("#successtoast").toast('show')
        }, 0)
    });

    var table = $('#table_list').DataTable({
        "scrollX": true,
        "ajax": {
            "url": "<?= BASE_URL ?>opname/get_disposal",
            "type": "GET",
            "dataSrc": function(data) {
                console.log(data);
                return data;
            }
        },
        "columns": [{
                data: 'namabarang'
            },
            {
                data: 'namakategori'
            },
            {
                data: 'jumlah'
            },
            {
                data: 'alasan'
            },
            {
                data: null,
                render: function(data, type, row) {
                    var reject = `<a href="#" onclick='setStatus("`+encodeURI(btoa(data.id))+`", 2)'>
                                        <i class="bx bx-x bx-md fs-3 text-danger"></i>
                                    </a>`;
                    var acc = `<a href="#" onclick='setStatus("`+encodeURI(btoa(data.id))+`", 1)'>
                                    <i class="bx bx-check bx-md fs-3 text-success"></i>
                                </a>`;
                    return `${reject} ${acc}`;
                }
            },
        ],
    });

    function setStatus(id, status) {

        $.ajax({
            url: "<?= BASE_URL ?>opname/setStatus_disposal",
            method: 'POST',
            data: {
            id: id,
            status: status
            },
            success: function(response) {
                table.ajax.reload(); 
            },
            error: function(xhr, status, error) {
                console.error('Error updating status:', error);
            }
    });
}
</script>