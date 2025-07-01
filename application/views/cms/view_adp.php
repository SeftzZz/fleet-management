<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>List Data ADP</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li>
                <a class="collapse-link">
                  <i class="fa fa-chevron-up" style="color: red;"></i>
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
            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
              <li class="nav-item active">
                <a class="nav-link active" id="adp-fit-tab" data-toggle="tab" href="#adp-fit" role="tab" aria-controls="adp-fit" aria-selected="true">FIT</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="adp-ota-tab" data-toggle="tab" href="#adp-ota" role="tab" aria-controls="adp-ota" aria-selected="true">OTA</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade active in" id="adp-fit" role="tabpanel" aria-labelledby="adp-fit-tab">
                <!-- Diagram Data ADP FIT ACCUMULATION -->
                <br />
                <div id="chart_plot_adp_accumulation" class="demo-placeholder"></div>
                <!-- Diagram Data ADP FIT PER DAY -->
                <br />
                <!-- <div id="chart_plot_adp" class="demo-placeholder"></div> -->
                <!-- ROOM REVENUE FIT -->
                <br />
                <h3> ROOM REVENUE </h3>
                <div class="row">
                  <div class="col-md-8">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Transaction</th>
                          <th colspan="3">Actual</th>
                        </tr>
                        <tr>
                          <th>Description</th>
                          <th>Today</th>
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
                            $this->db->where('idBusiness', $idBusiness);
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
                            $this->db->join('invoice', 'invoice.idBooking=booking.idBooking', 'left');
                            $this->db->where('invoice.idBusiness', $idBusiness);
                            $this->db->where('invoice.createdAtInvoice >=', $firstDayThisMonth);
                            $this->db->where('invoice.createdAtInvoice <=', $lastDayThisMonth);
                            $this->db->where('invoice.adpInvoice', 1); //khusus FIT
                            $this->db->where('booking.segmentBooking', 'FIT'); //khusus FIT
                            $this->db->order_by('invoice.createdAtInvoice', 'DESC');
                            $query = $this->db->get();
                            
                            if ($query->num_rows() > 0) {
                              $dataFITmtd = $query->result(); // Use result() to get an array of objects
                            }
                            $query->free_result();
                            
                            foreach($dataFITmtd as $row) {
                              $totalFITmtd += $row->priceInvoice;
                            }
                          ?>
                          <td><?php echo number_format($totalFITmtd, 0, ',', '.') ?></td>

                          <?php
                            $totalFITytd = 0;
                            $dataFITytd = array();
                            $firstDayThisYear = date('Y-01-01');
                            $lastDayThisYear = date('Y-12-t');
                            
                            $this->db->from('booking');
                            $this->db->join('invoice', 'invoice.idBooking=booking.idBooking', 'left');
                            $this->db->where('invoice.idBusiness', $idBusiness);
                            $this->db->where('invoice.createdAtInvoice >=', $firstDayThisYear);
                            $this->db->where('invoice.createdAtInvoice <=', $lastDayThisYear);
                            $this->db->where('invoice.adpInvoice', 1); //khusus FIT
                            $this->db->where('booking.segmentBooking', 'FIT'); //khusus FIT
                            $this->db->order_by('invoice.createdAtInvoice', 'DESC');
                            $query = $this->db->get();
                            
                            if ($query->num_rows() > 0) {
                              $dataFITytd = $query->result(); // Use result() to get an array of objects
                            }
                            $query->free_result();
                            
                            foreach($dataFITytd as $row) {
                              $totalFITytd += $row->priceInvoice;
                            }
                          ?>
                          <td><?php echo number_format($totalFITytd, 0, ',', '.') ?></td>
                        <tr>
                          <td><strong>TOTAL ROOM REVENUE</strong></td>
                          <!-- ACTUAL -->
                          <?php 
                            $totalRevenueToday = $totalFITtoday;
                            $totalRevenueMtd = $totalFITmtd;
                            $totalRevenueYtd = $totalFITytd;
                          ?>
                          <td><?php echo number_format($totalRevenueToday, 0, ',', '.') ?></td>
                          <td><?php echo number_format($totalRevenueMtd, 0, ',', '.') ?></td>
                          <td><?php echo number_format($totalRevenueYtd, 0, ',', '.') ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-4">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Transaction</th>
                          <th colspan="2">Deposit</th>
                        </tr>
                        <tr>
                          <th>Description</th>
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
                            $this->db->where('idBusiness', $idBusiness);
                            $query = $this->db->get();
                            
                            if ($query->num_rows() > 0) {
                              $dataFITtoday = $query->result(); // Use result() to get an array of objects
                            }
                            $query->free_result();
                            
                            foreach($dataFITtoday as $row) {
                              $totalFITtoday += $row->totalrateBooking;
                            }
                          ?>
                          <?php
                            $totalFITmtd = 0;
                            $dataFITmtd = array();
                            $firstDayThisMonth = date('Y-m-01');
                            $lastDayThisMonth = date('Y-m-t');

                            $this->db->from('booking');
                            $this->db->join('invoice', 'invoice.idBooking=booking.idBooking', 'left');
                            $this->db->where('invoice.idBusiness', $idBusiness);
                            $this->db->where('invoice.createdAtInvoice >=', $firstDayThisMonth);
                            $this->db->where('invoice.createdAtInvoice <=', $lastDayThisMonth);
                            $this->db->where('invoice.adpInvoice', 1); //khusus FIT
                            $this->db->where('booking.segmentBooking', 'FIT'); //khusus FIT
                            $this->db->order_by('invoice.createdAtInvoice', 'DESC');
                            $query = $this->db->get();
                            
                            if ($query->num_rows() > 0) {
                              $dataFITmtd = $query->result(); // Use result() to get an array of objects
                            }
                            $query->free_result();
                            
                            foreach($dataFITmtd as $row) {
                              $totalFITmtd += $row->priceInvoice;
                            }
                          ?>

                          <?php
                            if(!$totalInvestmentFITmtd) {
                              $debitInvestmentFITmtd = 0;
                            }
                            
                            $totalFITytd = 0;
                            $dataFITytd = array();
                            $firstDayThisYear = date('Y-01-01');
                            $lastDayThisYear = date('Y-12-t');
                            
                            $this->db->from('booking');
                            $this->db->join('invoice', 'invoice.idBooking=booking.idBooking', 'left');
                            $this->db->where('invoice.idBusiness', $idBusiness);
                            $this->db->where('invoice.createdAtInvoice >=', $firstDayThisYear);
                            $this->db->where('invoice.createdAtInvoice <=', $lastDayThisYear);
                            $this->db->where('invoice.adpInvoice', 1); //khusus FIT
                            $this->db->where('booking.segmentBooking', 'FIT'); //khusus FIT
                            $this->db->order_by('invoice.createdAtInvoice', 'DESC');
                            $query = $this->db->get();
                            
                            if ($query->num_rows() > 0) {
                              $dataFITytd = $query->result(); // Use result() to get an array of objects
                            }
                            $query->free_result();
                            
                            foreach($dataFITytd as $row) {
                              $totalFITytd += $row->priceInvoice;
                            }
                          ?>

                          <!-- BUDGET -->
                          <td><?php echo number_format($debitInvestmentFITmtd / 12, 0, ',', '.') ?></td>
                          <td><?php echo number_format($debitInvestmentFITmtd, 0, ',', '.') ?></td>
                        <tr>
                          <td><strong>SISA DEPOSIT</strong></td>
                          <!-- ACTUAL -->
                          <?php 
                            if(!$totalInvestmentFITmtd) {
                              $totalInvestmentFITmtd = 0;
                            }

                            $totalRevenueToday = $totalFITtoday;
                            $totalRevenueMtd = $totalFITmtd;
                            $totalRevenueYtd = $totalFITytd;
                            $budgeMonthly = ($totalInvestmentFITmtd / 12);
                            $fixBudgetMonthly = $budgeMonthly - $totalRevenueMtd;
                            $fixBudgetYearly = $totalInvestmentFITmtd - $totalRevenueYtd;
                          ?>
                          <td><?php echo number_format($totalInvestmentFITmtd / 12, 0, ',', '.') ?></td>
                          <td><?php echo number_format($totalInvestmentFITmtd, 0, ',', '.') ?></td>
                          <!-- BUDGET -->
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- LIST DATA ADP FIT -->
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Segment</th>
                      <th>Payment</th>
                      <th>Rincian Payment</th>
                      <th>Tanggal Payment</th>
                      <th>Nomor Referensi</th>
                      <th>Jumlah Total</th>
                      <th>Mata Uang</th>
                      <th>Negara</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $displayed_name = array();
                      $invoice_adp = array();
                      $this->db->from('booking');
                      $this->db->join('invoice', 'invoice.idBooking=booking.idBooking', 'left');
                      $this->db->where('invoice.idBusiness', $idBusiness);
                      $this->db->where('booking.segmentBooking', 'FIT'); //khusus FIT
                      $this->db->order_by('invoice.createdAtInvoice', 'DESC');
                      $this->db->where('invoice.adpInvoice', 1);
                      $query = $this->db->get();
                      if ($query->num_rows() > 0)
                      {
                        foreach ($query->result() as $row)
                        {
                          $invoice_adp[] = $row;
                        }
                      }
                      $query->free_result(); 
                    ?>
                    <?php 
                      foreach($invoice_adp as $row) {
                        $firstThreeChars = substr($row->firstnameBooking, 0, 3);
                        $remainingChars = str_repeat('*', max(0, strlen($row->firstnameBooking) - 3));

                        $maskedName = $firstThreeChars . $remainingChars . substr($row->firstnameBooking, -1);
                    ?>
                    <tr>
                      <td><?php echo $row->idInvoice ?></td>
                      <td><?php echo $maskedName ?></td>
                      <td><?php echo $row->segmentBooking ?></td>
                      <td><?php echo $row->paymentBooking ?></td>
                      <td><?php echo $row->ketInvoice ?></td>
                      <td><?php echo $row->createdAtInvoice ?></td>
                      <td><?php echo $row->refInvoice ?></td>
                      <td><?php echo 'IDR ' . number_format($row->priceInvoice, 0, ',', '.'); ?></td>
                      <td><?php echo $row->currencyBooking ?></td>
                      <td><?php echo $row->nationalityBooking ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="adp-ota" role="tabpanel" aria-labelledby="adp-ota-tab">
                <!-- Diagram Data ADP OTA ACCUMULATION -->
                <br />
                <!-- <div id="chart_plot_adp_accumulation_ota" class="demo-placeholder"></div> -->
                <!-- Diagram Data ADP OTA PER DAY -->
                <br />
                <!-- <div id="chart_plot_adp_day_ota" class="demo-placeholder"></div> -->
                <!-- ROOM REVENUE OTA -->
                <br />
                <h3> ROOM REVENUE </h3>
                <div class="row">
                  <div class="col-md-8">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Transaction</th>
                          <th colspan="3">Actual</th>
                        </tr>
                        <tr>
                          <th>Description</th>
                          <th>Today</th>
                          <th>MTD</th>
                          <th>YTD</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr></tr>
                        <tr>
                          <td>OTA</td>
                          <!-- ACTUAL -->
                          <?php 
                            $totalOTAtoday = 0;
                            $dataOTAtoday = array();
                            $this->db->from('booking');
                            $this->db->where('segmentBooking', 'OTA-SDJ');
                            $this->db->where('arrivalBooking', date('Y-m-d'));
                            $this->db->where('idBusiness', $idBusiness);
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
                            $this->db->join('invoice', 'invoice.idBooking=booking.idBooking', 'left');
                            $this->db->where('invoice.idBusiness', $idBusiness);
                            $this->db->where('invoice.createdAtInvoice >=', $firstDayThisMonth);
                            $this->db->where('invoice.createdAtInvoice <=', $lastDayThisMonth);
                            $this->db->where('invoice.adpInvoice', 1); //khusus OTA
                            $this->db->where('booking.segmentBooking', 'OTA-SDJ'); //khusus OTA
                            $this->db->order_by('invoice.createdAtInvoice', 'DESC');
                            $query = $this->db->get();
                            
                            if ($query->num_rows() > 0) {
                              $dataOTAmtd = $query->result(); // Use result() to get an array of objects
                            }
                            $query->free_result();
                            
                            foreach($dataOTAmtd as $row) {
                              $totalOTAmtd += $row->priceInvoice;
                            }
                          ?>
                          <td><?php echo number_format($totalOTAmtd, 0, ',', '.') ?></td>

                          <?php
                            $totalOTAytd = 0;
                            $dataOTAytd = array();
                            $firstDayThisYear = date('Y-01-01');
                            $lastDayThisYear = date('Y-12-t');
                            
                            $this->db->from('booking');
                            $this->db->join('invoice', 'invoice.idBooking=booking.idBooking', 'left');
                            $this->db->where('invoice.idBusiness', $idBusiness);
                            $this->db->where('invoice.createdAtInvoice >=', $firstDayThisYear);
                            $this->db->where('invoice.createdAtInvoice <=', $lastDayThisYear);
                            $this->db->where('invoice.adpInvoice', 1); //khusus OTA
                            $this->db->where('booking.segmentBooking', 'OTA-SDJ'); //khusus OTA
                            $this->db->order_by('invoice.createdAtInvoice', 'DESC');
                            $query = $this->db->get();
                            
                            if ($query->num_rows() > 0) {
                              $dataOTAytd = $query->result(); // Use result() to get an array of objects
                            }
                            $query->free_result();
                            
                            foreach($dataOTAytd as $row) {
                              $totalOTAytd += $row->priceInvoice;
                            }
                          ?>
                          <td><?php echo number_format($totalOTAytd, 0, ',', '.') ?></td>
                        <tr>
                          <td><strong>TOTAL ROOM REVENUE</strong></td>
                          <!-- ACTUAL -->
                          <?php 
                            $totalRevenueToday = $totalOTAtoday;
                            $totalRevenueMtd = $totalOTAmtd;
                            $totalRevenueYtd = $totalOTAytd;
                          ?>
                          <td><?php echo number_format($totalRevenueToday, 0, ',', '.') ?></td>
                          <td><?php echo number_format($totalRevenueMtd, 0, ',', '.') ?></td>
                          <td><?php echo number_format($totalRevenueYtd, 0, ',', '.') ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-4">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Transaction</th>
                          <th colspan="2">Deposit</th>
                        </tr>
                        <tr>
                          <th>Description</th>
                          <th>MTD</th>
                          <th>YTD</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr></tr>
                        <tr>
                          <td>OTA</td>
                          <!-- ACTUAL -->
                          <?php 
                            $totalOTAtoday = 0;
                            $dataOTAtoday = array();
                            $this->db->from('booking');
                            $this->db->where('segmentBooking', 'OTA-SDJ');
                            $this->db->where('arrivalBooking', date('Y-m-d'));
                            $this->db->where('idBusiness', $idBusiness);
                            $query = $this->db->get();
                            
                            if ($query->num_rows() > 0) {
                              $dataOTAtoday = $query->result(); // Use result() to get an array of objects
                            }
                            $query->free_result();
                            
                            foreach($dataOTAtoday as $row) {
                              $totalOTAtoday += $row->totalrateBooking;
                            }
                          ?>
                          <?php
                            $totalOTAmtd = 0;
                            $dataOTAmtd = array();
                            $firstDayThisMonth = date('Y-m-01');
                            $lastDayThisMonth = date('Y-m-t');

                            $this->db->from('booking');
                            $this->db->join('invoice', 'invoice.idBooking=booking.idBooking', 'left');
                            $this->db->where('invoice.idBusiness',$idBusiness);
                            $this->db->where('invoice.createdAtInvoice >=', $firstDayThisMonth);
                            $this->db->where('invoice.createdAtInvoice <=', $lastDayThisMonth);
                            $this->db->where('invoice.adpInvoice', 1); //khusus OTA
                            $this->db->where('booking.segmentBooking', 'OTA-SDJ'); //khusus OTA
                            $this->db->order_by('invoice.createdAtInvoice', 'DESC');
                            $query = $this->db->get();
                            
                            if ($query->num_rows() > 0) {
                              $dataOTAmtd = $query->result(); // Use result() to get an array of objects
                            }
                            $query->free_result();
                            
                            foreach($dataOTAmtd as $row) {
                              $totalOTAmtd += $row->priceInvoice;
                            }
                          ?>

                          <?php
                            if(!$totalInvestmentOTAmtd) {
                              $debitInvestmentOTAmtd = 0;
                            }
                            
                            $totalOTAytd = 0;
                            $dataOTAytd = array();
                            $firstDayThisYear = date('Y-01-01');
                            $lastDayThisYear = date('Y-12-t');
                            
                            $this->db->from('booking');
                            $this->db->join('invoice', 'invoice.idBooking=booking.idBooking', 'left');
                            $this->db->where('invoice.idBusiness', $idBusiness);
                            $this->db->where('invoice.createdAtInvoice >=', $firstDayThisYear);
                            $this->db->where('invoice.createdAtInvoice <=', $lastDayThisYear);
                            $this->db->where('invoice.adpInvoice', 1); //khusus OTA
                            $this->db->where('booking.segmentBooking', 'OTA-SDJ'); //khusus OTA
                            $this->db->order_by('invoice.createdAtInvoice', 'DESC');
                            $query = $this->db->get();
                            
                            if ($query->num_rows() > 0) {
                              $dataOTAytd = $query->result(); // Use result() to get an array of objects
                            }
                            $query->free_result();
                            
                            foreach($dataOTAytd as $row) {
                              $totalOTAytd += $row->priceInvoice;
                            }
                          ?>

                          <!-- BUDGET -->
                          <td><?php echo number_format($debitInvestmentOTAmtd / 12, 0, ',', '.') ?></td>
                          <td><?php echo number_format($debitInvestmentOTAmtd, 0, ',', '.') ?></td>
                        <tr>
                          <td><strong>SISA DEPOSIT</strong></td>
                          <!-- ACTUAL -->
                          <?php 
                            if(!$totalInvestmentOTAmtd) {
                              $totalInvestmentOTAmtd = 0;
                            }

                            $totalRevenueToday = $totalOTAtoday;
                            $totalRevenueMtd = $totalOTAmtd;
                            $totalRevenueYtd = $totalOTAytd;
                            $budgeMonthly = ($totalInvestmentOTAmtd / 12);
                            $fixBudgetMonthly = $budgeMonthly - $totalRevenueMtd;
                            $fixBudgetYearly = $totalInvestmentOTAmtd - $totalRevenueYtd;
                          ?>
                          <td><?php echo number_format($totalInvestmentOTAmtd / 12, 0, ',', '.') ?></td>
                          <td><?php echo number_format($totalInvestmentOTAmtd, 0, ',', '.') ?></td>
                          <!-- BUDGET -->
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- LIST DATA ADP OTA -->
                <ul class="nav nav-tabs bar_tabs" id="ota-nav" role="tablist">
                  <li class="nav-item active">
                    <a class="nav-link active" id="guest-tab" data-toggle="tab" href="#guest" role="tab" aria-controls="guest" aria-selected="true">GUEST</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="ota-tab" data-toggle="tab" href="#ota" role="tab" aria-controls="ota" aria-selected="true">OTA</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="hotel-tab" data-toggle="tab" href="#hotel" role="tab" aria-controls="hotel" aria-selected="false">HOTEL</a>
                  </li>
                </ul>
                <div class="tab-content" id="otaTabContent">
                  <div class="tab-pane fade active in" id="guest" role="tabpanel" aria-labelledby="guest-tab">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Segment</th>
                          <th>Payment</th>
                          <th>Total Pembayaran</th>
                          <th>Tanggal Payment</th>
                          <th>Nomor Referensi</th>
                          <th>Total Agreement Investment</th>
                          <th>Mata Uang</th>
                          <th>Negara</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $displayed_name = array();
                          $invoice_adp = array();
                          $this->db->from('invoice');
                          $this->db->join('investment', 'investment.idInvoice=invoice.idInvoice', 'left');
                          $this->db->join('booking', 'booking.idBooking=invoice.idBooking', 'left');
                          $this->db->where('invoice.idBusiness', $idBusiness);
                          $this->db->where('investment.nmSegment', 'OTA-SDJ'); //khusus OTA
                          $this->db->where('investment.statusInvestment', 'on'); //khusus OTA
                          $this->db->where('invoice.adpInvoice', 1);
                          $this->db->order_by('invoice.createdAtInvoice', 'DESC');
                          $query = $this->db->get();
                          if ($query->num_rows() > 0)
                          {
                            foreach ($query->result() as $row)
                            {
                              if (!in_array($row->idInvoice, $displayed_name)) {
                                // Add the invoice to the list of displayed invoices
                                $displayed_name[] = $row->idInvoice;
                                $invoice_adp[] = $row;
                              }
                            }
                          }
                          $query->free_result(); 
                        ?>
                        <?php 
                          foreach($invoice_adp as $row) {
                            $firstThreeChars = substr($row->firstnameBooking, 0, 3);
                            $remainingChars = str_repeat('*', max(0, strlen($row->firstnameBooking) - 3));

                            $maskedName = $firstThreeChars . $remainingChars . substr($row->firstnameBooking, -1);
                        ?>
                        <tr>
                          <td><?php echo $row->idInvoice ?></td>
                          <td><?php echo $maskedName ?></td>
                          <td><?php echo $row->segmentBooking ?></td>
                          <td><?php echo $row->paymentBooking ?></td>
                          <td><?php echo 'IDR ' . number_format($row->priceInvoice, 0, ',', '.'); ?></td>
                          <td><?php echo $row->createdAtInvoice ?></td>
                          <td><?php echo $row->refInvoice ?></td>
                          <td><?php echo 'IDR ' . number_format($row->agreementInvestment, 0, ',', '.'); ?></td>
                          <td><?php echo $row->currencyBooking ?></td>
                          <td><?php echo $row->nationalityBooking ?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="ota" role="tabpanel" aria-labelledby="ota-tab">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Segment</th>
                          <th>Payment</th>
                          <th>Total Pembayaran</th>
                          <th>Tanggal Payment</th>
                          <th>Persentasi Fee</th>
                          <th>Total Fee OTA</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $displayed_name = array();
                          $invoice_adp = array();
                          $this->db->from('invoice');
                          $this->db->join('investment', 'investment.idInvoice=invoice.idInvoice', 'left');
                          $this->db->join('booking', 'booking.idBooking=invoice.idBooking', 'left');
                          $this->db->where('invoice.idBusiness', $idBusiness);
                          $this->db->where('investment.nmSegment', 'OTA-SDJ'); //khusus OTA
                          $this->db->where('investment.statusInvestment', 'on'); //khusus OTA
                          $this->db->where('invoice.adpInvoice', 1);
                          $this->db->order_by('invoice.createdAtInvoice', 'DESC');
                          $query = $this->db->get();
                          if ($query->num_rows() > 0)
                          {
                            foreach ($query->result() as $row)
                            {
                              if (!in_array($row->idInvoice, $displayed_name)) {
                                // Add the invoice to the list of displayed invoices
                                $displayed_name[] = $row->idInvoice;
                                $invoice_adp[] = $row;
                              }
                            }
                          }
                          $query->free_result(); 
                        ?>
                        <?php 
                          foreach($invoice_adp as $row) {
                            $firstThreeChars = substr($row->firstnameBooking, 0, 3);
                            $remainingChars = str_repeat('*', max(0, strlen($row->firstnameBooking) - 3));

                            $maskedName = $firstThreeChars . $remainingChars . substr($row->firstnameBooking, -1);
                        ?>
                        <tr>
                          <td><?php echo $row->idInvoice ?></td>
                          <td><?php echo $maskedName ?></td>
                          <td><?php echo $row->segmentBooking ?></td>
                          <td><?php echo $row->paymentBooking ?></td>
                          <td><?php echo 'IDR ' . number_format($row->priceInvoice, 0, ',', '.'); ?></td>
                          <td><?php echo $row->createdAtInvoice ?></td>
                          <td><?php echo $row->percentInvestment ?>%</td>
                          <td><?php echo 'IDR ' . number_format($row->feeInvestment, 0, ',', '.'); ?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="hotel" role="tabpanel" aria-labelledby="hotel-tab">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Segment</th>
                          <th>Payment</th>
                          <th>Total Pembayaran</th>
                          <th>Tanggal Payment</th>
                          <th>Total Income OTA</th>
                          <th>Total Margin Hotel</th>
                          <th>Persentasi Hotel</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $displayed_name = array();
                          $invoice_adp = array();
                          $this->db->from('invoice');
                          $this->db->join('investment', 'investment.idInvoice=invoice.idInvoice', 'left');
                          $this->db->join('booking', 'booking.idBooking=invoice.idBooking', 'left');
                          $this->db->where('invoice.idBusiness', $idBusiness);
                          $this->db->where('investment.nmSegment', 'OTA-SDJ'); //khusus OTA
                          $this->db->where('investment.statusInvestment', 'on'); //khusus OTA
                          $this->db->where('invoice.adpInvoice', 1);
                          $this->db->order_by('invoice.createdAtInvoice', 'DESC');
                          $query = $this->db->get();
                          if ($query->num_rows() > 0)
                          {
                            foreach ($query->result() as $row)
                            {
                              if (!in_array($row->idInvoice, $displayed_name)) {
                                // Add the invoice to the list of displayed invoices
                                $displayed_name[] = $row->idInvoice;
                                $invoice_adp[] = $row;
                              }
                            }
                          }
                          $query->free_result(); 
                        ?>
                        <?php 
                          foreach($invoice_adp as $row) {
                            $firstThreeChars = substr($row->firstnameBooking, 0, 3);
                            $remainingChars = str_repeat('*', max(0, strlen($row->firstnameBooking) - 3));

                            $maskedName = $firstThreeChars . $remainingChars . substr($row->firstnameBooking, -1);
                        ?>
                        <tr>
                          <td><?php echo $row->idInvoice ?></td>
                          <td><?php echo $maskedName ?></td>
                          <td><?php echo $row->segmentBooking ?></td>
                          <td><?php echo $row->paymentBooking ?></td>
                          <td><?php echo 'IDR ' . number_format($row->priceInvoice, 0, ',', '.'); ?></td>
                          <td><?php echo $row->createdAtInvoice ?></td>
                          <td><?php echo 'IDR ' . number_format($row->grossInvestment, 0, ',', '.'); ?></td>
                          <td><?php echo 'IDR ' . number_format($row->marginInvestment, 0, ',', '.'); ?></td>
                          <td><?php echo $row->percmarginInvestment ?>%</td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
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