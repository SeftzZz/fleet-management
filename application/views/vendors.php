            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6"><h1 class="m-0">Manajemen Vendor</h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Vendors</li>
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
                                <h3 class="card-title">Vendor</h3>
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#mdl_tmbhVendor">
                                    <i class="fas fa-plus-square"></i>&nbsp;&nbsp; Tambah Vendor
                                </button>
                            </div>
                            <div class="card-body">
                                <table id="tbl_vendor" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Vendor</th>
                                            <th>Status</th>
                                            <th>Kode</th>
                                            <th width="11%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($vendors as $row) { ?>
                                            <tr>
                                                <td><?php echo $row->name; ?></td>
                                                <td><?php echo $row->status; ?></td>
                                                <td><?php echo $row->kode; ?></td>
                                                <td width="8%">
                                                    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#mdl_editVendor<?php echo $row->id ?>"><i class="fas fa-pencil-alt"></i></button>

                                                    <a href="<?php echo base_url('vendors/items/'.$row->id.'/') ?>" class="btn btn-sm btn-outline-success"><i class="fas fa-list"></i></a>

                                                    <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#mdl_delVendor<?php echo $row->id ?>"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Vendor</th>
                                            <th>Status</th>
                                            <th>Kode</th>
                                            <th width="11%">Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">&nbsp;</div>

                    <div class="modal fade" id="mdl_tmbhVendor">
                        <div class="modal-dialog">
                          <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Vendor Baru</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="form1" name="form1" action="<?php echo site_url('vendors/vendoradd')?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Nama Vendor</label>
                                                    <input type="text" name="nmVendor" value="<?php echo set_value('nmVendor')?>" class="form-control <?php if (form_error('nmVendor')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Kode</label>
                                                    <input type="text" name="kodeVendor" value="<?php echo set_value('kodeVendor')?>" class="form-control <?php if (form_error('kodeVendor')) {echo "is-invalid";} ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="statusVendor" class="custom-select <?php if (form_error('statusVendor')) {echo "is-invalid";} ?>" style="width:100%;">
                                                        <option value="">--- Pilih Status ---</option>
                                                        <?php
                                                            $pilihanstatus = array("Aktif","Non Aktif");
                                                            foreach ($pilihanstatus as $value) {
                                                                $selected = ($value == 'Aktif') ? "selected" : "";
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

                    <?php foreach ($vendors as $row) { ?>
                        <div class="modal fade" id="mdl_editVendor<?php echo $row->id ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Vendor</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form2" name="form2" action="<?php echo site_url('vendors/vendoredit/'.$row->id)?>" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Nama Vendor</label>
                                                        <input type="text" name="nmVendor" value="<?php echo set_value('nmVendor',$row->name)?>" class="form-control <?php if (form_error('nmVendor')) {echo "is-invalid";} ?>" />
                                                    </div>
                                                </div>
                                                <?php if ($row->no_po == '') { ?>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Kode</label>
                                                            <input type="text" name="kodeVendor" value="<?php echo set_value('kodeVendor',$row->kode)?>" class="form-control <?php if (form_error('kodeVendor')) {echo "is-invalid";} ?>" />
                                                        </div>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Kode</label>
                                                            <input type="text" value="<?php echo set_value('kodeVendor',$row->kode)?>" class="form-control <?php if (form_error('kodeVendor')) {echo "is-invalid";} ?>" disabled />
                                                            <input type="hidden" name="kodeVendor" value="<?php echo $row->kode?>">
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>PIC</label>
                                                        <input type="text" name="picVendor" value="<?php echo set_value('picVendor',$row->pic)?>" class="form-control <?php if (form_error('picVendor')) {echo "is-invalid";} ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>No. Telp./Hp.</label>
                                                        <input type="text" name="noTelpVendor" value="<?php echo set_value('noTelpVendor',$row->phone)?>" class="form-control <?php if (form_error('noTelpVendor')) {echo "is-invalid";} ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select name="statusVendor" class="custom-select <?php if (form_error('statusVendor')) {echo "is-invalid";} ?>" style="width:100%;">
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
                                                    <div class="form-group">
                                                        <label>Alamat</label>
                                                        <textarea rows="3" name="alamatVendor" class="form-control <?php if (form_error('alamatVendor')) {echo "is-invalid";} ?>"><?php echo $row->address ?></textarea>
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

                        <div class="modal fade" id="mdl_delVendor<?php echo $row->id ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Hapus Vendor</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form3" name="form3" action="<?php echo site_url('vendors/vendordel/'.$row->id)?>" method="post" enctype="multipart/form-data">
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
                                                        <a href="<?php echo site_url('vendors') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

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