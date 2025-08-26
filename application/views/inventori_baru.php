            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6"><h1 class="m-0">Inventori</h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo site_url('inventori/baru') ?>">Inventori</a></li>
                                    <li class="breadcrumb-item active">Inventori Barang Baru</li>
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
                            <div class="col-lg-6 col-6">
                                <div class="small-box callout callout-info">
                                    <div class="inner">
                                        <span>Total Barang</span>
                                        <h3><?php echo $total_barang ?></h3>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-boxes"></i>
                                    </div>
                                    <p class="small-box-footer2">
                                        &nbsp;&nbsp;&nbsp;
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-6">
                                <div class="small-box callout callout-success" id="stokHabisBox" style="cursor:pointer;">
                                    <div class="inner">
                                        <span>Stok Habis</span>
                                        <h3><?php echo $stok_habis ?></h3>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <p class="small-box-footer2">
                                        &nbsp;&nbsp;&nbsp;
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Filter Inventori Barang Baru</h3>
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nama Barang</label>
                                            <input type="text" name="nmBarang" id="nmBarang" value="<?php echo set_value('nmBarang')?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>   
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                            <button id="btnReset" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;Reset&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button id="btnFilter" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;Filter&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                        </center>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Inventori Barang Baru</h3>
                            </div>
                            <div class="card-body">
                                <table id="tbl_inventoryBaru" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Qty</th>
                                            <th>Terpakai</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Qty</th>
                                            <th>Terpakai</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">&nbsp;</div>
                </section>
                <!-- /.Main content -->
            </div>
            <!-- /.content-wrapper -->