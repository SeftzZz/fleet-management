            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6"><h1 class="m-0">Manajemen Klaim Wallet</h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Manajemen Klaim Wallet</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="card" style="z-index:99;">
                            <div class="card-header">
                                <h3 class="card-title">Filter Data Klaim Wallet</h3>
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nama Supir</label>
                                            <input type="text" name="nmSupir" id="nmSupir" value="<?php echo set_value('nmSupir')?>" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Bulan</label>
                                            <select name="blnKlaim" id="blnKlaim" class="form-control" style="width:100%;">
                                                <option value="">--- Pilih Bulan ---</option>
                                                <?php
                                                    $bulanList = [
                                                        '01' => 'Januari',
                                                        '02' => 'Februari',
                                                        '03' => 'Maret',
                                                        '04' => 'April',
                                                        '05' => 'Mei',
                                                        '06' => 'Juni',
                                                        '07' => 'Juli',
                                                        '08' => 'Agustus',
                                                        '09' => 'September',
                                                        '10' => 'Oktober',
                                                        '11' => 'November',
                                                        '12' => 'Desember'
                                                    ];
                                                    foreach ($bulanList as $num => $nama) {
                                                        echo "<option value='$num'>$nama</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tahun</label>
                                            <select name="thnKlaim" id="thnKlaim" class="form-control" style="width:100%;">
                                                <option value="">--- Pilih Tahun ---</option>
                                                <?php
                                                    $tahunSekarang = date('Y');
                                                    for ($i = $tahunSekarang; $i >= $tahunSekarang - 5; $i--) {
                                                        echo "<option value='$i'>$i</option>";
                                                    }
                                                ?>
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
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('wallet') ?>" class="nav-link"/>Form Wallet</a>
                                    </li>
                                    <li class="nav-item active">
                                        <a href="<?php echo site_url('wallet/walletlog') ?>" class="nav-link active"/>Log Klaim Wallet</a>
                                    </li>
                                </ul>
                                <div class="tab-custom-content2">
                                    <p class="lead mb-0">&nbsp;</p>
                                </div>
                                <div class="tab-content">
                                    <div>
                                        <h5>Data Klaim Wallet</h5>
                                        <table class="table table-bordered table-striped" id="tbl_reimburse_done">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Nama</th>
                                                    <th>Jumlah (Rp)</th>
                                                    <th>Keperluan</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2">Total:</th>
                                                    <th colspan="2"></th>
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