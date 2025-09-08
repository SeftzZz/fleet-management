            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6"><h1 class="m-0">Pengajuan Barang Inventori</h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Pengajuan Barang Inventori</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.content-header -->

                <!-- Kartu Statistik -->
                <section class="content">
                  <!-- Tabel Data -->
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Data Pengajuan Barang</h3>
                      <div class="card-tools">
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalFormPO"><i class="fas fa-plus"></i> Tambah Pengajuan Barang</button>
                      </div>
                    </div>
                    <div class="card-body table-responsive">
                      <table id="tbl_inventory" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Nama</th>                            
                            <th>Status Pengajuan</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                foreach($pengajuan as $row) {
                            ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row->tanggal ?></td>
                                <td><?php echo $row->nama ?></td>
                                <td><?php echo $row->status ?></td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalDetailPO<?php echo $row->id ?>"><i class="fas fa-eye"></i></button>
                                    <?php if ($row->status != "Selesai") { ?>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#mdl_delPengajuan<?php echo $row->id ?>"><i class="fas fa-trash"></i></button>  
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
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
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <input type="text" name="jabatan" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Divisi</label>
                                    <input type="text" name="divisi" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <div class="input-group date" id="tanggal" data-target-input="nearest">
                                        <input type="text" name="tanggal" id="tanggal" value="<?php echo set_value('tanggal')?>" class="form-control" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" />
                                        <div class="input-group-append">
                                            <div class="input-group-text" data-target="#tanggal" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabel Barang -->
                        <table class="table table-bordered" id="barangInventoriTable">
                            <thead class="thead-light">
                                <tr><th>No</th><th>Nama Barang</th><th>Qty</th><th>Aksi</th></tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <button type="button" class="btn btn-success btn-sm" onclick="addRowInventori()">+ Tambah Barang</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="ajaxSavePengajuan()">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>

                <!-- Modal Detail PO -->
                <?php foreach ($pengajuan as $row) { ?>
                    <div class="modal fade" id="modalDetailPO<?php echo $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="modalDetailPOLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <form id="formPO">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Pengajuan Barang</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Tabel Barang -->
                                        <h5>ID Pengajuan: <?php echo $row->id; ?></h5>
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Barang</th>
                                                    <th>Qty</th>
                                                    <th>No PO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    // Inisialisasi array untuk mencegah undefined variable
                                                    $details = [];

                                                    // Query data detail
                                                    $this->db->select('*');
                                                    $this->db->from('form_pengajuan_detail'); 
                                                    $this->db->where('pengajuan_id', $row->id);
                                                    $query = $this->db->get();

                                                    if ($query->num_rows() > 0) {
                                                        $details = $query->result();
                                                    }
                                                ?>

                                                <?php $no = 1; foreach ($details as $row) { ?>
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?php echo $row->sparepart; ?></td>
                                                    <td><?php echo $row->qty; ?></td>
                                                    <td><?php echo !empty($row->no_po) ? $row->no_po : 'Belum tersedia'; ?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                  

              <?php foreach ($pengajuan as $row) { ?>
                <div class="modal fade" id="mdl_delPengajuan<?php echo $row->id ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Hapus Pengajuan</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="form3" name="form3" action="<?php echo site_url('inventori/pengajuandel/'.$row->id)?>" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Yakin menghapus data ini!</label>
                                                <input type="hidden" name="del" value="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div>
                                                <a href="<?php echo site_url('inventori/pengajuan') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

                                                <input type="submit" name="submit" class="btn btn-primary float-right" value="&nbsp;&nbsp;&nbsp;&nbsp;Ya&nbsp;&nbsp;&nbsp;&nbsp;">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
              <?php } ?>
