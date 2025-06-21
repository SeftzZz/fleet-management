            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6"><h1 class="m-0">Manajemen Reimbursement</h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Manajemen Reimbursement</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Filter Manajemen Reimbursement</h3>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                  </button>
                                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                  </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="form1" name="form1" action="<?php echo site_url('reimbursement')?>" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Tanggal</label>
                                            <div class="input-group date" id="tglan_ritasi" data-target-input="nearest">
                                                <input type="text" name="tanggal" value="<?php echo set_value('tanggal')?>" class="form-control datetimepicker-input" data-target="#tglan_ritasi" data-toggle="datetimepicker" />
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nama Tim</label>
                                                <select name="tim" class="form-control" style="width:100%;">
                                                        <option value="">Semua Tim</option>
                                                        <?php foreach ($tims as $value) { ?>
                                                            <option value='<?php echo $value->id; ?>' <?php echo set_select('tim', $value->id );?>><?php echo 'Tim '.$value->nama_tim; ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nama Proyek</label>
                                                <select name="proyek" class="form-control" style="width:100%;">
                                                        <option value="">Semua Proyek</option>
                                                        <?php foreach ($proyeks as $value) { ?>
                                                            <option value='<?php echo $value->id; ?>' <?php echo set_select('proyek', $value->id );?>><?php echo 'Proyek '.$value->nama_proyek; ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Lokasi Galian</label>
                                                <select name="galian" class="form-control" style="width:100%;">
                                                        <option value="">Semua Lokasi</option>
                                                        <?php foreach ($galians as $value) { ?>
                                                            <option value='<?php echo $value->id; ?>' <?php echo set_select('galian', $value->id );?>><?php echo $value->lokasi; ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <center>
                                                <a href="<?php echo site_url('reimbursement') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reset&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="submit" name="submit" class="btn btn-primary" value="&nbsp;&nbsp;&nbsp;&nbsp;Filter&nbsp;&nbsp;&nbsp;&nbsp;">
                                            </center>
                                        </div>
                                    </div>  
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="log_ritasi_tab" data-toggle="pill" href="#log_ritasi" role="tab" aria-controls="log_ritasi" aria-selected="false">Manajemen Reimbursement</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="statistik_tab" data-toggle="pill" href="#statistik" role="tab" aria-controls="statistik" aria-selected="false">Statistik Ritasi</a>
                                    </li>
                                </ul>
                                <div class="tab-custom-content2">
                                    <p class="lead mb-0">&nbsp;</p>
                                </div>
                                <div class="tab-content" id="custom-content-below-tabContent">
                                    <div class="tab-pane fade show active" id="log_ritasi" role="tabpanel" aria-labelledby="log_ritasi_tab">
                                        <?php if (!empty($ritasi_list)): ?>
                                            <h5>List Kendaraan & Uang Jalan</h5>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No. Polisi</th>
                                                        <th>Uang Jalan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $total = 0;
                                                        foreach ($ritasi_list as $row): 
                                                            $total += $row->uang_jalan;
                                                    ?>
                                                        <tr>
                                                            <td><?= $row->no_pol ?></td>
                                                            <td>Rp <?= number_format($row->uang_jalan, 0, ',', '.') ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td><strong>Total Reimburse</strong></td>
                                                        <td><strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <form method="post" action="<?= site_url('reimbursement/submit_reimburse') ?>">
                                                <input type="hidden" name="tanggal" value="<?= $this->input->post('tanggal') ?>">
                                                <input type="hidden" name="proyek" value="<?= $this->input->post('proyek') ?>">
                                                <input type="hidden" name="galian" value="<?= $this->input->post('galian') ?>">
                                                <input type="hidden" name="tim" value="<?= $this->input->post('tim') ?>">

                                                <?php foreach ($ritasi_list as $row): ?>
                                                    <input type="hidden" name="ritasi_ids[]" value="<?= $row->id ?>">
                                                <?php endforeach; ?>

                                                <button type="submit" class="btn btn-success mt-3">Submit Reimburse</button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                    <div class="tab-pane fade" id="statistik" role="tabpanel" aria-labelledby="statistik_tab">
                                        <?php if (!empty($reimbursements_done)): ?>
                                            <h5>Data Reimbursement Selesai</h5>
                                            <table class="table table-bordered table-striped" id="tbl_reimburse_done">
                                                <thead>
                                                    <tr>
                                                        <th>Tanggal Ritasi</th>
                                                        <th>No. Polisi</th>
                                                        <th>Deskripsi</th>
                                                        <th>Amount (Rp)</th>
                                                        <th>Waktu Update</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $total = 0;
                                                        foreach ($reimbursements_done as $row):
                                                            $total += $row->amount;
                                                    ?>
                                                        <tr>
                                                            <td><?= date('d-m-Y', strtotime($row->tgl_ritasi)) ?></td>
                                                            <td><?= $row->no_pol ?></td>
                                                            <td><?= $row->description ?></td>
                                                            <td>Rp <?= number_format($row->amount, 0, ',', '.') ?></td>
                                                            <td><?= date('d-m-Y H:i', strtotime($row->updated_at)) ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td><strong>Total Reimburse Done</strong></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></td>
                                                        <td></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        <?php else: ?>
                                            <p class="text-muted">Belum ada data reimbursement yang selesai.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">&nbsp;</div>

                    <div class="modal fade" id="mdl_tmbhLog">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Supir Baru</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="form4" name="form4" action="<?php echo site_url('drivers/supiradd')?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="text" name="nmSupir" value="<?php echo set_value('nmSupir')?>" class="form-control <?php if (form_error('nmSupir')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Tgl. Lahir</label>
                                                    <div class="input-group date" id="tglAddLahir" data-target-input="nearest">
                                                        <input type="date" name="tglLahir" value="<?php echo set_value('tglLahir')?>" class="form-control <?php if (form_error('tglLahir')) {echo "is-invalid";} ?> datetimepicker-input" data-target="#tglAddLahir" data-toggle="datetimepicker" />
                                                        <!-- <div class="input-group-append">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Tanggal Bergabung</label>
                                                    <div class="input-group date" id="tglAddJoin" data-target-input="nearest">
                                                        <input type="date" name="tglJoin" value="<?php echo set_value('tglJoin')?>" class="form-control <?php if (form_error('tglJoin')) {echo "is-invalid";} ?> datetimepicker-input" data-target="#tglAddJoin" data-toggle="datetimepicker" />
                                                        <!-- <div class="input-group-append">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Foto Supir</label>
                                                    <input type="file" name="fotoSupir" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>No. HP</label>
                                                    <input type="text" name="noHp" value="<?php echo set_value('noHp')?>" class="form-control <?php if (form_error('noHp')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>No. HP Darurat</label>
                                                    <input type="text" name="noDarurat" value="<?php echo set_value('noDarurat')?>" class="form-control <?php if (form_error('noDarurat')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Foto SIM</label>
                                                    <input type="file" name="fotoSim" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>No. SIM</label>
                                                    <input type="text" name="noSim" value="<?php echo set_value('noSim')?>" class="form-control <?php if (form_error('noSim')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Tgl. Exp. SIM</label>
                                                    <div class="input-group date" id="tglAddExpSim" data-target-input="nearest">
                                                        <input type="date" name="tglExpSim" value="<?php echo set_value('tglExpSim')?>" class="form-control <?php if (form_error('tglExpSim')) {echo "is-invalid";} ?> datetimepicker-input" data-target="#tglAddExpSim" data-toggle="datetimepicker" />
                                                        <!-- <div class="input-group-append">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                 <div class="form-group">
                                                    <label>Foto KTP</label>
                                                    <input type="file" name="fotoKtp" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                 <div class="form-group">
                                                    <label>Alamat</label>
                                                    <textarea rows="3" name="alamat" value="<?php echo set_value('alamat')?>" class="form-control <?php if (form_error('alamat')) {echo "is-invalid";} ?>"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Status Supir</label>
                                                    <select name="statusSupir" class="custom-select <?php if (form_error('statusSupir')) {echo "is-invalid";} ?>" style="width:100%;">
                                                        <option value=""/>--- Pilih Status Supir ---</option>
                                                        <?php 
                                                            $pilihanstatus=array("Aktif","Non Aktif");
                                                            foreach ($pilihanstatus as $value) { 
                                                        ?>
                                                            <option value='<?php echo $value; ?>' <?php echo set_select('statusSupir', $value);?> /><?php echo $value; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div>
                                                    <a href="<?php echo site_url('drivers') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                                    <input type="submit" name="submit" class="btn btn-primary float-right" value="&nbsp;&nbsp;&nbsp;&nbsp;Simpan&nbsp;&nbsp;&nbsp;&nbsp;">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.Main content -->
            </div>
            <!-- /.content-wrapper -->