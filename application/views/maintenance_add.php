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
          <form id="maintenanceForm">
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
                      <option value='<?php echo $value->no_pintu; ?>' <?php echo set_select('no_pintu', $value->no_pintu );?> ><?php echo $value->no_pintu; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group col-md-12">
                <label>Jenis Maintenance</label>
                <select name="jenis" class="form-control" required>
                  <option value="">Pilih...</option>
                  <option>Service Berkala</option>
                  <option>Penggantian Sparepart</option>
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
                        <input type="text" name="jam[]" class="form-control" oninput="autoFormatJam(this)" maxlength="5" placeholder="HH:MM" required/>
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
                        <input type="text" name="jam[]" class="form-control" oninput="autoFormatJam(this)" maxlength="5" placeholder="HH:MM" required/>
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
                  <th id="th_sumber" style="display:none;">Sumber (Barang-Stok-Unit)</th>
                  <th>Qty</th>
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
                      <option value="">Pilih barang</option>
                      <?php foreach ($inventori as $value) { ?>
                        <option value='<?php echo $value->name; ?>'
                                data-qty="<?php echo $value->qty; ?>"
                                <?php echo set_select('sparepart[]', $value->name); ?>>
                          <?php echo $value->name; ?> : <?php echo $value->qty; ?>
                        </option>
                      <?php } ?>
                    </select>
                  </td>
                  <td class="sumber_kolom">
                    <div class="sumber-wrapper">
                      <select name="no_pintu_sumber[]" class="form-control sumber-select">
                        <option value="">Pilih...</option>
                        <?php foreach ($kendaraans as $value) { ?>
                          <option value='<?php echo $value->no_pintu; ?>'>
                            Oli Mesin - 10 - <?php echo $value->no_pintu; ?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                  </td>
                  <td>
                    <input type="number" name="qty[]" min="1" class="form-control" placeholder="0" />
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