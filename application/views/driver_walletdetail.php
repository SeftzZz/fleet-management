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
                                    <li class="breadcrumb-item"><a href="<?php echo site_url('drivers/wallet') ?>">Manajemen Wallet Supir</a></li>
                                    <li class="breadcrumb-item active">Wallet Detail</li>
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
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo site_url('drivers') ?>"/>Manajemen Supir</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="<?php echo site_url('drivers/wallet') ?>"/>Manajemen Wallet Supir</a>
                                    </li>
                                </ul>
                                <div class="tab-custom-content2">
                                    <p class="lead mb-0">&nbsp;</p>
                                </div>
                                <div class="tab-content" id="custom-content-below-tabContent">
                                    <div class="tab-pane fade show active" id="mgmt_wallet" role="tabpanel" aria-labelledby="mgmt_wallet_tab">
                                        <p class="lead2 mb-3">Wallet detail <?php echo $supir->name ?></p>

                                        <p>Wallet ID: <?php echo $walletID ?></p>
                                        <p>Jumlah transaksi: <?php echo $jmlTransaksi ?></p>

                                        <table id="tbl_manajemenwallet_transactions" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Tgl. Ritasi</th>
                                                    <th>Tipe transaksi</th>
                                                    <th>Amount</th>
                                                    <th>Keterangan</th>
                                                    <th>Create At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    foreach ($wallet_transactions as $row) {    
                                                        $this->db->select('tgl_ritasi');
                                                        $this->db->from('ritasi');   
                                                        $this->db->where('id', $row->id_ritasi);
                                                        $query = $this->db->get();
                                                        if ($query->num_rows() > 0) {
                                                            $ritasi = $query->row();
                                                        } else {
                                                            $ritasi = (object) ['tgl_ritasi' => ' '];
                                                        }
                                                        $query->free_result();      
                                                ?>
                                                    <tr>
                                                        <?php if ($ritasi->tgl_ritasi=="00-00-0000") { ?>
                                                            <td data-order="0000-00-00">
                                                                <?php echo "00-00-0000"; ?>
                                                            </td>
                                                        <?php } else { ?>
                                                            <td data-order="<?php echo date('Y-m-d', strtotime($ritasi->tgl_ritasi)); ?>">
                                                                <?php echo date('d/m/Y', strtotime($ritasi->tgl_ritasi)); ?>
                                                            </td>
                                                        <?php } ?>
                                                        <td><?php echo $row->transaction_type ?></td>
                                                        <td><?php echo $this->fppfunction->rupiah_ind($row->amount) ?></td>
                                                        <td><?php echo $row->description ?></td>
                                                        <td><?php echo $this->fppfunction->tglangkajam_ind($row->created_at) ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
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