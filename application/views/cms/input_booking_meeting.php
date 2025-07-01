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
<div class="right_col" role="main" id="body1">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Package Meeting <?php echo $businessId->Name ?> #<?php echo $new_invoice_number ?>
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
            <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateFormBookingMeeting/'.$businessId->idBusiness.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
              <div class="col-md-4">
                <input type="hidden" name="idBusiness" value="<?php echo $businessId->idBusiness ?>">
                <input type="hidden" id="idPaketmeeting" name="idPaketmeeting">
                <input type="hidden" id="RateNow" name="RateNow">                
                <input type="hidden" name="invoiceBooking" value="<?php echo $new_invoice_number ?>">
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="arrival">1. Check In *</label>
                    <div class="col-md-9 col-sm-9">
                        <input type="date" id="arrival" name="arrivalBooking" class="form-control" required>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="night">No of Night *</label>
                    <div class="col-md-9 col-sm-9">
                        <input type="number" id="night" name="nightBooking" class="form-control" min="1" placeholder="1" required>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="departure">Check Out *</label>
                    <div class="col-md-9 col-sm-9">
                        <input type="date" id="departure" name="departureBooking" class="form-control" readonly required>
                    </div>
                </div>
                <script>
                  // Get the currentDate date in the format YYYY-MM-DD
                  const currentDate = new Date().toISOString().split('T')[0];

                  // Set the value of the date input to the current date
                  document.getElementById('arrival').value = currentDate;
                  // document.getElementById('arrival').min = currentDate;

                  function updateDeparture() {
                    const arrivalDate = document.getElementById('arrival').value;
                    
                    const nightCount = parseInt(document.getElementById('night').value);

                    if (arrivalDate && nightCount && !isNaN(nightCount)) {
                      const arrival = new Date(arrivalDate);
                      const departure = new Date(arrival.getTime() + nightCount * 24 * 60 * 60 * 1000);
                      const departureString = departure.toISOString().split('T')[0];
                      document.getElementById('departure').value = departureString;
                      
                      var roomtypemeeting = document.getElementById('roomtypemeeting');
                      roomtypemeeting.setAttribute('data-toggle', 'modal');
                      roomtypemeeting.setAttribute('data-target', '#roomtypemeetingModal');
                      roomtypemeeting.readOnly = false;
                      var additional = document.getElementById('additional');
                      additional.setAttribute('data-toggle', 'modal');
                      additional.setAttribute('data-target', '#additionalroomtypemeetingModal');
                      additional.readOnly = false;
                    }
                  }

                  // Attach event listeners to the arrival and night inputs
                  document.getElementById('arrival').addEventListener('input', updateDeparture);
                  document.getElementById('night').addEventListener('input', updateDeparture);
                </script>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="status">Status *
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <select id="status" name="statusBooking" class="form-control" required>
                      <option value>Choose..</option>
                      <option value="Confirm">Confirm</option>
                      <option value="Tentative">Tentative</option>
                      <option value="Canceled">Canceled</option>
                      <option value="Waiting List">Waiting List</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="roomtype">2. Meeting Type
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="text" id="roomtypemeeting" name="roomtypeBooking" class="form-control" placeholder="Search room...." readonly>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="roomtype">Type Room
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="text" id="additional" name="roomtypeBooking" class="form-control" placeholder="Search room...." readonly>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="ln_solid"></div>
              </div>
              <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <button class="btn btn-primary" type="button">Cancel</button>
                  <button class="btn btn-primary" type="reset">Reset</button>
                  <input type="submit" class="btn btn-success" name="submit" value="Submit">
                </div>
              </div>
            </form>
          </div>
        </div>        
      </div>
    </div>
  </div>
</div>