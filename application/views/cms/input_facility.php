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
        <h3>Input facility <?php echo $this->session->userdata('business') ?></h3>
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
            <h2>Input facility <?php echo $this->session->userdata('business') ?>
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
            <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insert_facility/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nameIcon">facility Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="nameIcon" required="required" name="nameIcon" class="form-control " value="<?php echo empty($businessDetail->Name) ? null : $businessDetail->Name; ?>">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">image facility <span class="required">* (50 x 50) </span>
                </label>
                <div id="imgIcon">
                  <div class="col-md-6 col-sm-6 form-group has-feedback">
                    <input type="file" name="imgIcon" for="imgIcon" class="form-control"  onchange="displayImage2(event)">
                    <script>
                      function displayImage2(event) {
                        const file = event.target.files[0];
                        const reader = new FileReader();
                        reader.onload = function(e) {
                          const img = new Image();
                          img.onload = function() {
                            // alert("Image size: " + this.width + "x" + this.height);
                            if(this.width != '50' && this.height != '50'){
                              var btn = document.getElementById('submit_photo2')
                            btn.disabled = true
                            alert('dimenssi gambar tidak sesuai')
                          }else{
                            alert('gambar sudah sesuai') 
                            var btn = document.getElementById('submit_photo2')
                            btn.disabled = false
                          }
                          };
                          img.src = e.target.result;
                        };

                        reader.readAsDataURL(file);
                        
                      }
                    </script>
                  </div>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="tgllahir">facility Type <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select required="required" name="typeIcon" id="typeIcon" class="form-control" >
                    <option value="">Select Type</option>
                    <option value="building">building</option>
                    <option value="room">room</option>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <button class="btn btn-primary" type="button">Cancel</button>
                  <button class="btn btn-primary" type="reset">Reset</button>
                  <button type="submit" id="submit_photo2" class="btn btn-success">Submit</button>
                </div>
              </div>
            </form>
            <table class="table listfacility">
              <thead>
                <tr>
                  <th>Nama Facility</th>
                  <th>Type Facility</th>
                  <th>Image Facility</th>
                  <!-- <th>Action</th> -->
                </tr>
              </thead>
              <tbody>
                <?php 
                  $facility = array();
                  $this->db->from('type_facility');
                  $this->db->order_by('createdAtfacility', 'DESC');
                  $query = $this->db->get();
                  if ($query->num_rows() > 0)
                  {
                    foreach ($query->result() as $row)
                    {
                      $facility[] = $row;
                    }
                  }
                  $query->free_result();
                  foreach($facility as $icon) {
                ?>
                <tr>
                  <td><?php echo $icon->nameIcon ?></td>
                  <td><?php echo $icon->typeIcon ?></td>
                  <td><img src="<?php echo base_url('/assets/images/facilites/'.$icon->imgIcon); ?>"></td>
                  <!-- <td><?php echo $icon->nameIcon ?></td> -->
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