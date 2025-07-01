<!-- page content -->
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="x_panel">
    <div class="x_title">
      <h2>List Data Report Guest</h2>
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
      <form id="dateIntervalFormReport">
        <label for="startDateReport">Start Date:</label>
        <input type="date" id="startDateReport" name="startDateReport">

        <label for="endDateReport">End Date:</label>
        <input type="date" id="endDateReport" name="endDateReport">

        <button type="submit">Submit</button>
      </form>
    </div>
      
      <table id="datatable-buttons-report" class="table table-striped table-bordered report">
        <thead>
          <tr>
            <th>No</th>
            <th>ID Booking</th>
            <th>ID Invoice</th>
            <th>Name</th>
            <th>Segment</th>
            <th>Company</th>
            <th>Generate By</th>
            <th>Room Type</th>
            <th>Arrival</th>
            <th>Night</th>
            <th>Pax</th>
            <th>Status</th>
            <!-- <th>Extra Bed</th> -->
            <th>Rate Code</th>
            <th>Total Rate</th>
            <th>Rate After Discount</th>
            <!-- <th>Charge</th> -->
            <!-- <th>Additional</th> -->
            <th>Payment Methode</th>
            <th>Status Payment</th>
            <th>Description Invoice</th>
            <th>Created At Invoice</th>
            <!-- <th>No Refrence</th> -->
            <th>Total Payment</th>
            <th>Currency</th>
            <!-- <th>ID Number</th> -->
            <th>Email</th>
            <!-- <th>Mobile</th> -->
            <th>Nationality</th>

          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>
<!-- /page content -->