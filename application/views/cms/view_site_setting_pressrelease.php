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
<div id="loader-text" style="content: '';position: fixed;top: 0;left: 0;width: 100%;height: 100%;background: #121212b3;z-index: 4;display: none;">
  <h1 style="color: white;top: 0;left: 0;right: 0px;bottom: 0px;position: relative;text-align: center;">Uploading....</h1>
</div>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Setting Press Release
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
          <div class="x_content form-horizontal form-label-left">
            <br />
            <form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertpressrelease') ?>" id="demo-form2" class="form-horizontal form-label-left">
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusPressrelease">Status Menu <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 ">
                        <select name="statusPressrelease" id="statusPressrelease" class="form-control">
                            <option value="" disabled selected>-- Pilih status --</option>
                            <option value="1">Active</option>
                            <option value="0">Non Active</option>
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="locale">Locale <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <select name="locale" id="locale" class="form-control">
                            <option value="en">English</option>
                            <option value="id">Indonesian</option>
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="nmPressrelease">Press Release <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="nmPressrelease" name="nmPressrelease" class="form-control" required>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="ketPressrelease">Keterangan</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="ketPressrelease" name="ketPressrelease" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="imgPressrelease">File Image</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="file" id="imgPressrelease" name="imgPressrelease" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="imgurlPressrelease">URL Image</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="imgurlPressrelease" name="imgurlPressrelease" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="urlPressrelease">URL Web</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="urlPressrelease" name="urlPressrelease" class="form-control">
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                        <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>