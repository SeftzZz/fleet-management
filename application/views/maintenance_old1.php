            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6"><h1 class="m-0">Rekapitulasi Ritasi</h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Rekapitulasi Ritasi</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.content-header -->

                <!-- Kartu Statistik -->
                <section class="content">
                    <div class="row">
                      <div class="col-lg-4 col-6">
                        <div class="small-box bg-info">
                          <div class="inner">
                            <h3>125</h3>
                            <p>Total Barang</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-boxes"></i>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 col-6">
                        <div class="small-box bg-warning">
                          <div class="inner">
                            <h3>18</h3>
                            <p>Stok Habis</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-exclamation-triangle"></i>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 col-6">
                        <div class="small-box bg-danger">
                          <div class="inner">
                            <h3>7</h3>
                            <p>Stok Bekas</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-tools"></i>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Filter -->
                    <div class="card card-outline card-primary">
                      <div class="card-header">
                        <h3 class="card-title">Filter Maintenance</h3>
                      </div>
                      <div class="card-body">
                        <form class="form-row">
                          <div class="form-group col-md-4">
                            <label>Nama Kendaraan</label>
                            <input type="text" name="nama_kendaraan" class="form-control" required>
                          </div>
                          <div class="form-group col-md-4">
                            <label>Nomor Pintu</label>
                            <input type="text" name="no_pintu" class="form-control" required>
                          </div>
                          <div class="form-group col-md-4">
                            <label>Tanggal Maintenance</label>
                            <input type="date" name="tanggal" class="form-control" required>
                          </div>
                          <div class="form-group col-md-12 mt-2">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                          </div>
                        </form>
                      </div>
                    </div>

                    <!-- Tabel Data -->
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Data Barang</h3>
                        <div class="card-tools">
                          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalFormPO"><i class="fas fa-plus"></i> Tambah Maintenance Kendaraan</button>
                        </div>
                      </div>
                      <div class="card-body table-responsive">
                        <table class="table table-bordered mt-3">
                          <thead class="thead-light">
                            <tr>
                              <th>#</th>
                              <th>Nama Kendaraan</th>
                              <th>No Polisi</th>
                              <th>Tanggal</th>
                              <th>Jenis</th>
                              <th>Biaya</th>
                              <th>Keterangan</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td>Truck Hino 500</td>
                              <td>B 9123 XY</td>
                              <td>2025-07-10</td>
                              <td>Service Berkala</td>
                              <td>750000</td>
                              <td>Ganti oli, filter solar</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                </section>
              </div>

              <!-- Modal Form PO -->
              <div class="modal fade" id="modalFormPO" tabindex="-1" role="dialog" aria-labelledby="modalFormPOLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Formulir Pengajuan Pembelian Barang</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">

                      <form id="maintenanceForm">
                        <div class="form-row">
                          <div class="form-group col-md-4">
                            <label>Nama Kendaraan</label>
                            <input type="text" name="nama_kendaraan" class="form-control" required>
                          </div>
                          <div class="form-group col-md-4">
                            <label>Nomor Pintu</label>
                            <input type="text" name="no_pintu" class="form-control" required>
                          </div>
                          <div class="form-group col-md-4">
                            <label>Tanggal Maintenance</label>
                            <input type="date" name="tanggal" class="form-control" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label>Jenis Maintenance</label>
                          <select name="jenis" class="form-control" required>
                            <option value="">Pilih...</option>
                            <option>Service Berkala</option>
                            <option>Penggantian Sparepart</option>
                            <option>Perbaikan Kerusakan</option>
                            <option>Pengecekan Rutin</option>
                          </select>
                        </div>

                        <div class="form-group">
                          <label>Catatan / Keterangan</label>
                          <textarea name="catatan" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                          <label>Biaya (Rp)</label>
                          <input type="number" name="biaya" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </form> 
                      <!-- <form id="sparepartForm">
                        <div class="form-row">
                          <div class="form-group col-md-4">
                            <label>Kendaraan Tujuan</label>
                            <select id="kendaraanTujuan" class="form-control" onchange="checkQuota()">
                              <option value="">-- Pilih Kendaraan --</option>
                              <option value="A">Truck A (Quota: 0)</option>
                              <option value="B">Truck B (Quota: 2)</option>
                            </select>
                          </div>
                          <div class="form-group col-md-4">
                            <label>Jenis Spare Part</label>
                            <select id="jenisPart" class="form-control">
                              <option>Ban</option>
                              <option>Rem</option>
                              <option>Aki</option>
                            </select>
                          </div>
                          <div class="form-group col-md-4">
                            <label>Jumlah yang Dibutuhkan</label>
                            <input type="number" id="jumlahButuh" class="form-control" min="1" value="1">
                          </div>
                        </div>

                        <div id="formTransfer" class="hidden mt-4 border p-3 bg-light">
                          <h5>Transfer Spare Part dari Kendaraan Lain</h5>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                              <label>Kendaraan Sumber</label>
                              <select id="kendaraanSumber" class="form-control">
                                <option value="B">Truck B (Quota: 2)</option>
                                <option value="C">Truck C (Quota: 1)</option>
                              </select>
                            </div>
                            <div class="form-group col-md-6">
                              <label>Jumlah yang Dipinjam</label>
                              <input type="number" id="jumlahTransfer" class="form-control" min="1">
                            </div>
                          </div>
                        </div>

                        <div id="formBan" class="hidden mt-4 border p-3 bg-warning-subtle">
                          <h5>Pengecekan Penggantian Ban</h5>
                          <div class="form-group">
                            <label>Status Pembelian Ban</label>
                            <select class="form-control">
                              <option value="">-- Pilih --</option>
                              <option>Sudah Dibeli</option>
                              <option>Belum Dibeli</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Status Pemasangan Ban</label>
                            <select class="form-control">
                              <option value="">-- Pilih --</option>
                              <option>Sudah Terpasang</option>
                              <option>Belum Terpasang</option>
                            </select>
                          </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                      </form> -->                   
                    </div>
                  </div>
                </div>
              </div>
              <script>
                function addRow() {
                  const table = document.getElementById("barangTable").getElementsByTagName('tbody')[0];
                  const rowCount = table.rows.length;
                  const newRow = table.insertRow();
                  newRow.innerHTML = `
                    <td class="text-center">${rowCount + 1}</td>
                    <td><textarea name="nama_barang[]" class="form-control"></textarea></td>
                    <td><input type="number" name="qty[]" class="form-control" oninput="updateJumlah(this)"></td>
                    <td><input type="number" name="harga[]" class="form-control" oninput="updateJumlah(this)"></td>
                    <td><input type="text" name="jumlah[]" class="form-control" readonly></td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
                  `;
                }

                function removeRow(button) {
                  const row = button.closest('tr');
                  row.remove();
                  updateGrandTotal();
                  updateRowNumbers();
                }

                function updateJumlah(input) {
                  const row = input.closest('tr');
                  const qty = parseFloat(row.querySelector('[name="qty[]"]').value) || 0;
                  const harga = parseFloat(row.querySelector('[name="harga[]"]').value) || 0;
                  const jumlah = qty * harga;
                  row.querySelector('[name="jumlah[]"]').value = jumlah.toLocaleString('id-ID');
                  updateGrandTotal();
                }

                function updateGrandTotal() {
                  let total = 0;
                  document.querySelectorAll('[name="jumlah[]"]').forEach(input => {
                    total += parseInt(input.value.replace(/\./g, '').replace(/[^0-9]/g, '')) || 0;
                  });
                  document.getElementById("grandTotal").innerText = "Rp " + total.toLocaleString('id-ID');
                }

                function updateRowNumbers() {
                  const rows = document.querySelectorAll('#barangTable tbody tr');
                  rows.forEach((row, index) => {
                    row.querySelector('td').innerText = index + 1;
                  });
                }
              </script>
              <script>
                function checkQuota() {
                  const tujuan = document.getElementById('kendaraanTujuan').value;
                  const jenis = document.getElementById('jenisPart').value;
                  const transfer = document.getElementById('formTransfer');
                  const ban = document.getElementById('formBan');

                  if (tujuan === 'A') {
                    transfer.classList.remove('hidden');
                  } else {
                    transfer.classList.add('hidden');
                  }

                  if (jenis === 'Ban') {
                    ban.classList.remove('hidden');
                  } else {
                    ban.classList.add('hidden');
                  }
                }

                document.getElementById('jenisPart').addEventListener('change', checkQuota);
              </script>