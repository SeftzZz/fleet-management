        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Business</h3>
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
                    <h2>View Business</h2>
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
                    <p class="text-muted font-13 m-b-30">
                      The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
                    </p>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Invoice</th>
                          <th>Check In</th>
                          <th>Check Out</th>
                          <th>Status</th>
                          <th>Email</th>
                          <th>Payment</th>
                          <th>Company</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $displayed_invoices = array(); // Array to keep track of displayed invoices
                          $no = 1;

                          foreach ($bookingmeeting as $row) {
                            // Check if the invoice has already been displayed
                            if (!in_array($row->invoiceBooking, $displayed_invoices)) {
                              // Add the invoice to the list of displayed invoices
                              $displayed_invoices[] = $row->invoiceBooking;

                              // Display the row
                              ?>
                              <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row->invoiceBooking ?></td>
                                <td><?php echo $row->arrivalBooking ?></td>
                                <td><?php echo $row->departureBooking ?></td>
                                <td><?php echo $row->statusBooking ?></td>
                                <td><?php echo $row->emailBooking ?></td>
                                <td><?php echo $row->statuspayBooking ?></td>
                                <td><?php echo $row->companyBooking ?></td>
                                <td>
                                  <a href="<?php echo base_url('cms/home/inputAdditionalBookingMeeting/'.$row->invoiceBooking.'/') ?>" class="btn btn-primary">Pilih</a>
                                </td>
                              </tr>
                              <?php
                            }
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