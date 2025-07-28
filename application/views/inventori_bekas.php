            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6"><h1 class="m-0">Inventori</h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Inventori</li>
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
                    </div>

                    <!-- Filter -->
                    <div class="card card-outline card-primary">
                      <div class="card-header">
                        <h3 class="card-title">Filter Inventory</h3>
                      </div>
                      <div class="card-body">
                        <form class="form-row">
                          <div class="form-group col-md-4">
                            <label>No PO</label>
                            <input type="text" class="form-control" placeholder="Contoh: Nomor PO">
                          </div>
                          <div class="form-group col-md-4">
                            <label>Nama Barang</label>
                            <input type="text" class="form-control" placeholder="Contoh: Oli Mesin">
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
                          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalFormPO"><i class="fas fa-plus"></i> Tambah PO</button>
                        </div>
                      </div>
                      <div class="card-body table-responsive">
                        <table id="tbl_inventory" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Tanggal PO</th>
                              <th>No PO</th>
                              <th>Nama Barang</th>
                              <th>Qty</th>
                              <th>Sumber No Pintu</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td>2025-06-10</td>
                              <td>KMJP-DT/MS/0625-0001</td>
                              <td>Kampas Kopling</td>
                              <td>2</td>
                              <td>601</td>
                              <td>
                                <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                              </td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td>2025-06-10</td>
                              <td>KMJP-DT/MS/0625-0001</td>
                              <td>Baut nomor 20</td>
                              <td>2</td>
                              <td>503</td>
                              <td>
                                <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                              </td>
                            </tr>
                            <!-- Tambahkan data dummy lainnya jika perlu -->
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
                    <form id="formPO">
                      <div class="modal-header">
                        <h5 class="modal-title">Formulir Pengajuan Pembelian Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                      </div>
                      <div class="modal-body">

                        <!-- Header Form -->
                        <table class="table">
                          <tr><td>Nama</td><td><input type="text" name="nama" class="form-control"></td>
                              <td>Vendor</td><td><input type="text" name="vendor" class="form-control"></td></tr>
                          <tr><td>Jabatan</td><td><input type="text" name="jabatan" class="form-control"></td>
                              <td>Nama PIC</td><td><input type="text" name="pic" class="form-control"></td></tr>
                          <tr><td>Divisi</td><td><input type="text" name="divisi" class="form-control"></td>
                              <td>No Telp</td><td><input type="text" name="telp" class="form-control"></td></tr>
                          <tr><td>Tanggal</td><td><input type="date" name="tanggal" class="form-control"></td>
                              <td>No PO</td><td><input type="text" name="no_po" class="form-control"></td></tr>
                        </table>

                        <!-- Tabel Barang -->
                        <table class="table table-bordered" id="barangTable">
                          <thead class="thead-light">
                            <tr><th>No</th><th>Nama Barang</th><th>Qty</th><th>Harga</th><th>Jumlah</th><th>Aksi</th></tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="text-center">1</td>
                              <td><input name="nama_barang[]" class="form-control"></td>
                              <td><input type="number" name="qty[]" class="form-control" oninput="updateJumlah(this)"></td>
                              <td><input type="number" name="harga[]" class="form-control" oninput="updateJumlah(this)"></td>
                              <td><input type="text" name="jumlah[]" class="form-control" readonly></td>
                              <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
                            </tr>
                          </tbody>
                        </table>
                        <button type="button" class="btn btn-success btn-sm" onclick="addRow()">+ Tambah Barang</button>

                        <div class="text-right mt-3">
                          <strong>Grand Total:</strong> <span id="grandTotal">Rp 0</span>
                        </div>

                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan PO</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      </div>
                    </form>
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