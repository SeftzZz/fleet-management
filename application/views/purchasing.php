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
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Data Purchasing</h3>
                    </div>
                    <div class="card-body table-responsive">
                      <table id="tbl_inventory" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Nama</th>                            
                            <th>Status Pengajuan</th>
                            <th width="11%">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $no = 1;
                            foreach($pengajuan as $row) {
                          ?>
                            <tr>
                              <td><?= $no++ ?></td>
                              <td><?= $row->tanggal ?></td>
                              <td><?= $row->nama ?></td>
                              <td><?= $row->status ?></td>
                              <td>
                                <a href="<?= base_url(
                                    ($row->status == 'Selesai' && $row->form_purchasing_id) 
                                      ? 'purchasing/submited/' . $row->id 
                                      : 'purchasing/detail/' . $row->id
                                    ) ?>" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <?php if ($row->status != "Pengajuan") { ?>
                                    <a href="<?= base_url('purchasing/print_purchasing/' . $row->form_purchasing_id) ?>" class="btn btn-sm btn-success" target="_blank">
                                        <i class="fas fa-print"></i>
                                    </a>
                                <?php } ?>
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

                <?php foreach ($pengajuan as $row) { ?>
                    <div class="modal fade" id="mdl_delPengajuan<?php echo $row->id ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Hapus Purchasing</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="form3" name="form3" action="<?php echo site_url('purchasing/pengajuandel/'.$row->id)?>" method="post" enctype="multipart/form-data">
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
                                                    <a href="<?php echo site_url('inventori/purchasing') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

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
              </div>