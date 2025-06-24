            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6"><h1 class="m-0">Manajemen Supir</h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Dashboard</a></li>
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
                                        <h3>150</h3>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-trophy"></i>
                                    </div>
                                    <p class="small-box-footer2">&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-up text-success"></i> <span class="text-success">14%</span> dari kemarin </p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-6">
                                <div class="small-box callout callout-success">
                                    <div class="inner">
                                        <span>Top Saldo Tertinggi</span>
                                        <h3>1248</h3>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-trophy"></i>
                                    </div>
                                    <p class="small-box-footer2">&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-up text-success"></i> <span class="text-success">12.7%</span> dari bulan lalu </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="card">
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Bergabung</label>
                                                <div class="input-group date" id="tglan_bergabung" data-target-input="nearest">
                                                    <input type="text" name="tglJoin" value="<?php echo set_value('tglJoin')?>" class="form-control datetimepicker-input" data-target="#tglan_bergabung" data-toggle="datetimepicker" />
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status Supir</label>
                                                <select name="status" class="form-control" style="width:100%;">
                                                        <option value="">Semua Supir</option>
                                                        <?php foreach ($drivers as $value) { ?>
                                                            <option value='<?php echo $value->id; ?>' <?php echo set_select('status', $value->id );?> ><?php echo $value->status; ?></option>
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
                                        <a class="nav-link active" id="log_ritasi_tab" data-toggle="pill" href="#log_ritasi" role="tab" aria-controls="log_ritasi" aria-selected="false">Manajemen Supir</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="statistik_tab" data-toggle="pill" href="#statistik" role="tab" aria-controls="statistik" aria-selected="false">Manajemen Wallet Supir</a>
                                    </li>
                                </ul>
                                <div class="tab-custom-content2">
                                    <p class="lead mb-0">&nbsp;</p>
                                </div>
                                <div class="tab-content" id="custom-content-below-tabContent">
                                    <div class="tab-pane fade show active" id="log_ritasi" role="tabpanel" aria-labelledby="log_ritasi_tab">
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
                                                    <th>Tanggal Bergabung</th>
                                                    <th>No. HP</th>
                                                    <th>No. Darurat</th>
                                                    <th>No. SIM</th>
                                                    <th>Status</th>
                                                    <th>Keterangan</th>
                                                    <th width="8%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($supirs as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $row->name ?></td>
                                                        <td><?php echo $this->fppfunction->tglblnthn_ind($row->tgl_join); ?></td>
                                                        <td><?php echo $row->phone ?></td>
                                                        <td><?php echo $row->nomor_darurat ?></td>
                                                        <td><?php echo $row->license_number ?></td>
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

                                                            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#mdl_editSupir<?php echo $row->id ?>"><i class="fas fa-pencil-alt"></i></button>

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
                                                                                    <div class="col-sm-4">
                                                                                        <div class="form-group">
                                                                                            <label>Nama</label>
                                                                                            <input type="text" name="nmSupir" value="<?php echo set_value('nmSupir',$row->name)?>" class="form-control <?php if (form_error('nmSupir')) {echo "is-invalid";} ?>" />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-4">
                                                                                        <div class="form-group">
                                                                                            <label>Tgl. Lahir</label>
                                                                                            <div class="input-group date" id="tglEditLahir<?php echo $row->id ?>" data-target-input="nearest">
                                                                                                <input type="text" name="tglLahir" value="<?php echo set_value('tglLahir',$row->tgl_lahir)?>" class="form-control datetimepicker-input" data-target="#tglEditLahir<?php echo $row->id ?>" data-toggle="datetimepicker" />
                                                                                                <div class="input-group-append">
                                                                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-4">
                                                                                        <div class="form-group">
                                                                                            <label>Tanggal Bergabung</label>
                                                                                            <div class="input-group date" id="tglEditSupir<?php echo $row->id ?>" data-target-input="nearest">
                                                                                                <input type="text" name="tglJoin" value="<?php echo set_value('tgl',$row->tgl_join)?>" class="form-control datetimepicker-input" data-target="#tglEditSupir<?php echo $row->id ?>" data-toggle="datetimepicker" />
                                                                                                <div class="input-group-append">
                                                                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
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
                                                                                                <input type="text" name="tglExpSim" value="<?php echo set_value('tglExpSim',$row->tgl_exp_sim)?>" class="form-control datetimepicker-input" data-target="#tglEditExpSim<?php echo $row->id ?>" data-toggle="datetimepicker" />
                                                                                                <div class="input-group-append">
                                                                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
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
                                                                                    <div class="col-sm-8" id="keteranganWrapper<?php echo $row->id ?>">
                                                                                        <div class="form-group">
                                                                                            <label>Keterangan</label>
                                                                                            <textarea rows="3" name="keterangan" class="form-control <?php if (form_error('keterangan')) {echo "is-invalid";} ?>" placeholder="Resign/Bermasalah"><?php echo $row->keterangan ?></textarea>
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

                                                            <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#mdl_delSupir<?php echo $row->id ?>"><i class="fas fa-trash"></i></button>

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
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Tanggal Bergabung</th>
                                                    <th>No. HP</th>
                                                    <th>No. Darurat</th>
                                                    <th>No. SIM</th>
                                                    <th>Status</th>
                                                    <th>Keterangan</th>
                                                    <th width="8%">Aksi</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="statistik" role="tabpanel" aria-labelledby="statistik_tab">
                                        <p class="lead2 mb-3">
                                            Manajemen Wallet Supir
                                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#mdl_tmbhLog">
                                                <i class="fas fa-plus-square"></i>&nbsp;&nbsp;Tambah Wallet Supir
                                            </button>
                                        </p>
                                        <table id="tbl_manajemenwallet" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Balance</th>
                                                    <th>Update At</th>
                                                    <th width="8%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($wallets as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $row->name ?></td>
                                                        <td><?php echo $this->fppfunction->rupiah_ind($row->balance) ?></td>
                                                        <td><?php echo $this->fppfunction->tglangkajam_ind($row->updated_at) ?></td>
                                                        <td width="11%">
                                                            <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#mdl_wallet<?php echo $row->wallet_id ?>"><i class="fas fa-eye"></i></button>

                                                            <div class="modal fade" id="mdl_wallet<?php echo $row->wallet_id ?>">
                                                                <div class="modal-dialog modal-fullscreen">
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

                                                                            <table id="tbl_manajemenwallet_transactions<?php echo $row->wallet_id ?>" class="table table-bordered table-striped">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>No.</th>
                                                                                        <th>Tipe transaksi</th>
                                                                                        <th>Balance</th>
                                                                                        <th>Keterangan</th>
                                                                                        <th>Status</th>
                                                                                        <th>Create At</th>
                                                                                        <th>Update At</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php 
                                                                                        $no = 1;
                                                                                        foreach ($wallet_transactions[$row->wallet_id] ?? [] as $trans) { 
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td><?php echo $no++ ?></td>
                                                                                            <td><?php echo $trans->transaction_type ?></td>
                                                                                            <td><?php echo $this->fppfunction->rupiah_ind($trans->amount) ?></td>
                                                                                            <td><?php echo $trans->description ?></td>
                                                                                            <td><?php echo $trans->status ?></td>
                                                                                            <td><?php echo $this->fppfunction->tglangkajam_ind($trans->created_at) ?></td>
                                                                                            <td><?php echo $this->fppfunction->tglangkajam_ind($trans->updated_at) ?></td>
                                                                                        </tr>
                                                                                    <?php } ?>
                                                                                </tbody>
                                                                                <tfoot>
                                                                                    <tr>
                                                                                        <th>No.</th>
                                                                                        <th>Tipe transaksi</th>
                                                                                        <th>Balance</th>
                                                                                        <th>Keterangan</th>
                                                                                        <th>Status</th>
                                                                                        <th>Create</th>
                                                                                        <th>Last update</th>
                                                                                    </tr>
                                                                                </tfoot>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Balance</th>
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