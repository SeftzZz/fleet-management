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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Filter Manajemen Klaim Wallet</h3>
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
                                <form id="form1" name="form1" action="<?php echo site_url('wallet')?>" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nama Supir</label>
                                                <select name="driver_id" class="form-control select_rute" style="width:100%;">
                                                    <option value="">--- Pilih Supir ---</option>
                                                    <?php foreach ($supirs as $value) { ?>
                                                        <option value='<?php echo $value->id; ?>' <?php echo set_select('driver_id', $value->id );?>>
                                                            <?php
                                                                $this->db->select('no_pintu, nama_tim');
                                                                $this->db->from('tim_mgmt');
                                                                $this->db->where('driver_id', $value->id);
                                                                $this->db->where('status_tim_mgmt', 'Aktif');
                                                                $query = $this->db->get();

                                                                if ($query->num_rows() > 0) {
                                                                    $unit = $query->row();
                                                                    $no_pintu = $unit->no_pintu;
                                                                    $nama_tim = $unit->nama_tim;
                                                                } else {
                                                                    $no_pintu = 'Tida ada unit';
                                                                    $nama_tim = 'Tidak ada tim';
                                                                }
                                                                $query->free_result();

                                                                echo $value->name . ' - ' . $no_pintu . ' - ' . $nama_tim;
                                                            ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a href="<?php echo site_url('wallet') ?>" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reset&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="submit" name="submit" class="btn btn-primary" value="&nbsp;&nbsp;&nbsp;&nbsp;Filter&nbsp;&nbsp;&nbsp;&nbsp;">
                                        </div>
                                    </div>  
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('wallet') ?>" class="nav-link active"/>Form Wallet</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('wallet/walletlog') ?>" class="nav-link"/>Log Klaim Wallet</a>
                                    </li>
                                </ul>
                                <div class="tab-custom-content2">
                                    <p class="lead mb-0">&nbsp;</p>
                                </div>
                                <div class="tab-content">
                                    <div>
                                        <?php if (!empty($wallets)): ?>
                                            <h5>Form Wallet</h5>
                                            <!-- Submit Form -->
                                            <form method="post" action="<?= site_url('wallet/submit_walletadd') ?>">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Tanggal Klaim</label>
                                                            <div class="input-group date" id="tgl_klaim" data-target-input="nearest">
                                                                <input type="text" name="tgl_klaim" id="tgl_klaim" value="<?php echo set_value('tgl_klaim')?>" class="form-control" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" />
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text" data-target="#tgl_klaim" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Keperluan</label>
                                                            <textarea rows="3" name="utk" value="<?php echo set_value('utk')?>" class="form-control <?php if (form_error('utk')) {echo "is-invalid";} ?>"></textarea>
                                                        </div>
                                                    </div>                                                
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Jumlah </label>
                                                            <input type="number" name="jmlnya" value="<?php echo set_value('jmlnya')?>" class="form-control <?php if (form_error('jmlnya')) {echo "is-invalid";} ?>" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php foreach ($wallets as $row): ?>
                                                    <?php 
                                                        $transactions = $wallet_transactions[$row->wallet_id] ?? [];
                                                        $sisa_tabungan = 0;

                                                        foreach ($transactions as $trans) {
                                                            // $description = trim($trans->description);

                                                            // // Hanya ambil transaksi "Tabungan DO -<angka>"
                                                            // if (preg_match('/^Tabungan DO -\d+$/', $description)) {
                                                            //     $sisa_tabungan += $trans->amount;
                                                            // }
                                                            $sisa_tabungan += $trans->balance;
                                                        }
                                                    ?>
                                                    
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>Saldo Tabungan DO</label>
                                                                <input type="text" readonly class="form-control" value="Rp <?= $this->fppfunction->rupiah_ind2($sisa_tabungan) ?>">
                                                                <input type="hidden" name="balance" class="form-control" value="<?= $sisa_tabungan ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="transaksiTipe" value="debit">
                                                    <input type="hidden" name="wallet_id" value="<?= $row->wallet_id ?>">
                                                    <input type="hidden" name="driver_id" value="<?= $row->driver_id ?>">
                                                <?php endforeach; ?>

                                                <button type="submit" class="btn btn-success mt-3">Submit Form Wallet</button>
                                            </form>
                                        <?php else: ?>
                                            <p class="text-muted">Silakan pilih supir terlebih dahulu untuk pengajuan form wallet.</p>
                                        <?php endif; ?>
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