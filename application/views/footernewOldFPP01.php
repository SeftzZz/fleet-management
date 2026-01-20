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
        <!-- Bootstrap 4 (berdasarkan asumsi jQuery sudah dimuat) -->
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Moment.js (digunakan untuk tanggal/waktu) -->
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/moment/moment.min.js"></script>

        <!-- Tempusdominus Bootstrap 4 (depend on moment and bootstrap) -->
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Date Range Picker (depend on moment.js & Bootstrap) -->
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/daterangepicker/daterangepicker.js"></script>

        <!-- Select2 (plugin untuk select dropdown) -->
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/select2/js/select2.full.min.js"></script>

        <!-- SweetAlert2 -->
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/sweetalert2/sweetalert2.all.min.js"></script>

        <!-- overlayScrollbars -->
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

        <!-- DataTables core -->
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

        <!-- DataTables Responsive -->
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

        <!-- DataTables Buttons -->
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/jszip/jszip.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

        <!-- Script utama (pastikan ini paling akhir agar semua dependensi sudah ter-load) -->
        <script src="<?php echo base_url(); ?>assets/newstyle/dist/js/newtheme.js?v=3.2.0"></script>
        <?php if ($nopage==4||$nopage==1001||$nopage==1011||$nopage==1021||$nopage==1031||$nopage==1041||$nopage==1051||$nopage==1061||$nopage==1071||$nopage==1081||$nopage==1091||$nopage==1101||$nopage==1102||$nopage==1200||$nopage==1300||$nopage==1301||$nopage==1302||$nopage==1400) { ?>

            <!-- Pengajuan Pembelian Barang -->
            <script>
                function addRowInventori(prefill = null) {
                    const table = document.getElementById("barangInventoriTable").getElementsByTagName('tbody')[0];
                    const rowCount = table.rows.length;
                    const newRow = table.insertRow();
                    newRow.innerHTML = `
                        <td class="text-center">${rowCount + 1}</td>
                        <td>
                            <select name="vendor_item_id[]" class="form-control sparepart-select">
                                <option value="">Pilih barang</option>
                                <?php foreach ($vendor_items as $value) { ?>
                                    <option value='<?php echo $value->id; ?>' 
                                        data-sparepart="<?php echo htmlspecialchars($value->sparepart); ?>"                            
                                        data-vendor="<?php echo $value->vendor_id; ?>"
                                        data-harga="<?php echo $value->harga; ?>">
                                        <?php echo $value->sparepart; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </td>
                        <td><input type="number" name="qty[]" class="form-control qty-input" min="1" value="1"></td>
                        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
                    `;

                    const $select = $(newRow).find('.sparepart-select');

                    $select.select2({
                        width: '100%',
                        dropdownParent: $('#modalFormPO')
                    });

                    $(newRow).find('input[name="qty[]"]').on('input', function () {
                        let val = parseFloat($(this).val());
                        if (val < 1 || isNaN(val)) {
                            val = 1;
                            $(this).val(val);
                        }

                        calculateGrandTotal?.();
                    });

                    if (prefill) {
                        $select.val(prefill.vendor_item_id).trigger('change');
                        $(newRow).find('input[name="qty[]"]').val(prefill.qty);
                    }

                    $select.on('change', function () {
                        const selected = $(this).find('option:selected');
                        const value = $(this).val();
                        const namaBarang = selected.data('sparepart');
                        const vendorId = selected.data('vendor');

                        console.log("=== SPAREPART DIPILIH ===");
                        console.log("vendor_item_id (value):", value);
                        console.log("Nama Sparepart:", namaBarang);
                        console.log("Vendor ID:", vendorId);
                        console.log("==========================");

                        updateRowFromSelect(this);
                    });
                }

                function removeRow(button) {
                    const row = button.closest('tr');
                    row.remove();
                    updateRowNumbers();
                    calculateGrandTotal();
                }

                function updateRowNumbers() {
                    const rows = document.querySelectorAll('#barangInventoriTable tbody tr');
                    rows.forEach((row, index) => {
                        row.querySelector('td').innerText = index + 1;
                    });
                }

                function ajaxSavePengajuan() {
                    const rows = document.querySelectorAll('#barangInventoriTable tbody tr');
                    const barang = [];

                    rows.forEach(row => {
                        const select = row.querySelector('.sparepart-select');
                        const qtyInput = row.querySelector('input[name="qty[]"]');
                        const selectedOption = select?.options[select.selectedIndex];

                        barang.push({
                            vendor_item_id: select?.value || '',
                            namaBarang: selectedOption?.dataset.sparepart || '',
                            harga: selectedOption?.dataset.harga || 0,
                            vendor_id: selectedOption?.dataset.vendor || '',
                            qty: qtyInput?.value || 0
                        });
                    });

                    // const form = {
                    //     nama: $('input[name="nama"]').val() || '',
                    //     jabatan: $('input[name="jabatan"]').val() || '',
                    //     divisi: $('input[name="divisi"]').val() || '',
                    //     tanggal: $('input[name="tanggal"]').val() || ''
                    // };

                    const form = {
                        nama: $('input[name="nama"]').val().trim(),
                        jabatan: $('input[name="jabatan"]').val().trim(),
                        divisi: $('input[name="divisi"]').val().trim(),
                        tanggal: $('input[name="tanggal"]').val().trim()
                    };

                    // Validasi
                    if (!form.nama || !form.jabatan || !form.divisi || !form.tanggal) {
                        Swal.fire('Error', 'Semua field (Nama, Jabatan, Divisi, Tanggal) wajib diisi!', 'error');
                        return;
                    }

                    if (barang.length === 0) {
                        Swal.fire('Error', 'Minimal 1 barang harus ditambahkan!', 'error');
                        return;
                    }

                    const payload = { form, barang };

                    console.log('Mengirim via AJAX:', payload);

                    $.ajax({
                        url: '<?= site_url('inventori/pengajuanadd') ?>',
                        method: 'POST',
                        data: { data: JSON.stringify(payload) },
                        dataType: 'json',
                        success: function (response) {
                            console.log('Respon berhasil:', response);
                            Swal.fire({
                                title: 'Sukses',
                                text: 'Pengajuan berhasil disimpan',
                                icon: 'success',
                                confirmButtonText: 'Tutup'
                            }).then(() => {
                                // redirect setelah klik OK
                                window.location.href = '<?= site_url('inventori/pengajuan') ?>';
                            });
                        },
                        error: function (xhr, status, error) {
                            console.error('Gagal menyimpan:', error);
                            Swal.fire('Error', 'Gagal menyimpan pengajuan', 'error');
                        }
                    });
                }
            </script>

            <!-- Purchasing -->
            <script>
                const vendorList = <?= json_encode($vendors) ?>;
                const vendorItems = <?= json_encode($vendor_items) ?>;
                const vendorItemsMap = <?= json_encode($vendor_items) ?>;

                function addRowPurchasing(prefill = null) {
                    const table = document.getElementById("barangPurchasingTable").getElementsByTagName('tbody')[0];
                    const rowCount = table.rows.length;
                    const newRow = table.insertRow();

                    const pengajuanDetailIdInput = document.createElement('input');
                    pengajuanDetailIdInput.type = 'hidden';
                    pengajuanDetailIdInput.name = 'form_pengajuan_detail_id[]';
                    pengajuanDetailIdInput.value = prefill.form_pengajuan_detail_id || '';

                    // === Input sparepart (readonly) ===
                    const sparepartInput = document.createElement('input');
                    sparepartInput.type = 'text';
                    sparepartInput.name = 'sparepart[]';
                    sparepartInput.className = 'form-control';
                    sparepartInput.readOnly = true;

                    // === Input qty ===
                    const qtyInput = document.createElement('input');
                    qtyInput.type = 'number';
                    qtyInput.name = 'qty[]';
                    qtyInput.className = 'form-control';
                    qtyInput.min = 1;

                    // === Input vendor (id + nama) ===
                    const vendorIdInput = document.createElement('input');
                    vendorIdInput.type = 'hidden';
                    vendorIdInput.name = 'vendor_id[]';
                    vendorIdInput.className = 'form-control';

                    const vendorItemInput = document.createElement('input');
                    vendorItemInput.type = 'hidden';
                    vendorItemInput.name = 'vendor_item_id[]';
                    vendorItemInput.className = 'vendor-item-id';

                    const noPoInput = document.createElement('input');
                    noPoInput.type = 'hidden';
                    noPoInput.name = 'no_po[]';
                    noPoInput.className = 'no-po-value';

                    const vendorInput = document.createElement('input');
                    vendorInput.type = 'text';
                    vendorInput.className = 'form-control vendor-name mb-1';
                    vendorInput.readOnly = true;
                    vendorInput.placeholder = 'Pilih vendor';

                    // === Tombol Pilih Vendor (pakai modal) ===
                    const pilihVendorBtn = document.createElement('button');
                    pilihVendorBtn.type = 'button';
                    pilihVendorBtn.className = 'btn btn-sm btn-primary btn-block btn-pilih-vendor';
                    pilihVendorBtn.innerText = 'Pilih Vendor';
                    pilihVendorBtn.onclick = function () {
                        const rowIndex = newRow.rowIndex - 1;
                        const row = table.rows[rowIndex];
                        const sparepart = row.querySelector('input[name="sparepart[]"]').value;

                        if (!sparepart) {
                            alert('Sparepart belum diisi!');
                            return;
                        }

                        const sparepartNormalized = sparepart.trim().toLowerCase();

                        const allowedVendors = vendorItemsMap
                            .filter(item => item.sparepart.trim().toLowerCase() === sparepartNormalized)
                            .sort((a, b) => a.harga - b.harga);

                        const vendorTableBody = document.querySelector('#vendorModalTableBody');
                        vendorTableBody.innerHTML = '';

                        allowedVendors.forEach(item => {
                            const row = document.createElement('tr');
                            row.classList.add('vendor-row');
                            row.setAttribute('data-vendor-id', item.vendor_id);
                            row.innerHTML = `
                                <td>${getVendorNameById(item.vendor_id)}</td>
                                <td class="harga-col">Rp ${parseInt(item.harga).toLocaleString('id-ID')}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm"
                                        onclick="pilihVendorDariModal('${item.vendor_id}', '${getVendorNameById(item.vendor_id)}', ${item.harga}, ${rowIndex}, ${item.id})">Pilih</button>
                                </td>
                            `;
                            vendorTableBody.appendChild(row);
                        });

                        currentVendorRowIndex = rowIndex;
                        $('#vendorModal').modal('show');
                    };

                    // === Harga (hidden + display) ===
                    const hargaHidden = document.createElement('input');
                    hargaHidden.type = 'hidden';
                    hargaHidden.name = 'harga[]';
                    hargaHidden.className = 'form-control harga-hidden';

                    const hargaDisplay = document.createElement('input');
                    hargaDisplay.type = 'text';
                    hargaDisplay.className = 'form-control harga-display';
                    hargaDisplay.readOnly = true;

                    // === Tombol hapus baris ===
                    const hapusBtn = document.createElement('button');
                    hapusBtn.type = 'button';
                    hapusBtn.className = 'btn btn-danger btn-sm btn-hapus';
                    hapusBtn.innerText = 'Hapus';
                    hapusBtn.onclick = function () {
                        removeRow(hapusBtn);
                    };

                    // === Inisialisasi baris kosong ===
                    newRow.innerHTML = `<td class="text-center">${rowCount + 1}</td><td></td><td></td><td id="qtyPengajuan"></td><td id="pilihVendor"></td><td></td><td id="hapusPO"></td>`;

                    // === Masukkan komponen ke kolom ===
                    newRow.cells[1].appendChild(pengajuanDetailIdInput);
                    newRow.cells[1].appendChild(sparepartInput);
                    newRow.cells[2].appendChild(qtyInput);
                    newRow.cells[3].appendChild(vendorIdInput);
                    newRow.cells[3].appendChild(vendorItemInput);
                    newRow.cells[3].appendChild(noPoInput);
                    newRow.cells[3].appendChild(vendorInput);
                    newRow.cells[4].appendChild(pilihVendorBtn);
                    newRow.cells[5].appendChild(hargaHidden);
                    newRow.cells[5].appendChild(hargaDisplay);
                    newRow.cells[6].appendChild(hapusBtn);

                    // === Prefill jika ada ===
                    if (prefill) {
                        sparepartInput.value = prefill.sparepart;
                        qtyInput.value = prefill.qty || 1;
                        vendorIdInput.value = prefill.vendor_id;
                        vendorInput.value = getVendorNameById(prefill.vendor_id);
                        hargaHidden.value = prefill.harga;
                        hargaDisplay.value = formatRupiah(prefill.harga);
                        vendorItemInput.value = prefill.vendor_item_id || ''; // ⬅️ tambahkan ini
                    }

                    qtyInput.addEventListener('input', calculateGrandTotal);
                    calculateGrandTotal();
                }

                function pilihVendorDariModal(vendorId, vendorName, harga, rowIndex, vendorItemId = null) {
                    // Cek apakah vendor sudah ada di tabel vendorInventoriTable
                    const existingRow = Array.from(document.querySelectorAll('#vendorInventoriTable tbody select[name="vendor[]"]'))
                      .find(select => select.value === vendorId);

                    if (!existingRow) {
                      const vendorTable = document.querySelector('#vendorInventoriTable tbody');
                      const newRow = vendorTable.insertRow();

                      const select = document.createElement('select');
                      select.name = 'vendor[]';
                      select.classList.add('form-control', 'select-rute');
                      select.disabled = true;

                      const defaultOption = document.createElement('option');
                      defaultOption.value = '';
                      defaultOption.textContent = 'Pilih vendor';
                      select.appendChild(defaultOption);

                      vendorList.forEach(v => {
                        const option = document.createElement('option');
                        option.value = v.id;
                        option.textContent = v.name;
                        option.dataset.kode = v.kode;
                        select.appendChild(option);
                      });

                      const is_bonHidden = document.createElement('input');
                      is_bonHidden.type = 'hidden';
                      is_bonHidden.name = 'is_bon[]';
                      is_bonHidden.value = 0; // default 0

                      const is_bonInput = document.createElement('input');
                      is_bonInput.type = 'checkbox';
                      is_bonInput.classList.add('form-control');
                      is_bonInput.value = 1; // nilai saat dicentang
                      is_bonInput.onchange = function () {
                        if (this.checked) {
                            is_bonHidden.value = 1;
                        } else {
                            is_bonHidden.value = 0;
                        }
                      };

                      const noPoInput = document.createElement('input');
                      noPoInput.name = 'no_po[]';
                      noPoInput.classList.add('form-control', 'no-po-field');
                      noPoInput.readOnly = true;
                      noPoInput.placeholder = 'Sedang generate...';

                      const rowIndex = vendorTable.rows.length;

                      newRow.innerHTML = `<td class="text-center">${rowIndex + 0}</td><td></td><td></td><td></td>`;
                      newRow.cells[1].appendChild(select);
                      newRow.cells[2].appendChild(is_bonHidden);
                      newRow.cells[2].appendChild(is_bonInput);
                      newRow.cells[3].appendChild(noPoInput);

                      // Set value dan generate no_po
                      $(select).val(vendorId).trigger('change');
                      fetch(`/inventori/generate_po_ajax?vendor_id='${vendorId}'`)
                        .then(response => response.json())
                        .then(data => {
                          noPoInput.value = data.no_po || 'Gagal generate';
                        })
                        .catch(() => {
                          noPoInput.value = 'Error';
                        });
                    }


                    const table = document.querySelector('#barangPurchasingTable tbody');
                    const row = table.rows[rowIndex];

                    const vendorIdInput = row.querySelector('input[name="vendor_id[]"]');
                    const vendorItemInput = row.querySelector('input[name="vendor_item_id[]"]');
                    const vendorNameInput = row.querySelector('.vendor-name');
                    const hargaHiddenInput = row.querySelector('input[name="harga[]"]');
                    const hargaDisplayInput = row.querySelector('.harga-display');
                    const noPoInput = row.querySelector('input[name="no_po[]"]');

                    if (vendorIdInput) vendorIdInput.value = vendorId;
                    if (vendorNameInput) vendorNameInput.value = vendorName;
                    if (hargaHiddenInput) hargaHiddenInput.value = harga;
                    if (hargaDisplayInput) hargaDisplayInput.value = formatRupiah(harga);
                    if (vendorItemInput) vendorItemInput.value = vendorItemId ?? '';

                    // Update juga no_po di hidden input
                    if (noPoInput) {
                        noPoInput.value = 'Sedang generate...';

                        fetch(`/inventori/generate_po_ajax?vendor_id=${vendorId}`)
                            .then(response => response.json())
                            .then(data => {
                                const po = data.no_po || 'Gagal generate';
                                noPoInput.value = po;

                                // ✅ Update juga tampilan di vendorInventoriTable
                                const vendorTable = document.querySelector('#vendorInventoriTable tbody');
                                if (vendorTable) {
                                    const rowVendor = vendorTable.rows[rowIndex];
                                    if (rowVendor) {
                                        const select = rowVendor.querySelector('select[name="vendor[]"]');
                                        const is_bonDisplay = rowVendor.querySelector('input[name="is_bon[]"]');
                                        const noPoDisplay = rowVendor.querySelector('input[name="no_po[]"]');

                                        if (select) {
                                            $(select).val(vendorId).trigger('change');
                                        }

                                        if (noPoDisplay) {
                                            noPoDisplay.value = po;
                                        }

                                        if (is_bonDisplay) {
                                            is_bonDisplay.value = '';
                                        }
                                    }
                                    calculateGrandTotal();
                                }
                            })
                            .catch(() => {
                                if (noPoInput) noPoInput.value = 'Error';
                            });
                    }

                    $('#vendorModal').modal('hide');
                }

                function calculateGrandTotal() {
                    let total = 0;

                    // Loop semua baris barang
                    $('#barangPurchasingTable tbody tr').each(function () {
                        const qty = parseFloat($(this).find('input[name="qty[]"]').val()) || 0;
                        const harga = parseFloat($(this).find('input[name="harga[]"]').val()) || 0;
                        total += qty * harga;
                    });

                    // Update tampilan Grand Total
                    $('#grandTotal1').text(formatRupiah(total));
                    $('#grandTotal2').text(formatRupiah(total));
                }

                function renderVendorFromPengajuan(barangData) {
                    console.log("barangData", barangData);
                    if (!Array.isArray(barangData)) return;

                    const vendorIds = [...new Set(barangData.map(item => item.vendor_id).filter(id => !!id))];

                    const vendorTable = document.querySelector('#vendorInventoriTable tbody');
                    vendorTable.innerHTML = '';

                    fetch('<?= base_url('inventori/get_vendors_json') ?>')
                        .then(response => response.json())
                        .then(vendorList => {
                            vendorIds.forEach((vendorId, index) => {
                                const row = vendorTable.insertRow();

                                const select = document.createElement('select');
                                select.name = 'vendor[]';
                                select.classList.add('form-control', 'select-rute');
                                select.disabled = true;

                                const defaultOption = document.createElement('option');
                                defaultOption.value = '';
                                defaultOption.textContent = 'Pilih vendor';
                                select.appendChild(defaultOption);

                                vendorList.forEach(v => {
                                    const option = document.createElement('option');
                                    option.value = v.id;
                                    option.textContent = v.name;
                                    option.dataset.kode = v.kode;
                                    select.appendChild(option);
                                });

                                const is_bonHidden = document.createElement('input');
                                is_bonHidden.type = 'hidden';
                                is_bonHidden.name = 'is_bon[]';
                                is_bonHidden.value = 0;

                                const is_bonInput = document.createElement('input');
                                is_bonInput.type = 'checkbox';
                                is_bonInput.classList.add('form-control');
                                is_bonInput.value = 1;
                                is_bonInput.onchange = function () {
                                    if (this.checked) {
                                        is_bonHidden.value = 1;
                                        noPoInput.readOnly = true;   // supaya tidak bisa diisi manual
                                    } else {
                                        is_bonHidden.value = 0;
                                        noPoInput.value = 'Sedang generate...'; // generate ulang
                                        noPoInput.readOnly = false;

                                        // generate ulang nomor PO via ajax
                                        fetch(`/inventori/generate_po_ajax?vendor_id='${vendorId}'`)
                                        .then(response => response.json())
                                        .then(data => {
                                            noPoInput.value = data.no_po || 'Gagal generate';
                                        })
                                        .catch(() => {
                                            noPoInput.value = 'Error';
                                        });
                                    }
                                };

                                const noPoInput = document.createElement('input');
                                noPoInput.name = 'no_po[]';
                                noPoInput.classList.add('form-control', 'no-po-field');
                                noPoInput.readOnly = false; // bisa diedit manual

                                row.innerHTML = `
                                    <td class="text-center">${index + 1}</td>
                                    <td></td><td></td><td></td>
                                `;

                                row.cells[1].appendChild(select);
                                row.cells[2].appendChild(is_bonHidden);
                                row.cells[2].appendChild(is_bonInput);
                                row.cells[3].appendChild(noPoInput);

                                // Set vendor & trigger select2
                                $(select).val(vendorId).trigger('change');

                                // Generate PO langsung saat vendor tampil
                                if (vendorId) {
                                    fetch(`<?= base_url('inventori/generate_po_ajax?vendor_id=') ?>${vendorId}`)
                                        .then(response => response.json())
                                        .then(data => {
                                            noPoInput.value = data.no_po || 'Gagal generate';
                                        })
                                        .catch(() => {
                                            noPoInput.value = 'Error';
                                        });
                                } else {
                                    noPoInput.value = '';
                                }
                            });
                        })
                        .catch(err => {
                            console.error('Gagal ambil vendor:', err);
                        });
                }

                function removeRowPurchasing(button) {
                  const row = button.closest('tr');
                  row.remove();
                  updateRowNumbers();
                }

                function getVendorNameById(vendorId) {
                  const vendor = vendorList.find(v => String(v.id) === String(vendorId));
                  return vendor ? vendor.name : 'Unknown Vendor';
                }

                function formatRupiah(angka) {
                  const num = parseFloat(angka);
                  if (isNaN(num)) return '';
                  return 'Rp ' + num.toLocaleString('id-ID');
                }

                function updateRowFromSelect(selectEl) {
                  const selected = selectEl.options[selectEl.selectedIndex];
                  const vendorId = selected.getAttribute('data-vendor') || '';
                  const harga = selected.getAttribute('data-harga') || '';

                  const row = selectEl.closest('tr');
                  const vendorIdInput = row.querySelector('input[name="vendor_id[]"]');
                  const vendorNameInput = row.querySelector('.vendor-name');
                  const hargaHiddenInput = row.querySelector('input[name="harga[]"]');
                  const hargaDisplayInput = row.querySelector('.harga-display');
                }
            </script>
            <script>
                const pengajuanBarangData = <?php echo $pengajuan_barang ?>;
                console.log('[DEBUG] Data pengajuan_barang:', pengajuanBarangData);

                // Render langsung saat halaman dimuat
                $(document).ready(function () {
                    if (Array.isArray(pengajuanBarangData)) {
                        pengajuanBarangData.forEach(item => addRowPurchasing(item));
                    }

                    renderVendorFromPengajuan(pengajuanBarangData);
                });
            </script>

            <!-- Maintenance -->
            <script>
                $(document).ready(function () {
                    // Sembunyikan tabel saat pertama kali load
                    $('#barangTable').hide();
                    $('#button-form').hide();

                    // Tampilkan tabel saat no_pintu dipilih
                    $('#no_pintu').on('change', function () {
                        const val = $(this).val();
                        if (val) {
                            $('#barangTable').show();
                            $('#button-form').show();
                        } else {
                            $('#barangTable').hide();
                            $('#button-form').hide();
                        }

                        const driverId = $(this).find(':selected').data('driver-id');
                        const vehicleId = $(this).find(':selected').data('vehicle-id');

                        $('#driver_id').val(driverId);
                        $('#vehicle_id').val(vehicleId);
                    });

                    $('#addRowBtn').on('click', function () {
                        let isValid = true;

                        $('#barangTable tbody tr').each(function () {
                            const sparepartVal = $(this).find('.sparepart-select').val();
                            const kondisiVal = $(this).find('.kondisi-select').val();
                            const qtyVal = $(this).find('input[name="qty[]"]').val();
                            const posisiSelect = $(this).find('.posisi-select');
                            const posisiVal = posisiSelect.is(':disabled') ? 'valid' : posisiSelect.val();

                            if (!sparepartVal || !kondisiVal || !qtyVal || parseInt(qtyVal) <= 0 || !posisiVal || posisiVal === '') {
                                isValid = false;
                                return false; // break loop
                            }
                        });

                        if (!isValid) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Peringatan',
                                text: 'Harap isi dengan lengkap sebelum menambahkan baris baru.'
                            });
                            return; // stop here
                        }

                        const $newRow = $('#rowTemplate tr').clone();
                        $('#barangTable tbody').append($newRow);

                        // Re-inisialisasi select2 setelah append
                        $newRow.find('.sparepart-select').select2({
                            width: '100%',
                            dropdownParent: $newRow
                        });

                        $newRow.find('.posisi-select').select2({
                            width: '100%',
                            dropdownParent: $newRow
                        });

                        updateRowNumbers();
                        bindEvents($newRow);
                    });

                    function bindEvents($row) {
                        $row.find('.sparepart-select').on('change', function () {
                            const $select = $(this);
                            const selectedText = $select.find(':selected').text().toLowerCase();
                            const qty = parseInt($select.find(':selected').data('qty')) || 0;

                            const $posisiSelect = $row.find('.posisi-select');

                            // Aturan:
                            // 1. Jika ada kata "ban" → enable posisi
                            // 2. Jika qty <= 0 → enable posisi
                            // 3. Selain itu → disable posisi
                            if (selectedText.includes('ban') || qty <= 0) {
                                $posisiSelect.prop('disabled', false);
                            } else {
                                $posisiSelect.prop('disabled', true).val('').trigger('change'); // clear & disable
                            }

                            evaluateHeaderSumberVisibility(); // jika tetap digunakan
                        });

                        $row.find('.hapusRow').on('click', function () {
                            $(this).closest('tr').remove();
                            updateRowNumbers();
                            evaluateHeaderSumberVisibility();
                        });
                    }

                    function updateRowNumbers() {
                        $('#barangTable tbody tr').each(function (i) {
                            $(this).find('.no_urut').text(i + 1);
                        });
                    }

                    function evaluateHeaderSumberVisibility() {
                        let show = false;

                        $('#barangTable tbody tr').each(function () {
                            const qty = parseInt($(this).find('.sparepart-select option:selected').data('qty')) || 0;
                            if (qty <= 0) {
                                show = true;
                            }
                        });

                        // Hanya evaluasi header, jangan re-render konten row lagi
                        if (show) {
                            $('#th_posisi').show();
                        } else {
                            $('#th_posisi').show();
                        }
                    }

                    // Jika ada row default dari server, inisialisasi select2 dan event-nya
                    $('#barangTable tbody tr').each(function () {
                        const $row = $(this);
                        $row.find('.sparepart-select').select2({ width: '100%', dropdownParent: $row });
                        $row.find('.posisi-select').select2({ width: '100%', dropdownParent: $row });
                        bindEvents($row);
                    });

                    evaluateHeaderSumberVisibility();
                });
            </script>

            <script>
                function getQueryParam(param) {
                    const urlParams = new URLSearchParams(window.location.search);
                    return urlParams.get(param);
                }

                $(function () {
                    $("#tbl_daftarrute").DataTable({
                        "responsive": true, "lengthChange": false, "autoWidth": false,
                        "buttons": ["excel", "pdf", "print", "colvis"],
                        "columnDefs": [
                            { targets: [3], orderable: false}
                        ]
                    })
                    .buttons().container().appendTo('#tbl_daftarrute_wrapper .col-md-6:eq(0)');

                    // Prefill filter
                    $('#tgl_ritasi').val(getQueryParam('tgl'));
                    $('#tgl_klaim').val(getQueryParam('tgl_klaim'));
                    $('#nama_tim').val(getQueryParam('nama_tim'));
                    $('#nama_driver').val(getQueryParam('nama_driver'));
                    $('#no_pintu').val(getQueryParam('no_pintu'));
                    $('#nama_proyek').val(getQueryParam('nama_proyek'));
                    $('#lokasi_gali').val(getQueryParam('lokasi_gali'));

                    $('#nama_tim').trigger('change');
                    $('#nama_proyek').trigger('change');
                    $('#lokasi_gali').trigger('change');

                    // Bersihkan URL dari parameter tak perlu
                    window.history.replaceState({}, document.title, window.location.pathname + window.location.search.replace(/&?(jam|submit|ritasi_id|kendaraan)=[^&]*/g, ''));
                    
                    var table = $('#tbl_logritasi').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [[1, 'desc']],
                        "ajax": {
                            "url": "<?php echo site_url('routes/ajax_list'); ?>",
                            "type": "POST",
                            "data": function ( d ) {
                                d.tgl_ritasi = $('#tgl_ritasi').val();
                                d.nama_tim = $('#nama_tim').val();
                                d.nama_driver = $('#nama_driver').val();
                                d.no_pintu = $('#no_pintu').val();
                                d.nama_proyek = $('#nama_proyek').val();
                                d.lokasi_gali = $('#lokasi_gali').val();
                            }
                        },
                        "columns": [
                            { "data": "checkbox", "orderable": false, "className": "text-center" },
                            { "data": "tgl_ritasi" },
                            { "data": "nama_tim" },
                            { "data": "nama_proyek" },
                            { "data": "lokasi" },
                            { "data": "nama_driver" },
                            { "data": "no_pol" },
                            { "data": "no_pintu" },
                            { "data": "jam_angkut" },
                            { "data": "nomerdo" },
                            { "data": "uang_jalan", "className": "text-right" },
                            { "data": "aksi", "orderable": false }
                        ],
                        "responsive": true, "lengthChange": false, "searching": false,
                        "dom": "Bfrtip",
                        "buttons": [
                            "excel", "pdf", 
                            {
                                extend: "print",
                                footer: true, // ✅ memastikan <tfoot> ikut dicetak
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10] // kolom tertentu yang ikut di print
                                }
                            }, 
                            "colvis"
                        ],
                        drawCallback: function(settings) {
                            var api = this.api();
                            var data = api.rows({ page: 'current' }).data();

                            if (data.length === 0) {
                                Swal.fire({
                                    title: "Error",
                                    text: "Data tidak tersedia",
                                    icon: "error",
                                    confirmButtonText: "Tutup"
                                });
                            }
                        }

                    });
                    table.buttons().container().appendTo('#tbl_logritasi_wrapper .col-md-6:eq(0)');

                    $('#btn-filter').click(function(){
                        table.ajax.reload();
                    });

                    $('#btn-reset').click(function(){
                        $('#tgl_ritasi').val('');
                        $('#nama_tim').val('');
                        $('#nama_driver').val('');
                        $('#no_pintu').val('');
                        $('#nama_proyek').val('');
                        $('#lokasi_gali').val('');
                        table.ajax.reload();
                    });
                    
                    $(document).on('click', '.btn-edit-ritasi', function () {
                      const id = $(this).data('id');
                      $('#formEditRitasi').attr('action', `<?= site_url('routes/ritasiedit/') ?>${id}`);

                      $('#edit_ritasi_id').val(id);
                      $('#edit_tgl').val($(this).data('tgl'));
                      $('#edit_tim').val($(this).data('tim')).trigger('change');
                      $('#edit_proyek').val($(this).data('proyek')).trigger('change');
                      $('#edit_galian').val($(this).data('galian')).trigger('change');
                      $('#edit_kendaraan').val($(this).data('vehicle')).trigger('change');
                      $('#edit_jam').val($(this).data('jam'));
                      $('#edit_nodo').val($(this).data('nodo'));
                    });
                    $(document).on('click', '.btn-del-ritasi', function () {
                      const id = $(this).data('id');
                      $('#formDeleteRitasi').attr('action', `<?= site_url('routes/ritasidel/') ?>${id}`);
                    });

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
                        "buttons": ["excel", "pdf", "print", "colvis"],
                        "columnDefs": [
                            { targets: [3], orderable: false}
                        ]
                    })
                    .buttons().container().appendTo('#tbl_galian_wrapper .col-md-6:eq(0)');

                    $("#tbl_tim").DataTable({
                        "responsive": true, "lengthChange": false, "autoWidth": false, "searching": true,
                        "buttons": [
                            "excel", "pdf", 
                            {
                                extend: "print",
                                footer: true, // ✅ memastikan <tfoot> ikut dicetak
                                exportOptions: {
                                    columns: [0, 1] // kolom tertentu yang ikut di print
                                }
                            }, 
                            "colvis"
                        ],
                        "columnDefs": [
                            { targets: [2], orderable: false}
                        ]
                    })
                    .buttons().container().appendTo('#tbl_tim_wrapper .col-md-6:eq(0)');

                    $("#tbl_user").DataTable({
                        "responsive": true, "lengthChange": false, "autoWidth": false, "searching": true,
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
                        "responsive": true,
                        "lengthChange": false,
                        "autoWidth": false,
                        "searching": false,
                        "order": [[1, "asc"]], // 🔽 Urutkan kolom ke-1 (indeks 1) dari kecil ke besar
                        "buttons": [
                            "excel", "pdf",
                            {
                                extend: "print",
                                footer: true,
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4]
                                }
                            },
                            "colvis"
                        ],
                        "columnDefs": [
                            { targets: [0], orderable: false }
                        ]
                    })
                    .buttons().container().appendTo('#tbl_manajemenvehicles_wrapper .col-md-6:eq(0)');

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

                    $("#tbl_manajemenwallet_transactions").DataTable({
                        responsive: true,
                        lengthChange: false,
                        autoWidth: false,
                        paging: false,
                        searching: false,
                        buttons: [
                            "excel", 
                            "pdf", 
                            {
                                extend: "print",
                                footer: true, // ✅ memastikan <tfoot> ikut dicetak
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4] // Hanya kolom Nama, Balance, Update At
                                }
                            }, 
                            "colvis"
                        ],
                        columnDefs: [
                            { targets: [1,2,3,4], orderable: false }
                        ],
                        order: [[5, 'desc']]
                    })
                    .buttons().container().appendTo('#tbl_manajemenwallet_transactions_wrapper .col-md-6:eq(0)');

                    //Date and time picker
                    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

                    $('#tglan').datetimepicker({
                        format: 'DD-MM-YYYY'
                    });

                    $('#tglan_ritasi').datetimepicker({
                        format: 'DD-MM-YYYY'
                    });

                    $('#waktu').datetimepicker({
                        format: 'HH:mm'
                    });

                    $('#expiry_date').datetimepicker({
                        format: 'DD-MM-YYYY'
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
            <script>
                function autoFormatTanggal(input) {
                    const angka = input.value.replace(/\D/g, '').substring(0, 8); // hanya angka max 8 digit
                    let formatted = '';

                    if (angka.length > 0) formatted = angka.substring(0, 2);
                    if (angka.length > 2) formatted += '-' + angka.substring(2, 4);
                    if (angka.length > 4) formatted += '-' + angka.substring(4, 8);

                    // Simpan posisi kursor
                    const start = input.selectionStart;
                    const end = input.selectionEnd;

                    input.value = formatted;

                    // Hitung posisi baru setelah auto-format
                    const dashCount = (formatted.slice(0, start).match(/-/g) || []).length;
                    const offset = dashCount > 0 ? dashCount : 0;

                    // Set ulang posisi kursor
                    input.setSelectionRange(start + offset, end + offset);
                }

                function autoFormatJam(input) {
                    // Ambil hanya angka, maksimum 4 digit (HHMM)
                    const angka = input.value.replace(/\D/g, '').substring(0, 4);
                    let formatted = '';

                    // Simpan posisi kursor sebelum format
                    const oldPos = input.selectionStart;

                    if (angka.length <= 2) {
                        formatted = angka;
                    } else {
                        formatted = angka.substring(0, 2) + ':' + angka.substring(2, 4);
                    }

                    // Hitung selisih panjang input sebelum dan sesudah format
                    const diff = formatted.length - input.value.length;

                    // Masukkan hasil format
                    input.value = formatted;

                    // Set ulang posisi kursor (hindari error jika di akhir)
                    const newPos = Math.min(oldPos + diff, formatted.length);
                    input.setSelectionRange(newPos, newPos);
                }
            </script>
        <?php } ?>

        <?php if ($nopage == 4) { ?>
            <script>
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
                                                <input type="text" name="jam[]" class="form-control" oninput="autoFormatJam(this)" maxlength="5" placeholder="HH:MM"/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text datetimepicker-input" data-target="#jam-picker${value.vehicle_id}" data-toggle="datetimepicker"><i class="far fa-clock"></i></div>
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
                        format: 'DD-MM-YYYY'
                    });
                });

                <?php foreach ($kendaraans as $value): ?>
                    $('#jam-picker<?php echo $value->vehicle_id ?>').datetimepicker({
                        format: 'HH:mm'
                    });
                <?php endforeach; ?>
            </script>
            <script>
                // $(document).ready(function() {
                //     $('select[name="tim"]').on('change', function() {
                //         var timId = $(this).val();
                //         if (timId) {
                //             $.ajax({
                //                 url: "<?php echo site_url('routes/get_kendaraan_by_tim'); ?>",
                //                 type: "POST",
                //                 data: { tim_id: timId },
                //                 dataType: "json",
                //                 success: function(data) {
                //                     var kendaraanSelect = $('select[name="kendaraan"]');
                //                     kendaraanSelect.empty();
                //                     kendaraanSelect.append('<option value="">--- Pilih Kendaraan ---</option>');
                //                     $.each(data, function(key, value) {
                //                         kendaraanSelect.append('<option value="' + value.vehicle_id + '">' + value.no_pol + '</option>');
                //                     });
                //                 }
                //             });
                //         } else {
                //             $('select[name="kendaraan"]').html('<option value="">--- Pilih Kendaraan ---</option>');
                //         }
                //     });
                // });
            </script>
        <?php } ?>

        <?php if ($nopage==1041) { ?>
            <script>
                $('#tglEditLahir').datetimepicker({
                    format: 'DD-MM-YYYY'
                });
                $('#tglEditJoin').datetimepicker({
                    format: 'DD-MM-YYYY'
                });
                $('#tglEditOut').datetimepicker({
                    format: 'DD-MM-YYYY'
                });
                $('#tglEditExpSim').datetimepicker({
                    format: 'DD-MM-YYYY'
                });
                $('#tglAddLahir').datetimepicker({
                    format: 'DD-MM-YYYY'
                });
                $('#tglAddJoin').datetimepicker({
                    format: 'DD-MM-YYYY'
                });
                $('#tglAddOut').datetimepicker({
                    format: 'DD-MM-YYYY'
                });
                $('#tglAddExpSim').datetimepicker({
                    format: 'DD-MM-YYYY'
                });
                $('#tglCariJoin').datetimepicker({
                    format: 'DD-MM-YYYY'
                });
            </script>
            <script>
                $(function () {
                  $('[data-toggle="tooltip"]').tooltip()
                })
            </script>
            <script>
                var table;
                $(document).ready(function() {
                    table = $('#tbl_manajemensupir').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            "url": "<?php echo site_url('drivers/ajax_list') ?>",
                            "type": "POST",
                            "data": function ( d ) {
                                d.nmSupir = $('#nmSupir').val();
                                d.noPintu = $('#noPintu').val();
                                d.tglJoin = $('#tglJoin').val();
                                d.statusSupir = $('#statusSupir').val();
                            }
                        },
                        "responsive": true, "lengthChange": false, "autoWidth": false, "searching": false,"dom": "Bfrtip",
                        "buttons": [
                            "excel", "pdf", 
                            {
                                extend: "print",
                                footer: true, // ✅ memastikan <tfoot> ikut dicetak
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7] // kolom tertentu yang ikut di print
                                }
                            }, 
                            "colvis"
                        ],
                        "columnDefs": [
                            { targets: [7, 8], orderable: false}
                        ],
                        "order": [[0, 'asc']]
                    });

                    $('#btn-filter').click(function(){
                        table.ajax.reload();
                    });

                    $('#btn-reset').click(function(){
                        $('#nmSupir').val('');
                        $('#noPintu').val('');
                        $('#tglJoin').val('');
                        $('#statusSupir').val('');
                        table.ajax.reload();
                    });

                    $('#btnSave').click(function() {
                        var form = $('#form1')[0];           // Ambil elemen DOM form
                        var formData = new FormData(form);   // Buat FormData dari form
                        $.ajax({
                            url: "<?php echo site_url('drivers/ajax_update')?>",
                            type: "POST",
                            data: formData,
                            dataType: "JSON",
                            processData: false, // Wajib false untuk FormData
                            contentType: false, // Wajib false untuk FormData
                            success: function(data) {
                                $('#mdl_editSupir').modal('hide');
                                window.location.href = "<?php echo site_url('drivers'); ?>";
                            }
                        });
                    });

                    $('#btnDel').click(function() {
                        $.ajax({
                            url: "<?php echo site_url('drivers/ajax_delete')?>",
                            type: "POST",
                            data: $('#form2').serialize(),
                            dataType: "JSON",
                            success: function(data) {
                                $('#mdl_delSupir').modal('hide');
                                window.location.href = "<?php echo site_url('drivers'); ?>";
                            }
                        });
                    });
                });

                function edit_driver(id) {
                    $.ajax({
                        url: "<?php echo site_url('drivers/ajax_edit')?>/" + id,
                        type: "GET",
                        dataType: "JSON",
                        success: function(data) {
                            $('[name="id"]').val(data.id);
                            $('[name="nmSupir"]').val(data.name);
                            $('[name="tmpLahir"]').val(data.tempat_lahir);
                            $('[name="tglLahir"]').val(data.tgl_lahir);
                            $('[name="noNIK"]').val(data.nik);
                            $('[name="tglJoin"]').val(data.tgl_join);
                            $('[name="tglKeluar"]').val(data.tgl_keluar);
                            $('[name="noHp"]').val(data.phone);
                            $('[name="noDarurat"]').val(data.nomor_darurat);
                            $('[name="noSim"]').val(data.license_number);
                            $('[name="tglExpSim"]').val(data.tgl_exp_sim);
                            $('[name="alamat"]').val(data.alamat);
                            $('[name="statusSupir"]').val(data.status);
                            $('[name="keterangan"]').val(data.keterangan);
                            $('[name="fileFotoLama"]').val(data.img_profile);
                            $('[name="fileSimLama"]').val(data.img_sim);
                            $('[name="fileKtpLama"]').val(data.img_ktp);
                            $('#mdl_editSupir').modal('show');
                        }
                    });
                }

                function delete_driver(id) {
                    $.ajax({
                        url: "<?php echo site_url('drivers/ajax_del')?>/" + id,
                        type: "GET",
                        dataType: "JSON",
                        success: function(data) {
                            $('[name="id"]').val(data.id);
                            $('#mdl_delSupir').modal('show');
                        }
                    });
                }

                function view_files(files) {
                    var html = "";
                    if (files.length === 0) {
                        html = "<p class='text-danger'>Tidak ada file terlampir.</p>";
                    } else {
                        for (var i = 0; i < files.length; i++) {
                            var url = files[i];
                            var extension = url.split('.').pop().toLowerCase();
                            
                            html += "<div class='mb-3'>";
                            if (extension === 'pdf') {
                                html += "<iframe src='"+url+"' width='100%' height='400px'></iframe>";
                            } else if (['jpg','jpeg','png','gif'].includes(extension)) {
                                html += "<img src='"+url+"' class='img-fluid'/>";
                            } else {
                                html += "<a href='"+url+"' target='_blank' class='btn btn-primary'>Download File</a>";
                            }
                            html += "</div>";
                            html += "<hr/>";
                        }
                    }
                    $('#filePreview').html(html);
                    $('#mdl_imgSupir').modal('show');
                }
            </script>
            <script>
                var tableWallet;
                $(document).ready(function() {
                    tableWallet = $('#tbl_manajemenwallet').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            "url": "<?php echo site_url('drivers/ajax_listwallet')?>",
                            "type": "POST",
                            "data": function ( d ) {
                                d.nmSupir = $('#nmSupir').val();
                                d.statusWallet = $('#statusWallet').val();
                            }
                        },
                        "responsive": true, "lengthChange": false, "autoWidth": false, "searching": false,"dom": "Bfrtip",
                        "buttons": [
                            "excel", "pdf", 
                            {
                                extend: "print",
                                footer: true, // ✅ memastikan <tfoot> ikut dicetak
                                exportOptions: {
                                    columns: [0, 1, 2, 3] // kolom tertentu yang ikut di print
                                }
                            }, 
                            "colvis"
                        ],
                        "columnDefs": [
                            { targets: [4], orderable: false}
                        ],
                        "order": [[0, 'asc']]
                    });

                    $('#btnFilter').click(function(){
                        tableWallet.ajax.reload();
                    });

                    $('#btnReset').click(function(){
                        $('#nmSupir').val('');
                        $('#statusWallet').val('');
                        tableWallet.ajax.reload();
                    });
                });
            </script>
        <?php } ?>

        <?php if ($nopage == 1041) { ?>
            <script>
                $(document).ready(function () {
                    $('div[id^="mdl_wallet"]').on('shown.bs.modal', function () {
                        const table = $(this).find('table.table');

                        // Jika belum diinisialisasi DataTable, inisialisasi
                        if (!$.fn.DataTable.isDataTable(table)) {
                            table.DataTable({
                                responsive: true,
                                paging: false,
                                lengthChange: false,
                                autoWidth: false,
                                searching: false,
                                columnDefs: [{ targets: [0,1,2,3,4,5], orderable: false}],
                                buttons: [
                                    "excel",
                                    "pdf",
                                    {
                                        extend: "print",
                                        footer: true,
                                        title: table.closest('.modal').find('.modal-title').text()
                                    },
                                    "colvis"
                                ]
                            }).buttons().container()
                              .appendTo(table.closest('.dataTables_wrapper').find('.col-md-6:eq(0)'));
                        }
                    });
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
                $('.datepicker').datetimepicker({ format: 'DD-MM-YYYY' });
                $('.select2').select2();
            </script>
            <?php if ($this->session->flashdata('pdf_url')): ?>
            <script>
                window.open("<?= $this->session->flashdata('pdf_url') ?>", "_blank");
            </script>
            <?php endif; ?>
        <?php } ?>

        <?php if ($nopage == 1072) { ?>
            <script>
                var tableKlaimWallet;
                $(document).ready(function() {
                    tableKlaimWallet = $('#tbl_reimburse_done').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            "url": "<?php echo site_url('wallet/ajax_listklaimwallet')?>",
                            "type": "POST",
                            "data": function ( d ) {
                                d.nmSupir = $('#nmSupir').val();
                                d.blnKlaim = $('#blnKlaim').val();
                                d.thnKlaim = $('#thnKlaim').val();
                            }
                        },
                        "responsive": true, "lengthChange": false, "autoWidth": false, "searching": false,"dom": "Bfrtip",
                        "buttons": [
                            "excel", "pdf", 
                            {
                                extend: "print",
                                footer: true, // ✅ memastikan <tfoot> ikut dicetak
                                exportOptions: {
                                    columns: [0, 1, 2, 3] // kolom tertentu yang ikut di print
                                }
                            }, 
                            "colvis"
                        ],
                        "columnDefs": [
                            { targets: [3], orderable: false},
                            { targets: 0, type: 'date-eu' } // supaya format dd-mm-yyyy bisa di-sort benar
                        ],
                        "order": [[0, 'desc']],
                        footerCallback: function (row, data, start, end, display) {
                            var api = this.api();

                            // fungsi untuk ubah "Rp 10.000" → 10000
                            var intVal = function (i) {
                                return typeof i === 'string'
                                    ? i.replace(/[\Rp\s.]/g, '') * 1
                                    : typeof i === 'number'
                                    ? i
                                    : 0;
                            };

                            // Total semua halaman
                            var total = api
                                .column(2, { search: 'applied' })
                                .data()
                                .reduce(function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);

                            // Total halaman aktif
                            var pageTotal = api
                                .column(2, { page: 'current' })
                                .data()
                                .reduce(function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);

                            // Tampilkan di footer
                            $(api.column(2).footer()).html(
                                'Rp ' + pageTotal.toLocaleString('id-ID')
                            );
                        }
                    });

                    $('#btnFilter').click(function(){
                        tableKlaimWallet.ajax.reload();
                    });

                    $('#btnReset').click(function(){
                        $('#nmSupir').val('');
                        $('#blnKlaim').val('');
                        $('#thnKlaim').val('');
                        tableKlaimWallet.ajax.reload();
                    });
                });
            </script>
        <?php } ?>

        <?php if ($nopage == 1100) { ?>
            <script>
                var tableInvBaru;
                $(document).ready(function() {
                    tableInvBaru = $('#tbl_inventoryBaru').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            "url": "<?php echo site_url('inventori/ajax_listinvbaru')?>",
                            "type": "POST",
                            "data": function ( d ) {
                                d.nmBarang = $('#nmBarang').val();
                                d.filter_qty = filterQty;
                            }
                        },
                        "responsive": true, "lengthChange": false, "autoWidth": false, "searching": false,"dom": "Bfrtip",
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
                        ],
                        "order": [[0, 'asc']]
                    });

                    var filterQty = ''; // default tanpa filter
                    
                    $('#btnFilter').click(function(){
                        tableInvBaru.ajax.reload();
                    });

                    $('#btnReset').click(function(){
                        $('#nmBarang').val('');
                        filterQty = '';
                        tableInvBaru.ajax.reload();
                    });

                    $('#stokHabisBox').on('click', function() {
                        filterQty = 'habis'; // set filter
                        tableInvBaru.ajax.reload();
                    });
                });

                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            </script>
        <?php } ?>

        <?php if ($nopage == 1102) { ?>
            <script>
                var tablePengajuan;
                $(document).ready(function() {
                    tablePengajuan = $('#tbl_pengajuan').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            "url": "<?php echo site_url('inventori/ajax_listPengajuan')?>",
                            "type": "POST",
                            "data": function ( d ) {
                                d.tglPengajuan = $('#tglPengajuan').val();
                            }
                        },
                        "responsive": true, "lengthChange": false, "autoWidth": false, "searching": false,"dom": "Bfrtip",
                        "buttons": [
                            "excel", "pdf", 
                            {
                                extend: "print",
                                footer: true, // memastikan <tfoot> ikut dicetak
                                exportOptions: {
                                    columns: [0, 1, 2, 3] // kolom tertentu yang ikut di print
                                }
                            }, 
                            "colvis"
                        ],
                        "columnDefs": [
                            { targets: [0, 4], orderable: false}
                        ],
                        "order": [[1, 'desc']]
                    });

                    $('#btnFilter').click(function(){
                        tablePengajuan.ajax.reload();
                    });

                    $('#btnReset').click(function(){
                        $('#tglPengajuan').val('');
                        tablePengajuan.ajax.reload();
                    });
                });

                $('#tglFilter').datetimepicker({
                    format: 'DD-MM-YYYY'
                });
            </script>
        <?php } ?>

        <?php if ($nopage == 1103) { ?>
            <script>
                $("#tbl_inventoryBaruDtl").DataTable({
                    responsive: true,
                    lengthChange: false,
                    autoWidth: false,
                    paging: false,
                    searching: false,
                    buttons: [
                        "excel", 
                        "pdf", 
                        {
                            extend: "print",
                            footer: true, // ✅ memastikan <tfoot> ikut dicetak
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4] // Hanya kolom Nama, Balance, Update At
                            }
                        }, 
                        "colvis"
                    ],
                    columnDefs: [
                        { targets: [0,1,2,3], orderable: false }
                    ],
                    order: [[4, 'desc']]
                })
                .buttons().container().appendTo('#tbl_inventoryBaruDtl_wrapper .col-md-6:eq(0)');
            </script>
        <?php } ?>

        <?php if ($nopage == 1400) { ?>
            <script>
                var tableVendor;
                var filterQty = ''; // default tanpa filter
                $(document).ready(function() {
                    tableVendor = $('#tbl_vendor').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            "url": "<?php echo site_url('vendors/ajax_listvendor')?>",
                            "type": "POST",
                            "data": function ( d ) {
                                d.nmVendor = $('#nmVendor').val();
                                d.filter_qty = filterQty;
                            }
                        },
                        "responsive": true, "lengthChange": false, "autoWidth": false, "searching": false,"dom": "Bfrtip",
                        "buttons": [
                            "excel", "pdf", 
                            {
                                extend: "print",
                                footer: true,
                                exportOptions: {
                                    columns: [0, 1, 2] // kolom tertentu yang ikut di print
                                }
                            }, 
                            "colvis"
                        ],
                        "columnDefs": [
                            { targets: [3], orderable: false}
                        ],
                        "order": [[0, 'asc']]
                    });
                    
                    $('#btnFilter').click(function(){
                        tableVendor.ajax.reload();
                    });
                    $('#btnReset').click(function(){
                        $('#nmVendor').val('');
                        filterQty = '';
                        tableVendor.ajax.reload();
                    });
                    $('#btnSave').click(function() {
                        var form = $('#form2')[0];           // Ambil elemen DOM form
                        var formData = new FormData(form);   // Buat FormData dari form
                        $.ajax({
                            url: "<?php echo site_url('vendors/ajax_update')?>",
                            type: "POST",
                            data: formData,
                            dataType: "JSON",
                            processData: false, // Wajib false untuk FormData
                            contentType: false, // Wajib false untuk FormData
                            success: function(data) {
                                $('#mdl_editVendor').modal('hide');
                                window.location.href = "<?php echo site_url('vendors'); ?>";
                            }
                        });
                    });

                    $('#btnDel').click(function() {
                        var form = $('#form3')[0];           // Ambil elemen DOM form
                        var formData = new FormData(form);   // Buat FormData dari form
                        $.ajax({
                            url: "<?php echo site_url('vendors/ajax_delete')?>",
                            type: "POST",
                            data: formData,
                            dataType: "JSON",
                            processData: false, // Wajib false untuk FormData
                            contentType: false, // Wajib false untuk FormData
                            success: function(data) {
                                $('#mdl_delVendor').modal('hide');
                                window.location.href = "<?php echo site_url('vendors'); ?>";
                            }
                        });
                    });
                });

                function edit_vendor(id) {
                    $.ajax({
                        url: "<?php echo site_url('vendors/ajax_edit')?>/" + id,
                        type: "GET",
                        dataType: "JSON",
                        success: function(data) {
                            $('[name="id"]').val(data.id);
                            $('[name="nmVendor"]').val(data.name);
                            // Cek kondisi no_po
                            if (data.no_po === null || data.no_po === '') {
                                // Mode editable
                                $('#kode_editable').show()
                                    .find('input[type="text"]').val(data.kode).attr('name', 'kodeVendor'); // aktifkan name
                                $('#kode_readonly').hide()
                                    .find('input[type="hidden"]').removeAttr('name'); // nonaktifkan name
                            } else {
                                // Mode readonly
                                $('#kode_editable').hide()
                                    .find('input[type="text"]').removeAttr('name'); // nonaktifkan name
                                $('#kode_readonly').show();
                                $('#kode_readonly input[type="text"]').val(data.kode);
                                $('#kode_readonly input[type="hidden"]').val(data.kode).attr('name', 'kodeVendor'); // aktifkan name
                            }
                            $('[name="picVendor"]').val(data.pic);
                            $('[name="noTelpVendor"]').val(data.phone);
                            $('[name="statusVendor"]').val(data.status);
                            $('[name="alamatVendor"]').val(data.address);
                            $('#mdl_editVendor').modal('show');
                        }
                    });
                }

                function delete_vendor(id) {
                    $.ajax({
                        url: "<?php echo site_url('vendors/ajax_del')?>/" + id,
                        type: "GET",
                        dataType: "JSON",
                        success: function(data) {
                            $('[name="id"]').val(data.id);
                            $('#mdl_delVendor').modal('show');
                        }
                    });
                }
            </script>
        <?php } ?>

        <?php if ($nopage == 1420) { ?>
            <script>
                var tableLog;
                $(document).ready(function() {
                    tableLog = $('#tbl_log').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            "url": "<?php echo site_url('log/ajax_listlog')?>",
                            "type": "POST",
                            "data": function ( d ) {
                                d.nmUser = $('#nmUser').val();
                                d.tglLog = $('#tglLog').val();
                            }
                        },
                        "responsive": true, "lengthChange": false, "autoWidth": false, "searching": false,"dom": "Bfrtip",
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
                            { targets: [2], orderable: false}
                        ],
                        "order": [[0, 'desc']]
                    });

                    $('#btnFilter').click(function(){
                        tableLog.ajax.reload();
                    });

                    $('#btnReset').click(function(){
                        $('#nmUser').val('');
                        $('#tglLog').val('');
                        tableLog.ajax.reload();
                    });
                });

                $('#tglFilter').datetimepicker({
                    format: 'DD-MM-YYYY'
                });
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
    </body>
</html>