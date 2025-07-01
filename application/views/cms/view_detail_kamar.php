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
<div class="right_col" role="main">
  <div class>
    <div class="page-title">
      <div class="title_left">
        <h3>Detail Kamar :: <?php echo $kamar->ketKamar ?></h3>
      </div>
      <div class="title_right">
        <div class="col-md-5 col-sm-5  form-group pull-right top_search">
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
            <h2>Detail Kamar :: <?php echo $kamar->ketKamar ?></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li>
                <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
                </a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  <i class="fa fa-wrench"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Settings 1</a>
                  <a class="dropdown-item" href="#">Settings 2</a>
                </div>
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
            <!-- taruh form untuk insert nameIcon -->
            <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertNumberKamar/'.$idBusiness.'/'.$idKamarAll.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
              <input type="hidden" name="idKamar" value="<?php echo $kamar->ketKamar ?>">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nomorkamar">Nomor Kamar <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="number" id="nomorkamar" required="required" name="nmNumber" class="form-control" min="1" placeholder="1">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nomorkamar">Status Kamar <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select id="keterangankamar" name="ketNumber" class="form-control" required>
                    <option value>Choose..</option>
                    <option value="VD">Vacant Dirty</option>
                    <option value="VC">Vacant Clean</option>
                    <option value="VR">Vacant Ready</option>
                    <option value="OD">Occupied Dirty</option>
                    <option value="OC">Occupied Clean</option>
                    <option value="ED">Extend Departure</option>
                    <option value="OOO">Out Of Order</option>
                  </select>
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
          </div>
          <div class="x_content">
            <div class="col-md-12 col-sm-12">
              <div class="card-body">
                <div style="border:0px solid #e5e5e5;float:inline-end !important;">
                  <h3 class="prod_title"><?php echo $kamar->ketKamar ?></h3>
                  <h4>Keterangan Kamar</h4>
                  <p><?php echo $kamar->ketKamar ?></p>
                  <div class>
                    <h2>Nomor Kamar</h2>
                    <ul class="list-inline prod_size display-layout">
                      <?php
                        foreach($nomorkamar as $row) {
                      ?>
                      <li>
                        <div class="btn btn-success" id="fc_create" data-toggle="modal" data-target="#editnomorModal<?php echo $row->nmNumber ?>"><?php echo $row->nmNumber ?></div>
                      </li>
                      <div class="modal fade" id="editnomorModal<?php echo $row->nmNumber ?>" tabindex="-1" role="dialog" aria-labelledby="editnomorModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editnomorModalLabel">Room Number <?php echo $row->nmNumber ?></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/editNumberKamar/'.$idBusiness.'/'.$row->idKamar.'/'.$row->nmNumber.'/'.$row->idNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                                <input type="hidden" name="idBusiness" value="<?php echo $this->session->userdata('idBusiness') ?>">
                                <input type="hidden" name="idType" value="<?php echo $row->idType ?>">
                                <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="nomorkamar">Nomor Kamar
                                  </label>
                                  <div class="col-md-6 col-sm-6 ">
                                    <input type="number" id="nomorkamar" name="nmNumber" value="<?php echo $row->nmNumber ?>" class="form-control" min="1" placeholder="1">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="nomorkamar">Features Kamar
                                  </label>
                                  <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="featureskamar" name="featuresNumber" value="<?php echo $row->featuresNumber ?>" class="form-control" placeholder="1">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="idType">Type Kamar
                                  </label>
                                  <div class="col-md-6 col-sm-6 ">
                                    <select id="idType" name="idTypeAfter" class="form-control">
                                      <option value>Choose..</option>
                                      <?php
                                        foreach($nomor_edit as $row) {
                                      ?>
                                        <option value="<?php echo $row->idKamar ?>"><?php echo $row->ketKamar ?></option>
                                      <?php
                                        }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                                <div style="text-align: center; padding: 30px;">
                                  <canvas id="qr-code-<?php echo $row->nmNumber ?>" width="300" height="300" style="display: block;"></canvas>
                                </div>
                                <script src="<?php echo base_url() ?>/vendors/davidshimjs-qrcodejs-04f46c6/qrcode.js"></script>
                                <script>
                                  (function() {
                                    // Buat variabel untuk elemen canvas berdasarkan nmNumber
                                    const qrCanvasId = 'qr-code-<?php echo $row->nmNumber ?>';
                                    const qrCanvas = document.getElementById(qrCanvasId);
                                    const qrContext = qrCanvas.getContext('2d');

                                    // QR Code data
                                    const qrData = 'https://rahisaresto.sahirahotelsgroup.com/#/intro/' + '<?php echo $row->nmNumber ?>/<?php echo $idBusiness ?>';

                                    // Buat QR Code dalam elemen tersembunyi
                                    const tempDiv = document.createElement('div');
                                    tempDiv.style.display = 'none';
                                    document.body.appendChild(tempDiv);

                                    const qrCode = new QRCode(tempDiv, {
                                      text: qrData,
                                      width: 300,
                                      height: 300,
                                      colorDark: "#000000",
                                      colorLight: "#ffffff",
                                      correctLevel: QRCode.CorrectLevel.H
                                    });

                                    // Tunggu hingga QR Code selesai dirender di elemen tersembunyi
                                    setTimeout(() => {
                                      const qrImage = tempDiv.querySelector('img');
                                      const img = new Image();
                                      img.src = qrImage.src;

                                      img.onload = () => {
                                        // Gambar QR Code di canvas
                                        qrContext.drawImage(img, 0, 0, 300, 300);

                                        // Tambahkan logo
                                        const logo = new Image();
                                        logo.src = '<?php echo base_url('assets/images/logo-sahirahotelsgroup-new-lg.png') ?>';
                                        logo.onload = () => {
                                          const logoSize = 80; // Ukuran logo dalam pixel
                                          const centerX = (qrCanvas.width - logoSize) / 2;
                                          const centerY = (qrCanvas.height - logoSize) / 2;

                                          // Gambar logo di tengah QR Code
                                          qrContext.drawImage(logo, centerX, centerY, logoSize, logoSize);

                                          // Tambahkan teks di bawah QR Code dengan latar belakang putih
                                          const text = '<?php echo $row->nmNumber ?>'; // Teks yang akan ditambahkan
                                          const padding = 5; // Padding dalam pixel
                                          qrContext.font = '24px Red Rose'; // Atur font dan ukuran teks
                                          qrContext.textAlign = 'center'; // Atur teks agar rata tengah
                                          qrContext.fillStyle = '#a07c46'; // Warna teks

                                          // Hitung ukuran teks
                                          const textMetrics = qrContext.measureText(text);
                                          const textWidth = textMetrics.width;
                                          const textHeight = 16; // Perkiraan tinggi teks berdasarkan ukuran font
                                          const textX = qrCanvas.width / 2; // Posisi X teks (tengah canvas)
                                          const textY = qrCanvas.height - 10; // Posisi Y teks (sedikit di atas bawah canvas)

                                          // Gambar latar belakang putih
                                          const bgX = textX - textWidth / 2 - padding;
                                          const bgY = textY - textHeight - padding;
                                          const bgWidth = textWidth + padding * 2;
                                          const bgHeight = textHeight + padding * 2;

                                          qrContext.fillStyle = '#ffffff'; // Warna latar belakang
                                          qrContext.fillRect(bgX, bgY, bgWidth, bgHeight);

                                          // Gambar teks di atas latar belakang
                                          qrContext.fillStyle = '#a07c46'; // Warna teks
                                          qrContext.fillText(text, textX, textY);


                                          // Konversi QR Code ke gambar dan unduh otomatis
                                          // const imageData = qrCanvas.toDataURL('image/png');
                                          // const link = document.createElement('a');
                                          // link.href = imageData;
                                          // link.download = 'qr_code_<?php echo $row->nmNumber ?>.png';
                                          // document.body.appendChild(link); // Tambahkan ke DOM sementara
                                          // link.click(); // Simulasikan klik
                                          // document.body.removeChild(link); // Hapus link dari DOM
                                        };
                                      };

                                      // Hapus elemen sementara
                                      document.body.removeChild(tempDiv);
                                    }, 1000); // Tunggu 500ms agar QR Code selesai dirender
                                  })();
                                </script>
                                <div class="ln_solid"></div>
                                <div class="item form-group">
                                  <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button class="btn btn-primary" type="button">Cancel</button>
                                    <button class="btn btn-primary" type="reset">Reset</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php } ?>
                      <script type="text/javascript">
                        var modalID = document.getElementById('editnomorModal');
                        modalID.setAttribute('data-toggle', 'modal');
                        modalID.setAttribute('data-target', '#editnomorModal');
                        modalID.click();
                      </script>
                    </ul>
                  </div>
                  <br />
                  <div class>
                    <div class="product_price">
                    <h1 class="price">Rp <?php echo number_format($kamar->hargaROKamar) ?></h1>
                    <span class="price-tax">1 Night</span>
                    <br>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2> Kamar :: <?php echo $kamar->ketKamar ?></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li>
                <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
                </a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  <i class="fa fa-wrench"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Settings 1</a>
                  <a class="dropdown-item" href="#">Settings 2</a>
                </div>
              </li>
              <li>
                <a class="close-link">
                  <i class="fa fa-close"></i>
                </a>
              </li>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
          </div>
          <div class="x_content">
            <div class="card-body">
              <div style="grid">
                  <div class="item form-group" style="display: flex">
                      <label class="col-form-label col-md-3 col-sm-3 label-align">Gambar Kamar 1 <span class="required">*</span>
                      </label>
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
                                                  // Set the src attribute of the image element using the extracted URL
                                                  result_image.src = '/assets/images/kamar/' + imageUrl;
                                                  uploadImage(imageUrl, 1)
                                                  $('#cropperModal1').modal('toggle');
                                              },
                                              error: function (error) {
                                                  console.error("error", error);
                                              }
                                          });
                                      }
                                      function uploadImage(filename, type) {
                                          var fData = new FormData();
                                          fData.append('ketKamar', '<?php echo $kamar->ketKamar ?>');
                                          fData.append('typeGambar', type);
                                          fData.append('filename', filename);
                                            console.log("asdfasdfasfdaf")
                                          console.log(filename)
                                          console.log(type)
                                          $.ajax({
                                              type: 'POST',
                                              url: '<?php echo base_url('cms/home/uploadKamarGambar') ?>',
                                              data: fData,
                                              processData: false,  // Prevent jQuery from automatically processing the data
                                              contentType: false,  // Prevent jQuery from automatically setting the content type
                                              success: function (response) {
                                                  console.log("response", response);
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
                  <div class="item form-group" style="display: flex">
                      <label class="col-form-label col-md-3 col-sm-3 label-align">Gambar Kamar 2<span class="required">*</span>
                      </label>
                      <div class="btn btn-primary" style="height: 35px;" data-toggle="modal" data-target="#cropperModal2">Upload image</div>
                      <div class="modal fade" id="cropperModal2" tabindex="-1" role="dialog" aria-labelledby="cropperModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="cropperModalLabel">Image cropper Photo</h5>
                                      <div class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </div>
                                  </div>
                                  <div class="modal-body">
                                      <img id="image2" src="" alt="Picture" class="cropper-hidden">
                                      <div style="padding-top: 10px;">
                                          <input type="hidden" name="idBusiness" value="<?php echo $this->session->userdata('idBusiness') ?>">
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
                                          <div  id="submitBtn2" class="btn btn-success">
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
                                                  var result_image = document.getElementById('result-image2');
                                                  // Set the src attribute of the image element using the extracted URL
                                                  result_image.src = '/assets/images/kamar/' + imageUrl;
                                                  uploadImage(imageUrl, 2)
                                                  $('#cropperModal2').modal('toggle');
                                              },
                                              error: function (error) {
                                                  console.error("error", error);
                                              }
                                          });
                                      }
                                      function uploadImage(filename, type) {
                                          var fData = new FormData();
                                          fData.append('ketKamar', '<?php echo $kamar->ketKamar ?>');
                                          fData.append('typeGambar', type);
                                          fData.append('filename', filename);
                                          console.log("asdfasdfasfdaf")
                                          console.log(filename)
                                          console.log(type)
                                          $.ajax({
                                              type: 'POST',
                                              url: '<?php echo base_url('cms/home/uploadKamarGambar') ?>',
                                              data: fData,
                                              processData: false,  // Prevent jQuery from automatically processing the data
                                              contentType: false,  // Prevent jQuery from automatically setting the content type
                                              success: function (response) {
                                                  console.log("response", response);
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
                  <div class="item form-group" style="display: flex">
                      <label class="col-form-label col-md-3 col-sm-3 label-align">Gambar Kamar 3 <span class="required">*</span>
                      </label>
                      <div class="btn btn-primary" style="height: 35px;" data-toggle="modal" data-target="#cropperModal3">Upload image</div>
                      <div class="modal fade" id="cropperModal3" tabindex="-1" role="dialog" aria-labelledby="cropperModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="cropperModalLabel">Image cropper Photo</h5>
                                      <div class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </div>
                                  </div>
                                  <div class="modal-body">
                                      <img id="image3" src="" alt="Picture" class="cropper-hidden">
                                      <div style="padding-top: 10px;">
                                          <input type="hidden" name="idBusiness" value="<?php echo $this->session->userdata('idBusiness') ?>">
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
                                          <div  id="submitBtn3" class="btn btn-success">
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
                                                  var result_image = document.getElementById('result-image3');
                                                  // Set the src attribute of the image element using the extracted URL
                                                  result_image.src = '/assets/images/kamar/' + imageUrl;
                                                  uploadImage(imageUrl, 3)
                                                  $('#cropperModal3').modal('toggle');
                                              },
                                              error: function (error) {
                                                  console.error("error", error);
                                              }
                                          });
                                      }
                                      function uploadImage(filename, type) {
                                          var fData = new FormData();
                                          fData.append('ketKamar', '<?php echo $kamar->ketKamar ?>');
                                          fData.append('typeGambar', type);
                                          fData.append('filename', filename);
                                          console.log("asdfasdfasfdaf")
                                          console.log(filename)
                                          console.log(type)
                                          $.ajax({
                                              type: 'POST',
                                              url: '<?php echo base_url('cms/home/uploadKamarGambar') ?>',
                                              data: fData,
                                              processData: false,  // Prevent jQuery from automatically processing the data
                                              contentType: false,  // Prevent jQuery from automatically setting the content type
                                              success: function (response) {
                                                  console.log("response", response);
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
                <hr>
                    <h4>priview gambar kamar</h4>
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th style="text-align: center;">gambar1</th>
                          <th style="text-align: center;">gambar2</th>
                          <th style="text-align: center;">gambar3</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><img class="img-responsive" id="result-image1" src="<?php echo '/assets/images/kamar/' .$kamar->imgKamardetail; ?>"/></td>
                          <td><img class="img-responsive" id="result-image2" src="<?php echo '/assets/images/kamar/' .$kamar->img2Kamardetail; ?>"/></td>
                          <td><img class="img-responsive" id="result-image3" src="<?php echo '/assets/images/kamar/' .$kamar->img3Kamardetail; ?>"/></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>   
            </div>
          <div class="x_content">
            <div class="card-body">
              <div style="grid">
                  <div class="item form-group" style="display: flex">
                      <label class="col-form-label col-md-3 col-sm-3 label-align">Gambar Kamar 4 <span class="required">*</span>
                      </label>
                      <div class="btn btn-primary" style="height: 35px;" data-toggle="modal" data-target="#cropperModal4">Upload image</div>
                      <div class="modal fade" id="cropperModal4" tabindex="-1" role="dialog" aria-labelledby="cropperModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="cropperModalLabel">Image cropper Photo</h5>
                                      <div class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </div>
                                  </div>
                                  <div class="modal-body">
                                      <img id="image4" src="" alt="Picture" class="cropper-hidden">
                                      <div style="padding-top: 10px;">
                                          <input type="hidden" name="idBusiness" value="<?php echo $this->session->userdata('idBusiness') ?>">
                                          <input type="hidden" name="dataX" id="dataX" value="422">
                                          <input type="hidden" name="dataY" id="dataY" value="290">
                                          <input type="hidden" name="dataHeight" id="dataHeight" value="422">
                                          <input type="hidden" name="dataWidth" id="dataWidth" value="290">
                                          <label class="btn btn-primary btn-upload" for="inputImage4" title="Upload image file">
                                              <input type="file" class="sr-only" id="inputImage4" name="imgBuilding" accept="image/*">
                                              <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs">
                                            Import
                                            <span class="fa fa-upload"></span>
                                          </span>
                                          </label>
                                          <div  id="submitBtn4" class="btn btn-success">
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
                                  $('#cropperModal4').on('shown.bs.modal', function () {
                                      var Cropper = window.Cropper;
                                      var URL = window.URL || window.webkitURL;
                                      // var container = document.querySelector('.img-container');
                                      var image = document.getElementById('image4');
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
                                      var inputImage = document.getElementById('inputImage4');
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
                                          var fileInput= document.getElementById('inputImage4');
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
                                                  var result_image = document.getElementById('result-image4');
                                                  // Set the src attribute of the image element using the extracted URL
                                                  result_image.src = '/assets/images/kamar/' + imageUrl;
                                                  uploadImage(imageUrl, 4)
                                                  $('#cropperModal4').modal('toggle');
                                              },
                                              error: function (error) {
                                                  console.error("error", error);
                                              }
                                          });
                                      }
                                      function uploadImage(filename, type) {
                                          var fData = new FormData();
                                          fData.append('ketKamar', '<?php echo $kamar->ketKamar ?>');
                                          fData.append('typeGambar', type);
                                          fData.append('filename', filename);
                                          console.log("asdfasdfasfdaf")
                                          console.log(filename)
                                          console.log(type)
                                          $.ajax({
                                              type: 'POST',
                                              url: '<?php echo base_url('cms/home/uploadKamarGambar') ?>',
                                              data: fData,
                                              processData: false,  // Prevent jQuery from automatically processing the data
                                              contentType: false,  // Prevent jQuery from automatically setting the content type
                                              success: function (response) {
                                                  console.log("response", response);
                                              },
                                              error: function (error) {
                                                  console.error("error", error);
                                              }
                                          });
                                      }
                                      // Example: Trigger the form submission when a button is clicked
                                      document.getElementById('submitBtn4').addEventListener('click', function() {
                                          submitCroppedImage();
                                      });
                                      // window.onload(); // This line ensures your existing code runs
                                  });
                              });
                          </script>
                      </div>
                  </div>
                  <div class="item form-group" style="display: flex">
                      <label class="col-form-label col-md-3 col-sm-3 label-align">Gambar Kamar 5 <span class="required">*</span>
                      </label>
                      <div class="btn btn-primary" style="height: 35px;" data-toggle="modal" data-target="#cropperModal5">Upload image</div>
                      <div class="modal fade" id="cropperModal5" tabindex="-1" role="dialog" aria-labelledby="cropperModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="cropperModalLabel">Image cropper Photo</h5>
                                      <div class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </div>
                                  </div>
                                  <div class="modal-body">
                                      <img id="image5" src="" alt="Picture" class="cropper-hidden">
                                      <div style="padding-top: 10px;">
                                          <input type="hidden" name="idBusiness" value="<?php echo $this->session->userdata('idBusiness') ?>">
                                          <input type="hidden" name="dataX" id="dataX" value="422">
                                          <input type="hidden" name="dataY" id="dataY" value="290">
                                          <input type="hidden" name="dataHeight" id="dataHeight" value="422">
                                          <input type="hidden" name="dataWidth" id="dataWidth" value="290">
                                          <label class="btn btn-primary btn-upload" for="inputImage5" title="Upload image file">
                                              <input type="file" class="sr-only" id="inputImage5" name="imgBuilding" accept="image/*">
                                              <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs">
                                            Import
                                            <span class="fa fa-upload"></span>
                                          </span>
                                          </label>
                                          <div  id="submitBtn5" class="btn btn-success">
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
                                  $('#cropperModal5').on('shown.bs.modal', function () {
                                      var Cropper = window.Cropper;
                                      var URL = window.URL || window.webkitURL;
                                      // var container = document.querySelector('.img-container');
                                      var image = document.getElementById('image5');
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
                                      var inputImage = document.getElementById('inputImage5');
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
                                          var fileInput= document.getElementById('inputImage5');
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
                                                  var result_image = document.getElementById('result-image5');
                                                  // Set the src attribute of the image element using the extracted URL
                                                  result_image.src = '/assets/images/kamar/' + imageUrl;
                                                  uploadImage(imageUrl, 5)
                                                  $('#cropperModal5').modal('toggle');
                                              },
                                              error: function (error) {
                                                  console.error("error", error);
                                              }
                                          });
                                      }
                                      function uploadImage(filename, type) {
                                          var fData = new FormData();
                                          fData.append('ketKamar', '<?php echo $kamar->ketKamar ?>');
                                          fData.append('typeGambar', type);
                                          fData.append('filename', filename);
                                          console.log("asdfasdfasfdaf")
                                          console.log(filename)
                                          console.log(type)
                                          $.ajax({
                                              type: 'POST',
                                              url: '<?php echo base_url('cms/home/uploadKamarGambar') ?>',
                                              data: fData,
                                              processData: false,  // Prevent jQuery from automatically processing the data
                                              contentType: false,  // Prevent jQuery from automatically setting the content type
                                              success: function (response) {
                                                  console.log("response", response);
                                              },
                                              error: function (error) {
                                                  console.error("error", error);
                                              }
                                          });
                                      }
                                      // Example: Trigger the form submission when a button is clicked
                                      document.getElementById('submitBtn5').addEventListener('click', function() {
                                          submitCroppedImage();
                                      });
                                      // window.onload(); // This line ensures your existing code runs
                                  });
                              });
                          </script>
                      </div>
                  </div>
                  <div class="item form-group" style="display: flex">
                      <label class="col-form-label col-md-3 col-sm-3 label-align">Gambar Kamar 6 <span class="required">*</span>
                      </label>
                      <div class="btn btn-primary" style="height: 35px;" data-toggle="modal" data-target="#cropperModal6">Upload image</div>
                      <div class="modal fade" id="cropperModal6" tabindex="-1" role="dialog" aria-labelledby="cropperModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="cropperModalLabel">Image cropper Photo</h5>
                                      <div class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </div>
                                  </div>
                                  <div class="modal-body">
                                      <img id="image6" src="" alt="Picture" class="cropper-hidden">
                                      <div style="padding-top: 10px;">
                                          <input type="hidden" name="idBusiness" value="<?php echo $this->session->userdata('idBusiness') ?>">
                                          <input type="hidden" name="dataX" id="dataX" value="422">
                                          <input type="hidden" name="dataY" id="dataY" value="290">
                                          <input type="hidden" name="dataHeight" id="dataHeight" value="422">
                                          <input type="hidden" name="dataWidth" id="dataWidth" value="290">
                                          <label class="btn btn-primary btn-upload" for="inputImage6" title="Upload image file">
                                              <input type="file" class="sr-only" id="inputImage6" name="imgBuilding" accept="image/*">
                                              <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs">
                                            Import
                                            <span class="fa fa-upload"></span>
                                          </span>
                                          </label>
                                          <div  id="submitBtn6" class="btn btn-success">
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
                                  $('#cropperModal6').on('shown.bs.modal', function () {
                                      var Cropper = window.Cropper;
                                      var URL = window.URL || window.webkitURL;
                                      // var container = document.querySelector('.img-container');
                                      var image = document.getElementById('image6');
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
                                      var inputImage = document.getElementById('inputImage6');
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
                                          var fileInput= document.getElementById('inputImage6');
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
                                                  var result_image = document.getElementById('result-image6');
                                                  // Set the src attribute of the image element using the extracted URL
                                                  result_image.src = '/assets/images/kamar/' + imageUrl;
                                                  uploadImage(imageUrl, 6)
                                                  $('#cropperModal6').modal('toggle');
                                              },
                                              error: function (error) {
                                                  console.error("error", error);
                                              }
                                          });
                                      }
                                      function uploadImage(filename, type) {
                                          var fData = new FormData();
                                          fData.append('ketKamar', '<?php echo $kamar->ketKamar ?>');
                                          fData.append('typeGambar', type);
                                          fData.append('filename', filename);
                                          console.log("asdfasdfasfdaf")
                                          console.log(filename)
                                          console.log(type)
                                          $.ajax({
                                              type: 'POST',
                                              url: '<?php echo base_url('cms/home/uploadKamarGambar') ?>',
                                              data: fData,
                                              processData: false,  // Prevent jQuery from automatically processing the data
                                              contentType: false,  // Prevent jQuery from automatically setting the content type
                                              success: function (response) {
                                                  console.log("response", response);
                                              },
                                              error: function (error) {
                                                  console.error("error", error);
                                              }
                                          });
                                      }
                                      // Example: Trigger the form submission when a button is clicked
                                      document.getElementById('submitBtn6').addEventListener('click', function() {
                                          submitCroppedImage();
                                      });
                                      // window.onload(); // This line ensures your existing code runs
                                  });
                              });
                          </script>
                      </div>
                  </div>
                <hr>
                    <h4>priview gambar kamar</h4>
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th style="text-align: center;">gambar4</th>
                          <th style="text-align: center;">gambar5</th>
                          <th style="text-align: center;">gambar6</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><img class="img-responsive" id="result-image4" src="<?php echo '/assets/images/kamar/' .$kamar->img4Kamardetail; ?>" alt=""/></td>
                          <td><img class="img-responsive" id="result-image5" src="<?php echo '/assets/images/kamar/' .$kamar->img5Kamardetail; ?>" alt=""/></td>
                          <td><img class="img-responsive" id="result-image6" src="<?php echo '/assets/images/kamar/' .$kamar->img6Kamardetail; ?>" alt=""/></td>
                        </tr>
                      </tbody>
                    </table>
                    </div>
                  </div>
                </div>
                <form action="<?php echo base_url('cms/home/applyFacilityRoom')?>" method="post">
                  <?php 
                    $displayed_name = array();
                    $facility = array();
                    $this->db->from('type_facility');
                    $this->db->where('typeIcon', 'room');
                    $query = $this->db->get();
                    if ($query->num_rows() > 0)
                    {
                      foreach ($query->result() as $row)
                      {
                        if (!in_array($row->typeIcon, $displayed_name)) {
                          $displayed_name[] = $row->typeIcon;
                          $facility[] = $row;
                        }
                      }
                    }
                    $query->free_result(); 
                  ?>
                  <div class="form-group">
                    <div class="row">
                      <?php foreach($facility as $row) { ?>  
                      <input type="text" name="idKamar" value="<?php echo $kamar->idKamar ?>">
                      <input type="text" readonly class="form-control" name="kamarFacility" id="kamarFacility<?php echo $row->nameIcon ?>" value="<?php echo $kamar->kamarFacility ?>">
                      <table class="table listfacility<?php echo $row->idfacility ?>">
                        <thead>
                          <tr>
                            <th>Nama Facility</th>
                            <th>Type Facility</th>
                            <th>Image Facility</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                      <script type="text/javascript">
                        $(document).ready(function () {
                          $.ajax({
                            type: "POST",
                            url: '<?php echo base_url("cms/home/sendajaxFacilityroom/") ?>',
                            success: function(response) {
                              var result = JSON.parse(response);
                              console.log(result);
                              // Assuming 'datatable-buttons' is the ID of your table
                              var tableBody = document.querySelector(".listfacility<?php echo $row->idfacility ?> tbody");
                              // Clear any previous content
                              tableBody.innerHTML = '';
                              try {
                                // Assuming 'result' is an array of objects
                                result.forEach(function(item) {
                                  var tr = document.createElement('tr');
                                  var tdidfacility = document.createElement('td');
                                  var idfacilityInput = document.createElement('input');
                                  idfacilityInput.type = 'hidden';
                                  idfacilityInput.value = item.idfacility;
                                  idfacilityInput.id = 'idfacility'+item.idfacility;
                                  idfacilityInput.name = 'idfacility';
                                  var tdnamefacility = document.createElement('td');
                                  tdnamefacility.textContent = item.nameIcon;
                                  var tdtypefacility = document.createElement('td');
                                  tdtypefacility.textContent = item.typeIcon;
                                  var tdimagefacility = document.createElement('td');
                                  var urlImageFacility = document.createElement('img');
                                  urlImageFacility.src = '<?php echo base_url('/assets/images/facilites/'); ?>'+item.imgIcon;
                                  var tdAction = document.createElement('td');
                                  var actionCheckbox = document.createElement('input');
                                  actionCheckbox.type = 'checkbox';
                                  actionCheckbox.dataset.type = item.typeIcon;
                                  actionCheckbox.id = item.nameIcon;
                                  // Set data-type<?php echo $row->idfacility ?> attribute for the row
                                  tr.setAttribute('data-type<?php echo $row->idfacility ?>', item.typeIcon);
                                  // Add a click event listener to the row to handle checkbox clicks
                                  actionCheckbox.addEventListener('click', function(e) {
                                    e.stopPropagation(); // Prevent the click event from reaching the row
                                    // Get all rows in the table
                                    var allRows = document.querySelectorAll('table tbody tr');
                                    // Initialize checked count
                                    var checkedCount = 0;
                                    console.log("checkedCount", checkedCount);
                                    allRows.forEach(function(row) {
                                      var dataType = row.getAttribute('data-type<?php echo $row->idfacility ?>');
                                      if (dataType === item.typeIcon) {
                                        var checkbox = row.querySelector('input[type="checkbox"]');
                                        checkbox.addEventListener('change', function() {
                                          if (this.checked) {
                                            checkedCount++;
                                            allRows.forEach(function(r) {
                                              var rType = r.getAttribute('data-type<?php echo $row->idfacility ?>');
                                              if (rType === item.typeIcon) {
                                                var cb = r.querySelector('input[type="checkbox"]');
                                                if (!cb.checked) {
                                                  cb.disabled = false;
                                                }
                                              }
                                            });
                                          } else {
                                            checkedCount--;
                                            allRows.forEach(function(r) {
                                              var rType = r.getAttribute('data-type<?php echo $row->idfacility ?>');
                                              if (rType === item.typeIcon) {
                                                var cb = r.querySelector('input[type="checkbox"]');
                                                cb.disabled = false;
                                              }
                                            });
                                          }
                                        });
                                      }
                                    });
                                  });
                                  // Add data attributes
                                  actionCheckbox.onclick = function() {
                                    chooseFacility(item.nameIcon); // Assuming 'chooseFacility' function takes a parameter
                                    if (this.checked) {
                                      let selectedOptions = JSON.parse(localStorage.getItem('selectedOptions')) || [];
                                      selectedOptions.push(item.nameIcon);
                                      localStorage.setItem('selectedOptions', JSON.stringify(selectedOptions));
                                      document.getElementById('kamarFacility<?php echo $row->nameIcon ?>').value = selectedOptions;
                                    } else {
                                      let selectedOptions = JSON.parse(localStorage.getItem('selectedOptions')) || [];
                                      selectedOptions = selectedOptions.filter(items => items !== item.nameIcon);
                                      localStorage.setItem('selectedOptions', JSON.stringify(selectedOptions));
                                      actionCheckbox.setAttribute('disabled', 'True');
                                    }
                                  };
                                  window.addEventListener('beforeunload', function() {
                                    localStorage.removeItem('selectedOptions');
                                  });
                                  tdAction.appendChild(actionCheckbox);
                                  tdimagefacility.appendChild(urlImageFacility);
                                  tdidfacility.appendChild(idfacilityInput);
                                  tr.appendChild(tdnamefacility);
                                  tr.appendChild(tdtypefacility);
                                  tr.appendChild(tdimagefacility);
                                  tr.appendChild(tdAction);
                                  tableBody.appendChild(tr);
                                });
                              } catch (error) {
                                console.error('Error:', error.message);
                                AlertError();
                                // Add your error handling code here
                              } 
                              function chooseFacility(facility) {
                                // Add your code to handle the chosen facility here
                                console.log("Chosen facility:", facility);
                              }
                            }
                          });
                        });
                      </script>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-warning btn-flat">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>