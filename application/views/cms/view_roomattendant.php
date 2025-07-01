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
              <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">ALL</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="or-tab" data-toggle="tab" href="#or" role="tab" aria-controls="or" aria-selected="true">OR</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="od-tab" data-toggle="tab" href="#od" role="tab" aria-controls="od" aria-selected="false">OD</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="oc-tab" data-toggle="tab" href="#oc" role="tab" aria-controls="oc" aria-selected="false">OC</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="ed-tab" data-toggle="tab" href="#ed" role="tab" aria-controls="ed" aria-selected="true">ED</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="vd-tab" data-toggle="tab" href="#vd" role="tab" aria-controls="vd" aria-selected="false">VD</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="vc-tab" data-toggle="tab" href="#vc" role="tab" aria-controls="vc" aria-selected="false">VC</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="vr-tab" data-toggle="tab" href="#vr" role="tab" aria-controls="vr" aria-selected="false">VR</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="oo-tab" data-toggle="tab" href="#oo" role="tab" aria-controls="oo" aria-selected="false">OO</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active in" id="all" role="tabpanel" aria-labelledby="all-tab">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Kamar</th>
                    <th>Status</th>
                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                      <th>ED</th>
                      <th>EA</th>
                      <th>Start</th>
                      <th>Stop</th>
                      <?php
                      foreach($taskTypes as $taskType) {
                      ?>
                          <th> <?php echo $taskType->displayName ?> </th>
                      <?php } ?>
                      <th>REMARK</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    $displayed_name = array(); // Array to keep track of displayed invoices
                    foreach($roomattendant_all as $row) {
                      if (!in_array($row->nmNumber, $displayed_name)) {
                      // Add the invoice to the list of displayed invoices
                      $displayed_name[] = $row->nmNumber;
                  ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row->nmNumber ?></td>
                    <?php
                      // if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                    <!-- <?php
                      if ($row->ketNumber == 'OR') {
                    ?>
                     <td colspan="1">
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: darkblue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: darkblue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: green;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: silver;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: blue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: limegreen;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                      <td style="background-color: orange;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                    <?php
                      } elseif ($row->ketNumber == 'OO') {
                    ?>
                      <td style="background-color: red;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                    <?php
                      }
                    ?> -->
                    <?php
                      // } else {
                    ?>
                      <?php
                        if ($row->ketNumber == 'OR') {
                      ?>
                        <td style="background-color: brown;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OD') {
                      ?>
                        <td style="background-color: darkblue;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OC') {
                      ?>
                        <td style="background-color: green;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'ED') {
                      ?>
                        <td style="background-color: silver;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VD') {
                      ?>
                        <td style="background-color: blue;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VC') {
                      ?>
                        <td style="background-color: limegreen;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VR') {
                      ?>
                        <td style="background-color: orange;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OO') {
                      ?>
                        <td style="background-color: red;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } 
                        ?>
                    <?php
                      // }
                    ?>
                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                      <td><?php if(isset($checkoutRoomNumber[$row->nmNumber])) { echo '<a disabled class="#"><i class="fa fa-check"></i> </a>'; } else { echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>'; } ?></td>
                      <td><?php if(isset($checkinRoomNumber[$row->nmNumber])) { echo '<a disabled class="#"><i class="fa fa-check"></i> </a>'; } else { echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>'; } ?></td>
                      <td>
                          <?php if(isset($taskAttendant[$row->nmNumber]['startWork'])) {
                              echo $taskAttendant[$row->nmNumber]['startWork'];
                          } ?>
                      </td>
                      <td>
                          <?php if(isset($taskAttendant[$row->nmNumber]['endWork'])) {
                              echo $taskAttendant[$row->nmNumber]['endWork'];
                          } ?>
                      </td>

                      <?php
                        foreach($taskTypes as $taskType) {
                      ?>
                          <td><?php if(isset($taskAttendant[$row->nmNumber]['details'][$taskType->name]['status']) &&
                                  $taskAttendant[$row->nmNumber]['details'][$taskType->name]['status'] == true) {
                                  echo '<a disabled class="#"><i class="fa fa-check"></i> </a>';
                          } else {
                                  echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>';
                          }?></td>
                      <?php } ?>
                      <td><?php if(isset($taskAttendant[$row->nmNumber]['remark'])) {
                                echo $taskAttendant[$row->nmNumber]['remark'];
                      } ?></td>
                    <?php } ?>
                  </tr>
                  <!-- Modal Room Attendant -->
                  <div class="modal fade" id="roomattendantModal<?php echo $row->nmNumber; ?>" tabindex="-1" role="dialog" aria-labelledby="roomattendantModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="roomattendantModalLabel">Modal title <?php echo $row->nmNumber; ?>"</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        
                          <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                            <input type="hidden" name="idBusiness" value="<?php echo $this->session->userdata('idBusiness') ?>">
                            <input type="hidden" name="roomAttendant" value="<?php echo $row->nmNumber ?>">
                            <div class="modal-body">
                              <div class="row">

                                  <?php foreach ($taskTypes as $taskType) {?>
                                      <div class="col-md-2">
                                          <div class="item form-group text-center">
                                              <label class="col-form-label col-md-12 col-sm-12 label-align" for="<?php echo $taskType->name ?>" style="font-size: 8px;"> <?php echo $taskType->displayName ?>
                                              </label>
                                              <div class="col-md-12 col-sm-12">
                                                  <?php if(isset($taskAttendant[$row->nmNumber]['details'][$taskType->name]['status']) &&
                                                      $taskAttendant[$row->nmNumber]['details'][$taskType->name]['status'] == true)  {
                                                      echo '<a disabled class="#"><i class="fa fa-check"></i> </a><input type="hidden" id="'.$taskType->name.'" name="combAttendant" value="1" class="form-control form-check-input" />';
                                                  } else { echo '<input type="checkbox" id="'.$taskType->name.'" name="combAttendant" value="1" class="form-control form-check-input" />';
                                                  } ?>
                                              </div>
                                          </div>
                                      </div>
                                  <?php } ?>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <div class="col-md-12">
                                <div class="item form-group">
                                  <label class="col-form-label col-md-12 col-sm-12 label-align" for="img1Attendant" style="font-size: 8px;">PHOTOS
                                  </label>
                                  <div class="col-md-12 col-sm-12">
                                    <input type="file" id="img1Attendant" name="img1Attendant" class="form-control">
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="item form-group">
                                  <label class="col-form-label col-md-12 col-sm-12 label-align" for="remarkAttendant" style="font-size: 8px;">REMARK
                                  </label>
                                  <div class="col-md-12 col-sm-12">
                                    <input type="text" id="remarkAttendant" name="remarkAttendant" class="form-control">
                                  </div>
                                </div>
                              </div>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <input type="submit" name="submit" class="btn btn-primary" value="Save"></input>
                            </div>
                          </form>
                      </div>
                    </div>
                  </div>
                  <?php } } ?>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade in" id="or" role="tabpanel" aria-labelledby="or-tab">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Kamar</th>
                    <th>Status</th>
                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                      <th>ED</th>
                      <th>EA</th>
                      <th>Start</th>
                      <th>Stop</th>
                      <?php
                      foreach($taskTypes as $taskType) {
                      ?>
                          <th> <?php echo $taskType->displayName ?> </th>
                      <?php } ?>
                      <th>REMARK</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    $displayed_name = array(); // Array to keep track of displayed invoices
                    foreach($roomattendant_or as $row) {
                      if (!in_array($row->nmNumber, $displayed_name)) {
                      // Add the invoice to the list of displayed invoices
                      $displayed_name[] = $row->nmNumber;
                  ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row->nmNumber ?></td>
                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                    <?php
                      if ($row->ketNumber == 'OR') {
                    ?>
                     <td colspan="1">
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: darkblue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: darkblue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: green;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: silver;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: blue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: limegreen;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                      <td style="background-color: orange;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                    <?php
                      } elseif ($row->ketNumber == 'OO') {
                    ?>
                      <td style="background-color: red;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                    <?php
                      }
                    ?>
                    <?php
                      } else {
                    ?>
                      <?php
                        if ($row->ketNumber == 'OR') {
                      ?>
                        <td style="background-color: brown;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OD') {
                      ?>
                        <td style="background-color: darkblue;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OC') {
                      ?>
                        <td style="background-color: green;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'ED') {
                      ?>
                        <td style="background-color: silver;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VD') {
                      ?>
                        <td style="background-color: blue;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VC') {
                      ?>
                        <td style="background-color: limegreen;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VR') {
                      ?>
                        <td style="background-color: orange;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OO') {
                      ?>
                        <td style="background-color: red;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } 
                        ?>
                    <?php
                    }
                    ?>

                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                      <td><?php if(isset($checkoutRoomNumber[$row->nmNumber])) { echo '<a disabled class="#"><i class="fa fa-check"></i> </a>'; } else { echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>'; } ?></td>
                      <td><?php if(isset($checkinRoomNumber[$row->nmNumber])) { echo '<a disabled class="#"><i class="fa fa-check"></i> </a>'; } else { echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>'; } ?></td>
                      <td>
                          <?php if(isset($taskAttendant[$row->nmNumber]['startWork'])) {
                              echo $taskAttendant[$row->nmNumber]['startWork'];
                          } ?>
                      </td>
                      <td>
                          <?php if(isset($taskAttendant[$row->nmNumber]['endWork'])) {
                              echo $taskAttendant[$row->nmNumber]['endWork'];
                          } ?>
                      </td>

                      <?php
                        foreach($taskTypes as $taskType) {
                      ?>
                          <td><?php if(isset($taskAttendant[$row->nmNumber]['details'][$taskType->name]['status']) &&
                                  $taskAttendant[$row->nmNumber]['details'][$taskType->name]['status'] == true) {
                                  echo '<a disabled class="#"><i class="fa fa-check"></i> </a>';
                          } else {
                                  echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>';
                          }?></td>
                      <?php } ?>
                      <td><?php if(isset($taskAttendant[$row->nmNumber]['remark'])) {
                                echo $taskAttendant[$row->nmNumber]['remark'];
                      } ?></td>
                    <?php } ?>
                  </tr>
                  <!-- Modal Room Attendant -->
                  <div class="modal fade" id="roomattendantModal<?php echo $row->nmNumber; ?>" tabindex="-1" role="dialog" aria-labelledby="roomattendantModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="roomattendantModalLabel">Modal title <?php echo $row->nmNumber; ?>"</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        
                          <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                            <input type="hidden" name="idBusiness" value="<?php echo $this->session->userdata('idBusiness') ?>">
                            <input type="hidden" name="roomAttendant" value="<?php echo $row->nmNumber ?>">
                            <div class="modal-body">
                              <div class="row">

                                  <?php foreach ($taskTypes as $taskType) {?>
                                      <div class="col-md-2">
                                          <div class="item form-group text-center">
                                              <label class="col-form-label col-md-12 col-sm-12 label-align" for="<?php echo $taskType->name ?>" style="font-size: 8px;"> <?php echo $taskType->displayName ?>
                                              </label>
                                              <div class="col-md-12 col-sm-12">
                                                  <?php if(isset($taskAttendant[$row->nmNumber]['details'][$taskType->name]['status']) &&
                                                      $taskAttendant[$row->nmNumber]['details'][$taskType->name]['status'] == true)  {
                                                      echo '<a disabled class="#"><i class="fa fa-check"></i> </a><input type="hidden" id="'.$taskType->name.'" name="combAttendant" value="1" class="form-control form-check-input" />';
                                                  } else { echo '<input type="checkbox" id="'.$taskType->name.'" name="combAttendant" value="1" class="form-control form-check-input" />';
                                                  } ?>
                                              </div>
                                          </div>
                                      </div>
                                  <?php } ?>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <div class="col-md-12">
                                <div class="item form-group">
                                  <label class="col-form-label col-md-12 col-sm-12 label-align" for="img1Attendant" style="font-size: 8px;">PHOTOS
                                  </label>
                                  <div class="col-md-12 col-sm-12">
                                    <input type="file" id="img1Attendant" name="img1Attendant" class="form-control">
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="item form-group">
                                  <label class="col-form-label col-md-12 col-sm-12 label-align" for="remarkAttendant" style="font-size: 8px;">REMARK
                                  </label>
                                  <div class="col-md-12 col-sm-12">
                                    <input type="text" id="remarkAttendant" name="remarkAttendant" class="form-control">
                                  </div>
                                </div>
                              </div>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <input type="submit" name="submit" class="btn btn-primary" value="Save"></input>
                            </div>
                          </form>
                      </div>
                    </div>
                  </div>
                  <?php } } ?>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade in" id="od" role="tabpanel" aria-labelledby="od-tab">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Kamar</th>
                    <th>Status</th>
                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                      <th>ED</th>
                      <th>EA</th>
                      <th>Start</th>
                      <th>Stop</th>
                      <?php
                      foreach($taskTypes as $taskType) {
                      ?>
                          <th> <?php echo $taskType->displayName ?> </th>
                      <?php } ?>
                      <th>REMARK</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    $displayed_name = array(); // Array to keep track of displayed invoices
                    foreach($roomattendant_od as $row) {
                      if (!in_array($row->nmNumber, $displayed_name)) {
                      // Add the invoice to the list of displayed invoices
                      $displayed_name[] = $row->nmNumber;
                  ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row->nmNumber ?></td>
                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                    <?php
                      if ($row->ketNumber == 'OR') {
                    ?>
                     <td colspan="1">
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: darkblue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: darkblue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: green;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: silver;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: blue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: limegreen;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                      <td style="background-color: orange;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                    <?php
                      } elseif ($row->ketNumber == 'OO') {
                    ?>
                      <td style="background-color: red;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                    <?php
                      }
                    ?>
                    <?php
                      } else {
                    ?>
                      <?php
                        if ($row->ketNumber == 'OR') {
                      ?>
                        <td style="background-color: brown;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OD') {
                      ?>
                        <td style="background-color: darkblue;color: white;text-align: center;" data-toggle="modal" data-target="#odroomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OC') {
                      ?>
                        <td style="background-color: green;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'ED') {
                      ?>
                        <td style="background-color: silver;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VD') {
                      ?>
                        <td style="background-color: blue;color: white;text-align: center;" data-toggle="modal" data-target="#odroomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VC') {
                      ?>
                        <td style="background-color: limegreen;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VR') {
                      ?>
                        <td style="background-color: orange;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OO') {
                      ?>
                        <td style="background-color: red;color: white;text-align: center;" data-toggle="modal" data-target="#odroomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } 
                        ?>
                    <?php
                    }
                    ?>

                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                      <td><?php if(isset($checkoutRoomNumber[$row->nmNumber])) { echo '<a disabled class="#"><i class="fa fa-check"></i> </a>'; } else { echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>'; } ?></td>
                      <td><?php if(isset($checkinRoomNumber[$row->nmNumber])) { echo '<a disabled class="#"><i class="fa fa-check"></i> </a>'; } else { echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>'; } ?></td>
                      <td>
                          <?php if(isset($taskAttendant[$row->nmNumber]['startWork'])) {
                              echo $taskAttendant[$row->nmNumber]['startWork'];
                          } ?>
                      </td>
                      <td>
                          <?php if(isset($taskAttendant[$row->nmNumber]['endWork'])) {
                              echo $taskAttendant[$row->nmNumber]['endWork'];
                          } ?>
                      </td>

                      <?php
                        foreach($taskTypes as $taskType) {
                      ?>
                          <td><?php if(isset($taskAttendant[$row->nmNumber]['details'][$taskType->name]['status']) &&
                                  $taskAttendant[$row->nmNumber]['details'][$taskType->name]['status'] == true) {
                                  echo '<a disabled class="#"><i class="fa fa-check"></i> </a>';
                          } else {
                                  echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>';
                          }?></td>
                      <?php } ?>
                      <td><?php if(isset($taskAttendant[$row->nmNumber]['remark'])) {
                                echo $taskAttendant[$row->nmNumber]['remark'];
                      } ?></td>
                    <?php } ?>
                  </tr>
                  <!-- Modal Room Attendant -->
                  <div class="modal fade" id="odroomattendantModal<?php echo $row->nmNumber; ?>" tabindex="-1" role="dialog" aria-labelledby="odroomattendantModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="odroomattendantModalLabel">Modal title <?php echo $row->nmNumber; ?>"</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        
                          <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                            <input type="hidden" name="idBusiness" value="<?php echo $this->session->userdata('idBusiness') ?>">
                            <input type="hidden" name="roomAttendant" value="<?php echo $row->nmNumber ?>">
                            <div class="modal-body">
                              <div class="row">

                                  <?php foreach ($taskTypes as $taskType) {?>
                                      <div class="col-md-2">
                                          <div class="item form-group text-center">
                                              <label class="col-form-label col-md-12 col-sm-12 label-align" for="<?php echo $taskType->name ?>" style="font-size: 8px;"> <?php echo $taskType->displayName ?>
                                              </label>
                                              <div class="col-md-12 col-sm-12">
                                                  <?php if(isset($taskAttendant[$row->nmNumber]['details'][$taskType->name]['status']) &&
                                                      $taskAttendant[$row->nmNumber]['details'][$taskType->name]['status'] == true)  {
                                                      echo '<a disabled class="#"><i class="fa fa-check"></i> </a><input type="hidden" id="'.$taskType->name.'" name="combAttendant" value="1" class="form-control form-check-input" />';
                                                  } else { echo '<input type="checkbox" id="'.$taskType->name.'" name="combAttendant" value="1" class="form-control form-check-input" />';
                                                  } ?>
                                              </div>
                                          </div>
                                      </div>
                                  <?php } ?>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <div class="col-md-12">
                                <div class="item form-group">
                                  <label class="col-form-label col-md-12 col-sm-12 label-align" for="img1Attendant" style="font-size: 8px;">PHOTOS
                                  </label>
                                  <div class="col-md-12 col-sm-12">
                                    <input type="file" id="img1Attendant" name="img1Attendant" class="form-control">
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="item form-group">
                                  <label class="col-form-label col-md-12 col-sm-12 label-align" for="remarkAttendant" style="font-size: 8px;">REMARK
                                  </label>
                                  <div class="col-md-12 col-sm-12">
                                    <input type="text" id="remarkAttendant" name="remarkAttendant" class="form-control">
                                  </div>
                                </div>
                              </div>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <input type="submit" name="submit" class="btn btn-primary" value="Save"></input>
                            </div>
                          </form>
                      </div>
                    </div>
                  </div>
                  <?php } } ?>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade in" id="oc" role="tabpanel" aria-labelledby="oc-tab">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Kamar</th>
                    <th>Status</th>
                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                      <th>ED</th>
                      <th>EA</th>
                      <th>Start</th>
                      <th>Stop</th>
                      <?php
                      foreach($taskTypes as $taskType) {
                      ?>
                          <th> <?php echo $taskType->displayName ?> </th>
                      <?php } ?>
                      <th>REMARK</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    $displayed_name = array(); // Array to keep track of displayed invoices
                    foreach($roomattendant_all as $row) {
                      if (!in_array($row->nmNumber, $displayed_name)) {
                      // Add the invoice to the list of displayed invoices
                      $displayed_name[] = $row->nmNumber;
                  ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row->nmNumber ?></td>
                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                    <?php
                      if ($row->ketNumber == 'OR') {
                    ?>
                     <td colspan="1">
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: darkblue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: darkblue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: green;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: silver;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: blue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: limegreen;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                      <td style="background-color: orange;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                    <?php
                      } elseif ($row->ketNumber == 'OO') {
                    ?>
                      <td style="background-color: red;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                    <?php
                      }
                    ?>
                    <?php
                      } else {
                    ?>
                      <?php
                        if ($row->ketNumber == 'OR') {
                      ?>
                        <td style="background-color: brown;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OD') {
                      ?>
                        <td style="background-color: darkblue;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OC') {
                      ?>
                        <td style="background-color: green;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'ED') {
                      ?>
                        <td style="background-color: silver;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VD') {
                      ?>
                        <td style="background-color: blue;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VC') {
                      ?>
                        <td style="background-color: limegreen;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VR') {
                      ?>
                        <td style="background-color: orange;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OO') {
                      ?>
                        <td style="background-color: red;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } 
                        ?>
                    <?php
                    }
                    ?>

                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                      <td><?php if(isset($checkoutRoomNumber[$row->nmNumber])) { echo '<a disabled class="#"><i class="fa fa-check"></i> </a>'; } else { echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>'; } ?></td>
                      <td><?php if(isset($checkinRoomNumber[$row->nmNumber])) { echo '<a disabled class="#"><i class="fa fa-check"></i> </a>'; } else { echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>'; } ?></td>
                      <td>
                          <?php if(isset($taskAttendant[$row->nmNumber]['startWork'])) {
                              echo $taskAttendant[$row->nmNumber]['startWork'];
                          } ?>
                      </td>
                      <td>
                          <?php if(isset($taskAttendant[$row->nmNumber]['endWork'])) {
                              echo $taskAttendant[$row->nmNumber]['endWork'];
                          } ?>
                      </td>

                      <?php
                        foreach($taskTypes as $taskType) {
                      ?>
                          <td><?php if(isset($taskAttendant[$row->nmNumber]['details'][$taskType->name]['status']) &&
                                  $taskAttendant[$row->nmNumber]['details'][$taskType->name]['status'] == true) {
                                  echo '<a disabled class="#"><i class="fa fa-check"></i> </a>';
                          } else {
                                  echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>';
                          }?></td>
                      <?php } ?>
                      <td><?php if(isset($taskAttendant[$row->nmNumber]['remark'])) {
                                echo $taskAttendant[$row->nmNumber]['remark'];
                      } ?></td>
                    <?php } ?>
                  </tr>
                  <!-- Modal Room Attendant -->
                  <div class="modal fade" id="roomattendantModal<?php echo $row->nmNumber; ?>" tabindex="-1" role="dialog" aria-labelledby="roomattendantModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="roomattendantModalLabel">Modal title <?php echo $row->nmNumber; ?>"</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        
                          <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                            <input type="hidden" name="idBusiness" value="<?php echo $this->session->userdata('idBusiness') ?>">
                            <input type="hidden" name="roomAttendant" value="<?php echo $row->nmNumber ?>">
                            <div class="modal-body">
                              <div class="row">

                                  <?php foreach ($taskTypes as $taskType) {?>
                                      <div class="col-md-2">
                                          <div class="item form-group text-center">
                                              <label class="col-form-label col-md-12 col-sm-12 label-align" for="<?php echo $taskType->name ?>" style="font-size: 8px;"> <?php echo $taskType->displayName ?>
                                              </label>
                                              <div class="col-md-12 col-sm-12">
                                                  <?php if(isset($taskAttendant[$row->nmNumber]['details'][$taskType->name]['status']) &&
                                                      $taskAttendant[$row->nmNumber]['details'][$taskType->name]['status'] == true)  {
                                                      echo '<a disabled class="#"><i class="fa fa-check"></i> </a><input type="hidden" id="'.$taskType->name.'" name="combAttendant" value="1" class="form-control form-check-input" />';
                                                  } else { echo '<input type="checkbox" id="'.$taskType->name.'" name="combAttendant" value="1" class="form-control form-check-input" />';
                                                  } ?>
                                              </div>
                                          </div>
                                      </div>
                                  <?php } ?>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <div class="col-md-12">
                                <div class="item form-group">
                                  <label class="col-form-label col-md-12 col-sm-12 label-align" for="img1Attendant" style="font-size: 8px;">PHOTOS
                                  </label>
                                  <div class="col-md-12 col-sm-12">
                                    <input type="file" id="img1Attendant" name="img1Attendant" class="form-control">
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="item form-group">
                                  <label class="col-form-label col-md-12 col-sm-12 label-align" for="remarkAttendant" style="font-size: 8px;">REMARK
                                  </label>
                                  <div class="col-md-12 col-sm-12">
                                    <input type="text" id="remarkAttendant" name="remarkAttendant" class="form-control">
                                  </div>
                                </div>
                              </div>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <input type="submit" name="submit" class="btn btn-primary" value="Save"></input>
                            </div>
                          </form>
                      </div>
                    </div>
                  </div>
                  <?php } } ?>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade in" id="ed" role="tabpanel" aria-labelledby="ed-tab">
            <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Kamar</th>
                    <th>Status</th>
                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                      <th>ED</th>
                      <th>EA</th>
                      <th>Start</th>
                      <th>Stop</th>
                      <?php
                      foreach($taskTypes as $taskType) {
                      ?>
                          <th> <?php echo $taskType->displayName ?> </th>
                      <?php } ?>
                      <th>REMARK</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    $displayed_name = array(); // Array to keep track of displayed invoices
                    foreach($roomattendant_ed as $row) {
                      if (!in_array($row->nmNumber, $displayed_name)) {
                      // Add the invoice to the list of displayed invoices
                      $displayed_name[] = $row->nmNumber;
                  ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row->nmNumber ?></td>
                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                    <?php
                      if ($row->ketNumber == 'OR') {
                    ?>
                     <td colspan="1">
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: darkblue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: darkblue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: green;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: silver;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: blue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: limegreen;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                      <td style="background-color: orange;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                    <?php
                      } elseif ($row->ketNumber == 'OO') {
                    ?>
                      <td style="background-color: red;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                    <?php
                      }
                    ?>
                    <?php
                      } else {
                    ?>
                      <?php
                        if ($row->ketNumber == 'OR') {
                      ?>
                        <td style="background-color: brown;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OD') {
                      ?>
                        <td style="background-color: darkblue;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OC') {
                      ?>
                        <td style="background-color: green;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'ED') {
                      ?>
                        <td style="background-color: silver;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VD') {
                      ?>
                        <td style="background-color: blue;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VC') {
                      ?>
                        <td style="background-color: limegreen;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VR') {
                      ?>
                        <td style="background-color: orange;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OO') {
                      ?>
                        <td style="background-color: red;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } 
                        ?>
                    <?php
                    }
                    ?>

                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                      <td><?php if(isset($checkoutRoomNumber[$row->nmNumber])) { echo '<a disabled class="#"><i class="fa fa-check"></i> </a>'; } else { echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>'; } ?></td>
                      <td><?php if(isset($checkinRoomNumber[$row->nmNumber])) { echo '<a disabled class="#"><i class="fa fa-check"></i> </a>'; } else { echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>'; } ?></td>
                      <td>
                          <?php if(isset($taskAttendant[$row->nmNumber]['startWork'])) {
                              echo $taskAttendant[$row->nmNumber]['startWork'];
                          } ?>
                      </td>
                      <td>
                          <?php if(isset($taskAttendant[$row->nmNumber]['endWork'])) {
                              echo $taskAttendant[$row->nmNumber]['endWork'];
                          } ?>
                      </td>

                      <?php
                        foreach($taskTypes as $taskType) {
                      ?>
                          <td><?php if(isset($taskAttendant[$row->nmNumber]['details'][$taskType->name]['status']) &&
                                  $taskAttendant[$row->nmNumber]['details'][$taskType->name]['status'] == true) {
                                  echo '<a disabled class="#"><i class="fa fa-check"></i> </a>';
                          } else {
                                  echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>';
                          }?></td>
                      <?php } ?>
                      <td><?php if(isset($taskAttendant[$row->nmNumber]['remark'])) {
                                echo $taskAttendant[$row->nmNumber]['remark'];
                      } ?></td>
                    <?php } ?>
                  </tr>
                  <!-- Modal Room Attendant -->
                  <div class="modal fade" id="roomattendantModal<?php echo $row->nmNumber; ?>" tabindex="-1" role="dialog" aria-labelledby="roomattendantModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="roomattendantModalLabel">Modal title <?php echo $row->nmNumber; ?>"</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        
                          <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                            <input type="hidden" name="idBusiness" value="<?php echo $this->session->userdata('idBusiness') ?>">
                            <input type="hidden" name="roomAttendant" value="<?php echo $row->nmNumber ?>">
                            <div class="modal-body">
                              <div class="row">

                                  <?php foreach ($taskTypes as $taskType) {?>
                                      <div class="col-md-2">
                                          <div class="item form-group text-center">
                                              <label class="col-form-label col-md-12 col-sm-12 label-align" for="<?php echo $taskType->name ?>" style="font-size: 8px;"> <?php echo $taskType->displayName ?>
                                              </label>
                                              <div class="col-md-12 col-sm-12">
                                                  <?php if(isset($taskAttendant[$row->nmNumber]['details'][$taskType->name]['status']) &&
                                                      $taskAttendant[$row->nmNumber]['details'][$taskType->name]['status'] == true)  {
                                                      echo '<a disabled class="#"><i class="fa fa-check"></i> </a><input type="hidden" id="'.$taskType->name.'" name="combAttendant" value="1" class="form-control form-check-input" />';
                                                  } else { echo '<input type="checkbox" id="'.$taskType->name.'" name="combAttendant" value="1" class="form-control form-check-input" />';
                                                  } ?>
                                              </div>
                                          </div>
                                      </div>
                                  <?php } ?>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <div class="col-md-12">
                                <div class="item form-group">
                                  <label class="col-form-label col-md-12 col-sm-12 label-align" for="img1Attendant" style="font-size: 8px;">PHOTOS
                                  </label>
                                  <div class="col-md-12 col-sm-12">
                                    <input type="file" id="img1Attendant" name="img1Attendant" class="form-control">
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="item form-group">
                                  <label class="col-form-label col-md-12 col-sm-12 label-align" for="remarkAttendant" style="font-size: 8px;">REMARK
                                  </label>
                                  <div class="col-md-12 col-sm-12">
                                    <input type="text" id="remarkAttendant" name="remarkAttendant" class="form-control">
                                  </div>
                                </div>
                              </div>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <input type="submit" name="submit" class="btn btn-primary" value="Save"></input>
                            </div>
                          </form>
                      </div>
                    </div>
                  </div>
                  <?php } } ?>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade in" id="vd" role="tabpanel" aria-labelledby="vd-tab">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Kamar</th>
                    <th>Status</th>
                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                      <th>ED</th>
                      <th>EA</th>
                      <th>Start</th>
                      <th>Stop</th>
                      <?php
                      foreach($taskTypes as $taskType) {
                      ?>
                          <th> <?php echo $taskType->displayName ?> </th>
                      <?php } ?>
                      <th>REMARK</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    $displayed_name = array(); // Array to keep track of displayed invoices
                    foreach($roomattendant_vd as $row) {
                      if (!in_array($row->nmNumber, $displayed_name)) {
                      // Add the invoice to the list of displayed invoices
                      $displayed_name[] = $row->nmNumber;
                  ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row->nmNumber ?></td>
                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                    <?php
                      if ($row->ketNumber == 'OR') {
                    ?>
                     <td colspan="1">
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: darkblue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: darkblue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: green;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: silver;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: blue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: limegreen;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                      <td style="background-color: orange;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                    <?php
                      } elseif ($row->ketNumber == 'OO') {
                    ?>
                      <td style="background-color: red;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                    <?php
                      }
                    ?>
                    <?php
                      } else {
                    ?>
                      <?php
                        if ($row->ketNumber == 'OR') {
                      ?>
                        <td style="background-color: brown;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OD') {
                      ?>
                        <td style="background-color: darkblue;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OC') {
                      ?>
                        <td style="background-color: green;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'ED') {
                      ?>
                        <td style="background-color: silver;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VD') {
                      ?>
                        <td style="background-color: blue;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VC') {
                      ?>
                        <td style="background-color: limegreen;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VR') {
                      ?>
                        <td style="background-color: orange;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OO') {
                      ?>
                        <td style="background-color: red;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } 
                        ?>
                    <?php
                    }
                    ?>

                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                      <td><?php if(isset($checkoutRoomNumber[$row->nmNumber])) { echo '<a disabled class="#"><i class="fa fa-check"></i> </a>'; } else { echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>'; } ?></td>
                      <td><?php if(isset($checkinRoomNumber[$row->nmNumber])) { echo '<a disabled class="#"><i class="fa fa-check"></i> </a>'; } else { echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>'; } ?></td>
                      <td>
                          <?php if(isset($taskAttendant[$row->nmNumber]['startWork'])) {
                              echo $taskAttendant[$row->nmNumber]['startWork'];
                          } ?>
                      </td>
                      <td>
                          <?php if(isset($taskAttendant[$row->nmNumber]['endWork'])) {
                              echo $taskAttendant[$row->nmNumber]['endWork'];
                          } ?>
                      </td>

                      <?php
                        foreach($taskTypes as $taskType) {
                      ?>
                          <td><?php if(isset($taskAttendant[$row->nmNumber]['details'][$taskType->name]['status']) &&
                                  $taskAttendant[$row->nmNumber]['details'][$taskType->name]['status'] == true) {
                                  echo '<a disabled class="#"><i class="fa fa-check"></i> </a>';
                          } else {
                                  echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>';
                          }?></td>
                      <?php } ?>
                      <td><?php if(isset($taskAttendant[$row->nmNumber]['remark'])) {
                                echo $taskAttendant[$row->nmNumber]['remark'];
                      } ?></td>
                    <?php } ?>
                  </tr>
                  <!-- Modal Room Attendant -->
                  <div class="modal fade" id="roomattendantModal<?php echo $row->nmNumber; ?>" tabindex="-1" role="dialog" aria-labelledby="roomattendantModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="roomattendantModalLabel">Modal title <?php echo $row->nmNumber; ?>"</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        
                          <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                            <input type="hidden" name="idBusiness" value="<?php echo $this->session->userdata('idBusiness') ?>">
                            <input type="hidden" name="roomAttendant" value="<?php echo $row->nmNumber ?>">
                            <div class="modal-body">
                              <div class="row">

                                  <?php foreach ($taskTypes as $taskType) {?>
                                      <div class="col-md-2">
                                          <div class="item form-group text-center">
                                              <label class="col-form-label col-md-12 col-sm-12 label-align" for="<?php echo $taskType->name ?>" style="font-size: 8px;"> <?php echo $taskType->displayName ?>
                                              </label>
                                              <div class="col-md-12 col-sm-12">
                                                  <?php if(isset($taskAttendant[$row->nmNumber]['details'][$taskType->name]['status']) &&
                                                      $taskAttendant[$row->nmNumber]['details'][$taskType->name]['status'] == true)  {
                                                      echo '<a disabled class="#"><i class="fa fa-check"></i> </a><input type="hidden" id="'.$taskType->name.'" name="combAttendant" value="1" class="form-control form-check-input" />';
                                                  } else { echo '<input type="checkbox" id="'.$taskType->name.'" name="combAttendant" value="1" class="form-control form-check-input" />';
                                                  } ?>
                                              </div>
                                          </div>
                                      </div>
                                  <?php } ?>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <div class="col-md-12">
                                <div class="item form-group">
                                  <label class="col-form-label col-md-12 col-sm-12 label-align" for="img1Attendant" style="font-size: 8px;">PHOTOS
                                  </label>
                                  <div class="col-md-12 col-sm-12">
                                    <input type="file" id="img1Attendant" name="img1Attendant" class="form-control">
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="item form-group">
                                  <label class="col-form-label col-md-12 col-sm-12 label-align" for="remarkAttendant" style="font-size: 8px;">REMARK
                                  </label>
                                  <div class="col-md-12 col-sm-12">
                                    <input type="text" id="remarkAttendant" name="remarkAttendant" class="form-control">
                                  </div>
                                </div>
                              </div>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <input type="submit" name="submit" class="btn btn-primary" value="Save"></input>
                            </div>
                          </form>
                      </div>
                    </div>
                  </div>
                  <?php } } ?>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade in" id="vc" role="tabpanel" aria-labelledby="vc-tab">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Kamar</th>
                    <th>Status</th>
                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                      <th>ED</th>
                      <th>EA</th>
                      <th>Start</th>
                      <th>Stop</th>
                      <?php
                      foreach($taskTypes as $taskType) {
                      ?>
                          <th> <?php echo $taskType->displayName ?> </th>
                      <?php } ?>
                      <th>REMARK</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    $displayed_name = array(); // Array to keep track of displayed invoices
                    foreach($roomattendant_vc as $row) {
                      if (!in_array($row->nmNumber, $displayed_name)) {
                      // Add the invoice to the list of displayed invoices
                      $displayed_name[] = $row->nmNumber;
                  ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row->nmNumber ?></td>
                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                    <?php
                      if ($row->ketNumber == 'OR') {
                    ?>
                     <td colspan="1">
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: darkblue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: darkblue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: green;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: silver;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: blue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: limegreen;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                      <td style="background-color: orange;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                    <?php
                      } elseif ($row->ketNumber == 'OO') {
                    ?>
                      <td style="background-color: red;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                    <?php
                      }
                    ?>
                    <?php
                      } else {
                    ?>
                      <?php
                        if ($row->ketNumber == 'OR') {
                      ?>
                        <td style="background-color: brown;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OD') {
                      ?>
                        <td style="background-color: darkblue;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OC') {
                      ?>
                        <td style="background-color: green;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'ED') {
                      ?>
                        <td style="background-color: silver;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VD') {
                      ?>
                        <td style="background-color: blue;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VC') {
                      ?>
                        <td style="background-color: limegreen;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VR') {
                      ?>
                        <td style="background-color: orange;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OO') {
                      ?>
                        <td style="background-color: red;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } 
                        ?>
                    <?php
                    }
                    ?>

                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                      <td><?php if(isset($checkoutRoomNumber[$row->nmNumber])) { echo '<a disabled class="#"><i class="fa fa-check"></i> </a>'; } else { echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>'; } ?></td>
                      <td><?php if(isset($checkinRoomNumber[$row->nmNumber])) { echo '<a disabled class="#"><i class="fa fa-check"></i> </a>'; } else { echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>'; } ?></td>
                      <td>
                          <?php if(isset($taskAttendant[$row->nmNumber]['startWork'])) {
                              echo $taskAttendant[$row->nmNumber]['startWork'];
                          } ?>
                      </td>
                      <td>
                          <?php if(isset($taskAttendant[$row->nmNumber]['endWork'])) {
                              echo $taskAttendant[$row->nmNumber]['endWork'];
                          } ?>
                      </td>

                      <?php
                        foreach($taskTypes as $taskType) {
                      ?>
                          <td><?php if(isset($taskAttendant[$row->nmNumber]['details'][$taskType->name]['status']) &&
                                  $taskAttendant[$row->nmNumber]['details'][$taskType->name]['status'] == true) {
                                  echo '<a disabled class="#"><i class="fa fa-check"></i> </a>';
                          } else {
                                  echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>';
                          }?></td>
                      <?php } ?>
                      <td><?php if(isset($taskAttendant[$row->nmNumber]['remark'])) {
                                echo $taskAttendant[$row->nmNumber]['remark'];
                      } ?></td>
                    <?php } ?>
                  </tr>
                  <!-- Modal Room Attendant -->
                  <div class="modal fade" id="roomattendantModal<?php echo $row->nmNumber; ?>" tabindex="-1" role="dialog" aria-labelledby="roomattendantModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="roomattendantModalLabel">Modal title <?php echo $row->nmNumber; ?>"</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        
                          <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                            <input type="hidden" name="idBusiness" value="<?php echo $this->session->userdata('idBusiness') ?>">
                            <input type="hidden" name="roomAttendant" value="<?php echo $row->nmNumber ?>">
                            <div class="modal-body">
                              <div class="row">

                                  <?php foreach ($taskTypes as $taskType) {?>
                                      <div class="col-md-2">
                                          <div class="item form-group text-center">
                                              <label class="col-form-label col-md-12 col-sm-12 label-align" for="<?php echo $taskType->name ?>" style="font-size: 8px;"> <?php echo $taskType->displayName ?>
                                              </label>
                                              <div class="col-md-12 col-sm-12">
                                                  <?php if(isset($taskAttendant[$row->nmNumber]['details'][$taskType->name]['status']) &&
                                                      $taskAttendant[$row->nmNumber]['details'][$taskType->name]['status'] == true)  {
                                                      echo '<a disabled class="#"><i class="fa fa-check"></i> </a><input type="hidden" id="'.$taskType->name.'" name="combAttendant" value="1" class="form-control form-check-input" />';
                                                  } else { echo '<input type="checkbox" id="'.$taskType->name.'" name="combAttendant" value="1" class="form-control form-check-input" />';
                                                  } ?>
                                              </div>
                                          </div>
                                      </div>
                                  <?php } ?>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <div class="col-md-12">
                                <div class="item form-group">
                                  <label class="col-form-label col-md-12 col-sm-12 label-align" for="img1Attendant" style="font-size: 8px;">PHOTOS
                                  </label>
                                  <div class="col-md-12 col-sm-12">
                                    <input type="file" id="img1Attendant" name="img1Attendant" class="form-control">
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="item form-group">
                                  <label class="col-form-label col-md-12 col-sm-12 label-align" for="remarkAttendant" style="font-size: 8px;">REMARK
                                  </label>
                                  <div class="col-md-12 col-sm-12">
                                    <input type="text" id="remarkAttendant" name="remarkAttendant" class="form-control">
                                  </div>
                                </div>
                              </div>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <input type="submit" name="submit" class="btn btn-primary" value="Save"></input>
                            </div>
                          </form>
                      </div>
                    </div>
                  </div>
                  <?php } } ?>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade in" id="vr" role="tabpanel" aria-labelledby="vr-tab">
            <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Kamar</th>
                    <th>Status</th>
                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                      <th>ED</th>
                      <th>EA</th>
                      <th>Start</th>
                      <th>Stop</th>
                      <?php
                      foreach($taskTypes as $taskType) {
                      ?>
                          <th> <?php echo $taskType->displayName ?> </th>
                      <?php } ?>
                      <th>REMARK</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    $displayed_name = array(); // Array to keep track of displayed invoices
                    foreach($roomattendant_vr as $row) {
                      if (!in_array($row->nmNumber, $displayed_name)) {
                      // Add the invoice to the list of displayed invoices
                      $displayed_name[] = $row->nmNumber;
                  ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row->nmNumber ?></td>
                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                    <?php
                      if ($row->ketNumber == 'OR') {
                    ?>
                     <td colspan="1">
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: darkblue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: darkblue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: green;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: silver;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: blue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: limegreen;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                      <td style="background-color: orange;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                    <?php
                      } elseif ($row->ketNumber == 'OO') {
                    ?>
                      <td style="background-color: red;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                    <?php
                      }
                    ?>
                    <?php
                      } else {
                    ?>
                      <?php
                        if ($row->ketNumber == 'OR') {
                      ?>
                        <td style="background-color: brown;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OD') {
                      ?>
                        <td style="background-color: darkblue;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OC') {
                      ?>
                        <td style="background-color: green;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'ED') {
                      ?>
                        <td style="background-color: silver;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VD') {
                      ?>
                        <td style="background-color: blue;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VC') {
                      ?>
                        <td style="background-color: limegreen;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VR') {
                      ?>
                        <td style="background-color: orange;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OO') {
                      ?>
                        <td style="background-color: red;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } 
                        ?>
                    <?php
                    }
                    ?>

                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                      <td><?php if(isset($checkoutRoomNumber[$row->nmNumber])) { echo '<a disabled class="#"><i class="fa fa-check"></i> </a>'; } else { echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>'; } ?></td>
                      <td><?php if(isset($checkinRoomNumber[$row->nmNumber])) { echo '<a disabled class="#"><i class="fa fa-check"></i> </a>'; } else { echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>'; } ?></td>
                      <td>
                          <?php if(isset($taskAttendant[$row->nmNumber]['startWork'])) {
                              echo $taskAttendant[$row->nmNumber]['startWork'];
                          } ?>
                      </td>
                      <td>
                          <?php if(isset($taskAttendant[$row->nmNumber]['endWork'])) {
                              echo $taskAttendant[$row->nmNumber]['endWork'];
                          } ?>
                      </td>

                      <?php
                        foreach($taskTypes as $taskType) {
                      ?>
                          <td><?php if(isset($taskAttendant[$row->nmNumber]['details'][$taskType->name]['status']) &&
                                  $taskAttendant[$row->nmNumber]['details'][$taskType->name]['status'] == true) {
                                  echo '<a disabled class="#"><i class="fa fa-check"></i> </a>';
                          } else {
                                  echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>';
                          }?></td>
                      <?php } ?>
                      <td><?php if(isset($taskAttendant[$row->nmNumber]['remark'])) {
                                echo $taskAttendant[$row->nmNumber]['remark'];
                      } ?></td>
                    <?php } ?>
                  </tr>
                  <!-- Modal Room Attendant -->
                  <div class="modal fade" id="roomattendantModal<?php echo $row->nmNumber; ?>" tabindex="-1" role="dialog" aria-labelledby="roomattendantModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="roomattendantModalLabel">Modal title <?php echo $row->nmNumber; ?>"</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        
                          <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                            <input type="hidden" name="idBusiness" value="<?php echo $this->session->userdata('idBusiness') ?>">
                            <input type="hidden" name="roomAttendant" value="<?php echo $row->nmNumber ?>">
                            <div class="modal-body">
                              <div class="row">

                                  <?php foreach ($taskTypes as $taskType) {?>
                                      <div class="col-md-2">
                                          <div class="item form-group text-center">
                                              <label class="col-form-label col-md-12 col-sm-12 label-align" for="<?php echo $taskType->name ?>" style="font-size: 8px;"> <?php echo $taskType->displayName ?>
                                              </label>
                                              <div class="col-md-12 col-sm-12">
                                                  <?php if(isset($taskAttendant[$row->nmNumber]['details'][$taskType->name]['status']) &&
                                                      $taskAttendant[$row->nmNumber]['details'][$taskType->name]['status'] == true)  {
                                                      echo '<a disabled class="#"><i class="fa fa-check"></i> </a><input type="hidden" id="'.$taskType->name.'" name="combAttendant" value="1" class="form-control form-check-input" />';
                                                  } else { echo '<input type="checkbox" id="'.$taskType->name.'" name="combAttendant" value="1" class="form-control form-check-input" />';
                                                  } ?>
                                              </div>
                                          </div>
                                      </div>
                                  <?php } ?>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <div class="col-md-12">
                                <div class="item form-group">
                                  <label class="col-form-label col-md-12 col-sm-12 label-align" for="img1Attendant" style="font-size: 8px;">PHOTOS
                                  </label>
                                  <div class="col-md-12 col-sm-12">
                                    <input type="file" id="img1Attendant" name="img1Attendant" class="form-control">
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="item form-group">
                                  <label class="col-form-label col-md-12 col-sm-12 label-align" for="remarkAttendant" style="font-size: 8px;">REMARK
                                  </label>
                                  <div class="col-md-12 col-sm-12">
                                    <input type="text" id="remarkAttendant" name="remarkAttendant" class="form-control">
                                  </div>
                                </div>
                              </div>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <input type="submit" name="submit" class="btn btn-primary" value="Save"></input>
                            </div>
                          </form>
                      </div>
                    </div>
                  </div>
                  <?php } } ?>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade in" id="oo" role="tabpanel" aria-labelledby="oo-tab">
            <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Kamar</th>
                    <th>Status</th>
                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                      <th>ED</th>
                      <th>EA</th>
                      <th>Start</th>
                      <th>Stop</th>
                      <?php
                      foreach($taskTypes as $taskType) {
                      ?>
                          <th> <?php echo $taskType->displayName ?> </th>
                      <?php } ?>
                      <th>REMARK</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    $displayed_name = array(); // Array to keep track of displayed invoices
                    foreach($roomattendant_oo as $row) {
                      if (!in_array($row->nmNumber, $displayed_name)) {
                      // Add the invoice to the list of displayed invoices
                      $displayed_name[] = $row->nmNumber;
                  ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row->nmNumber ?></td>
                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                    <?php
                      if ($row->ketNumber == 'OR') {
                    ?>
                     <td colspan="1">
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: darkblue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: darkblue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: green;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: silver;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: blue;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: limegreen;color: white;">
                            <option selected value="<?php echo $row->ketNumber ?>"><?php echo $row->ketNumber ?></option>
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
                      <td style="background-color: orange;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                    <?php
                      } elseif ($row->ketNumber == 'OO') {
                    ?>
                      <td style="background-color: red;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                    <?php
                      }
                    ?>
                    <?php
                      } else {
                    ?>
                      <?php
                        if ($row->ketNumber == 'OR') {
                      ?>
                        <td style="background-color: brown;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OD') {
                      ?>
                        <td style="background-color: darkblue;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OC') {
                      ?>
                        <td style="background-color: green;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'ED') {
                      ?>
                        <td style="background-color: silver;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VD') {
                      ?>
                        <td style="background-color: blue;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VC') {
                      ?>
                        <td style="background-color: limegreen;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'VR') {
                      ?>
                        <td style="background-color: orange;color: white;text-align: center;"><?php echo $row->ketNumber ?></td>
                      <?php
                        } elseif ($row->ketNumber == 'OO') {
                      ?>
                        <td style="background-color: red;color: white;text-align: center;" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->nmNumber; ?>"><?php echo $row->ketNumber ?></td>
                      <?php
                        } 
                        ?>
                    <?php
                    }
                    ?>

                    <?php
                      if ($this->session->userdata('level') == '2' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '4') {
                    ?>
                      <td><?php if(isset($checkoutRoomNumber[$row->nmNumber])) { echo '<a disabled class="#"><i class="fa fa-check"></i> </a>'; } else { echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>'; } ?></td>
                      <td><?php if(isset($checkinRoomNumber[$row->nmNumber])) { echo '<a disabled class="#"><i class="fa fa-check"></i> </a>'; } else { echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>'; } ?></td>
                      <td>
                          <?php if(isset($taskAttendant[$row->nmNumber]['startWork'])) {
                              echo $taskAttendant[$row->nmNumber]['startWork'];
                          } ?>
                      </td>
                      <td>
                          <?php if(isset($taskAttendant[$row->nmNumber]['endWork'])) {
                              echo $taskAttendant[$row->nmNumber]['endWork'];
                          } ?>
                      </td>

                      <?php
                        foreach($taskTypes as $taskType) {
                      ?>
                          <td><?php if(isset($taskAttendant[$row->nmNumber]['details'][$taskType->name]['status']) &&
                                  $taskAttendant[$row->nmNumber]['details'][$taskType->name]['status'] == true) {
                                  echo '<a disabled class="#"><i class="fa fa-check"></i> </a>';
                          } else {
                                  echo '<a disabled class="#"><i class="fa fa-uncheck"></i> </a>';
                          }?></td>
                      <?php } ?>
                      <td><?php if(isset($taskAttendant[$row->nmNumber]['remark'])) {
                                echo $taskAttendant[$row->nmNumber]['remark'];
                      } ?></td>
                    <?php } ?>
                  </tr>
                  <!-- Modal Room Attendant -->
                  <div class="modal fade" id="roomattendantModal<?php echo $row->nmNumber; ?>" tabindex="-1" role="dialog" aria-labelledby="roomattendantModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="roomattendantModalLabel">Modal title <?php echo $row->nmNumber; ?>"</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        
                          <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertRoomAttendant/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                            <input type="hidden" name="idBusiness" value="<?php echo $this->session->userdata('idBusiness') ?>">
                            <input type="hidden" name="roomAttendant" value="<?php echo $row->nmNumber ?>">
                            <div class="modal-body">
                              <div class="row">

                                  <?php foreach ($taskTypes as $taskType) {?>
                                      <div class="col-md-2">
                                          <div class="item form-group text-center">
                                              <label class="col-form-label col-md-12 col-sm-12 label-align" for="<?php echo $taskType->name ?>" style="font-size: 8px;"> <?php echo $taskType->displayName ?>
                                              </label>
                                              <div class="col-md-12 col-sm-12">
                                                  <?php if(isset($taskAttendant[$row->nmNumber]['details'][$taskType->name]['status']) &&
                                                      $taskAttendant[$row->nmNumber]['details'][$taskType->name]['status'] == true)  {
                                                      echo '<a disabled class="#"><i class="fa fa-check"></i> </a><input type="hidden" id="'.$taskType->name.'" name="combAttendant" value="1" class="form-control form-check-input" />';
                                                  } else { echo '<input type="checkbox" id="'.$taskType->name.'" name="combAttendant" value="1" class="form-control form-check-input" />';
                                                  } ?>
                                              </div>
                                          </div>
                                      </div>
                                  <?php } ?>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <div class="col-md-12">
                                <div class="item form-group">
                                  <label class="col-form-label col-md-12 col-sm-12 label-align" for="img1Attendant" style="font-size: 8px;">PHOTOS
                                  </label>
                                  <div class="col-md-12 col-sm-12">
                                    <input type="file" id="img1Attendant" name="img1Attendant" class="form-control">
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="item form-group">
                                  <label class="col-form-label col-md-12 col-sm-12 label-align" for="remarkAttendant" style="font-size: 8px;">REMARK
                                  </label>
                                  <div class="col-md-12 col-sm-12">
                                    <input type="text" id="remarkAttendant" name="remarkAttendant" class="form-control">
                                  </div>
                                </div>
                              </div>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <input type="submit" name="submit" class="btn btn-primary" value="Save"></input>
                            </div>
                          </form>
                      </div>
                    </div>
                  </div>
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