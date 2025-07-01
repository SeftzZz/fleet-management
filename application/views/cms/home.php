<?php if ($this->session->flashdata('pesansukses')) { ?><script language="javascript" type="text/javascript">
  window.onload = function() {
    swal({
      title: "Success",
      text: " <?php echo $this->session->flashdata('pesansukses');?>",
      type : "success",
      confirmButtonText: "Close"
    });
  }
</script> <?php } ?>
<!-- page content -->
<div class="right_col" role="main">
  <?php
    if($this->session->userdata('level') == 7) {
  ?>
    <div class="row">
      <div class="col-md-2">
        <button class="btn btn-success" data-toggle="modal" data-target="#checkinModal">Self CheckIn Scanner</button>
        <!-- Replace the URL inside the "src" attribute with the URL of the website you want to embed -->
        <div class="modal fade" id="checkinModal" tabindex="-1" role="dialog" aria-labelledby="checkinModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="checkinModalLabel">Self CheckIn Scanner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- Create an HTML element for the QR code scanner -->
                <div id="qr-code-scanner"></div>
                <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
                <script>
                  // Function to handle QR code scanning results
                  function onScanSuccess(qrCodeMessage) {
                    // Display the scanned QR code message
                    alert('QR Code Scanned: ' + qrCodeMessage);
                    window.location.href = '<?php echo base_url('cms/home/viewBookingDetail/') ?>'+qrCodeMessage;
                  }

                  // Function to handle QR code scanning failure
                  function onScanFailure(error) {
                    // Handle the error
                    // console.error('QR Code Scanning Error:', error);
                  }

                  // Initialize the HTML5 QR code scanner
                  const html5QrcodeScanner = new Html5QrcodeScanner(
                    'qr-code-scanner', // Element ID where the scanner will be rendered
                    { fps: 10, qrbox: 250 } // Optional configuration options
                  );

                  // Start the QR code scanner
                  html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                </script>
              </div>
              <div class="modal-footer">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-2">
        <!-- <button class="btn btn-warning" data-toggle="modal" data-target="#ocrModal">OCR Scanner</button> -->
        <!-- Replace the URL inside the "src" attribute with the URL of the website you want to embed -->
        <div class="modal fade" id="ocrModal" tabindex="-1" role="dialog" aria-labelledby="ocrModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ocrModalLabel">OCR Scanner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- Include the Tesseract.js library -->
                <script src="<?php echo base_url('build/js/worker.js') ?>"></script>
                <script src="<?php echo base_url('build/js/tesseract.js') ?>"></script>
                <script src="<?php echo base_url('build/js/tesseract-core.js') ?>"></script>
                <!-- Create an HTML video element to stream the camera feed -->
                <video id="cameraFeed" width="400" height="300" autoplay></video>

                <!-- Create a canvas element to capture and process the image -->
                <canvas id="imageCanvas" width="400" height="300" style="display:none;"></canvas>

                <!-- Create a button to trigger image capture and OCR processing -->
                <button onclick="captureAndProcessImage()">Capture and Process Image with OCR</button>

                <!-- Display the result -->
                <div id="result"></div>

                <script>
                    // Function to access the camera and stream the video
                    async function startCamera() {
                        try {
                            const stream = await navigator.mediaDevices.getUserMedia({ video: true });
                            const videoElement = document.getElementById('cameraFeed');
                            videoElement.srcObject = stream;
                        } catch (error) {
                            console.error('Error accessing the camera:', error);
                        }
                    }

                    // Function to wait for Tesseract.js to be ready
                    async function waitForTesseract() {
                        console.log('Waiting for Tesseract.js to be ready...');
                        while (typeof Tesseract === 'undefined' || typeof Tesseract.recognize !== 'function') {
                            await new Promise(resolve => setTimeout(resolve, 100));
                        }
                        console.log('Tesseract.js is ready.');
                    }

                    // Function to capture and process the image with OCR
                    async function captureAndProcessImage() {
                      await waitForTesseract(); // Wait for Tesseract.js to be ready

                      const videoElement = document.getElementById('cameraFeed');
                      const canvasElement = document.getElementById('imageCanvas');
                      const resultDiv = document.getElementById('result');

                      // Draw the current video frame onto the canvas
                      const canvasContext = canvasElement.getContext('2d');
                      canvasContext.drawImage(videoElement, 0, 0, canvasElement.width, canvasElement.height);

                      // Convert the canvas content to a data URL (base64-encoded PNG)
                      const imageDataUrl = canvasElement.toDataURL('image/png');
                      console.log('Captured image data URL:', imageDataUrl);

                      // Perform OCR using Tesseract.js
                      console.log('Performing OCR...');
                      const { data: { text } } = await Tesseract.recognize(
                        imageDataUrl,
                        'eng', // Language code (English in this case)
                        { logger: info => console.log(info) } // Optional logger
                      ).then(async({ data: { text } }) => {
                        console.log(text);
                        this.resultOCR = text;
                        // Define regular expressions for extracting information
                        const nameRegex = /Nama: ([^\n]+)/;
                        const addressRegex = /Alamat: ([^\n]+)/;
                        const birthdateRegex = /TglLahir :([^\n]+)/;
                        const licenseNumberRegex = /Ai "AI No. S : ([^\n]+)/;
                        const validityRegex = /Berlaku s\/d: ([^\n]+)/;

                        // Extract information using regular expressions
                        const nameMatch = text.match(nameRegex);
                        const addressMatch = text.match(addressRegex);
                        const birthdateMatch = text.match(birthdateRegex);
                        const licenseNumberMatch = text.match(licenseNumberRegex);
                        const validityMatch = text.match(validityRegex);

                        // Output the extracted information
                        const nama = nameMatch ? nameMatch[1] : 'Not found';
                        const alamat = addressMatch ? addressMatch[1] : 'Not found';
                        const tglLahir = birthdateMatch ? birthdateMatch[1] : 'Not found';
                        const noSIM = licenseNumberMatch ? licenseNumberMatch[1] : 'Not found';
                        const berlaku = validityMatch ? validityMatch[1] : 'Not found';

                        console.log('Nama:', nama);
                        console.log('Alamat:', alamat);
                        console.log('Tgl Lahir:', tglLahir);
                        console.log('No. SIM:', noSIM);
                        console.log('Berlaku:', berlaku);

                        setTimeout(async() => {
                          console.log("image deleted!");
                        }, 1000);
                        
                      });
                      console.log('OCR Result:', text);

                      // Store the OCR result in localStorage
                      localStorage.setItem('ocrResult', text);

                      // Display the result
                      resultDiv.innerHTML = `<p>OCR Result:</p><p>${text}</p>`;
                    }

                    // Start the camera when the page loads
                    document.addEventListener('DOMContentLoaded', startCamera);
                </script>
              </div>
              <div class="modal-footer">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- top tiles -->
    
    <div class="row tile_count">
      <?php
        $business = array();
        $this->db->from('Business_Detail');
        $this->db->join('business_group', 'business_group.idGroup=Business_Detail.idGroup');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
          foreach ($query->result() as $row) {
            $business[] = $row;
          }
        }
        $query->free_result(); 
        foreach($business as $row) {
      ?>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-building"></i> <?php echo $row->Name ?></span>
          <?php 
            $revenue = 0;
            $dataTSH = array();
            $this->db->from('booking');
            $this->db->where('idBusiness', $row->idBusiness);
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
              $dataTSH = $query->result(); // Use result() to get an array of objects
            }
            $query->free_result();
            
            foreach($dataTSH as $row) {
              $revenue += $row->totalrateBooking;
            }
          ?>
          <div class="count"><?php echo number_format($revenue, 0, ',', '.') ?></div>
        </div>
      <?php } ?>
    </div>
    <div class="row tile_count">
      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-group"></i> All Member / Year</span>
        <?php 
          $dataMembershipytd = array();
          $firstDayThisYear = date('Y-01-01 H:i:s');
          $lastDayThisYear = date('Y-12-t H:i:s');

          $this->db->from('Business_Detail');
          $this->db->join('business_group', 'business_group.idGroup=Business_Detail.idGroup');
          $this->db->join('membership', 'membership.idBusiness=Business_Detail.idBusiness');
          $this->db->where('membership.createdAtMembership >=', $firstDayThisYear);
          $this->db->where('membership.createdAtMembership <=', $lastDayThisYear);
          $query = $this->db->get();
          
          if ($query->num_rows() > 0) {
              $dataMembershipytd = $query->result(); // Use result() to get an array of objects
          }
          $query->free_result();

          $totalMembershipytd = count($dataMembershipytd);
        ?>
        <div class="count"><?php echo number_format($totalMembershipytd, 0, ',', '.') ?></div>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-group"></i> All Member / Month</span>
        <?php 
          $dataMembershipmtd = array();
          $firstDayThisMonth = date('Y-m-01 H:i:s');
          $lastDayThisMonth = date('Y-m-t H:i:s');

          $this->db->from('Business_Detail');
          $this->db->join('business_group', 'business_group.idGroup=Business_Detail.idGroup');
          $this->db->join('membership', 'membership.idBusiness=Business_Detail.idBusiness');
          $this->db->where('membership.createdAtMembership >=', $firstDayThisMonth);
          $this->db->where('membership.createdAtMembership <=', $lastDayThisMonth);
          $query = $this->db->get();
          
          if ($query->num_rows() > 0) {
              $dataMembershipmtd = $query->result(); // Use result() to get an array of objects
          }
          $query->free_result();

          $totalMembershipmtd = count($dataMembershipmtd);
        ?>
        <div class="count"><?php echo number_format($totalMembershipmtd, 0, ',', '.') ?></div>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-group"></i> All Member / Days</span>
        <?php 
          $dataMembershiptd = array();
          $firstDayThisDay = date('Y-m-d 00:00:00');
          $lastDayThisDay = date('Y-m-d 23:59:59');

          $this->db->from('Business_Detail');
          $this->db->join('business_group', 'business_group.idGroup=Business_Detail.idGroup');
          $this->db->join('membership', 'membership.idBusiness=Business_Detail.idBusiness');
          $this->db->where('membership.createdAtMembership >=', $firstDayThisDay);
          $this->db->where('membership.createdAtMembership <=', $lastDayThisDay);
          $query = $this->db->get();
          
          if ($query->num_rows() > 0) {
              $dataMembershiptd = $query->result(); // Use result() to get an array of objects
          }
          $query->free_result();

          $totalMembershiptd = count($dataMembershiptd);
        ?>
        <div class="count"><?php echo number_format($totalMembershiptd, 0, ',', '.') ?></div>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-group"></i> All Member</span>
        <?php 
          $dataMemberships = array();

          $this->db->from('Business_Detail');
          $this->db->join('business_group', 'business_group.idGroup=Business_Detail.idGroup');
          $this->db->join('membership', 'membership.idBusiness=Business_Detail.idBusiness');
          $query = $this->db->get();
          
          if ($query->num_rows() > 0) {
              $dataMemberships = $query->result(); // Use result() to get an array of objects
          }
          $query->free_result();

          $totalMemberships = count($dataMemberships);
        ?>
        <div class="count"><?php echo number_format($totalMemberships, 0, ',', '.') ?></div>
      </div>
    </div>
    <div class="row tile_count">
      <div class="col-md-3 widget widget_tally_box">
        <div class="x_panel ui-ribbon-container">
          <div class="x_content">
            <h3 class="name_title">Room Rates</h3>
            <p>Set the daily rates for your rooms</p>
            <div class="divider"></div>
            <div class="name_title">
              <a href="<?php echo base_url('cms/home/viewRateStructure') ?>" class="btn btn-success">Manage Room Rates</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 widget widget_tally_box">
        <div class="x_panel ui-ribbon-container">
          <div class="x_content">
            <h3 class="name_title">Room Allotment</h3>
            <p>Manage availability of your rooms</p>
            <div class="divider"></div>
            <div class="name_title">
              <a href="<?php echo base_url('cms/home/viewKamar/'.$this->session->userdata('idBusiness').'/') ?>" class="btn btn-success">Manage Room Allotment</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 widget widget_tally_box">
        <div class="x_panel ui-ribbon-container">
          <div class="x_content">
            <h3 class="name_title">Booking List</h3>
            <p>See all of your incoming bookings</p>
            <div class="divider"></div>
            <div class="name_title">
              <a href="<?php echo base_url('cms/home/viewBooking') ?>" class="btn btn-success">Manage Booking List</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 widget widget_tally_box">
        <div class="x_panel ui-ribbon-container">
          <div class="x_content">
            <h3 class="name_title">Payment Report</h3>
            <p>See all of your incoming invoice</p>
            <div class="divider"></div>
            <div class="name_title">
              <a href="<?php echo base_url('cms/home/viewPembayaran/'.$this->session->userdata('idBusiness').'/') ?>" class="btn btn-success">Manage Payment Report</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 widget widget_tally_box">
        <div class="x_panel ui-ribbon-container">
          <div class="x_content">
            <h3 class="name_title">Investment Hotel</h3>
            <p>Manage all investment in your hotel</p>
            <div class="divider"></div>
            <div class="name_title">
              <a href="<?php echo base_url('cms/home/viewInvestment/'.$this->session->userdata('idBusiness').'/') ?>" class="btn btn-success">Manage Investment Hotel</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <?php
        $business = array();
        $this->db->from('Business_Detail');
        $this->db->join('business_group', 'business_group.idGroup=Business_Detail.idGroup');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
          foreach ($query->result() as $row) {
            $business[] = $row;
          }
        }
        $query->free_result(); 
        foreach($business as $row) {
      ?>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2>ROOM REVENUE <?php echo $row->Name ?></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li>
                  <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                  </a>
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
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Transaction</th>
                    <th colspan="3">Actual</th>
                    <th colspan="2">Budget</th>
                    <th colspan="2">Forecast</th>
                  </tr>
                  <tr>
                    <th>Description</th>
                    <th>Today</th>
                    <th>MTD</th>
                    <th>YTD</th>
                    <th>MTD</th>
                    <th>YTD</th>
                    <th>MTD</th>
                    <th>YTD</th>
                  </tr>
                </thead>
                <tbody>
                  <tr></tr>
                  <tr>
                    <td>FIT</td>
                    <!-- ACTUAL -->
                    <?php 
                      $totalFITtoday = 0;
                      $dataFITtoday = array();
                      $this->db->from('booking');
                      $this->db->where('segmentBooking', 'FIT');
                      $this->db->where('arrivalBooking', date('Y-m-d'));
                      $this->db->where('idBusiness', $row->idBusiness);
                      $query = $this->db->get();
                      
                      if ($query->num_rows() > 0) {
                        $dataFITtoday = $query->result(); // Use result() to get an array of objects
                      }
                      $query->free_result();
                      
                      foreach($dataFITtoday as $row) {
                        $totalFITtoday += $row->totalrateBooking;
                      }
                    ?>
                    <td><?php echo number_format($totalFITtoday, 0, ',', '.') ?></td>
                    <?php
                      $totalFITmtd = 0;
                      $dataFITmtd = array();
                      $firstDayThisMonth = date('Y-m-01');
                      $lastDayThisMonth = date('Y-m-t');

                      $this->db->from('booking');
                      $this->db->where('segmentBooking', 'FIT');
                      $this->db->where('arrivalBooking >=', $firstDayThisMonth);
                      $this->db->where('arrivalBooking <=', $lastDayThisMonth);
                      $this->db->where('idBusiness', $row->idBusiness);
                      $query = $this->db->get();
                      
                      if ($query->num_rows() > 0) {
                        $dataFITmtd = $query->result(); // Use result() to get an array of objects
                      }
                      $query->free_result();
                      
                      foreach($dataFITmtd as $row) {
                        $totalFITmtd += $row->totalrateBooking;
                      }
                    ?>
                    <td><?php echo number_format($totalFITmtd, 0, ',', '.') ?></td>

                    <?php
                      $totalFITytd = 0;
                      $dataFITytd = array();
                      $firstDayThisYear = date('Y-01-01');
                      $lastDayThisYear = date('Y-12-t');
                      
                      $this->db->from('booking');
                      $this->db->where('segmentBooking', 'FIT');
                      $this->db->where('arrivalBooking >=', $firstDayThisYear);
                      $this->db->where('arrivalBooking <=', $lastDayThisYear);
                      $this->db->where('idBusiness', $row->idBusiness);
                      $query = $this->db->get();
                      
                      if ($query->num_rows() > 0) {
                        $dataFITytd = $query->result(); // Use result() to get an array of objects
                      }
                      $query->free_result();
                      
                      foreach($dataFITytd as $row) {
                        $totalFITytd += $row->totalrateBooking;
                      }
                    ?>
                    <td><?php echo number_format($totalFITytd, 0, ',', '.') ?></td>

                    <!-- BUDGET -->
                    <td>0</td>
                    <td>0</td>
                    <!-- FORECAST -->
                    <td>0</td>
                    <td>0</td>
                  </tr>
                  <tr>
                    <td>OTA</td>
                    <!-- ACTUAL -->
                    <?php 
                      $totalOTAtoday = 0;
                      $dataOTAtoday = array();
                      $this->db->from('booking');
                      $this->db->where('segmentBooking', 'OTA');
                      $this->db->where('arrivalBooking', date('Y-m-d'));
                      $this->db->where('idBusiness', $row->idBusiness);
                      $query = $this->db->get();
                      
                      if ($query->num_rows() > 0) {
                        $dataOTAtoday = $query->result(); // Use result() to get an array of objects
                      }
                      $query->free_result();
                      
                      foreach($dataOTAtoday as $row) {
                        $totalOTAtoday += $row->totalrateBooking;
                      }
                    ?>
                    <td><?php echo number_format($totalOTAtoday, 0, ',', '.') ?></td>
                    <?php
                      $totalOTAmtd = 0;
                      $dataOTAmtd = array();
                      $firstDayThisMonth = date('Y-m-01');
                      $lastDayThisMonth = date('Y-m-t');

                      $this->db->from('booking');
                      $this->db->where('segmentBooking', 'OTA');
                      $this->db->where('arrivalBooking >=', $firstDayThisMonth);
                      $this->db->where('arrivalBooking <=', $lastDayThisMonth);
                      $this->db->where('idBusiness', $row->idBusiness);
                      $query = $this->db->get();
                      
                      if ($query->num_rows() > 0) {
                        $dataOTAmtd = $query->result(); // Use result() to get an array of objects
                      }
                      $query->free_result();
                      
                      foreach($dataOTAmtd as $row) {
                        $totalOTAmtd += $row->totalrateBooking;
                      }
                    ?>
                    <td><?php echo number_format($totalOTAmtd, 0, ',', '.') ?></td>

                    <?php
                      $totalOTAytd = 0;
                      $dataOTAytd = array();
                      $firstDayThisYear = date('Y-01-01');
                      $lastDayThisYear = date('Y-12-t');
                      
                      $this->db->from('booking');
                      $this->db->where('segmentBooking', 'OTA');
                      $this->db->where('arrivalBooking >=', $firstDayThisYear);
                      $this->db->where('arrivalBooking <=', $lastDayThisYear);
                      $this->db->where('idBusiness', $row->idBusiness);
                      $query = $this->db->get();
                      
                      if ($query->num_rows() > 0) {
                        $dataOTAytd = $query->result(); // Use result() to get an array of objects
                      }
                      $query->free_result();
                      
                      foreach($dataOTAytd as $row) {
                        $totalOTAytd += $row->totalrateBooking;
                      }
                    ?>
                    <td><?php echo number_format($totalOTAytd, 0, ',', '.') ?></td>

                    <!-- BUDGET -->
                    <td>0</td>
                    <td>0</td>
                    <!-- FORECAST -->
                    <td>0</td>
                    <td>0</td>
                  </tr>
                  <tr>
                    <td><strong>TOTAL ROOM REVENUE</strong></td>
                    <!-- ACTUAL -->
                    <?php 
                      $totalRevenueToday = $totalFITtoday + $totalOTAtoday;
                      $totalRevenueMtd = $totalFITmtd + $totalOTAmtd;
                      $totalRevenueYtd = $totalFITytd + $totalOTAytd;
                    ?>
                    <td><?php echo number_format($totalRevenueToday, 0, ',', '.') ?></td>
                    <td><?php echo number_format($totalRevenueMtd, 0, ',', '.') ?></td>
                    <td><?php echo number_format($totalRevenueYtd, 0, ',', '.') ?></td>
                    <!-- BUDGET -->
                    <td>0</td>
                    <td>0</td>
                    <!-- FORECAST -->
                    <td>0</td>
                    <td>0</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>ROOM DAILY <?php echo $row->Name ?></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li>
                <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
                </a>
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
            <div id="calendar-fo"></div>
            <?php foreach ($alltype as $row) { ?>
              <?php $modal_id = 'modal_' . strtolower(str_replace(' ', '_', $row->ketKamar)); ?>
              <div id="<?php echo $modal_id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title" id="start<?php echo $modal_id; ?>"></h4>
                      <div id="formattedDateDisplay<?php echo $modal_id; ?>"></div>
                    </div>
                    <div class="modal-body">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Type Room</th>
                            <th>Available</th>
                            <!-- <th>Occupied</th> -->
                            <th>Pax</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $datarroms = array();
                            $this->db->from('Business_Detail');
                            $this->db->join('kamar', 'kamar.idBusiness=Business_Detail.idBusiness');
                            $query = $this->db->get();
                            if ($query->num_rows() > 0)
                            {
                              foreach ($query->result() as $row)
                              {
                                $datarroms[] = $row;
                              }
                            }
                            $query->free_result(); 
                          ?>
                          <?php 
                            foreach($datarroms as $row) {
                          ?>
                          <tr>
                            <td id="ketKamar_<?php echo $modal_id; ?>_<?php echo $row->idKamar; ?>"></td>
                            <td id="capacityMeeting_<?php echo $modal_id; ?>_<?php echo $row->idKamar; ?>"></td>
                            <!-- <td id="soldKamar_<?php echo $modal_id; ?>_<?php echo $row->idKamar; ?>"></td> -->
                            <td id="paxBooking_<?php echo $modal_id; ?>_<?php echo $row->idKamar; ?>"></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
            <div id="fc_edit"></div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  <?php
    if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 2) {
  ?>
    <div class="row tile_count">
      <?php
        $business = array();
        $this->db->from('Business_Detail');
        $this->db->join('business_group', 'business_group.idGroup=Business_Detail.idGroup');
        $this->db->where('Business_Detail.typeBusiness !=', 'OFFICE');
        $this->db->where('Business_Detail.idGroup', $this->session->userdata('idGroup'));
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
          foreach ($query->result() as $row) {
            $business[] = $row;
          }
        }
        $query->free_result(); 
        foreach($business as $row) {
      ?>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-building"></i> <?php echo $row->Name ?></span>
          <?php 
            $revenue = 0;
            $dataTSH = array();
            $this->db->from('booking');
            $this->db->where('idBusiness', $row->idBusiness);
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
              $dataTSH = $query->result(); // Use result() to get an array of objects
            }
            $query->free_result();
            
            foreach($dataTSH as $row) {
              $revenue += $row->totalrateBooking;
            }
          ?>
          <div class="count"><?php echo number_format($revenue, 0, ',', '.') ?></div>
        </div>
      <?php } ?>
    </div>
    <div class="row tile_count">
      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-group"></i> All Member / Year</span>
        <?php 
          $dataMembershipytd = array();
          $firstDayThisYear = date('Y-01-01 H:i:s');
          $lastDayThisYear = date('Y-12-t H:i:s');

          $this->db->from('Business_Detail');
          $this->db->join('business_group', 'business_group.idGroup=Business_Detail.idGroup');
          $this->db->join('membership', 'membership.idBusiness=Business_Detail.idBusiness');
          $this->db->where('Business_Detail.idGroup', $this->session->userdata('idGroup'));
          $this->db->where('membership.createdAtMembership >=', $firstDayThisYear);
          $this->db->where('membership.createdAtMembership <=', $lastDayThisYear);
          $query = $this->db->get();
          
          if ($query->num_rows() > 0) {
              $dataMembershipytd = $query->result(); // Use result() to get an array of objects
          }
          $query->free_result();

          $totalMembershipytd = count($dataMembershipytd);
        ?>
        <div class="count"><?php echo number_format($totalMembershipytd, 0, ',', '.') ?></div>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-group"></i> All Member / Month</span>
        <?php 
          $dataMembershipmtd = array();
          $firstDayThisMonth = date('Y-m-01 H:i:s');
          $lastDayThisMonth = date('Y-m-t H:i:s');

          $this->db->from('Business_Detail');
          $this->db->join('business_group', 'business_group.idGroup=Business_Detail.idGroup');
          $this->db->join('membership', 'membership.idBusiness=Business_Detail.idBusiness');
          $this->db->where('Business_Detail.idGroup', $this->session->userdata('idGroup'));
          $this->db->where('membership.createdAtMembership >=', $firstDayThisMonth);
          $this->db->where('membership.createdAtMembership <=', $lastDayThisMonth);
          $query = $this->db->get();
          
          if ($query->num_rows() > 0) {
              $dataMembershipmtd = $query->result(); // Use result() to get an array of objects
          }
          $query->free_result();

          $totalMembershipmtd = count($dataMembershipmtd);
        ?>
        <div class="count"><?php echo number_format($totalMembershipmtd, 0, ',', '.') ?></div>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-group"></i> All Member / Days</span>
        <?php 
          $dataMembershiptd = array();
          $firstDayThisDay = date('Y-m-d 00:00:00');
          $lastDayThisDay = date('Y-m-d 23:59:59');

          $this->db->from('Business_Detail');
          $this->db->join('business_group', 'business_group.idGroup=Business_Detail.idGroup');
          $this->db->join('membership', 'membership.idBusiness=Business_Detail.idBusiness');
          $this->db->where('Business_Detail.idGroup', $this->session->userdata('idGroup'));
          $this->db->where('membership.createdAtMembership >=', $firstDayThisDay);
          $this->db->where('membership.createdAtMembership <=', $lastDayThisDay);
          $query = $this->db->get();
          
          if ($query->num_rows() > 0) {
              $dataMembershiptd = $query->result(); // Use result() to get an array of objects
          }
          $query->free_result();

          $totalMembershiptd = count($dataMembershiptd);
        ?>
        <div class="count"><?php echo number_format($totalMembershiptd, 0, ',', '.') ?></div>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-group"></i> All Member</span>
        <?php 
          $dataMemberships = array();

          $this->db->from('Business_Detail');
          $this->db->join('business_group', 'business_group.idGroup=Business_Detail.idGroup');
          $this->db->join('membership', 'membership.idBusiness=Business_Detail.idBusiness');
          $this->db->where('Business_Detail.idGroup', $this->session->userdata('idGroup'));
          $query = $this->db->get();
          
          if ($query->num_rows() > 0) {
              $dataMemberships = $query->result(); // Use result() to get an array of objects
          }
          $query->free_result();

          $totalMemberships = count($dataMemberships);
        ?>
        <div class="count"><?php echo number_format($totalMemberships, 0, ',', '.') ?></div>
      </div>
    </div>
    <div class="row tile_count">
      <div class="col-md-3 widget widget_tally_box">
        <div class="x_panel ui-ribbon-container">
          <div class="x_content">
            <h3 class="name_title">Room Rates</h3>
            <p>Set the daily rates for your rooms</p>
            <div class="divider"></div>
            <div class="name_title">
              <a href="<?php echo base_url('cms/home/viewRateStructure') ?>" class="btn btn-success">Manage Room Rates</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 widget widget_tally_box">
        <div class="x_panel ui-ribbon-container">
          <div class="x_content">
            <h3 class="name_title">Room Allotment</h3>
            <p>Manage availability of your rooms</p>
            <div class="divider"></div>
            <div class="name_title">
              <a href="<?php echo base_url('cms/home/viewKamar/'.$this->session->userdata('idBusiness').'/') ?>" class="btn btn-success">Manage Room Allotment</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 widget widget_tally_box">
        <div class="x_panel ui-ribbon-container">
          <div class="x_content">
            <h3 class="name_title">Booking List</h3>
            <p>See all of your incoming bookings</p>
            <div class="divider"></div>
            <div class="name_title">
              <a href="<?php echo base_url('cms/home/viewBooking') ?>" class="btn btn-success">Manage Booking List</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 widget widget_tally_box">
        <div class="x_panel ui-ribbon-container">
          <div class="x_content">
            <h3 class="name_title">Payment Report</h3>
            <p>See all of your incoming invoice</p>
            <div class="divider"></div>
            <div class="name_title">
              <a href="<?php echo base_url('cms/home/viewPembayaran/'.$this->session->userdata('idBusiness').'/') ?>" class="btn btn-success">Manage Payment Report</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 widget widget_tally_box">
        <div class="x_panel ui-ribbon-container">
          <div class="x_content">
            <h3 class="name_title">Investment Hotel</h3>
            <p>Manage all investment in your hotel</p>
            <div class="divider"></div>
            <div class="name_title">
              <a href="<?php echo base_url('cms/home/viewInvestment/'.$this->session->userdata('idBusiness').'/') ?>" class="btn btn-success">Manage Investment Hotel</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <?php
        $business = array();
        $this->db->from('Business_Detail');
        $this->db->join('business_group', 'business_group.idGroup=Business_Detail.idGroup');
        $this->db->where('Business_Detail.typeBusiness !=', 'OFFICE');
        $this->db->where('Business_Detail.idGroup', $this->session->userdata('idGroup'));
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
          foreach ($query->result() as $row) {
            $business[] = $row;
          }
        }
        $query->free_result(); 
        foreach($business as $row) {
      ?>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2>ROOM REVENUE <?php echo $row->Name ?></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li>
                  <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                  </a>
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
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Transaction</th>
                    <th colspan="3">Actual</th>
                    <th colspan="2">Budget</th>
                    <th colspan="2">Forecast</th>
                  </tr>
                  <tr>
                    <th>Description</th>
                    <th>Today</th>
                    <th>MTD</th>
                    <th>YTD</th>
                    <th>MTD</th>
                    <th>YTD</th>
                    <th>MTD</th>
                    <th>YTD</th>
                  </tr>
                </thead>
                <tbody>
                  <tr></tr>
                  <tr>
                    <td>FIT</td>
                    <!-- ACTUAL -->
                    <?php 
                      $totalFITtoday = 0;
                      $dataFITtoday = array();
                      $this->db->from('booking');
                      $this->db->where('segmentBooking', 'FIT');
                      $this->db->where('arrivalBooking', date('Y-m-d'));
                      $this->db->where('idBusiness', $row->idBusiness);
                      $query = $this->db->get();
                      
                      if ($query->num_rows() > 0) {
                        $dataFITtoday = $query->result(); // Use result() to get an array of objects
                      }
                      $query->free_result();
                      
                      foreach($dataFITtoday as $row) {
                        $totalFITtoday += $row->totalrateBooking;
                      }
                    ?>
                    <td><?php echo number_format($totalFITtoday, 0, ',', '.') ?></td>
                    <?php
                      $totalFITmtd = 0;
                      $dataFITmtd = array();
                      $firstDayThisMonth = date('Y-m-01');
                      $lastDayThisMonth = date('Y-m-t');

                      $this->db->from('booking');
                      $this->db->where('segmentBooking', 'FIT');
                      $this->db->where('arrivalBooking >=', $firstDayThisMonth);
                      $this->db->where('arrivalBooking <=', $lastDayThisMonth);
                      $this->db->where('idBusiness', $row->idBusiness);
                      $query = $this->db->get();
                      
                      if ($query->num_rows() > 0) {
                        $dataFITmtd = $query->result(); // Use result() to get an array of objects
                      }
                      $query->free_result();
                      
                      foreach($dataFITmtd as $row) {
                        $totalFITmtd += $row->totalrateBooking;
                      }
                    ?>
                    <td><?php echo number_format($totalFITmtd, 0, ',', '.') ?></td>

                    <?php
                      $totalFITytd = 0;
                      $dataFITytd = array();
                      $firstDayThisYear = date('Y-01-01');
                      $lastDayThisYear = date('Y-12-t');
                      
                      $this->db->from('booking');
                      $this->db->where('segmentBooking', 'FIT');
                      $this->db->where('arrivalBooking >=', $firstDayThisYear);
                      $this->db->where('arrivalBooking <=', $lastDayThisYear);
                      $this->db->where('idBusiness', $row->idBusiness);
                      $query = $this->db->get();
                      
                      if ($query->num_rows() > 0) {
                        $dataFITytd = $query->result(); // Use result() to get an array of objects
                      }
                      $query->free_result();
                      
                      foreach($dataFITytd as $row) {
                        $totalFITytd += $row->totalrateBooking;
                      }
                    ?>
                    <td><?php echo number_format($totalFITytd, 0, ',', '.') ?></td>

                    <!-- BUDGET -->
                    <td>0</td>
                    <td>0</td>
                    <!-- FORECAST -->
                    <td>0</td>
                    <td>0</td>
                  </tr>
                  <tr>
                    <td>OTA</td>
                    <!-- ACTUAL -->
                    <?php 
                      $totalOTAtoday = 0;
                      $dataOTAtoday = array();
                      $this->db->from('booking');
                      $this->db->where('segmentBooking', 'OTA');
                      $this->db->where('arrivalBooking', date('Y-m-d'));
                      $this->db->where('idBusiness', $row->idBusiness);
                      $query = $this->db->get();
                      
                      if ($query->num_rows() > 0) {
                        $dataOTAtoday = $query->result(); // Use result() to get an array of objects
                      }
                      $query->free_result();
                      
                      foreach($dataOTAtoday as $row) {
                        $totalOTAtoday += $row->totalrateBooking;
                      }
                    ?>
                    <td><?php echo number_format($totalOTAtoday, 0, ',', '.') ?></td>
                    <?php
                      $totalOTAmtd = 0;
                      $dataOTAmtd = array();
                      $firstDayThisMonth = date('Y-m-01');
                      $lastDayThisMonth = date('Y-m-t');

                      $this->db->from('booking');
                      $this->db->where('segmentBooking', 'OTA');
                      $this->db->where('arrivalBooking >=', $firstDayThisMonth);
                      $this->db->where('arrivalBooking <=', $lastDayThisMonth);
                      $this->db->where('idBusiness', $row->idBusiness);
                      $query = $this->db->get();
                      
                      if ($query->num_rows() > 0) {
                        $dataOTAmtd = $query->result(); // Use result() to get an array of objects
                      }
                      $query->free_result();
                      
                      foreach($dataOTAmtd as $row) {
                        $totalOTAmtd += $row->totalrateBooking;
                      }
                    ?>
                    <td><?php echo number_format($totalOTAmtd, 0, ',', '.') ?></td>

                    <?php
                      $totalOTAytd = 0;
                      $dataOTAytd = array();
                      $firstDayThisYear = date('Y-01-01');
                      $lastDayThisYear = date('Y-12-t');
                      
                      $this->db->from('booking');
                      $this->db->where('segmentBooking', 'OTA');
                      $this->db->where('arrivalBooking >=', $firstDayThisYear);
                      $this->db->where('arrivalBooking <=', $lastDayThisYear);
                      $this->db->where('idBusiness', $row->idBusiness);
                      $query = $this->db->get();
                      
                      if ($query->num_rows() > 0) {
                        $dataOTAytd = $query->result(); // Use result() to get an array of objects
                      }
                      $query->free_result();
                      
                      foreach($dataOTAytd as $row) {
                        $totalOTAytd += $row->totalrateBooking;
                      }
                    ?>
                    <td><?php echo number_format($totalOTAytd, 0, ',', '.') ?></td>

                    <!-- BUDGET -->
                    <td>0</td>
                    <td>0</td>
                    <!-- FORECAST -->
                    <td>0</td>
                    <td>0</td>
                  </tr>
                  <tr>
                    <td><strong>TOTAL ROOM REVENUE</strong></td>
                    <!-- ACTUAL -->
                    <?php 
                      $totalRevenueToday = $totalFITtoday + $totalOTAtoday;
                      $totalRevenueMtd = $totalFITmtd + $totalOTAmtd;
                      $totalRevenueYtd = $totalFITytd + $totalOTAytd;
                    ?>
                    <td><?php echo number_format($totalRevenueToday, 0, ',', '.') ?></td>
                    <td><?php echo number_format($totalRevenueMtd, 0, ',', '.') ?></td>
                    <td><?php echo number_format($totalRevenueYtd, 0, ',', '.') ?></td>
                    <!-- BUDGET -->
                    <td>0</td>
                    <td>0</td>
                    <!-- FORECAST -->
                    <td>0</td>
                    <td>0</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  <?php } ?>
  <?php
    if($this->session->userdata('level') == 3) {
  ?>
    <div class="row tile_count">
      <?php
        $business = array();
        $this->db->from('Business_Detail');
        $this->db->where('typeBusiness !=', 'OFFICE');
        $this->db->where('idBusiness', $this->session->userdata('idBusiness'));
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
          foreach ($query->result() as $row) {
            $business[] = $row;
          }
        }
        $query->free_result(); 
        foreach($business as $row) {
      ?>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-building"></i> <?php echo $row->Name ?></span>
          <?php 
            $revenue = 0;
            $dataTSH = array();
            $this->db->from('booking');
            $this->db->where('idBusiness', $row->idBusiness);
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
              $dataTSH = $query->result(); // Use result() to get an array of objects
            }
            $query->free_result();
            
            foreach($dataTSH as $row) {
              $revenue += $row->totalrateBooking;
            }
          ?>
          <div class="count"><?php echo number_format($revenue, 0, ',', '.') ?></div>
        </div>
      <?php } ?>
    </div>
    <div class="row tile_count">
      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-group"></i> All Member / Year</span>
        <?php 
          $dataMembershipytd = array();
          $firstDayThisYear = date('Y-01-01 H:i:s');
          $lastDayThisYear = date('Y-12-t H:i:s');

          $this->db->from('Business_Detail');
          $this->db->join('membership', 'membership.idBusiness=Business_Detail.idBusiness');
          $this->db->where('Business_Detail.idBusiness', $this->session->userdata('idBusiness'));
          $this->db->where('membership.createdAtMembership >=', $firstDayThisYear);
          $this->db->where('membership.createdAtMembership <=', $lastDayThisYear);
          $query = $this->db->get();
          
          if ($query->num_rows() > 0) {
              $dataMembershipytd = $query->result(); // Use result() to get an array of objects
          }
          $query->free_result();

          $totalMembershipytd = count($dataMembershipytd);
        ?>
        <div class="count"><?php echo number_format($totalMembershipytd, 0, ',', '.') ?></div>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-group"></i> All Member / Month</span>
        <?php 
          $dataMembershipmtd = array();
          $firstDayThisMonth = date('Y-m-01 H:i:s');
          $lastDayThisMonth = date('Y-m-t H:i:s');

          $this->db->from('Business_Detail');
          $this->db->join('membership', 'membership.idBusiness=Business_Detail.idBusiness');
          $this->db->where('Business_Detail.idBusiness', $this->session->userdata('idBusiness'));
          $this->db->where('membership.createdAtMembership >=', $firstDayThisMonth);
          $this->db->where('membership.createdAtMembership <=', $lastDayThisMonth);
          $query = $this->db->get();
          
          if ($query->num_rows() > 0) {
              $dataMembershipmtd = $query->result(); // Use result() to get an array of objects
          }
          $query->free_result();

          $totalMembershipmtd = count($dataMembershipmtd);
        ?>
        <div class="count"><?php echo number_format($totalMembershipmtd, 0, ',', '.') ?></div>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-group"></i> All Member / Days</span>
        <?php 
          $dataMembershiptd = array();
          $firstDayThisDay = date('Y-m-d 00:00:00');
          $lastDayThisDay = date('Y-m-d 23:59:59');

          $this->db->from('Business_Detail');
          $this->db->join('membership', 'membership.idBusiness=Business_Detail.idBusiness');
          $this->db->where('Business_Detail.idBusiness', $this->session->userdata('idBusiness'));
          $this->db->where('membership.createdAtMembership >=', $firstDayThisDay);
          $this->db->where('membership.createdAtMembership <=', $lastDayThisDay);
          $query = $this->db->get();
          
          if ($query->num_rows() > 0) {
              $dataMembershiptd = $query->result(); // Use result() to get an array of objects
          }
          $query->free_result();

          $totalMembershiptd = count($dataMembershiptd);
        ?>
        <div class="count"><?php echo number_format($totalMembershiptd, 0, ',', '.') ?></div>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-group"></i> All Member</span>
        <?php 
          $dataMemberships = array();

          $this->db->from('Business_Detail');
          $this->db->join('membership', 'membership.idBusiness=Business_Detail.idBusiness');
          $this->db->where('Business_Detail.idBusiness', $this->session->userdata('idBusiness'));
          $query = $this->db->get();
          
          if ($query->num_rows() > 0) {
              $dataMemberships = $query->result(); // Use result() to get an array of objects
          }
          $query->free_result();

          $totalMemberships = count($dataMemberships);
        ?>
        <div class="count"><?php echo number_format($totalMemberships, 0, ',', '.') ?></div>
      </div>
    </div>
    <div class="row tile_count">
      <div class="col-md-3 widget widget_tally_box">
        <div class="x_panel ui-ribbon-container">
          <div class="x_content">
            <h3 class="name_title">Room Rates</h3>
            <p>Set the daily rates for your rooms</p>
            <div class="divider"></div>
            <div class="name_title">
              <a href="<?php echo base_url('cms/home/viewRateStructure') ?>" class="btn btn-success">Manage Room Rates</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 widget widget_tally_box">
        <div class="x_panel ui-ribbon-container">
          <div class="x_content">
            <h3 class="name_title">Room Allotment</h3>
            <p>Manage availability of your rooms</p>
            <div class="divider"></div>
            <div class="name_title">
              <a href="<?php echo base_url('cms/home/viewKamar/'.$this->session->userdata('idBusiness').'/') ?>" class="btn btn-success">Manage Room Allotment</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 widget widget_tally_box">
        <div class="x_panel ui-ribbon-container">
          <div class="x_content">
            <h3 class="name_title">Booking List</h3>
            <p>See all of your incoming bookings</p>
            <div class="divider"></div>
            <div class="name_title">
              <a href="<?php echo base_url('cms/home/viewBooking') ?>" class="btn btn-success">Manage Booking List</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 widget widget_tally_box">
        <div class="x_panel ui-ribbon-container">
          <div class="x_content">
            <h3 class="name_title">Payment Report</h3>
            <p>See all of your incoming invoice</p>
            <div class="divider"></div>
            <div class="name_title">
              <a href="<?php echo base_url('cms/home/viewPembayaran/'.$this->session->userdata('idBusiness').'/') ?>" class="btn btn-success">Manage Payment Report</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 widget widget_tally_box">
        <div class="x_panel ui-ribbon-container">
          <div class="x_content">
            <h3 class="name_title">Investment Hotel</h3>
            <p>Manage all investment in your hotel</p>
            <div class="divider"></div>
            <div class="name_title">
              <a href="<?php echo base_url('cms/home/viewInvestment/'.$this->session->userdata('idBusiness').'/') ?>" class="btn btn-success">Manage Investment Hotel</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <?php
        $business = array();
        $this->db->from('Business_Detail');
        $this->db->where('Business_Detail.typeBusiness !=', 'OFFICE');
        $this->db->where('Business_Detail.idBusiness', $this->session->userdata('idBusiness'));
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
          foreach ($query->result() as $row) {
            $business[] = $row;
          }
        }
        $query->free_result(); 
        foreach($business as $row) {
      ?>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2>ROOM REVENUE <?php echo $row->Name ?></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li>
                  <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                  </a>
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
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Transaction</th>
                    <th colspan="3">Actual</th>
                    <th colspan="2">Budget</th>
                    <th colspan="2">Forecast</th>
                  </tr>
                  <tr>
                    <th>Description</th>
                    <th>Today</th>
                    <th>MTD</th>
                    <th>YTD</th>
                    <th>MTD</th>
                    <th>YTD</th>
                    <th>MTD</th>
                    <th>YTD</th>
                  </tr>
                </thead>
                <tbody>
                  <tr></tr>
                  <tr>
                    <td>FIT</td>
                    <!-- ACTUAL -->
                    <?php 
                      $totalFITtoday = 0;
                      $dataFITtoday = array();
                      $this->db->from('booking');
                      $this->db->where('segmentBooking', 'FIT');
                      $this->db->where('arrivalBooking', date('Y-m-d'));
                      $this->db->where('idBusiness', $row->idBusiness);
                      $query = $this->db->get();
                      
                      if ($query->num_rows() > 0) {
                        $dataFITtoday = $query->result(); // Use result() to get an array of objects
                      }
                      $query->free_result();
                      
                      foreach($dataFITtoday as $row) {
                        $totalFITtoday += $row->totalrateBooking;
                      }
                    ?>
                    <td><?php echo number_format($totalFITtoday, 0, ',', '.') ?></td>
                    <?php
                      $totalFITmtd = 0;
                      $dataFITmtd = array();
                      $firstDayThisMonth = date('Y-m-01');
                      $lastDayThisMonth = date('Y-m-t');

                      $this->db->from('booking');
                      $this->db->where('segmentBooking', 'FIT');
                      $this->db->where('arrivalBooking >=', $firstDayThisMonth);
                      $this->db->where('arrivalBooking <=', $lastDayThisMonth);
                      $this->db->where('idBusiness', $row->idBusiness);
                      $query = $this->db->get();
                      
                      if ($query->num_rows() > 0) {
                        $dataFITmtd = $query->result(); // Use result() to get an array of objects
                      }
                      $query->free_result();
                      
                      foreach($dataFITmtd as $row) {
                        $totalFITmtd += $row->totalrateBooking;
                      }
                    ?>
                    <td><?php echo number_format($totalFITmtd, 0, ',', '.') ?></td>

                    <?php
                      $totalFITytd = 0;
                      $dataFITytd = array();
                      $firstDayThisYear = date('Y-01-01');
                      $lastDayThisYear = date('Y-12-t');
                      
                      $this->db->from('booking');
                      $this->db->where('segmentBooking', 'FIT');
                      $this->db->where('arrivalBooking >=', $firstDayThisYear);
                      $this->db->where('arrivalBooking <=', $lastDayThisYear);
                      $this->db->where('idBusiness', $row->idBusiness);
                      $query = $this->db->get();
                      
                      if ($query->num_rows() > 0) {
                        $dataFITytd = $query->result(); // Use result() to get an array of objects
                      }
                      $query->free_result();
                      
                      foreach($dataFITytd as $row) {
                        $totalFITytd += $row->totalrateBooking;
                      }
                    ?>
                    <td><?php echo number_format($totalFITytd, 0, ',', '.') ?></td>

                    <!-- BUDGET -->
                    <td>0</td>
                    <td>0</td>
                    <!-- FORECAST -->
                    <td>0</td>
                    <td>0</td>
                  </tr>
                  <tr>
                    <td>OTA</td>
                    <!-- ACTUAL -->
                    <?php 
                      $totalOTAtoday = 0;
                      $dataOTAtoday = array();
                      $this->db->from('booking');
                      $this->db->where('segmentBooking', 'OTA');
                      $this->db->where('arrivalBooking', date('Y-m-d'));
                      $this->db->where('idBusiness', $row->idBusiness);
                      $query = $this->db->get();
                      
                      if ($query->num_rows() > 0) {
                        $dataOTAtoday = $query->result(); // Use result() to get an array of objects
                      }
                      $query->free_result();
                      
                      foreach($dataOTAtoday as $row) {
                        $totalOTAtoday += $row->totalrateBooking;
                      }
                    ?>
                    <td><?php echo number_format($totalOTAtoday, 0, ',', '.') ?></td>
                    <?php
                      $totalOTAmtd = 0;
                      $dataOTAmtd = array();
                      $firstDayThisMonth = date('Y-m-01');
                      $lastDayThisMonth = date('Y-m-t');

                      $this->db->from('booking');
                      $this->db->where('segmentBooking', 'OTA');
                      $this->db->where('arrivalBooking >=', $firstDayThisMonth);
                      $this->db->where('arrivalBooking <=', $lastDayThisMonth);
                      $this->db->where('idBusiness', $row->idBusiness);
                      $query = $this->db->get();
                      
                      if ($query->num_rows() > 0) {
                        $dataOTAmtd = $query->result(); // Use result() to get an array of objects
                      }
                      $query->free_result();
                      
                      foreach($dataOTAmtd as $row) {
                        $totalOTAmtd += $row->totalrateBooking;
                      }
                    ?>
                    <td><?php echo number_format($totalOTAmtd, 0, ',', '.') ?></td>

                    <?php
                      $totalOTAytd = 0;
                      $dataOTAytd = array();
                      $firstDayThisYear = date('Y-01-01');
                      $lastDayThisYear = date('Y-12-t');
                      
                      $this->db->from('booking');
                      $this->db->where('segmentBooking', 'OTA');
                      $this->db->where('arrivalBooking >=', $firstDayThisYear);
                      $this->db->where('arrivalBooking <=', $lastDayThisYear);
                      $this->db->where('idBusiness', $row->idBusiness);
                      $query = $this->db->get();
                      
                      if ($query->num_rows() > 0) {
                        $dataOTAytd = $query->result(); // Use result() to get an array of objects
                      }
                      $query->free_result();
                      
                      foreach($dataOTAytd as $row) {
                        $totalOTAytd += $row->totalrateBooking;
                      }
                    ?>
                    <td><?php echo number_format($totalOTAytd, 0, ',', '.') ?></td>

                    <!-- BUDGET -->
                    <td>0</td>
                    <td>0</td>
                    <!-- FORECAST -->
                    <td>0</td>
                    <td>0</td>
                  </tr>
                  <tr>
                    <td><strong>TOTAL ROOM REVENUE</strong></td>
                    <!-- ACTUAL -->
                    <?php 
                      $totalRevenueToday = $totalFITtoday + $totalOTAtoday;
                      $totalRevenueMtd = $totalFITmtd + $totalOTAmtd;
                      $totalRevenueYtd = $totalFITytd + $totalOTAytd;
                    ?>
                    <td><?php echo number_format($totalRevenueToday, 0, ',', '.') ?></td>
                    <td><?php echo number_format($totalRevenueMtd, 0, ',', '.') ?></td>
                    <td><?php echo number_format($totalRevenueYtd, 0, ',', '.') ?></td>
                    <!-- BUDGET -->
                    <td>0</td>
                    <td>0</td>
                    <!-- FORECAST -->
                    <td>0</td>
                    <td>0</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>ROOM DAILY <?php echo $this->session->userdata('business') ?></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li>
                <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
                </a>
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
            <div id="calendar-fo"></div>
            <?php foreach ($alltype as $row) { ?>
              <?php $modal_id = 'modal_' . strtolower(str_replace(' ', '_', $row->ketKamar)); ?>
              <div id="<?php echo $modal_id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title" id="start<?php echo $modal_id; ?>"></h4>
                      <div id="formattedDateDisplay<?php echo $modal_id; ?>"></div>
                    </div>
                    <div class="modal-body">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Type Room</th>
                            <th>Available</th>
                            <!-- <th>Occupied</th> -->
                            <th>Pax</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $datarroms = array();
                            $this->db->from('Business_Detail');
                            $this->db->join('kamar', 'kamar.idBusiness=Business_Detail.idBusiness');
                            $this->db->where('Business_Detail.idBusiness', $row->idBusiness);
                            $query = $this->db->get();
                            if ($query->num_rows() > 0)
                            {
                              foreach ($query->result() as $row)
                              {
                                $datarroms[] = $row;
                              }
                            }
                            $query->free_result(); 
                          ?>
                          <?php 
                            foreach($datarroms as $row) {
                          ?>
                          <tr>
                            <td id="ketKamar_<?php echo $modal_id; ?>_<?php echo $row->idKamar; ?>"></td>
                            <td id="capacityMeeting_<?php echo $modal_id; ?>_<?php echo $row->idKamar; ?>"></td>
                            <!-- <td id="soldKamar_<?php echo $modal_id; ?>_<?php echo $row->idKamar; ?>"></td> -->
                            <td id="paxBooking_<?php echo $modal_id; ?>_<?php echo $row->idKamar; ?>"></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
            <div id="fc_edit"></div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  <script type="text/javascript">
    // Check if the browser supports the getUserMedia API
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
      navigator.mediaDevices.getUserMedia({ video: true })
        .then(function (stream) {
          // User granted camera permission
          console.log('Camera permission granted');
          // You can use the 'stream' object to do something with the camera feed if needed
        })
        .catch(function (error) {
          // User denied camera permission or an error occurred
          console.error('Camera permission denied or error:', error);
        });
    } else {
      console.error('getUserMedia not supported on this browser');
    }
  </script>
  <hr>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_content">
          <div id="calendar-fo"></div>
          <?php foreach ($alltype as $row) { ?>
            <?php $modal_id = 'modal_' . strtolower(str_replace(' ', '_', $row->ketKamar)); ?>
            <div id="<?php echo $modal_id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="start<?php echo $modal_id; ?>"></h4>
                    <div id="formattedDateDisplay<?php echo $modal_id; ?>"></div>
                  </div>
                  <div class="modal-body">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Type Room</th>
                          <th>Available</th>
                          <!-- <th>Occupied</th> -->
                          <th>Pax</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $datarroms = array();
                          $this->db->from('Business_Detail');
                          $this->db->join('kamar', 'kamar.idBusiness=Business_Detail.idBusiness');
                          $this->db->where('Business_Detail.idBusiness', $row->idBusiness);
                          $query = $this->db->get();
                          if ($query->num_rows() > 0)
                          {
                            foreach ($query->result() as $row)
                            {
                              $datarroms[] = $row;
                            }
                          }
                          $query->free_result(); 
                        ?>
                        <?php 
                          foreach($datarroms as $row) {
                        ?>
                        <tr>
                          <td id="ketKamar_<?php echo $modal_id; ?>_<?php echo $row->idKamar; ?>"></td>
                          <td id="capacityMeeting_<?php echo $modal_id; ?>_<?php echo $row->idKamar; ?>"></td>
                          <!-- <td id="soldKamar_<?php echo $modal_id; ?>_<?php echo $row->idKamar; ?>"></td> -->
                          <td id="paxBooking_<?php echo $modal_id; ?>_<?php echo $row->idKamar; ?>"></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
          <div id="fc_edit"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->