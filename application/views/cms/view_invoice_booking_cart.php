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
  .status-invoice-unpaid {
    background: #ffdeec;
  }
  .status-invoice-paid {
    background: #deffe2;
  }
  @media print {
    .x_title.no-print {
      display: none !important;
    }
    .panel_toolbox.no-print {
      display: none !important;
    }
  }
</style>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <?php
            if($bookingcartdetail->statuspayBooking == 'UNPAID') {
          ?>
          <div class="x_title no-print status-invoice-unpaid">
            <h2>UNPAID</h2>
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
          <?php
          } else {
          ?>
          <div class="x_title no-print status-invoice-paid">
            <h2>PAID</h2>
            <ul class="nav navbar-right panel_toolbox no-print">
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
          <?php
          } 
          ?>
          <div class="x_content">
            <br />
            <section class="content invoice">
              <div class="row invoice-info">
                <div class="col-sm-2 invoice-col">
                  <img src="<?php echo base_url() ?>/assets/images/logo-sahira.jpg" class="img-responsive avatar-view" width="150px">
                </div>
                <div class="col-sm-4 invoice-col"> From <address>
                    <strong><?php echo $this->session->userdata('business') ?></strong>
                    <br><?php echo $this->session->userdata('address') ?> <br>Email: <?php echo $this->session->userdata('emailuser') ?>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col"> Guest Billing <address>
                    <strong><?php echo $bookingcartdetail->firstnameBooking ?> <?php echo $bookingcartdetail->lastnameBooking ?>, <?php echo $bookingcartdetail->genderBooking ?></strong>
                    <br><?php echo $bookingcartdetail->companyBooking ?> <br><?php echo $bookingcartdetail->addressBooking ?> <br>Phone: <?php echo $bookingcartdetail->mobileBooking ?> <br>Email: <?php echo $bookingcartdetail->emailBooking ?>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  <b>Arrival Date :</b> <?php echo $this->fppfunction->format_tgl1($bookingcartdetail->arrivalBooking) ?> <br>
                  <b>Departure Date :</b> <?php echo $this->fppfunction->format_tgl1($bookingcartdetail->departureBooking) ?> <br>
                </div>
              </div>
              <div class="row">
                <div class="table">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th style="width: 20%">Description</th>
                        <th>Room</th>
                        <th>Extra Bed</th>
                        <th>Additional</th>
                        <th>Charge</th>
                        <th>Payment</th>
                        <th>Balance</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $totalInvoice = 0;
                        $fixPayment = 0;
                        $dataInvoice = array();
                        $this->db->from('booking_cart');
                        $this->db->join('kamar_type_meeting', 'kamar_type_meeting.nmTypeMeeting=booking_cart.roomtypeBooking', 'left');
                        $this->db->join('kamar_type', 'kamar_type.nmType=booking_cart.roomtypeBooking', 'left');
                        $this->db->join('kamar_harga', 'kamar_harga.idType=booking_cart.idType', 'left');
                        $this->db->join('kamar_harga_meeting', 'kamar_harga_meeting.idType=booking_cart.idType', 'left');
                        $this->db->join('kamar', 'kamar.idKamar=kamar_type.idKamar', 'left');
                        $this->db->join('kamar_meeting', 'kamar_meeting.idKamarMeeting=kamar_type_meeting.idKamar', 'left');
                        $this->db->join('invoice', 'invoice.idBooking=booking_cart.invoiceBooking', 'left');
                        $this->db->where('booking_cart.invoiceBooking', $bookingcartdetail->invoiceBooking);
                        $query = $this->db->get();
                        
                        if ($query->num_rows() > 0) {
                          $dataInvoice = $query->result(); // Use result() to get an array of objects
                        }
                        $query->free_result();
                        
                        foreach($dataInvoice as $row) {
                          $totalInvoice += $row->priceInvoice;
                        }

                        if($bookingcartdetail->rateafterdiscountBooking != 0) {
                          $extrabed = $bookingcartdetail->extrabedBooking;
                          if($this->session->userdata('idBusiness') == 1) {
                            $priceextrabed = $extrabed * 350000;
                            $payment = $bookingcartdetail->additionalBooking + $bookingcartdetail->chargeBooking + $bookingcartdetail->rateafterdiscountBooking + $priceextrabed;
                            $fixPayment = $bookingcartdetail->nightBooking * $payment;
                          } else if($this->session->userdata('idBusiness') == 2) {
                            $priceextrabed = $extrabed * 250000;
                            $payment = $bookingcartdetail->additionalBooking + $bookingcartdetail->chargeBooking + $bookingcartdetail->rateafterdiscountBooking + $priceextrabed;
                            $fixPayment = $bookingcartdetail->nightBooking * $payment;
                          } else if($this->session->userdata('idBusiness') == 3) {
                            $priceextrabed = $extrabed * 150000;
                            $payment = $bookingcartdetail->additionalBooking + $bookingcartdetail->chargeBooking + $bookingcartdetail->rateafterdiscountBooking + $priceextrabed;
                            $fixPayment = $bookingcartdetail->nightBooking * $payment;
                          }
                        } else {
                          if($this->session->userdata('idBusiness') == 1) {
                            $extrabed = $bookingcartdetail->extrabedBooking;
                            $priceextrabed = $extrabed * 350000;
                            $payment = $bookingcartdetail->additionalBooking + $bookingcartdetail->chargeBooking + $bookingcartdetail->totalrateBooking + $priceextrabed;
                            $fixPayment = $bookingcartdetail->nightBooking * $payment;
                          } else if($this->session->userdata('idBusiness') == 2) {
                            $extrabed = $bookingcartdetail->extrabedBooking;
                            $priceextrabed = $extrabed * 250000;
                            $payment = $bookingcartdetail->additionalBooking + $bookingcartdetail->chargeBooking + $bookingcartdetail->totalrateBooking + $priceextrabed;
                            $fixPayment = $bookingcartdetail->nightBooking * $payment;
                          } else if($this->session->userdata('idBusiness') == 2) {
                            $extrabed = $bookingcartdetail->extrabedBooking;
                            $priceextrabed = $extrabed * 150000;
                            $payment = $bookingcartdetail->additionalBooking + $bookingcartdetail->chargeBooking + $bookingcartdetail->totalrateBooking + $priceextrabed;
                            $fixPayment = $bookingcartdetail->nightBooking * $payment;
                          }
                        }
                      ?>
                      <tr>
                        <td>1</td>
                        <td><?php echo $bookingcartdetail->nightBooking ?> Night, <?php echo $bookingcartdetail->roomtypeBooking ?>, <?php echo $bookingcartdetail->billinginstructionBooking ?></td>
                        <td><?php echo $bookingcartdetail->numberroomBooking ?></td>
                        <td><?php echo number_format($bookingcartdetail->extrabedBooking) ?></td>
                        <td><?php echo number_format($bookingcartdetail->additionalBooking) ?></td>
                        <td><?php echo number_format($bookingcartdetail->chargeBooking) ?></td>
                        <td><?php echo number_format($bookingcartdetail->totalrateBooking) ?></td>
                        <td><?php echo number_format($fixPayment - $totalInvoice) ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <?php
                    if($bookingcartdetail->paymentBooking == 'CASH') {
                  ?>
                  <p class="lead">
                    Payment : <?php echo $bookingcartdetail->paymentBooking ?> | 
                    <?php
                      if($bookingcartdetail->statuspayBooking == 'UNPAID') {
                    ?>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#invoiceModal" ><?php echo $bookingcartdetail->statuspayBooking ?></button>
                    <?php
                    } else {
                    ?>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#invoiceModal" ><?php echo $bookingcartdetail->statuspayBooking ?></button>
                    <?php 
                      if($totalInvoice == $fixPayment) {
                    ?>
                      <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#checkoutModal">Checkout</button>
                    <?php } ?>
                    <?php
                    } 
                    ?>
                  </p>
                  <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;"> I AGREE THAT MY LIABILITY FOR THIS BILL NOT WAIVED AND AGREE TO BE HELD PERSONALITY LIABLE IN THE EVEN THAT THE INDICATED PERSON COMPANY OR ASSOCIATION FAILS TO PAY FOR ANY PART OR THE FULL AMOUNT OF THESE CHARGES </p>
                  <?php
                    } else {
                  ?>
                  <p class="lead">
                    Payment : <?php echo $bookingcartdetail->paymentBooking ?> | 
                    <?php
                      if($bookingcartdetail->statuspayBooking == 'UNPAID') {
                    ?>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#invoiceModal" ><?php echo $bookingcartdetail->statuspayBooking ?></button>
                    <?php
                    } else {
                    ?>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#invoiceModal" ><?php echo $bookingcartdetail->statuspayBooking ?></button>
                    <?php 
                      if($totalInvoice == $fixPayment) {
                    ?>
                      <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#checkoutModal">Checkout</button>
                    <?php } ?>
                    <?php
                    } 
                    ?>
                  </p>
                  <?php
                    }
                  ?>
                </div>
                <div class="col-md-6">
                  <p class="lead">Amount Due <?php echo $bookingcartdetail->createdAtBooking ?></p>
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th>Extra Bed :</th>
                          <td>
                            <?php
                              if($bookingcartdetail->extrabedBooking > 0) {
                                $extrabed = $bookingcartdetail->extrabedBooking;
                                if($this->session->userdata('idBusiness') == 1) {
                                  $priceextrabed = $extrabed * 350000;
                                  echo number_format($priceextrabed);
                                } else if($this->session->userdata('idBusiness') == 2) {
                                  $priceextrabed = $extrabed * 250000;
                                  echo number_format($priceextrabed);
                                } else if($this->session->userdata('idBusiness') == 3) {
                                  $priceextrabed = $extrabed * 150000;
                                  echo number_format($priceextrabed);
                                }
                              } else {
                                $priceextrabed = 0;
                                echo number_format($priceextrabed);
                              }
                            ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Night :</th>
                          <td>
                            <?php echo $bookingcartdetail->nightBooking; ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Discount :</th>
                          <td>
                            <?php
                              if($bookingcartdetail->rateafterdiscountBooking != 0) {
                                $discount = $bookingcartdetail->discountBooking;
                                echo $discount . "%";
                              } else {
                                $discount = 0;
                                echo $discount . "%";
                              }
                            ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Total :</th>
                          <td>
                            <?php 
                              if($bookingcartdetail->rateafterdiscountBooking != 0) {
                                $extrabed = $bookingcartdetail->extrabedBooking;
                                if($this->session->userdata('idBusiness') == 1) {
                                  $priceextrabed = $extrabed * 350000;
                                  $payment = $bookingcartdetail->additionalBooking + $bookingcartdetail->chargeBooking + $bookingcartdetail->rateafterdiscountBooking + $priceextrabed;
                                  $fixPayment = $bookingcartdetail->nightBooking * $payment;
                                  echo number_format($fixPayment);
                                } else if($this->session->userdata('idBusiness') == 2) {
                                  $priceextrabed = $extrabed * 250000;
                                  $payment = $bookingcartdetail->additionalBooking + $bookingcartdetail->chargeBooking + $bookingcartdetail->rateafterdiscountBooking + $priceextrabed;
                                  $fixPayment = $bookingcartdetail->nightBooking * $payment;
                                  echo number_format($fixPayment);
                                } else if($this->session->userdata('idBusiness') == 3) {
                                  $priceextrabed = $extrabed * 150000;
                                  $payment = $bookingcartdetail->additionalBooking + $bookingcartdetail->chargeBooking + $bookingcartdetail->rateafterdiscountBooking + $priceextrabed;
                                  $fixPayment = $bookingcartdetail->nightBooking * $payment;
                                  echo number_format($fixPayment);
                                }
                              } else {
                                if($this->session->userdata('idBusiness') == 1) {
                                  $extrabed = $bookingcartdetail->extrabedBooking;
                                  $priceextrabed = $extrabed * 350000;
                                  $payment = $bookingcartdetail->additionalBooking + $bookingcartdetail->chargeBooking + $bookingcartdetail->totalrateBooking + $priceextrabed;
                                  $fixPayment = $bookingcartdetail->nightBooking * $payment;
                                  echo number_format($fixPayment);
                                } else if($this->session->userdata('idBusiness') == 2) {
                                  $extrabed = $bookingcartdetail->extrabedBooking;
                                  $priceextrabed = $extrabed * 250000;
                                  $payment = $bookingcartdetail->additionalBooking + $bookingcartdetail->chargeBooking + $bookingcartdetail->totalrateBooking + $priceextrabed;
                                  $fixPayment = $bookingcartdetail->nightBooking * $payment;
                                  echo number_format($fixPayment);
                                } else if($this->session->userdata('idBusiness') == 2) {
                                  $extrabed = $bookingcartdetail->extrabedBooking;
                                  $priceextrabed = $extrabed * 150000;
                                  $payment = $bookingcartdetail->additionalBooking + $bookingcartdetail->chargeBooking + $bookingcartdetail->totalrateBooking + $priceextrabed;
                                  $fixPayment = $bookingcartdetail->nightBooking * $payment;
                                  echo number_format($fixPayment);
                                }
                              }
                            ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-6 pull-right">
                  <div class="ln_solid"></div>
                  <p><?php echo $bookingcartdetail->firstnameBooking ?> <?php echo $bookingcartdetail->lastnameBooking ?></p>
                </div>
              </div>
            </section>

            <!-- Modal Update Invoice -->
            <div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="invoiceModalLabel">INVOICE <?php echo $bookingcartdetail->nightBooking ?> Night, <?php echo $bookingcartdetail->roomtypeBooking ?>, <?php echo $bookingcartdetail->billinginstructionBooking ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateStatusBooking/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                      <input type="hidden" name="idBooking" value="<?php echo $bookingcartdetail->idBooking ?>">
                      <input type="hidden" name="idCustomer" value="<?php echo $bookingcartdetail->idCustomer ?>">
                      <input type="hidden" id="ratenow" name="RateNow" value="<?php echo $bookingcartdetail->RateNow ?>">
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="statuspayBooking">Status Invoice <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <select id="statuspayBooking" name="statuspayBooking" class="form-control" required>
                            <option value="UNPAID">UNPAID</option>
                            <option value="PAID">PAID</option>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="address">Keterangan
                        </label>
                        <div class="col-md-9 col-sm-9">
                          <textarea type="text" id="ketinvoice" name="ketInvoice" class="form-control"></textarea>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="company">Total Pembayaran
                        </label>
                        <div class="col-md-9 col-sm-9">
                          <input type="text" id="priceInvoice" name="priceInvoice" class="form-control" oninput="formatNumber(event)">
                        </div>
                        <script>
                          function formatNumber(event) {
                            let input = event.target;
                            let value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
                            value = Number(value).toLocaleString(); // Format as a number with commas

                            input.value = value;
                            console.log(input.value);
                          }
                        </script>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="company">Nomor Referensi
                        </label>
                        <div class="col-md-9 col-sm-9">
                          <input type="text" id="refInvoice" name="refInvoice" class="form-control">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="company">Bukti Pembayaran
                        </label>
                        <div class="col-md-9 col-sm-9">
                          <input type="file" id="imgInvoice" name="imgInvoice" class="form-control">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                          <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button>
                          <input type="submit" class="btn btn-success" value="Submit">
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
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
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $invoice = array();
                          $this->db->from('booking');
                          $this->db->join('invoice', 'invoice.idBooking=booking.idBooking', 'left');
                          $this->db->where('invoice.idBooking', $bookingcartdetail->idBooking);
                          $query = $this->db->get();
                          if ($query->num_rows() > 0)
                          {
                            foreach ($query->result() as $row)
                            {
                              $invoice[] = $row;
                            }
                          }
                          $query->free_result(); 
                        ?>
                        <?php 
                          foreach($invoice as $row) {
                        ?>
                        <tr>
                          <td><?php echo $row->idInvoice ?></td>
                          <td><?php echo $row->firstnameBooking ?></td>
                          <td><?php echo $row->segmentBooking ?></td>
                          <td><?php echo $row->paymentBooking ?></td>
                          <td><?php echo $row->ketInvoice ?></td>
                          <td><?php echo $row->createdAtInvoice ?></td>
                          <td><?php echo $row->refInvoice ?></td>
                          <td><?php echo number_format($row->priceInvoice) ?></td>
                          <td><?php echo $row->currencyBooking ?></td>
                          <td><a href="<?php echo base_url('cms/home/') ?>" class="btn btn-primary">view</a></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">Checkout Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <table class="table roomready">
                      <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Room Type</th>
                            <th>Arrival</th>
                            <th>Departure</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr>
                            <td><?php echo $bookingcartdetail->firstnameBooking ?></td>
                            <td><?php echo $bookingcartdetail->roomtypeBooking ?></td>
                            <td><?php echo $bookingcartdetail->arrivalBooking ?></td>
                            <td><?php echo $bookingcartdetail->departureBooking ?></td>
                            <td>
                              <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/checkoutFormBooking/'.$this->session->userdata('idBusiness').'/'.$bookingcartdetail->idBooking.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                                <input type="hidden" name="idKamar" value="<?php echo $bookingcartdetail->idKamar ?>">
                                <input type="hidden" name="numberroomBooking" value="<?php echo $bookingcartdetail->numberroomBooking ?>">
                                <input type="submit" name="submit" value="Checkout" class="btn btn-warning">
                              </form>
                            </td>
                          </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="modal-footer">
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