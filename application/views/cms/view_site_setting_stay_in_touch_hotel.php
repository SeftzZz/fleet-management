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
            <h2>View Site Stay In Touch
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
            <form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertstaymember/'.$idBusiness.'/') ?>" id="demo-form2" class="form-horizontal form-label-left">
              <input type="hidden" name="idBusiness" value="<?php echo $idBusiness ?>">
              <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusStay">Status Stay<span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 ">
                      <select name="statusStay" id="statusStay" class="form-control">
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
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="imgHero">Image</label>
                  <div class="col-md-6 col-sm-6">
                      <input type="file" id="imgHero" name="imgHero" class="form-control">
                  </div>
              </div>
              <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="titlehomeHero">Title <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6">
                      <input type="text" id="titlehomeHero" name="titlehomeHero" class="form-control" required>
                  </div>
              </div>
              <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="titlestayintouchHero">Title Stay</label>
                  <div class="col-md-6 col-sm-6">
                      <input type="text" id="titlestayintouchHero" name="titlestayintouchHero" class="form-control">
                  </div>
              </div>
              <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="subtitlestayintouchHero">Subtitle Stay</label>
                  <div class="col-md-6 col-sm-6">
                      <input type="text" id="subtitlestayintouchHero" name="subtitlestayintouchHero" class="form-control">
                  </div>
              </div>
              <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="textstayintouchHero">Text Stay</label>
                  <div class="col-md-6 col-sm-6">
                      <input type="text" id="textstayintouchHero" name="textstayintouchHero" class="form-control">
                  </div>
              </div>
              <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="titlejoinmemberHero">Title Join</label>
                  <div class="col-md-6 col-sm-6">
                      <input type="text" id="titlejoinmemberHero" name="titlejoinmemberHero" class="form-control">
                  </div>
              </div>
              <div class="ln_solid"></div>
              <div class="item form-group">
                  <div class="col-md-6 col-sm-6 offset-md-3">
                      <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>
                  </div>
              </div>
            </form>
            <br />
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Locale</th>
                  <th>Title</th>
                  <th>Sub Title</th>
                  <th>Button</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach($stay_in_touch as $index => $row) {
                ?>
                  <tr>
                    <td><?php echo $row->locale ?></td>
                    <td><?php echo $row->titlehomeHero ?></td>
                    <td><?php echo $row->titlestayintouchHero ?></td>
                    <td><?php echo $row->subtitlestayintouchHero ?></td>
                    <td><button type="button" class="btn btn-primary editBtn" data-toggle="modal" data-target="#homeOffersModal<?php echo $row->idHero; ?>" data-index="<?php echo $index; ?>" id-header="<?php echo $row->idHero; ?>">Edit</button></td>
                  </tr>
                  <div class="modal fade" id="homeOffersModal<?php echo $row->idHero; ?>" tabindex="-1" role="dialog" aria-labelledby="homeOffersModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="homeOffersModalLabel">Edit Hotel <?php echo $row->titlehomeHero; ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateSiteSettingStayInTouch') ?>" id="demo-form2" class="form-horizontal form-label-left">
                              <input type="hidden" readonly name="idHero" value="<?php echo $row->idHero; ?>" class="form-control">
                              <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="titlehomeHero">Title <span class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                      <input type="text" id="titlehomeHero" name="titlehomeHero" class="form-control" value="<?php echo $row->titlehomeHero ?>">
                                  </div>
                              </div>

                              <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="titlestayintouchHero">Sub Title <span class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                      <textarea type="text" id="titlestayintouchHero" name="titlestayintouchHero" class="form-control" rows="7"><?php echo $row->titlestayintouchHero ?></textarea>
                                  </div>
                              </div>

                              <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="subtitlestayintouchHero">Sub Title <span class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                      <input type="text" id="subtitlestayintouchHero" name="subtitlestayintouchHero" class="form-control" value="<?php echo $row->subtitlestayintouchHero ?>">
                                  </div>
                              </div>

                              <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="imgHero">Image <span class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                      <input type="file" id="imgHero" name="imgHero" class="form-control" value="<?php echo isset($row->imgHero) ? $row->imgHero : $row->imgHero ?>">
                                  </div>
                              </div>

                              <div class="ln_solid"></div>
                              <div class="item form-group">
                                  <div class="col-md-6 col-sm-6 offset-md-3">
                                      <button type="submit" id="submitBtnModal" class="btn btn-success">Submit</button>
                                  </div>
                              </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                      </div>
                    </div>
                  </div>
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