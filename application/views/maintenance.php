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
                        <a class="btn btn-primary btn-sm" href="<?php echo base_url('maintenance/addmaintenance') ?>"><i class="fas fa-plus"></i> Tambah Maintenance Kendaraan</a>
                      </div>
                    </div>
                    <div class="card-body table-responsive">
                      <table class="table table-bordered mt-3">
                        <thead class="thead-light">
                          <tr>
                            <th>#</th>
                            <th>No Pintu</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Type</th>
                            <th>Diajukan Oleh</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $no = 1;
                            foreach($maintenances as $row) {
                          ?>
                            <tr>
                              <td><?php echo $no++ ?></td>
                              <td><?php echo $row->no_pintu ?></td>
                              <td><?php echo $row->tgl_order ?></td>
                              <td><?php echo $row->tgl_selesai ?></td>
                              <td><?php echo $row->type ?></td>
                              <td><?php echo $row->requester ?></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </section>
              </div>