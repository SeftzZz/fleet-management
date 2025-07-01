<?php if ($this->session->flashdata('pesanerror')) { ?> <script language="javascript" type="text/javascript">
  window.onload = function() {
    swal({
      title: "Failed!",
      text: " <?php echo $this->session->flashdata('pesanerror'); ?>",
      type : "error",
      confirmButtonText: "Close"
    });
  }
</script> <?php } ?> <?php if ($this->session->flashdata('pesansukses')) { ?> <script language="javascript" type="text/javascript">
  window.onload = function() {
    swal({
      title: "Success",
      text: "<?php echo $this->session->flashdata('pesansukses'); ?> ",
      type : "success",
      confirmButtonText: "Close"
    });
  }
</script> <?php } ?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Input Business Detail</h3>
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
            <h2>Input Business Detail </h2>
            <ul class="nav navbar-right panel_toolbox">
              <li>
                <a class="collapse-link">
                  <i class="fa fa-chevron-up" style="color: red;"></i>
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
            <!-- <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateBusinessDetail') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left"> -->
            <div class="form-horizontal form-label-left">
              <input type="hidden" id="idBusiness" name="idBusiness" value="<?php echo empty($detailBusiness->idBusiness) ? null : $detailBusiness->idBusiness; ?>" />
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="Name">Nama <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="Name" required="required" name="Name" class="form-control " value="<?php echo $detailBusiness->Name; ?>">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="tgllahir">Address <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" required="required" id="addres" name="addres" class="form-control " value="<?php echo $detailBusiness->addres; ?>">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Photo <span class="required">* (1257 x 1778)</span>
                </label>
                <div id="fileInputsContainer">
                  <div class="col-md-6 col-sm-6 form-group has-feedback">
                    <img id="imageBusiness" src="" alt="Picture" class="cropper-hidden">
                    <div style="padding-top: 10px;">
                      <input type="hidden" name="dataX" id="dataX" value="1257">
                      <input type="hidden" name="dataY" id="dataY" value="1778">
                      <input type="hidden" name="dataHeight" id="dataHeight" value="1257">
                      <input type="hidden" name="dataWidth" id="dataWidth" value="1778">
                      <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                        <input type="file" class="sr-only" id="inputImage" name="imgBuilding" accept="image/*">
                        <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs">
                          Import
                          <span class="fa fa-upload"></span>
                        </span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="tgllahir">Location Url <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" required="required" id="location" name="location" class="form-control " value="<?php echo $detailBusiness->location; ?>">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="tgllahir">Business Type <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select disabled name="typeBusiness" id="typeBusiness" class="form-control">
                    <option value="<?php echo $detailBusiness->typeBusiness ?>"><?php echo $detailBusiness->typeBusiness ?></option>
                  </select>
                </div>
              </div>

                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="cktextarea">Keterangan<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <textarea id="cktextarea" required="required" class="form-control __textarea" name="descENBusiness" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10">
                            <?php echo $detailBusiness->descENBusiness ?>
                        </textarea>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="tgllahir">Active<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <select required="required" name="active" id="active" class="form-control" >
                            <option value="">Select active</option>
                            <option value="1" <?php echo $detailBusiness->active ? "selected" : "" ?> >Active</option>
                            <option value="0" <?php echo !$detailBusiness->active ? "selected" : "" ?> >Deactivate</option>
                        </select>
                    </div>
                </div>
                <?php
                    $active = false;
                    if (isset($fnbDetail)) {
                        $active = $fnbDetail->isActive;
                    }
                ?>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="tgllahir">Has FNB<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <select required="required" name="hasFnb" id="hasFnb" class="form-control" >
                            <option value="">Select active</option>
                            <option value="1" <?php echo $active ? "selected" : "" ?> >Active</option>
                            <option value="0" <?php echo !$active ? "selected" : "" ?> >Deactivate</option>
                        </select>
                    </div>
                </div>
              <div class="item form-group" id="ratingstar">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Business grade (rating's) <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select required="required" id="ratingstar" disabled name="ratingstar" class="form-control">
                    <option value="<?php echo $detailBusiness->ratingstar ?>"><?php echo $detailBusiness->ratingstar ?></option>
                  </select>
                </div>
              </div>
              <script>
                const typeBusinessSelect = document.getElementById('typeBusiness');
                const ratingStarSelect = document.getElementById('ratingstar');

                if (typeBusinessSelect.value != 'HOTEL') {
                  ratingStarSelect.disabled = true; // Disable ratingstar for OFFICE
                  ratingStarSelect.style.display='none';
                } else {
                  ratingStarSelect.disabled = false; // Enable ratingstar for other types
                  ratingStarSelect.style.display='block';
                };
              </script>
              <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <a href="<?php echo base_url('cms/home/deleteBusiness/'.$detailBusiness->idBusiness.'/') ?>" class="btn btn-danger" id="deleteBtn" onclick="return confirmDelete();">Delete</a>
                  <script>
                    function confirmDelete() {
                      var confirmMsg = "Are you sure you want to delete?"; // Change the confirmation message as needed
                      var userConfirmed = confirm(confirmMsg);

                      if (userConfirmed) {
                        // User confirmed, proceed with deletion
                        return true;
                      } else {
                        // User denied, handle accordingly (e.g., show a message)
                        alert("Deletion canceled by user.");
                        return false; // Prevent the default action (deletion)
                      }
                    }
                  </script>
                  <button class="btn btn-primary" type="reset">Reset</button>
                  <button type="submit" id="submitBtn" class="btn btn-success">Submit Edit</button>
                </div>
              </div>
            </div>
            <!-- </form> -->
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Building Facility</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li>
                <a class="collapse-link">
                  <i class="fa fa-chevron-down" style="color: red;"></i>
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
          <div class="x_content" style="display: none;">
            <br />
            <form action="<?php echo base_url('cms/home/applyFacilityBusiness')?>" method="post">
              <?php 
                $displayed_name = array();
                $facility = array();
                $this->db->from('type_facility');
                $this->db->where('typeIcon', 'building');
                $query = $this->db->get();
                if ($query->num_rows() > 0)
                {
                  foreach ($query->result() as $row)
                  {
                    if (!in_array($row->typeIcon, $displayed_name)) {
                      $displayed_name[] = $row->typeIcon;
                      $facility[] = $row;
                    }
                  }
                }
                $query->free_result(); 
              ?>
              <div class="form-group">
                <div class="row">
                  <?php foreach($facility as $row) { ?>  
                  <input type="hidden" name="idBusiness" value="<?php echo $detailBusiness->idBusiness ?>">
                  <input type="text" readonly class="form-control" name="facilityBusiness" id="facilityBusiness<?php echo $row->nameIcon ?>" value="<?php echo $detailBusiness->facilityBusiness ?>">
                  <table class="table listfacility<?php echo $row->idfacility ?>">
                    <thead>
                      <tr>
                        <th>Nama Facility</th>
                        <th>Type Facility</th>
                        <th>Image Facility</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                  <script type="text/javascript">
                    $(document).ready(function () {
                      $.ajax({
                        type: "POST",
                        url: '<?php echo base_url("cms/home/sendajaxFacility/") ?>',
                        success: function(response) {
                          var result = JSON.parse(response);
                          console.log(result);
                          // Assuming 'datatable-buttons' is the ID of your table
                          var tableBody = document.querySelector(".listfacility<?php echo $row->idfacility ?> tbody");

                          // Clear any previous content
                          tableBody.innerHTML = '';
                          try {
                            // Assuming 'result' is an array of objects
                            result.forEach(function(item) {
                              var tr = document.createElement('tr');

                              var tdidfacility = document.createElement('td');
                              var idfacilityInput = document.createElement('input');
                              idfacilityInput.type = 'hidden';
                              idfacilityInput.value = item.idfacility;
                              idfacilityInput.id = 'idfacility'+item.idfacility;
                              idfacilityInput.name = 'idfacility';

                              var tdnamefacility = document.createElement('td');
                              tdnamefacility.textContent = item.nameIcon;

                              var tdtypefacility = document.createElement('td');
                              tdtypefacility.textContent = item.typeIcon;

                              var tdimagefacility = document.createElement('td');
                              var urlImageFacility = document.createElement('img');
                              urlImageFacility.src = '<?php echo base_url('/assets/images/facilites/'); ?>'+item.imgIcon;

                              var tdAction = document.createElement('td');
                              var actionCheckbox = document.createElement('input');
                              actionCheckbox.type = 'checkbox';
                              actionCheckbox.dataset.type = item.typeIcon;
                              actionCheckbox.id = item.nameIcon;
                              // Set data-type<?php echo $row->idfacility ?> attribute for the row
                              tr.setAttribute('data-type<?php echo $row->idfacility ?>', item.typeIcon);
                              // Add a click event listener to the row to handle checkbox clicks
                              actionCheckbox.addEventListener('click', function(e) {
                                e.stopPropagation(); // Prevent the click event from reaching the row
                                // Get all rows in the table
                                var allRows = document.querySelectorAll('table tbody tr');

                                // Initialize checked count
                                var checkedCount = 0;
                                console.log("checkedCount", checkedCount);
                                allRows.forEach(function(row) {
                                  var dataType = row.getAttribute('data-type<?php echo $row->idfacility ?>');

                                  if (dataType === item.typeIcon) {
                                    var checkbox = row.querySelector('input[type="checkbox"]');

                                    checkbox.addEventListener('change', function() {
                                      if (this.checked) {
                                        checkedCount++;
                                        allRows.forEach(function(r) {
                                          var rType = r.getAttribute('data-type<?php echo $row->idfacility ?>');
                                          if (rType === item.typeIcon) {
                                            var cb = r.querySelector('input[type="checkbox"]');
                                            if (!cb.checked) {
                                              cb.disabled = false;
                                            }
                                          }
                                        });
                                      } else {
                                        checkedCount--;
                                        allRows.forEach(function(r) {
                                          var rType = r.getAttribute('data-type<?php echo $row->idfacility ?>');
                                          if (rType === item.typeIcon) {
                                            var cb = r.querySelector('input[type="checkbox"]');
                                            cb.disabled = false;
                                          }
                                        });
                                      }
                                    });
                                  }
                                });

                              });

                              // Add data attributes
                              actionCheckbox.onclick = function() {
                                chooseFacility(item.nameIcon); // Assuming 'chooseFacility' function takes a parameter
                                if (this.checked) {
                                  let selectedOptions = JSON.parse(localStorage.getItem('selectedOptions')) || [];
                                  selectedOptions.push(item.nameIcon);
                                  localStorage.setItem('selectedOptions', JSON.stringify(selectedOptions));
                                  document.getElementById('facilityBusiness<?php echo $row->nameIcon ?>').value = selectedOptions;
                                } else {
                                  let selectedOptions = JSON.parse(localStorage.getItem('selectedOptions')) || [];
                                  selectedOptions = selectedOptions.filter(items => items !== item.nameIcon);
                                  localStorage.setItem('selectedOptions', JSON.stringify(selectedOptions));
                                  actionCheckbox.setAttribute('disabled', 'True');
                                }
                              };

                              window.addEventListener('beforeunload', function() {
                                localStorage.removeItem('selectedOptions');
                              });

                              tdAction.appendChild(actionCheckbox);
                              tdimagefacility.appendChild(urlImageFacility);
                              tdidfacility.appendChild(idfacilityInput);
                              tr.appendChild(tdnamefacility);
                              tr.appendChild(tdtypefacility);
                              tr.appendChild(tdimagefacility);
                              tr.appendChild(tdAction);

                              tableBody.appendChild(tr);
                            });
                          } catch (error) {
                            console.error('Error:', error.message);
                            AlertError();
                            // Add your error handling code here
                          } 

                          function chooseFacility(facility) {
                            // Add your code to handle the chosen facility here
                            console.log("Chosen facility:", facility);
                          }
                        }
                      });
                    });
                  </script>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-warning btn-flat">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Gallery Business Detail </h2>
            <ul class="nav navbar-right panel_toolbox">
              <li>
                <a class="collapse-link">
                  <i class="fa fa-chevron-down" style="color: red;"></i>
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
          <div class="x_content" style="display: none;">
            <br />
            <div class="row">
              <?php
                $building = array();
                $this->db->from('building_detail');
                $this->db->where('idBusiness', $detailBusiness->idBusiness);
                $query = $this->db->get();
                if ($query->num_rows() > 0)
                {
                  foreach ($query->result() as $row)
                  {
                    $building[] = $row;
                  }
                }
                $query->free_result(); 
                foreach($building as $businessDetail) {
              ?>
                <div class="col-md-4" style="padding: 50px;">
                  <style type="text/css">
                    .image-container {
                      position: relative;
                      display: inline-block;
                      width: 100%;
                    }

                    .overlay {
                      position: absolute;
                      top: 0;
                      left: 0;
                      width: 100%;
                      height: 100%;
                      background: rgba(0, 0, 0, 0.7);
                      display: flex;
                      flex-direction: column;
                      justify-content: center;
                      align-items: center;
                      color: #fff;
                      opacity: 0;
                      transition: opacity 0.3s ease;
                      cursor: pointer;
                    }

                    .image-container:hover .overlay {
                      opacity: 1;
                    }
                  </style>
                  <?php
                    if($businessDetail->imgBuilding == '') {
                  ?>
                  <div class="image-container">
                    <img id="result-image" width="100%" src="https://cms.onixlabs.tech/assets/images/placeholder.png" alt="<?php echo $businessDetail->imgBuilding; ?>">
                    <a target="_blank" href="https://cms.onixlabs.tech/assets/images/placeholder.png">
                      <div class="overlay">
                        <span>View Fullscreen</span>
                      </div>
                    </a>
                  </div>
                  <button class="btn btn-primary" style="margin-top: 10px;" data-toggle="modal" data-target="#cropperModal<?php echo $businessDetail->idbuilding; ?>">Upload image</button>
                  <?php
                    } else {
                  ?>
                  <div class="image-container">
                    <img id="result-image" width="100%" src="<?php echo base_url('/assets/images/gallery/'.$businessDetail->imgBuilding); ?>" alt="<?php echo $businessDetail->imgBuilding; ?>">
                    <a target="_blank" href="<?php echo base_url('/assets/images/gallery/'.$businessDetail->imgBuilding); ?>">
                      <div class="overlay">
                        <span>View Fullscreen</span>
                      </div>
                    </a>
                  </div>
                  <button class="btn btn-primary" style="margin-top: 10px;" data-toggle="modal" data-target="#cropperModal<?php echo $businessDetail->idbuilding; ?>">Upload image</button>
                  <?php
                    }
                  ?>
                </div>
                <div class="modal fade" id="cropperModal<?php echo $businessDetail->idbuilding; ?>" tabindex="-1" role="dialog" aria-labelledby="cropperModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="cropperModalLabel">Image cropper <?php echo $businessDetail->idbuilding; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <img id="image<?php echo $businessDetail->idbuilding ?>" src="" alt="Picture" class="cropper-hidden">
                        <div style="padding-top: 10px;">
                          <input type="hidden" value="<?php echo $businessDetail->idBusiness ?>" name="idBusiness" id="idBusiness<?php echo $businessDetail->idbuilding ?>">
                          <input type="hidden" value="<?php echo $businessDetail->idbuilding ?>" name="idbuilding" id="idbuilding<?php echo $businessDetail->idbuilding ?>">
                          <input type="hidden" name="dataX" id="dataX" value="422">
                          <input type="hidden" name="dataY" id="dataY" value="290">
                          <input type="hidden" name="dataHeight" id="dataHeight" value="422">
                          <input type="hidden" name="dataWidth" id="dataWidth" value="290">
                          <label class="btn btn-primary btn-upload" for="inputImage<?php echo $businessDetail->idbuilding ?>" title="Upload image file">
                            <input type="file" class="sr-only" id="inputImage<?php echo $businessDetail->idbuilding ?>" name="imgBuilding" accept="image/*">
                            <span class="docs-tooltip" data-toggle="tooltip<?php echo $businessDetail->idbuilding ?>" title="" data-original-title="Import image with Blob URLs">
                              Import
                              <span class="fa fa-upload"></span>
                            </span>
                          </label>
                          <button type="button" id="submitBtn<?php echo $businessDetail->idbuilding ?>" class="btn btn-success">
                            <span class="docs-tooltip" data-toggle="tooltip<?php echo $businessDetail->idbuilding ?>" title="" data-original-title="Import image with Blob URLs">
                              Submit
                              <span class="fa fa-save"></span>
                            </span>
                          </button>
                        </div>
                      </div>
                      <div class="modal-footer">
                      </div>
                    </div>
                  </div>
                  
                  <script>
                    // import 'cropperjs/dist/cropper.css';
                    $(document).ready(function () {
                      $('#cropperModal<?php echo $businessDetail->idbuilding; ?>').on('shown.bs.modal', function () {
                        var Cropper = window.Cropper;
                        var URL = window.URL || window.webkitURL;
                        console.log(URL + " lalala <?php echo $businessDetail->idbuilding ?>")
                        if (URL) {
                          console.log("truee <?php echo $businessDetail->idbuilding ?>")
                        }
                        // var container = document.querySelector('.img-container');
                        var image = document.getElementById('image<?php echo $businessDetail->idbuilding ?>');
                        var options = {
                          aspectRatio: 16/9,
                          cropBoxResizable: false,
                          // preview: '.img-preview',
                          ready: function(e) {
                            console.log(e.type);
                          },
                          cropstart: function(e) {
                            console.log(e.type, e.detail.action);
                          },
                          cropmove: function(e) {
                            // console.log(e.type, e.detail.action);
                          },
                          cropend: function(e) {
                            console.log(e.type, e.detail.action);
                          },
                          crop: function(e) {
                            var data = e.detail;

                            console.log(e.type);
                            dataX.value = Math.round(data.x);
                            dataY.value = Math.round(data.y);
                            dataHeight.value = Math.round(data.height);
                            dataWidth.value = Math.round(data.width);
                          },
                          zoom: function(e) {
                            console.log(e.type, e.detail.ratio);
                          },
                        };
                        
                        var cropper = new Cropper(image, options); 
                        var originalImageURL = image.src;
                        var uploadedImageType = 'image/jpeg';
                        var uploadedImageName = 'cropped.jpg';
                        var uploadedImageURL = './assets/images/gallery/';

                        // Import image
                        var inputImage = document.getElementById('inputImage<?php echo $businessDetail->idbuilding ?>');
                        var idBusiness = document.getElementById('idBusiness<?php echo $businessDetail->idbuilding ?>');
                        var idbuilding = document.getElementById('idbuilding<?php echo $businessDetail->idbuilding ?>');

                        if (URL) {
                          inputImage.onchange = function() {
                            var files = this.files;
                            var file;
                            console.log("inputImage", inputImage);
                            console.log("idBusiness", idBusiness.value);
                            console.log("idbuilding", idbuilding.value);
                            if (files && files.length) {
                              file = files[0];

                              if (/^image\/\w+/.test(file.type)) {
                                uploadedImageType = file.type;
                                uploadedImageName = file.name;

                                if (uploadedImageURL) {
                                  URL.revokeObjectURL(uploadedImageURL);
                                }

                                image.src = uploadedImageURL = URL.createObjectURL(file);

                                if (cropper) {
                                  cropper.destroy();
                                }

                                cropper = new Cropper(image, options);
                              } else {
                                window.alert('Please choose an image file.');
                              }
                            }
                          };
                        } else {
                          inputImage.disabled = true;
                          inputImage.parentNode.className += ' disabled';
                        }

                        // Function to submit the form with cropped image data
                        function submitCroppedImage(idbuilding) {
                          // Extract the cropped data and set the values of hidden form inputs
                          document.getElementById('dataX').value = Math.round(cropper.getData().x);
                          document.getElementById('dataY').value = Math.round(cropper.getData().y);
                          document.getElementById('dataHeight').value = Math.round(cropper.getData().height);
                          document.getElementById('dataWidth').value = Math.round(cropper.getData().width);

                          // Extract the uploaded image format
                          var uploadedImageFormat = uploadedImageName.split('.').pop().toLowerCase();

                          // Extract the cropped data
                          var croppedData = {
                            dataX: Math.round(cropper.getData().x),
                            dataY: Math.round(cropper.getData().y),
                            dataHeight: Math.round(cropper.getData().height),
                            dataWidth: Math.round(cropper.getData().width),
                            uploadedImagePath: uploadedImageFormat // Pass the uploaded image format
                          };

                          var blobUri = uploadedImageURL;

                          // Extract the unique identifier
                          var uniqueIdentifier = blobUri.split('/').pop();
                          console.log(uniqueIdentifier);

                          var fData = new FormData();
                          var fileInput = document.getElementById('inputImage'+idbuilding);
                          var idBusiness = document.getElementById('idBusiness'+idbuilding);
                          var idbuilding = document.getElementById('idbuilding'+idbuilding);
                          console.log(fileInput);
                          console.log(fileInput.files);
                          console.log(fileInput.files.length);
                          console.log(idBusiness.value);
                          console.log(idbuilding.value);
                          fData.append('file', fileInput.files[0]);
                          fData.append('dataX', croppedData.dataX);
                          fData.append('dataY', croppedData.dataY);
                          fData.append('dataWidth', croppedData.dataWidth);
                          fData.append('dataHeight', croppedData.dataHeight);
                          fData.append('uploadedImagePath', croppedData.uploadedImagePath);
                          fData.append('uniqueIdentifier', croppedData.uniqueIdentifier);
                          fData.append('idBusiness', idBusiness.value);
                          fData.append('idbuilding', idbuilding.value);

                          $.ajax({
                            type: 'POST',
                            url: '<?php echo base_url('cms/home/updateimgBuilding') ?>',
                            data: fData,
                            processData: false,  // Prevent jQuery from automatically processing the data
                            contentType: false,  // Prevent jQuery from automatically setting the content type
                            success: function (response) {
                              // Handle the response from the server (if needed)
                              console.log("response", response);
                              // Access the image URL from the response array
                              var imageUrl = '<?php echo base_url($businessDetail->imgBuilding); ?>'; // Assuming the full path is the desired URL

                              // Get the image element
                              var result_image = document.getElementById('result-image');

                              // Set the src attribute of the image element using the extracted URL
                              result_image.src = imageUrl;
                              // Assigning the current URL to location.href triggers a reload
                              window.location.href = window.location.href;
                            },
                            error: function (error) {
                              console.error("error", error);
                            }
                          });
                        }

                        // Example: Trigger the form submission when a button is clicked
                        document.getElementById('submitBtn<?php echo $businessDetail->idbuilding ?>').addEventListener('click', function() {
                          submitCroppedImage(<?php echo $businessDetail->idbuilding ?>);
                        });
                      // window.onload(); // This line ensures your existing code runs
                      });
                    });
                  </script>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  // import 'cropperjs/dist/cropper.css';
  $(document).ready(function () {
    var Cropper = window.Cropper;
    var URL = window.URL || window.webkitURL;
    console.log(URL + " lalala ")
    if (URL) {
      console.log("truee ")
    }
    // var container = document.querySelector('.img-container');
    var image = document.getElementById('imageBusiness');
    var options = {
      aspectRatio: 9/16,
      cropBoxResizable: false,
      // preview: '.img-preview',
      ready: function(e) {
        console.log(e.type);
      },
      cropstart: function(e) {
        console.log(e.type, e.detail.action);
      },
      cropmove: function(e) {
        // console.log(e.type, e.detail.action);
      },
      cropend: function(e) {
        console.log(e.type, e.detail.action);
      },
      crop: function(e) {
        var data = e.detail;

        console.log(e.type);
        dataX.value = Math.round(data.x);
        dataY.value = Math.round(data.y);
        dataHeight.value = Math.round(data.height);
        dataWidth.value = Math.round(data.width);
      },
      zoom: function(e) {
        console.log(e.type, e.detail.ratio);
      },
    };
    
    var cropper = new Cropper(image, options); 
    var originalImageURL = image.src;
    var uploadedImageType = 'image/jpeg';
    var uploadedImageName = 'cropped.jpg';
    var uploadedImageURL = './assets/images/hotels/';

    // Import image
    var inputImage = document.getElementById('inputImage');

    if (URL) {
      inputImage.onchange = function() {
        var files = this.files;
        var file;
        console.log("inputImage", inputImage);
        if (files && files.length) {
          file = files[0];

          if (/^image\/\w+/.test(file.type)) {
            uploadedImageType = file.type;
            uploadedImageName = file.name;

            if (uploadedImageURL) {
              URL.revokeObjectURL(uploadedImageURL);
            }

            image.src = uploadedImageURL = URL.createObjectURL(file);

            if (cropper) {
              cropper.destroy();
            }

            cropper = new Cropper(image, options);
          } else {
            window.alert('Please choose an image file.');
          }
        }
      };
    } else {
      inputImage.disabled = true;
      inputImage.parentNode.className += ' disabled';
    }

    // Function to submit the form with cropped image data
    function submitCroppedImage(idbuilding) {
      // Extract the cropped data and set the values of hidden form inputs
      document.getElementById('dataX').value = Math.round(cropper.getData().x);
      document.getElementById('dataY').value = Math.round(cropper.getData().y);
      document.getElementById('dataHeight').value = Math.round(cropper.getData().height);
      document.getElementById('dataWidth').value = Math.round(cropper.getData().width);

      // Extract the uploaded image format
      var uploadedImageFormat = uploadedImageName.split('.').pop().toLowerCase();

      // Extract the cropped data
      var croppedData = {
        dataX: Math.round(cropper.getData().x),
        dataY: Math.round(cropper.getData().y),
        dataHeight: Math.round(cropper.getData().height),
        dataWidth: Math.round(cropper.getData().width),
        uploadedImagePath: uploadedImageFormat // Pass the uploaded image format
      };

      var blobUri = uploadedImageURL;

      // Extract the unique identifier
      var uniqueIdentifier = blobUri.split('/').pop();
      console.log(uniqueIdentifier);

      var fData = new FormData();
      var fileInput = document.getElementById('inputImage');
      var idBusiness = document.getElementById('idBusiness');
      var Name = document.getElementById('Name');
      var addres = document.getElementById('addres');
      var location = document.getElementById('location');
      var typeBusiness = document.getElementById('typeBusiness');
      var ratingstar = document.getElementById('ratingstar');
        var active = document.getElementById('active');
        var hasFnb = document.getElementById('hasFnb');

        var ContentFromEditor = CKEDITOR.instances.cktextarea.getData();
      console.log(fileInput);
      console.log(fileInput.files);
      console.log(fileInput.files.length);
      fData.append('file', fileInput.files[0]);
      fData.append('dataX', croppedData.dataX);
      fData.append('dataY', croppedData.dataY);
      fData.append('dataWidth', croppedData.dataWidth);
      fData.append('dataHeight', croppedData.dataHeight);
      fData.append('uploadedImagePath', croppedData.uploadedImagePath);
      fData.append('idBusiness', idBusiness.value);
      fData.append('Name', Name.value);
      fData.append('addres', addres.value);
      fData.append('location', location.value);
      fData.append('typeBusiness', typeBusiness.value);
        fData.append('descENBusiness', ContentFromEditor);
        fData.append('active', active.value);
      fData.append('ratingstar', ratingstar.value);
        fData.append('hasFnb', hasFnb.value);

      $.ajax({
        type: 'POST',
        url: '<?php echo base_url('cms/home/updateBusinessDetail') ?>',
        data: fData,
        processData: false,  // Prevent jQuery from automatically processing the data
        contentType: false,  // Prevent jQuery from automatically setting the content type
        success: function (response) {
          // Handle the response from the server (if needed)
          console.log("response", response);
          // Assigning the current URL to location.href triggers a reload
          window.location.href = window.location.href;
        },
        error: function (error) {
          console.error("error", error);
        }
      });
    }

    // Example: Trigger the form submission when a button is clicked
    document.getElementById('submitBtn').addEventListener('click', function() {
      submitCroppedImage();
    });
  });
</script>