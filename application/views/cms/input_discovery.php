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
            <h2>Input Discovery <?php echo $this->session->userdata('business') ?>
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
            <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertDiscovery') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
              <input type="hidden" id="idDiscovery" name="idDiscovery" value="<?php echo empty($disc->idDiscovery) ? null : $disc->idDiscovery; ?>"/>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="position">Business Detail <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 ">
                    <select id="idBusiness" name="idBusiness" class="form-control" required>
                      <option value>Choose..</option>
                      <option value="1">Global</option>
                      <?php
                      foreach($businessDetail as $bd) {
                        ?>
                        <option <?php echo (isset($disc->idBusiness) && $disc->idBusiness == $bd->idBusiness) ? 'selected' : ''; ?> value="<?php echo $bd->idBusiness; ?>">
                          <?php echo $bd->Name; ?>
                        </option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="full-name">Keterangan <span class="required">*</span>
                    <br>
                    Template for adding link
                    <br>
                    &lt;div class="hotel-link" id="1"&gt;Hotel Sahira&lt;/div&gt;
                  </label>
                  <div class="col-md-6 col-sm-6 ">
                    <textarea id="cktextarea" name="description">
                      <?php echo isset( $disc->description) ?  $disc->description : "" ?>
                    </textarea>
                  </div>
                </div>

                <div class="item form-group" style="display: flex">
                    <input type="hidden" name="photoPath" id="photoPath" value="<?php  echo empty($disc->pictureUrl) ? null : './assets/images/gallery/'.$disc->pictureUrl; ?>"/>
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Photo <span class="required">*</span>
                    </label>
                    <div class="image-container">
                      <img id="result-image" width="100%" src="<?php  echo empty($disc->pictureUrl) ? 'https://cms.onixlabs.tech/assets/images/placeholder.png' : $disc->pictureUrl; ?>" alt="img" style="width: 250px">
                      <a target="_blank" href="https://cms.onixlabs.tech/assets/images/placeholder.png">
                        <div class="overlay">
                          <span>View Fullscreen</span>
                        </div>
                      </a>
                    </div>
                    <div class="btn btn-primary" style="margin-top: 10px;    height: 35px;" data-toggle="modal" data-target="#cropperModal">Upload image</div>
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
                                  <input type="hidden" name="dataX" id="dataX" value="100">
                                  <input type="hidden" name="dataY" id="dataY" value="170">
                                  <input type="hidden" name="dataHeight" id="dataHeight" value="100">
                                  <input type="hidden" name="dataWidth" id="dataWidth" value="170">
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
                        // import 'cropperjs/dist/cropper.css'
                        $(document).ready(function() {
                          $('#cropperModal').on('shown.bs.modal', function() {
                            var Cropper = window.Cropper;
                            var URL = window.URL || window.webkitURL;
                            // var container = document.querySelector('.img-container');
                            var image = document.getElementById('image');
                            var options = {
                              aspectRatio: 170/100,
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
                            console.log(inputImage)
                            if (URL) {
                              inputImage.onchange = function() {
                                console.log("asdasd")
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
                              console.log(uniqueIdentifier);
                              var fData = new FormData();
                              var fileInput = document.getElementById('inputImage');
                              fData.append('file', fileInput.files[0]);
                              fData.append('dataX', croppedData.dataX);
                              fData.append('dataY', croppedData.dataY);
                              fData.append('dataWidth', croppedData.dataWidth);
                              fData.append('dataHeight', croppedData.dataHeight);
                              fData.append('uploadedImagePath', croppedData.uploadedImagePath);
                              fData.append('uniqueIdentifier', croppedData.uniqueIdentifier);
                              fData.append('type', 'city');
                              $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url('cms/home/uploadImage'); ?> ',
                                data: fData,
                                processData: false, // Prevent jQuery from automatically processing the data
                                contentType: false, // Prevent jQuery from automatically setting the content type
                                success: function(response) {
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
                                  result_image.src = './assets/images/city/' + imageUrl;
                                  inputPhotoPath.value = imageUrl;
                                  $('#cropperModal').modal('toggle');
                                },
                                error: function(error) {
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
