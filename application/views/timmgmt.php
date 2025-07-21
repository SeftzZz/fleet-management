            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6"><h1 class="m-0">Manajemen Anggota Tim</h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Anggota Tim</li>
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
                                <h3 class="card-title">Filter Anggota Tim</h3>
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
                                <form id="form1" name="form1" action="<?php echo site_url('timmgmt')?>" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Nama Tim</label>
                                                <select name="nmTim" class="form-control" style="width:100%;">
                                                        <option value="">Semua Tim</option>
                                                        <?php foreach ($tims as $value) { ?>
                                                            <option value='<?php echo $value->id; ?>' <?php echo set_select('nmTim', $value->id );?> ><?php echo 'Tim '.$value->nama_tim; ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Nama Supir</label>
                                                <input type="text" name="nmSupir" value="<?php echo set_value('nmSupir')?>" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>No. Polisi</label>
                                                <select name="noPol" class="form-control select_rute" style="width:100%;">
                                                    <option value=""></option>
                                                    <?php foreach ($mobils as $value) { ?>
                                                        <option value='<?php echo $value->no_pol; ?>' <?php echo set_select('noPol', $value->no_pol );?> ><?php echo $value->no_pol; ?></option>
                                                    <?php } ?>
                                                </select>
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
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="statusAtim" class="custom-select" style="width:100%;">
                                                    <option value=""/>--- Pilih Status ---</option>
                                                    <?php 
                                                        $pilihanstatus=array("Aktif","Non Aktif");
                                                        foreach ($pilihanstatus as $value) { 
                                                    ?>
                                                        <option value='<?php echo $value; ?>' <?php echo set_select('statusAtim', $value);?> /><?php echo $value; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>     
                                    <div class="row">
                                        <div class="col-md-12">
                                            <center>
                                                <a href="<?php echo site_url('timmgmt') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reset&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
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
                            <div class="card-header">
                                <h3 class="card-title">Anggota Tim</h3>
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#mdl_tmbhAtim">
                                    <i class="fas fa-plus-square"></i>&nbsp;&nbsp; Tambah Anggota Tim
                                </button>
                            </div>
                            <div class="card-body">
                                <table id="tbl_atim" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Tim</th>
                                            <th>Supir</th>
                                            <th>No. Polisi</th>
                                            <th>No. Pintu/Bak/Unit</th>
                                            <th>Status</th>
                                            <th>Tgl. Update</th>
                                            <th width="8%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($atims as $row) { ?>
                                            <tr>
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
                                                        $this->db->select('name'); 
                                                        $this->db->from('drivers'); 
                                                        $this->db->where('id', $row->driver_id);
                                                        $query = $this->db->get();
                                                        if ($query->num_rows() > 0) {
                                                            $supir = $query->row();
                                                        } 
                                                        $query->free_result();
                                                        echo $supir->name ?? '-';  
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
                                                        echo $mobil->no_pol ?? '-';  
                                                    ?>
                                                </td>
                                                <td><?php echo $mobil->no_pintu ?? '-'; ?></td>
                                                <td><?php echo $row->status_tim_mgmt; ?></td>
                                                <td><?php echo $this->fppfunction->tglangkajam_ind($row->updated_at); ?></td>
                                                <td width="8%">
                                                    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#mdl_editAtim<?php echo $row->id ?>" data-timid="<?php echo $row->tim_id ?>"><i class="fas fa-pencil-alt"></i></button>

                                                    <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#mdl_delAtim<?php echo $row->id ?>"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Tim</th>
                                            <th>Supir</th>
                                            <th>No. Polisi</th>
                                            <th>No.Unit/No. Bak</th>
                                            <th>Status</th>
                                            <th>Tgl. Update</th>
                                            <th width="8%">Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">&nbsp;</div>

                    <div class="modal fade" id="mdl_tmbhAtim">
                        <div class="modal-dialog">
                          <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Anggota Tim Baru</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="form4" name="form4" action="<?php echo site_url('timmgmt/add')?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Nama Tim</label>
                                                    <select name="nmTim" class="form-control select_rute <?php if (form_error('nmTim')) {echo "is-invalid";} ?>" style="width:100%;">
                                                        <option value="">--- Pilih Tim ---</option>
                                                        <?php foreach ($tims as $value) { ?>
                                                            <option value='<?php echo $value->id; ?>' <?php echo set_select('nmTim', $value->id );?> ><?php echo $value->nama_tim; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Nama Supir</label>
                                                    <select name="nmSupir" class="form-control select_rute <?php if (form_error('nmSupir')) {echo "is-invalid";} ?>" style="width:100%;">
                                                        <option value="">--- Pilih Supir ---</option>
                                                        <?php foreach ($supirs as $value) { ?>
                                                            <option value='<?php echo $value->id; ?>' <?php echo set_select('nmSupir', $value->id );?> ><?php echo $value->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Kendaraan</label>
                                                    <select name="mobil" class="form-control select_rute <?php if (form_error('mobil')) {echo "is-invalid";} ?>" style="width:100%;">
                                                        <option value="">--- Pilih Kendaraan ---</option>
                                                        <?php foreach ($mobils as $value) { ?>
                                                            <option value='<?php echo $value->id; ?>' <?php echo set_select('mobil', $value->id );?> ><?php echo $value->no_pintu; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="statusAtim" class="custom-select <?php if (form_error('statusAtim')) {echo "is-invalid";} ?>" style="width:100%;">
                                                        <option value=""/>--- Pilih Status ---</option>
                                                        <?php 
                                                            $pilihanstatus=array("Aktif","Non Aktif");
                                                            foreach ($pilihanstatus as $value) { 
                                                        ?>
                                                            <option value='<?php echo $value; ?>' <?php echo set_select('statusAtim', $value);?> /><?php echo $value; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div>
                                                    <a href="<?php echo site_url('timmgmt') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

                                                    <input type="submit" name="submit" class="btn btn-primary float-right" value="&nbsp;&nbsp;&nbsp;&nbsp;Simpan&nbsp;&nbsp;&nbsp;&nbsp;">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php foreach ($atims as $row) { ?>
                        <div class="modal fade" id="mdl_editAtim<?php echo $row->id ?>" data-timid="<?php echo $row->tim_id ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Anggota Tim</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form2" name="form2" action="<?php echo site_url('timmgmt/edit/'.$row->id)?>" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Nama Tim</label>
                                                        <select name="nmTim" class="form-control select_rute <?php if (form_error('nmTim')) {echo "is-invalid";} ?>" style="width:100%;" disabled="disabled" />
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
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Nama Supir</label>
                                                        <select name="nmSupir" class="form-control select_rute <?php if (form_error('nmSupir')) {echo "is-invalid";} ?>" style="width:100%;" disabled="disabled" />
                                                            <option value="">--- Pilih Supir ---</option>
                                                            <?php
                                                                foreach ($supirs as $value) {
                                                                  $selected=($value->id == $row->driver_id) ? "selected" : "";
                                                                  echo " <option value='$value->id' $selected>$value->name</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                        <input type="hidden" name="nmSupir" value="<?php echo $row->driver_id; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Kendaraan</label>
                                                        <select name="mobil" class="form-control select_rute" data-selected="<?php echo $row->vehicle_id ?>" style="width:100%;" disabled="disabled" />
                                                            <option value="">--- Pilih Kendaraan ---</option>
                                                            <?php
                                                                foreach ($mobils as $value) {
                                                                  $selected=($value->id == $row->vehicle_id) ? "selected" : "";
                                                                  echo " <option value='$value->id' $selected>$value->no_pintu</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                        <input type="hidden" name="mobil" value="<?php echo $row->vehicle_id; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select name="statusAtim" class="form-control <?php if (form_error('statusAtim')) {echo "is-invalid";} ?>" style="width:100%;"/>
                                                            <option value=""/>--- Pilih Status ---</option>
                                                            <?php
                                                                $pilihanstatus=array("Aktif","Non Aktif");
                                                                foreach ($pilihanstatus as $value) {
                                                                    $selected=($value == $row->status_tim_mgmt) ? "selected" : "";
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
                                                        <a href="<?php echo site_url('timmgmt') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

                                                        <input type="submit" name="submit" class="btn btn-primary float-right" value="&nbsp;&nbsp;&nbsp;&nbsp;Simpan&nbsp;&nbsp;&nbsp;&nbsp;">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="mdl_delAtim<?php echo $row->id ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Hapus Anggota Tim</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form3" name="form3" action="<?php echo site_url('timmgmt/del/'.$row->id)?>" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Yakin menghapus data ini!</label>
                                                        <input type="hidden" name="del" value="1">
                                                        <input type="hidden" name="nmSupir" value="<?php echo $row->driver_id; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div>
                                                        <a href="<?php echo site_url('timmgmt') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

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

