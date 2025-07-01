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
<div id="loader-text" style="content: '';position: fixed;top: 0;left: 0;width: 100%;height: 100%;background: #121212b3;z-index: 1051;display: none;">
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
            <h2>Setting Site Sliders
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
            <form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertSiteSettingSlider') ?>" id="siteSettingSlider" class="form-horizontal form-label-left">
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
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="imgSwiper">Image <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 ">
                        <img id="result-image1" width="100%" src="https://cms.onixlabs.tech/assets/images/placeholder.png" alt="img" style="width: 250px">
                        <div class="btn btn-primary" data-toggle="modal" data-target="#cropperModal1">Upload image</div>
                    </div>
                    <input type="hidden" name="photoPath1" id="photoPath1"/>
                </div>

                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="titleSwiper">Title <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="titleSwiper" name="titleSwiper" class="form-control" required>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="subtitleSwiper">Subtitle <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="subtitleSwiper" name="subtitleSwiper" class="form-control" required>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusSwiper">Status <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <select id="statusSwiper" name="statusSwiper" class="form-control" required>
                            <option value="" disabled selected>-- Pilih status --</option>
                            <option value="1">Active</option>
                            <option value="0">Non Active</option>
                        </select>
                    </div>
                </div>

                <div class="ln_solid"></div>
                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
                      <input type="hidden" name="dataX" id="dataX" value="839">
                      <input type="hidden" name="dataY" id="dataY" value="1920">
                      <input type="hidden" name="dataHeight" id="dataHeight" value="839">
                      <input type="hidden" name="dataWidth" id="dataWidth" value="1920">
                      <label class="btn btn-primary btn-upload" for="inputImage1" title="Upload image file">
                        <input type="file" class="sr-only" id="inputImage1" name="imgSwiper" accept="image/*">
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
              <script>
                // import 'cropperjs/dist/cropper.css'
                $(document).ready(function() {
                  $('#cropperModal1').on('shown.bs.modal', function() {
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
                    var uploadedImageURL = './assets/images/swiper/';
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
                      var loaderText = document.getElementById('loader-text');
                      loaderText.style.display = 'block';
                      fData.append('file', fileInput.files[0]);
                      fData.append('dataX', croppedData.dataX);
                      fData.append('dataY', croppedData.dataY);
                      fData.append('dataWidth', croppedData.dataWidth);
                      fData.append('dataHeight', croppedData.dataHeight);
                      fData.append('uploadedImagePath', croppedData.uploadedImagePath);
                      fData.append('uniqueIdentifier', croppedData.uniqueIdentifier);
                      fData.append('type', 'swiper');
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
                            loaderText.style.display = 'none';
                          }
                          loaderText.style.display = 'none';
                          // Access the image URL from the response array
                          var imageUrl = result.data.image; // Assuming the full path is the desired URL
                          // Get the image element
                          var result_image = document.getElementById('result-image1');
                          var inputPhotoPath = document.getElementById('photoPath1');
                          // // Set the src attribute of the image element using the extracted URL
                          result_image.src = '/assets/images/swiper/' + imageUrl;
                          inputPhotoPath.value = imageUrl;
                          console.log("imageUrl", imageUrl);
                          $('#cropperModal1').modal('toggle');
                        },
                        error: function(error) {
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
        </div>
      </div>
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>View Site Slider
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
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Locale</th>
                  <th>Image</th>
                  <th>Title Slider</th>
                  <th>Subtitle Slider</th>
                  <th>Status Slider</th>
                  <th>Expired Slider</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach($swiper as $index => $row) {
                ?>
                <tr id="row-<?php echo $index; ?>">
                  <td><?php echo $row->locale; ?></td>
                  <td width="20%"><img src="https://cms.sahirahotelsgroup.com/assets/images/swiper/<?php echo $row->imgSwiper; ?>"></td>
                  <td><?php echo $row->titleSwiper; ?></td>
                  <td><?php echo $row->subtitleSwiper; ?></td>
                  <td><?php echo $row->statusSwiper ? 'Active' : 'Tidak Aktif'; ?></td>
                  <td><?php echo $row->expiredSwiper ?></td>
                  <td><button type="button" class="btn btn-primary editBtn" data-toggle="modal" data-target="#swiperModal<?php echo $row->idSwiper; ?>" data-index="<?php echo $index; ?>" id-swiper="<?php echo $row->idSwiper; ?>">Edit</button></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <?php
            foreach($swiper as $index => $row) {
          ?>
          <div class="modal fade" id="swiperModal<?php echo $row->idSwiper; ?>" tabindex="-2" role="dialog" aria-labelledby="swiperModalLabel" aria-hidden="true" style="z-index: 1049;">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="swiperModalLabel">Edit Slider <?php echo $row->idSwiper; ?></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateSiteSettingSlider') ?>" id="siteSettingSlider" class="form-horizontal form-label-left">
                      <input type="hidden" id="idSwiper" name="idSwiper" class="form-control" required value="<?php echo $row->idSwiper ?>">
                      <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="locale">Locale <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6">
                              <select name="locale" id="locale" class="form-control">
                                  <option value="<?php echo $row->locale ?>"><?php echo $row->locale ?></option>
                                  <option value="en">English</option>
                                  <option value="id">Indonesian</option>
                              </select>
                          </div>
                      </div>

                      <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="imgSwiper">Image <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 ">
                              <img id="result-imageEdit" width="100%" src="https://cms.onixlabs.tech/assets/images/placeholder.png" alt="img" style="width: 250px">
                              <div class="btn btn-primary" data-toggle="modal" data-target="#cropperModalEdit">Upload image</div>
                          </div>
                          <input type="hidden" name="photoPathEdit" id="photoPathEdit"/>
                      </div>

                      <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="titleSwiper">Title <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6">
                              <input type="text" id="titleSwiper" name="titleSwiper" class="form-control" required value="<?php echo $row->titleSwiper ?>">
                          </div>
                      </div>

                      <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="subtitleSwiper">Subtitle <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6">
                              <input type="text" id="subtitleSwiper" name="subtitleSwiper" class="form-control" required value="<?php echo $row->subtitleSwiper ?>">
                          </div>
                      </div>

                      <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusSwiper">Status <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6">
                              <select id="statusSwiper" name="statusSwiper" class="form-control" required>
                                  <option disabled selected value="<?php echo $row->statusSwiper ?>"><?php echo $row->statusSwiper ? 'Active' : 'Tidak Aktif' ?></option>
                                  <option value="1">Active</option>
                                  <option value="0">Non Active</option>
                              </select>
                          </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="item form-group">
                          <div class="col-md-6 col-sm-6 offset-md-3">
                              <button type="submit" class="btn btn-success">Submit</button>
                          </div>
                      </div>
                  </form>
                  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                  <div class="modal fade" id="cropperModalEdit" tabindex="-1" role="dialog" aria-labelledby="cropperModalEditLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="cropperModalEditLabel">Image cropper Photo 1</h5>
                          <div class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </div>
                        </div>
                        <div class="modal-body">
                          <img id="imageEdit" src="" alt="Picture" class="cropper-hidden">
                          <div style="padding-top: 10px;">
                            <input type="hidden" name="dataX" id="dataX" value="839">
                            <input type="hidden" name="dataY" id="dataY" value="1920">
                            <input type="hidden" name="dataHeight" id="dataHeight" value="839">
                            <input type="hidden" name="dataWidth" id="dataWidth" value="1920">
                            <label class="btn btn-primary btn-upload" for="inputImageEdit" title="Upload image file">
                              <input type="file" class="sr-only" id="inputImageEdit" name="imgSwiper" accept="image/*">
                              <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs"> Import <span class="fa fa-upload"></span>
                              </span>
                            </label>
                            <div id="submitBtnEdit" class="btn btn-success">
                              <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs"> Submit <span class="fa fa-save"></span>
                              </span>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer"></div>
                      </div>
                    </div>
                    <script>
                      // import 'cropperjs/dist/cropper.css'
                      $(document).ready(function() {
                        $('#cropperModalEdit').on('shown.bs.modal', function() {
                          var Cropper = window.Cropper;
                          var URL = window.URL || window.webkitURL;
                          // var container = document.querySelector('.img-container');
                          var image = document.getElementById('imageEdit');
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
                          var uploadedImageURL = './assets/images/swiper/';
                          // Import image
                          var inputImage = document.getElementById('inputImageEdit');
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
                            var fileInput = document.getElementById('inputImageEdit');
                            console.log(uniqueIdentifier)
                            var loaderText = document.getElementById('loader-text');
                            loaderText.style.display = 'block';
                            fData.append('file', fileInput.files[0]);
                            fData.append('dataX', croppedData.dataX);
                            fData.append('dataY', croppedData.dataY);
                            fData.append('dataWidth', croppedData.dataWidth);
                            fData.append('dataHeight', croppedData.dataHeight);
                            fData.append('uploadedImagePath', croppedData.uploadedImagePath);
                            fData.append('uniqueIdentifier', croppedData.uniqueIdentifier);
                            fData.append('type', 'swiper');
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
                                  loaderText.style.display = 'none';
                                }
                                loaderText.style.display = 'none';
                                // Access the image URL from the response array
                                var imageUrl = result.data.image; // Assuming the full path is the desired URL
                                // Get the image element
                                var result_image = document.getElementById('result-imageEdit');
                                var inputPhotoPath = document.getElementById('photoPathEdit');
                                // // Set the src attribute of the image element using the extracted URL
                                result_image.src = '/assets/images/swiper/' + imageUrl;
                                inputPhotoPath.value = imageUrl;
                                console.log("imageUrl", imageUrl);
                                $('#cropperModalEdit').modal('toggle');
                              },
                              error: function(error) {
                                console.error("error", error);
                              }
                            });
                          }
                          // Example: Trigger the form submission when a button is clicked
                          document.getElementById('submitBtnEdit').addEventListener('click', function() {
                            submitCroppedImage();
                          });
                          // window.onload(); // This line ensures your existing code runs
                        });
                      });
                    </script>
                  </div>
                </div>
                <div class="modal-footer">
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>