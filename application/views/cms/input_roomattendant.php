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
<style type="text/css">
  .btn.btn-app {
    position: relative;
    padding: 10px 10px;
    margin: 0 0 10px 10px;
    min-width: 40px;
    height: 40px;
    box-shadow: none;
    border-radius: 0;
    text-align: center;
    color: #666;
    border: 1px solid #ddd;
    background-color: #fafafa;
    font-size: 12px;
  }
</style>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Room Attendant</h3>
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
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>View Room Attendant</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
            <li class="nav-item active">
              <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true">1st Floor</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="true">2nd Floor</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab" aria-controls="third" aria-selected="false">3rd Floor</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="fourth-tab" data-toggle="tab" href="#fourth" role="tab" aria-controls="fourth" aria-selected="false">4th Floor</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active in" id="first" role="tabpanel" aria-labelledby="first-tab">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Kamar</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    $displayed_name = array(); // Array to keep track of displayed invoices
                    foreach($roomattendant_first as $row) {
                      if (!in_array($row->nmNumber, $displayed_name)) {
                      // Add the invoice to the list of displayed invoices
                      $displayed_name[] = $row->nmNumber;
                  ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row->nmNumber ?></td>
                    <td style="background: darkblue;color: white;"><?php echo $row->ketNumber ?></td>
                  </tr>
                  <?php } } ?>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade in" id="second" role="tabpanel" aria-labelledby="second-tab">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Kamar</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    $displayed_name = array(); // Array to keep track of displayed invoices
                    foreach($roomattendant_second as $row) {
                      if (!in_array($row->nmNumber, $displayed_name)) {
                      // Add the invoice to the list of displayed invoices
                      $displayed_name[] = $row->nmNumber;
                  ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row->nmNumber ?></td>
                    <td style="background: darkblue;color: white;"><?php echo $row->ketNumber ?></td>
                  </tr>
                  <?php } } ?>
                </tbody>
              </table>
              <!-- Modal Room Attendant -->
              <div class="modal fade" id="odroomattendantModal" tabindex="-1" role="dialog" aria-labelledby="odroomattendantModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h2 class="modal-title" id="odroomattendantModalLabel">Date : </h2>
                      <h5 class="modal-title" id="odroomattendantModalLabel">Room Attendant : </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <table border="1">
                          <tr>
                            <th class="vertical-text">comb</th>
                            <th class="vertical-text">cottonbud</th>
                            <th class="vertical-text">dentalkit</th>
                            <th class="vertical-text">handsoap</th>
                            <th class="vertical-text">bedpad</th>
                            <th class="vertical-text">sewingkit</th>
                            <th class="vertical-text">shampoo</th>
                            <th class="vertical-text">showercap</th>
                            <th class="vertical-text">tissuebox</th>
                            <th class="vertical-text">tissueroll</th>
                            <th class="vertical-text">soap</th>
                            <th class="vertical-text">disposalbag</th>
                            <th class="vertical-text">sleeper</th>
                            <th class="vertical-text">laundry</th>
                            <th class="vertical-text">coaster</th>
                            <th class="vertical-text">memopad</th>
                            <th class="vertical-text">pencil</th>
                            <th class="vertical-text">guestcomment</th>
                            <th class="vertical-text">compliment</th>
                            <th class="vertical-text">bathmat</th>
                            <th class="vertical-text">bathtowel</th>
                            <th class="vertical-text">bedsheet</th>
                            <th class="vertical-text">duvetcover</th>
                            <th class="vertical-text">facetowel</th>
                            <th class="vertical-text">handtowel</th>
                            <th class="vertical-text">pillowcase</th>
                            <th class="vertical-text">sheetdouble</th>
                            <th class="vertical-text">sheetsingle</th>
                            <th class="vertical-text">bedcover</th>
                            <th class="vertical-text">innerduvet</th>
                          </tr>
                          <tr>
                            <td>comb</td>
                            <td>cottonbud</td>
                            <td>dentalkit</td>
                            <td>handsoap</td>
                            <td>bedpad</td>
                            <td>sewingkit</td>
                            <td>shampoo</td>
                            <td>showercap</td>
                            <td>tissuebox</td>
                            <td>tissueroll</td>
                            <td>soap</td>
                            <td>disposalbag</td>
                            <td>sleeper</td>
                            <td>laundry</td>
                            <td>coaster</td>
                            <td>memopad</td>
                            <td>pencil</td>
                            <td>guestcomment</td>
                            <td>compliment</td>
                            <td>bathmat</td>
                            <td>bathtowel</td>
                            <td>bedsheet</td>
                            <td>duvetcover</td>
                            <td>facetowel</td>
                            <td>handtowel</td>
                            <td>pillowcase</td>
                            <td>sheetdouble</td>
                            <td>sheetsingle</td>
                            <td>bedcover</td>
                            <td>innerduvet</td>
                          </tr>
                          <!-- Add more rows as needed -->
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <style>
                .vertical-text {
                  writing-mode: vertical-rl; /* Menampilkan teks secara vertikal dari atas ke bawah */
                  text-orientation: upright; /* Menjaga orientasi teks */
                }
              </style>
              <!-- Print button for modal content -->
              <button onclick="printModalContent()">Print Modal Content</button>
              <script>
                // Function to open print dialog for modal content
                function printModalContent() {
                    var modalContent = document.querySelector('.modal-content').innerHTML;
                    var printWindow = window.open('', '_blank');
                    printWindow.document.write('<html><head><title>Print Modal Content</title></head><body>');
                    printWindow.document.write(modalContent);
                    printWindow.document.write('</body></html>');
                    printWindow.document.close();
                    printWindow.print();
                }

                // Get the modal
                var modal = document.getElementById('myModal');

                // Get the close button
                var closeBtn = document.getElementsByClassName("close")[0];

                // When the user clicks the close button, close the modal
                closeBtn.onclick = function() {
                    modal.style.display = "none";
                }

                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            </script>
            </div>
            <div class="tab-pane fade in" id="third" role="tabpanel" aria-labelledby="third-tab">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Kamar</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    $displayed_name = array(); // Array to keep track of displayed invoices
                    foreach($roomattendant_third as $row) {
                      if (!in_array($row->nmNumber, $displayed_name)) {
                      // Add the invoice to the list of displayed invoices
                      $displayed_name[] = $row->nmNumber;
                  ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row->nmNumber ?></td>
                    <td style="background: darkblue;color: white;"><?php echo $row->ketNumber ?></td>
                  </tr>
                  <?php } } ?>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade in" id="fourth" role="tabpanel" aria-labelledby="fourth-tab">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Kamar</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    $displayed_name = array(); // Array to keep track of displayed invoices
                    foreach($roomattendant_fourth as $row) {
                      if (!in_array($row->nmNumber, $displayed_name)) {
                      // Add the invoice to the list of displayed invoices
                      $displayed_name[] = $row->nmNumber;
                  ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row->nmNumber ?></td>
                    <td style="background: darkblue;color: white;"><?php echo $row->ketNumber ?></td>
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
</div>
<!-- /page content -->