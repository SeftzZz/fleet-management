            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6"><h1 class="m-0">Manajemen Sparepart</h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo site_url('vendors') ?>">Vendor</a></li>
                                    <li class="breadcrumb-item active">Sparepart</li>
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
                                <h3 class="card-title">
                                    Sparepart Vendor
                                    <?php 
                                        $this->db->select('name'); 
                                        $this->db->from('vendors'); 
                                        $this->db->where('id', $vendor_id);
                                        $query = $this->db->get();
                                        if ($query->num_rows() > 0) {
                                            $vendor = $query->row();
                                        } 
                                        $query->free_result();
                                        echo $vendor->name;
                                    ?>
                                </h3>
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#mdl_tmbhSparepart">
                                    <i class="fas fa-plus-square"></i>&nbsp;&nbsp; Tambah Sparepart
                                </button>
                            </div>
                            <div class="card-body">
                                <table id="tbl_Sparepart" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sparepart</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                            <th width="8%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($sparepart as $row) { ?>
                                            <tr>
                                                <td><?php echo $row->sparepart; ?></td>
                                                <td>Rp <?php echo $this->fppfunction->rupiah_ind2($row->harga); ?></td>
                                                <td><?php echo $row->status; ?></td>
                                                <td width="8%">
                                                    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#mdl_editSparepart<?php echo $row->id ?>"><i class="fas fa-pencil-alt"></i></button>

                                                    <!-- <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#mdl_delSparepart<?php echo $row->id ?>"><i class="fas fa-trash"></i></button> -->
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Sparepart</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                            <th width="8%">Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">&nbsp;</div>

                    <div class="modal fade" id="mdl_tmbhSparepart">
                        <div class="modal-dialog">
                          <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Sparepart Baru</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="form1" name="form1" action="<?php echo site_url('vendors/sparepartadd/'.$vendor_id)?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="vendor_id" value="<?php echo $vendor_id ?>">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Sparepart</label>
                                                    <input type="text" name="sparepart" value="<?php echo set_value('sparepart')?>" class="form-control <?php if (form_error('sparepart')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Harga</label>
                                                    <input type="text" name="harga" value="<?php echo set_value('harga')?>" class="form-control <?php if (form_error('harga')) {echo "is-invalid";} ?>" />
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
                                                    <a href="<?php echo site_url('vendors') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

                                                    <input type="submit" name="submit" class="btn btn-primary float-right" value="&nbsp;&nbsp;&nbsp;&nbsp;Simpan&nbsp;&nbsp;&nbsp;&nbsp;">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php foreach ($sparepart as $row) { ?>
                        <div class="modal fade" id="mdl_editSparepart<?php echo $row->id ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Sparepart</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form2" name="form2" action="<?php echo site_url('vendors/sparepartedit/'.$row->id)?>" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="vendor_id" value="<?php echo $vendor_id ?>">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Sparepart</label>
                                                        <input type="text" name="sparepart" value="<?php echo set_value('sparepart',$row->sparepart)?>" class="form-control <?php if (form_error('sparepart')) {echo "is-invalid";} ?>" disabled />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Harga</label>
                                                        <input type="text" name="harga" value="<?php echo set_value('harga',$row->harga)?>" class="form-control <?php if (form_error('harga')) {echo "is-invalid";} ?>" disabled />
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
                                                        <a href="<?php echo site_url('vendors/items/'.$vendor_id.'/') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

                                                        <input type="submit" name="submit" class="btn btn-primary float-right" value="&nbsp;&nbsp;&nbsp;&nbsp;Simpan&nbsp;&nbsp;&nbsp;&nbsp;">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="modal fade" id="mdl_delSparepart<?php echo $row->id ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Hapus Sparepart</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form3" name="form3" action="<?php echo site_url('vendors/sparepartdel/'.$row->id)?>" method="post" enctype="multipart/form-data">
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
                                                        <a href="<?php echo site_url('vendors/items/'.$vendor_id) ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

                                                        <input type="submit" name="submit" class="btn btn-primary float-right" value="&nbsp;&nbsp;&nbsp;&nbsp;Ya&nbsp;&nbsp;&nbsp;&nbsp;">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    <?php } ?>
                </section>
                <!-- /.Main content -->
            </div>
            <!-- /.content-wrapper -->