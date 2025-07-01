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
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Input Notification Center <?php echo $this->session->userdata('business') ?>
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
            <!-- <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertFormNewsletter/'.$this->session->userdata('idBusiness').'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left"> -->
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="titleNewsletter">Notification Title <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="titleNewsletter" required="required" name="titleNewsletter" class="form-control" placeholder="New promo from mideast">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="bodyNewsletter">Notification Body<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <textarea class="form-control" id="bodyNewsletter" name="bodyNewsletter"></textarea>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Photo <span class="required">* (1668 x 946)</span>
                </label>
                <div id="fileInputsContainer">
                  <div class="col-md-6 col-sm-6 form-group has-feedback">
                    <img id="imgNewsletter" src="" alt="Picture" class="cropper-hidden">
                    <div style="padding-top: 10px;">
                      <input type="hidden" name="dataX" id="dataX" value="1668">
                      <input type="hidden" name="dataY" id="dataY" value="946">
                      <input type="hidden" name="dataHeight" id="dataHeight" value="1668">
                      <input type="hidden" name="dataWidth" id="dataWidth" value="946">
                      <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                        <input type="file" class="sr-only" id="inputImage" name="imgNewsletter" accept="image/*">
                        <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs">
                          Import
                          <span class="fa fa-upload"></span>
                        </span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <button id="submit_notification_newsletter" class="btn btn-success">Submit</button>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                <script type="text/javascript">
                  var submit_notification_newsletter = document.getElementById('submit_notification_newsletter');
                  document.getElementById('titleNewsletter').addEventListener('input', function() {
                    var titleNewsletter = document.getElementById('titleNewsletter').value;
                    var bodyNewsletter = document.getElementById('bodyNewsletter').value;
                  });

                  // import 'cropperjs/dist/cropper.css';
                  $(document).ready(function () {
                    var Cropper = window.Cropper;
                    var URL = window.URL || window.webkitURL;
                    console.log(URL + " lalala ")
                    if (URL) {
                      console.log("truee ")
                    }
                    // var container = document.querySelector('.img-container');
                    var image = document.getElementById('imgNewsletter');
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
                    var uploadedImageURL = './assets/images/newsletter/';

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
                            console.log('file name', file.name);

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
                      var titleNewsletter = document.getElementById('titleNewsletter');
                      var bodyNewsletter = document.getElementById('bodyNewsletter');
                      console.log('fileInput', fileInput);
                      console.log('fileInput.files', fileInput.files);
                      console.log('fileInput.files[0].name', fileInput.files[0].name);
                      console.log('fileInput.files.length', fileInput.files.length);
                      fData.append('file', fileInput.files[0]);
                      fData.append('dataX', croppedData.dataX);
                      fData.append('dataY', croppedData.dataY);
                      fData.append('dataWidth', croppedData.dataWidth);
                      fData.append('dataHeight', croppedData.dataHeight);
                      fData.append('uploadedImagePath', croppedData.uploadedImagePath);
                      fData.append('titleNewsletter', titleNewsletter.value);
                      fData.append('bodyNewsletter', bodyNewsletter.value);
                      fData.append('type', 'newsletter');

                      $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('cms/home/insertFormNotification/'.$this->session->userdata('idBusiness').'/') ?>',
                        data: fData,
                        processData: false,  // Prevent jQuery from automatically processing the data
                        contentType: false,  // Prevent jQuery from automatically setting the content type
                        success: function (response) {
                          // Handle the response from the server (if needed)
                          // console.log("response", response);
                          // Assigning the current URL to location.href triggers a reload
                          // console.log(titleNewsletter.value);
                          // console.log(bodyNewsletter.value);
                        },
                        error: function (error) {
                          console.error("error", error);
                        }
                      });

                      $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('cms/home/uploadImage'); ?> ',
                        data: fData,
                        processData: false, // Prevent jQuery from automatically processing the data
                        contentType: false, // Prevent jQuery from automatically setting the content type
                        success: function(response) {
                          // console.log("response", response);
                          var result = JSON.parse(response);
                          // Handle the response from the server (if needed)
                          // console.log("response", result);
                          if(result.response == 'error') {
                            alert(result.desc);
                            var loaderText = document.getElementById('loader-text');
                            loaderText.style.display = 'none';
                          }
                          // Access the image URL from the response array
                          var imageUrl = result.data.image; // Assuming the full path is the desired URL
                          // Get the image element
                          var inputPhotoPath = document.getElementById('imgNewsletter');
                          inputPhotoPath.value = imageUrl;
                          // console.log('imageUrl', imageUrl);
                          $.ajax({
                            url: '<?php echo base_url('cms/api/postNotificationNewsletter') ?>', // Replace with the actual URL
                            method: 'POST',
                            contentType: 'application/x-www-form-urlencoded',
                            data: {
                              titleNewsletter: titleNewsletter.value,
                              currentToken: 'DEV',
                              bodyNewsletter: bodyNewsletter.value,
                              imgNewsletter: imageUrl,
                            },
                            success: function(response) {
                              alert(response);
                              window.location.href = window.location.href;
                            },
                            error: function(error) {
                              console.error('Error:', error);
                            }
                          });
                        },
                        error: function(error) {
                          console.error("error", error);
                        }
                      });
                    }

                    submit_notification_newsletter.addEventListener('click', function() {
                      submitCroppedImage();
                    });
                  });
                </script>
              </div>
            </form>
          </div>
          <table id="datatable-buttons" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Title</th>
                <th>Descriptions</th>
                <th>Created At</th>
              </tr>
            </thead>
            <tbody>
              
              <?php
                foreach($notification as $row) {
              ?>
              <tr>
                <td><?php echo $row->nmNotification ?></td>
                <td><?php echo $row->descNotification ?></td>
                <td><?php echo $row->createdAtNotification ?></td>
              </tr>
              <?php }?>
            </tbody>
          </table>
        </div>                
      </div>
    </div>
  </div>
</div>