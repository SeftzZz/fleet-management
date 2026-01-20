            <style>
              .btn-hapus, .btn-pilih-vendor {
                display: none !important;
              }
              #pilihVendor, #hapusPO {
                display: none !important;
              }
              form.readonly input,
              form.readonly select,
              form.readonly textarea {
                pointer-events: none;
                background-color: #e9ecef;
              }
            </style>

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
                  <form id="formPO" class="readonly">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Data Purchasing</h3>
                      </div>
                      <div class="card-body table-responsive">
                        <div class="row">
                          <div class="col-md-6">
                            <!-- Header Form -->
                            <table class="table">
                              <tr><td>Nama</td><td><input type="text" readonly name="nama" class="form-control" value="<?php echo $pengajuan->nama_po ?>"></td>
                              <tr><td>Jabatan</td><td><input type="text" readonly name="jabatan" class="form-control" value="<?php echo $pengajuan->jabatan_po ?>"></td>
                              <tr><td>Divisi</td><td><input type="text" readonly name="divisi" class="form-control" value="<?php echo $pengajuan->divisi_po ?>"></td>
                              <tr><td>Tanggal</td><td>
                                <div class="input-group date" id="tanggal" data-target-input="nearest">
                                    <input type="text" readonly name="tanggal" id="tanggal" value="<?php echo set_value('tanggal', $pengajuan->tanggal_po)?>" class="form-control" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" />
                                    <div class="input-group-append">
                                        <div class="input-group-text" data-target="#tanggal" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
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
                                  <th>dari BON</th>
                                  <th>Nomor PO</th>
                                </tr>
                              </thead>
                              <tbody>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="text-right mb-3">
                          <strong>Grand Total:</strong> <strong id="grandTotal1">Rp 0</strong>
                        </div>

                        <!-- Tabel Barang -->
                        <table class="table table-bordered" id="barangPurchasingTable">
                          <thead class="thead-light">
                            <tr>
                              <th>No</th>
                              <th>Nama Barang</th>
                              <th width="10%">Qty</th>
                              <th>Vendor</th>
                              <th>Harga</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                        <div class="text-right mt-3">
                          <strong>Grand Total:</strong> <strong id="grandTotal2">Rp 0</strong>
                        </div>
                      </div>
                      <div class="card-footer">
                        <a href="<?php echo base_url('inventori/purchasing') ?>" class="btn btn-secondary">Tutup</a>
                      </div>
                    </div>
                  </form>
                </section>
            </div>
