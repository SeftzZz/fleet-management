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
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>View Additional Detail <?php echo $this->session->userdata('depCode') ?></h2>
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
            <?php
              $dataFNBAdditional = array();
              $this->db->from('fnb_additional_booking');
              $this->db->join('fnb_additional_cooking', 'fnb_additional_cooking.idBooking=fnb_additional_booking.idBooking');
              $this->db->where('fnb_additional_booking.idBooking', $fnbdetail->idBooking);
              $query = $this->db->get();
              if ($query->num_rows() > 0) {
                  $dataFNBAdditional = $query->row();
              }
              $query->free_result();
            ?>
            <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateAdditionalFnb/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
              <input type="hidden" name="idBooking" value="<?php echo $fnbdetail->idBooking ?>">
              <input type="hidden" name="invoiceFnbadditional" value="<?php echo $fnbdetail->invoiceFnbadditional ?>">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="statuspayFnbcooking">Choose Payment Status <span class="required">*</span>
                </label>
                <div class="col-md-3 col-sm-3 ">
                  <select id="statuspayFnbcooking" name="statuspayFnbcooking" class="form-control" required>
                    <option value="<?php echo $fnbdetail->statuspayFnbcooking ?>"><?php echo $fnbdetail->statuspayFnbcooking ?></option>
                    <option disabled value="Choose...">Choose...</option>
                    <option value="CONFIRM">CONFIRM</option>
                    <option value="UNCONFIRM">UNCONFIRM</option>
                    <option value="CANCEL">CANCEL</option>
                  </select>
                </div>
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <button type="submit" id="submit_notification" class="btn btn-success">Submit</button>
                </div>
                <script type="text/javascript">
                  var submit_notification = document.getElementById('submit_notification');
                  submit_notification.addEventListener('click', function() {
                    $.ajax({
                      url: '<?php echo base_url('cms/api/postNotificationPaymentFinance') ?>', // Replace with the actual URL
                      method: 'POST',
                      contentType: 'application/x-www-form-urlencoded',
                      data: {
                        invoiceBooking: '<?php echo $fnbdetail->invoiceFnbadditional ?>',
                        currentToken: '<?php echo $user->tokenPushNotification ?>',
                        idBusiness: '<?php echo $fnbdetail->idBusiness ?>',
                        rateafterdiscountBooking: '<?php echo $fnbdetail->subtotalPrice ?>',
                      },
                      success: function(response) {
                        console.log(response);
                      },
                      error: function(error) {
                        console.error('Error:', error);
                      }
                    });
                  });
                </script>
              </div>
            </form>
            <div class="ln_solid"></div>
            <!-- <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/inputAdditionalFnb/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
              <input type="hidden" name="idBooking" value="<?php echo $dataFNBAdditional->idBooking ?>">
              <input type="hidden" name="numberroomFnbadditional" value="<?php echo $dataFNBAdditional->numberroomFnbadditional ?>">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="ketFnbadditional">Choose Menu <span class="required">*</span>
                </label>
                <div class="col-md-3 col-sm-3 ">
                  <select id="ketFnbadditional" name="ketFnbadditional" class="form-control" required>
                    <option value="Choose...">Choose...</option>
                    <?php 
                      foreach($fnb_menu as $row) {
                    ?>
                      <option value="<?php echo $row->idMenu ?>"><?php echo $row->nmMenu ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
                <div class="col-md-3 col-sm-3 ">
                  <input type="number" name="qtyFnbadditional" class="form-control">
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <button class="btn btn-primary" type="button">Cancel</button>
                  <button class="btn btn-primary" type="reset">Reset</button>
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </form> -->
            <a target="_blank" href="<?php echo base_url('cms/home/printfnb/'.$fnbdetail->idBooking.'/'.$fnbdetail->invoiceFnbadditional.'/') ?>" class="btn btn-danger" style="float: right;">Print</a>
            <table id="detail-kamar" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Nomor Kamar</th>
                  <th>Menu</th>
                  <th>Jumlah Pesanan</th>
                  <th>Keterangan Pesanan</th>
                  <th>Price Additional</th>
                  <th>Create At</th>
                  <?php
                    if($this->session->userdata('depCode') == 'FNB') {
                  ?>
                  <th>Status</th>
                  <th>Action</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php foreach($additional_fnb as $row) { ?>
                    <tr>
                        <td><?php echo $row->numberroomFnbadditional ?></td>
                        <td><?php echo $row->ketFnbadditional ?></td>
                        <td><?php echo $row->qtyFnbadditional ?></td>
                        <td><?php echo $row->descFnbadditional ?></td>
                        <td><?php echo number_format($row->priceFnbadditional) ?></td>
                        <td><?php echo $row->createdAt ?></td>
                        <?php if($this->session->userdata('depCode') == 'FNB') { ?>
                            <?php if($row->statusFnbcooking == 0) { ?>
                                <td>
                                    <?php if($row->orderFnbadditional != 'SOLD_OUT') { ?>
                                        <form method="post" action="<?php echo base_url('cms/home/updateorderAdditionalFnb/') ?>">
                                            <input type="hidden" name="idBooking" value="<?php echo $fnbdetail->idBooking ?>">
                                            <input type="hidden" name="invoiceFnbadditional" value="<?php echo $fnbdetail->invoiceFnbadditional ?>">
                                            <input type="hidden" name="ketFnbadditional" value="<?php echo $row->ketFnbadditional ?>">
                                            <input type="hidden" name="orderFnbadditional" value="SOLD_OUT">
                                            <button type="submit" class="btn btn-danger">Sold Out</button>
                                        </form>
                                    <?php } else { ?>
                                        <button disabled class="btn btn-danger">Sold Out</button>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if($row->orderFnbadditional != 'SOLD_OUT') { ?>
                                        <form method="post" action="<?php echo base_url('cms/home/confirmAdditionalFnb/') ?>">
                                            <input type="hidden" name="idBooking" value="<?php echo $fnbdetail->idBooking ?>">
                                            <input type="hidden" name="invoiceFnbadditional" value="<?php echo $fnbdetail->invoiceFnbadditional ?>">
                                            <input type="hidden" name="statusFnbcooking" value="1">
                                            <button type="submit" class="btn btn-warning">Konfirmasi</button>
                                        </form>
                                    <?php } else { ?>
                                        <button disabled class="btn btn-warning">Konfirmasi</button>
                                    <?php } ?>
                                </td>
                            <?php } elseif($row->statusFnbserving == 0 && $row->orderFnbadditional != 'SOLD_OUT') { ?>
                                <td>
                                  <form method="post" action="<?php echo base_url('cms/home/updateorderAdditionalFnb/') ?>">
                                      <input type="hidden" name="idBooking" value="<?php echo $fnbdetail->idBooking ?>">
                                      <input type="hidden" name="invoiceFnbadditional" value="<?php echo $fnbdetail->invoiceFnbadditional ?>">
                                      <input type="hidden" name="ketFnbadditional" value="<?php echo $row->ketFnbadditional ?>">
                                      <input type="hidden" name="orderFnbadditional" value="SOLD_OUT">
                                      <button type="submit" class="btn btn-danger">Sold Out</button>
                                  </form>
                                </td>
                                <td>
                                    <form method="post" action="<?php echo base_url('cms/home/servingAdditionalFnb/') ?>">
                                        <input type="hidden" name="idBooking" value="<?php echo $fnbdetail->idBooking ?>">
                                        <input type="hidden" name="invoiceFnbadditional" value="<?php echo $fnbdetail->invoiceFnbadditional ?>">
                                        <input type="hidden" name="statusFnbcooking" value="2">
                                        <input type="hidden" name="statusFnbserving" value="1">
                                        <button type="submit" class="btn btn-primary">Selesaikan</button>
                                    </form>
                                </td>
                            <?php } elseif($row->orderFnbadditional == 'SOLD_OUT') { ?>
                                <td>Sold Out</td>
                                <td></td>
                            <?php } else { ?>
                                <td>Telah disajikan</td>
                                <td></td>
                            <?php } ?>

                        <?php } ?>
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


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> <!-- Add jQuery -->
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script>
    $('#detail-kamar').DataTable( {
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
    } );
</script>