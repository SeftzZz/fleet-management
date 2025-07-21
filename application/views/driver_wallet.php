            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6"><h1 class="m-0">Manajemen Supir</h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo site_url('drivers') ?>">Manajemen Supir</a></li>
                                    <li class="breadcrumb-item active">Manajemen Wallet Supir</li>
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
                                        <span>Total Saldo Wallet</span>
                                        <h3><?php echo $this->fppfunction->rupiah_ind($jmltotalsaldo) ?></h3>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-wallet"></i>
                                    </div>
                                    <p class="small-box-footer2">&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-up text-success"></i> <span class="text-success">14%</span> dari kemarin </p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-6">
                                <div class="small-box callout callout-success">
                                    <div class="inner">
                                        <span>Top Saldo Tertinggi</span>
                                        <h3><?php echo $this->fppfunction->rupiah_ind($jmlhighestsaldo) ?></h3>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-trophy"></i>
                                    </div>
                                    <p class="small-box-footer2">
                                        &nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-up text-success"></i> 
                                        <span class="text-success"><?php echo $nmhighestsaldo ?></span> 
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Filter Wallet Supir</h3>
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Supir</label>
                                            <input type="text" name="nmSupir" id="nmSupir" value="<?php echo set_value('nmSupir')?>" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status Wallet</label>
                                            <select name="statusWallet" id="statusWallet" class="custom-select" style="width:100%;">
                                                <option value=""/>--- Pilih Status ---</option>
                                                <?php 
                                                    $pilihanstatus=array("Aktif","Non Aktif");
                                                    foreach ($pilihanstatus as $value) { 
                                                ?>
                                                    <option value='<?php echo $value; ?>' <?php echo set_select('statusWallet', $value);?> /><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>
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
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo site_url('drivers') ?>"/>Manajemen Supir</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="<?php echo site_url('drivers/wallet') ?>" />Manajemen Wallet Supir</a>
                                    </li>
                                </ul>
                                <div class="tab-custom-content2">
                                    <p class="lead mb-0">&nbsp;</p>
                                </div>
                                <div class="tab-content" id="custom-content-below-tabContent">
                                    <div class="tab-pane fade show active" id="mgmt_wallet" role="tabpanel" aria-labelledby="mgmt_wallet_tab">
                                        <p class="lead2 mb-3">
                                            Manajemen Wallet Supir
                                        </p>
                                        <table id="tbl_manajemenwallet" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Balance</th>
                                                    <th>Status Wallet</th>
                                                    <th>Update At</th>
                                                    <th width="8%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Balance</th>
                                                    <th>Status Wallet</th>
                                                    <th>Update At</th>
                                                    <th width="8%">Aksi</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">&nbsp;</div>
                </section>
                <!-- /.Main content -->
            </div>
            <!-- /.content-wrapper -->