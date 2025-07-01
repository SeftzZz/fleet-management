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
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Claimed Voucher</th>
                          <th>Date Claimed</th>
                          <th>Preparing</th>
                          <th>Serving</th>
                          <th>Finish At</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $this->db->from('voucher_claim');
                          $this->db->join('fnb_additional_cooking', 'fnb_additional_cooking.idBooking=voucher_claim.idBooking');
                          $this->db->join('booking', 'booking.idUser=voucher_claim.idUser');
                          $query = $this->db->get();

                          if ($query->num_rows() > 0) {
                            foreach ($query->result() as $row) {
                        ?>
                        <tr>
                          <td><?php echo $row->firstnameBooking.$row->lastnameBooking ?></td>
                          <td><?php echo $row->nmVoucher ?></td>
                          <td><?php echo $row->createdAtClaim ?></td>
                          <td>
                            <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateFnbAdditionalCooking/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                              <input type="hidden" name="idBusiness" value="<?php echo $row->idBusiness ?>">
                              <input type="hidden" name="idBooking" value="<?php echo $row->idBooking ?>">
                              <input type="hidden" name="invoiceFnbadditional" value="<?php echo $row->invoiceFnbadditional ?>">
                              <input type="hidden" name="idUser" value="<?php echo $row->idUser ?>">
                              <?php
                                if($row->statusFnbcooking == 0) {
                              ?>
                              <div class="item form-group">
                                <select required="required" name="statusFnbcooking" id="statusFnbcooking" class="form-control">
                                  <option value="">Change Status</option>
                                  <option value="1">Preparing</option>
                                </select>
                              </div>
                              <div class="item form-group">
                                <button type="submit" class="btn btn-success">Submit</button>
                              </div>
                              <?php
                                } else {
                              ?>
                              <option value="<?php echo $row->statusFnbcooking ?>">Preparing</option>
                              <?php } ?>
                              </div>
                            </form>
                          </td>
                          <td>
                            <?php
                              if($row->statusFnbcooking == 1) {
                            ?>
                              <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateFnbAdditionalServing/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                                <input type="hidden" name="idBusiness" value="<?php echo $row->idBusiness ?>">
                                <input type="hidden" name="idBooking" value="<?php echo $row->idBooking ?>">
                                <input type="hidden" name="invoiceFnbadditional" value="<?php echo $row->invoiceFnbadditional ?>">
                                <input type="hidden" name="idUser" value="<?php echo $row->idUser ?>">
                                <input type="hidden" name="nmVoucher" value="<?php echo $row->nmVoucher ?>">
                                <?php
                                  if($row->statusFnbserving == 0) {
                                ?>
                                <div class="item form-group">
                                  <select required="required" name="statusFnbserving" id="statusFnbserving" class="form-control">
                                    <option value="">Change Status</option>
                                    <option value="1">Serving</option>
                                  </select>
                                </div>
                                <div class="item form-group">
                                  <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <?php
                                  } else {
                                ?>
                                <option value="<?php echo $row->statusFnbserving ?>">Serving</option>
                                <?php } ?>
                                </div>
                              </form>
                            <?php } else {
                            ?>
                            Wait for preparing
                            <?php } ?>
                          </td>
                          <td><?php echo $row->finishAtFnbcooking ?></td>
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