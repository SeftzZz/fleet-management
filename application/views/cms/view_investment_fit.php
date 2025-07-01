<!-- page content -->
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="x_panel">
    <div class="x_title">
      <h2>List Data Investment</h2>
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
      <table class="table table-bordered">
        <thead>              
          <tr>
            <style type="text/css">
              body {
                background: #f7f7f7;
              }
            </style>
            <th>SEGMENT</th>
            <th>Total Debit</th>
            <th>Total Agreement Commision</th>
            <th>Date Investment</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr></tr>
          <tr>
            <td>FIT</td>
            <?php
              $fit = array();
              $this->db->from('investment');
              $this->db->where('statusInvestment', 'on');
              $this->db->where('nmSegment', 'FIT');
              $this->db->where('idBusiness', $this->session->userdata('idBusiness'));
              $query = $this->db->get();
              if ($query->num_rows() > 0) {
                  $fit = $query->row();
              }
              $query->free_result();
            ?>
            <div class="input-group">
              <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertInvestment') ?>" class="form-horizontal form-label-left">
                <td style="width: 10px;">
                  <input type="hidden" name="segmentInvestment" value="FIT">
                  <input type="text" name="debitInvestment" id="priceInput" style="width: 20vh;" required="required" class="form-control" value="">
                </td>
                <td style="width: 10px;">
                  <input type="text" name="agreementInvestment" id="priceInputAgreement" style="width: 20vh;" required="required" class="form-control" value="">
                </td>
                <td style="width: 10px;">
                  <input type="date" name="dateInvestment" style="width: 20vh;" class="form-control" value="<?php echo date('Y-m-d') ?>">
                </td>
                <td style="width: 10px;">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-success btn-block" value="save">
                  </span>
                </td>
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
                    var formattedValue = formatNumberWithCommasAndDecimalsRO(numericValue);

                    // Update the input value with the formatted value
                    inputElement.value = formattedValue;
                  });

                  function formatNumberWithCommasAndDecimalsRO(number) {
                    var parts = number.split(".");
                    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    return parts.join(".");
                  }
                </script>
                <script>
                  var inputElementAgreement = document.getElementById("priceInputAgreement");

                  inputElementAgreement.addEventListener("input", function() {
                    var inputValueAgreement = inputElementAgreement.value;

                    // Remove non-numeric characters
                    var numericValue = inputValueAgreement.replace(/[^0-9.]/g, '');

                    const doubleNumber = Number(numericValue);

                    console.log(doubleNumber);

                    // Set the value of the input to doubleNumber
                    inputElementAgreement.value = doubleNumber;

                    // Format the value with commas and two decimal places
                    var formattedValue = formatNumberWithCommasAndDecimalsRO(numericValue);

                    // Update the input value with the formatted value
                    inputElementAgreement.value = formattedValue;
                  });

                  function formatNumberWithCommasAndDecimalsRO(number) {
                    var parts = number.split(".");
                    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    return parts.join(".");
                  }
                </script>
              </form>
            </div>
          </tr>
        </tbody>
      </table>
      </div>
      
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Description</th>
            <th>Segment</th>
            <th>Total Agreement Commision</th>
            <th>Unit Business</th>
            <th>Total Debit</th>
            <th>Total Kredit</th>
            <th>Total Balance</th>
            <th>Status Investment</th>
            <th>Tanggal Investment</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            foreach($investments as $row) {
          ?>
          <tr>
            <td><?php echo $row->idInvestment ?></td>
            <td><?php echo $row->ketInvestment ?></td>
            <td><?php echo $row->nmSegment ?></td>
            <td><?php echo 'IDR ' . number_format($row->agreementInvestment, 0, ',', '.'); ?></td>
            <td><?php echo $row->Name ?></td>
            <td><?php echo 'IDR ' . number_format($row->debitInvestment, 0, ',', '.'); ?></td>
            <td><?php echo 'IDR ' . number_format($row->kreditInvestment, 0, ',', '.'); ?></td>
            <td><?php echo 'IDR ' . number_format($row->totalInvestment, 0, ',', '.'); ?></td>
            <td><?php echo $row->statusInvestment ?></td>
            <td><?php echo $row->createdAtInvestment ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- /page content -->