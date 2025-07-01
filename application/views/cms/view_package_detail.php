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
            <h2>Input Package <?php echo $this->session->userdata('business') ?>
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
            <!-- <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateFormKamarPackage/'.$this->session->userdata('idBusiness').'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left"> -->
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusPackage">Status Package <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select type="text" name="statusPackage" id="statusPackage" class="form-control">
                    <option value="<?php echo $package->statusPackage ?>"><?php echo $package->statusPackage ?></option>
                    <option value="Active">Active</option>
                    <option value="Non Active">Non Active</option>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="idBusiness">Business Package <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select type="text" name="idBusiness" id="idBusiness" class="form-control">
                    <?php 
                      $get_Business_Detail = array();
                      $this->db->from('kamar_package');
                      $this->db->join('Business_Detail', 'Business_Detail.idBusiness=kamar_package.idBusiness');
                      $this->db->where('kamar_package.idBusiness', $package->idBusiness);
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
                      $this->db->where('typeBusiness', 'HOTEL');
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
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="dateKamar">Start event *</label>
                <div class="col-md-6 col-sm-6">
                  <input type="date" id="dateKamar" min="<?php echo date('Y-m-d') ?>" name="dateKamar" class="form-control" value="<?php echo $package->dateKamar; ?>" required style="background: #ffff4c82;">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nightPackage">Duration Package *</label>
                <div class="col-md-6 col-sm-6">
                  <input type="number" id="nightPackage" name="nightPackage" class="form-control" min="1" placeholder="1" value="<?php echo $package->nightPackage; ?>" required style="background: #ffff4c82;">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="dateafterKamar">End of event *</label>
                <div class="col-md-6 col-sm-6">
                  <input type="date" id="dateafterKamar" name="dateafterKamar" class="form-control" readonly required style="background: #ffff4c82;">
                </div>
              </div>
              <script>
                // Get the currentDate date in the format YYYY-MM-DD
                const currentDate = new Date('<?php echo $package->dateKamar ?>').toISOString().split('T')[0];

                // Set the value of the date input to the current date
                document.getElementById('dateKamar').value = currentDate;
                // document.getElementById('arrival').min = currentDate;

                function updateDeparture() {
                  const arrivalDate = document.getElementById('dateKamar').value;
                  const nightCount = parseInt(document.getElementById('nightPackage').value);

                  if (arrivalDate && nightCount && !isNaN(nightCount)) {
                    const arrival = new Date(arrivalDate);
                    const departure = new Date(arrival.getTime() + nightCount * 24 * 60 * 60 * 1000);
                    const departureString = departure.toISOString().split('T')[0];
                    document.getElementById('dateafterKamar').value = departureString;
                     // Display date interval sequence if more than one day
                    if (nightCount > 0) {
                      const intervalDates = [];
                      for (let i = 0; i < nightCount; i++) {
                        const currentDay = new Date(arrival.getTime() + i * 24 * 60 * 60 * 1000);
                        const currentDayString = currentDay.toISOString().split('T')[0];
                        intervalDates.push(currentDayString);
                      }
                      console.log('Interval Dates:', intervalDates); // Log the interval dates to the console
                      document.getElementById('intervalDate').value = intervalDates+','+departureString;
                    }
                  }
                }

                // Attach event listeners to the arrival and night inputs
                document.getElementById('dateKamar').addEventListener('input', updateDeparture);
                document.getElementById('nightPackage').addEventListener('input', updateDeparture);

                // Trigger initial update on page load
                window.onload = updateDeparture;
              </script>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="durationPackage">Day</label>
                <div class="col-md-6 col-sm-6">
                  <input type="number" id="durationPackage" name="durationPackage" class="form-control" value="<?php echo $package->durationPackage; ?>" required style="background: #ffff4c82;">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="durationnightPackage">Night</label>
                <div class="col-md-6 col-sm-6">
                  <input type="number" id="durationnightPackage" name="durationnightPackage" class="form-control" value="<?php echo $package->durationnightPackage; ?>" required style="background: #ffff4c82;">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="qtyKamar">Kuaniti package <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="number" min="1" id="qtyKamar" required="required" name="qtyKamar" class="form-control" placeholder="1" value="<?php echo $package->nightPackage; ?>">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="autocomplete-custom-append-type-kamar">Type Kamar <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="autocomplete-custom-append-type-kamar" required="required" name="ketKamar" class="form-control" placeholder="Deluxe Room Single" value="<?php echo $package->ketKamar; ?>">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nmPackage">Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="nmPackage" required="required" name="nmPackage" class="form-control" placeholder="Holiday Package" value="<?php echo $package->nmPackage; ?>">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="eventType">Event type <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="eventType" readonly name="eventType" class="form-control" placeholder="Holiday Package" value="<?php echo $package->eventType; ?>">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="cktextarea">Keterangan<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <textarea required="required" class="form-control" id="cktextarea" name="ketPackage" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"><?php echo $package->ketPackage; ?></textarea>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Harga Package <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 form-group has-feedback">
                  <input type="text" name="hargaROKamar" id="priceInput" required="required" class="form-control" value="<?php echo $package->hargaROKamar; ?>">
                  <span class="form-control-feedback right" aria-hidden="true">IDR</span>
                </div>
              </div>
              <script>
                var inputElement = document.getElementById("priceInput");

                inputElement.addEventListener("input", function() {
                  var inputValue = inputElement.value;

                  // Remove non-numeric characters
                  var numericValue = inputValue.replace(/[^0-9.]/g, '');

                  const doubleNumber = Number(numericValue);

                  console.log(doubleNumber);

                  // Set the value of the input to doubleNumber
                  inputElement.value = doubleNumber;

                  // Format the value with commas and two decimal places
                  var formattedValue = formatNumberWithCommasAndDecimals(<?php echo $package->hargaROKamar; ?>);

                  // Update the input value with the formatted value
                  inputElement.value = formattedValue;
                });

                function formatNumberWithCommasAndDecimals(number) {
                  var parts = number.split(".");
                  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                  return parts.join(".");
                }

                var ContentFromEditor = CKEDITOR.instances.cktextarea.getData();
                document.getElementById('cktextarea').value = <?php echo $package->ketPackage; ?>
              </script>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Photo <span class="required">* (1257 x 1778)</span>
                </label>
                <div id="fileInputsContainer">
                  <div class="col-md-6 col-sm-6 form-group has-feedback">
                    <img src="<?php echo '/assets/images/package/' . $package->imgPackage; ?>"  width="200" height="200" alt="no picture"/>
                    <img id="imgPackage" src="" alt="Picture" class="cropper-hidden">
                    <div style="padding-top: 10px;">
                      <input type="hidden" name="dataX" id="dataX" value="1257">
                      <input type="hidden" name="dataY" id="dataY" value="1778">
                      <input type="hidden" name="dataHeight" id="dataHeight" value="1257">
                      <input type="hidden" name="dataWidth" id="dataWidth" value="1778">
                      <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                        <input type="file" class="sr-only" id="inputImage" name="imgPackage" accept="image/*">
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
                  <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>
                </div>
              </div>
            <!-- </form> -->
          </div>
          <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
          <script type="text/javascript">
            // import 'cropperjs/dist/cropper.css';
            $(document).ready(function () {
              var loaderText = document.getElementById('loader-text');
              loaderText.style.display = 'none';
              var Cropper = window.Cropper;
              var URL = window.URL || window.webkitURL;
              console.log(URL + " lalala ")
              if (URL) {
                console.log("truee ")
              }
              // var container = document.querySelector('.img-container');
              var image = document.getElementById('imgPackage');
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
              var uploadedImageURL = './assets/images/package/';

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
                var statusPackage = document.getElementById('statusPackage');
                var dateKamar = document.getElementById('dateKamar');
                var nightPackage = document.getElementById('nightPackage');
                var dateafterKamar = document.getElementById('dateafterKamar');
                var durationPackage = document.getElementById('durationPackage');
                var durationnightPackage = document.getElementById('durationnightPackage');
                var qtyKamar = document.getElementById('qtyKamar');
                var ketKamar = document.getElementById('autocomplete-custom-append-type-kamar');
                var nmPackage = document.getElementById('nmPackage');
                var ketPackage = document.getElementById('ketPackage');
                var hargaROKamar = document.getElementById('priceInput');
                var ContentFromEditor = CKEDITOR.instances.cktextarea.getData();
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
                fData.append('statusPackage', statusPackage.value);
                fData.append('dateKamar', dateKamar.value);
                fData.append('nightPackage', nightPackage.value);
                fData.append('dateafterKamar', dateafterKamar.value);
                fData.append('durationPackage', durationPackage.value);
                fData.append('durationnightPackage', durationnightPackage.value);
                fData.append('qtyKamar', qtyKamar.value);
                fData.append('ketKamar', ketKamar.value);
                fData.append('nmPackage', nmPackage.value);
                fData.append('ketPackage', ContentFromEditor);
                fData.append('hargaROKamar', hargaROKamar.value);
                $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url('cms/home/updateFormKamarPackage/'.$package->idKamar.'/') ?>',
                  data: fData,
                  processData: false,  // Prevent jQuery from automatically processing the data
                  contentType: false,  // Prevent jQuery from automatically setting the content type
                  success: function (response) {
                    // Handle the response from the server (if needed)
                    var resp = JSON.parse(response);
                    // console.log("response", response);
                    if(resp.response == 'error') {
                      alert(resp.desc);
                      var loaderText = document.getElementById('loader-text');
                      loaderText.style.display = 'none';
                    }
                    window.location.href = window.location.href;
                  },
                  error: function (error) {
                    console.error("error", error);
                  }
                });
              }

              // Example: Trigger the form submission when a button is clicked
              document.getElementById('submitBtn').addEventListener('click', function() {
                var loaderText = document.getElementById('loader-text');
                loaderText.style.display = 'block';
                submitCroppedImage();
              });
            });
          </script>
        </div>                
      </div>
    </div>
  </div>
</div>