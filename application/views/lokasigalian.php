            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6"><h1 class="m-0">Manajemen Lokasi Galian</h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Lokasi Galian</li>
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
                                <h3 class="card-title">Lokasi Galian</h3>
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#mdl_tmbhGalian">
                                    <i class="fas fa-plus-square"></i>&nbsp;&nbsp; Tambah Lokasi
                                </button>
                            </div>
                            <div class="card-body">
                                <table id="tbl_galian" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Proyek</th>
                                            <th>Lokasi Galian</th>
                                            <th>Status</th>
                                            <th width="8%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($galians as $row) { ?>
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
                                                <td><?php echo $row->lokasi; ?></td>
                                                <td><?php echo $row->status_lokasi; ?></td>
                                                <td width="8%">
                                                    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#mdl_editGalian<?php echo $row->id ?>"><i class="fas fa-pencil-alt"></i></button>

                                                    <div class="modal fade" id="mdl_editGalian<?php echo $row->id ?>">
                                                        <div class="modal-dialog">
                                                          <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Edit Lokasi Galian</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="form1" name="form1" action="<?php echo site_url('lokasigalian/edit/'.$row->id)?>" method="post" enctype="multipart/form-data">
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label>Nama Proyek</label>
                                                                                    <select name="nmProyek" class="form-control <?php if (form_error('nmProyek')) {echo "is-invalid";} ?>">
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
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label>Lokasi Galian</label>
                                                                                    <input type="text" name="galian" value="<?php echo set_value('galian',$row->lokasi)?>" class="form-control <?php if (form_error('galian')) {echo "is-invalid";} ?>" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label>Status</label>
                                                                                    <select name="status" class="custom-select <?php if (form_error('status')) {echo "is-invalid";} ?>" style="width:100%;">
                                                                                        <option value=""/>--- Pilih Status ---</option>
                                                                                        <?php
                                                                                            $pilihanstatus=array("Aktif","Non Aktif");
                                                                                            foreach ($pilihanstatus as $value) {
                                                                                                $selected=($value == $row->status_lokasi) ? "selected" : "";
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
                                                                                    <a href="<?php echo site_url('lokasigalian') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

                                                                                    <input type="submit" name="submit" class="btn btn-primary float-right" value="&nbsp;&nbsp;&nbsp;&nbsp;Simpan&nbsp;&nbsp;&nbsp;&nbsp;">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#mdl_delGalian<?php echo $row->id ?>"><i class="fas fa-trash"></i></button>

                                                    <div class="modal fade" id="mdl_delGalian<?php echo $row->id ?>">
                                                        <div class="modal-dialog">
                                                          <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Hapus Lokasi Galian</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="form1" name="form1" action="<?php echo site_url('lokasigalian/del/'.$row->id)?>" method="post" enctype="multipart/form-data">
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
                                                                                    <a href="<?php echo site_url('lokasigalian') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

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
                                            <th>Proyek</th>
                                            <th>Lokasi Galian</th>
                                            <th>Status</th>
                                            <th width="8%">Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">&nbsp;</div>

                    <div class="modal fade" id="mdl_tmbhGalian">
                        <div class="modal-dialog">
                          <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Lokasi Galian Baru</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="form1" name="form1" action="<?php echo site_url('lokasigalian/add')?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-12">
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
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Lokasi Galian</label>
                                                    <input type="text" name="galian" value="<?php echo set_value('galian')?>" class="form-control <?php if (form_error('galian')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" class="custom-select <?php if (form_error('status')) {echo "is-invalid";} ?>" style="width:100%;">
                                                        <option value=""/>--- Pilih Status ---</option>
                                                        <?php 
                                                            $pilihanstatus=array("Aktif","Non Aktif");
                                                            foreach ($pilihanstatus as $value) { 
                                                        ?>
                                                            <option value='<?php echo $value; ?>' <?php echo set_select('status', $value);?> /><?php echo $value; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div>
                                                    <a href="<?php echo site_url('lokasigalian') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

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