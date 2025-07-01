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
  #myTab {
    position: sticky;
    top: 0px;
    background-color: #fff; /* Set your desired background color */
    z-index: 1000;
    padding-top: 30px;
  }
  ul.bar_tabs {
    overflow: visible;
    background: #F5F7FA;
    height: 80px;
    margin: 0px 0 0px;
    padding-left: 14px;
    position: relative;
    z-index: 1;
    width: 100%;
    border-bottom: 1px solid #E6E9ED;
  }
  /* Add the following styles to your stylesheet */
  .table-sticky thead th {
    position: sticky;
    top: 80px;
    background-color: #f8f9fa; /* Set your desired background color */
    z-index: 1000;
  }
  ul.bar_tabs>li {
    border: 1px solid #E6E9ED;
    color: #333 !important;
    margin-top: 0px;
    margin-left: 8px;
    background: #fff;
    border-bottom: none;
    border-radius: 4px 4px 0 0;
  }
  ul.bar_tabs>li.active {
    border-right: 6px solid #D3D6DA;
    border-top: 0;
    margin-top: 0px;
  }
</style>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
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
              <table class="table table-striped table-bordered table-sticky">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Kamar</th>
                    <th>Nama Tamu</th>
                    <th>Status</th>
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
                    <td></td>
                    <?php
                      if ($row->ketNumber == 'OR') {
                    ?>
                      <td colspan="1">
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: brown;color: white;">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                      }
                    }
                    ?>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="or" role="tabpanel" aria-labelledby="or-tab">
              <table class="table table-striped table-bordered table-sticky">
                <thead>
                  <tr>
                    <th>Nomor Kamar</th>
                    <th>Nama Tamu</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $displayed_name = array(); // Array to keep track of displayed invoices
                    foreach($roomattendant_or as $row) {
                      if (!in_array($row->nmNumber, $displayed_name)) {
                      // Add the invoice to the list of displayed invoices
                      $displayed_name[] = $row->nmNumber;
                  ?>
                  <tr>
                    <td><?php echo $row->nmNumber ?></td>
                    <td></td>
                    <?php
                      if ($row->ketNumber == 'OR') {
                    ?>
                      <td colspan="1">
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: brown;color: white;">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                      }
                    }
                    ?>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="od" role="tabpanel" aria-labelledby="od-tab">
              <table class="table table-striped table-bordered table-sticky">
                <thead>
                  <tr>
                    <th>Nomor Kamar</th>
                    <th>Nama Tamu</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $displayed_name = array(); // Array to keep track of displayed invoices
                    foreach($roomattendant_od as $row) {
                      if (!in_array($row->nmNumber, $displayed_name)) {
                      // Add the invoice to the list of displayed invoices
                      $displayed_name[] = $row->nmNumber;
                  ?>
                  <tr>
                    <td><?php echo $row->nmNumber ?></td>
                    <td></td>
                    <?php
                      if ($row->ketNumber == 'OR') {
                    ?>
                      <td colspan="1">
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: brown;color: white;">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                      }
                    }
                    ?>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="oc" role="tabpanel" aria-labelledby="oc-tab">
              <table class="table table-striped table-bordered table-sticky">
                <thead>
                  <tr>
                    <th>Nomor Kamar</th>
                    <th>Nama Tamu</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $displayed_name = array(); // Array to keep track of displayed invoices
                    foreach($roomattendant_oc as $row) {
                      if (!in_array($row->nmNumber, $displayed_name)) {
                      // Add the invoice to the list of displayed invoices
                      $displayed_name[] = $row->nmNumber;
                  ?>
                  <tr>
                    <td><?php echo $row->nmNumber ?></td>
                    <td></td>
                    <?php
                      if ($row->ketNumber == 'OR') {
                    ?>
                      <td colspan="1">
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: brown;color: white;">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                      }
                    }
                    ?>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="ed" role="tabpanel" aria-labelledby="ed-tab">
              <table class="table table-striped table-bordered table-sticky">
                <thead>
                  <tr>
                    <th>Nomor Kamar</th>
                    <th>Nama Tamu</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $displayed_name = array(); // Array to keep track of displayed invoices
                    foreach($roomattendant_ed as $row) {
                      if (!in_array($row->nmNumber, $displayed_name)) {
                      // Add the invoice to the list of displayed invoices
                      $displayed_name[] = $row->nmNumber;
                  ?>
                  <tr>
                    <td><?php echo $row->nmNumber ?></td>
                    <td></td>
                    <?php
                      if ($row->ketNumber == 'OR') {
                    ?>
                      <td colspan="1">
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: brown;color: white;">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                      }
                    }
                    ?>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="vd" role="tabpanel" aria-labelledby="vd-tab">
              <table class="table table-striped table-bordered table-sticky">
                <thead>
                  <tr>
                    <th>Nomor Kamar</th>
                    <th>Nama Tamu</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $displayed_name = array(); // Array to keep track of displayed invoices
                    foreach($roomattendant_vd as $row) {
                      if (!in_array($row->nmNumber, $displayed_name)) {
                      // Add the invoice to the list of displayed invoices
                      $displayed_name[] = $row->nmNumber;
                  ?>
                  <tr>
                    <td><?php echo $row->nmNumber ?></td>
                    <td></td>
                    <?php
                      if ($row->ketNumber == 'OR') {
                    ?>
                      <td colspan="1">
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: brown;color: white;">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                      }
                    }
                    ?>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="vc" role="tabpanel" aria-labelledby="vc-tab">
              <table class="table table-striped table-bordered table-sticky">
                <thead>
                  <tr>
                    <th>Nomor Kamar</th>
                    <th>Nama Tamu</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $displayed_name = array(); // Array to keep track of displayed invoices
                    foreach($roomattendant_vc as $row) {
                      if (!in_array($row->nmNumber, $displayed_name)) {
                      // Add the invoice to the list of displayed invoices
                      $displayed_name[] = $row->nmNumber;
                  ?>
                  <tr>
                    <td><?php echo $row->nmNumber ?></td>
                    <td></td>
                    <?php
                      if ($row->ketNumber == 'OR') {
                    ?>
                      <td colspan="1">
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: brown;color: white;">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                      }
                    }
                    ?>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="vr" role="tabpanel" aria-labelledby="vr-tab">
              <table class="table table-striped table-bordered table-sticky">
                <thead>
                  <tr>
                    <th>Nomor Kamar</th>
                    <th>Nama Tamu</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $displayed_name = array(); // Array to keep track of displayed invoices
                    foreach($roomattendant_vr as $row) {
                      if (!in_array($row->nmNumber, $displayed_name)) {
                      // Add the invoice to the list of displayed invoices
                      $displayed_name[] = $row->nmNumber;
                  ?>
                  <tr>
                    <td><?php echo $row->nmNumber ?></td>
                    <td></td>
                    <?php
                      if ($row->ketNumber == 'OR') {
                    ?>
                      <td colspan="1">
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: brown;color: white;">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                      }
                    }
                    ?>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="oo" role="tabpanel" aria-labelledby="oo-tab">
              <table class="table table-striped table-bordered table-sticky">
                <thead>
                  <tr>
                    <th>Nomor Kamar</th>
                    <th>Nama Tamu</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $displayed_name = array(); // Array to keep track of displayed invoices
                    foreach($roomattendant_oo as $row) {
                      if (!in_array($row->nmNumber, $displayed_name)) {
                      // Add the invoice to the list of displayed invoices
                      $displayed_name[] = $row->nmNumber;
                  ?>
                  <tr>
                    <td><?php echo $row->nmNumber ?></td>
                    <td></td>
                    <?php
                      if ($row->ketNumber == 'OR') {
                    ?>
                      <td colspan="1">
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                          <select id="status" name="ketNumber" class="form-control" style="background: brown;color: white;">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                        <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRoomStatusFO/'.$row->nmNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
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
                      }
                    }
                    ?>
                  </tr>
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
<script type="text/javascript">
  $(document).ready(function () {
    var navTabs = $("#myTab");

    $(window).scroll(function () {
      var scrollPosition = $(this).scrollTop();

      // Adjust the threshold as needed
      var threshold = 100;

      if (scrollPosition > threshold) {
        navTabs.addClass("sticky");
      } else {
        navTabs.removeClass("sticky");
      }
    });
    var table = $('.table-sticky');

    $(window).scroll(function () {
        var scrollPosition = $(this).scrollTop();

        // Adjust the threshold as needed
        var threshold = table.offset().top + 10;

        if (scrollPosition > threshold) {
            table.find('thead').addClass('sticky');
        } else {
            table.find('thead').removeClass('sticky');
        }
    });
  });

</script>