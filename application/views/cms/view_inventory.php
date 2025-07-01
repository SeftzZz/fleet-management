<?php if ($this->session->flashdata('pesanerror')) { ?>
  <script language="javascript" type="text/javascript">
    window.onload = function(){
      swal({
        title: "Failed!",
        text: "<?php echo $this->session->flashdata('pesanerror');?>",
        type: "error",
        confirmButtonText: "Close"
      });
    }
  </script>
<?php } ?>
<?php if ($this->session->flashdata('pesansukses')) { ?>
  <script language="javascript" type="text/javascript">
    window.onload = function(){
      swal({
        title: "Success",
        text: "<?php echo $this->session->flashdata('pesansukses');?>",
        type: "success",
        confirmButtonText: "Close"
      });
    }
  </script>
<?php } ?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>View Inventory <?php echo $this->session->userdata('business') ?></h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>View Inventory <?php echo $this->session->userdata('business') ?>
            </h2>
            <ul class="nav navbar-right panel_toolbox">
              <li>
                <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
                </a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li>
                    <a class="dropdown-item" href="#">Settings 1</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li>
                <a class="close-link">
                  <i class="fa fa-close"></i>
                </a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertInventory') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Type Barang <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select id="typeInventori" name="typeInventori" class="form-control">
                    <option value>Choose..</option>
                    <?php 
                      $pengadaan_inventori_type = array();
                      $this->db->from('pengadaan_inventori_type');
                      $this->db->where('idBusiness', $this->session->userdata('idBusiness'));
                      $query = $this->db->get();
                      if ($query->num_rows() > 0)
                      {
                        foreach ($query->result() as $row)
                        {
                          $pengadaan_inventori_type[] = $row;
                        }
                      }
                      $query->free_result(); 
                    ?>
                    <?php 
                      foreach($pengadaan_inventori_type as $row) {
                    ?>
                      <option value="<?php echo $row->typeInventoritype ?>"><?php echo $row->typeInventoritype ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nmRatecode">Nama Barang <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select id="nmInventori" name="nmInventori" class="form-control">
                    <option value>Choose..</option>
                    <?php 
                      $pengadaan_inventori_nama = array();
                      $this->db->from('pengadaan_inventori_nama');
                      $this->db->where('idBusiness', $this->session->userdata('idBusiness'));
                      $query = $this->db->get();
                      if ($query->num_rows() > 0)
                      {
                        foreach ($query->result() as $row)
                        {
                          $pengadaan_inventori_nama[] = $row;
                        }
                      }
                      $query->free_result(); 
                    ?>
                    <?php 
                      foreach($pengadaan_inventori_nama as $row) {
                    ?>
                      <option value="<?php echo $row->nmInventorinama ?>"><?php echo $row->nmInventorinama ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="beginRatecode">Merk Barang <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select id="merkInventori" name="merkInventori" class="form-control">
                    <option value>Choose..</option>
                    <?php 
                      $pengadaan_inventori_merk = array();
                      $this->db->from('pengadaan_inventori_merk');
                      $this->db->where('idBusiness', $this->session->userdata('idBusiness'));
                      $query = $this->db->get();
                      if ($query->num_rows() > 0)
                      {
                        foreach ($query->result() as $row)
                        {
                          $pengadaan_inventori_merk[] = $row;
                        }
                      }
                      $query->free_result(); 
                    ?>
                    <?php 
                      foreach($pengadaan_inventori_merk as $row) {
                    ?>
                      <option value="<?php echo $row->merkInventorimerk ?>"><?php echo $row->merkInventorimerk ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="endRatecode">Satuan Barang <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select id="satuanInventori" name="satuanInventori" class="form-control">
                    <option value>Choose..</option>
                    <?php 
                      $pengadaan_inventori_satuan = array();
                      $this->db->from('pengadaan_inventori_satuan');
                      $this->db->where('idBusiness', $this->session->userdata('idBusiness'));
                      $query = $this->db->get();
                      if ($query->num_rows() > 0)
                      {
                        foreach ($query->result() as $row)
                        {
                          $pengadaan_inventori_satuan[] = $row;
                        }
                      }
                      $query->free_result(); 
                    ?>
                    <?php 
                      foreach($pengadaan_inventori_satuan as $row) {
                    ?>
                      <option value="<?php echo $row->satuanInventorisatuan ?>"><?php echo $row->satuanInventorisatuan ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Nett Barang <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 form-group has-feedback">
                  <input type="number" name="nettInventori" id="nettInventori" required="required" class="form-control">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Kuantiti Barang <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 form-group has-feedback">
                  <input type="number" name="qtyInventori" id="qtyInventori" required="required" class="form-control">
                  <span class="form-control-feedback right" aria-hidden="true">QTY</span>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <button class="btn btn-primary" type="button">Cancel</button>
                  <button class="btn btn-primary" type="reset">Reset</button>
                  <input type="submit" name="submit" value="Submit" class="btn btn-success">
                </div>
              </div>
            </form>
            <div class="ln_solid"></div>
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th style="width: 15%;">Type Barang</th>
                  <th>Nama Barang</th>
                  <th style="width: 5%;">Merk Barang</th>
                  <th style="width: 5%;">Satuan Barang</th>
                  <th>Nett Barang</th>
                  <th>Kuantiti Barang</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach($inventory as $row) {
                ?>
                <tr>
                  <form method="post" title="rate_code" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateInventory') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                    <input type="hidden" name="idInventori" value="<?php echo $row->idInventori ?>">
                    <td><?php echo $row->typeInventori ?></td>
                    <td><?php echo $row->nmInventori ?></td>
                    <td><?php echo $row->merkInventori ?></td>
                    <td><?php echo $row->satuanInventori ?></td>
                    <td><?php echo $row->nettInventori ?></td>
                    <td><input type="number" id="qtyInventori" required="required" name="qtyInventori" class="form-control" value="<?php echo $row->qtyInventori ?>"></td>
                    <td><input type="submit" name="submit" class="btn btn-success" value="Update"><a id="rate<?php echo $row->idInventori ?>" class="btn btn-danger" onclick="deleteRate(<?php echo $row->idInventori ?>)">Delete</a></td>
                  </form>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>