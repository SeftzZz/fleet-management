            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6"><h1 class="m-0">Manajemen Tim</h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Tim</li>
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
                                <h3 class="card-title">Tim</h3>
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#mdl_tmbhTim">
                                    <i class="fas fa-plus-square"></i>&nbsp;&nbsp; Tambah Tim
                                </button>
                            </div>
                            <div class="card-body">
                                <table id="tbl_tim" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Tim</th>
                                            <th>Status</th>
                                            <th width="8%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tims as $row) { ?>
                                            <tr>
                                                <td><?php echo $row->nama_tim; ?></td>
                                                <td><?php echo $row->status_tim; ?></td>
                                                <td width="8%">
                                                    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#mdl_editTim<?php echo $row->id ?>"><i class="fas fa-pencil-alt"></i></button>

                                                    <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#mdl_delTim<?php echo $row->id ?>"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Tim</th>
                                            <th>Status</th>
                                            <th width="8%">Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">&nbsp;</div>

                    <div class="modal fade" id="mdl_tmbhTim">
                        <div class="modal-dialog">
                          <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Tim Baru</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="form1" name="form1" action="<?php echo site_url('tim/add')?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Nama Tim</label>
                                                    <input type="text" name="nmTim" value="<?php echo set_value('nmTim')?>" class="form-control <?php if (form_error('nmTim')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="statusTim" class="custom-select <?php if (form_error('statusTim')) {echo "is-invalid";} ?>" style="width:100%;">
                                                        <option value=""/>--- Pilih Status ---</option>
                                                        <?php 
                                                            $pilihanstatus=array("Aktif","Non Aktif");
                                                            foreach ($pilihanstatus as $value) { 
                                                        ?>
                                                            <option value='<?php echo $value; ?>' <?php echo set_select('statusTim', $value);?> /><?php echo $value; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div>
                                                    <a href="<?php echo site_url('tim') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

                                                    <input type="submit" name="submit" class="btn btn-primary float-right" value="&nbsp;&nbsp;&nbsp;&nbsp;Simpan&nbsp;&nbsp;&nbsp;&nbsp;">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php foreach ($tims as $row) { ?>
                        <div class="modal fade" id="mdl_editTim<?php echo $row->id ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Tim</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form1" name="form1" action="<?php echo site_url('tim/edit/'.$row->id)?>" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Nama Tim</label>
                                                        <input type="text" name="nmTim" value="<?php echo set_value('nmTim',$row->nama_tim)?>" class="form-control <?php if (form_error('nmTim')) {echo "is-invalid";} ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select name="statusTim" class="custom-select <?php if (form_error('statusTim')) {echo "is-invalid";} ?>" style="width:100%;">
                                                            <option value=""/>--- Pilih Status ---</option>
                                                            <?php
                                                                $pilihanstatus=array("Aktif","Non Aktif");
                                                                foreach ($pilihanstatus as $value) {
                                                                    $selected=($value == $row->status_tim) ? "selected" : "";
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
                                                        <a href="<?php echo site_url('tim') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

                                                        <input type="submit" name="submit" class="btn btn-primary float-right" value="&nbsp;&nbsp;&nbsp;&nbsp;Simpan&nbsp;&nbsp;&nbsp;&nbsp;">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="mdl_delTim<?php echo $row->id ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Hapus Tim</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form1" name="form1" action="<?php echo site_url('tim/del/'.$row->id)?>" method="post" enctype="multipart/form-data">
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
                                                        <a href="<?php echo site_url('tim') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

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