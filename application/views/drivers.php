            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6"><h1 class="m-0">Manajemen Supir</h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Manajemen Supir</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6 col-6">
                                <div class="small-box callout callout-info">
                                    <div class="inner">
                                        <span>Total Saldo Wallet</span>
                                        <h3><?php echo $this->fppfunction->rupiah_ind($jmltotalsaldo) ?></h3>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-wallet"></i>
                                    </div>
                                    <p class="small-box-footer2">&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-up text-success"></i> <span class="text-success">14%</span> dari kemarin </p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-6">
                                <div class="small-box callout callout-success">
                                    <div class="inner">
                                        <span>Top Saldo Tertinggi</span>
                                        <h3><?php echo $this->fppfunction->rupiah_ind($jmlhighestsaldo) ?></h3>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-trophy"></i>
                                    </div>
                                    <p class="small-box-footer2">
                                        &nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-up text-success"></i> 
                                        <span class="text-success"><?php echo $nmhighestsaldo ?></span> 
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="card" style="z-index:99;">
                            <div class="card-header">
                                <h3 class="card-title">Filter Manajemen Supir</h3>
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
                                
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nama Supir</label>
                                                <input type="text" name="nmSupir" id="nmSupir" value="<?php echo set_value('nmSupir')?>" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>No. Pintu/Bak/Unit</label>
                                                <input type="text" name="noPintu" id="noPintu" value="<?php echo set_value('noPintu')?>" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tanggal Bergabung</label>
                                                <div class="input-group date" id="tglCariJoin" data-target-input="nearest">
                                                    <input type="text" name="tglJoin" id="tglJoin" value="<?php echo set_value('tglJoin')?>" class="form-control" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" />
                                                    <div class="input-group-append">
                                                        <div class="input-group-text" data-target="#tglCariJoin" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="statusSupir" id="statusSupir" class="custom-select" style="width:100%;">
                                                    <option value=""/>--- Pilih Status ---</option>
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
                                        <div class="col-md-12">
                                            <center>
                                                <button id="btn-reset" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;Reset&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <button id="btn-filter" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;Filter&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                            </center>
                                        </div>
                                    </div>  
                                
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="<?php echo site_url('drivers') ?>"/>Manajemen Supir</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo site_url('drivers/wallet') ?>"/>Manajemen Wallet Supir</a>
                                    </li>
                                </ul>
                                <div class="tab-custom-content2">
                                    <p class="lead mb-0">&nbsp;</p>
                                </div>
                                <div class="tab-content" id="custom-content-below-tabContent">
                                    <div class="tab-pane fade show active" id="mgmt_supir" role="tabpanel" aria-labelledby="mgmt_supir_tab">
                                        <p class="lead2 mb-3">
                                            Manajemen Supir
                                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#mdl_tmbhLog">
                                                <i class="fas fa-plus-square"></i>&nbsp;&nbsp;Tambah Supir
                                            </button>
                                        </p>
                                        <table id="tbl_manajemensupir" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Tgl. Gabung</th>
                                                    <th>No. HP</th>
                                                    <th>No. Darurat</th>
                                                    <th>No. SIM</th>
                                                    <th>No. Pintu/Bak/Unit</th>
                                                    <th>Status</th>
                                                    <th>Keterangan</th>
                                                    <th width="11%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Tgl. Gabung</th>
                                                    <th>No. HP</th>
                                                    <th>No. Darurat</th>
                                                    <th>No. SIM</th>
                                                    <th>No. Pintu/Bak/Unit</th>
                                                    <th>Status</th>
                                                    <th>Keterangan</th>
                                                    <th width="11%">Aksi</th>
                                                </tr>
                                            </tfoot>
                                        </table>
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
                                                    <label>Tempat Lahir</label>
                                                    <input type="text" name="tmpLahir" value="<?php echo set_value('tmpLahir')?>" class="form-control <?php if (form_error('tmpLahir')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Tgl. Lahir</label>
                                                    <div class="input-group date" id="tglAddLahir" data-target-input="nearest">
                                                        <input type="text" name="tglLahir" value="<?php echo set_value('tglLahir')?>" class="form-control <?php if (form_error('tglLahir')) {echo "is-invalid";} ?>" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" />
                                                        <div class="input-group-append">
                                                            <div class="input-group-text" data-target="#tglAddLahir" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>NIK</label>
                                                    <input type="text" name="noNIK" value="<?php echo set_value('noNIK')?>" class="form-control <?php if (form_error('noNIK')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Tanggal Bergabung</label>
                                                    <div class="input-group date" id="tglAddJoin" data-target-input="nearest">
                                                        <input type="text" name="tglJoin" value="<?php echo set_value('tglJoin')?>" class="form-control <?php if (form_error('tglJoin')) {echo "is-invalid";} ?>" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" />
                                                        <div class="input-group-append">
                                                            <div class="input-group-text" data-target="#tglAddJoin" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Tanggal Keluar</label>
                                                    <div class="input-group date" id="tglAddOut" data-target-input="nearest">
                                                        <input type="text" name="tglKeluar" value="<?php echo set_value('tglKeluar')?>" class="form-control <?php if (form_error('tglKeluar')) {echo "is-invalid";} ?>" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" />
                                                        <div class="input-group-append">
                                                            <div class="input-group-text" data-target="#tglAddOut" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                                        </div>
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
                                                        <input type="text" name="tglExpSim" value="<?php echo set_value('tglExpSim')?>" class="form-control <?php if (form_error('tglExpSim')) {echo "is-invalid";} ?>" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" />
                                                        <div class="input-group-append">
                                                            <div class="input-group-text" data-target="#tglAddExpSim" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                                        </div>
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
                                            <div class="col-sm-8">
                                                 <div class="form-group">
                                                    <label>Alamat</label>
                                                    <textarea rows="3" name="alamat" class="form-control <?php if (form_error('alamat')) {echo "is-invalid";} ?>" placeholder="Alamat"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Status Supir</label>
                                                    <select name="statusSupir" class="custom-select <?php if (form_error('statusSupir')) {echo "is-invalid";} ?>" style="width:100%;">
                                                        <option value=""/>--- Pilih Status ---</option>
                                                        <?php 
                                                            $pilihanstatus=array("Aktif","Non Aktif");
                                                            foreach ($pilihanstatus as $value) { 
                                                        ?>
                                                            <option value='<?php echo $value; ?>' <?php echo set_select('statusSupir', $value);?> /><?php echo $value; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <textarea rows="3" name="keterangan" class="form-control <?php if (form_error('keterangan')) {echo "is-invalid";} ?>" placeholder="Keterangan"></textarea>
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

                    <div class="modal fade" id="mdl_imgSupir">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Foto | SIM | KTP</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="filePreview">
                                    <!-- konten file muncul di sini -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="mdl_editSupir">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form id="form1" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Supir</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="text" name="nmSupir" value="<?php echo set_value('nmSupir')?>" class="form-control <?php if (form_error('nmSupir')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Tempat Lahir</label>
                                                    <input type="text" name="tmpLahir" value="<?php echo set_value('tmpLahir')?>" class="form-control <?php if (form_error('tmpLahir')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Tgl. Lahir</label>
                                                    <div class="input-group date" id="tglEditLahir" data-target-input="nearest">
                                                        <input type="text" name="tglLahir" value="<?php echo set_value('tglLahir')?>" class="form-control" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" />
                                                        <div class="input-group-append">
                                                            <div class="input-group-text" data-target="#tglEditLahir" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>NIK</label>
                                                    <input type="text" name="noNIK" value="<?php echo set_value('noNIK')?>" class="form-control <?php if (form_error('noNIK')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Tanggal Bergabung</label>
                                                    <div class="input-group date" id="tglEditJoin" data-target-input="nearest">
                                                        <input type="text" name="tglJoin" value="<?php echo set_value('tglJoin')?>" class="form-control" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" />
                                                        <div class="input-group-append">
                                                            <div class="input-group-text" data-target="#tglEditJoin" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Tanggal Keluar</label>
                                                    <div class="input-group date" id="tglEditOut" data-target-input="nearest">
                                                        <input type="text" name="tglKeluar" value="<?php echo set_value('tglKeluar')?>" class="form-control" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" />
                                                        <div class="input-group-append">
                                                            <div class="input-group-text" data-target="#tglEditOut" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                                        </div>
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
                                                    <div class="input-group date" id="tglEditExpSim" data-target-input="nearest">
                                                        <input type="text" name="tglExpSim" value="<?php echo set_value('tglExpSim')?>" class="form-control" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" />
                                                        <div class="input-group-append">
                                                            <div class="input-group-text" data-target="#tglEditExpSim" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                                        </div>
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
                                            <div class="col-sm-8">
                                                 <div class="form-group">
                                                    <label>Alamat</label>
                                                    <textarea rows="3" name="alamat" value="<?php echo set_value('alamat')?>" class="form-control <?php if (form_error('alamat')) {echo "is-invalid";} ?>"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Status Supir</label>
                                                    <select id="statusSupir" name="statusSupir" class="form-control <?php if (form_error('statusSupir')) {echo "is-invalid";} ?>" style="width:100%;">
                                                        <option value="">--- Pilih Status ---</option>
                                                        <?php
                                                            $pilihanstatus = array("Aktif","Non Aktif");
                                                            foreach ($pilihanstatus as $value) {
                                                                $selected = ($value == $row->status) ? "selected" : "";
                                                                echo "<option value='$value' $selected>$value</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <textarea rows="3" name="keterangan" class="form-control <?php if (form_error('keterangan')) {echo "is-invalid";} ?>" placeholder="Keterangan"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div>
                                                    <input type="hidden" name="id" />
                                                    <input type="hidden" name="fileFotoLama" />
                                                    <input type="hidden" name="fileSimLama" />
                                                    <input type="hidden" name="fileKtpLama" />
                                                    <a href="<?php echo site_url('drivers') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                                    <button type="button" id="btnSave" class="btn btn-primary float-right">&nbsp;&nbsp;&nbsp;&nbsp;Simpan&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="mdl_delSupir">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Hapus Supir</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="form2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Yakin ingin menghapus data ini?</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div>
                                                    <input type="hidden" name="id" />
                                                    <a href="<?php echo site_url('drivers') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                                    <button type="button" id="btnDel" class="btn btn-primary float-right">&nbsp;&nbsp;&nbsp;&nbsp;Ya, Hapus&nbsp;&nbsp;&nbsp;&nbsp;</button>
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