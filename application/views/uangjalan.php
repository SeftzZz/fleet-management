            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6"><h1 class="m-0">Manajemen Uang Jalan</h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Uang Jalan</li>
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
                                <h3 class="card-title">Uang Jalan</h3>
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#mdl_tmbhUjalan">
                                    <i class="fas fa-plus-square"></i>&nbsp;&nbsp; Tambah Uang Jalan
                                </button>
                            </div>
                            <div class="card-body">
                                <table id="tbl_ujalan" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Proyek</th>
                                            <th>Lokasi Galian</th>
                                            <th>Uang Jalan (Rp)</th>
                                            <th>Status</th>
                                            <th width="8%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ujalans as $row) { ?>
                                            <tr>
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
                                                <td><?php echo $this->fppfunction->rupiah_ind2($row->uang_jalan); ?></td>
                                                <td><?php echo $row->status_uangjalan; ?></td>
                                                <td width="8%">
                                                    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#mdl_editUjalan<?php echo $row->id ?>"><i class="fas fa-pencil-alt"></i></button>

                                                    <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#mdl_delUjalan<?php echo $row->id ?>"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Proyek</th>
                                            <th>Lokasi Galian</th>
                                            <th>Uang Jalan (Rp)</th>
                                            <th>Status</th>
                                            <th width="8%">Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">&nbsp;</div>

                    <div class="modal fade" id="mdl_tmbhUjalan">
                        <div class="modal-dialog">
                          <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Uang Jalan Baru</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="form1" name="form1" action="<?php echo site_url('uangjalan/add')?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Nama Proyek</label>
                                                    <select name="nmProyek" class="form-control select_rute <?php if (form_error('nmProyek')) {echo "is-invalid";} ?>" style="width:100%;">
                                                        <option value="">--- Pilih Proyek ---</option>
                                                        <?php foreach ($proyeks as $value) { ?>
                                                            <option value='<?php echo $value->id; ?>' <?php echo set_select('nmProyek', $value->id );?> ><?php echo $value->nama_proyek; ?></option>
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
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Uang Jalan</label>
                                                    <input type="text" name="uJalan" value="<?php echo set_value('uJalan')?>" class="form-control <?php if (form_error('uJalan')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="statusUjalan" class="custom-select <?php if (form_error('statusUjalan')) {echo "is-invalid";} ?>" style="width:100%;">
                                                        <option value=""/>--- Pilih Status ---</option>
                                                        <?php 
                                                            $pilihanstatus=array("Aktif","Non Aktif");
                                                            foreach ($pilihanstatus as $value) { 
                                                        ?>
                                                            <option value='<?php echo $value; ?>' <?php echo set_select('statusUjalan', $value);?> /><?php echo $value; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div>
                                                    <a href="<?php echo site_url('uangjalan') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

                                                    <input type="submit" name="submit" class="btn btn-primary float-right" value="&nbsp;&nbsp;&nbsp;&nbsp;Simpan&nbsp;&nbsp;&nbsp;&nbsp;">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php foreach ($ujalans as $row) { ?>
                        <div class="modal fade" id="mdl_editUjalan<?php echo $row->id ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Uang Jalan</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form2" name="form2" action="<?php echo site_url('uangjalan/edit/'.$row->id)?>" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Nama Proyek</label>
                                                        <select name="nmProyek" class="form-control select_rute <?php if (form_error('nmProyek')) {echo "is-invalid";} ?>" style="width:100%;">
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
                                                        <label>Uang Jalan</label>
                                                        <input type="text" name="uJalan" value="<?php echo set_value('uJalan',$row->uang_jalan)?>" class="form-control <?php if (form_error('uJalan')) {echo "is-invalid";} ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select name="statusUjalan" class="custom-select <?php if (form_error('statusUjalan')) {echo "is-invalid";} ?>" style="width:100%;">
                                                            <option value=""/>--- Pilih Status ---</option>
                                                            <?php
                                                                $pilihanstatus=array("Aktif","Non Aktif");
                                                                foreach ($pilihanstatus as $value) {
                                                                    $selected=($value == $row->status_uangjalan) ? "selected" : "";
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
                                                        <a href="<?php echo site_url('uangjalan') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

                                                        <input type="submit" name="submit" class="btn btn-primary float-right" value="&nbsp;&nbsp;&nbsp;&nbsp;Simpan&nbsp;&nbsp;&nbsp;&nbsp;">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="mdl_delUjalan<?php echo $row->id ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Hapus Uang Jalan</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form3" name="form3" action="<?php echo site_url('uangjalan/del/'.$row->id)?>" method="post" enctype="multipart/form-data">
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
                                                        <a href="<?php echo site_url('uangjalan') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

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