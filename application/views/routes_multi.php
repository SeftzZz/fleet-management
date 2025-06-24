<<<<<<< HEAD
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6"><h1 class="m-0">Rekaputilasi Ritasi Harian</h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Rekaputilasi Ritasi Harian</li>
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
                                <h3 class="card-title">Rekaputilasi Ritasi Harian</h3>
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
                                <form id="form1" name="form1" action="<?php echo site_url('routes/ritasiadd')?>" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <div class="input-group date" id="tglan" data-target-input="nearest">
                                                    <input type="text" name="tgl" value="<?php echo set_value('tgl')?>" class="form-control datetimepicker-input" data-target="#tglan" data-toggle="datetimepicker" />
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Proyek</label>
                                                <select name="proyek" class="form-control select_rute <?php if (form_error('proyek')) {echo "is-invalid";} ?>" style="width: 100%;">
                                                    <option value="">--- Pilih Proyek ---</option>
                                                    <?php foreach ($proyeks as $value) { ?>
                                                        <option value='<?php echo $value->id; ?>' <?php echo set_select('proyek', $value->id );?>><?php echo $value->nama_proyek; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Lokasi Galian</label>
                                                <select name="galian" class="form-control select_rute <?php if (form_error('galian')) {echo "is-invalid";} ?>" style="width:100%;">
                                                    <option value="">--- Pilih Lokasi Galian ---</option>
                                                    <?php foreach ($galians as $value) { ?>
                                                        <option value='<?php echo $value->id; ?>' <?php echo set_select('galian', $value->id );?> ><?php echo $value->lokasi; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Tim</label>
                                                <select name="tim" id="tim-select" class="form-control select_rute <?php if (form_error('tim')) {echo "is-invalid";} ?>" style="width: 100%;">
                                                    <option value="">--- Pilih Tim ---</option>
                                                    <?php foreach ($tims as $value) { ?>
                                                        <option value='<?php echo $value->id; ?>' <?php echo set_select('tim', $value->id );?>><?php echo $value->nama_tim; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered" id="kendaraan-table">
                                                <thead>
                                                    <tr>
                                                        <th>List Kendaraan</th>
                                                        <th>Jam Angkut</th>
                                                        <th>No. DO</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Baris kendaraan akan dimasukkan di sini oleh JavaScript -->
                                                </tbody>
                                            </table>
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
                            <div class="col-sm-6"><h1 class="m-0">Rekaputilasi Ritasi Harian</h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Rekaputilasi Ritasi Harian</li>
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
                                <h3 class="card-title">Rekaputilasi Ritasi Harian</h3>
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
                                <form id="form1" name="form1" action="<?php echo site_url('routes/ritasiadd')?>" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <div class="input-group date" id="tglan" data-target-input="nearest">
                                                    <input type="text" name="tgl" value="<?php echo set_value('tgl')?>" class="form-control datetimepicker-input" data-target="#tglan" data-toggle="datetimepicker" />
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Proyek</label>
                                                <select name="proyek" class="form-control select_rute <?php if (form_error('proyek')) {echo "is-invalid";} ?>" style="width: 100%;">
                                                    <option value="">--- Pilih Proyek ---</option>
                                                    <?php foreach ($proyeks as $value) { ?>
                                                        <option value='<?php echo $value->id; ?>' <?php echo set_select('proyek', $value->id );?>><?php echo $value->nama_proyek; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Lokasi Galian</label>
                                                <select name="galian" class="form-control select_rute <?php if (form_error('galian')) {echo "is-invalid";} ?>" style="width:100%;">
                                                    <option value="">--- Pilih Lokasi Galian ---</option>
                                                    <?php foreach ($galians as $value) { ?>
                                                        <option value='<?php echo $value->id; ?>' <?php echo set_select('galian', $value->id );?> ><?php echo $value->lokasi; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Tim</label>
                                                <select name="tim" id="tim-select" class="form-control select_rute <?php if (form_error('tim')) {echo "is-invalid";} ?>" style="width: 100%;">
                                                    <option value="">--- Pilih Tim ---</option>
                                                    <?php foreach ($tims as $value) { ?>
                                                        <option value='<?php echo $value->id; ?>' <?php echo set_select('tim', $value->id );?>><?php echo $value->nama_tim; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered" id="kendaraan-table">
                                                <thead>
                                                    <tr>
                                                        <th>List Kendaraan</th>
                                                        <th>Jam Angkut</th>
                                                        <th>No. DO</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Baris kendaraan akan dimasukkan di sini oleh JavaScript -->
                                                </tbody>
                                            </table>
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
                </section>
                <!-- /.Main content -->
            </div>
>>>>>>> 73efc7e9b82e023a3212b22621cfe8b8eff37ad0
            <!-- /.content-wrapper -->