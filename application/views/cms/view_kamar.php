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
      <?php 
       if($this->session->userdata('level') == 7) {
      ?>
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Input Kamar
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
            <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertFormKamar/'.$idBusiness.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
              <input type="hidden" name="idBusiness" value="<?php echo $idBusiness ?>">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kuantiti Kamar <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="number" id="first-name" required="required" name="qtyKamar" class="form-control" min="1" placeholder="1">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="type-kamar">Type Kamar <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="type-kamar" required="required" name="ketKamar" class="form-control" placeholder="1">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Harga Kamar RO <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 form-group has-feedback">
                  <input type="text" name="totalHargaRO" id="priceInputRO" required="required" class="form-control" value="">
                  <span class="form-control-feedback right" aria-hidden="true">IDR</span>
                </div>
              </div>
              <script>
                var inputElementRO = document.getElementById("priceInputRO");
                inputElementRO.addEventListener("input", function() {
                  var inputValueRO = inputElementRO.value;
                  // Remove non-numeric characters
                  var numericValue = inputValueRO.replace(/[^0-9.]/g, '');
                  const doubleNumber = Number(numericValue);
                  console.log(doubleNumber);
                  // Set the value of the input to doubleNumber
                  inputElementRO.value = doubleNumber;
                  // Format the value with commas and two decimal places
                  var formattedValue = formatNumberWithCommasAndDecimalsRO(numericValue);
                  // Update the input value with the formatted value
                  inputElementRO.value = formattedValue;
                });
                function formatNumberWithCommasAndDecimalsRO(number) {
                  var parts = number.split(".");
                  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                  return parts.join(".");
                }
              </script>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Harga Kamar RB <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 form-group has-feedback">
                  <input type="text" name="totalHargaRB" id="priceInputRB" required="required" class="form-control" value="">
                  <span class="form-control-feedback right" aria-hidden="true">IDR</span>
                </div>
              </div>
              <script>
                var inputElement = document.getElementById("priceInputRB");
                inputElement.addEventListener("input", function() {
                    var inputValue = inputElement.value;
                    // Remove non-numeric characters
                    var numericValue = inputValue.replace(/[^0-9.]/g, '');
                    const doubleNumber = Number(numericValue);
                    console.log(doubleNumber);
                    // Set the value of the input to doubleNumber
                    inputElement.value = doubleNumber;
                    // Format the value with commas and two decimal places
                    var formattedValue = formatNumberWithCommasAndDecimals(numericValue);
                    // Update the input value with the formatted value
                    inputElement.value = formattedValue;
                });
                function formatNumberWithCommasAndDecimals(number) {
                    var parts = number.split(".");
                    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    return parts.join(".");
                }
              </script>
              <input type="hidden" name="photoPath1" id="photoPath1"/>
              <div class="item form-group" style="display: flex">
                  <label class="col-form-label col-md-3 col-sm-3 label-align">Gambar Kamar 1 <span class="required">*</span>
                  </label>
                  <div class="image-container">
                      <img id="result-image1" width="100%" src="https://cms.onixlabs.tech/assets/images/placeholder.png" alt="img" style="width: 250px">
                      <a target="_blank" href="https://cms.onixlabs.tech/assets/images/placeholder.png">
                          <div class="overlay">
                              <span>View Fullscreen</span>
                          </div>
                      </a>
                  </div>
                  <div class="btn btn-primary" style="height: 35px;" data-toggle="modal" data-target="#cropperModal1">Upload image</div>
                  <div class="modal fade" id="cropperModal1" tabindex="-1" role="dialog" aria-labelledby="cropperModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="cropperModalLabel">Image cropper Photo</h5>
                                  <div class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </div>
                              </div>
                              <div class="modal-body">
                                  <img id="image1" src="" alt="Picture" class="cropper-hidden">
                                  <div style="padding-top: 10px;">
                                      <input type="hidden" name="idBusiness" value="<?php echo $idBusiness ?>">
                                      <input type="hidden" name="dataX" id="dataX" value="422">
                                      <input type="hidden" name="dataY" id="dataY" value="290">
                                      <input type="hidden" name="dataHeight" id="dataHeight" value="422">
                                      <input type="hidden" name="dataWidth" id="dataWidth" value="290">
                                      <label class="btn btn-primary btn-upload" for="inputImage1" title="Upload image file">
                                          <input type="file" class="sr-only" id="inputImage1" name="imgBuilding" accept="image/*">
                                          <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs">
                                        Import
                                        <span class="fa fa-upload"></span>
                                      </span>
                                      </label>
                                      <div  id="submitBtn1" class="btn btn-success">
                                      <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs">
                                            Submit
                                            <span class="fa fa-save"></span>
                                      </span>
                                      </div>
                                  </div>
                              </div>
                              <div class="modal-footer">
                              </div>
                          </div>
                      </div>
                      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                      <script>
                          // import 'cropperjs/dist/cropper.css'
                          $(document).ready(function () {
                              $('#cropperModal1').on('shown.bs.modal', function () {
                                  var Cropper = window.Cropper;
                                  var URL = window.URL || window.webkitURL;
                                  // var container = document.querySelector('.img-container');
                                  var image = document.getElementById('image1');
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
                                  var uploadedImageURL = './assets/images/kamar/';
                                  // Import image
                                  var inputImage = document.getElementById('inputImage1');
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
                                      var fileInput= document.getElementById('inputImage1');
                                      console.log(uniqueIdentifier)
                                      fData.append('file', fileInput.files[0]);
                                      fData.append('dataX', croppedData.dataX);
                                      fData.append('dataY', croppedData.dataY);
                                      fData.append('dataWidth', croppedData.dataWidth);
                                      fData.append('dataHeight', croppedData.dataHeight);
                                      fData.append('uploadedImagePath', croppedData.uploadedImagePath);
                                      fData.append('uniqueIdentifier', croppedData.uniqueIdentifier);
                                      fData.append('type', 'kamar');
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
                                              var result_image = document.getElementById('result-image1');
                                              var inputPhotoPath = document.getElementById('photoPath1');
                                              // Set the src attribute of the image element using the extracted URL
                                              result_image.src = '/assets/images/kamar/' + imageUrl;
                                              inputPhotoPath.value = imageUrl;
                                              $('#cropperModal1').modal('toggle');
                                          },
                                          error: function (error) {
                                              console.error("error", error);
                                          }
                                      });
                                  }
                                  // Example: Trigger the form submission when a button is clicked
                                  document.getElementById('submitBtn1').addEventListener('click', function() {
                                      submitCroppedImage();
                                  });
                                  // window.onload(); // This line ensures your existing code runs
                              });
                          });
                      </script>
                  </div>
              </div>
              
              <input type="hidden" name="photoPath2" id="photoPath2"/>
              <div class="item form-group" style="display: flex">
                  <label class="col-form-label col-md-3 col-sm-3 label-align">Gambar Kamar 2 <span class="required">*</span>
                  </label>
                  <div class="image-container">
                      <img id="result-image2" width="100%" src="https://cms.onixlabs.tech/assets/images/placeholder.png" alt="img" style="width: 250px">
                      <a target="_blank" href="https://cms.onixlabs.tech/assets/images/placeholder.png">
                          <div class="overlay">
                              <span>View Fullscreen</span>
                          </div>
                      </a>
                  </div>
                  <div class="btn btn-primary" style="height: 35px" data-toggle="modal" data-target="#cropperModal2">Upload image</div>
                  <div class="modal fade" id="cropperModal2" tabindex="-1" role="dialog" aria-labelledby="cropperModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="cropperModalLabel">Image cropper Photo</h5>
                                  <div type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </div>
                              </div>
                              <div class="modal-body">
                                  <img id="image2" src="" alt="Picture" class="cropper-hidden">
                                  <div style="padding-top: 10px;">
                                      <input type="hidden" name="idBusiness" value="<?php echo $idBusiness ?>">
                                      <input type="hidden" name="dataX" id="dataX" value="422">
                                      <input type="hidden" name="dataY" id="dataY" value="290">
                                      <input type="hidden" name="dataHeight" id="dataHeight" value="422">
                                      <input type="hidden" name="dataWidth" id="dataWidth" value="290">
                                      <label class="btn btn-primary btn-upload" for="inputImage2" title="Upload image file">
                                          <input type="file" class="sr-only" id="inputImage2" name="imgBuilding" accept="image/*">
                                          <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs">
                                        Import
                                        <span class="fa fa-upload"></span>
                                      </span>
                                      </label>
                                      <div id="submitBtn2" class="btn btn-success">
                                      <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs">
                                            Submit
                                            <span class="fa fa-save"></span>
                                      </span>
                                      </div>
                                  </div>
                              </div>
                              <div class="modal-footer">
                              </div>
                          </div>
                      </div>
                      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                      <script>
                          // import 'cropperjs/dist/cropper.css'
                          $(document).ready(function () {
                              $('#cropperModal2').on('shown.bs.modal', function () {
                                  var Cropper = window.Cropper;
                                  var URL = window.URL || window.webkitURL;
                                  // var container = document.querySelector('.img-container');
                                  var image = document.getElementById('image2');
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
                                  var uploadedImageURL = './assets/images/kamar/';
                                  // Import image
                                  var inputImage = document.getElementById('inputImage2');
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
                                      var fileInput= document.getElementById('inputImage2');
                                      fData.append('file', fileInput.files[0]);
                                      fData.append('dataX', croppedData.dataX);
                                      fData.append('dataY', croppedData.dataY);
                                      fData.append('dataWidth', croppedData.dataWidth);
                                      fData.append('dataHeight', croppedData.dataHeight);
                                      fData.append('uploadedImagePath', croppedData.uploadedImagePath);
                                      fData.append('uniqueIdentifier', croppedData.uniqueIdentifier);
                                      fData.append('type', 'kamar');
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
                                              var result_image = document.getElementById('result-image2');
                                              var inputPhotoPath = document.getElementById('photoPath2');
                                              // Set the src attribute of the image element using the extracted URL
                                              result_image.src = '/assets/images/kamar/' + imageUrl;
                                              inputPhotoPath.value = imageUrl;
                                              $('#cropperModal2').modal('toggle');
                                          },
                                          error: function (error) {
                                              console.error("error", error);
                                          }
                                      });
                                  }
                                  // Example: Trigger the form submission when a button is clicked
                                  document.getElementById('submitBtn2').addEventListener('click', function() {
                                      submitCroppedImage();
                                  });
                                  // window.onload(); // This line ensures your existing code runs
                              });
                          });
                      </script>
                  </div>
              </div>
              <input type="hidden" name="photoPath3" id="photoPath3"/>
              <div class="item form-group" style="display: flex">
                  <label class="col-form-label col-md-3 col-sm-3 label-align">Gambar Kamar 3 <span class="required">*</span>
                  </label>
                  <div class="image-container">
                      <img id="result-image3" width="100%" src="https://cms.onixlabs.tech/assets/images/placeholder.png" alt="img" style="width: 250px">
                      <a target="_blank" href="https://cms.onixlabs.tech/assets/images/placeholder.png">
                          <div class="overlay">
                              <span>View Fullscreen</span>
                          </div>
                      </a>
                  </div>
                  <div class="btn btn-primary" style="height: 35px" data-toggle="modal" data-target="#cropperModal3">Upload image</div>
                  <div class="modal fade" id="cropperModal3" tabindex="-1" role="dialog" aria-labelledby="cropperModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="cropperModalLabel">Image cropper Photo</h5>
                                  <div type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </div>
                              </div>
                              <div class="modal-body">
                                  <img id="image3" src="" alt="Picture" class="cropper-hidden">
                                  <div style="padding-top: 10px;">
                                      <input type="hidden" name="idBusiness" value="<?php echo $idBusiness ?>">
                                      <input type="hidden" name="dataX" id="dataX" value="422">
                                      <input type="hidden" name="dataY" id="dataY" value="290">
                                      <input type="hidden" name="dataHeight" id="dataHeight" value="422">
                                      <input type="hidden" name="dataWidth" id="dataWidth" value="290">
                                      <label class="btn btn-primary btn-upload" for="inputImage3" title="Upload image file">
                                          <input type="file" class="sr-only" id="inputImage3" name="imgBuilding" accept="image/*">
                                          <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs">
                                        Import
                                        <span class="fa fa-upload"></span>
                                      </span>
                                      </label>
                                      <div id="submitBtn3" class="btn btn-success">
                                      <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs">
                                            Submit
                                            <span class="fa fa-save"></span>
                                      </span>
                                      </div>
                                  </div>
                              </div>
                              <div class="modal-footer">
                              </div>
                          </div>
                      </div>
                      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                      <script>
                          // import 'cropperjs/dist/cropper.css'
                          $(document).ready(function () {
                              $('#cropperModal3').on('shown.bs.modal', function () {
                                  var Cropper = window.Cropper;
                                  var URL = window.URL || window.webkitURL;
                                  // var container = document.querySelector('.img-container');
                                  var image = document.getElementById('image3');
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
                                  var uploadedImageURL = './assets/images/kamar/';
                                  // Import image
                                  var inputImage = document.getElementById('inputImage3');
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
                                      var fileInput= document.getElementById('inputImage3');
                                      fData.append('file', fileInput.files[0]);
                                      fData.append('dataX', croppedData.dataX);
                                      fData.append('dataY', croppedData.dataY);
                                      fData.append('dataWidth', croppedData.dataWidth);
                                      fData.append('dataHeight', croppedData.dataHeight);
                                      fData.append('uploadedImagePath', croppedData.uploadedImagePath);
                                      fData.append('uniqueIdentifier', croppedData.uniqueIdentifier);
                                      fData.append('type', 'kamar');
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
                                              var result_image = document.getElementById('result-image3');
                                              var inputPhotoPath = document.getElementById('photoPath3');
                                              // Set the src attribute of the image element using the extracted URL
                                              result_image.src = '/assets/images/kamar/' + imageUrl;
                                              inputPhotoPath.value = imageUrl;
                                              $('#cropperModal3').modal('toggle');
                                          },
                                          error: function (error) {
                                              console.error("error", error);
                                          }
                                      });
                                  }
                                  // Example: Trigger the form submission when a button is clicked
                                  document.getElementById('submitBtn3').addEventListener('click', function() {
                                      submitCroppedImage();
                                  });
                                  // window.onload(); // This line ensures your existing code runs
                              });
                          });
                      </script>
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
            <!-- disini untuk input  -->
          </div>
        </div>
      </div>
      <?php
       }
      ?>
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Data Kamar <?php echo $this->session->userdata('business') ?>
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
            <br>
            <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateAllotmentByDate/'.$idBusiness.'/') ?>" id="demo-form2" class="form-horizontal form-label-left">
                <input type="hidden" name="idBusiness" value="<?php echo $idBusiness ?>">
                
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="type_kamar">Type Kamar <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <select id="type_kamar" name="ketKamar" class="form-control" required>
                            <option value="">Choose..</option>
                            <?php 
                                $displayed_name = array();
                                $kamar = array();
                                $this->db->from('kamar_all');
                                $this->db->where('idBusiness', $idBusiness);
                                $query = $this->db->get();
                                if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        if (!in_array($row->ketKamar, $displayed_name)) {
                                            $displayed_name[] = $row->ketKamar;
                                            $kamar[] = $row;
                                        }
                                    }
                                }
                                $query->free_result(); 
                            ?>
                            <?php foreach($kamar as $row) { ?>
                                <option value="<?php echo $row->ketKamar ?>"><?php echo $row->ketKamar ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="beginDateKamar">Begin Date <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="date" id="beginDateKamar" required="required" name="beginDateKamar" class="form-control">
                    </div>
                </div>
                
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="endDateKamar">End Date <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="date" id="endDateKamar" required="required" name="endDateKamar" class="form-control">
                    </div>
                </div>
                
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="qtyKamar">Available Room <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="number" id="qtyKamar" required="required" name="qtyKamar" class="form-control" min="0">
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

            <br />
            <table id="datatable-buttons" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Type Kamar</th>
                  <th>Keterangan</th>
                  <th>Owner</th>
                  <th>Harga Kamar</th>
                  <th>Available Kamar</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $displayed_name = array();
                  foreach($kamar as $row) {
                    if (!in_array($row->ketKamar, $displayed_name)) {
                    // Add the invoice to the list of displayed invoices
                    $displayed_name[] = $row->ketKamar;
                ?>
                <tr>
                  <td><?php echo $row->ketKamar ?></td>
                  <td><?php echo $row->ketKamar ?></td>
                  <td><?php echo $row->idBusiness ?></td>
                  <td><?php echo number_format($row->hargaROKamar) ?></td>
                  <td>
                    <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/editFormKamar/'.$idBusiness.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                      <input type="hidden" name="idBusiness" value="<?php echo $row->idBusiness ?>">
                      <input type="hidden" name="ketKamar" value="<?php echo $row->ketKamar ?>">
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kuantiti Kamar <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="number" id="first-name" required="required" name="qtyKamar" class="form-control" value="<?php echo $row->qtyKamar ?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kapasitas Kamar <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="number" id="first-name" required="required" name="capKamar" class="form-control" value="<?php echo $row->capKamar ?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                    </form>
                  </td>
                  <td>
                    <a class="btn btn-primary" href="<?php echo base_url('cms/home/viewdetailKamar/'.$row->idBusiness.'/'.$row->idKamar.'/'); ?>">Detail</a>
                  </td>
                </tr>
                <?php } } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>