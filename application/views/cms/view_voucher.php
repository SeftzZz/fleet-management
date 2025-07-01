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
            <h2>Input Voucher <?php echo $this->session->userdata('business') ?>
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
            <!-- <form name="Diskon" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insert_voucher') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left"> -->
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="idBusiness">Business Voucher <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select type="text" name="idBusiness" id="idBusiness" class="form-control">
                    <option value="">Global</option>
                    <?php 
                      $Business_Detail = array();
                      $this->db->from('Business_Detail');
                      $this->db->where('typeBusiness !=', 'OFFICE');
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
                    <option value="<?php echo $row->idBusiness ?>"><?php echo $row->Name ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="expiredVoucher">End of voucher *</label>
                <div class="col-md-6 col-sm-6">
                  <input type="date" id="expiredVoucher" min="<?php echo date('Y-m-d') ?>" name="expiredVoucher" class="form-control" value="<?php echo set_value('dateKamar'); ?>" required style="background: #ffff4c82;">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nmVoucher">Voucher Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="nmVoucher" required="required" name="nmVoucher" class="form-control">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Harga Kamar RO <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 form-group has-feedback">
                  <input type="text" name="diskonVoucher" id="diskonVoucher" required="required" class="form-control" value="">
                  <span class="form-control-feedback right" aria-hidden="true">IDR</span>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Photo <span class="required">* (1668 x 946)</span>
                </label>
                <div id="fileInputsContainer">
                  <div class="col-md-6 col-sm-6 form-group has-feedback">
                    <img id="imgVoucher" src="" alt="Picture" class="cropper-hidden">
                    <div style="padding-top: 10px;">
                      <input type="hidden" name="dataX" id="dataX" value="1668">
                      <input type="hidden" name="dataY" id="dataY" value="946">
                      <input type="hidden" name="dataHeight" id="dataHeight" value="1668">
                      <input type="hidden" name="dataWidth" id="dataWidth" value="946">
                      <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                        <input type="file" class="sr-only" id="inputImage" name="imgVoucher" accept="image/*">
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
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="ketVoucher">Description <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <textarea id="cktextarea" required="required" class="form-control" name="ketVoucher" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></textarea>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusVoucher">Can Open / Clicked <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select type="text" id="statusVoucher" name="statusVoucher" class="form-control">
                    <option disabled value="">--Choose options--</option>
                    <option value="true">Can Open / Clicked</option>
                    <option value="false">False</option>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>
                </div>
              </div>
              <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
              <?php
                foreach($user as $row) {
              ?>
              <script type="text/javascript">
                // import 'cropperjs/dist/cropper.css';
                $(document).ready(function () {
                  var Cropper = window.Cropper;
                  var URL = window.URL || window.webkitURL;
                  console.log(URL + " lalala ")
                  if (URL) {
                    console.log("truee ")
                  }
                  // var container = document.querySelector('.img-container');
                  var image = document.getElementById('imgVoucher');
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
                    var idBusiness = document.getElementById('idBusiness');
                    var expiredVoucher = document.getElementById('expiredVoucher');
                    var nmVoucher = document.getElementById('nmVoucher');
                    var diskonVoucher = document.getElementById('diskonVoucher');
                    var ContentFromEditor = CKEDITOR.instances.cktextarea.getData();
                    var ketVoucher = document.getElementById('ketVoucher');
                    var statusVoucher = document.getElementById('statusVoucher');
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
                    fData.append('idBusiness', idBusiness.value);
                    fData.append('expiredVoucher', expiredVoucher.value);
                    fData.append('nmVoucher', nmVoucher.value);
                    fData.append('diskonVoucher', diskonVoucher.value);
                    fData.append('ketVoucher', ContentFromEditor);
                    fData.append('statusVoucher', statusVoucher.value);

                    $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url('cms/home/insert_voucher') ?>',
                      data: fData,
                      processData: false,  // Prevent jQuery from automatically processing the data
                      contentType: false,  // Prevent jQuery from automatically setting the content type
                      success: function (response) {
                        // Handle the response from the server (if needed)
                        console.log("response", response);
                        $.ajax({
                          url: '<?php echo base_url('cms/api/postNotificationOffers') ?>', // Replace with the actual URL
                          method: 'POST',
                          contentType: 'application/x-www-form-urlencoded',
                          data: {
                            nmVoucher: nmVoucher.value,
                            currentToken: '<?php echo $row->tokenPushNotification ?>',
                            ketVoucher: ContentFromEditor,
                            imgVoucher: fileInput.files[0].name,
                          },
                          success: function(response) {
                            console.log(response);
                            window.location.href = window.location.href;
                          },
                          error: function(error) {
                            console.error('Error:', error);
                          }
                        });
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
              <?php } ?>
            <!-- </form> -->
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
                foreach($voucher as $row) {
              ?>
              <tr>
                <td><?php echo $row->nmVoucher ?></td>
                <td><?php echo $row->ketVoucher ?></td>
                <td><?php echo $row->createdAtVoucher ?></td>
              </tr>
              <?php }?>
            </tbody>
          </table>
        </div>                
      </div>
    </div>
  </div>
</div>