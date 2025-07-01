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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- page content -->
<div id="loader-text" style="content: '';position: fixed;top: 0;left: 0;width: 100%;height: 100%;background: #121212b3;z-index: 4;display: none;">
  <h1 style="color: white;top: 0;left: 0;right: 0px;bottom: 0px;position: relative;text-align: center;">Uploading....</h1>
</div>
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Input Voucher Catalog <?php echo $this->session->userdata('business') ?>
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
            <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateFormVoucherCatalog/'.$voucher->idVouchercatalog.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="idBusiness">Business Voucher Catalog <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select type="text" name="idBusiness" id="idBusiness" class="form-control">
                    <?php 
                      $get_Business_Detail = array();
                      $this->db->from('voucher_catalog');
                      $this->db->join('Business_Detail', 'Business_Detail.idBusiness=voucher_catalog.idBusiness');
                      $this->db->where('voucher_catalog.idBusiness', $voucher->idBusiness);
                      $query = $this->db->get();
                      if ($query->num_rows() > 0) {
                        $get_Business_Detail = $query->row();
                      }
                      $query->free_result();
                    ?>
                    <option value="<?php echo $get_Business_Detail->idBusiness ?>"><?php echo $get_Business_Detail->Name ?></option>
                    <?php 
                      $Business_Detail = array();
                      $this->db->from('Business_Detail');
                      $query = $this->db->get();
                      if ($query->num_rows() > 0)
                      {
                        foreach ($query->result() as $row)
                        {
                          $Business_Detail[] = $row;
                        }
                      }
                      $query->free_result(); 
                    ?>
                    <?php 
                      foreach($Business_Detail as $row) {
                    ?>
                    <option value="<?php echo $row->idBusiness ?>" id="BusinessID"><?php echo $row->Name ?></option>
                    <?php } ?>
                  </select>
                  <script type="text/javascript">
                    // Select the dropdown element
                    var idBusiness = document.getElementById('idBusiness');
                    // Attach onchange event listener
                    idBusiness.addEventListener('change', function() {
                      // Get the selected value
                      var selectedValue = idBusiness.value;
                      
                      // Check if a value is selected
                      if (selectedValue) {
                        var fData = new FormData();
                        fData.append('BusinessID', selectedValue);

                        // Make AJAX request
                        $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url('cms/home/ajaxcheckBusiness'); ?> ',
                          data: fData,
                          processData: false,
                          contentType: false,
                          success: function(response) {
                            console.log(response);
                            var resp = JSON.parse(response);
                            var imageName = resp.image.split('.')[0]; // Extracting the filename without extension
                            var result_image1 = document.getElementById('result-image1');
                            result_image1.src = '/assets/images/hotels/' + resp.image;
                            var result_image2 = document.getElementById('result-image2');
                            result_image2.src = '/assets/images/hotels/' + resp.image;
                            var result_image3 = document.getElementById('result-image3');
                            result_image3.src = '/assets/images/hotels/' + resp.image;
                            var uploadedImageURL = './assets/images/voucher/';
                            var blobUri = uploadedImageURL;
                            var uniqueIdentifier = blobUri.split('/').pop();
                            var uploadedImageFormat = resp.image.split('.').pop().toLowerCase();
                            var croppedData = {
                              dataX: 290,
                              dataY: 290,
                              dataHeight: 290,
                              dataWidth: 290,
                              uploadedImagePath: uploadedImageFormat // Pass the uploaded image format
                            };
                            fData.append('file', resp.image);
                            fData.append('dataX', croppedData.dataX);
                            fData.append('dataY', croppedData.dataY);
                            fData.append('dataWidth', croppedData.dataWidth);
                            fData.append('dataHeight', croppedData.dataHeight);
                            fData.append('uploadedImagePath', croppedData.uploadedImagePath);
                            fData.append('uniqueIdentifier', croppedData.uniqueIdentifier);
                            fData.append('type', 'voucher');
                            $.ajax({
                              type: 'POST',
                              url: '<?php echo base_url('cms/home/copy_file'); ?> ',
                              data: fData,
                              processData: false,
                              contentType: false,
                              success: function(response) {
                                var result = JSON.parse(response);
                                console.log("response", result);
                                var inputPhotoPath1 = document.getElementById('photoPath1');
                                inputPhotoPath1.value = resp.image;
                                var inputPhotoPath2 = document.getElementById('photoPath2');
                                inputPhotoPath2.value = resp.image;
                                var inputPhotoPath3 = document.getElementById('photoPath3');
                                inputPhotoPath3.value = resp.image;
                              },
                              error: function(error) {
                                console.error("error", error);
                              }
                            });

                            // Handle success response here
                          },
                          error: function(error) {
                            console.error("error", error);
                            // Handle error here
                          }
                        });
                      }
                    });
                  </script>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nmVouchercatalog">Voucher Catalog Title <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="nmVouchercatalog" required="required" name="nmVouchercatalog" value="<?php echo $voucher->nmVouchercatalog ?>" class="form-control" placeholder="New promo from mideast">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="qtyVouchercatalog">Voucher Catalog QTY <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="number" id="qtyVouchercatalog" required="required" name="qtyVouchercatalog" value="<?php echo $voucher->qtyVouchercatalog ?>" class="form-control" placeholder="0">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="priceVouchercatalog">Voucher Catalog Price <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="priceVouchercatalog" required="required" name="priceVouchercatalog" value="<?php echo $voucher->priceVouchercatalog ?>" class="form-control" placeholder="0">
                </div>
              </div>
              <script>
                var inputElement = document.getElementById("priceVouchercatalog");

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
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="payableVouchercatalog">Voucher Catalog Payable <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select id="payableVouchercatalog" name="payableVouchercatalog" class="form-control" required>
                    <option value="<?php echo $voucher->payableVouchercatalog ?>"><?php echo $voucher->payableVouchercatalog ?></option>
                    <option value="Free">Free</option>
                    <option value="Payable">Payable</option>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="categoryVouchercatalog">Voucher Catalog Category <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select id="categoryVouchercatalog" name="categoryVouchercatalog" class="form-control" required>
                    <option value="<?php echo $voucher->categoryVouchercatalog ?>"><?php echo $voucher->categoryVouchercatalog ?></option>
                    <option value="Room">Room</option>
                    <option value="FNB">FNB</option>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusVouchercatalog">Voucher Catalog Status <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select id="statusVouchercatalog" name="statusVouchercatalog" class="form-control" required>
                    <option value="<?php echo $voucher->statusVouchercatalog ?>"><?php echo $voucher->statusVouchercatalog ?></option>
                    <option value="Active">Active</option>
                    <option value="Non Active">Non Active</option>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="expiredVouchercatalog">Voucher Catalog Expired <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="date" id="expiredVouchercatalog" required="required" name="expiredVouchercatalog" value="<?php echo $voucher->expiredVouchercatalog ?>" class="form-control" placeholder="New promo from mideast">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="ketVouchercatalog">Voucher Catalog Description <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <textarea required="required" class="form-control" id="cktextarea" name="ketVouchercatalog" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"><?php echo $voucher->ketVouchercatalog ?></textarea>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="inslideVouchercatalog">Voucher Catalog Promotion Status <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select id="inslideVouchercatalog" name="inslideVouchercatalog" class="form-control" required>
                    <option value="<?php echo $voucher->inslideVouchercatalog ?>"><?php echo $voucher->inslideVouchercatalog ?></option>
                    <option value="Active">Active</option>
                    <option value="Non Active">Non Active</option>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="shortketVouchercatalog">Voucher Catalog Promotion Description <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="shortketVouchercatalog" required="required" name="shortketVouchercatalog" value="<?php echo $voucher->shortketVouchercatalog ?>" class="form-control" placeholder="New promo from mideast">
                </div>
              </div>
              <!-- <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="imgVouchercatalog">Voucher Catalog Image 1 <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <img id="result-image1" width="100%" src="<?php echo '/assets/images/voucher/' . $voucher->imgVouchercatalog; ?>" alt="img" style="width: 250px">
                  <div class="btn btn-primary" data-toggle="modal" data-target="#cropperModal1">Upload image</div>
                </div>
                <input type="hidden" name="photoPath1" id="photoPath1"/>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="img2Vouchercatalog">Voucher Catalog Image 2 <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <img id="result-image2" width="100%" src="<?php echo '/assets/images/voucher/' . $voucher->img2Vouchercatalog; ?>" alt="img" style="width: 250px">
                  <div class="btn btn-primary" data-toggle="modal" data-target="#cropperModal2">Upload image</div>
                </div>
                <input type="hidden" name="photoPath2" id="photoPath2" />
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="img3Vouchercatalog">Voucher Catalog Image 3 <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <img id="result-image3" width="100%" src="<?php echo '/assets/images/voucher/' . $voucher->img3Vouchercatalog; ?>" alt="img" style="width: 250px">
                  <div class="btn btn-primary" data-toggle="modal" data-target="#cropperModal3">Upload image</div>
                </div>
                <input type="hidden" name="photoPath3" id="photoPath3" />
              </div> -->
              <div class="ln_solid"></div>
              <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
              </div>
            </form>
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
                        <input type="file" class="sr-only" id="inputImage1" name="imgBuilding" accept="image/*">
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
                    var uploadedImageURL = './assets/images/voucher/';
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
                      fData.append('type', 'voucher');
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
                          result_image.src = '/assets/images/voucher/' + imageUrl;
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
            <div class="modal fade" id="cropperModal2" tabindex="-1" role="dialog" aria-labelledby="cropperModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="cropperModalLabel">Image cropper Photo 2</h5>
                    <div type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </div>
                  </div>
                  <div class="modal-body">
                    <img id="image2" src="" alt="Picture" class="cropper-hidden">
                    <div style="padding-top: 10px;">
                      <input type="hidden" name="dataX" id="dataX" value="290">
                      <input type="hidden" name="dataY" id="dataY" value="290">
                      <input type="hidden" name="dataHeight" id="dataHeight" value="290">
                      <input type="hidden" name="dataWidth" id="dataWidth" value="290">
                      <label class="btn btn-primary btn-upload" for="inputImage2" title="Upload image file">
                        <input type="file" class="sr-only" id="inputImage2" name="imgBuilding" accept="image/*">
                        <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs"> Import <span class="fa fa-upload"></span>
                        </span>
                      </label>
                      <div id="submitBtn2" class="btn btn-success">
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
                $(document).ready(function() {
                  $('#cropperModal2').on('shown.bs.modal', function() {
                    var Cropper = window.Cropper;
                    var URL = window.URL || window.webkitURL;
                    // var container = document.querySelector('.img-container');
                    var image = document.getElementById('image2');
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
                    var uploadedImageURL = './assets/images/voucher/';
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
                      var fileInput = document.getElementById('inputImage2');
                      fData.append('file', fileInput.files[0]);
                      fData.append('dataX', croppedData.dataX);
                      fData.append('dataY', croppedData.dataY);
                      fData.append('dataWidth', croppedData.dataWidth);
                      fData.append('dataHeight', croppedData.dataHeight);
                      fData.append('uploadedImagePath', croppedData.uploadedImagePath);
                      fData.append('uniqueIdentifier', croppedData.uniqueIdentifier);
                      fData.append('type', 'voucher');
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
                          var result_image = document.getElementById('result-image2');
                          var inputPhotoPath = document.getElementById('photoPath2');
                          // Set the src attribute of the image element using the extracted URL
                          result_image.src = '/assets/images/voucher/' + imageUrl;
                          inputPhotoPath.value = imageUrl;
                          $('#cropperModal2').modal('toggle');
                        },
                        error: function(error) {
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
            <div class="modal fade" id="cropperModal3" tabindex="-1" role="dialog" aria-labelledby="cropperModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="cropperModalLabel">Image cropper Photo 3</h5>
                    <div type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </div>
                  </div>
                  <div class="modal-body">
                    <img id="image3" src="" alt="Picture" class="cropper-hidden">
                    <div style="padding-top: 10px;">
                      <input type="hidden" name="dataX" id="dataX" value="290">
                      <input type="hidden" name="dataY" id="dataY" value="290">
                      <input type="hidden" name="dataHeight" id="dataHeight" value="290">
                      <input type="hidden" name="dataWidth" id="dataWidth" value="290">
                      <label class="btn btn-primary btn-upload" for="inputImage3" title="Upload image file">
                        <input type="file" class="sr-only" id="inputImage3" name="imgBuilding" accept="image/*">
                        <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs"> Import <span class="fa fa-upload"></span>
                        </span>
                      </label>
                      <div id="submitBtn3" class="btn btn-success">
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
                $(document).ready(function() {
                  $('#cropperModal3').on('shown.bs.modal', function() {
                    var Cropper = window.Cropper;
                    var URL = window.URL || window.webkitURL;
                    // var container = document.querySelector('.img-container');
                    var image = document.getElementById('image3');
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
                    var uploadedImageURL = './assets/images/voucher/';
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
                      var fileInput = document.getElementById('inputImage3');
                      fData.append('file', fileInput.files[0]);
                      fData.append('dataX', croppedData.dataX);
                      fData.append('dataY', croppedData.dataY);
                      fData.append('dataWidth', croppedData.dataWidth);
                      fData.append('dataHeight', croppedData.dataHeight);
                      fData.append('uploadedImagePath', croppedData.uploadedImagePath);
                      fData.append('uniqueIdentifier', croppedData.uniqueIdentifier);
                      fData.append('type', 'voucher');
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
                          var result_image = document.getElementById('result-image3');
                          var inputPhotoPath = document.getElementById('photoPath3');
                          // Set the src attribute of the image element using the extracted URL
                          result_image.src = '/assets/images/voucher/' + imageUrl;
                          inputPhotoPath.value = imageUrl;
                          $('#cropperModal3').modal('toggle');
                        },
                        error: function(error) {
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
        </div>                
      </div>
    </div>
  </div>
</div>