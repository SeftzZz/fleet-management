        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Checkout</h3>
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
                    <h2>View Checkout</h2>
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
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Nomor Kamar</th>
                          <th>Nama Tamu</th>
                          <th>Type Kamar</th>
                          <th>Rate Code</th>
                          <th>Check In</th>
                          <th>Check Out</th>
                          <th>Additional</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                        <tbody>
                        <?php
                          foreach($booking as $row) {
                            $dateNow = date('Y-m-d');
                        ?>
                        <tr>
                          <?php
                            if ($row->ketNumber == 'OR') {
                          ?>
                            <td colspan="1">
                              <?php echo $row->numberroomBooking ?>
                              <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendantFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                                <select id="status" name="ketNumber" class="form-control" style="background: green;color: white;">
                                  <option value><?php echo $row->ketNumber ?></option>
                                  <option value="OD">OD</option>
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
                                <select id="status" name="ketNumber" class="form-control" style="background: brown;color: white;">
                                  <option value><?php echo $row->ketNumber ?></option>
                                  <option value="OC">OC</option>
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
                                <select id="status" name="ketNumber" class="form-control" style="background: orange;color: white;">
                                  <option value><?php echo $row->ketNumber ?></option>
                                  <option value="OD">OD</option>
                                  <option value="ED">ED</option>
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
                                  <option value><?php echo $row->ketNumber ?></option>
                                  <option value="VD">VD</option>
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
                                <select id="status" name="ketNumber" class="form-control" style="background: red;color: white;">
                                  <option value><?php echo $row->ketNumber ?></option>
                                  <option value="VC">VC</option>
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
                                <select id="status" name="ketNumber" class="form-control" style="background: yellow;color: white;">
                                  <option value><?php echo $row->ketNumber ?></option>
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
                                <select id="status" name="ketNumber" class="form-control" style="background: blue;color: white;">
                                  <option value><?php echo $row->ketNumber ?></option>
                                  <option value="OR">OR</option>
                                </select>
                                <button type="submit" name="submit" value="update">save</button>
                              </form>
                            </td>
                          <?php
                            }
                          ?>
                          <td><?php echo $row->firstnameBooking ?><br><span class="text-muted text-sm" style="font-size: 10px;"><?php echo $row->checkinremarkBooking ?></span></td>
                          <td><?php echo $row->roomtypeBooking ?></td>
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
                          <td><a href="<?php echo base_url('cms/home/viewBookingDetail/'.$row->idBooking.'/') ?>" class="btn btn-primary">View Detail</a></td>
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
        <!-- /page content -->