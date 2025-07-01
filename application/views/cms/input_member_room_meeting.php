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
        <h3>View Booking Room Member </h3>
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
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>View Booking Room Member
            </h2>
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
            <br />
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Nama Member</th>
                  <th>Nomor</th>
                </tr>
              </thead>
              <tbody>
                <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMemberRoom') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                  <?php 
                  $displayed_name = array(); // Array to keep track of displayed invoices
                  foreach($booking_cart as $row) {
                    if (!in_array($row->numberroomBooking, $displayed_name)) {
                    // Add the invoice to the list of displayed invoices
                    $displayed_name[] = $row->numberroomBooking;
                      $number_room = explode(',', $row->numberroomBooking);
                      foreach ($number_room as $room_number):
                        // Loop through each room number
                  ?>
                  <tr>
                    <td>
                      <select class="form-control" name="nmBookingroommember[]">
                        <option value="">Choose Member</option>
                        <?php
                          $company_member = array();
                          $this->db->from('booking_cart');
                          $this->db->join('company', 'company.nmCompany=booking_cart.companyBooking');
                          $this->db->join('company_member', 'company_member.idCompany=company.idCompany');
                          $this->db->where('booking_cart.invoiceBooking', $new_invoice_number);
                          $query = $this->db->get();
                          if ($query->num_rows() > 0)
                          {
                            foreach ($query->result() as $row)
                            {
                              $company_member[] = $row;
                            }
                          }
                          $query->free_result();
                          foreach($company_member as $rowcompany) {
                        ?>
                        <option value="<?php echo $rowcompany->nmCompanymember ?>"><?php echo $rowcompany->nmCompanymember ?></option>
                        <?php } ?>
                      </select>
                    </td>
                    <td><input type="text" readonly name="noBookingroommember" value="<?php echo $room_number; ?>" class="form-control"></td>
                  </tr>
                  <?php
                      endforeach;
                    }
                  }
                  ?>
                  <input type="hidden" name="invoiceBooking" value="<?php echo $new_invoice_number; ?>" class="form-control">
                  <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
                </form>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>