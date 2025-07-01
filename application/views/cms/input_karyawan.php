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
            <h2>Input Karyawan <?php echo $this->session->userdata('business') ?>
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
            <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertFormKaryawan') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
              <input type="hidden" name="photoPath" id="photoPath"/>
              <input type="hidden" name="idBusiness" value="<?php echo $this->session->userdata('idBusiness') ?>">
              <?php
                if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 7) {
              ?>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="office">Office <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select id="office" name="officeKaryawan" class="form-control" required>
                    <?php
                    if ($this->session->userdata('level') == '7') {
                      $user_level = array();
                      $this->db->from('Business_Detail');
                      $query = $this->db->get();

                      if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                          $user_level[] = $row;
                        }
                      }
                      $query->free_result(); 
                    } else {
                      $user_level = array();
                      $this->db->from('Business_Detail');
                      $this->db->where('idGroup', $this->session->userdata('idGroup'));
                      $this->db->where('idBusiness !=', 2);
                      $query = $this->db->get();

                      if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                          $user_level[] = $row;
                        }
                      }
                      $query->free_result(); 
                    }
                    ?>

                    <?php 
                    foreach($user_level as $row) {
                    ?>
                        <option value="<?php echo $row->idBusiness ?>"><?php echo $row->Name ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <?php } else {
              ?>
              <input type="hidden" id="idBusiness" name="officeKaryawan" value="<?php echo $this->session->userdata('idBusiness') ?>" class="form-control ">
              <?php
              } ?>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="position">Position <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select id="position" name="idLevel" class="form-control" required>
                    <option>Choose..</option>
                    <?php
                    if ($this->session->userdata('level') == '7') {
                      $user_level = array();
                      $this->db->from('user_lavel');
                      $query = $this->db->get();

                      if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                          $user_level[] = $row;
                        }
                      }
                      $query->free_result(); 
                    } elseif ($this->session->userdata('level') == '1') {
                      $user_level = array();
                      $this->db->from('user_lavel');
                      $this->db->where('idLevel >=', 2);
                      $query = $this->db->get();

                      if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                          $user_level[] = $row;
                        }
                      }
                      $query->free_result(); 
                    } elseif ($this->session->userdata('level') == '2') {
                      $user_level = array();
                      $this->db->from('user_lavel');
                      $this->db->where('idLevel >=', 3);
                      $query = $this->db->get();

                      if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                          $user_level[] = $row;
                        }
                      }
                      $query->free_result(); 
                    } elseif ($this->session->userdata('level') == '3') {
                      $user_level = array();
                      $this->db->from('user_lavel');
                      $this->db->where('idLevel >=', 4);
                      $this->db->where('idLevel <', 7);
                      $query = $this->db->get();

                      if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                          $user_level[] = $row;
                        }
                      }
                      $query->free_result(); 
                    }
                    ?>

                    <?php 
                    foreach($user_level as $row) {
                    ?>
                        <option value="<?php echo $row->idLevel ?>"><?php echo $row->Note ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <?php
                if ($this->session->userdata('level') == '7') {
              ?>
              <div class="item form-group" id="group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="business_group">Group <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select id="business_group" name="idGroup" class="form-control" required>
                    <option value>Choose..</option>
                    <?php
                    if ($this->session->userdata('level') == '7') {
                      $user_level = array();
                      $this->db->from('business_group');
                      $query = $this->db->get();

                      if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                          $user_level[] = $row;
                        }
                      }
                      $query->free_result(); 
                    }
                    ?>

                    <?php 
                    foreach($user_level as $row) {
                    ?>
                      <option value="<?php echo $row->idGroup ?>"><?php echo $row->nmGroup ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <?php } else {
              ?>
              <input type="hidden" required name="idGroup" value="<?php echo $this->session->userdata('idGroup') ?>" class="form-control ">
              <?php
              }
              ?>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="departement">Departement <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select id="departement" name="idDep" class="form-control" required>
                    <option value>Choose..</option>
                    <?php
                    if ($this->session->userdata('level') == '7') {
                      $user_level = array();
                      $this->db->from('User_Departemen');
                      $query = $this->db->get();

                      if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                          $user_level[] = $row;
                        }
                      }
                      $query->free_result(); 
                    } elseif ($this->session->userdata('level') == '1') {
                      $user_level = array();
                      $this->db->from('User_Departemen');
                      $this->db->where('idDep >=', 2);
                      $query = $this->db->get();

                      if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                          $user_level[] = $row;
                        }
                      }
                      $query->free_result(); 
                    } elseif ($this->session->userdata('level') == '2') {
                      $user_level = array();
                      $this->db->from('User_Departemen');
                      $this->db->where('idDep >=', 3);
                      $query = $this->db->get();

                      if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                          $user_level[] = $row;
                        }
                      }
                      $query->free_result(); 
                    } elseif ($this->session->userdata('level') == '3') {
                      $user_level = array();
                      $this->db->from('User_Departemen');
                      $this->db->where('idDep >=', 4);
                      $this->db->where('idDep <=', 8);
                      $query = $this->db->get();

                      if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                          $user_level[] = $row;
                        }
                      }
                      $query->free_result(); 
                    }
                    ?>

                    <?php 
                    foreach($user_level as $row) {
                    ?>
                      <option value="<?php echo $row->idDep ?>"><?php echo $row->DepName ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <?php
              if($this->session->userdata('level') == 7) {
              ?>
                <div class="item form-group" id="checkboxSection">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" >User Akses
                        <small class="text-navy">*</small>
                    </label>
                    <div class="col-md-9 col-sm-9 ">

                        <?php foreach ($menu_header as $menu) { ?>
                            <div class="form-check">
                                <input class="form-check-input" name="access[]" type="checkbox" id="<?php echo $menu->name?>" value="<?php echo $menu->name?>">
                                <label class="form-check-label" for="<?php echo $menu->name?>">
                                    <?php echo $menu->displayName?>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                </div>

              <!-- JavaScript to handle checkbox states based on the selected position -->
                  <script>
                      // Attach an event listener to the position dropdown
                      document.getElementById('position').addEventListener('change', function() {
                          // Get the selected value
                          var selectedPosition = this.value;

                          // Define a mapping of position values to checkbox values
                          var positionCheckboxMapping = {
                              '1': ["HRD", "ROOM_REPORT", "INVESTMENT_HOTEL", "BUDGETING_HOTEL", "RATE_STRUCTURE", "INVENTORY", "MEMBERSHIP", "HOUSE_KEEPING", "FRONT_OFFICE", "FNB"],
                              '2': ["ROOM_REPORT", "INVESTMENT_HOTEL", "BUDGETING_HOTEL"],
                              '3': ["HRD", "ROOM_REPORT", "INVESTMENT_HOTEL", "BUDGETING_HOTEL", "RATE_STRUCTURE", "INVENTORY", "MEMBERSHIP", "HOUSE_KEEPING", "FRONT_OFFICE", "FNB", "VOUCHER_CATALOG"],
                              '4': ["ROOM_REPORT", "INVENTORY", "MEMBERSHIP", "HOUSE_KEEPING", "FRONT_OFFICE", "FNB"],
                              '5': ["ROOM_REPORT", "INVENTORY", "MEMBERSHIP", "HOUSE_KEEPING", "FRONT_OFFICE", "FNB"],
                              '6': ["FRONT_OFFICE", "FNB"],
                              '7': ["BUSINESS_DEVELOPMENT", "APP_SETTING", "HRD", "ROOM_REPORT", "INVESTMENT_HOTEL", "BUDGETING_HOTEL", "RATE_STRUCTURE", "INVENTORY", "MEMBERSHIP", "HOUSE_KEEPING", "FRONT_OFFICE", "FNB", "VOUCHER_CATALOG"]
                              // Add more mappings as needed
                          };

                          // Get the corresponding checkbox values for the selected position
                          var checkedValues = positionCheckboxMapping[selectedPosition] || [];

                          // Get all checkboxes in the checkboxSection
                          var checkboxes = document.getElementById('checkboxSection').querySelectorAll('input[type="checkbox"]');

                          // Uncheck all checkboxes
                          checkboxes.forEach(function(checkbox) {
                              checkbox.checked = false;
                          });

                          // Check the checkboxes based on the values in checkedValues
                          checkedValues.forEach(function(value) {
                              var checkbox = document.querySelector('input[value="' + value + '"]');
                              if (checkbox) {
                                  checkbox.checked = true;
                              }
                          });
                      });
                  </script>
              <?php } ?>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="full-name">Nama Lengkap <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="full-name" required name="nmKaryawan" class="form-control ">
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="tgllahir">Tanggal Lahir <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="date" id="tgllahir" required name="tgllahirKaryawan" class="form-control ">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="mobile">Mobile <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="mobile" required name="mobileKaryawan" class="form-control ">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="email" required name="emailKaryawan" class="form-control ">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Password <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="password" id="password" required name="passwordKaryawan" class="form-control ">
                </div>
              </div>
              <style type="text/css">
                /* Add some styling for the uploaded image */
                #uploadedImage {
                  max-width: 100%;
                  max-height: 200px; /* Set a maximum height to avoid stretching the image */
                  margin-top: 10px;
                }
              </style>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Photo <span class="required">*</span>
                </label>
                  <div class="image-container">
                    <img id="result-image" width="100%" src="https://cms.onixlabs.tech/assets/images/placeholder.png" alt="img" style="width: 250px">
                    <a target="_blank" href="https://cms.onixlabs.tech/assets/images/placeholder.png">
                      <div class="overlay">
                        <span>View Fullscreen</span>
                      </div>
                    </a>
                  </div>
                  <div class="btn btn-primary" style="margin-top: 10px;" data-toggle="modal" data-target="#cropperModal">Upload image</div>
                  <div class="modal fade" id="cropperModal" tabindex="-1" role="dialog" aria-labelledby="cropperModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="cropperModalLabel">Image cropper Photo</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                  <img id="image" src="" alt="Picture" class="cropper-hidden">
                                  <div style="padding-top: 10px;">
                                      <input type="hidden" name="idBusiness" value="<?php echo $this->session->userdata('idBusiness') ?>">
                                      <input type="hidden" name="dataX" id="dataX" value="512">
                                      <input type="hidden" name="dataY" id="dataY" value="512">
                                      <input type="hidden" name="dataHeight" id="dataHeight" value="512">
                                      <input type="hidden" name="dataWidth" id="dataWidth" value="512">
                                      <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                                      <input type="file" class="sr-only" id="inputImage" name="imgBuilding" accept="image/*">
                                          <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs">
                                            Import
                                            <span class="fa fa-upload"></span>
                                          </span>
                                      </label>
                                      <button type="button" id="submitBtn" class="btn btn-success">
                                          <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs">
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

                      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                      <script>
                          // import 'cropperjs/dist/cropper.css';
                          $(document).ready(function () {
                              $('#cropperModal').on('shown.bs.modal', function () {
                                  var Cropper = window.Cropper;
                                  var URL = window.URL || window.webkitURL;

                                  // var container = document.querySelector('.img-container');
                                  var image = document.getElementById('image');
                                  var options = {
                                      aspectRatio: 1/1,
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
                                  var inputImage = document.getElementById('inputImage');
                                  var idBusiness = document.getElementById('idBusiness');

                                  if (URL) {
                                      inputImage.onchange = function() {
                                          var files = this.files;
                                          var file;
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
                                  function submitCroppedImage() {
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

                                      var fData = new FormData();
                                      var fileInput = document.getElementById('inputImage')
                                      console.log(fileInput);
                                      console.log(fileInput.files[0]);

                                      fData.append('file', fileInput.files[0]);
                                      fData.append('dataX', croppedData.dataX);
                                      fData.append('dataY', croppedData.dataY);
                                      fData.append('dataWidth', croppedData.dataWidth);
                                      fData.append('dataHeight', croppedData.dataHeight);
                                      fData.append('uploadedImagePath', croppedData.uploadedImagePath);
                                      fData.append('uniqueIdentifier', croppedData.uniqueIdentifier);
                                      fData.append('type', 'karyawan');

                                      $.ajax({
                                          type: 'POST',
                                          url: '<?php echo base_url('cms/home/uploadImage') ?>',
                                          data: fData,
                                          processData: false,  // Prevent jQuery from automatically processing the data
                                          contentType: false,  // Prevent jQuery from automatically setting the content type
                                          success: function (response) {
                                              console.log("response", response);
                                              var result = JSON.parse(response);
                                              // Handle the response from the server (if needed)
                                              console.log("response", result);
                                              // Access the image URL from the response array
                                              var imageUrl = result.data.image; // Assuming the full path is the desired URL

                                              // Get the image element
                                              var result_image = document.getElementById('result-image');
                                              var inputPhotoPath = document.getElementById('photoPath');

                                              // Set the src attribute of the image element using the extracted URL
                                              result_image.src = '/assets/images/karyawan/' + imageUrl;
                                              inputPhotoPath.value = imageUrl;

                                              $('#cropperModal').modal('toggle');
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
                                  // window.onload(); // This line ensures your existing code runs
                              });
                          });
                      </script>
                  </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">
                </label>
                 <div id="fileInputsContainer">
                  <div class="col-md-6 col-sm-6 form-group has-feedback">
                    <div id="imagePreview">
                        <!-- The uploaded image will be displayed here -->
                    </div>
                    <script>
                        function displayImage(event) {
                            const file = event.target.files[0];
                            const reader = new FileReader();

                            reader.onload = function() {
                                const img = document.createElement('img');
                                img.src = reader.result;
                                img.id = 'uploadedImage';
                                document.getElementById('imagePreview').innerHTML = '';
                                document.getElementById('imagePreview').appendChild(img);
                            }

                            reader.readAsDataURL(file);
                        }
                    </script>
                  </div>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="linkedin">LinkedIn <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="linkedin" required name="linkedinKaryawan" class="form-control ">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="instagram">Instagram <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="instagram" required name="instagramKaryawan" class="form-control ">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="facebook">Facebook <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="facebook" required name="facebookKaryawan" class="form-control ">
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <button class="btn btn-primary" type="button">Cancel</button>
                  <button class="btn btn-primary" type="reset">Reset</button>
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>