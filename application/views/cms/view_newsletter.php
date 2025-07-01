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
            <h2>Input Email Newsletter <?php echo $this->session->userdata('business') ?>
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
            <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertFormNewsletter/'.$this->session->userdata('idBusiness').'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="titleNewsletter">News Letter Title <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9">
                  <input type="text" id="titleNewsletter" required="required" name="titleNewsletter" class="form-control" placeholder="New promo from mideast">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="imgNewsletter">News Letter Image <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <div class="row">
                    <div class="col-md-6">
                      <img id="result-image1" width="100%" src="https://cms.onixlabs.tech/assets/images/placeholder.png" alt="img" style="width: 500px">
                    </div>
                    <div class="col-md-6">
                      <div class="btn btn-primary" data-toggle="modal" data-target="#cropperModal1">Upload image</div>
                      <div class="input-group">
                        <input class="form-control" id="copyUrlImage" readonly>
                        <span class="input-group-btn">
                          <div class="btn btn-warning" style="float: right;" onclick="copyUrl()">Copy url image</div>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="photoPath1" id="photoPath1"/>
              </div>
              <div class="modal fade" id="cropperModal1" tabindex="-1" role="dialog" aria-labelledby="cropperModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="cropperModalLabel">Image cropper Photo 1</h5>
                      <div class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </div>
                    </div>
                    <div class="modal-body">
                      <img id="image1" src="" alt="Picture" class="cropper-hidden">
                      <div style="padding-top: 10px;">
                        <input type="hidden" name="dataX" id="dataX" value="290">
                        <input type="hidden" name="dataY" id="dataY" value="290">
                        <input type="hidden" name="dataHeight" id="dataHeight" value="290">
                        <input type="hidden" name="dataWidth" id="dataWidth" value="290">
                        <label class="btn btn-primary btn-upload" for="inputImage1" title="Upload image file">
                          <input type="file" class="sr-only" id="inputImage1" name="imgNewsletter" accept="image/*">
                          <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs"> Import <span class="fa fa-upload"></span>
                          </span>
                        </label>
                        <div id="submitBtn1" class="btn btn-success">
                          <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs"> Submit <span class="fa fa-save"></span>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer"></div>
                  </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                <script>
                  // import 'cropperjs/dist/cropper.css'
                  var copyUrlImage = document.getElementById('copyUrlImage');
                  copyUrlImage.style.display = 'block';

                  $(document).ready(function() {
                    $('#cropperModal1').on('shown.bs.modal', function() {
                      var Cropper = window.Cropper;
                      var URL = window.URL || window.webkitURL;
                      // var container = document.querySelector('.img-container');
                      var image = document.getElementById('image1');
                      var options = {
                        // aspectRatio: 1/1,
                        cropBoxResizable: true,
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
                        var fileInput = document.getElementById('inputImage1');
                        console.log(uniqueIdentifier)
                        fData.append('file', fileInput.files[0]);
                        fData.append('dataX', croppedData.dataX);
                        fData.append('dataY', croppedData.dataY);
                        fData.append('dataWidth', croppedData.dataWidth);
                        fData.append('dataHeight', croppedData.dataHeight);
                        fData.append('uploadedImagePath', croppedData.uploadedImagePath);
                        fData.append('uniqueIdentifier', croppedData.uniqueIdentifier);
                        fData.append('type', 'newsletter');
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
                            if(result.response == 'error') {
                              alert(result.desc);
                              var loaderText = document.getElementById('loader-text');
                              loaderText.style.display = 'none';
                            }
                            // Access the image URL from the response array
                            var imageUrl = result.data.image; // Assuming the full path is the desired URL
                            // Get the image element
                            var result_image = document.getElementById('result-image1');
                            var inputPhotoPath = document.getElementById('photoPath1');
                            // // Set the src attribute of the image element using the extracted URL
                            result_image.src = '/assets/images/newsletter/' + imageUrl;
                            inputPhotoPath.value = imageUrl;
                            console.log("imageUrl", imageUrl);
                            var copyUrlImage = document.getElementById('copyUrlImage');
                            copyUrlImage.style.display = 'block';
                            copyUrlImage.value = result_image.src;
                            $('#cropperModal1').modal('toggle');
                          },
                          error: function(error) {
                            console.error("error", error);
                          }
                        });

                        // $.ajax({
                        //   url: '<?php echo base_url('cms/api/postNotificationNewsletter') ?>', // Replace with the actual URL
                        //   method: 'POST',
                        //   contentType: 'application/x-www-form-urlencoded',
                        //   data: {
                        //     titleNewsletter: titleNewsletter.value,
                        //     currentToken: 'DEV',
                        //     bodyNewsletter: bodyNewsletter.value,
                        //     imgNewsletter: fileInput.files[0].name,
                        //   },
                        //   success: function(response) {
                        //     alert(response);
                        //     window.location.href = window.location.href;
                        //   },
                        //   error: function(error) {
                        //     console.error('Error:', error);
                        //   }
                        // });
                      }
                      // Example: Trigger the form submission when a button is clicked
                      document.getElementById('submitBtn1').addEventListener('click', function() {
                        submitCroppedImage();
                      });
                      // window.onload(); // This line ensures your existing code runs
                    });
                  });
                  
                  function copyUrl() {
                    // Create a temporary copyUrlImage element
                    const copyUrlImage = document.getElementById('copyUrlImage');
                    var urlImage = copyUrlImage.value;

                    // Use the Clipboard API to write urlImage to the clipboard
                    navigator.clipboard.writeText(urlImage)
                      .then(() => {
                        console.log('Text copied to clipboard:', urlImage);
                        alert('Text copied to clipboard: ' + urlImage);
                      })
                      .catch(err => {
                        console.error('Failed to copy text: ', err);
                        alert('Failed to copy text: ' + err);
                      });
                  }
                </script>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="bodyNewsletter">News Letter Body<span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9">
                  <textarea class="form-control" id="cktextarea" rows="10" name="bodyNewsletter"></textarea>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <button id="submit_notification_newsletter" class="btn btn-success">Submit</button>
                </div>
              </div>
            </form>
          </div>
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Title</th>
                <th>Descriptions</th>
                <th>Created At</th>
              </tr>
            </thead>
            <tbody>
              
              <?php
                foreach($newsletter as $row) {
              ?>
              <tr>
                <td><?php echo $row->titleNewsletter ?></td>
                <td><?php echo $row->bodyNewsletter ?></td>
                <td><?php echo $row->createdAtNewsletter ?></td>
              </tr>
              <?php }?>
            </tbody>
          </table>
        </div>                
      </div>
    </div>
  </div>
</div>