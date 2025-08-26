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
                                    <li class="breadcrumb-item"><a href="<?php echo site_url('inventori/baru') ?>">Inventori Barang Baru</a></li>
                                    <li class="breadcrumb-item active">Detail</li>
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
                                <div class="small-box callout callout-success">
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
                                <h3 class="card-title">Inventori Detail - Pemakaian Sparepart <?php echo $sparepart; ?></h3>
                            </div>
                            <div class="card-body">
                                <table id="tbl_inventoryBaruDtl" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Qty</th>
                                            <th>No. Pintu/Bak/unit</th>
                                            <th>Supir</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($pemakaian) { ?>
                                            <?php foreach ($pemakaian as $row) { ?>
                                                <?php 
                                                    $this->db->select('*'); 
                                                    $this->db->from('maintenances'); 
                                                    $this->db->where('id', $row->maintenance_id);
                                                    $query = $this->db->get();
                                                    if ($query->num_rows() > 0) {
                                                        $maintenances = $query->row();
                                                    } 
                                                    $query->free_result();
                                                ?>
                                                <tr>
                                                    <td><?php echo $row->sparepart; ?></td>
                                                    <td><?php echo $row->qty; ?></td>
                                                    <td><?php echo $maintenances->no_pintu; ?></td>
                                                    <td>
                                                        <?php 
                                                            $this->db->select('name'); 
                                                            $this->db->from('drivers'); 
                                                            $this->db->where('id', $maintenances->driver_id);
                                                            $query = $this->db->get();
                                                            if ($query->num_rows() > 0) {
                                                                $driver = $query->row();
                                                            } 
                                                            $query->free_result();
                                                            echo $driver->name;
                                                        ?>
                                                    </td>
                                                    <td><?php echo $maintenances->tgl_order; ?></td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="5" class="text-center">Data tidak ada</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Qty</th>
                                            <th>No. Pintu/Bak/unit</th>
                                            <th>Supir</th>
                                            <th>Tanggal</th>
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