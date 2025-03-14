<!-- Button Export Datatables -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>


<script>
    $(function() {
        setTimeout(() => {
            $("#failedtoast").toast('show')
            $("#successtoast").toast('show')
        }, 0)
    });
    const BASE_URL = "<?= BASE_URL ?>";

    var table = $('#table_list').DataTable({
        "scrollX": false,
        "dom": 'lBfrtip',
        "buttons": [
            {
                extend: 'pdfHtml5',
                className: 'pdf-red',
                text: '<img src="<?= BASE_URL ?>assets/img/icons/118861_printer_icon.png" alt="add" class="me-2" width="20" height="20"> PDF',
                action: function (e, dt, button, config) {
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Please wait while the PDF is being generated.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
    
                    convertImagesToBase64(dt).then((base64Data) => {
                        config.customize = function (doc) {
                            // Check if doc.content exists and contains the table
                            if (doc.content && doc.content.length > 1 && doc.content[1].table) {
                                doc.content[1].table.widths = Array(doc.content[1].table.body[0].length).fill('*');
                                doc.content[1].layout = {
                                    hLineWidth: function(i, node) {
                                        return i === 0 || i === node.table.body.length ? 2 : 1; // Add horizontal lines
                                    },
                                    vLineWidth: function(i, node) {
                                        return 0; // Remove vertical borders
                                    },
                                    hLineColor: function(i, node) {
                                        return 'black'; // Ensure visible horizontal lines
                                    },
                                    vLineColor: function(i, node) {
                                        return 'white'; // No visible vertical lines
                                    },
                                    fillColor: function(rowIndex, node, columnIndex) {
                                        return rowIndex === 0 ? 'white' : null; // Ensure header is white, rest transparent
                                    },
                                    paddingLeft: function(i, node) { return 8; },
                                    paddingRight: function(i, node) { return 8; },
                                    paddingTop: function(i, node) { return 6; },
                                    paddingBottom: function(i, node) { return 6; }
                                };
                                let tableBody = doc.content[1].table.body;
    
                                tableBody.forEach((row, index) => {
                                    if (index > 0 && base64Data[index - 1]) { // Ensure valid Base64 data
                                        row[0] = {
                                            image: base64Data[index - 1],
                                            width: 80
                                        };
                                    }
                                });
                            }
                        };
    
                        // Now trigger the actual PDF export
                        $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
                        Swal.close();
                    }).catch(error => {
                        console.error("Error processing images:", error);
                        Swal.close();
                    });
                }
            },
            'excel'
        ],
        "lengthMenu": [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        "ajax": {
            "url": BASE_URL + "laporan/get_katalog",
            "type": "POST",
            "data": function (d) {
                d.id = $('#kategori').val();
            },
            "dataSrc": function (data) {
                return data;
            }
        },
        "columns": [
            {
                data: 'foto',
                render: function (data, type, row) {
                    return `<img src="${BASE_URL}${data}" alt="Produk" style="width: 50px; height: 50px;">`;
                }
            },
            { data: 'namabarang' },
            { data: 'barcode' },
            { data: 'namakategori' },
            { data: 'harga1' }
        ],
    });
    
    /**
     * Convert all image URLs in DataTables to Base64 before exporting PDF
     */
    function convertImagesToBase64(dt) {
        return new Promise((resolve, reject) => {
            let imagePromises = [];
            let base64Images = [];
            let data = dt.rows({ search: 'applied' }).data().toArray();
    
            data.forEach((row, index) => {
                let imgSrc = BASE_URL + row.foto;
                if (imgSrc) {
                    let promise = new Promise((resolveImage, rejectImage) => {
                        fetch(imgSrc)
                            .then(response => response.blob())
                            .then(blob => {
                                const reader = new FileReader();
                                reader.onloadend = () => {
                                    base64Images[index] = reader.result; // Store Base64 string
                                    resolveImage();
                                };
                                reader.onerror = () => rejectImage(reader.error);
                                reader.readAsDataURL(blob);
                            })
                            .catch(error => rejectImage(error));
                    });
                    imagePromises.push(promise);
                } else {
                    base64Images[index] = null; // If no image, store null
                }
            });
    
            Promise.all(imagePromises)
                .then(() => resolve(base64Images)) // Resolve with all Base64 images
                .catch(error => reject(error));
        });
    }


    $("#lihat").on("click", function() {
        table.ajax.reload();
    });
</script>