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

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-4 col-4">
                                <div class="small-box callout callout-info h-100">
                                    <div class="inner">
                                        <span>Ritasi Hari Ini</span>
                                        <a href="#collapseExample" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample" style="text-decoration:none;">
                                           <h3><?php echo $jmlritasiHari; ?><i class="fas fa-caret-right fa-fw"></i></h3>
                                        </a>
                                        <div class="collapse" id="collapseExample">
                                            <div class="card card-body">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Tim G</th>
                                                            <th>Tim K</th>
                                                            <th>Tim M</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo $jmlritasiGHari; ?></td>
                                                            <td><?php echo $jmlritasiKHari; ?></td>
                                                            <td><?php echo $jmlritasiMHari; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-shuffle"></i>
                                    </div>
                                    <p class="small-box-footer2">
                                        &nbsp;&nbsp;&nbsp;
                                        <?php if ($persenRitasiHari >= 0) { ?>
                                            <i class="fas fa-arrow-up text-success"></i>
                                            <span class="text-success">
                                                <?php echo number_format(abs($persenRitasiHari), 1); ?>
                                            </span> 
                                        <?php } else { ?>
                                            <i class="fas fa-arrow-down text-danger"></i>
                                            <span class="text-danger">
                                                <?php echo number_format(abs($persenRitasiHari), 1); ?>
                                            </span> 
                                        <?php } ?>
                                        % dari kemarin
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-4">
                                <div class="small-box callout callout-success h-100">
                                    <div class="inner">
                                        <span>Ritasi Bulan Ini</span>
                                        <h3><?php echo $jmlritasiBln; ?></h3>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-loop"></i>
                                    </div>
                                    <p class="small-box-footer2">
                                        &nbsp;&nbsp;&nbsp;
                                        <?php if ($persenRitasiBln >= 0) { ?>
                                            <i class="fas fa-arrow-up text-success"></i>
                                            <span class="text-success">
                                                <?php echo number_format(abs($persenRitasiBln), 1); ?>
                                            </span> 
                                        <?php } else { ?>
                                            <i class="fas fa-arrow-down text-danger"></i>
                                            <span class="text-danger">
                                                <?php echo number_format(abs($persenRitasiBln), 1); ?>
                                            </span> 
                                        <?php } ?>
                                        % dari bulan lalu
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-4">
                                <div class="small-box callout callout-danger h-100">
                                    <div class="inner">
                                        <span>Ritasi Tertunda</span>
                                        <h3><?php echo $jmlritasiTanpaNodo; ?></h3>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-alert-circled"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">&nbsp;</div>
                    <div class="container-fluid">
                        <div class="card" style="z-index: 1;">
                            <div class="card-header">
                                <h3 class="card-title">Filter Rekapitulasi Ritasi Harian</h3>
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
                                <form id="form1" name="form1" action="<?php echo site_url('routes')?>" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <div class="input-group date" id="tglan_ritasi" data-target-input="nearest">
                                                    <input type="text" name="tgl_ritasi" value="<?php echo set_value('tgl_ritasi')?>" class="form-control" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" />
                                                    <div class="input-group-append">
                                                        <div class="input-group-text" data-target="#tglan_ritasi" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nama Tim</label>
                                                <select name="nama_tim" class="form-control" style="width:100%;">
                                                        <option value="">Semua Tim</option>
                                                        <?php foreach ($tims as $value) { ?>
                                                            <option value='<?php echo $value->id; ?>' <?php echo set_select('nama_tim', $value->id );?> ><?php echo 'Tim '.$value->nama_tim; ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nama Proyek</label>
                                                <select name="nama_proyek" class="form-control" style="width:100%;">
                                                        <option value="">Semua Proyek</option>
                                                        <?php foreach ($proyeks as $value) { ?>
                                                            <option value='<?php echo $value->id; ?>' <?php echo set_select('nama_proyek', $value->id );?> ><?php echo 'Proyek '.$value->nama_proyek; ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Lokasi Galian</label>
                                                <select name="lokasi" class="form-control select_rute" style="width:100%;">
                                                        <option value="">Semua Lokasi</option>
                                                        <?php foreach ($galians as $value) { ?>
                                                            <option value='<?php echo $value->id; ?>' <?php echo set_select('lokasi', $value->id );?> ><?php echo $value->lokasi; ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="row">
                                        <div class="col-md-12">
                                            <center>
                                                <a href="<?php echo site_url('routes') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reset&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
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
                                        <a class="nav-link active" id="log_ritasi_tab" data-toggle="pill" href="#log_ritasi" role="tab" aria-controls="log_ritasi" aria-selected="false">Rekapitulasi Ritasi Harian</a>
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
                                        <p class="lead2 mb-3">
                                            Rekapitulasi Ritasi Harian
                                            <a href="<?php echo base_url('routes/multi_ritasi') ?>" class="btn btn-primary float-right ml-2">
                                                <i class="fas fa-plus-square"></i>&nbsp;&nbsp;Tambah Log
                                            </a>
                                            <button id="btn-copy-checked" class="btn btn-success float-right">
                                                <i class="fas fa-copy"></i>&nbsp;&nbsp;Copy Data
                                            </button>
                                        </p>
                                        <table id="tbl_logritasi" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="select-all"></th> <!-- Master checkbox -->
                                                    <th>Tanggal</th>
                                                    <th>Tim</th>
                                                    <th>Proyek</th>
                                                    <th>Lokasi Galian</th>
                                                    <th>Supir</th>
                                                    <th>No. Polisi</th>
                                                    <th>No. Pintu/Bak/Unit</th>
                                                    <th>Jam Angkut</th>
                                                    <th>Nomer DO</th>
                                                    <th>Uang Jalan</th>
                                                    <th width="8%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($ritasis as $row) { ?>
                                                    <tr>
                                                        <td><input type="checkbox" class="row-check" value="<?php echo $row->id ?>"></td>
                                                        <td><?php echo $row->tgl_ritasi; ?></td>
                                                        <td>
                                                            <?php 
                                                                $this->db->select('nama_tim'); 
                                                                $this->db->from('tim'); 
                                                                $this->db->where('id', $row->tim_id);
                                                                $query = $this->db->get();
                                                                if ($query->num_rows() > 0) {
                                                                    $tim = $query->row();
                                                                } 
                                                                $query->free_result();
                                                                echo $tim->nama_tim;  
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                $this->db->select('nama_proyek'); 
                                                                $this->db->from('proyek'); 
                                                                $this->db->where('id', $row->proyek_id);
                                                                $query = $this->db->get();
                                                                if ($query->num_rows() > 0) {
                                                                    $proyek = $query->row();
                                                                } 
                                                                $query->free_result();
                                                                echo $proyek->nama_proyek;  
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                $this->db->select('lokasi'); 
                                                                $this->db->from('galian'); 
                                                                $this->db->where('id', $row->galian_id);
                                                                $query = $this->db->get();
                                                                if ($query->num_rows() > 0) {
                                                                    $galian = $query->row();
                                                                } 
                                                                $query->free_result();
                                                                echo $galian->lokasi;  
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                $this->db->select('tim_mgmt.driver_id, drivers.name'); 
                                                                $this->db->from('tim_mgmt'); 
                                                                $this->db->join('drivers', 'tim_mgmt.driver_id = drivers.id');
                                                                $this->db->where('tim_mgmt.vehicle_id', $row->vehicle_id);
                                                                $query = $this->db->get();
                                                                if ($query->num_rows() > 0) {
                                                                    $supir = $query->row();
                                                                } 
                                                                $query->free_result();
                                                                echo $supir->name;  
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                $this->db->select('no_pol, no_pintu'); 
                                                                $this->db->from('vehicles'); 
                                                                $this->db->where('id', $row->vehicle_id);
                                                                $query = $this->db->get();
                                                                if ($query->num_rows() > 0) {
                                                                    $mobil = $query->row();
                                                                } 
                                                                $query->free_result();
                                                                echo $mobil->no_pol;  
                                                            ?>
                                                        </td>
                                                        <td><?php echo $mobil->no_pintu; ?></td>
                                                        <td><?php echo $row->jam_angkut; ?></td>
                                                        <td><?php echo $row->nomerdo; ?></td>
                                                        <td><?php echo $this->fppfunction->rupiah_ind2($row->uang_jalan); ?></td>
                                                        <td width="8%">
                                                            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#mdl_editRitasi<?php echo $row->id ?>"><i class="fas fa-pencil-alt"></i></button>

                                                            <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#mdl_delRitasi<?php echo $row->id ?>"><i class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th>Tanggal</th>
                                                    <th>Tim</th>
                                                    <th>Proyek</th>
                                                    <th>Lokasi Galian</th>
                                                    <th>Supir</th>
                                                    <th>No. Polisi</th>
                                                    <th>No. Pintu/Bak/Unit</th>
                                                    <th>Jam Angkut</th>
                                                    <th>Nomer DO</th>
                                                    <th>Uang Jalan</th>
                                                    <th width="8%">Aksi</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="statistik" role="tabpanel" aria-labelledby="statistik_tab">
                                        Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">&nbsp;</div>
                    <?php foreach ($ritasis as $row) { ?>
                        <div class="modal fade" id="mdl_editRitasi<?php echo $row->id ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Log Ritasi</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form1" name="form1" action="<?php echo site_url('routes/ritasiedit/'.$row->id)?>" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Tanggal</label>
                                                        <div class="input-group date" id="tgl_edit<?php echo $row->id ?>" data-target-input="nearest">
                                                            <input type="text" name="tgl" value="<?php echo set_value('tgl')?>" class="form-control" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" />
                                                            <div class="input-group-append">
                                                                <div class="input-group-text" data-target="#tgl_edit<?php echo $row->id ?>" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Tim</label>
                                                        <select name="tim" class="form-control select_rute <?php if (form_error('tim')) {echo "is-invalid";} ?>" style="width:100%;">
                                                            <option value="">--- Pilih Tim ---</option>
                                                            <?php
                                                                foreach ($tims as $value) {
                                                                  $selected=($value->id == $row->tim_id) ? "selected" : "";
                                                                  echo " <option value='$value->id' $selected>$value->nama_tim</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Nama Proyek</label>
                                                        <select name="proyek" class="form-control select_rute <?php if (form_error('proyek')) {echo "is-invalid";} ?>" style="width:100%;">
                                                            <option value="">--- Pilih Proyek ---</option>
                                                            <?php
                                                                foreach ($proyeks as $value) {
                                                                  $selected=($value->id == $row->proyek_id) ? "selected" : "";
                                                                  echo " <option value='$value->id' $selected>$value->nama_proyek</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Lokasi Galian</label>
                                                        <select name="galian" class="form-control <?php if (form_error('galian')) {echo "is-invalid";} ?>">
                                                            <option value="">--- Pilih Lokasi Galian ---</option>
                                                            <?php
                                                                foreach ($galians as $value) {
                                                                  $selected=($value->id == $row->galian_id) ? "selected" : "";
                                                                  echo " <option value='$value->id' $selected>$value->lokasi</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Kendaraan</label>
                                                        <select name="kendaraan" class="form-control select_rute <?php if (form_error('kendaraan')) {echo "is-invalid";} ?>" style="width:100%;" />
                                                            <option value="">--- Pilih Kendaraan ---</option>
                                                            <?php
                                                                foreach ($kendaraans as $value) {
                                                                  $selected=($value->vehicle_id == $row->vehicle_id) ? "selected" : "";
                                                                  echo " <option value='$value->vehicle_id' $selected>$value->no_pol</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Jam Angkut</label>
                                                        <div class="input-group date" id="waktu_angkut<?php echo $row->id ?>" data-target-input="nearest">
                                                            <input type="text" name="jam" value="<?php echo set_value('jam')?>" class="form-control" oninput="autoFormatJam(this)" maxlength="5" placeholder="HH:MM" />
                                                            <div class="input-group-append">
                                                                <div class="input-group-text datetimepicker-input" data-target="#waktu_angkut<?php echo $row->id ?>" data-toggle="datetimepicker"><i class="fa fa-clock"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Nomer DO</label>
                                                        <input type="text" name="nodo" value="<?php echo set_value('nodo',$row->nomerdo)?>" class="form-control <?php if (form_error('nodo')) {echo "is-invalid";} ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div>
                                                        <a href="<?php echo site_url('routes') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                                        <input type="submit" name="submit" class="btn btn-primary float-right" value="&nbsp;&nbsp;&nbsp;&nbsp;Simpan&nbsp;&nbsp;&nbsp;&nbsp;">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="mdl_delRitasi<?php echo $row->id ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Hapus Log Ritasi</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form1" name="form1" action="<?php echo site_url('routes/ritasidel/'.$row->id)?>" method="post" enctype="multipart/form-data">
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
                </section>
                <!-- /.Main content -->
            </div>
            <!-- /.content-wrapper -->