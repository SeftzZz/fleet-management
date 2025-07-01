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
            <h2>Setting Career
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
            <form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertcareer') ?>" id="demo-form2" class="form-horizontal form-label-left">
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusCarrer">Status Career <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 ">
                        <select name="statusCarrer" id="statusCarrer" class="form-control">
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
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="nmCarrer">Career <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="nmCarrer" name="nmCarrer" class="form-control" required>
                    </div>
                </div>
                <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="ketCarrer">Keterangan<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <textarea required="required" class="form-control" id="cktextarea" name="ketCarrer" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></textarea>
                </div>
              </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="locationCarrer">Lokasi Career</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="locationCarrer" name="locationCarrer" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="timeCarrer">Waktu Career</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="timeCarrer" name="timeCarrer" class="form-control">
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
          <div class="x_content form-horizontal form-label-left">
            <br />
            <div class="row">
              <div class="col-md-6">
                  <h4>View Career</h4>
                  <table class="table table-striped table-bordered">
                      <thead>
                          <tr>
                              <th>Job Opportunities</th>
                              <th>Location</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                          $business = array();
                          $this->db->from('sahira_hero_carrer');
                          $query = $this->db->get();
                          if ($query->num_rows() > 0) {
                              foreach ($query->result() as $row) {
                                  $business[] = $row;
                              }
                          }
                          $query->free_result();
                          foreach ($business as $index => $row) {
                          ?>
                              <tr id="row-<?php echo $index; ?>">
                                  <td><?php echo $row->nmCarrer; ?></td>
                                  <td><?php echo $row->locationCarrer; ?></td>
                                  <td>
                                      <button type="button" class="btn btn-primary editBtn" data-toggle="modal" data-target="#headerModal<?php echo $row->idCarrer; ?>" id-header="<?php echo $row->idCarrer; ?>">
                                          Edit
                                      </button>
                                      <a class="btn btn-danger" href="<?php echo base_url('cms/home/deletecareer/'.$row->idCarrer.'/'); ?>" onclick="return confirm('Are you sure you want to delete this career: <?php echo $row->nmCarrer; ?>?')">Delete</a>
                                  </td>
                              </tr>

                              <!-- Modal -->
                              <div class="modal fade" id="headerModal<?php echo $row->idCarrer; ?>" tabindex="-1" role="dialog" aria-labelledby="headerModalLabel<?php echo $row->idCarrer; ?>" aria-hidden="true">
                                  <div class="modal-dialog modal-lg" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="headerModalLabel<?php echo $row->idCarrer; ?>">Edit Career <?php echo $row->nmCarrer; ?></h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                                          <div class="modal-body">
                                              <form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updatecareer'); ?>" id="demo-form2-<?php echo $row->idCarrer; ?>" class="form-horizontal form-label-left">
                                                <input type="hidden" name="idCarrer" value="<?php echo $row->idCarrer ?>">
                                                  <div class="item form-group">
                                                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusCarrer">Status Career <span class="required">*</span></label>
                                                      <div class="col-md-6 col-sm-6 ">
                                                          <select name="statusCarrer" id="statusCarrer<?php echo $row->idCarrer; ?>" class="form-control">
                                                              <option value="" disabled selected>-- Pilih status --</option>
                                                              <option value="1" <?php echo $row->statusCarrer == 1 ? 'selected' : ''; ?>>Active</option>
                                                              <option value="0" <?php echo $row->statusCarrer == 0 ? 'selected' : ''; ?>>Non Active</option>
                                                          </select>
                                                      </div>
                                                  </div>
                                                  <div class="item form-group">
                                                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="locale">Locale <span class="required">*</span></label>
                                                      <div class="col-md-6 col-sm-6">
                                                          <select name="locale" id="locale<?php echo $row->idCarrer; ?>" class="form-control">
                                                              <option value="en" <?php echo $row->locale == 'en' ? 'selected' : ''; ?>>English</option>
                                                              <option value="id" <?php echo $row->locale == 'id' ? 'selected' : ''; ?>>Indonesian</option>
                                                          </select>
                                                      </div>
                                                  </div>
                                                  <div class="item form-group">
                                                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="nmCarrer">Career <span class="required">*</span></label>
                                                      <div class="col-md-6 col-sm-6">
                                                          <input type="text" id="nmCarrer<?php echo $row->idCarrer; ?>" name="nmCarrer" class="form-control" value="<?php echo $row->nmCarrer; ?>" required>
                                                      </div>
                                                  </div>
                                                  <div class="item form-group">
                                                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="ketCarrer">Keterangan <span class="required">*</span></label>
                                                      <div class="col-md-6 col-sm-6">
                                                          <textarea required="required" class="form-control" id="cktextareaedit<?php echo $row->idCarrer; ?>" name="ketCarrer" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"><?php echo $row->ketCarrer; ?></textarea>
                                                      </div>
                                                  </div>
                                                  <div class="item form-group">
                                                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="locationCarrer">Lokasi Career</label>
                                                      <div class="col-md-6 col-sm-6">
                                                          <input type="text" id="locationCarrer<?php echo $row->idCarrer; ?>" name="locationCarrer" class="form-control" value="<?php echo $row->locationCarrer; ?>">
                                                      </div>
                                                  </div>
                                                  <div class="item form-group">
                                                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="timeCarrer">Waktu Career</label>
                                                      <div class="col-md-6 col-sm-6">
                                                          <input type="text" id="timeCarrer<?php echo $row->idCarrer; ?>" name="timeCarrer" class="form-control" value="<?php echo $row->timeCarrer; ?>">
                                                      </div>
                                                  </div>
                                                  <div class="ln_solid"></div>
                                                  <div class="item form-group">
                                                      <div class="col-md-6 col-sm-6 offset-md-3">
                                                          <button type="submit" id="submitBtn<?php echo $row->idCarrer; ?>" class="btn btn-success">Submit</button>
                                                      </div>
                                                  </div>
                                                  <script src="<?php echo base_url() ?>/vendors/jquery/dist/jquery.min.js"></script>
                                                  <script src="https://www.forkalim.or.id/assets/ckeditor/ckeditor.js"></script>
                                                  <script type="text/javascript">
                                                    $(function () {
                                                      CKEDITOR.replace(
                                                        'cktextareaedit<?php echo $row->idCarrer; ?>',{ 
                                                          height: '400px',
                                                          filebrowserBrowseUrl : 'https://www.forkalim.or.id/assets/ckeditor/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                                                          filebrowserUploadUrl : 'https://www.forkalim.or.id/assets/ckeditor/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                                                          filebrowserImageBrowseUrl : 'https://www.forkalim.or.id/assets/ckeditor/filemanager/dialog.php?type=1&editor=ckeditor&fldr='
                                                        }
                                                      );
                                                    })
                                                  </script>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          <?php } ?>
                      </tbody>
                  </table>
              </div>

              <div class="col-md-6">
                <h4>View Submit</h4>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Nama Lengkap</th>
                      <th>Telepon</th>
                      <th>Email</th>
                      <th>Resume</th>
                      <!-- <th>Action</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $business = array();
                      $this->db->from('sahira_hero_carrer_apply');
                      $query = $this->db->get();
                      if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                          $business[] = $row;
                        }
                      }
                      $query->free_result();
                      foreach($business as $index => $row) {
                    ?>
                    <tr id="row-<?php echo $index; ?>">
                      <td><?php echo $row->nmApply; ?></td>
                      <td><?php echo $row->telpApply; ?></td>
                      <td><?php echo $row->emailApply; ?></td>
                      <td><a href="https://sahirahotelsgroup.com/img/apply/<?php echo $row->resumeApply; ?>" target="_blank"><?php echo $row->resumeApply; ?></a></td>
                      <!-- <td><button type="button" class="btn btn-primary editBtn" data-toggle="modal" data-target="#headerModal" data-index="<?php echo $index; ?>" id-header="<?php echo $row->idHeader; ?>">Edit</button></td> -->
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
  </div>
</div>