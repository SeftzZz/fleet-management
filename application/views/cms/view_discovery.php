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
                  <h2>View FnB <small>Users</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </div>
                <div class="x_content">
                  <table id="datatable-fnb" class="table table-striped table-bordered asc-sort-4">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Photo</th>
                        <th>Keterangan</th>
                        <th>Active/Inactive</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                      <tbody>

                        <?php
                          $displayed_numberroom = array();
                          foreach($discovery as $row) {
                            $dateNow = date('Y-m-d');
                        ?>
                        <tr>
                          <td><?php echo $row->idDiscovery  ?></td>
                          <td><img src="<?php echo '/assets/images/city/' . $row->imgCity; ?>"  width="400" height="300" alt="no picture"/></td>
                          <td><?php echo $row->description?></td>
                            <td><?php if ($row->active == 1) { ?>
                                    <a href="<?php echo base_url('cms/home/inactiveDiscover/'.$row->idDiscovery.'/') ?>" class="btn btn-primary">Inactive</a>
                                <?php } else { ?>
                                    <a href="<?php echo base_url('cms/home/activeDiscover/'.$row->idDiscovery.'/') ?>" class="btn btn-primary">Active</a>
                                <?php }?>
                            </td>
                          <td><a href="<?php echo base_url('cms/home/detailDiscovery/'.$row->idDiscovery.'/') ?>" class="btn btn-primary">Edit</a>
                          </td>
                        </tr>
                        <?php }?>
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> <!-- Add jQuery -->
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script>
  $("#datatable-fnb").length && $("#datatable-fnb").DataTable({
      dom: "Blfrtip",
          order: [[0, 'desc']],
      buttons: [{
          extend: "copy",
          className: "btn-sm"
      }, {
          extend: "csv",
          className: "btn-sm"
      }, {
          extend: "excel",
          className: "btn-sm"
      }, {
          extend: "pdfHtml5",
          className: "btn-sm"
      }, {
          extend: "print",
          className: "btn-sm"
      }],
      responsive: !0
  })
</script>