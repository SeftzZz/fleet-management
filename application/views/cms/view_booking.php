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
    <div class="page-title">
      <div class="title_left">
        <h3>Booking</h3>
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
            <h2>View Booking</h2>
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
          <!-- <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
            <li class="nav-item active">
              <a class="nav-link active" id="reservation-tab" data-toggle="tab" href="#reservation" role="tab" aria-controls="reservation" aria-selected="true">Reservation</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="checkin-tab" data-toggle="tab" href="#checkin" role="tab" aria-controls="checkin" aria-selected="true">Check-In</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="checkin-app-tab" data-toggle="tab" href="#checkin-app" role="tab" aria-controls="checkin-app" aria-selected="true">Check-In App</a>
            </li>
          </ul> -->
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active in" id="reservation" role="tabpanel" aria-labelledby="reservation-tab">
              <table id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Nama Tamu</th>
                    <th>Nomor Kamar</th>
                    <th>Book By</th>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                    <th>Alamat</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Action</th>
                  </tr>
                </thead>
                  <tbody>
                  <?php
                    $displayed_numberroom = array();
                    foreach($booking_reservation as $row) {
                      $dateNow = date('Y-m-d');
                  ?>
                  <tr>
                    <td><?php echo $row->firstnameBooking ?><br><span class="text-muted text-sm" style="font-size: 10px;"><?php echo $row->checkinremarkBooking ?></span></td>
                    <td><?php echo $row->numberroomBooking ?></td>
                    <td><?php echo $row->byBooking ?></td>
                    <td><?php echo $row->emailBooking ?></td>
                    <td><?php echo $row->mobileBooking ?></td>
                    <td><?php echo $row->addressBooking ?></td>
                    <td><?php echo $row->arrivalBooking ?></td>
                    <td><?php echo $row->departureBooking ?><br>
                      <?php 
                        if($dateNow == $row->departureBooking) {
                      ?>
                        <a href="<?php echo base_url('cms/home/viewBookingDetail/'.$row->idBooking.'/') ?>" class="btn btn-danger btn-sm">Check Out</a>
                      <?php
                        } else {
                      ?>
                        <a href="#" class="btn btn-danger btn-sm" disabled>Check Out</a>
                      <?php
                        }
                      ?>
                    </td>
                    <!-- <td><?php echo number_format($row->additionalBooking) ?></td>
                    <td><?php echo number_format($row->chargeBooking) ?></td> -->
                    <td><a href="<?php echo base_url('cms/home/viewBookingDetail/'.$row->idBooking.'/') ?>" class="btn btn-primary">View Detail</a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="checkin" role="tabpanel" aria-labelledby="checkin-tab">
              <table id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Nomor Kamar</th>
                    <th>Nama Tamu</th>
                    <th>Type Kamar</th>
                    <th>Upgrade Kamar</th>
                    <th>Status</th>
                    <th>Rate Code</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Additional</th>
                    <th>Charge</th>
                    <th>Add By</th>
                    <th>Action</th>
                  </tr>
                </thead>
                  <tbody>
                  <?php
                    $displayed_numberroom = array();
                    foreach($booking as $row) {
                      $dateNow = date('Y-m-d');
                      if (!in_array($row->numberroomBooking, $displayed_numberroom)) {
                      // Add the invoice to the list of displayed invoices
                      $displayed_numberroom[] = $row->numberroomBooking;
                  ?>
                  <tr>
                    <?php
                      if ($row->ketNumber == 'OR') {
                    ?>
                      <td colspan="1">
                        <?php echo $row->numberroomBooking ?>
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendantFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: brown;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
                            <option value="OR">OR</option>
                            <option value="OD">OD</option>
                            <option value="OC">OC</option>
                            <option value="ED">ED</option>
                            <option value="VD">VD</option>
                            <option value="VC">VC</option>
                            <option value="VR">VR</option>
                          </select>
                          <button type="submit" name="submit" value="update">save</button>
                        </form>
                      </td>
                    <?php
                      } elseif ($row->ketNumber == 'OD') {
                    ?>
                      <td colspan="1">
                        <?php echo $row->numberroomBooking ?>
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendantFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: darkblue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
                            <option value="OR">OR</option>
                            <option value="OD">OD</option>
                            <option value="OC">OC</option>
                            <option value="ED">ED</option>
                            <option value="VD">VD</option>
                            <option value="VC">VC</option>
                            <option value="VR">VR</option>
                          </select>
                          <button type="submit" name="submit" value="update">save</button>
                        </form>
                      </td>
                    <?php
                      } elseif ($row->ketNumber == 'OC') {
                    ?>
                      <td colspan="1">
                        <?php echo $row->numberroomBooking ?>
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendantFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: green;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
                            <option value="OR">OR</option>
                            <option value="OD">OD</option>
                            <option value="OC">OC</option>
                            <option value="ED">ED</option>
                            <option value="VD">VD</option>
                            <option value="VC">VC</option>
                            <option value="VR">VR</option>
                          </select>
                          <button type="submit" name="submit" value="update">save</button>
                        </form>
                      </td>
                    <?php
                      } elseif ($row->ketNumber == 'ED') {
                    ?>
                      <td colspan="1">
                        <?php echo $row->numberroomBooking ?>
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendantFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: silver;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
                            <option value="OR">OR</option>
                            <option value="OD">OD</option>
                            <option value="OC">OC</option>
                            <option value="ED">ED</option>
                            <option value="VD">VD</option>
                            <option value="VC">VC</option>
                            <option value="VR">VR</option>
                          </select>
                          <button type="submit" name="submit" value="update">save</button>
                        </form>
                      </td>
                    <?php
                      } elseif ($row->ketNumber == 'VD') {
                    ?>
                      <td colspan="1">
                        <?php echo $row->numberroomBooking ?>
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendantFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: blue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
                            <option value="OR">OR</option>
                            <option value="OD">OD</option>
                            <option value="OC">OC</option>
                            <option value="ED">ED</option>
                            <option value="VD">VD</option>
                            <option value="VC">VC</option>
                            <option value="VR">VR</option>
                          </select>
                          <button type="submit" name="submit" value="update">save</button>
                        </form>
                      </td>
                    <?php
                      } elseif ($row->ketNumber == 'VC') {
                    ?>
                      <td colspan="1">
                        <?php echo $row->numberroomBooking ?>
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendantFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: limegreen;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
                            <option value="OR">OR</option>
                            <option value="OD">OD</option>
                            <option value="OC">OC</option>
                            <option value="ED">ED</option>
                            <option value="VD">VD</option>
                            <option value="VC">VC</option>
                            <option value="VR">VR</option>
                          </select>
                          <button type="submit" name="submit" value="update">save</button>
                        </form>
                      </td>
                    <?php
                      } elseif ($row->ketNumber == 'VR') {
                    ?>
                      <td colspan="1">
                        <?php echo $row->numberroomBooking ?>
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendantFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: orange;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
                            <option value="OR">OR</option>
                            <option value="OD">OD</option>
                            <option value="OC">OC</option>
                            <option value="ED">ED</option>
                            <option value="VD">VD</option>
                            <option value="VC">VC</option>
                            <option value="VR">VR</option>
                          </select>
                          <button type="submit" name="submit" value="update">save</button>
                        </form>
                      </td>
                    <?php
                      }
                    ?>
                    <td><?php echo $row->firstnameBooking ?><br><span class="text-muted text-sm" style="font-size: 10px;"><?php echo $row->checkinremarkBooking ?></span></td>
                    <td><?php echo $row->roomtypeBooking ?></td>
                    <td><?php echo $row->updagradetoBooking ?></td>
                    <td><?php echo $row->statusBooking ?></td>
                    <td><?php echo $row->ratecodeBooking ?></td>
                    <td><?php echo $row->arrivalBooking ?></td>
                    <td><?php echo $row->departureBooking ?><br>
                      <?php 
                        if($dateNow == $row->departureBooking) {
                      ?>
                        <a href="<?php echo base_url('cms/home/viewBookingDetail/'.$row->idBooking.'/') ?>" class="btn btn-danger btn-sm">Check Out</a>
                      <?php
                        } else {
                      ?>
                        <a href="#" class="btn btn-danger btn-sm" disabled>Check Out</a>
                      <?php
                        }
                      ?>
                    </td>
                    <td><?php echo number_format($row->additionalBooking) ?></td>
                    <td><?php echo number_format($row->chargeBooking) ?></td>
                    <td><?php echo $row->emailUser ?></td>
                    <td><a href="<?php echo base_url('cms/home/viewBookingDetail/'.$row->idBooking.'/') ?>" class="btn btn-primary">View Detail</a> | <a href="<?php echo base_url('cms/home/viewBookingCopy/'.$row->idBooking.'/') ?>" class="btn btn-warning">Duplikat Booking</a></td>
                  </tr>
                  <?php } } ?>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="checkin-app" role="tabpanel" aria-labelledby="checkin-app-tab">
              <table id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Nama Tamu</th>
                    <th>Type Kamar</th>
                    <th>Upgrade Kamar</th>
                    <th>Status</th>
                    <th>Rate Code</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Additional</th>
                    <th>Charge</th>
                    <th>Add By</th>
                    <th>Action</th>
                  </tr>
                </thead>
                  <tbody>
                  <?php
                    $booking_app = array();
                    $this->db->from('booking');
                    $this->db->join('user', 'user.idUser=booking.idUser');
                    $this->db->where('booking.idBusiness', $this->session->userdata('idBusiness'));
                    $this->db->where('statusBooking', 'Confirm');
                    $this->db->where('segmentBooking', 'OTA-SDJ');
                    $this->db->order_by('booking.createdAtBooking', 'DESC');
                    $query = $this->db->get();
                    if ($query->num_rows() > 0)
                    {
                      foreach ($query->result() as $row)
                      {
                        $booking_app[] = $row;
                      }
                    }
                    $query->free_result();
                    foreach($booking_app as $row) {
                  ?>
                  <tr>
                    <td><?php echo $row->firstnameBooking ?><br><span class="text-muted text-sm" style="font-size: 10px;"><?php echo $row->checkinremarkBooking ?></span></td>
                    <td><?php echo $row->roomtypeBooking ?></td>
                    <td><?php echo $row->updagradetoBooking ?></td>
                    <td><?php echo $row->statusBooking ?></td>
                    <td><?php echo $row->ratecodeBooking ?></td>
                    <td><?php echo $row->arrivalBooking ?></td>
                    <td><?php echo $row->departureBooking ?><br>
                      <?php 
                        if($dateNow == $row->departureBooking) {
                      ?>
                        <a href="<?php echo base_url('cms/home/viewBookingDetail/'.$row->idBooking.'/') ?>" class="btn btn-danger btn-sm">Check Out</a>
                      <?php
                        } else {
                      ?>
                        <a href="#" class="btn btn-danger btn-sm" disabled>Check Out</a>
                      <?php
                        }
                      ?>
                    </td>
                    <td><?php echo number_format($row->additionalBooking) ?></td>
                    <td><?php echo number_format($row->chargeBooking) ?></td>
                    <td><?php echo $row->emailUser ?></td>
                    <td><a href="<?php echo base_url('cms/home/viewBookingDetail/'.$row->idBooking.'/') ?>" class="btn btn-primary">View Detail</a> | <a href="<?php echo base_url('cms/home/viewBookingCopy/'.$row->idBooking.'/') ?>" class="btn btn-warning">Duplikat Booking</a></td>
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
<!-- /page content -->