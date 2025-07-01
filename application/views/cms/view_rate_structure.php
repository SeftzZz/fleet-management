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
        <h3>View Rate Code <?php echo $this->session->userdata('business') ?></h3>
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
            <h2>View Rate Code <?php echo $this->session->userdata('business') ?>
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
            <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertRateCode') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
              <input type="hidden" name="idBusiness" value="<?php echo $idBusiness ?>">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Type Kamar <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select id="type_kamar" name="ketKamar" class="form-control">
                    <option value>Choose..</option>
                    <?php 
                      $displayed_name = array();
                      $kamar = array();
                      $this->db->from('kamar_all');
                      $this->db->where('idBusiness', $idBusiness);
                      $query = $this->db->get();
                      if ($query->num_rows() > 0)
                      {
                        foreach ($query->result() as $row)
                        {
                          if (!in_array($row->ketKamar, $displayed_name)) {
                            // Add the invoice to the list of displayed invoices
                            $displayed_name[] = $row->ketKamar;
                            $kamar[] = $row;
                          }
                        }
                      }
                      $query->free_result(); 
                    ?>
                    <?php 
                      foreach($kamar as $row) {
                    ?>
                      <option value="<?php echo $row->ketKamar ?>"><?php echo $row->ketKamar ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nmRatecode">Name Rate Code <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="nmRatecode" required="required" name="nmRatecode" class="form-control">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="beginRatecode">Begin Rate Code <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="date" id="beginRatecode" required="required" name="beginRatecode" class="form-control">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="endRatecode">End Rate Code <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="date" id="endRatecode" required="required" name="endRatecode" class="form-control">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Level Occupancy <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 form-group has-feedback">
                  <input type="number" name="lvlOccupancy" id="lvlOccupancy" required="required" class="form-control">
                  <span class="form-control-feedback right" aria-hidden="true">%</span>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Discount <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 form-group has-feedback">
                  <input type="number" name="dscOccupancy" id="dscOccupancy" required="required" class="form-control">
                  <span class="form-control-feedback right" aria-hidden="true">%</span>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Harga Room Only <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 form-group has-feedback">
                  <input type="text" name="roOccupancy" id="roOccupancy" required="required" class="form-control">
                  <span class="form-control-feedback right" aria-hidden="true">IDR</span>
                </div>
              </div>
              <script>
                var inputElementRO = document.getElementById("roOccupancy");
                inputElementRO.addEventListener("input", function() {
                  var inputValueRO = inputElementRO.value;
                  // Remove non-numeric characters
                  var numericValue = inputValueRO.replace(/[^0-9.]/g, '');
                  const doubleNumber = Number(numericValue);
                  console.log(doubleNumber);
                  // Set the value of the input to doubleNumber
                  inputElementRO.value = doubleNumber;
                  // Format the value with commas and two decimal places
                  var formattedValue = formatNumberWithCommasAndDecimalsRO(numericValue);
                  // Update the input value with the formatted value
                  inputElementRO.value = formattedValue;
                });
                function formatNumberWithCommasAndDecimalsRO(number) {
                  var parts = number.split(".");
                  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                  return parts.join(".");
                }
              </script>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Harga Room Breakfast <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 form-group has-feedback">
                  <input type="text" name="rbOccupancy" id="rbOccupancy" required="required" class="form-control">
                  <span class="form-control-feedback right" aria-hidden="true">IDR</span>
                </div>
              </div>
              <script>
                var inputElement = document.getElementById("rbOccupancy");
                inputElement.addEventListener("input", function() {
                    var inputValue = inputElement.value;
                    // Remove non-numeric characters
                    var numericValue = inputValue.replace(/[^0-9.]/g, '');
                    const doubleNumber = Number(numericValue);
                    console.log(doubleNumber);
                    // Set the value of the input to doubleNumber
                    inputElement.value = doubleNumber;
                    // Format the value with commas and two decimal places
                    var formattedValue = formatNumberWithCommasAndDecimals(numericValue);
                    // Update the input value with the formatted value
                    inputElement.value = formattedValue;
                });
                function formatNumberWithCommasAndDecimals(number) {
                    var parts = number.split(".");
                    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    return parts.join(".");
                }
              </script>
              <div class="ln_solid"></div>
              <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <button class="btn btn-primary" type="button">Cancel</button>
                  <button class="btn btn-primary" type="reset">Reset</button>
                  <input type="submit" name="submit" value="Submit" class="btn btn-success">
                </div>
              </div>
            </form>
            <div class="ln_solid"></div>
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th style="width: 15%;">Type Kamar</th>
                  <th>Keterangan BAR</th>
                  <th style="width: 5%;">Level Occupancy</th>
                  <th style="width: 5%;">Discount</th>
                  <th>Begin</th>
                  <th>End</th>
                  <th>Room Only</th>
                  <th>Room Breakfast</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach($rate_structure as $row) {
                ?>
                <tr>
                  <form method="post" title="rate_code" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateRateCode') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                    <input type="hidden" name="idRatecode" value="<?php echo $row->idRatecode ?>">
                    <input type="hidden" name="idOccupancy" value="<?php echo $row->idOccupancy ?>">
                    <input type="hidden" name="beginRatecode" value="<?php echo $row->beginRatecode ?>">
                    <input type="hidden" name="endRatecode" value="<?php echo $row->endRatecode ?>">
                    <td><input type="text" readonly name="ketKamar" class="form-control" value="<?php echo $row->ketKamar ?>"></td>
                    <td><input type="text" id="nmRatecode" required="required" name="nmRatecode" class="form-control" value="<?php echo $row->nmRatecode ?>"></td>
                    <td><input type="text" id="lvlOccupancy" required="required" name="lvlOccupancy" class="form-control" value="<?php echo $row->lvlOccupancy ?>"></td>
                    <td><input type="text" id="dscOccupancy" required="required" name="dscOccupancy" class="form-control" value="<?php echo $row->dscOccupancy ?>"></td>
                    <td><?php echo $row->beginRatecode ?></td>
                    <td><?php echo $row->endRatecode ?></td>
                    <td>
                      <input type="text" id="roOccupancyEdit" required="required" name="roOccupancy" class="form-control" placeholder="<?php echo number_format($row->roOccupancy) ?>">
                      <script>
                        var inputElementROEdit = document.getElementById("roOccupancyEdit");
                        inputElementROEdit.addEventListener("input", function() {
                          var inputValueRO = inputElementROEdit.value;
                          // Remove non-numeric characters
                          var numericValue = inputValueRO.replace(/[^0-9.]/g, '');
                          const doubleNumber = Number(numericValue);
                          console.log(doubleNumber);
                          // Set the value of the input to doubleNumber
                          inputElementROEdit.value = doubleNumber;
                          // Format the value with commas and two decimal places
                          var formattedValue = formatNumberWithCommasAndDecimalsRO(numericValue);
                          // Update the input value with the formatted value
                          inputElementROEdit.value = formattedValue;
                        });
                        function formatNumberWithCommasAndDecimalsRO(number) {
                          var parts = number.split(".");
                          parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                          return parts.join(".");
                        }
                      </script>
                    </td>
                    <td>
                      <input type="text" id="rbOccupancyEdit" required="required" name="rbOccupancy" class="form-control" placeholder="<?php echo number_format($row->rbOccupancy) ?>">
                      <script>
                        var inputElementRBEdit = document.getElementById("rbOccupancyEdit");
                        inputElementRBEdit.addEventListener("input", function() {
                          var inputValueRBEdit = inputElementRBEdit.value;
                          // Remove non-numeric characters
                          var numericValue = inputValueRBEdit.replace(/[^0-9.]/g, '');
                          const doubleNumber = Number(numericValue);
                          console.log(doubleNumber);
                          // Set the value of the input to doubleNumber
                          inputElementRBEdit.value = doubleNumber;
                          // Format the value with commas and two decimal places
                          var formattedValue = formatNumberWithCommasAndDecimalsRO(numericValue);
                          // Update the input value with the formatted value
                          inputElementRBEdit.value = formattedValue;
                        });
                        function formatNumberWithCommasAndDecimalsRO(number) {
                          var parts = number.split(".");
                          parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                          return parts.join(".");
                        }
                      </script>
                    </td>
                    <td><input type="submit" name="submit" class="btn btn-success" value="Update"><a id="rate<?php echo $row->idRatecode ?>" class="btn btn-danger" onclick="deleteRate(<?php echo $row->idRatecode ?>)">Delete</a></td>
                  </form>
                  <script type="text/javascript">
                    function deleteRate(idRatecode) {
                      $.ajax({
                        url: '<?php echo base_url('cms/home/ajaxDeleteRate') ?>', // Replace with the actual URL
                        data: { idRatecode: idRatecode },
                        method: 'POST',
                        success: function(response) {
                          console.log(response);
                          if(response == 1) {
                            swal({
                              title: "Success",
                              text: "Berhasil di delete",
                              type: "success",
                              confirmButtonText: null
                            });
                            setTimeout(function() {
                              window.location.reload();
                            }, 1000); // This will refresh after a 2000ms (2 seconds) delay
                          }
                        },
                        error: function(error) {
                          console.error('Error:', error);
                        }
                      });
                    }
                  </script>
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