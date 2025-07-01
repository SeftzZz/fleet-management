<?php if ($this->session->flashdata('pesanerror')) { ?>
  <script language="javascript" type="text/javascript">
    window.onload = function() {
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
    swal({
      title: "Success",
      text: "Berhasil tambah data",
      type: "success",
      confirmButtonText: null
    });
    setTimeout(function() {
      window.location.reload();
    }, 2000); // This will refresh after a 2000ms (2 seconds) delay
  </script>
<?php } ?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Booking Room <?php echo $this->session->userdata('business') ?>
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
            <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertFormBooking') ?>" id="demo-form2" class="form-horizontal form-label-left">
              <div class="col-md-4">
                <input type="hidden" name="idBusiness" value="<?php echo $this->session->userdata('idBusiness') ?>">
                <input type="hidden" id="idkamar" name="idKamar" class="form-control">
                <input type="hidden" id="intervalDate" name="intervalDate" class="form-control">
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="arrival">Occupancy *</label>
                  <div class="col-md-9 col-sm-9">
                    <input readonly type="text" id="occupancy-level" name="RateNow" class="form-control">
                    <span class="form-control-feedback right" aria-hidden="true">%</span>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="arrival">1. Arrival *</label>
                  <div class="col-md-9 col-sm-9">
                    <input type="date" id="arrival" name="arrivalBooking" class="form-control" value="<?php echo set_value('arrivalBooking'); ?>" required style="background: #ffff4c82;">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="night">No of Night *</label>
                  <div class="col-md-9 col-sm-9">
                    <input type="number" id="night" name="nightBooking" class="form-control" min="1" placeholder="1" value="1" required style="background: #ffff4c82;">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="departure">Departure *</label>
                  <div class="col-md-9 col-sm-9">
                    <input type="date" id="departure" name="departureBooking" class="form-control" readonly required style="background: #ffff4c82;">
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
                    var totalrate = document.getElementById('totalrate').value;
                    const nightCount = parseInt(document.getElementById('night').value);

                    if (arrivalDate && nightCount && !isNaN(nightCount)) {
                      const arrival = new Date(arrivalDate);
                      const departure = new Date(arrival.getTime() + nightCount * 24 * 60 * 60 * 1000);
                      const departureString = departure.toISOString().split('T')[0];
                      var formattedTotalHarga = totalrate; // This formats the number
                      document.getElementById('departure').value = departureString;
                       // Display date interval sequence if more than one day
                      if (nightCount > 0) {
                        const intervalDates = [];
                        for (let i = 0; i < nightCount; i++) {
                          const currentDay = new Date(arrival.getTime() + i * 24 * 60 * 60 * 1000);
                          const currentDayString = currentDay.toISOString().split('T')[0];
                          intervalDates.push(currentDayString);
                        }
                        console.log('Interval Dates:', intervalDates); // Log the interval dates to the console
                        document.getElementById('intervalDate').value = intervalDates+','+departureString;
                      }
                      var occupancyInterval = setInterval(function() {
                        $.ajax({
                          url: '<?php echo base_url('cms/home/ajaxCheckOccupancy_byDate_arrival/') ?>'+arrivalDate, // Replace with the actual URL
                          method: 'GET',
                          success: function(response) {
                            var res = JSON.parse(response);
                            var allRooms = res.sumRoom;
                            var booking = res.bookingRoom;
                            var available = res.availableRoom;

                            if (allRooms > 0) {
                              var percentageInUse = (booking / allRooms) * 100;
                            } else {
                              var percentageInUse = 0; // Handle the case where allRooms is 0 to avoid division by zero.
                            }

                            var levelRate = Number(percentageInUse.toFixed(2));
                            // Update the UI with the response if needed
                            localStorage.setItem("percentageInUse", levelRate.toFixed(2));
                            clearInterval(occupancyInterval);
                            var percentageInUse = localStorage.getItem('percentageInUse');
                            document.getElementById('occupancy-level').value = percentageInUse;
                          },
                          error: function(error) {
                            console.error('Error:', error);
                          }
                        });
                      }, 1000);
                    }
                  }

                  // Attach event listeners to the arrival and night inputs
                  document.getElementById('arrival').addEventListener('input', updateDeparture);
                  document.getElementById('night').addEventListener('input', updateDeparture);

                  // Trigger initial update on page load
                  window.onload = updateDeparture;
                </script>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="company">Company *
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="text" id="company" name="companyBooking" class="form-control" value="<?php echo set_value('companyBooking'); ?>" data-toggle="modal" data-target="#companyModal" required style="background: #ffff4c82;">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="member">Member
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <select id="member" name="memberBooking" class="form-control">
                      <option value>Choose..</option>
                      <option value="TIER_5" <?php echo set_select('memberBooking', 'TIER_5'); ?>>TIER 5</option>
                      <option value="TIER_4" <?php echo set_select('memberBooking', 'TIER_4'); ?>>TIER 4</option>
                      <option value="TIER_3" <?php echo set_select('memberBooking', 'TIER_3'); ?>>TIER 3</option>
                      <option value="TIER_2" <?php echo set_select('memberBooking', 'TIER_2'); ?>>TIER 2</option>
                      <option value="TIER_1" <?php echo set_select('memberBooking', 'TIER_1'); ?>>TIER 1</option>
                    </select>
                  </div>
                  <script type="text/javascript">
                    document.getElementById('member').addEventListener('change', function() {
                      var selectedValue = this.value;
                      console.log('Selected value:', selectedValue);
                      var getNumber = localStorage.getItem('room');
                      $.ajax({
                        type: "POST",
                        url: '<?php echo base_url("cms/home/ajaxPaketMember/") ?>' + selectedValue + '/',
                        data: { member: selectedValue },
                        success: function(response) {
                            var result = JSON.parse(response);
                            if(document.getElementById('member').value != '') {
                              var nightInput = document.getElementById('roomtype');
                              nightInput.setAttribute('data-toggle', 'modal');
                              nightInput.setAttribute('data-target', '#roomtypememberModal');
                              // console.log(result);

                              // Assuming 'datatable-buttons' is the ID of your table
                              var tableBody = document.querySelector(".memberready tbody");

                              // Clear any previous content
                              tableBody.innerHTML = '';

                              // Assuming 'result' is an array of objects
                              result.forEach(function(item) {
                                var tr = document.createElement('tr');

                                var memberKamar = document.createElement('td');
                                memberKamar.textContent = item.nmType;

                                var memberKeterangan = document.createElement('td');
                                memberKeterangan.textContent = item.ketKamar;

                                var memberOwner = document.createElement('td');
                                memberOwner.textContent = item.idBusiness;

                                var memberHarga = document.createElement('td');
                                memberHarga.textContent = item.totalHargamember;

                                var memberAvailable = document.createElement('td');
                                memberAvailable.textContent = item.qtyKamar;

                                var tdAction = document.createElement('td');
                                var actionLink = document.createElement('button');
                                actionLink.classList.add('btn', 'btn-primary'); // Add classes
                                actionLink.href = '#'; // Add your link here
                                actionLink.textContent = 'Pilih';
                                // Add data attributes
                                actionLink.dataset.dismiss = 'modal';
                                actionLink.setAttribute('aria-label', 'Close');
                                actionLink.onclick = function() {
                                  var rategap = <?php echo json_encode($rateGap); ?>;
                                  var rate_1 = rategap.totalRategap;
                                  var rate_2 = rategap.totalRategap2;
                                  var rate_3 = rategap.totalRategap3;
                                  var rate_4 = rategap.totalRategap4;
                                  var rate_5 = rategap.totalRategap5;
                                  console.log(rate_1);
                                  // var idKamar = document.getElementById('idKamar').value;
                                  document.getElementById('roomtype').value = 'mencari data...';
                                  // Construct the URL using JavaScript
                                  var url = '<?php echo base_url("cms/home/ajaxRoomType/") ?>' + item.idKamar + '/';

                                  var xhr = new XMLHttpRequest();
                                  xhr.open('POST', url, true);
                                  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                                  xhr.onreadystatechange = function() {
                                    if (xhr.readyState === XMLHttpRequest.DONE) {
                                      if (xhr.status === 200) {
                                        // Handle the response here
                                        var response = JSON.parse(xhr.responseText);
                                        console.log("response", response);
                                        localStorage.setItem('room', response.idType);
                                        document.getElementById('roomtype').value = response.nmType;
                                        document.getElementById('idkamar').value = response.idKamar;
                                        document.getElementById('feautres').value = response.ketKamar;
                                        var totalrate = item.totalHargamember;
                                        var night = document.getElementById('night').value;
                                        var formattedTotalHarga = totalrate; // This formats the number
                                        document.getElementById('totalrate').value = formattedTotalHarga;
                                        console.log(response.idType);
                                        var numberroomInput = document.getElementById('numberroom');
                                        numberroomInput.setAttribute('data-toggle', 'modal');
                                        numberroomInput.setAttribute('data-target', '#numberroomModal');
                                        numberroomInput.readOnly = false;
                                        var getNumber = localStorage.getItem('room');
                                        var getarrival = document.getElementById('arrival').value;
                                        var getdeparture = document.getElementById('departure').value;
                                        // Send an AJAX request to your PHP script
                                        $.ajax({
                                          type: "POST",
                                          url: '<?php echo base_url("cms/home/ajaxNumberkamar/") ?>' + response.idType + '/',
                                          data: { numberroomValue: getNumber, arrival: getarrival, departure: getdeparture },
                                          success: function(response) {
                                            var result = JSON.parse(response);

                                            // Assuming 'datatable-buttons' is the ID of your table
                                            var tableBody = document.querySelector(".roomready tbody");

                                            // Clear any previous content
                                            tableBody.innerHTML = '';

                                            // Assuming 'result' is an array of objects
                                            result.forEach(function(item) {
                                                var tr = document.createElement('tr');

                                                var tdNomor = document.createElement('td');
                                                tdNomor.textContent = item.nmNumber;

                                                var tdType = document.createElement('td');
                                                tdType.textContent = item.nmType;

                                                var tdKetKamar = document.createElement('td');
                                                tdKetKamar.textContent = item.ketKamar;

                                                var tdStatus = document.createElement('td');
                                                tdStatus.textContent = item.ketNumber;

                                                var tdAction = document.createElement('td');
                                                var actionLink = document.createElement('button');
                                                actionLink.href = '#'; // Add your link here
                                                actionLink.textContent = 'Pilih';
                                                if(item.ketNumber != 'VR') {
                                                  actionLink.classList.add('btn', 'btn-warning'); // Add classes
                                                  actionLink.setAttribute('disabled', 'True');
                                                } else {
                                                  actionLink.classList.add('btn', 'btn-primary'); // Add classes
                                                }

                                                // Add data attributes
                                                actionLink.dataset.dismiss = 'modal';
                                                actionLink.setAttribute('aria-label', 'Close');
                                                actionLink.onclick = function() {
                                                  chooseNumber(item.nmNumber, item.idKamar); // Assuming 'chooseNumber' function takes a parameter
                                                };

                                                tdAction.appendChild(actionLink);

                                                tr.appendChild(tdNomor);
                                                tr.appendChild(tdType);
                                                tr.appendChild(tdKetKamar);
                                                tr.appendChild(tdStatus);
                                                tr.appendChild(tdAction);

                                                tableBody.appendChild(tr);
                                            });
                                          }
                                        });

                                        function chooseNumber(number, idKamar) {
                                          // Add your code to handle the chosen number here
                                          console.log("Chosen Number:", number);
                                          document.getElementById('numberroom').value = number;
                                          var ratecodeInput = document.getElementById('ratecode');
                                          ratecodeInput.setAttribute('data-toggle', 'modal');
                                          ratecodeInput.setAttribute('data-target', '#ratecodeModal');
                                          ratecodeInput.readOnly = false;
                                          $.ajax({
                                              type: "POST",
                                              url: '<?php echo base_url("cms/home/ajaxRatecode/") ?>' + idKamar + '/',
                                              data: { ratecodeValue: getNumber },
                                              success: function(ratecoderesponse) {
                                                  var ratecoderesult = JSON.parse(ratecoderesponse);
                                                  // Assuming 'datatable-buttons' is the ID of your table
                                                  var ratecodetableBody = document.querySelector(".ratecodelist tbody");

                                                  // Clear any previous content
                                                  ratecodetableBody.innerHTML = '';

                                                  // Assuming 'ratecoderesult' is an array of objects
                                                  ratecoderesult.forEach(function(ratecodeitem) {
                                                      var ratecodetr = document.createElement('tr');

                                                      var tdrateName = document.createElement('td');
                                                      tdrateName.textContent = ratecodeitem.nmRatecode;

                                                      var tdrateBegin = document.createElement('td');
                                                      tdrateBegin.textContent = ratecodeitem.beginRatecode;

                                                      var tdrateEnd = document.createElement('td');
                                                      tdrateEnd.textContent = ratecodeitem.endRatecode;

                                                      var tdrateExtrabed = document.createElement('td');
                                                      tdrateExtrabed.textContent = ratecodeitem.extrabedRatecode;

                                                      var tdrateDiscount = document.createElement('td');
                                                      tdrateDiscount.textContent = ratecodeitem.discRatecode;

                                                      var tdrateRO = document.createElement('td');
                                                      var tdrateROactionLink = document.createElement('button');
                                                      tdrateROactionLink.classList.add('btn', 'btn-primary'); // Add classes
                                                      tdrateROactionLink.href = '#'; // Add your link here
                                                      tdrateROactionLink.textContent = ratecodeitem.roOccupancy;
                                                      // Add data attributes
                                                      tdrateROactionLink.dataset.dismiss = 'modal';
                                                      tdrateROactionLink.setAttribute('aria-label', 'Close');

                                                      var tdrateRB = document.createElement('td');
                                                      var tdrateRBactionLink = document.createElement('button');
                                                      tdrateRBactionLink.classList.add('btn', 'btn-primary'); // Add classes
                                                      tdrateRBactionLink.href = '#'; // Add your link here
                                                      tdrateRBactionLink.textContent = ratecodeitem.rbOccupancy;
                                                      // Add data attributes
                                                      tdrateRBactionLink.dataset.dismiss = 'modal';
                                                      tdrateRBactionLink.setAttribute('aria-label', 'Close');

                                                      // Add data attributes
                                                      tdrateROactionLink.dataset.dismiss = 'modal';
                                                      tdrateROactionLink.setAttribute('aria-label', 'Close');
                                                      tdrateROactionLink.onclick = function() {
                                                        console.log("Chosen Rate Code:", ratecodeitem.nmRatecode);
                                                        document.getElementById('ratecode').value = ratecodeitem.nmRatecode + ' RO';
                                                        document.getElementById('totalrate').value = 0;
                                                        document.getElementById('totalrate').value = ratecodeitem.roOccupancy;
                                                      };

                                                      tdrateRBactionLink.dataset.dismiss = 'modal';
                                                      tdrateRBactionLink.setAttribute('aria-label', 'Close');
                                                      tdrateRBactionLink.onclick = function() {
                                                        console.log("Chosen Rate Code:", ratecodeitem.nmRatecode);
                                                        document.getElementById('ratecode').value = ratecodeitem.nmRatecode + ' RB';
                                                        document.getElementById('totalrate').value = 0;
                                                        document.getElementById('totalrate').value = ratecodeitem.rbOccupancy;
                                                      };

                                                      var percentageInUse = localStorage.getItem('percentageInUse');
                                                      var ratenow = document.getElementById('totalrate').value;
                                                      if(percentageInUse >= 0 && percentageInUse < 40) {
                                                        if(ratenow == ratecodeitem.roOccupancy || ratenow == ratecodeitem.rbOccupancy) {
                                                          ratecodetr.style.backgroundColor = 'orange';
                                                        } else {
                                                          tdrateROactionLink.disabled = false;
                                                          tdrateRBactionLink.disabled = false;
                                                        }
                                                      } else if(percentageInUse > 41 && percentageInUse < 60) {
                                                        if(ratenow == ratecodeitem.roOccupancy || ratenow == ratecodeitem.rbOccupancy) {
                                                          ratecodetr.style.backgroundColor = 'orange';
                                                        } else {
                                                          tdrateROactionLink.disabled = false;
                                                          tdrateRBactionLink.disabled = false;
                                                        }
                                                      } else if(percentageInUse > 61 && percentageInUse < 70) {
                                                        if(ratenow == ratecodeitem.roOccupancy || ratenow == ratecodeitem.rbOccupancy) {
                                                          ratecodetr.style.backgroundColor = 'orange';
                                                        } else {
                                                          tdrateROactionLink.disabled = false;
                                                          tdrateRBactionLink.disabled = false;
                                                        }
                                                      } else if(percentageInUse > 71 && percentageInUse < 80) {
                                                        if(ratenow == ratecodeitem.roOccupancy || ratenow == ratecodeitem.rbOccupancy) {
                                                          ratecodetr.style.backgroundColor = 'orange';
                                                        } else {
                                                          tdrateROactionLink.disabled = false;
                                                          tdrateRBactionLink.disabled = false;
                                                        }
                                                      } else if(percentageInUse > 81 && percentageInUse < 90) {
                                                        if(ratenow == ratecodeitem.roOccupancy || ratenow == ratecodeitem.rbOccupancy) {
                                                          ratecodetr.style.backgroundColor = 'orange';
                                                        } else {
                                                          tdrateROactionLink.disabled = false;
                                                          tdrateRBactionLink.disabled = false;
                                                        }
                                                      } else if(percentageInUse > 91 && percentageInUse < 100) {
                                                        if(ratenow == ratecodeitem.roOccupancy || ratenow == ratecodeitem.rbOccupancy) {
                                                          ratecodetr.style.backgroundColor = 'orange';
                                                        } else {
                                                          tdrateROactionLink.disabled = false;
                                                          tdrateRBactionLink.disabled = false;
                                                        }
                                                      }

                                                      tdrateRO.appendChild(tdrateROactionLink);
                                                      tdrateRB.appendChild(tdrateRBactionLink);

                                                      ratecodetr.appendChild(tdrateName);
                                                      ratecodetr.appendChild(tdrateBegin);
                                                      ratecodetr.appendChild(tdrateEnd);
                                                      ratecodetr.appendChild(tdrateExtrabed);
                                                      ratecodetr.appendChild(tdrateDiscount);
                                                      ratecodetr.appendChild(tdrateRO);
                                                      ratecodetr.appendChild(tdrateRB);

                                                      ratecodetableBody.appendChild(ratecodetr);
                                                  });
                                              }
                                          });
                                          console.log(number, idKamar);
                                          var discountInput = document.getElementById('discount');
                                          discountInput.readOnly = false;
                                        }
                                      } else {
                                        alert('Error: ' + xhr.status);
                                      }
                                    }
                                  };
                                  xhr.send();
                                  localStorage.getItem('roomready');
                                };

                                tdAction.appendChild(actionLink);

                                tr.appendChild(memberKamar);
                                tr.appendChild(memberKeterangan);
                                tr.appendChild(memberOwner);
                                tr.appendChild(memberHarga);
                                tr.appendChild(memberAvailable);
                                tr.appendChild(tdAction);

                                tableBody.appendChild(tr);
                              });
                            } else {
                              var nightInput = document.getElementById('roomtype');
                              nightInput.setAttribute('data-toggle', 'modal');
                              nightInput.setAttribute('data-target', '#roomtypeModal');
                              console.log(document.getElementById('member').value);
                              var result = JSON.parse(response);

                              // Assuming 'datatable-buttons' is the ID of your table
                              var tableBody = document.querySelector(".memberready tbody");

                              // Clear any previous content
                              tableBody.innerHTML = '';

                              // Assuming 'result' is an array of objects
                              result.forEach(function(item) {
                                  var tr = document.createElement('tr');

                                  var memberKamar = document.createElement('td');
                                  memberKamar.textContent = item.nmNumber;

                                  var memberKeterangan = document.createElement('td');
                                  memberKeterangan.textContent = item.nmType;

                                  var memberOwner = document.createElement('td');
                                  memberOwner.textContent = item.ketKamar;

                                  var memberHarga = document.createElement('td');
                                  memberHarga.textContent = item.ketNumber;

                                  var memberAvailable = document.createElement('td');
                                  memberAvailable.textContent = item.ketNumber;

                                  var tdAction = document.createElement('td');
                                  var actionLink = document.createElement('button');
                                  actionLink.href = '#'; // Add your link here
                                  actionLink.textContent = 'Pilih';
                                  if(item.ketNumber != 'VR') {
                                    actionLink.classList.add('btn', 'btn-warning'); // Add classes
                                    actionLink.setAttribute('disabled', 'True');
                                  } else {
                                    actionLink.classList.add('btn', 'btn-primary'); // Add classes
                                  }

                                  // Add data attributes
                                  actionLink.dataset.dismiss = 'modal';
                                  actionLink.setAttribute('aria-label', 'Close');
                                  actionLink.onclick = function() {
                                    chooseNumber(item.nmNumber, idKamar); // Assuming 'chooseNumber' function takes a parameter
                                  };

                                  tdAction.appendChild(actionLink);

                                  tr.appendChild(memberKamar);
                                  tr.appendChild(memberKeterangan);
                                  tr.appendChild(memberOwner);
                                  tr.appendChild(memberHarga);
                                  tr.appendChild(memberAvailable);
                                  tr.appendChild(tdAction);

                                  tableBody.appendChild(tr);
                              });
                            }
                          }
                      });
                      function chooseNumber(number, idKamar) {
                        // Add your code to handle the chosen number here
                        console.log("Chosen Number:", number);
                        document.getElementById('numberroom').value = number;
                        var ratecodeInput = document.getElementById('ratecode');
                        ratecodeInput.setAttribute('data-toggle', 'modal');
                        ratecodeInput.setAttribute('data-target', '#ratecodeModal');
                        ratecodeInput.readOnly = false;
                        $.ajax({
                            type: "POST",
                            url: '<?php echo base_url("cms/home/ajaxRatecode/") ?>' + idKamar + '/',
                            data: { ratecodeValue: getNumber },
                            success: function(ratecoderesponse) {
                                var ratecoderesult = JSON.parse(ratecoderesponse);
                                // Assuming 'datatable-buttons' is the ID of your table
                                var ratecodetableBody = document.querySelector(".ratecodelist tbody");

                                // Clear any previous content
                                ratecodetableBody.innerHTML = '';

                                // Assuming 'ratecoderesult' is an array of objects
                                ratecoderesult.forEach(function(ratecodeitem) {
                                    var ratecodetr = document.createElement('tr');

                                    var tdrateName = document.createElement('td');
                                    tdrateName.textContent = ratecodeitem.nmRatecode;

                                    var tdrateBegin = document.createElement('td');
                                    tdrateBegin.textContent = ratecodeitem.beginRatecode;

                                    var tdrateEnd = document.createElement('td');
                                    tdrateEnd.textContent = ratecodeitem.endRatecode;

                                    var tdrateExtrabed = document.createElement('td');
                                    tdrateExtrabed.textContent = ratecodeitem.extrabedRatecode;

                                    var tdrateDiscount = document.createElement('td');
                                    tdrateDiscount.textContent = ratecodeitem.discRatecode;

                                    var tdrateRO = document.createElement('td');
                                    var tdrateROactionLink = document.createElement('button');
                                    tdrateROactionLink.classList.add('btn', 'btn-primary'); // Add classes
                                    tdrateROactionLink.href = '#'; // Add your link here
                                    tdrateROactionLink.textContent = ratecodeitem.roOccupancy;
                                    // Add data attributes
                                    tdrateROactionLink.dataset.dismiss = 'modal';
                                    tdrateROactionLink.setAttribute('aria-label', 'Close');

                                    var tdrateRB = document.createElement('td');
                                    var tdrateRBactionLink = document.createElement('button');
                                    tdrateRBactionLink.classList.add('btn', 'btn-primary'); // Add classes
                                    tdrateRBactionLink.href = '#'; // Add your link here
                                    tdrateRBactionLink.textContent = ratecodeitem.rbOccupancy;
                                    // Add data attributes
                                    tdrateRBactionLink.dataset.dismiss = 'modal';
                                    tdrateRBactionLink.setAttribute('aria-label', 'Close');

                                    // Add data attributes
                                    tdrateROactionLink.dataset.dismiss = 'modal';
                                    tdrateROactionLink.setAttribute('aria-label', 'Close');
                                    tdrateROactionLink.onclick = function() {
                                      console.log("Chosen Rate Code:", ratecodeitem.nmRatecode);
                                      document.getElementById('ratecode').value = ratecodeitem.nmRatecode + ' RO';
                                      document.getElementById('totalrate').value = 0;
                                      document.getElementById('totalrate').value = ratecodeitem.roOccupancy;
                                    };

                                    tdrateRBactionLink.dataset.dismiss = 'modal';
                                    tdrateRBactionLink.setAttribute('aria-label', 'Close');
                                    tdrateRBactionLink.onclick = function() {
                                      console.log("Chosen Rate Code:", ratecodeitem.nmRatecode);
                                      document.getElementById('ratecode').value = ratecodeitem.nmRatecode + ' RB';
                                      document.getElementById('totalrate').value = 0;
                                      document.getElementById('totalrate').value = ratecodeitem.rbOccupancy;
                                    };

                                    var percentageInUse = localStorage.getItem('percentageInUse');
                                    var ratenow = document.getElementById('totalrate').value;
                                    if(percentageInUse >= 0 && percentageInUse < 40) {
                                      if(ratenow == ratecodeitem.roOccupancy || ratenow == ratecodeitem.rbOccupancy) {
                                        ratecodetr.style.backgroundColor = 'orange';
                                      } else {
                                        tdrateROactionLink.disabled = false;
                                        tdrateRBactionLink.disabled = false;
                                      }
                                    } else if(percentageInUse > 41 && percentageInUse < 60) {
                                      if(ratenow == ratecodeitem.roOccupancy || ratenow == ratecodeitem.rbOccupancy) {
                                        ratecodetr.style.backgroundColor = 'orange';
                                      } else {
                                        tdrateROactionLink.disabled = false;
                                        tdrateRBactionLink.disabled = false;
                                      }
                                    } else if(percentageInUse > 61 && percentageInUse < 70) {
                                      if(ratenow == ratecodeitem.roOccupancy || ratenow == ratecodeitem.rbOccupancy) {
                                        ratecodetr.style.backgroundColor = 'orange';
                                      } else {
                                        tdrateROactionLink.disabled = false;
                                        tdrateRBactionLink.disabled = false;
                                      }
                                    } else if(percentageInUse > 71 && percentageInUse < 80) {
                                      if(ratenow == ratecodeitem.roOccupancy || ratenow == ratecodeitem.rbOccupancy) {
                                        ratecodetr.style.backgroundColor = 'orange';
                                      } else {
                                        tdrateROactionLink.disabled = false;
                                        tdrateRBactionLink.disabled = false;
                                      }
                                    } else if(percentageInUse > 81 && percentageInUse < 90) {
                                      if(ratenow == ratecodeitem.roOccupancy || ratenow == ratecodeitem.rbOccupancy) {
                                        ratecodetr.style.backgroundColor = 'orange';
                                      } else {
                                        tdrateROactionLink.disabled = false;
                                        tdrateRBactionLink.disabled = false;
                                      }
                                    } else if(percentageInUse > 91 && percentageInUse < 100) {
                                      if(ratenow == ratecodeitem.roOccupancy || ratenow == ratecodeitem.rbOccupancy) {
                                        ratecodetr.style.backgroundColor = 'orange';
                                      } else {
                                        tdrateROactionLink.disabled = false;
                                        tdrateRBactionLink.disabled = false;
                                      }
                                    }

                                    tdrateRO.appendChild(tdrateROactionLink);
                                    tdrateRB.appendChild(tdrateRBactionLink);

                                    ratecodetr.appendChild(tdrateName);
                                    ratecodetr.appendChild(tdrateBegin);
                                    ratecodetr.appendChild(tdrateEnd);
                                    ratecodetr.appendChild(tdrateExtrabed);
                                    ratecodetr.appendChild(tdrateDiscount);
                                    ratecodetr.appendChild(tdrateRO);
                                    ratecodetr.appendChild(tdrateRB);

                                    ratecodetableBody.appendChild(ratecodetr);
                                });
                            }
                        });
                        console.log(number, idKamar);
                        var discountInput = document.getElementById('discount');
                        discountInput.readOnly = false;
                      }
                    });
                  </script>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="status">Status *
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <select id="status" name="statusBooking" class="form-control" required style="background: #ffff4c82;">
                      <option value>Choose..</option>
                      <option value="Reservation" <?php echo set_select('statusBooking', 'Reservation'); ?>>Reservation</option>
                      <option value="Confirm" <?php echo set_select('statusBooking', 'Confirm'); ?>>Confirm</option>
                      <option value="Tentative" <?php echo set_select('statusBooking', 'Tentative'); ?>>Tentative</option>
                      <option value="Canceled" <?php echo set_select('statusBooking', 'Canceled'); ?>>Canceled</option>
                      <option value="Waiting List" <?php echo set_select('statusBooking', 'Waiting List'); ?>>Waiting List</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="roomtype">2. Room Type *
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="text" id="roomtype" name="roomtypeBooking" class="form-control" placeholder="Search room...." readonly value="<?php echo set_value('roomtypeBooking'); ?>" required style="background: #ffff4c82;">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="updagradeto">Upgrade to
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="text" id="updagradeto" name="updagradetoBooking" class="form-control" placeholder="Search room....">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="block">Block
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="text" id="block" name="blockBooking" class="form-control">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="feautres">Feautres
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="text" readonly id="feautres" name="feautresBooking" class="form-control">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="numberroom">Room No
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="text" id="numberroom" name="numberroomBooking" class="form-control" readonly value="<?php echo set_value('numberroomBooking'); ?>" style="background: #ffff4c82;">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="ratecode">Rate Code
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="text" readonly id="ratecode" name="ratecodeBooking" class="form-control" placeholder="Search code...." value="<?php echo set_value('ratecodeBooking'); ?>" style="background: #ffff4c82;">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="totalrate">Total Rate *
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="text" readonly id="totalrate" name="totalrateBooking" class="form-control" value="<?php echo set_value('totalrateBooking'); ?>" required style="background: #ffff4c82;">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="discount">Diskon
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input readonly type="text" id="discount" name="discountBooking" class="form-control" value="<?php echo set_value('discountBooking'); ?>">
                    <span class="form-control-feedback right" aria-hidden="true">%</span>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="reason">Reason
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <select id="reason" name="reasonBooking" class="form-control">
                      <option value>Choose..</option>
                      <?php 
                        $promotion = array();
                        $this->db->from('promotion');
                        $this->db->where('idBusiness', $this->session->userdata('idBusiness'));
                        $query = $this->db->get();
                        if ($query->num_rows() > 0)
                        {
                          foreach ($query->result() as $row)
                          {
                            $promotion[] = $row;
                          }
                        }
                        $query->free_result(); 
                      ?>
                      <?php 
                        foreach($promotion as $row) {
                      ?>
                        <option value="<?php echo $row->nmPromotion ?>"><?php echo $row->ketPromotion ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="rateafterdiscount">Rate after discount
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input type="text" id="rateafterdiscount" name="rateafterdiscountBooking" class="form-control">
                  </div>
                  <label class="col-form-label col-md-2 col-sm-2 label-align" for="splitroomonly">Split Room Only
                  </label>
                  <div class="col-md-1 col-sm-1">
                    <input type="checkbox" id="splitroomonly" name="splitroomonlyBooking">
                  </div>
                </div>
                <script type="text/javascript">
                  function updateRateAfterDiscount() {
                      var totalRate = parseFloat(document.getElementById('totalrate').value);
                      var discount = parseFloat(document.getElementById('discount').value);

                      if (!isNaN(totalRate) && !isNaN(discount)) {
                          var rateAfterDiscount = totalRate - (totalRate * (discount / 100));
                          document.getElementById('rateafterdiscount').value = rateAfterDiscount;
                      }
                  }

                  document.getElementById('totalrate').addEventListener('input', updateRateAfterDiscount);
                  document.getElementById('discount').addEventListener('input', updateRateAfterDiscount);
                </script>
                <script>
                  document.getElementById('rateafterdiscount').addEventListener('input', function() {
                    var rateAfterDiscount = parseInt(this.value);
                    var totalRate = document.getElementById('totalrate').value; // Replace with your actual total rate
                    var discount = totalRate - rateAfterDiscount;
                    var discountPercentage = ((discount / totalRate) * 100).toFixed(2);

                    document.getElementById('discount').value = discountPercentage;
                  });
                </script>
                <div class="item form-group">
                  <label class="col-form-label col-md-7 col-sm-7 label-align" for="latecheckoutcharge">Late Check Out Charge
                  </label>
                  <div class="col-md-5 col-sm-5">
                    <input type="text" id="latecheckoutcharge" name="latecheckoutchargeBooking" class="form-control" placeholder="Search code....">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="commision">Commision
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <input type="text" id="commision" name="commisionBooking" class="form-control">
                  </div>
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="agent">Agent
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <input type="text" id="agent" name="agentBooking" class="form-control">
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="ln_solid"></div>
              </div>
              <div class="col-md-6">
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="firstname">3. First Name *
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="text" id="firstname" name="firstnameBooking" class="form-control" placeholder="Search name...." value="<?php echo set_value('firstnameBooking'); ?>" required style="background: #ffff4c82;">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="lastname">Last Name *
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <input type="text" id="lastname" name="lastnameBooking" class="form-control" placeholder="Search name...." value="<?php echo set_value('lastnameBooking'); ?>" required style="background: #ffff4c82;">
                  </div>
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="gender">Gender *
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <select id="gender" name="genderBooking" class="form-control" required style="background: #ffff4c82;">
                      <option value>Choose..</option>
                      <option value="Mr" <?php echo set_select('genderBooking', 'Mr'); ?>>Mr</option>
                      <option value="Mrs" <?php echo set_select('genderBooking', 'Mrs'); ?>>Mrs</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">ID Number</label>
                  <div class="col-sm-9">
                    <div class="input-group">
                      <input type="text" id="idnumber" name="idnumberBooking" class="form-control" value="<?php echo set_value('idnumberBooking'); ?>">
                      <span class="input-group-btn">
                        <div class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#memberModal" >Check</div>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Visit</label>
                  <div class="col-sm-9">
                    <div class="input-group">
                      <input readonly type="text" id="visitMembership" name="visitMembership" class="form-control" value="<?php echo set_value('visitMembership'); ?>">
                      <span class="input-group-btn">
                        <div class="btn btn-warning" id="nmMembershipdetail" style="float: right;"></div>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="birthday">Birthday
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <input type="date" id="birthday" name="birthdayBooking" class="form-control" value="<?php echo set_value('birthdayBooking'); ?>">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email *
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <input type="text" id="email" name="emailBooking" class="form-control" value="<?php echo set_value('emailBooking'); ?>" required style="background: #ffff4c82;">
                  </div>
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="mobile">Mobile *
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <input type="text" id="mobile" name="mobileBooking" class="form-control" value="<?php echo set_value('mobileBooking'); ?>" required style="background: #ffff4c82;">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="address">Address
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <textarea type="text" id="address" name="addressBooking" class="form-control"><?php echo set_value('addressBooking'); ?></textarea>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="insideallotment">Inside Allotment
                  </label>
                  <div class="col-md-1 col-sm-1">
                    <input type="checkbox" id="insideallotment" name="insideallotmentBooking">
                  </div>
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="individualbill">Individual Bill
                  </label>
                  <div class="col-md-1 col-sm-1">
                    <input type="checkbox" id="individualbill" name="individualbillBooking">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="bookercode">Booker Code
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <input type="text" id="bookercode" name="bookercodeBooking" class="form-control">
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <input type="text" id="bookercode1" name="bookercode1Booking" class="form-control">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="bookercontact">4. Booker Contact
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <input type="text" id="bookercontact" name="bookercontactBooking" class="form-control" placeholder="Search contact....">
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <input type="text" id="bookercontact1" name="bookercontact1Booking" class="form-control">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="bookeremail">Booker Email
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <input type="text" id="bookeremail" name="bookeremailBooking" class="form-control">
                  </div>
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="bookermobile">Mobile
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <input type="text" id="bookermobile1" name="bookermobile1Booking" class="form-control">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="pax">5. Pax *
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="number" id="pax" name="paxBooking" class="form-control" min="1" placeholder="1" value="2" required style="background: #ffff4c82;">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="child">Child
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="number" id="child" name="childBooking" class="form-control" min="1" value="<?php echo set_value('childBooking'); ?>" placeholder="0">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="extrabed">Extra Bed
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="number" id="extrabed" name="extrabedBooking" class="form-control" value="<?php echo set_value('extrabedBooking'); ?>" placeholder="0">
                  </div>
                  <script>
                    var previousExtrabedValue = 0;
                    document.getElementById('extrabed').addEventListener('input', function() {
                        var extrabedValue = parseInt(this.value, 10) || 0;
                        var newTotalrateValue = extrabedValue * 250000;

                        if (extrabedValue > previousExtrabedValue) {
                            document.getElementById('rateafterdiscount').value = parseInt(document.getElementById('rateafterdiscount').value, 10) + newTotalrateValue;
                        } else if (extrabedValue < previousExtrabedValue) {
                            document.getElementById('rateafterdiscount').value = parseInt(document.getElementById('rateafterdiscount').value, 10) - (previousExtrabedValue * 250000);
                        }

                        previousExtrabedValue = extrabedValue;
                    });
                  </script>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="vip">VIP
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <select id="vip" name="vipBooking" class="form-control">
                      <option value>Choose..</option>
                      <option value="Reguler">Reguler</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="arrivaltimeBooking">Arrival Time
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="time" id="arrivaltimeBooking" name="arrivaltimeBooking" class="form-control" value="14:00" style="background: #ffff4c82;">
                    <script>
                        // Get the current time in the format HH:MM
                        const currentTime = new Date().toLocaleTimeString('id-ID', {hour12: false});
                        
                        // Set the value of the time input to the current time
                        document.getElementById('arrivaltimeBooking').value = '14:00';
                    </script>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="departuretimeBooking">Departure Time
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="time" id="departuretimeBooking" name="departuretimeBooking" class="form-control" value="12:00" style="background: #ffff4c82;">
                    <script>
                        // Get the current time in the format HH:MM
                        const currentTime = new Date().toLocaleTimeString('id-ID', {hour12: false});
                        
                        // Set the value of the time input to the current time
                        document.getElementById('departuretimeBooking').value = '12:00';
                    </script>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="payment">6. Payment
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <select id="payment" name="paymentBooking" class="form-control">
                      <option value>Choose..</option>
                      <?php 
                        $payment = array();
                        $this->db->from('payment');
                        $this->db->where('idBusiness', $this->session->userdata('idBusiness'));
                        $query = $this->db->get();
                        if ($query->num_rows() > 0)
                        {
                          foreach ($query->result() as $row)
                          {
                            $payment[] = $row;
                          }
                        }
                        $query->free_result(); 
                      ?>
                      <?php 
                        foreach($payment as $row) {
                      ?>
                        <option value="<?php echo $row->nmPayment ?>"><?php echo $row->ketPayment ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="currency">Currency
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <select id="currency" name="currencyBooking" class="form-control">
                      <option value>Choose..</option>
                      <option value="IDR">IDR</option>
                      <option value="USD">USD</option>
                    </select>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="creditcardno">Credit Card No.
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="text" id="creditcardno" name="creditcardnoBooking" class="form-control">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="validdatethru">Valid Date (Thru)
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <input type="text" id="validdatethru" name="validdatethruBooking" class="form-control">
                  </div>
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="creditlimit">Credit Limit
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <input type="text" id="creditlimit" name="creditlimitBooking" class="form-control">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="voucherno">Voucher No.
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="text" id="voucherno" name="vouchernoBooking" class="form-control">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="salesperson">Sales Person *
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <select id="salesperson" name="salespersonBooking" class="form-control" required style="background: #ffff4c82;">
                      <option value>Choose..</option>
                      <option value="AMG">PT. AMG</option>
                      <option value="ECU">PT. ECU</option>
                      <option value="FO">Front Office</option>
                      <option value="RAKACON">RAKACON</option>
                      <option value="SALAM">PT. SALAM</option> 
                      <option value="SALAM1">HARY</option> 
                      <option value="SALAM2">RENDY</option> 
                      <option value="GRO">GRO</option> 
                    </select>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="welcoming">Welcoming
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="text" id="welcoming" name="welcomingBooking" class="form-control">
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="ln_solid"></div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="segment">7. Segment *
                </label>
                <div class="col-md-3 col-sm-3">
                  <select id="segment" name="segmentBooking" class="form-control" required style="background: #ffff4c82;">
                    <option value>Choose..</option>
                    <option value="CFIT">Corporate Ind Travel</option>
                    <option value="FIT">FIT</option>
                    <option value="GFIT">Goverment Ind Travel</option>
                    <option value="GRCM">Corporate MICE</option>
                    <option value="GRGM">Goverment MICE</option>
                    <option value="OTA">Online Travel Agent</option>
                    <option value="PCKG">Hotel Package</option>
                    <option value="PRTY">Party</option>
                    <option value="RC">Restaurant & Cafe</option>
                    <option value="TA">Travel Agent</option>
                    <option value="WEB">Website</option>
                    <option value="WEDD">Wedding</option>
                  </select>
                </div>
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="autocomplete-custom-append-countries">Nationality *
                </label>
                <div class="col-md-3 col-sm-3">
                  <input type="text" id="autocomplete-custom-append-countries" name="nationalityBooking" class="form-control" value="Indonesian" required style="background: #ffff4c82;">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="originarea">Origin Area *
                </label>
                <div class="col-md-3 col-sm-3">
                  <input type="text" id="autocomplete-custom-append-originarea" name="originareaBooking" class="form-control" value="Kota Bogor" required style="background: #ffff4c82;">
                </div>
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="destination">Destination *
                </label>
                <div class="col-md-3 col-sm-3">
                  <select id="destination" name="destinationBooking" class="form-control" required style="background: #ffff4c82;">
                    <option value>Choose..</option>
                    <option selected value="BGR">BGR</option>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="source">Source
                </label>
                <div class="col-md-3 col-sm-3">
                  <select id="source" name="sourceBooking" class="form-control">
                    <option value>Choose..</option>
                    <option value="CRO">Corporate Office</option>
                    <option value="DB">Direct Booking</option>
                    <option value="FAX">Faximile</option>
                    <option value="OTA">Online Travel Agent</option>
                    <option value="PHN">Telephone</option>
                    <option value="SM">Sales & Marketing</option>
                    <option value="SOC">Social Media</option>
                    <option value="WEB">Website</option>
                    <option value="WI">Walk In Guest</option>
                  </select>
                </div>
                <label class="col-form-label col-md-2 col-sm-2 label-align" for="honeymoon">Honeymoon
                </label>
                <div class="col-md-1 col-sm-1">
                  <input type="checkbox" id="honeymoon" name="honeymoonBooking" value="1">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="cashbasis">Cash Basis
                </label>
                <div class="col-md-1 col-sm-1">
                  <input type="checkbox" id="cashbasis" name="cashbasisBooking" value="1">
                </div>
                <label class="col-form-label col-md-2 col-sm-2 label-align" for="transactionclosed">Transaction Closed
                </label>
                <div class="col-md-1 col-sm-1">
                  <input type="checkbox" id="transactionclosed" name="transactionclosedBooking" value="1">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="noinfo">No Info (Incognito)
                </label>
                <div class="col-md-1 col-sm-1">
                  <input type="checkbox" id="noinfo" name="noinfoBooking" value="1">
                </div>
                <label class="col-form-label col-md-2 col-sm-2 label-align" for="blockedphone">Blocked Phone
                </label>
                <div class="col-md-1 col-sm-1">
                  <input type="checkbox" id="blockedphone" name="blockedphoneBooking" value="1">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="flightarrive">Flight Arrive
                </label>
                <div class="col-md-3 col-sm-3">
                  <select id="flightarrive" name="flightarriveBooking" class="form-control">
                    <option value>Choose..</option>
                    <option value="CAR">Car..</option>
                    <option value="PLANE">Plane..</option>
                    <option value="TAXI">Taxi..</option> 
                  </select>
                </div>
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="flightdepart">Flight Depart.
                </label>
                <div class="col-md-3 col-sm-3">
                  <select id="flightdepart" name="flightdepartBooking" class="form-control">
                    <option value>Choose..</option>
                    <option value="CAR">Car..</option>
                    <option value="PLANE">Plane..</option>
                    <option value="TAXI">Taxi..</option> 
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="ln_solid"></div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="billinginstruction">8. Billing Instruction (Cashier Remark) *
                </label>
                <div class="col-md-9 col-sm-9">
                  <input type="text" id="billinginstruction" name="billinginstructionBooking" class="form-control" value="<?php echo set_value('billinginstructionBooking'); ?>" required style="background: #ffff4c82;">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="checkinremark">Check In Remark
                </label>
                <div class="col-md-9 col-sm-9">
                  <input type="text" id="checkinremark" name="checkinremarkBooking" class="form-control" value="<?php echo set_value('checkinremarkBooking'); ?>">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="preference">Preference
                </label>
                <div class="col-md-9 col-sm-9">
                  <input type="text" id="preference" name="preferenceBooking" class="form-control">
                </div>
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
<!-- Add this script in your inputbooking.php or your main JavaScript file -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    var form = document.getElementById("demo-form2");
    var formChanged = false;

    form.addEventListener("input", function () {
      formChanged = true;
      console.log("Form changed");
    });

    form.addEventListener("submit", function () {
      // Reset the formChanged flag when the form is submitted
      formChanged = false;
      console.log("Form submitted");
    });

    window.addEventListener('beforeunload', function (event) {
      if (formChanged) {
        var confirmationMessage = 'You have unsaved changes. Are you sure you want to leave?';
        console.log("Showing confirmation message");
        (event || window.event).returnValue = confirmationMessage;
        return confirmationMessage;
      }
    });
  });
  </script>
