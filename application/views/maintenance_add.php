<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0">Maintenance Kendaraan</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Maintenance Kendaraan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Kartu Statistik -->
    <section class="content">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <h3 class="card-title">Filter Maintenance</h3>
        </div>
        <div class="card-body">
          <form id="maintenanceForm" method="post" action="<?php echo site_url('maintenance/simpan') ?>">
            <input type="hidden" name="driver_id" id="driver_id" />
            <input type="hidden" name="vehicle_id" id="vehicle_id" />
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Nama Mekanik</label>
                <input name="mekanik" id="mekanik" class="form-control" style="width:100%;" required>
              </div>
              <div class="form-group col-md-6">
                <label>No. Pintu</label>
                <select name="no_pintu" id="no_pintu" class="form-control select_rute" style="width:100%;" required>
                  <option value=""></option>
                  <?php foreach ($kendaraans as $value) { ?>
                      <option 
                          value="<?= $value->no_pintu ?>" 
                          data-driver-id="<?= $value->driver_id ?>"
                          data-vehicle-id="<?= $value->vehicle_id ?>"
                          <?= set_select('no_pintu', $value->no_pintu) ?>
                      >
                          <?= $value->no_pintu ?>
                      </option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group col-md-12">
                <label>Jenis Maintenance</label>
                <select name="type" class="form-control" required>
                  <option value="">Pilih...</option>
                  <option value="Service Berkala">Service Berkala</option>
                  <option value="Penggantian Sparepart">Penggantian Sparepart</option>
                  <option value="Penggantian Ban">Penggantian Ban</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label>Tanggal Order</label>
                    <div class="input-group date" id="tgl_order" data-target-input="nearest">
                      <input type="text" name="tgl_order" value="<?php echo set_value('tgl_order')?>" class="form-control" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" required />
                      <div class="input-group-append">
                          <div class="input-group-text" data-target="#tgl_order" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-md-12">
                    <label>Waktu</label>
                    <div class="input-group date" id="jam-picker${value.vehicle_id}" data-target-input="nearest">
                        <input type="text" name="jam_order" class="form-control" oninput="autoFormatJam(this)" maxlength="5" placeholder="HH:MM" required/>
                        <div class="input-group-append">
                            <div class="input-group-text datetimepicker-input" data-target="#jam-picker${value.vehicle_id}" data-toggle="datetimepicker"><i class="far fa-clock"></i></div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label>Tanggal Selesai</label>
                    <div class="input-group date" id="tgl_selesai" data-target-input="nearest">
                      <input type="text" name="tgl_selesai" value="<?php echo set_value('tgl_selesai')?>" class="form-control" oninput="autoFormatTanggal(this)" maxlength="10" placeholder="DD-MM-YYYY" required />
                      <div class="input-group-append">
                          <div class="input-group-text" data-target="#tgl_selesai" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-md-12">
                    <label>Waktu</label>
                    <div class="input-group date" id="jam-picker${value.vehicle_id}" data-target-input="nearest">
                        <input type="text" name="jam_selesai" class="form-control" oninput="autoFormatJam(this)" maxlength="5" placeholder="HH:MM" required/>
                        <div class="input-group-append">
                            <div class="input-group-text datetimepicker-input" data-target="#jam-picker${value.vehicle_id}" data-toggle="datetimepicker"><i class="far fa-clock"></i></div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <table class="table" id="barangTable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Permintaan Perbaikan</th>
                  <th>Kondisi</th>
                  <th>Sparepart</th>
                  <th>Qty</th>
                  <th id="th_posisi" style="display:none;">Posisi</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <!-- Baris akan diisi lewat JS -->
              </tbody>
            </table>

            <div id="button-form">
              <a href="<?php echo site_url('maintenance') ?>" class="btn btn-default">&nbsp;&nbsp;Reset&nbsp;&nbsp;</a>
              <button type="submit" class="btn btn-primary">Simpan</button>
              <button type="button" class="btn btn-success float-right" id="addRowBtn">+ Spare part</button>
            </div>

            <!-- Template row disembunyikan -->
            <table style="display: none;">
              <tbody id="rowTemplate">
                <tr>
                  <td class="no_urut">1</td>
                  <td><input name="permintaan_perbaikan[]" id="permintaan_perbaikan" class="form-control"></td>
                  <td>
                    <select name="kondisi[]" class="form-control kondisi-select">
                      <option value="">--</option>
                      <option value="baru">Baru</option>
                      <option value="bekas">Bekas</option>
                    </select>
                  </td>
                  <td>
                    <select name="sparepart[]" class="form-control sparepart-select">
                      <style>
                          .select2-selection--single {
                              width: 300px !important;
                          }
                      </style>
                      <option value="">Pilih barang</option>
                      <?php foreach ($inventori as $value) { ?>
                        <option value='<?php echo $value->sparepart; ?>'
                                data-sparepart="<?php echo $value->sparepart; ?>"
                                data-qty="<?php echo $value->qty; ?>"
                                <?php echo set_select('sparepart[]', $value->sparepart); ?>>
                          <?php echo $value->sparepart; ?> : <?php echo $value->qty; ?>
                        </option>
                      <?php } ?>
                    </select>
                  </td>
                  <td><input type="number" name="qty[]" min="1" class="form-control" placeholder="0" /></td>
                  <td>
                    <select name="posisi[]" id="posisi" class="form-control posisi-select" style="width:100%;">
                        <option value="">--- Pilih Posisi ---</option>
                        <?php 
                            $pilihanposisi = array(
                              "R1 (kanan depan)",
                              "R2 (kanan belakang tengah luar)",
                              "R3 (kanan belakang tengah dalem)",
                              "R4 (kanan belakang luar)",
                              "R5 (kanan belakang dalem)",
                              "L1 (kiri depan)",
                              "L2 (kiri belakang tengah luar)",
                              "L3 (kiri belakang tengah dalem)",
                              "L4 (kiri belakang luar)",
                              "L5 (kiri belakang dalem)",

                            );
                            foreach ($pilihanposisi as $value) { 
                        ?>
                            <option value="<?php echo $value ?>" <?php echo set_select('posisi', $value) ?>><?php echo $value ?></option>
                        <?php } ?>
                    </select>
                  </td>
                  <td><textarea name="keterangan[]" id="keterangan" rows="1" class="form-control"></textarea></td>
                  <td>
                    <button type="button" class="hapusRow btn btn-danger btn-block">Hapus</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
      </div>
       
    </section>
  </div>