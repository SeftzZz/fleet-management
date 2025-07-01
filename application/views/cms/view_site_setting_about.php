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
            <h2>View Site About
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
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Locale</th>
                  <th>Title About</th>
                  <th>Subtitle About</th>
                  <th>Status About</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach($about as $index => $row) {
                ?>
                <tr id="row-<?php echo $index; ?>">
                  <td><?php echo $row->locale; ?></td>
                  <td><?php echo $row->titleAbout; ?></td>
                  <td><?php echo $row->subtitleAbout; ?></td>
                  <td><?php echo $row->subtitleAbout ? 'Aktif' : 'Tidak Aktif'; ?></td>
                  <td><button type="button" class="btn btn-primary editBtn" data-toggle="modal" data-target="#headerModal<?php echo $row->idAbout; ?>" data-index="<?php echo $index; ?>" id-header="<?php echo $row->idAbout; ?>">Edit</button></td>
                </tr>
                <div class="modal fade" id="headerModal<?php echo $row->idAbout; ?>" tabindex="-1" role="dialog" aria-labelledby="headerModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="headerModalLabel">Edit About <?php echo $row->idAbout; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateSiteSettingAbout') ?>" id="demo-form2" class="form-horizontal form-label-left">
                            <input type="hidden" readonly name="idAbout" value="<?php echo $row->idAbout; ?>" class="form-control">
                            <!-- <input type="hidden" id="bgheroAbout" name="bgheroAbout" class="form-control" value="<?php echo $row->bgheroAbout ?>"> -->
                            <!-- <input type="hidden" id="imgAbout" name="imgAbout" class="form-control" value="<?php echo $row->imgAbout ?>"> -->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="localeModal">Locale <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select name="locale" id="localeModal" class="form-control">
                                        <option disabled selected value="<?php echo $row->locale ?>"><?php echo $row->locale ?></option>
                                        <option value="en">English</option>
                                        <option value="id">Indonesian</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="titleAbout">Title About <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" id="titleAbout" name="titleAbout" class="form-control" value="<?php echo $row->subtitleAbout ?>">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="subtitleAbout">Subtitle About</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" id="subtitleAbout" name="subtitleAbout" class="form-control" value="<?php echo $row->subtitleAbout ?>">
                                </div>
                            </div>

                            <!-- <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="uploadbgheroAbout">Background Header About <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="file" id="uploadbgheroAbout" name="uploadbgheroAbout" class="form-control">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="uploadimgAbout">Image About <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="file" id="uploadimgAbout" name="uploadimgAbout" class="form-control">
                                </div>
                            </div> -->

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
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>