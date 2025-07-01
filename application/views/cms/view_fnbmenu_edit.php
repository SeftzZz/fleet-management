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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Input Karyawan <?php echo $this->session->userdata('business') ?></h3>
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
            <h2>Input Fnb <?php echo $this->session->userdata('business') ?>
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
            <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateFnbMenu') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
              <input type="hidden" name="idBusiness" value="<?php echo $idBusiness ?>">
              <input type="hidden" id="idMenu" name="idMenu" value="<?php echo empty($fnbMenu->idMenu) ? null : $fnbMenu->idMenu; ?>"/>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="full-name">Nama menu <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="full-name" required="required" name="nmMenu" class="form-control " value="<?php echo empty($fnbMenu->nmMenu) ? null : $fnbMenu->nmMenu; ?>">
                </div>
              </div>
              <div class="item form-group" id="ketMenu">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="keteranganMenu">Keterangan menu <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="keteranganMenu" required="required" name="description" class="form-control " value="<?php echo empty($fnbMenu->description) ? null : $fnbMenu->description; ?>">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="tgllahir">Harga <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="number" id="priceMenu" required="required" name="priceMenu" class="form-control " value="<?php echo empty($fnbMenu->priceMenu) ? null : $fnbMenu->priceMenu; ?>">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="typeMenu">Tipe menu <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select id="typeMenu" name="typeMenu" class="form-control" required>
                    <option value>Choose..</option>
                    <?php
                      foreach($fnbMenuType as $type) {
                    ?>
                      <option 
                        value="<?php echo $type->name; ?>" 
                        data-is-packages="<?php echo $type->isPackages; ?>"
                        <?php echo (isset($fnbMenu->typeMenu) && $fnbMenu->typeMenu == $type->name) ? 'selected' : ''; ?>
                      >
                        <?php echo $type->displayName; ?>
                      </option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="mobile">Stock Menu <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="stockMenu" required="required" name="stockMenu" class="form-control " value="<?php echo empty($fnbMenu->stockMenu) ? null : $fnbMenu->stockMenu; ?>">
                </div>
              </div>
              <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <a class="btn btn-warning" href="<?php echo base_url('cms/home/detailFnbMenuImg/'.$fnbMenu->idMenu.'/') ?>">Edit Image</a>
      </div>
    </div>
  </div>
</div>