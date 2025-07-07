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
                                <form id="form1" name="form1" action="<?php echo site_url('drivers')?>" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nama Supir</label>
                                                <input type="text" name="nmSupir" value="<?php echo set_value('nmSupir')?>" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>No. Pintu/Bak/Unit</label>
                                                <select name="noPintu" class="form-control select_rute" style="width:100%;">
                                                    <option value=""></option>
                                                    <?php foreach ($mobils as $value) { ?>
                                                        <option value='<?php echo $value->no_pintu; ?>' <?php echo set_select('noPintu', $value->no_pintu );?> ><?php echo $value->no_pintu; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tanggal Bergabung</label>
                                                <div class="input-group date" id="tglCariJoin" data-target-input="nearest">
                                                    <input type="text" name="tglJoin" value="<?php echo set_value('tglJoin')?>" class="form-control" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" />
                                                    <div class="input-group-append">
                                                        <div class="input-group-text" data-target="#tglCariJoin" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="statusSupir" class="custom-select" style="width:100%;">
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
                                                <a href="<?php echo site_url('drivers') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reset&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
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
                                        <a class="nav-link active" id="mgmt_supir_tab" data-toggle="pill" href="#mgmt_supir" role="tab" aria-controls="mgmt_supir" aria-selected="false">Manajemen Supir</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="mgmt_wallet_tab" data-toggle="pill" href="#mgmt_wallet" role="tab" aria-controls="mgmt_wallet" aria-selected="false">Manajemen Wallet Supir</a>
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
                                                    <th width="8%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($supirs as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $row->name ?></td>
                                                        <td><?php echo $row->tgl_join; ?></td>
                                                        <td><?php echo $row->phone ?></td>
                                                        <td><?php echo $row->nomor_darurat ?></td>
                                                        <td><?php echo $row->license_number ?></td>
                                                        <td>
                                                            <?php 
                                                                $this->db->select('no_pintu'); 
                                                                $this->db->from('tim_mgmt');
                                                                $this->db->where('driver_id', $row->id);
                                                                $this->db->where('status_tim_mgmt', 'Aktif');
                                                                $query = $this->db->get();
                                                                if ($query->num_rows() > 0) {
                                                                    $unit = $query->row();
                                                                    echo $unit->no_pintu;
                                                                } else {
                                                                    echo "<small class='text-danger'>Belum ada Tim</small>";
                                                                }
                                                                $query->free_result();
                                                            ?>
                                                        </td>
                                                        <td
                                                            <?php if ($row->status == 'Non Aktif'): ?>
                                                                data-toggle="tooltip"
                                                                data-placement="top"
                                                                title="<?php echo htmlspecialchars($row->keterangan) ?>"
                                                            <?php endif; ?>
                                                        >
                                                            <?php echo $row->status ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($row->status == 'Non Aktif'): ?>
                                                                <?php echo $row->keterangan ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td width="11%">
                                                            <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#mdl_imgSupir<?php echo $row->id ?>"><i class="fas fa-file-image"></i></button>

                                                            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#mdl_editSupir<?php echo $row->id ?>"><i class="fas fa-pencil-alt"></i></button>

                                                            <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#mdl_delSupir<?php echo $row->id ?>"><i class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
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
                                                    <th width="8%">Aksi</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="mgmt_wallet" role="tabpanel" aria-labelledby="mgmt_wallet_tab">
                                        <p class="lead2 mb-3">
                                            Manajemen Wallet Supir
                                        </p>
                                        <table id="tbl_manajemenwallet" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Balance</th>
                                                    <th>Status</th>
                                                    <th>Update At</th>
                                                    <th width="8%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($wallets as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $row->name ?></td>
                                                        <td><?php echo $this->fppfunction->rupiah_ind($row->balance) ?></td>
                                                        <td><?php echo $row->status_wallet ?></td>
                                                        <td><?php echo $this->fppfunction->tglangkajam_ind($row->updated_at) ?></td>
                                                        <td width="8%">
                                                            <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#mdl_wallet<?php echo $row->wallet_id ?>"><i class="fas fa-eye"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Balance</th>
                                                    <th>Status</th>
                                                    <th>Update At</th>
                                                    <th width="8%">Aksi</th>
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
                                                    <label>Tgl. Lahir</label>
                                                    <div class="input-group date" id="tglAddLahir" data-target-input="nearest">
                                                        <input type="text" name="tglLahir" value="<?php echo set_value('tglLahir')?>" class="form-control" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" />
                                                        <div class="input-group-append">
                                                            <div class="input-group-text" data-target="#tglAddLahir" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Tanggal Bergabung</label>
                                                    <div class="input-group date" id="tglAddJoin" data-target-input="nearest">
                                                        <input type="text" name="tglJoin" value="<?php echo set_value('tglJoin')?>" class="form-control" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" />
                                                        <div class="input-group-append">
                                                            <div class="input-group-text" data-target="#tglAddJoin" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
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
                                                        <input type="text" name="tglExpSim" value="<?php echo set_value('tglExpSim')?>" class="form-control" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" />
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
                                                    <label>Status Supir</label>
                                                    <select id="statusSupir<?php echo $row->id ?>" name="statusSupir" class="form-control <?php if (form_error('statusSupir')) {echo "is-invalid";} ?>" style="width:100%;">
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

                    <?php foreach ($supirs as $row) { ?>
                        <div class="modal fade" id="mdl_imgSupir<?php echo $row->id ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Foto | SIM | KTP</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php if ($row->img_profile) { ?>
                                            <img class="img-fluid mb-3" src="<?php echo base_url('uploads/foto/'.$row->img_profile); ?>" alt="Foto">
                                        <?php } ?>
                                        <?php if ($row->img_sim) { ?>
                                            <img class="img-fluid mb-3" src="<?php echo base_url('uploads/sim/'.$row->img_sim); ?>" alt="SIM">
                                        <?php } ?>
                                        <?php if ($row->img_ktp) { ?>
                                            <img class="img-fluid mb-3" src="<?php echo base_url('uploads/ktp/'.$row->img_ktp); ?>" alt="KTP">
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="mdl_editSupir<?php echo $row->id ?>">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Supir</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form2" name="form2" action="<?php echo site_url('drivers/supiredit/'.$row->id)?>" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input type="text" name="nmSupir" value="<?php echo set_value('nmSupir',$row->name)?>" class="form-control <?php if (form_error('nmSupir')) {echo "is-invalid";} ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Tgl. Lahir</label>
                                                        <div class="input-group date" id="tglEditLahir<?php echo $row->id ?>" data-target-input="nearest">
                                                            <input type="text" name="tglLahir" value="<?php echo set_value('tglLahir',$row->tgl_lahir)?>" class="form-control" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" />
                                                            <div class="input-group-append">
                                                                <div class="input-group-text" data-target="#tglEditLahir<?php echo $row->id ?>" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Tanggal Bergabung</label>
                                                        <div class="input-group date" id="tglEditSupir<?php echo $row->id ?>" data-target-input="nearest">
                                                            <input type="text" name="tglJoin" value="<?php echo set_value('tgl',$row->tgl_join)?>" class="form-control" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" />
                                                            <div class="input-group-append">
                                                                <div class="input-group-text" data-target="#tglEditSupir<?php echo $row->id ?>" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Tanggal Keluar</label>
                                                        <div class="input-group date" id="tglAddKeluar" data-target-input="nearest">
                                                            <input type="text" name="tglKeluar" value="<?php echo set_value('tglKeluar')?>" class="form-control" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" />
                                                            <div class="input-group-append">
                                                                <div class="input-group-text" data-target="#tglAddKeluar" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
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
                                                        <input type="text" name="noHp" value="<?php echo set_value('noHp',$row->phone)?>" class="form-control <?php if (form_error('noHp')) {echo "is-invalid";} ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>No. HP Darurat</label>
                                                        <input type="text" name="noDarurat" value="<?php echo set_value('noDarurat',$row->nomor_darurat)?>" class="form-control <?php if (form_error('noDarurat')) {echo "is-invalid";} ?>" />
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
                                                        <input type="text" name="noSim" value="<?php echo set_value('noSim',$row->license_number)?>" class="form-control <?php if (form_error('noSim')) {echo "is-invalid";} ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Tgl. Exp. SIM</label>
                                                        <div class="input-group date" id="tglEditExpSim<?php echo $row->id ?>" data-target-input="nearest">
                                                            <input type="text" name="tglExpSim" value="<?php echo set_value('tglExpSim',$row->tgl_exp_sim)?>" class="form-control" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" />
                                                            <div class="input-group-append">
                                                                <div class="input-group-text" data-target="#tglEditExpSim<?php echo $row->id ?>" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
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
                                                        <textarea rows="3" name="alamat" value="<?php echo set_value('alamat')?>" class="form-control <?php if (form_error('alamat')) {echo "is-invalid";} ?>"><?php echo $row->alamat ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Status Supir</label>
                                                        <select id="statusSupir<?php echo $row->id ?>" name="statusSupir" class="form-control <?php if (form_error('statusSupir')) {echo "is-invalid";} ?>" style="width:100%;">
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
                                                        <textarea rows="3" name="keterangan" class="form-control <?php if (form_error('keterangan')) {echo "is-invalid";} ?>" placeholder="Keterangan"><?php echo $row->keterangan ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div>
                                                        <input type="hidden" name="fileFotoLama" value="<?php echo $row->img_profile; ?>">
                                                        <input type="hidden" name="fileSimLama" value="<?php echo $row->img_sim; ?>">
                                                        <input type="hidden" name="fileKtpLama" value="<?php echo $row->img_ktp; ?>">

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

                        <div class="modal fade" id="mdl_delSupir<?php echo $row->id ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Hapus Supir</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form3" name="form3" action="<?php echo site_url('drivers/supirdel/'.$row->id)?>" method="post" enctype="multipart/form-data">
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
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
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

                    <?php foreach ($wallets as $row) { ?>
                    <div class="modal fade" id="mdl_wallet<?php echo $row->wallet_id ?>">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Wallet detail <?php echo $row->name ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Wallet ID: <?php echo $row->wallet_id ?></p>
                                    <p>Jumlah transaksi: <?php echo count($wallet_transactions[$row->wallet_id] ?? []) ?></p>

                                    <?php
                                        $transList = $wallet_transactions[$row->wallet_id] ?? [];

                                        // Ambil tgl_ritasi jika ada
                                        foreach ($transList as &$tr) {
                                            $this->db->select('tgl_ritasi');
                                            $this->db->from('ritasi');
                                            $this->db->where('id', $tr->id_ritasi);
                                            $query = $this->db->get();
                                            $tr->tgl_ritasi_result = ($query->num_rows() > 0) ? $query->row()->tgl_ritasi : null;
                                            $query->free_result();
                                        }
                                        unset($tr); // good practice

                                        // Urutkan berdasarkan tgl_ritasi (jika ada), fallback ke created_at
                                        usort($transList, function($a, $b) {
                                            $aDate = $a->tgl_ritasi_result ?? $a->created_at;
                                            $bDate = $b->tgl_ritasi_result ?? $b->created_at;
                                            return strtotime($bDate) <=> strtotime($aDate);
                                        });
                                    ?>

                                    <table id="tbl_manajemenwallet_transactions<?php echo $row->wallet_id ?>" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Tipe transaksi</th>
                                                <th>Amount</th>
                                                <th>Keterangan</th>
                                                <th>Tgl. Ritasi</th>
                                                <th>Create At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $no = 1;
                                                foreach ($transList as $trans) { 
                                                    $tgl_ritasi_raw = ($trans->tgl_ritasi_result && $trans->tgl_ritasi_result != '00-00-0000') 
                                                        ? $trans->tgl_ritasi_result 
                                                        : $trans->created_at;

                                                    $tgl_ritasi_display = ($trans->tgl_ritasi_result && $trans->tgl_ritasi_result != '00-00-0000') 
                                                        ? date('d-m-Y', strtotime($trans->tgl_ritasi_result)) 
                                                        : '';
                                            ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $trans->transaction_type ?></td>
                                                <td><?php echo $this->fppfunction->rupiah_ind($trans->amount) ?></td>
                                                <td><?php echo $trans->description ?></td>
                                                <td data-order="<?= $tgl_ritasi_raw ?>"><?= $tgl_ritasi_display ?></td>
                                                <td><?php echo $this->fppfunction->tglangkajam_ind($trans->created_at) ?></td>
                                            </tr>
                                            <?php } ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="1">Balance</th>
                                                <th></th>
                                                <th colspan="1"><?php echo $this->fppfunction->rupiah_ind($row->balance) ?></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                </section>
                <!-- /.Main content -->
            </div>
            <!-- /.content-wrapper -->