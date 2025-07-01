        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View Claim Voucher Catalog</h2>
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
                  <div class="x_content">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Voucher Name</th>
                          <th>User Name</th>
                          <th>Segment Order</th>
                          <th>ID Booking</th>
                          <th>Invoice Number</th>
                          <th>Total Price</th>
                          <th>Status Payment</th>
                          <th>Payment Method</th>
                          <th>Created At</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $this->db->from('fnb_additional_booking');
                          $this->db->join('fnb_additional_cooking', 'fnb_additional_cooking.invoiceFnbadditional=fnb_additional_booking.invoiceFnbadditional');
                          $this->db->join('user', 'user.idUser=fnb_additional_booking.idUser');
                          $this->db->where('fnb_additional_cooking.statuspayFnbcooking !=', 'EXPIRED');
                          $this->db->order_by('fnb_additional_cooking.createdAtFnbcooking', 'DESC');
                          $query = $this->db->get();

                          if ($query->num_rows() > 0) {
                            foreach ($query->result() as $row) {
                        ?>
                        <tr>
                          <td><?php echo $row->ketFnbadditional ?></td>
                          <td><?php echo $row->nmUser ?></td>
                          <td><?php echo $row->segmentFnbadditional ?></td>
                          <td><?php echo $row->idBooking ?></td>
                          <td><?php echo $row->invoiceFnbadditional ?></td>
                          <td>Rp <?php echo number_format($row->subtotalPrice) ?></td>
                          <?php 
                          if($row->statuspayFnbcooking == 'UNPAID') {
                          ?>
                          <td style="background: red;color: white;"><?php echo $row->statuspayFnbcooking ?></td>
                          <?php 
                          } elseif($row->statuspayFnbcooking == 'PAID') { 
                          ?>
                          <td style="background: green;color: white;"><?php echo $row->statuspayFnbcooking ?></td>
                          <?php } ?>
                          <td><?php echo $row->paymentFnbcooking ?></td>
                          <td><?php echo $row->createdAtFnbcooking ?></td>
                        </tr>
                        <?php
                            }
                          } else {
                            echo "No data found in the membership table.";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->