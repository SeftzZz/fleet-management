            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6"><h1 class="m-0">Purchasing</h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Purchasing</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.content-header -->

                <!-- Kartu Statistik -->
                <section class="content">
                  <!-- Tabel Data -->
                  <form id="formPO" method="post" action="<?php echo base_url('purchasing/simpan_purchasing') ?>">
                    <input type="hidden" name="pengajuan_id" value="<?php echo $pengajuan->id ?>">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Data Detail Purchasing</h3>
                      </div>
                      <div class="card-body table-responsive">
                        <div class="row">
                          <div class="col-md-6">
                            <!-- Header Form -->
                            <table class="table">
                              <tr><td>Nama</td><td><input type="text" name="nama_po" class="form-control" value=""></td>
                              <tr><td>Jabatan</td><td><input type="text" name="jabatan_po" class="form-control" value=""></td>
                              <tr><td>Divisi</td><td><input type="text" name="divisi_po" class="form-control" value=""></td>
                              <tr><td>Tanggal</td><td>
                                <div class="input-group date" id="tanggal_po" data-target-input="nearest">
                                    <input type="text" name="tanggal_po" id="tanggal_po" value="<?php echo set_value('tanggal_po')?>" class="form-control" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" />
                                    <div class="input-group-append">
                                        <div class="input-group-text" data-target="#tanggal_po" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                              </td>
                            </table>
                          </div>
                          <div class="col-md-6">
                            <!-- Tabel vendor -->
                            <table class="table table-bordered" id="vendorInventoriTable">
                              <thead class="thead-light">
                                <tr>
                                  <th>No</th>
                                  <th>Nama Vendor</th>
                                  <th width="20%">(Ceklis Jika dari BON)</th>
                                  <th>Nomor PO</th>
                                </tr>
                              </thead>
                              <tbody>
                              </tbody>
                            </table>
                            <!-- <button type="button" class="btn btn-success btn-sm" onclick="addRowVendorInventori()">+ Tambah Vendor</button> -->
                          </div>
                        </div>
                        <div class="text-right mb-3">
                          <strong>Grand Total:</strong> <strong id="grandTotal1">Rp 0</strong>
                        </div>

                        <!-- Tabel Barang -->
                        <table class="table table-bordered" id="barangPurchasingTable">
                          <thead class="thead-light">
                            <tr><th>No</th><th>Nama Barang</th><th width="10%">Qty</th><th>Vendor</th><th>Pilih Vendor (Jika ingin ganti)</th><th>Harga</th><th>Aksi</th></tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                        <!-- <button type="button" class="btn btn-success btn-sm" onclick="addRowInventori()">+ Tambah Barang</button> -->

                        <div class="text-right mt-3">
                          <strong>Grand Total:</strong> <strong id="grandTotal2">Rp 0</strong>
                        </div>
                      </div>
                      <div class="card-footer">
                        <a href="<?php echo base_url('inventori/purchasing') ?>" class="btn btn-secondary">Tutup</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </div>
                  </form>
                </section>

                <!-- Modal Vendor -->
                <div class="modal fade" id="vendorModal" tabindex="-1" role="dialog" aria-labelledby="vendorModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="vendorModalLabel">Pilih Vendor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>Nama Vendor</th>
                              <th>Harga</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody id="vendorModalTableBody">
                            <?php foreach ($vendors as $v): ?>
                              <tr class="vendor-row" data-vendor-id="<?= $v->id ?>">
                                <td><?= $v->name ?></td>
                                <td class="harga-col">-</td>
                                <td>
                                  <button class="btn btn-primary btn-sm"
                                    onclick="pilihVendorDariModal('<?= $v->id ?>', '<?= $v->name ?>')">Pilih</button>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
