            <footer class="main-footer">
                <strong>Copyright 2025</strong>
                <div class="float-right d-none d-sm-inline-block">
                  <b>Version</b> 1.0
                </div>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
          $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/moment/moment.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- SweetAlert2 -->
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/sweetalert2/sweetalert2.all.min.js"></script>

        <?php if ($nopage==4||$nopage==1001||$nopage==1011||$nopage==1021||$nopage==1031||$nopage==1041||$nopage==1051||$nopage==1061||$nopage==1081) { ?>
            <!-- Select2 -->
            <script src="<?php echo base_url(); ?>assets/newstyle/plugins/select2/js/select2.full.min.js"></script>
            <!-- date-range-picker -->
            <script src="<?php echo base_url(); ?>assets/newstyle/plugins/daterangepicker/daterangepicker.js"></script>
            <!-- Tempusdominus Bootstrap 4 -->
            <script src="<?php echo base_url(); ?>assets/newstyle/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
            <!-- DataTables & Plugins -->
            <script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables/jquery.dataTables.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/newstyle/plugins/jszip/jszip.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/newstyle/plugins/pdfmake/pdfmake.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/newstyle/plugins/pdfmake/vfs_fonts.js"></script>
            <script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-buttons/js/buttons.print.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
            <script>
                $(function () {
                    $("#tbl_daftarrute").DataTable({
                        "responsive": true, "lengthChange": false, "autoWidth": false,
                        "buttons": ["excel", "pdf", "print", "colvis"],
                        "columnDefs": [
                            { targets: [3], orderable: false}
                        ]
                    })
                    .buttons().container().appendTo('#tbl_daftarrute_wrapper .col-md-6:eq(0)');

                    var table = $("#tbl_logritasi").DataTable({
                        "responsive": true,
                        "lengthChange": false,
                        "autoWidth": false,
                        "searching": false,
                        "buttons": [
                            "excel", "pdf", 
                            {
                                extend: "print",
                                footer: true, // ✅ memastikan <tfoot> ikut dicetak
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9] // kolom tertentu yang ikut di print
                                }
                            }, 
                            "colvis"
                        ],
                        "columnDefs": [
                            { targets: [0, 10], orderable: false },
                            { targets: 0, className: 'text-center' }
                        ],
                        "order": [[8, 'desc']]
                    });

                    table.buttons().container().appendTo('#tbl_logritasi_wrapper .col-md-6:eq(0)');

                    $("#tbl_ujalan").DataTable({
                        "responsive": true, "lengthChange": false, "autoWidth": false,
                        "buttons": ["excel", "pdf", "print", "colvis"],
                        "columnDefs": [
                            { targets: [3], orderable: false}
                        ]
                    })
                    .buttons().container().appendTo('#tbl_ujalan_wrapper .col-md-6:eq(0)');

                    $("#tbl_proyek").DataTable({
                        "responsive": true, "lengthChange": false, "autoWidth": false,
                        "buttons": ["excel", "pdf", "print", "colvis"],
                        "columnDefs": [
                            { targets: [3], orderable: false}
                        ]
                    })
                    .buttons().container().appendTo('#tbl_proyek_wrapper .col-md-6:eq(0)');

                    $("#tbl_galian").DataTable({
                        "responsive": true, "lengthChange": false, "autoWidth": false,
                        "buttons": [
                            "excel", "pdf", 
                            {
                                extend: "print",
                                footer: true, // ✅ memastikan <tfoot> ikut dicetak
                                exportOptions: {
                                    columns: [0, 1, 2] // kolom tertentu yang ikut di print
                                }
                            }, 
                            "colvis"
                        ],
                        "columnDefs": [
                            { targets: [3], orderable: false}
                        ]
                    })
                    .buttons().container().appendTo('#tbl_galian_wrapper .col-md-6:eq(0)');

                    $("#tbl_user").DataTable({
                        "responsive": true, "lengthChange": false, "autoWidth": false,
                        "buttons": [
                            "excel", "pdf", 
                            {
                                extend: "print",
                                footer: true, // ✅ memastikan <tfoot> ikut dicetak
                                exportOptions: {
                                    columns: [0, 1, 2] // kolom tertentu yang ikut di print
                                }
                            }, 
                            "colvis"
                        ],
                        "columnDefs": [
                            { targets: [3], orderable: false}
                        ]
                    })
                    .buttons().container().appendTo('#tbl_user_wrapper .col-md-6:eq(0)');

                    $("#tbl_manajemenvehicles").DataTable({
                        "responsive": true, "lengthChange": false, "autoWidth": false, "searching": false,
                        "buttons": [
                            "excel", "pdf", 
                            {
                                extend: "print",
                                footer: true, // ✅ memastikan <tfoot> ikut dicetak
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4] // kolom tertentu yang ikut di print
                                }
                            }, 
                            "colvis"
                        ],
                        "columnDefs": [
                            { targets: [5], orderable: false}
                        ]
                    })
                    .buttons().container().appendTo('#tbl_manajemenvehicles_wrapper .col-md-6:eq(0)');

                    $("#tbl_manajemensupir").DataTable({
                        "responsive": true, "lengthChange": false, "autoWidth": false, "searching": false,
                        "buttons": [
                            "excel", "pdf", 
                            {
                                extend: "print",
                                footer: true, // ✅ memastikan <tfoot> ikut dicetak
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6] // kolom tertentu yang ikut di print
                                }
                            }, 
                            "colvis"
                        ],
                        "columnDefs": [
                            { targets: [7], orderable: false}
                        ]
                    })
                    .buttons().container().appendTo('#tbl_manajemensupir_wrapper .col-md-6:eq(0)');

                    $("#tbl_atim").DataTable({
                        "responsive": true, "lengthChange": false, "autoWidth": false, "searching": false,
                        "buttons": [
                            "excel", "pdf", 
                            {
                                extend: "print",
                                footer: true, // ✅ memastikan <tfoot> ikut dicetak
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5] // kolom tertentu yang ikut di print
                                }
                            }, 
                            "colvis"
                        ],
                        "columnDefs": [
                            { targets: [6], orderable: false}
                        ]
                    })
                    .buttons().container().appendTo('#tbl_atim_wrapper .col-md-6:eq(0)');

                    $("#tbl_manajemenwallet").DataTable({
                        responsive: true,
                        lengthChange: false,
                        autoWidth: false,
                        searching: false,
                        buttons: [
                            "excel", 
                            "pdf", 
                            {
                                extend: "print",
                                footer: true, // ✅ memastikan <tfoot> ikut dicetak
                                exportOptions: {
                                    columns: [0, 1, 2] // Hanya kolom Nama, Balance, Update At
                                }
                            }, 
                            "colvis"
                        ],
                        columnDefs: [
                            { targets: [3], orderable: false }
                        ]
                    })
                    .buttons().container().appendTo('#tbl_manajemenwallet_wrapper .col-md-6:eq(0)');

                    $("#tbl_reimburse_done").DataTable({
                        responsive: true,
                        paging: false,
                        lengthChange: false,
                        autoWidth: false,
                        searching: false,
                        buttons: [
                            "excel", 
                            "pdf", 
                            {
                                extend: "print",
                                footer: true // ✅ memastikan <tfoot> ikut dicetak
                            }, 
                            "colvis"
                        ],
                        columnDefs: [
                            { targets: [4], orderable: false }
                        ]
                    })
                    .buttons()
                    .container()
                    .appendTo('#tbl_reimburse_done_wrapper .col-md-6:eq(0)');

                    $('#tgl_log').datetimepicker({
                        format: 'L'
                    });

                    //Date and time picker
                    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

                    $('#tglan').datetimepicker({
                        format: 'YYYY-MM-DD'
                    });

                    $('#tglan_ritasi').datetimepicker({
                        format: 'YYYY-MM-DD'
                    });

                    $('#waktu').datetimepicker({
                        format: 'HH:mm'
                    });

                    //Select2
                    $('.select_rute').select2();

                    // Select all checkbox handler
                    $('#select-all').on('click', function () {
                        var rows = table.rows({ 'search': 'applied' }).nodes();
                        $('input[type="checkbox"].row-check', rows).prop('checked', this.checked);
                        console.log(`[Select All] Status: ${this.checked}`);
                    });

                    // Tombol Copy Data
                    $('#btn-copy-checked').on('click', function () {
                        var selectedIDs = [];

                        $('#tbl_logritasi tbody input.row-check:checked').each(function () {
                            selectedIDs.push($(this).val());
                        });

                        if (selectedIDs.length === 0) {
                            alert('Silakan checklist data yang ingin disalin.');
                            return;
                        }

                        // Redirect ke halaman routes_copy dengan parameter ID
                        var url = "<?php echo site_url('routes/routes_copy'); ?>?ids=" + selectedIDs.join(',');
                        console.log("Redirecting to:", url);
                        window.location.href = url;
                    });
                });
            </script>
        <?php } ?>

        <?php if ($nopage == 4) { ?>
            <script>
                <?php foreach ($ritasis as $row) { ?>
                    $('#tgl_edit<?php echo $row->id ?>').datetimepicker({
                        format: 'YYYY-MM-DD'
                    });

                    $('#waktu_angkut<?php echo $row->id ?>').datetimepicker({
                        format: 'HH:mm'
                    });
                <?php } ?>

                /**
                 * Ambil kendaraan berdasarkan tim_id lalu isi <select> mobil.
                 * @param {Number|String} timId        – ID tim.
                 * @param {jQuery}        mobilSelect  – Elemen <select> kendaraan di dalam modal.
                 */
                function loadKendaraanByTim(timId) {
                    console.log('[loadKendaraanByTim] dipanggil. timId =', timId);

                    if (!timId) {
                        console.warn('[loadKendaraanByTim] timId kosong, abort.');
                        return;
                    }

                    $.ajax({
                        url: "<?php echo site_url('routes/get_kendaraan_by_tim'); ?>",
                        type: "POST",
                        data: { tim_id: timId },
                        dataType: "json",
                        success: function(data) {
                            var tbody = $('#kendaraan-table tbody');
                            tbody.empty();

                            $.each(data, function(index, value) {
                                var row = `
                                    <tr>
                                        <td>
                                            ${value.no_pintu} - ${value.no_pol}
                                            <input type="hidden" name="kendaraan_id[]" value="${value.vehicle_id}">
                                        </td>
                                        <td>
                                            <div class="input-group date" id="jam-picker${value.vehicle_id}" data-target-input="nearest">
                                                <input type="text" name="jam[]" class="form-control datetimepicker-input" data-target="#jam-picker${value.vehicle_id}" data-toggle="datetimepicker"/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="nodo[]" class="form-control" placeholder="No. DO">
                                        </td>
                                    </tr>
                                `;
                                tbody.append(row);

                                // Gunakan ID selector yang benar
                                $(`#jam-picker${value.vehicle_id}`).datetimepicker({
                                    format: 'HH:mm'
                                });
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('[loadKendaraanByTim] AJAX error:', status, error);
                        }
                    });
                }

                $(document).ready(function() {
                    $('#tim-select').on('change', function() {
                        var timId = $(this).val();
                        loadKendaraanByTim(timId);
                    });

                    // Init tanggal
                    $('#tglan').datetimepicker({
                        format: 'YYYY-MM-DD'
                    });
                });

                <?php foreach ($kendaraans as $value): ?>
                    $('#jam-picker<?php echo $value->vehicle_id ?>').datetimepicker({
                        format: 'HH:mm'
                    });
                <?php endforeach; ?>
            </script>
            <script>
                $(document).ready(function() {
                    $('select[name="tim"]').on('change', function() {
                        var timId = $(this).val();
                        if (timId) {
                            $.ajax({
                                url: "<?php echo site_url('routes/get_kendaraan_by_tim'); ?>",
                                type: "POST",
                                data: { tim_id: timId },
                                dataType: "json",
                                success: function(data) {
                                    var kendaraanSelect = $('select[name="kendaraan"]');
                                    kendaraanSelect.empty();
                                    kendaraanSelect.append('<option value="">--- Pilih Kendaraan ---</option>');
                                    $.each(data, function(key, value) {
                                        kendaraanSelect.append('<option value="' + value.vehicle_id + '">' + value.no_pol + '</option>');
                                    });
                                }
                            });
                        } else {
                            $('select[name="kendaraan"]').html('<option value="">--- Pilih Kendaraan ---</option>');
                        }
                    });
                });
            </script>
        <?php } ?>

        <?php if ($nopage==1041) { ?>
            <script>
                <?php foreach ($supirs as $row) { ?>
                    $('#tglEditSupir<?php echo $row->id ?>').datetimepicker({
                        format: 'YYYY-MM-DD'
                    });
                    $('#tglEditLahir<?php echo $row->id ?>').datetimepicker({
                        format: 'YYYY-MM-DD'
                    });
                    $('#tglEditExpSim<?php echo $row->id ?>').datetimepicker({
                        format: 'YYYY-MM-DD'
                    });
                <?php } ?>

                $('#tglAddLahir').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#tglAddJoin').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#tglAddExpSim').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#tglCariJoin').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
            </script>
            <script>
                $(function () {
                  $('[data-toggle="tooltip"]').tooltip()
                })
            </script>
            <script>
                $(document).ready(function() {
                    <?php foreach ($supirs as $row) { ?>
                        (function() {
                            var id = <?php echo $row->id ?>;
                            var statusSelector = '#statusSupir' + id;
                            var keteranganWrapper = '#keteranganWrapper' + id;

                            function toggleKeterangan() {
                                var status = $(statusSelector).val();
                                if (status === 'Non Aktif') {
                                    $(keteranganWrapper).show();
                                } else {
                                    $(keteranganWrapper).hide();
                                }
                            }

                            toggleKeterangan(); // Saat load
                            $(statusSelector).change(toggleKeterangan); // Saat berubah
                        })();
                    <?php } ?>
                });
            </script>
        <?php } ?>

        <?php if ($nopage == 1061) { ?>
            <script>
                function loadRitasiData() {
                    const tanggal = $('#tanggal').val();
                    const proyek = $('#proyek').val();
                    const galian = $('#galian').val();
                    const tim = $('#tim').val();

                    if (!tanggal || !proyek || !galian || !tim) return;

                    $.ajax({
                        url: '<?= site_url('routes/get_ritasi_filtered') ?>',
                        method: 'POST',
                        data: {
                            tanggal: tanggal,
                            proyek: proyek,
                            galian: galian,
                            tim: tim
                        },
                        dataType: 'json',
                        success: function(response) {
                            const tbody = $('#kendaraan-body');
                            let total = 0;
                            tbody.empty();

                            response.forEach(item => {
                                total += parseInt(item.uang_jalan);
                                tbody.append(`
                                <tr>
                                    <td>${item.no_pol}</td>
                                    <td>Rp ${parseInt(item.uang_jalan).toLocaleString()}</td>
                                </tr>
                            `);
                        });

                            $('#total-remburst').text(`Rp ${total.toLocaleString()}`);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetch data ritasi:', error);
                        }
                    });
                }
                
                // Trigger otomatis jika semua field diisi
                $('#tanggal, #proyek, #galian, #tim').on('change', loadRitasiData);

                // Inisialisasi datepicker dan select2 jika diperlukan
                $('.datepicker').datetimepicker({ format: 'YYYY-MM-DD' });
                $('.select2').select2();
            </script>
        <?php } ?>

        <?php if ($nopage == 1041) { ?>
            <script>
                <?php foreach ($wallets as $row): ?>
                    $(document).ready(function () {
                        var tableId = "#tbl_manajemenwallet_transactions<?php echo $row->wallet_id ?>";
                        var wrapperSelector = tableId + "_wrapper .col-md-6:eq(0)";

                        var jumlahTransaksi = <?php echo count($wallet_transactions[$row->wallet_id] ?? []); ?>;

                        $(tableId).DataTable({
                            responsive: true,
                            paging: false,
                            lengthChange: false,
                            autoWidth: false,
                            searching: false,
                            buttons: [
                                "excel",
                                "pdf",
                                {
                                    extend: "print",
                                    footer: true,
                                    title: '<?php echo "[Wallet] " . $row->name . "<br>Jumlah transaksi: " . count($wallet_transactions[$row->wallet_id] ?? []); ?>'
                                },
                                "colvis"
                            ]
                        }).buttons().container().appendTo(wrapperSelector);
                    });
                <?php endforeach; ?>
            </script>
        <?php } ?>

        <?php if ($this->session->flashdata('pesanerror')) { ?>
            <script language="javascript" type="text/javascript">
                window.onload = function() {
                    Swal.fire({
                        title: "Error",
                        text: "<?php echo $this->session->flashdata('pesanerror');?>",
                        icon: "error",
                        confirmButtonText: "Tutup"
                    });
                }
            </script>
            <?php $this->session->unset_userdata('pesanerror') ?>
        <?php } else if ($this->session->flashdata('pesansukses')) { ?>
            <script language="javascript" type="text/javascript">
                window.onload = function() {
                    Swal.fire({
                        title: "Sukses",
                        text: "<?php echo $this->session->flashdata('pesansukses');?>",
                        icon: "success",
                        confirmButtonText: "Tutup"
                    });
                }
            </script>
            <?php $this->session->unset_userdata('pesansukses') ?>
        <?php } else { ?>
            <!-- sengaja dikosongkan -->
        <?php } ?>

        <script src="<?php echo base_url(); ?>assets/newstyle/dist/js/newtheme.js?v=3.2.0"></script>
    </body>
</html>