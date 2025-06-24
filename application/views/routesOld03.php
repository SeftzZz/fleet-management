<<<<<<< HEAD
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6"><h1 class="m-0">Rute & Ritasi</h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Rute & Ritasi</li>
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
                            <div class="col-lg-3 col-6">
                                <div class="small-box callout callout-info">
                                    <div class="inner">
                                        <span>Ritasi Hari Ini</span>
                                        <h3>150</h3>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-shuffle"></i>
                                    </div>
                                    <p class="small-box-footer2">&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-up text-success"></i> <span class="text-success">14%</span> dari kemarin </p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box callout callout-success">
                                    <div class="inner">
                                        <span>Ritasi Bulan Ini</span>
                                        <h3>1248</h3>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-loop"></i>
                                    </div>
                                    <p class="small-box-footer2">&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-up text-success"></i> <span class="text-success">12.7%</span> dari bulan lalu </p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box callout callout-warning">
                                    <div class="inner">
                                        <span>Rata-Rata KM/Hari</span>
                                        <h3>187</h3>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-speedometer"></i>
                                    </div>
                                    <p class="small-box-footer2">&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-down text-danger"></i> <span class="text-danger">5.3%</span> dari bulan lalu </p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box callout callout-danger">
                                    <div class="inner">
                                        <span>Ritasi Tertunda</span>
                                        <h3>3</h3>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-alert-circled"></i>
                                    </div>
                                    <p class="small-box-footer2">&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-down text-danger"></i> <span class="text-danger">25%</span> dari minggu lalu </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="daftar_rute_tab" data-toggle="pill" href="#daftar_rute" role="tab" aria-controls="custom-content-daftar_rute-home" aria-selected="true">Daftar Rute</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="log_ritasi_tab" data-toggle="pill" href="#log_ritasi" role="tab" aria-controls="log_ritasi" aria-selected="false">Log Ritasi Harian</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="statistik_tab" data-toggle="pill" href="#statistik" role="tab" aria-controls="statistik" aria-selected="false">Statistik Ritasi</a>
                                    </li>
                                </ul>
                                <div class="tab-custom-content2">
                                    <p class="lead mb-0">&nbsp;</p>
                                </div>
                                <div class="tab-content" id="custom-content-below-tabContent">
                                    <div class="tab-pane fade show active" id="daftar_rute" role="tabpanel" aria-labelledby="daftar_rute_tab">
                                        <p class="lead2 mb-3">
                                            Daftar Rute
                                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#mdl_tmbhRute">
                                                <i class="fas fa-plus-square"></i>&nbsp;&nbsp; Tambah Rute
                                            </button>
                                        </p>
                                        <table id="tbl_daftarrute" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Asal</th>
                                                    <th>Tujuan</th>
                                                    <th>Jarak (KM)</th>
                                                    <th width="8%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($routes as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $row->start_point; ?></td>
                                                        <td><?php echo $row->end_point; ?></td>
                                                        <td><?php echo $row->planned_distance; ?></td>
                                                        <td width="8%">
                                                            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#mdl_editRute<?php echo $row->id ?>"><i class="fas fa-pencil-alt"></i></button>

                                                            <div class="modal fade" id="mdl_editRute<?php echo $row->id ?>">
                                                                <div class="modal-dialog">
                                                                  <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Edit Rute</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form id="form1" name="form1" action="<?php echo site_url('routes/edit/'.$row->id)?>" method="post" enctype="multipart/form-data">
                                                                                <div class="row">
                                                                                    <div class="col-sm-6">
                                                                                        <div class="form-group">
                                                                                            <label>Asal</label>
                                                                                            <input type="text" name="asal" value="<?php echo set_value('asal',$row->start_point)?>" class="form-control <?php if (form_error('asal')) {echo "is-invalid";} ?>" />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-6">
                                                                                        <div class="form-group">
                                                                                            <label>Tujuan</label>
                                                                                            <input type="text" name="tujuan" value="<?php echo set_value('tujuan',$row->end_point)?>" class="form-control <?php if (form_error('tujuan')) {echo "is-invalid";} ?>" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="form-group">
                                                                                            <label>Jarak Rencana (KM)</label>
                                                                                            <input type="text" name="jarakRencana" value="<?php echo set_value('jarakRencana',$row->planned_distance)?>" class="form-control <?php if (form_error('jarakRencana')) {echo "is-invalid";} ?>" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div>
                                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                                                                            <input type="submit" name="submit" class="btn btn-primary float-right" value="&nbsp;&nbsp;&nbsp;&nbsp;Simpan&nbsp;&nbsp;&nbsp;&nbsp;">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#mdl_delRute<?php echo $row->id ?>"><i class="fas fa-trash"></i></button>

                                                            <div class="modal fade" id="mdl_delRute<?php echo $row->id ?>">
                                                                <div class="modal-dialog">
                                                                  <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Hapus Rute</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form id="form1" name="form1" action="<?php echo site_url('routes/del/'.$row->id)?>" method="post" enctype="multipart/form-data">
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
                                                    <th>Asal</th>
                                                    <th>Tujuan</th>
                                                    <th>Jarak (KM)</th>
                                                    <th width="8%">Aksi</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="log_ritasi" role="tabpanel" aria-labelledby="log_ritasi_tab">
                                        <p class="lead2 mb-3">
                                            Log Ritasi Harian
                                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#mdl_tmbhLog">
                                                <i class="fas fa-plus-square"></i>&nbsp;&nbsp;Tambah Log
                                            </button>
                                        </p>
                                        <table id="tbl_logritasi" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Tim</th>
                                                    <th>Proyek</th>
                                                    <th>Lokasi Galian</th>
                                                    <th>No. Polisi</th>
                                                    <th>No. Bak</th>
                                                    <th>Jam Angkut</th>
                                                    <th>Nomer DO</th>
                                                    <th width="8%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($ritasis as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $this->fppfunction->tglblnthn_ind($row->tgl_ritasi); ?></td>
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
                                                        <td width="8%">
                                                            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#mdl_editRitasi<?php echo $row->id ?>"><i class="fas fa-pencil-alt"></i></button>

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
                                                                                            <input type="text" name="tgl" value="<?php echo set_value('tgl',$row->tgl_ritasi)?>" class="form-control <?php if (form_error('tgl')) {echo "is-invalid";} ?>" />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-6">
                                                                                        <div class="form-group">
                                                                                            <label>Tim</label>
                                                                                            <input type="text" name="tim" value="<?php echo set_value('tim',$row->tim_id)?>" class="form-control <?php if (form_error('tim')) {echo "is-invalid";} ?>" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-sm-6">
                                                                                        <div class="form-group">
                                                                                            <label>Proyek</label>
                                                                                            <input type="text" name="proyek" value="<?php echo set_value('proyek',$row->proyek_id)?>" class="form-control <?php if (form_error('proyek')) {echo "is-invalid";} ?>" />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-6">
                                                                                        <div class="form-group">
                                                                                            <label>Lokasi Galian</label>
                                                                                            <input type="text" name="galian" value="<?php echo set_value('galian',$row->galian_id)?>" class="form-control <?php if (form_error('galian')) {echo "is-invalid";} ?>" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-sm-6">
                                                                                        <div class="form-group">
                                                                                            <label>Kendaraan</label>
                                                                                            <input type="text" name="kendaraan" value="<?php echo set_value('kendaraan',$row->vehicle_id)?>" class="form-control <?php if (form_error('kendaraan')) {echo "is-invalid";} ?>" />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-6">
                                                                                        <div class="form-group">
                                                                                            <label>Jam Angkut</label>
                                                                                            <input type="text" name="jam" value="<?php echo set_value('jam',$row->jam_angkut)?>" class="form-control <?php if (form_error('jam')) {echo "is-invalid";} ?>" />
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
                                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                                                                            <input type="submit" name="submit" class="btn btn-primary float-right" value="&nbsp;&nbsp;&nbsp;&nbsp;Simpan&nbsp;&nbsp;&nbsp;&nbsp;">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#mdl_delRitasi<?php echo $row->id ?>"><i class="fas fa-trash"></i></button>

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
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Tim</th>
                                                    <th>Proyek</th>
                                                    <th>Lokasi Galian</th>
                                                    <th>No. Polisi</th>
                                                    <th>No. Bak</th>
                                                    <th>Jam Angkut</th>
                                                    <th>Nomer DO</th>
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

                    <div class="modal fade" id="mdl_tmbhRute">
                        <div class="modal-dialog">
                          <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Rute Baru</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="form1" name="form1" action="<?php echo site_url('routes/tambah')?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Asal</label>
                                                    <input type="text" name="asal" value="<?php echo set_value('asal')?>" class="form-control <?php if (form_error('asal')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Tujuan</label>
                                                    <input type="text" name="tujuan" value="<?php echo set_value('tujuan')?>" class="form-control <?php if (form_error('tujuan')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Jarak Rencana (KM)</label>
                                                    <input type="text" name="jarakRencana" value="<?php echo set_value('jarakRencana')?>" class="form-control <?php if (form_error('jarakRencana')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                                    <input type="submit" name="submit" class="btn btn-primary float-right" value="&nbsp;&nbsp;&nbsp;&nbsp;Simpan&nbsp;&nbsp;&nbsp;&nbsp;">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="mdl_tmbhLog">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Log Baru</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="form1" name="form1" action="<?php echo site_url('routes/logadd')?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Tanggal Ritasi</label>
                                                    <div class="input-group date" id="tgl_log" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input" data-target="#tgl_log" data-toggle="datetimepicker" />
                                                        <div class="input-group-append" data-target="#tgl_log">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Kendaraan</label>
                                                    <select name="kendaraan" class="form-control select_rute <?php if (form_error('kendaraan')) {echo "is-invalid";} ?>" style="width:100%;">
                                                        <option value="">--- Pilih Kendaraan ---</option>
                                                        <?php foreach ($kendaraans as $value) { ?>
                                                            <option value='<?php echo $value->id; ?>' <?php echo set_select('kendaraan', $value->id );?> ><?php echo $value->plate_number.' - '.$value->brand.' '.$value->model; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Supir</label>
                                                    <select name="supir" class="form-control select_rute <?php if (form_error('supir')) {echo "is-invalid";} ?>" style="width:100%;">
                                                        <option value="">--- Pilih Supir ---</option>
                                                        <?php foreach ($supirs as $value) { ?>
                                                            <option value='<?php echo $value->id; ?>' <?php echo set_select('supir', $value->id );?> ><?php echo $value->name.' ('.$value->license_number.')'; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Rute</label>
                                                    <select name="rute" class="form-control select_rute <?php if (form_error('rute')) {echo "is-invalid";} ?>" style="width:100%;">
                                                        <option value="">--- Pilih Rute ---</option>
                                                        <?php foreach ($routes as $value) { ?>
                                                            <option value='<?php echo $value->id; ?>' <?php echo set_select('rute', $value->id );?> ><?php echo $value->start_point.' - '.$value->end_point.' ('.$value->actual_distance.' Km)'; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Nomor Bak</label>
                                                    <input type="text" name="noBak" value="<?php echo set_value('noBak')?>" class="form-control <?php if (form_error('noBak')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Jam Angkut</label>
                                                    <!-- <input type="text" name="jamAngkut" value="<?php echo set_value('jamAngkut')?>" class="form-control timepicker <?php if (form_error('jamAngkut')) {echo "is-invalid";} ?>" placeholder="Contoh 13:05" /> -->

                                                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input" data-target="#timepicker" data-toggle="datetimepicker"/>
                                                        <div class="input-group-append" data-target="#timepicker">
                                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Nomor DO</label>
                                                    <input type="text" name="noDo" value="<?php echo set_value('noDo')?>" class="form-control <?php if (form_error('noDo')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Jarak Aktual (Km)</label>
                                                    <input type="text" name="jarakAktual" value="<?php echo set_value('jarakAktual')?>" class="form-control <?php if (form_error('jarakAktual')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Waktu Selesai</label>
                                                    <!-- <input type="text" name="waktuSelesai" value="<?php echo set_value('waktuSelesai')?>" class="form-control <?php if (form_error('waktuSelesai')) {echo "is-invalid";} ?>" id="waktu_selesai" /> -->

                                                    <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime" data-toggle="datetimepicker"/>
                                                        <div class="input-group-append" data-target="#reservationdatetime">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Catatan Tambahan</label>
                                                    <textarea type="text" name="catatan" rows="3" class="form-control <?php if (form_error('catatan')) {echo "is-invalid";} ?>" /></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
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
=======
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6"><h1 class="m-0">Rute & Ritasi</h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Rute & Ritasi</li>
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
                            <div class="col-lg-3 col-6">
                                <div class="small-box callout callout-info">
                                    <div class="inner">
                                        <span>Ritasi Hari Ini</span>
                                        <h3>150</h3>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-shuffle"></i>
                                    </div>
                                    <p class="small-box-footer2">&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-up text-success"></i> <span class="text-success">14%</span> dari kemarin </p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box callout callout-success">
                                    <div class="inner">
                                        <span>Ritasi Bulan Ini</span>
                                        <h3>1248</h3>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-loop"></i>
                                    </div>
                                    <p class="small-box-footer2">&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-up text-success"></i> <span class="text-success">12.7%</span> dari bulan lalu </p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box callout callout-warning">
                                    <div class="inner">
                                        <span>Rata-Rata KM/Hari</span>
                                        <h3>187</h3>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-speedometer"></i>
                                    </div>
                                    <p class="small-box-footer2">&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-down text-danger"></i> <span class="text-danger">5.3%</span> dari bulan lalu </p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box callout callout-danger">
                                    <div class="inner">
                                        <span>Ritasi Tertunda</span>
                                        <h3>3</h3>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-alert-circled"></i>
                                    </div>
                                    <p class="small-box-footer2">&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-down text-danger"></i> <span class="text-danger">25%</span> dari minggu lalu </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="daftar_rute_tab" data-toggle="pill" href="#daftar_rute" role="tab" aria-controls="custom-content-daftar_rute-home" aria-selected="true">Daftar Rute</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="log_ritasi_tab" data-toggle="pill" href="#log_ritasi" role="tab" aria-controls="log_ritasi" aria-selected="false">Log Ritasi Harian</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="statistik_tab" data-toggle="pill" href="#statistik" role="tab" aria-controls="statistik" aria-selected="false">Statistik Ritasi</a>
                                    </li>
                                </ul>
                                <div class="tab-custom-content2">
                                    <p class="lead mb-0">&nbsp;</p>
                                </div>
                                <div class="tab-content" id="custom-content-below-tabContent">
                                    <div class="tab-pane fade show active" id="daftar_rute" role="tabpanel" aria-labelledby="daftar_rute_tab">
                                        <p class="lead2 mb-3">
                                            Daftar Rute
                                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#mdl_tmbhRute">
                                                <i class="fas fa-plus-square"></i>&nbsp;&nbsp; Tambah Rute
                                            </button>
                                        </p>
                                        <table id="tbl_daftarrute" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Asal</th>
                                                    <th>Tujuan</th>
                                                    <th>Jarak (KM)</th>
                                                    <th width="8%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($routes as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $row->start_point; ?></td>
                                                        <td><?php echo $row->end_point; ?></td>
                                                        <td><?php echo $row->planned_distance; ?></td>
                                                        <td width="8%">
                                                            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#mdl_editRute<?php echo $row->id ?>"><i class="fas fa-pencil-alt"></i></button>

                                                            <div class="modal fade" id="mdl_editRute<?php echo $row->id ?>">
                                                                <div class="modal-dialog">
                                                                  <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Edit Rute</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form id="form1" name="form1" action="<?php echo site_url('routes/edit/'.$row->id)?>" method="post" enctype="multipart/form-data">
                                                                                <div class="row">
                                                                                    <div class="col-sm-6">
                                                                                        <div class="form-group">
                                                                                            <label>Asal</label>
                                                                                            <input type="text" name="asal" value="<?php echo set_value('asal',$row->start_point)?>" class="form-control <?php if (form_error('asal')) {echo "is-invalid";} ?>" />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-6">
                                                                                        <div class="form-group">
                                                                                            <label>Tujuan</label>
                                                                                            <input type="text" name="tujuan" value="<?php echo set_value('tujuan',$row->end_point)?>" class="form-control <?php if (form_error('tujuan')) {echo "is-invalid";} ?>" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="form-group">
                                                                                            <label>Jarak Rencana (KM)</label>
                                                                                            <input type="text" name="jarakRencana" value="<?php echo set_value('jarakRencana',$row->planned_distance)?>" class="form-control <?php if (form_error('jarakRencana')) {echo "is-invalid";} ?>" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div>
                                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                                                                            <input type="submit" name="submit" class="btn btn-primary float-right" value="&nbsp;&nbsp;&nbsp;&nbsp;Simpan&nbsp;&nbsp;&nbsp;&nbsp;">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#mdl_delRute<?php echo $row->id ?>"><i class="fas fa-trash"></i></button>

                                                            <div class="modal fade" id="mdl_delRute<?php echo $row->id ?>">
                                                                <div class="modal-dialog">
                                                                  <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Hapus Rute</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form id="form1" name="form1" action="<?php echo site_url('routes/del/'.$row->id)?>" method="post" enctype="multipart/form-data">
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
                                                    <th>Asal</th>
                                                    <th>Tujuan</th>
                                                    <th>Jarak (KM)</th>
                                                    <th width="8%">Aksi</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="log_ritasi" role="tabpanel" aria-labelledby="log_ritasi_tab">
                                        <p class="lead2 mb-3">
                                            Log Ritasi Harian
                                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#mdl_tmbhLog">
                                                <i class="fas fa-plus-square"></i>&nbsp;&nbsp;Tambah Log
                                            </button>
                                        </p>
                                        <table id="tbl_logritasi" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Tim</th>
                                                    <th>Proyek</th>
                                                    <th>Lokasi Galian</th>
                                                    <th>No. Polisi</th>
                                                    <th>No. Bak</th>
                                                    <th>Jam Angkut</th>
                                                    <th>Nomer DO</th>
                                                    <th width="8%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($ritasis as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $this->fppfunction->tglblnthn_ind($row->tgl_ritasi); ?></td>
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
                                                        <td width="8%">
                                                            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#mdl_editRitasi<?php echo $row->id ?>"><i class="fas fa-pencil-alt"></i></button>

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
                                                                                            <input type="text" name="tgl" value="<?php echo set_value('tgl',$row->tgl_ritasi)?>" class="form-control <?php if (form_error('tgl')) {echo "is-invalid";} ?>" />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-6">
                                                                                        <div class="form-group">
                                                                                            <label>Tim</label>
                                                                                            <input type="text" name="tim" value="<?php echo set_value('tim',$row->tim_id)?>" class="form-control <?php if (form_error('tim')) {echo "is-invalid";} ?>" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-sm-6">
                                                                                        <div class="form-group">
                                                                                            <label>Proyek</label>
                                                                                            <input type="text" name="proyek" value="<?php echo set_value('proyek',$row->proyek_id)?>" class="form-control <?php if (form_error('proyek')) {echo "is-invalid";} ?>" />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-6">
                                                                                        <div class="form-group">
                                                                                            <label>Lokasi Galian</label>
                                                                                            <input type="text" name="galian" value="<?php echo set_value('galian',$row->galian_id)?>" class="form-control <?php if (form_error('galian')) {echo "is-invalid";} ?>" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-sm-6">
                                                                                        <div class="form-group">
                                                                                            <label>Kendaraan</label>
                                                                                            <input type="text" name="kendaraan" value="<?php echo set_value('kendaraan',$row->vehicle_id)?>" class="form-control <?php if (form_error('kendaraan')) {echo "is-invalid";} ?>" />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-6">
                                                                                        <div class="form-group">
                                                                                            <label>Jam Angkut</label>
                                                                                            <input type="text" name="jam" value="<?php echo set_value('jam',$row->jam_angkut)?>" class="form-control <?php if (form_error('jam')) {echo "is-invalid";} ?>" />
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
                                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                                                                            <input type="submit" name="submit" class="btn btn-primary float-right" value="&nbsp;&nbsp;&nbsp;&nbsp;Simpan&nbsp;&nbsp;&nbsp;&nbsp;">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#mdl_delRitasi<?php echo $row->id ?>"><i class="fas fa-trash"></i></button>

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
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Tim</th>
                                                    <th>Proyek</th>
                                                    <th>Lokasi Galian</th>
                                                    <th>No. Polisi</th>
                                                    <th>No. Bak</th>
                                                    <th>Jam Angkut</th>
                                                    <th>Nomer DO</th>
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

                    <div class="modal fade" id="mdl_tmbhRute">
                        <div class="modal-dialog">
                          <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Rute Baru</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="form1" name="form1" action="<?php echo site_url('routes/tambah')?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Asal</label>
                                                    <input type="text" name="asal" value="<?php echo set_value('asal')?>" class="form-control <?php if (form_error('asal')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Tujuan</label>
                                                    <input type="text" name="tujuan" value="<?php echo set_value('tujuan')?>" class="form-control <?php if (form_error('tujuan')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Jarak Rencana (KM)</label>
                                                    <input type="text" name="jarakRencana" value="<?php echo set_value('jarakRencana')?>" class="form-control <?php if (form_error('jarakRencana')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                                    <input type="submit" name="submit" class="btn btn-primary float-right" value="&nbsp;&nbsp;&nbsp;&nbsp;Simpan&nbsp;&nbsp;&nbsp;&nbsp;">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="mdl_tmbhLog">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Log Baru</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="form1" name="form1" action="<?php echo site_url('routes/logadd')?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Tanggal Ritasi</label>
                                                    <div class="input-group date" id="tgl_log" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input" data-target="#tgl_log" data-toggle="datetimepicker" />
                                                        <div class="input-group-append" data-target="#tgl_log">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Kendaraan</label>
                                                    <select name="kendaraan" class="form-control select_rute <?php if (form_error('kendaraan')) {echo "is-invalid";} ?>" style="width:100%;">
                                                        <option value="">--- Pilih Kendaraan ---</option>
                                                        <?php foreach ($kendaraans as $value) { ?>
                                                            <option value='<?php echo $value->id; ?>' <?php echo set_select('kendaraan', $value->id );?> ><?php echo $value->plate_number.' - '.$value->brand.' '.$value->model; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Supir</label>
                                                    <select name="supir" class="form-control select_rute <?php if (form_error('supir')) {echo "is-invalid";} ?>" style="width:100%;">
                                                        <option value="">--- Pilih Supir ---</option>
                                                        <?php foreach ($supirs as $value) { ?>
                                                            <option value='<?php echo $value->id; ?>' <?php echo set_select('supir', $value->id );?> ><?php echo $value->name.' ('.$value->license_number.')'; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Rute</label>
                                                    <select name="rute" class="form-control select_rute <?php if (form_error('rute')) {echo "is-invalid";} ?>" style="width:100%;">
                                                        <option value="">--- Pilih Rute ---</option>
                                                        <?php foreach ($routes as $value) { ?>
                                                            <option value='<?php echo $value->id; ?>' <?php echo set_select('rute', $value->id );?> ><?php echo $value->start_point.' - '.$value->end_point.' ('.$value->actual_distance.' Km)'; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Nomor Bak</label>
                                                    <input type="text" name="noBak" value="<?php echo set_value('noBak')?>" class="form-control <?php if (form_error('noBak')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Jam Angkut</label>
                                                    <!-- <input type="text" name="jamAngkut" value="<?php echo set_value('jamAngkut')?>" class="form-control timepicker <?php if (form_error('jamAngkut')) {echo "is-invalid";} ?>" placeholder="Contoh 13:05" /> -->

                                                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input" data-target="#timepicker" data-toggle="datetimepicker"/>
                                                        <div class="input-group-append" data-target="#timepicker">
                                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Nomor DO</label>
                                                    <input type="text" name="noDo" value="<?php echo set_value('noDo')?>" class="form-control <?php if (form_error('noDo')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Jarak Aktual (Km)</label>
                                                    <input type="text" name="jarakAktual" value="<?php echo set_value('jarakAktual')?>" class="form-control <?php if (form_error('jarakAktual')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Waktu Selesai</label>
                                                    <!-- <input type="text" name="waktuSelesai" value="<?php echo set_value('waktuSelesai')?>" class="form-control <?php if (form_error('waktuSelesai')) {echo "is-invalid";} ?>" id="waktu_selesai" /> -->

                                                    <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime" data-toggle="datetimepicker"/>
                                                        <div class="input-group-append" data-target="#reservationdatetime">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Catatan Tambahan</label>
                                                    <textarea type="text" name="catatan" rows="3" class="form-control <?php if (form_error('catatan')) {echo "is-invalid";} ?>" /></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
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
>>>>>>> 73efc7e9b82e023a3212b22621cfe8b8eff37ad0
            <!-- /.content-wrapper -->