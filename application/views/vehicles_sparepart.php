            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6"><h1 class="m-0">Sparepart Kendaraan</h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Sparepart Kendaraan</li>
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
                                                <label>Sparepart</label>
                                                <select name="name" class="form-control select_rute" style="width:100%;">
                                                    <option value=""></option>
                                                    <?php foreach($vehicle_inventori as $value): ?>
                                                        <option value='<?php echo $value->id; ?>'><?php echo htmlspecialchars($value['name']) ?></option>
                                                    <?php endforeach; ?>
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
                            <div class="card-header">
                                <h3 class="card-title">Sparepart Kendaraan</h3>
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
                                <?php if(isset($filter_applied) && $filter_applied): ?>
                                    <form id="form1" name="form1" action="<?php echo site_url('vehicles/vehiclessparepartadd/') ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="no_pintu" value="<?php echo $filter_no_pintu ?>">

                                        <div class="table-responsive">
                                            <table id="tbl_manajemenvehicles" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Sparepart</th>
                                                        <th>Stok Inventori</th>
                                                        <th>Owned</th>
                                                        <th>Tambah QTY</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($vehicle_inventori as $row): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($row['name']) ?></td>
                                                        <td><strong><?php echo $row['inventory_qty'] ?></strong></td>
                                                        <td><strong><?php echo $row['vehicle_qty'] ?></strong></td>
                                                        <td>
                                                            <input type="number"
                                                                   name="qty[<?php echo $row['id'] ?>]"
                                                                   placeholder="0"
                                                                   class="form-control <?php if (form_error('qty['.$row['id'].']')) {echo 'is-invalid';} ?>"
                                                                   max="<?php echo $row['inventory_qty'] ?>" />
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="text-center mt-3">
                                            <a href="<?php echo site_url('vehicles') ?>" class="btn btn-default">Reset</a>
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                                        </div>
                                    </form>
                                <?php else: ?>
                                    <div class="alert alert-info">
                                        Silakan terapkan filter terlebih dahulu untuk melihat dan mengelola sparepart kendaraan.
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.Main content -->
            </div>
            <!-- /.content-wrapper -->