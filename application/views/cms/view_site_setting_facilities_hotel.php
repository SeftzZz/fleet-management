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
<div id="loader-text" style="content: '';position: fixed;top: 0;left: 0;width: 100%;height: 100%;background: #121212b3;z-index: 4;display: none;">
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
            <h2>Setting Fasilitas
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
            <form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertfacilities/'.$idBusiness.'/') ?>" id="demo-form2" class="form-horizontal form-label-left">
               <input type="hidden" name="idBusiness" value="<?php echo $idBusiness ?>">
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusFacilities">Status Fasilitas<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 ">
                        <select name="statusFacilities" id="statusFacilities" class="form-control">
                            <option value="" disabled selected>-- Pilih status --</option>
                            <option value="1">Active</option>
                            <option value="0">Non Active</option>
                        </select>
                    </div>
                </div>
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
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="imgFacilities">Image</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="file" id="imgFacilities" name="imgFacilities" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="img2Facilities">Image2</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="file" id="img2Facilities" name="img2Facilities" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="img3Facilities">Image3</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="file" id="img3Facilities" name="img3Facilities" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="nmFacilities">Nama Fasilitas <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="nmFacilities" name="nmFacilities" class="form-control" required>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="ketFacilities">Keterangan Fasilitas</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="ketFacilities" name="ketFacilities" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="openFacilities">Jam Buka</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="openFacilities" name="openFacilities" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="floorFacilities">Fasilitas Lokasi</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="floorFacilities" name="floorFacilities" class="form-control">
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                        <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
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
                  <th>Status Fasilitas</th>
                  <th>Locale</th>
                  <th>Image</th>
                  <th>Image2</th>
                  <th>Image3</th>
                  <th>Nama Fasilitas</th>
                  <th>Keterangan Fasilitas</th>
                  <th>Jam Buka</th>
                  <th>Fasilitas Lokasi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach($facilities as $index => $row) {
                ?>
                <tr id="row-<?php echo $index; ?>">
                  <td><?php echo $row->locale; ?></td>
                  <td width="20%"><img src="https://cms.sahirahotelsgroup.com/assets/images/kamar/<?php echo $row->imgFacilities; ?>"></td>
                  <td width="7%"><img src="https://cms.sahirahotelsgroup.com/assets/images/kamar/<?php echo $row->img2Facilities; ?>"></td>
                  <td width="7%"><img src="https://cms.sahirahotelsgroup.com/assets/images/kamar/<?php echo $row->img3Facilities; ?>"></td>
                  <td><?php echo $row->nmFacilities; ?></td>
                  <td><?php echo $row->statusFacilities ? 'Active' : 'Tidak Aktif'; ?></td>
                  <td><?php echo $row->ketFacilities; ?></td>
                  <td><?php echo $row->openFacilities; ?></td>
                  <td><?php echo $row->floorFacilities; ?></td>
                  <td><button type="button" class="btn btn-primary editBtn" data-toggle="modal" data-target="#facilitiesModal<?php echo $row->idFacilities; ?>" data-index="<?php echo $index; ?>" id-facilities="<?php echo $row->idFacilities; ?>">Edit</button></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <?php
            foreach($facilities as $index => $row) {
          ?>
          <div class="modal fade" id="facilitiesModal<?php echo $row->idFacilities; ?>" tabindex="-2" role="dialog" aria-labelledby="facilitiesModalLabel" aria-hidden="true" style="z-index: 1049;">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="facilitiesModalLabel">Edit Slider <?php echo $row->idFacilities; ?></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateSiteSettingFacilitiesHotel/'.$idBusiness.'/') ?>" id="siteSettingFacilities" class="form-horizontal form-label-left">
                      <input type="hidden" id="idFacilities" name="idFacilities" class="form-control" required value="<?php echo $row->idFacilities ?>">
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
                              <img id="result-imageEdit" width="100%" src="https://cms.sahirahotelsgroup.com/assets/images/placeholder.png" alt="img" style="width: 250px">
                              <div class="btn btn-primary" data-toggle="modal" data-target="#cropperModalEdit">Upload image</div>
                          </div>
                          <input type="hidden" name="photoPathEdit" id="photoPathEdit"/>
                      </div>

                       <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="imgSwiper">Image <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 ">
                              <img id="result-imageEdit2" width="100%" src="https://cms.sahirahotelsgroup.com/assets/images/placeholder.png" alt="img" style="width: 250px">
                              <div class="btn btn-primary" data-toggle="modal" data-target="#cropperModalEdit2">Upload image</div>
                          </div>
                          <input type="hidden" name="photoPathEdit2" id="photoPathEdit2"/>
                      </div>

                      <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="nmFacilities">Title <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6">
                              <input type="text" id="nmFacilities" name="nmFacilities" class="form-control" value="<?php echo $row->nmFacilities ?>">
                          </div>
                      </div>

                      <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="ketFacilities">Subtitle <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6">
                              <input type="text" id="ketFacilities" name="ketFacilities" class="form-control" value="<?php echo $row->ketFacilities ?>">
                          </div>
                      </div>

                      <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusFacilities">Status <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6">
                              <select id="statusFacilities" name="statusFacilities" class="form-control" required>
                                  <option disabled selected value="<?php echo $row->statusFacilities ?>"><?php echo $row->statusFacilities ? 'Active' : 'Tidak Aktif' ?></option>
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
                  <div class="modal fade" id="cropperModalEdit2" tabindex="-1" role="dialog" aria-labelledby="cropperModalEdit2Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="cropperModalEdit2Label">Image cropper Photo 1</h5>
                          <div class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </div>
                        </div>
                        <div class="modal-body">
                          <img id="imageEdit2" src="" alt="Picture" class="cropper-hidden">
                          <div style="padding-top: 10px;">
                            <input type="hidden" name="dataX" id="dataX" value="839">
                            <input type="hidden" name="dataY" id="dataY" value="1920">
                            <input type="hidden" name="dataHeight" id="dataHeight" value="839">
                            <input type="hidden" name="dataWidth" id="dataWidth" value="1920">
                            <label class="btn btn-primary btn-upload" for="inputImageEdit2" title="Upload image file">
                              <input type="file" class="sr-only" id="inputImageEdit2" name="imgsmSwiper" accept="image/*">
                              <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs"> Import <span class="fa fa-upload"></span>
                              </span>
                            </label>
                            <div id="submitBtnEdit2" class="btn btn-success">
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
                        $('#cropperModalEdit2').on('shown.bs.modal', function() {
                          var Cropper = window.Cropper;
                          var URL = window.URL || window.webkitURL;
                          // var container = document.querySelector('.img-container');
                          var image = document.getElementById('imageEdit2');
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
                          var inputImage = document.getElementById('inputImageEdit2');
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
                            var fileInput = document.getElementById('inputImageEdit2');
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
                                var result_image = document.getElementById('result-imageEdit2');
                                var inputPhotoPath = document.getElementById('photoPathEdit2');
                                // // Set the src attribute of the image element using the extracted URL
                                result_image.src = '/assets/images/swiper/' + imageUrl;
                                inputPhotoPath.value = imageUrl;
                                console.log("imageUrl", imageUrl);
                                $('#cropperModalEdit2').modal('toggle');
                              },
                              error: function(error) {
                                console.error("error", error);
                              }
                            });
                          }
                          // Example: Trigger the form submission when a button is clicked
                          document.getElementById('submitBtnEdit2').addEventListener('click', function() {
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