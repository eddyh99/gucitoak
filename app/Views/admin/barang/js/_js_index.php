<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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

      $(document).ready(function() {
            $('.kategoriselect2').select2({
                  placeholder: "Pilih Kategori",
                  allowClear: true,
                  theme: "bootstrap",
                  width: "100%"
            });
            $('.satuanselect2').select2({
                  placeholder: "Pilih Satuan",
                  allowClear: true,
                  theme: "bootstrap",
                  width: "100%"
            });
      });

      let cols = [{
                  data: 'namabarang'
            },
            {
                  data: 'namakategori'
            },
            {
                  data: 'namasatuan'
            },
            {
                  data: 'stokmin'
            },
            {
                  data: "harga1",
                  "mRender": function(data, type, full, meta) {
                      // Check if the value is NaN
                        if (data === null || data === undefined) {
                            return ""; // Replace null/undefined with blank
                        }

                        if (type === 'display') {
                              return parseFloat(data).toLocaleString('en-US', {
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 0
                              });
                        }
                        return data;
                  }
            },
            {
                  data: "harga2",
                  "mRender": function(data, type, full, meta) {
                      // Check if the value is NaN
                        if (data === null || data === undefined) {
                            return ""; // Replace null/undefined with blank
                        }
                        if (type === 'display') {
                              return parseFloat(data).toLocaleString('en-US', {
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 0
                              });
                        }
                        return data;
                  }
            },
            {
                  data: "harga3",
                  "mRender": function(data, type, full, meta) {
                        if (data === null || data === undefined) {
                            return ""; // Replace null/undefined with blank
                        }
                        if (type === 'display') {
                              return parseFloat(data).toLocaleString('en-US', {
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 0
                              });
                        }
                        return data;
                  }
            }
      ];
      if (role == 'admin') {
            cols.push({
                  data: null,
                  "mRender": function(data, type, full, meta) {
                        var detail = `<a href="#" onclick='detailharga("` + encodeURI(btoa(full.id)) + `")'>
                                                <img src="<?= BASE_URL ?>assets/img/icons/118864_important_emblem_icon.png" alt="Home Icon" width="20" height="20">
                                          </a>`;
                        var edit = `<a href="<?= BASE_URL ?>barang/edit_barang/${encodeURI(btoa(full.id))}">
                                                <img src="<?= BASE_URL ?>assets/img/icons/pencil.png" alt="Home Icon" width="30" height="30">
                                          </a>`;
                        var del = `<a href="<?= BASE_URL ?>barang/hapus_barang/${encodeURI(btoa(full.id))}" class="del-data">
                                                <img src="<?= BASE_URL ?>assets/img/icons/118794_process_stop_icon.png" alt="Home Icon" width="20" height="20">
                                          </a>`;
                        return `${detail} ${edit} ${del}`;
                  }
            })
      }
      $('#table_list').DataTable({
            "scrollX": true,
            "dom": 'lBfrtip',
            "buttons": [{
                        extend: 'pdf',
                        className: 'pdf-red',
                        text: '<img src="<?= BASE_URL ?>assets/img/icons/118861_printer_icon.png" alt="add" class="me-2" width="20" height="20"> PDF',
                        exportOptions: {
                              columns: "th:not(:last-child)" //remove last column in pdf
                        }
                  },
                   {
                    extend: 'excelHtml5',
                   text: '<img src="<?= BASE_URL ?>assets/img/icons/118918_edit_copy_icon.png" alt="add" class="me-2" width="20" height="20"> Excel',
                    className: 'excel-green', // Apply custom green style
                  },
            ],
            "lengthMenu": [
                  [10, 25, 50, -1],
                  ['10 rows', '25 rows', '50 rows', 'Show all']
            ],
            "ajax": {
                  "url": "<?= BASE_URL ?>barang/list_all_barang",
                  "type": "POST",
                  "dataSrc": function(data) {
                        console.log(data);
                        return data;
                  }
            },
            "columns": cols
      });

      $(document).on("click", ".del-data", function(e) {
            e.preventDefault();
            let url_href = $(this).attr('href');
            Swal.fire({
                  text: "Apakah anda yakin menghapus data ini?",
                  type: "warning",
                  position: 'center',
                  showCancelButton: true,
                  confirmButtonText: "Hapus",
                  cancelButtonText: "Batal",
                  confirmButtonColor: '#FA896B',
                  closeOnConfirm: true,
                  showLoaderOnConfirm: true,
                  reverseButtons: true
            }).then((result) => {
                  if (result.isConfirmed) {
                        document.location.href = url_href;
                  }
            })
      });

      function detailharga(idbarang) {
            $.get("<?= BASE_URL ?>barang/list_harga/" + idbarang, function(data, status) {
                  let mdata = JSON.parse(data);
                  let html = '';

                  mdata.forEach(item => {
                        html += `
                    <tr>
                        <td>${item.tanggal}</td>
                        <td>${Number(item.harga1).toLocaleString('id-ID')}</td>
                        <td>${Number(item.harga2).toLocaleString('id-ID')}</td>
                        <td>${Number(item.harga3).toLocaleString('id-ID')}</td>
                    </tr>
                `;
                  });

                  // Insert rows into the table body
                  $('#modalDataBody').html(html);
                  $("#detailharga").modal('show');
            });


      }

      function previewImage() {
            const img = document.querySelector('#foto');
            const imgPreview = document.querySelector('.img-preview');
            const blob = URL.createObjectURL(img.files[0]);
            imgPreview.classList.add("mb-3");
            imgPreview.src = blob;
      }
</script>