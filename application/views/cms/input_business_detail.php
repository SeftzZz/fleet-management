<?php if ($this->session->flashdata('pesanerror')) { ?> <script language="javascript" type="text/javascript">
  window.onload = function() {
    swal({
      title: "Failed!",
      text: " <?php echo $this->session->flashdata('pesanerror');?>",
      type : "error",
      confirmButtonText: "Close"
    });
  }
</script> <?php } ?> <?php if ($this->session->flashdata('pesansukses')) { ?> <script language="javascript" type="text/javascript">
  window.onload = function() {
    swal({
      title: "Success",
      text: " <?php echo $this->session->flashdata('pesansukses');?>",
      type : "success",
      confirmButtonText: "Close"
    });
  }
</script> <?php } ?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Input Business Detail </h2>
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
            <!-- <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertBusinessDetail') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left"> -->
            <div class="form-horizontal">
              <?php
                if ($this->session->userdata('level') == '7') {
              ?>
              <div class="item form-group" id="group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="business_group">Group <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select id="idGroup" name="idGroup" class="form-control" required>
                    <option value>Choose..</option>
                    <?php
                      $user_level = array();
                      $this->db->from('business_group');
                      $query = $this->db->get();

                      if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                          $user_level[] = $row;
                        }
                      }
                      $query->free_result(); 
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
              <?php
              } else {
              ?>
              <input type="hidden" name="idGroup" id="idGroup" value="<?php echo $this->session->userdata('idGroup') ?>">
              <?php
              }
              ?>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="Name">Nama <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="Name" required="required" name="Name" class="form-control " value="<?php echo empty($businessDetail->Name) ? null : $businessDetail->Name; ?>">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="tgllahir">Address <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="addres" required="required" name="addres" class="form-control " value="<?php echo empty($businessDetail->addres) ? null : $fnbMenu->addres; ?>">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="mobileBusiness">Telephone <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="mobileBusiness" required="required" name="mobileBusiness" class="form-control ">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="emailReservationBusiness">Email Reservation <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="emailReservationBusiness" required="required" name="emailReservationBusiness" class="form-control ">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="emailFOMBusiness">Email FOM <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="emailFOMBusiness" required="required" name="emailFOMBusiness" class="form-control ">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="emailCABusiness">Email CA <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="emailCABusiness" required="required" name="emailCABusiness" class="form-control ">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="emailARBusiness">Email AR <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="emailARBusiness" required="required" name="emailARBusiness" class="form-control ">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="feeBusiness">Fee Business <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="number" id="feeBusiness" required="required" name="feeBusiness" class="form-control ">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="extrabedBusiness">Extrabed <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="number" id="extrabedBusiness" required="required" name="extrabedBusiness" class="form-control ">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="messageBusiness">Business Message <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="number" id="messageBusiness" required="required" name="messageBusiness" class="form-control ">
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
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="tgllahir">Location Url from Google Map<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="urlmapBusiness" required="required" name="urlmapBusiness" class="form-control " value="<?php echo empty($businessDetail->urlmapBusiness) ? null : $fnbMenu->urlmapBusiness; ?>">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="tgllahir">Latitude <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="latitude" required="required" name="latitude" class="form-control " value="<?php echo empty($businessDetail->latitude) ? null : $fnbMenu->latitude; ?>">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="tgllahir">Longitude <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="longitude" required="required" name="longitude" class="form-control " value="<?php echo empty($businessDetail->longitude) ? null : $fnbMenu->longitude; ?>">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="tgllahir">Business Type <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select required="required" name="typeBusiness" id="typeBusiness" class="form-control" >
                    <option value="">Select Type</option>
                    <option value="OFFICE">OFFICE</option>
                    <option value="HOTEL">HOTEL</option>
                    <option value="CAFE">CAFE</option>
                    <option value="PLACE">PLACE</option>
                  </select>
                </div>
              </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="tgllahir">Has FNB<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <select required="required" name="hasFnb" id="hasFnb" class="form-control" >
                            <option value="">Select active</option>
                            <option value="1">Active</option>
                            <option value="0">Deactivate</option>
                        </select>
                    </div>
                </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Business grade (rating's) <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select required="required"  id="ratingstar" disabled name="ratingstar" class="form-control">
                    <option value="">Select Type</option>
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                    <option value="0">0</option>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="cktextarea">Keterangan<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input id="cktextarea" required="required" class="form-control __textarea" name="descENBusiness" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></input>
                </div>
              </div>
              <script>
                const typeBusinessSelect = document.getElementById('typeBusiness');
                const ratingStarSelect = document.getElementById('ratingstar');

                typeBusinessSelect.addEventListener('change', (event) => {
                  if (event.target.value != 'HOTEL') {
                    ratingStarSelect.disabled = true; // Disable ratingstar for OFFICE
                    ratingStarSelect.style.display='none';
                  } else {
                    ratingStarSelect.disabled = false; // Enable ratingstar for other types
                    ratingStarSelect.style.display='block'
                  }
                });
              </script>
              <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <button class="btn btn-primary" type="button">Cancel</button>
                  <button class="btn btn-primary" type="reset">Reset</button>
                  <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>
                </div>
              </div>
            <!-- </form> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
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
      var idGroup = document.getElementById('idGroup');
      var Name = document.getElementById('Name');
      var addres = document.getElementById('addres');
      var urlmapBusiness = document.getElementById('urlmapBusiness');
      var latitude = document.getElementById('latitude');
      var longitude = document.getElementById('longitude');
      var emailReservationBusiness = document.getElementById('emailReservationBusiness');
      var emailFOMBusiness = document.getElementById('emailFOMBusiness');
      var emailCABusiness = document.getElementById('emailCABusiness');
      var emailARBusiness = document.getElementById('emailARBusiness');
      var mobileBusiness = document.getElementById('mobileBusiness');
      var feeBusiness = document.getElementById('feeBusiness');
      var messageBusiness = document.getElementById('messageBusiness');
      var extrabedBusiness = document.getElementById('extrabedBusiness');
      var typeBusiness = document.getElementById('typeBusiness');
      var ratingstar = document.getElementById('ratingstar');
      var hasFnb = document.getElementById('hasFnb');
      var ContentFromEditor = CKEDITOR.instances.cktextarea.getData();
      var cktextarea = document.getElementById('cktextarea');
      console.log(fileInput);
      console.log(fileInput.files);
      console.log(fileInput.files.length);
      fData.append('file', fileInput.files[0]);
      fData.append('dataX', croppedData.dataX);
      fData.append('dataY', croppedData.dataY);
      fData.append('dataWidth', croppedData.dataWidth);
      fData.append('dataHeight', croppedData.dataHeight);
      fData.append('uploadedImagePath', croppedData.uploadedImagePath);
      fData.append('idGroup', idGroup.value);
      fData.append('Name', Name.value);
      fData.append('addres', addres.value);
      fData.append('urlmapBusiness', urlmapBusiness.value);
      fData.append('latitude', latitude.value);
      fData.append('longitude', longitude.value);
      fData.append('emailReservationBusiness', emailReservationBusiness.value);
      fData.append('emailFOMBusiness', emailFOMBusiness.value);
      fData.append('emailCABusiness', emailCABusiness.value);
      fData.append('emailARBusiness', emailARBusiness.value);
      fData.append('mobileBusiness', mobileBusiness.value);
      fData.append('feeBusiness', feeBusiness.value);
      fData.append('messageBusiness', messageBusiness.value);
      fData.append('extrabedBusiness', extrabedBusiness.value);
      fData.append('typeBusiness', typeBusiness.value);
      fData.append('ratingstar', ratingstar.value)
      fData.append('hasFnb', hasFnb.value);
      fData.append('cktextarea', ContentFromEditor);
       $.ajax({
         type: 'POST',
         url: '<?php echo base_url('cms/home/insertBusinessDetail') ?>',
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
</div>