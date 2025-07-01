<?php if ($this->session->flashdata('pesanerror')) { ?> <script language="javascript" type="text/javascript">
  window.onload = function() {
    swal({
      title: "Failed!",
      text: " <?php echo $this->session-> flashdata('pesanerror'); ?> ",
      type : "error",
      confirmButtonText: "Close"
    });
  }
</script> <?php } ?> <?php if ($this->session->flashdata('pesansukses')) { ?> <script language="javascript" type="text/javascript">
  window.onload = function() {
    swal({
      title: "Success",
      text: " <?php echo $this->session->flashdata('pesansukses'); ?> ",
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
            <h2>Input Discover App</h2>
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
            <div class="form-horizontal form-label-left">
              <div class="item form-group" id="id">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="autocomplete-custom-append-originarea">City *
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="text" id="autocomplete-custom-append-originarea" name="name" class="form-control">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusCity">status City <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select id="statusCity" name="statusCity" class="form-control" required>
                    <option value="">Select Type</option>
                    <option value="1">Active</option>
                    <option value="0">non Active</option>
                    </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Photo <span class="required">* (213 x 302)</span>
                </label>
                <div id="fileInputsContainer">
                  <div class="col-md-6 col-sm-6 form-group has-feedback">
                    <img id="imageCity" src="" alt="Picture" class="cropper-hidden">
                    <div style="padding-top: 10px;">
                      <input type="hidden" name="dataX" id="dataX" value="213">
                      <input type="hidden" name="dataY" id="dataY" value="302">
                      <input type="hidden" name="dataHeight" id="dataHeight" value="213">
                      <input type="hidden" name="dataWidth" id="dataWidth" value="302">
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
                <label class="col-form-label col-md-3 col-sm-3 label-align">Keterangan <span class="required">*</label>
                <div class="col-md-6 col-sm-6">
                  <textarea id="cktextarea" name="Des_City"></textarea>
                </div>
              </div>
              <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <button class="btn btn-primary" type="button">Cancel</button>
                  <button class="btn btn-primary" type="reset">Reset</button>
                  <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>
                </div>
              </div>
            </div>
            <table id="datatable-buttons" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Descriptions</th>
                  <th>Image</th>
                  <th>Created At</th>
                </tr>
              </thead>
              <tbody>
                
                <?php
                  foreach($discovery as $row) {
                ?>
                <tr>
                  <td><?php echo $row->name ?></td>
                  <td><?php echo substr($row->Des_City, 0, 100) ?>...</td>
                  <td><?php echo $row->imgCity ?></td>
                  <td><?php echo $row->createdAtCity ?></td>
                </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- detail2 -->
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
    var image = document.getElementById('imageCity');
    var options = {
      aspectRatio: 9/12,
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
    var uploadedImageURL = './assets/images/city/';

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
      var statusCity = document.getElementById('statusCity');
      var textArea = document.getElementById('cktextarea');
      var idCity = document.getElementById('autocomplete-custom-append-originarea');
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
      fData.append('name', idCity.value);
      fData.append('statusCity', statusCity.value);
        fData.append('Des_City', ContentFromEditor);
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url('cms/home/insert_home_setting') ?>',
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