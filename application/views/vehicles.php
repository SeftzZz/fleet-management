            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6"><h1 class="m-0">Manajemen Kendaraan</h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Manajemen Kendaraan</li>
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
                                <h3 class="card-title">Filter Manajemen Kendaraan</h3>
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
                                <form id="form1" name="form1" action="<?php echo site_url('vehicles')?>" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>No. Polisi</label>
                                                <select name="noPol" class="form-control select_rute" style="width:100%;">
                                                    <option value=""></option>
                                                    <?php foreach ($vehicles as $value) { ?>
                                                        <option value='<?php echo $value->no_pol; ?>' <?php echo set_select('noPol', $value->no_pol );?> ><?php echo $value->no_pol; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>No. Pintu/Bak/Unit</label>
                                                <select name="noPintu" class="form-control select_rute" style="width:100%;">
                                                    <option value=""></option>
                                                    <?php foreach ($vehicles as $value) { ?>
                                                        <option value='<?php echo $value->no_pintu; ?>' <?php echo set_select('noPintu', $value->no_pintu );?> ><?php echo $value->no_pintu; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="statusCariMobil" class="custom-select" style="width:100%;">
                                                    <option value=""/>--- Pilih Status ---</option>
                                                    <?php 
                                                        $pilihanstatus=array("Aktif","Non Aktif");
                                                        foreach ($pilihanstatus as $value) { 
                                                    ?>
                                                        <option value='<?php echo $value; ?>' <?php echo set_select('statusCariMobil', $value);?> /><?php echo $value; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="row">
                                        <div class="col-md-12">
                                            <center>
                                                <a href="<?php echo site_url('vehicles') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reset&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
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
                                        <a class="nav-link active" id="log_ritasi_tab" data-toggle="pill" href="#log_ritasi" role="tab" aria-controls="log_ritasi" aria-selected="false">Manajemen Kendaraan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="statistik_tab" data-toggle="pill" href="#statistik" role="tab" aria-controls="statistik" aria-selected="false">Dokumen Kendaraan</a>
                                    </li>
                                </ul>
                                <div class="tab-custom-content2">
                                    <p class="lead mb-0">&nbsp;</p>
                                </div>
                                <div class="tab-content" id="custom-content-below-tabContent">
                                    <div class="tab-pane fade show active" id="log_ritasi" role="tabpanel" aria-labelledby="log_ritasi_tab">
                                        <p class="lead2 mb-3">
                                            Manajemen Kendaran
                                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#mdl_tmbhMobil">
                                                <i class="fas fa-plus-square"></i>&nbsp;&nbsp;Tambah Kendaran
                                            </button>
                                        </p>
                                        <table id="tbl_manajemenvehicles" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No. Polisi</th>                                                    
                                                    <th>No. Pintu/Bak/Unit</th>
                                                    <th>Type</th>
                                                    <th>Warna</th>
                                                    <th>Status</th>
                                                    <th width="8%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($vehicles as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $row->no_pol ?></td>
                                                        <td><?php echo $row->no_pintu ?></td>
                                                        <td><?php echo $row->type ?></td>
                                                        <td><?php echo $row->warna ?></td>
                                                        <td><?php echo $row->status ?></td>
                                                        <td width="8%">
                                                            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#mdl_editvehicles<?php echo $row->id ?>"><i class="fas fa-pencil-alt"></i></button>

                                                            <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#mdl_delvehicles<?php echo $row->id ?>"><i class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No. Polisi</th>                                                    
                                                    <th>No. Bak</th>
                                                    <th>Type</th>
                                                    <th>Warna</th>
                                                    <th>Status</th>
                                                    <th width="8%">Aksi</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="statistik" role="tabpanel" aria-labelledby="statistik_tab">
                                        <form id="form1" name="form1" action="<?php echo site_url('vehicles/vehiclesdocumentadd/')?>" method="post" enctype="multipart/form-data">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Pilih Kendaraan</label>
                                                    <select class="form-select form-control" name="vehicle_id">
                                                        <option selected>Pilih kendaraan...</option>
                                                        <?php foreach ($vehicles as $value) { ?>
                                                            <option value='<?php echo $value->id; ?>' <?php echo set_select('vehicle_id', $value->id );?> ><?php echo $value->no_pol; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Jenis Dokumen</label>
                                                    <select class="form-select form-control" name="doc_type">
                                                        <option selected>Pilih jenis...</option>
                                                        <!-- <?php foreach ($v_doc_detail as $value) { ?>
                                                            <option value='<?php echo $value->name; ?>' <?php echo set_select('doc_type', $value->id );?> ><?php echo $value->name; ?></option>
                                                        <?php } ?> -->
                                                        <option>STNK</option>
                                                        <option>KIR</option>
                                                        <option>Asuransi</option>
                                                        <option>BPKB</option>
                                                        <option>Lainnya</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>No. Dokumen</label>
                                                        <input type="text" name="doc_number" value="<?php echo set_value('doc_number')?>" class="form-control <?php if (form_error('doc_number')) {echo "is-invalid";} ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Tanggal Expired</label>
                                                    <input type="date" name="expiry_date" value="<?php echo set_value('expiry_date')?>" class="form-control <?php if (form_error('expiry_date')) {echo "is-invalid";} ?>" />
                                                </div>
                                                <!-- <div class="col-md-8">
                                                    <label class="form-label">Upload File</label>
                                                    <input class="form-control" type="file">
                                                </div> -->
                                                <div class="col-md-4 d-flex align-items-end">
                                                    <center>
                                                        <a href="<?php echo site_url('vehicles') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reset&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="submit" name="submit" class="btn btn-primary" value="&nbsp;&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;&nbsp;">
                                                    </center>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">&nbsp;</div>

                    <div class="modal fade" id="mdl_tmbhMobil">
                        <div class="modal-dialog">
                          <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah vehicles Baru</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="form1" name="form1" action="<?php echo site_url('vehicles/vehiclesadd')?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>No. Polisi</label>
                                                    <input type="text" name="no_pol" value="<?php echo set_value('no_pol')?>" class="form-control <?php if (form_error('no_pol')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>No. Bak</label>
                                                    <input type="text" name="no_pintu" value="<?php echo set_value('no_pintu')?>" class="form-control <?php if (form_error('no_pintu')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Type</label>
                                                    <select name="type" class="form-control <?php if (form_error('type')) {echo "is-invalid";} ?>" style="width:100%;"/>
                                                        <option value=""/>--- Pilih Type ---</option>
                                                        <?php
                                                            $pilihantype=array("FM 260 JD","GIGA FVZ N");
                                                            foreach ($pilihantype as $value) {
                                                                $selected=($value == $row->type) ? "selected" : "";
                                                                echo "<option value='$value' $selected>$value</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Warna</label>
                                                    <input type="text" name="warna" value="<?php echo set_value('warna')?>" class="form-control <?php if (form_error('warna')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" class="form-control <?php if (form_error('status')) {echo "is-invalid";} ?>" style="width:100%;"/>
                                                        <option value=""/>--- Pilih Status ---</option>
                                                        <?php
                                                            $pilihanstatus=array("Aktif","Non Aktif");
                                                            foreach ($pilihanstatus as $value) {
                                                                $selected=($value == $row->status) ? "selected" : "";
                                                                echo "<option value='$value' $selected>$value</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div>
                                                    <a href="<?php echo site_url('vehicles') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                                    <input type="submit" name="submit" class="btn btn-primary float-right" value="&nbsp;&nbsp;&nbsp;&nbsp;Simpan&nbsp;&nbsp;&nbsp;&nbsp;">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php foreach ($vehicles as $row) { ?>
                        <div class="modal fade" id="mdl_editvehicles<?php echo $row->id ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Kendaraan</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form1" name="form1" action="<?php echo site_url('vehicles/vehiclesedit/'.$row->id)?>" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>No. Polisi</label>
                                                        <input type="text" name="no_pol" value="<?php echo set_value('no_pol',$row->no_pol)?>" class="form-control <?php if (form_error('no_pol')) {echo "is-invalid";} ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>No. Bak</label>
                                                        <input type="text" name="no_pintu" value="<?php echo set_value('no_pintu',$row->no_pintu)?>" class="form-control <?php if (form_error('no_pintu')) {echo "is-invalid";} ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Type</label>
                                                        <input type="text" name="type" value="<?php echo set_value('type',$row->type)?>" class="form-control <?php if (form_error('type')) {echo "is-invalid";} ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Warna</label>
                                                        <input type="text" name="warna" value="<?php echo set_value('warna',$row->warna)?>" class="form-control <?php if (form_error('warna')) {echo "is-invalid";} ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select id="status<?php echo $row->id ?>" name="status" class="form-control <?php if (form_error('status')) {echo "is-invalid";} ?>" style="width:100%;">
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
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <center>
                                                        <a href="<?php echo site_url('vehicles') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reset&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="submit" name="submit" class="btn btn-primary" value="&nbsp;&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;&nbsp;">
                                                    </center>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="mdl_delvehicles<?php echo $row->id ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Hapus Kendaraan</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form1" name="form1" action="<?php echo site_url('vehicles/vehiclesdel/'.$row->id)?>" method="post" enctype="multipart/form-data">
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
                                                    <center>
                                                        <a href="<?php echo site_url('vehicles') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reset&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="submit" name="submit" class="btn btn-primary" value="&nbsp;&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;&nbsp;">
                                                    </center>
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