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
            <h2>Package Meeting <?php echo $this->session->userdata('business') ?> #<?php echo $new_invoice_number ?>
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
            <table class="table roomready">
              <thead>
                <tr>
                    <th>Paket Meeting</th>
                    <th>Room Number</th>
                    <th>Total Room</th>
                    <th>Pax</th>
                    <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach($bookingcart as $row) {
                ?>
                  <tr>
                    <td><?php echo $row->roomtypeBooking ?></td>
                    <td><input style="background-color: #212121;" onclick="checkNumberCart(<?php echo $row->idKamar ?>)" value="<?php echo $row->numberroomBooking ?>" placeholder="Select room numbers here" readonly type="text" class="form-control" data-toggle="modal" data-target="#numberroommeetingModal<?php echo $row->idKamar ?>"></td>
                    <td><?php echo $row->roompaxBooking ?></td>
                    <td><?php echo $row->paxBooking ?></td>
                    <td><?php echo number_format($row->totalrateBooking) ?></td>
                    <td>
                      <div class="modal fade" id="numberroommeetingModal<?php echo $row->idKamar ?>" tabindex="-1" role="dialog" aria-labelledby="numberroommeetingModalLabel<?php echo $row->idKamar ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="numberroommeetingModalLabel<?php echo $row->idKamar ?>">Room Number <?php echo $row->roomtypeBooking ?></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <table class="table numberroomcart<?php echo $row->idKamar ?>">
                                <thead>
                                  <tr>
                                    <th>Nomor Kamar</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>
                              </table>
                            </div>
                            <div class="modal-footer">
                            </div>
                          </div>
                        </div>
                      </div>
                      <script type="text/javascript">
                        function checkNumberCart(idKamar) {
                          <?php
                            $displayed_name = array(); // Array to keep track of displayed invoices
                            foreach($bookingcart as $row) {
                          ?>
                          var getNumber = localStorage.getItem('room');
                          $.ajax({
                            type: "POST",
                            url: '<?php echo base_url("cms/home/sendajaxNumberkamar") ?>',
                            data: { new_invoice_number: '<?php echo $new_invoice_number ?>', arrivalBooking: '<?php echo $row->arrivalBooking ?>', departureBooking: '<?php echo $row->departureBooking ?>', roomtypeBooking: '<?php echo $row->roomtypeBooking ?>' },
                            success: function(response) {
                              var result = JSON.parse(response);
                              console.log(idKamar);
                              // Assuming 'datatable-buttons' is the ID of your table
                              var tableBody = document.querySelector(".numberroomcart<?php echo $row->idKamar ?> tbody");

                              // Clear any previous content
                              tableBody.innerHTML = '';
                              try {
                                // Assuming 'result' is an array of objects
                                result.forEach(function(item) {
                                  var tr = document.createElement('tr');

                                  if(item.nmNumber != null) {
                                    var tdidKamar = document.createElement('td');
                                    var idKamarInput = document.createElement('input');
                                    idKamarInput.type = 'hidden';
                                    idKamarInput.value = item.idKamar;
                                    idKamarInput.id = 'idKamar'+item.idKamar;
                                    idKamarInput.name = 'idKamar';

                                    var tdNomor = document.createElement('td');
                                    tdNomor.textContent = item.nmNumber;

                                    var tdType = document.createElement('td');
                                    tdType.textContent = item.ketKamar;

                                    var tdKetKamar = document.createElement('td');
                                    tdKetKamar.textContent = item.ketKamar;

                                    var tdStatus = document.createElement('td');
                                    tdStatus.textContent = item.ketNumber;

                                    var tdAction = document.createElement('td');
                                    var actionCheckbox = document.createElement('input');
                                    actionCheckbox.type = 'checkbox';
                                    actionCheckbox.max = item.roompaxBooking;
                                    actionCheckbox.dataset.type = item.ketKamar;
                                    actionCheckbox.id = item.nmNumber;
                                    // Set data-type<?php echo $row->idKamar ?> attribute for the row
                                    tr.setAttribute('data-type<?php echo $row->idKamar ?>', item.ketKamar);
                                    // Add a click event listener to the row to handle checkbox clicks
                                    actionCheckbox.addEventListener('click', function(e) {
                                      e.stopPropagation(); // Prevent the click event from reaching the row
                                      // Get all rows in the table
                                      var allRows = document.querySelectorAll('table tbody tr');

                                      // Initialize checked count
                                      var checkedCount = 0;

                                      allRows.forEach(function(row) {
                                        var dataType = row.getAttribute('data-type<?php echo $row->idKamar ?>');

                                        if (dataType === item.ketKamar) {
                                          var checkbox = row.querySelector('input[type="checkbox"]');

                                          checkbox.addEventListener('change', function() {
                                            if (this.checked) {
                                              checkedCount++;
                                              if (checkedCount >= item.roompaxBooking) {
                                                allRows.forEach(function(r) {
                                                  var rType = r.getAttribute('data-type<?php echo $row->idKamar ?>');
                                                  if (rType === item.ketKamar) {
                                                    var cb = r.querySelector('input[type="checkbox"]');
                                                    if (!cb.checked) {
                                                      cb.disabled = false;
                                                    }
                                                  }
                                                });
                                              }
                                            } else {
                                              checkedCount--;
                                              allRows.forEach(function(r) {
                                                var rType = r.getAttribute('data-type<?php echo $row->idKamar ?>');
                                                if (rType === item.ketKamar) {
                                                  var cb = r.querySelector('input[type="checkbox"]');
                                                  cb.disabled = false;
                                                }
                                              });
                                            }
                                          });
                                        }
                                      });

                                    });

                                    // Add data attributes
                                    actionCheckbox.onclick = function() {
                                      chooseNumber(item.nmNumber); // Assuming 'chooseNumber' function takes a parameter
                                      if (this.checked) {
                                        let selectedOptions = JSON.parse(localStorage.getItem('selectedOptions')) || [];
                                        selectedOptions.push(item.nmNumber);
                                        localStorage.setItem('selectedOptions', JSON.stringify(selectedOptions));
                                        document.getElementById('numberroom').value = selectedOptions;
                                      } else {
                                        let selectedOptions = JSON.parse(localStorage.getItem('selectedOptions')) || [];
                                        selectedOptions = selectedOptions.filter(items => items !== item.nmNumber);
                                        localStorage.setItem('selectedOptions', JSON.stringify(selectedOptions));
                                        actionCheckbox.setAttribute('disabled', 'false');
                                      }
                                    };

                                    window.addEventListener('beforeunload', function() {
                                      localStorage.removeItem('selectedOptions');
                                    });

                                    tdAction.appendChild(actionCheckbox);
                                    tdidKamar.appendChild(idKamarInput);
                                    tr.appendChild(tdNomor);
                                    tr.appendChild(tdType);
                                    tr.appendChild(tdStatus);
                                    tr.appendChild(tdKetKamar);
                                    tr.appendChild(tdAction);

                                    tableBody.appendChild(tr);
                                  } else {
                                    var tdidKamarMeeting = document.createElement('td');
                                    var idKamarMeetingInput = document.createElement('input');
                                    idKamarMeetingInput.type = 'hidden';
                                    idKamarMeetingInput.value = item.idKamarMeeting;
                                    idKamarMeetingInput.id = 'idKamar'+item.idKamarMeeting;
                                    idKamarMeetingInput.name = 'idKamar';

                                    var tdNomorMeeting = document.createElement('td');
                                    tdNomorMeeting.textContent = item.nmNumberMeeting;

                                    var tdTypeMeeting = document.createElement('td');
                                    tdTypeMeeting.textContent = item.nmTypeMeeting;

                                    var tdKetKamarMeeting = document.createElement('td');
                                    tdKetKamarMeeting.textContent = item.ketKamarMeeting;

                                    var tdStatusMeeting = document.createElement('td');
                                    tdStatusMeeting.textContent = item.ketNumberMeeting;

                                    var tdActionMeeting = document.createElement('td');
                                    var actionCheckbox = document.createElement('input');
                                    actionCheckbox.type = 'checkbox';
                                    actionCheckbox.max = item.paxBooking;
                                    actionCheckbox.dataset.type = item.nmTypeMeeting;
                                    actionCheckbox.id = item.nmNumberMeeting;
                                    // Set data-type<?php echo $row->idKamar ?> attribute for the row
                                    tr.setAttribute('data-type<?php echo $row->idKamar ?>', item.nmTypeMeeting);
                                    // Add a click event listener to the row to handle checkbox clicks
                                    actionCheckbox.addEventListener('click', function(e) {
                                      e.stopPropagation(); // Prevent the click event from reaching the row
                                      // Get all rows in the table
                                      var allRows = document.querySelectorAll('table tbody tr');

                                      // Initialize checked count
                                      var checkedCount = 0;

                                      allRows.forEach(function(row) {
                                        var dataType = row.getAttribute('data-type<?php echo $row->idKamar ?>');

                                        if (dataType === item.nmTypeMeeting) {
                                          var checkbox = row.querySelector('input[type="checkbox"]');

                                          checkbox.addEventListener('change', function() {
                                            if (this.checked) {
                                              checkedCount++;
                                              if (checkedCount >= item.paxBooking) {
                                                allRows.forEach(function(r) {
                                                  var rType = r.getAttribute('data-type<?php echo $row->idKamar ?>');
                                                  if (rType === item.nmTypeMeeting) {
                                                    var cb = r.querySelector('input[type="checkbox"]');
                                                    if (!cb.checked) {
                                                      cb.disabled = false;
                                                    }
                                                  }
                                                });
                                              }
                                            } else {
                                              checkedCount--;
                                              allRows.forEach(function(r) {
                                                var rType = r.getAttribute('data-type<?php echo $row->idKamar ?>');
                                                if (rType === item.nmTypeMeeting) {
                                                  var cb = r.querySelector('input[type="checkbox"]');
                                                  cb.disabled = false;
                                                }
                                              });
                                            }
                                          });
                                        }
                                      });

                                    });

                                    if(item.ketNumberMeeting != 'VR') {
                                      actionCheckbox.classList.add('btn', 'btn-warning'); // Add classes
                                      actionCheckbox.setAttribute('disabled', 'True');
                                      actionCheckbox.setAttribute('checked', 'True');
                                    } else {
                                      actionCheckbox.classList.add('btn', 'btn-primary'); // Add classes
                                    }

                                    // Add data attributes
                                    actionCheckbox.onclick = function() {
                                      chooseNumber(item.nmNumberMeeting); // Assuming 'chooseNumber' function takes a parameter
                                      if (this.checked) {
                                        let selectedOptions = JSON.parse(localStorage.getItem('selectedOptions')) || [];
                                        selectedOptions.push(item.nmNumberMeeting);
                                        localStorage.setItem('selectedOptions', JSON.stringify(selectedOptions));
                                        document.getElementById('numberroom').value = selectedOptions;
                                      } else {
                                        let selectedOptions = JSON.parse(localStorage.getItem('selectedOptions')) || [];
                                        selectedOptions = selectedOptions.filter(items => items !== item.nmNumberMeeting);
                                        localStorage.setItem('selectedOptions', JSON.stringify(selectedOptions));
                                        actionCheckbox.setAttribute('disabled', 'True');
                                      }
                                    };

                                    window.addEventListener('beforeunload', function() {
                                      localStorage.removeItem('selectedOptions');
                                    });

                                    tdActionMeeting.appendChild(actionCheckbox);
                                    tdidKamarMeeting.appendChild(idKamarMeetingInput);
                                    tr.appendChild(tdNomorMeeting);
                                    tr.appendChild(tdTypeMeeting);
                                    tr.appendChild(tdStatusMeeting);
                                    tr.appendChild(tdKetKamarMeeting);
                                    tr.appendChild(tdActionMeeting);

                                    tableBody.appendChild(tr);
                                  }
                                });
                              } catch (error) {
                                console.error('Error:', error.message);
                                AlertError();
                                // Add your error handling code here
                              } 
                            }
                          });

                          function chooseNumber(number) {
                            // Add your code to handle the chosen number here
                            console.log("Chosen Number:", number);
                            document.getElementById('numberroom').value = number;
                          }

                          function AlertError() {
                            swal({
                              title: "Error",
                              text: "Data tidak ditemukan, kembali kehalaman sebelumnya",
                              type: "error",
                              confirmButtonText: "Close"
                            });
                          }
                          <?php } ?>
                        }
                      </script>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <br />
            <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateAdditionalFormBookingMeeting/'.$new_invoice_number) ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
              <input type="hidden"  value="<?php echo $databookingcart->companyBooking ?>" name="idCompany">
              <div class="col-md-6">
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="status">Status *
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <select id="status" name="statusBooking" class="form-control" required>
                      <option value="<?php echo $databookingcart->statusBooking ?>"><?php echo $databookingcart->statusBooking ?></option>
                      <option value>Choose..</option>
                      <option value="Confirm">Confirm</option>
                      <option value="Tentative">Tentative</option>
                      <option value="Canceled">Canceled</option>
                      <option value="Waiting List">Waiting List</option>
                    </select>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="numberroom">No Room
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <div class="input-group">
                      <input value="<?php echo $databookingcart->numberroomBooking ?>" readonly type="text" id="numberroom" name="numberroomBooking" class="form-control">
                      <span class="input-group-btn">
                        <div class="btn btn-danger" style="float: right;" data-toggle="modal" data-target="#roommember<?php echo $databookingcart->idType ?>">Room Member</div>
                      </span>
                    </div>
                    <div class="modal fade" id="roommember<?php echo $databookingcart->idType ?>" tabindex="-1" role="dialog" aria-labelledby="roommemberLabel<?php echo $databookingcart->idType ?>" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="roommemberLabel<?php echo $databookingcart->idType ?>">Room Number <?php echo $databookingcart->roomtypeBooking ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th>Nomor Kamar</th>
                                  <th>Member</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                  $booking_room_member = array();
                                  $this->db->from('booking_room_member');
                                  $this->db->join('booking_cart', 'booking_cart.invoiceBooking=booking_room_member.invoiceBooking', 'left');
                                  $this->db->where('booking_room_member.invoiceBooking', $new_invoice_number);
                                  $query = $this->db->get();
                                  if ($query->num_rows() > 0)
                                  {
                                    foreach ($query->result() as $row)
                                    {
                                      $booking_room_member[] = $row;
                                    }
                                  }
                                  $query->free_result(); 
                                ?>
                                <?php 
                                  $displayed_name_member = array(); // Array to keep track of displayed invoices
                                  foreach($booking_room_member as $roommember) {
                                    if (!in_array($roommember->noBookingroommember, $displayed_name_member)) {
                                      // Add the invoice to the list of displayed invoices
                                      $displayed_name_member[] = $roommember->noBookingroommember;
                                ?>
                                  <tr>
                                  <td><input type="text" readonly name="noBookingroommember" id="noBookingroommember<?php echo $roommember->noBookingroommember ?>" value="<?php echo $roommember->noBookingroommember ?>" class="form-control"></td>
                                  <td>
                                    <select id="nmBookingroommember" name="nmBookingroommember" class="form-control" onchange="handleSelectChange(this)">
                                      <?php 
                                        $getmember = array();
                                        $this->db->from('booking_room_member');
                                        $this->db->join('company', 'company.nmCompany=booking_room_member.idCompany');
                                        $this->db->join('company_member', 'company_member.idCompany=company.nmCompany');
                                        $this->db->where('booking_room_member.noBookingroommember', $roommember->noBookingroommember);
                                        $querygetmember = $this->db->get();
                                        if ($querygetmember->num_rows() > 0)
                                        {
                                          foreach ($querygetmember->result() as $row)
                                          {
                                            $getmember[] = $row;
                                          }
                                        }
                                        $querygetmember->free_result(); 
                                        $displayed_name_selected = array(); // Array to keep track of displayed invoices
                                        foreach($getmember as $rowmember) {
                                          if (!in_array($row->nmBookingroommember, $displayed_name_selected)) {
                                          // Add the invoice to the list of displayed invoices
                                          $displayed_name_selected[] = $row->nmBookingroommember;
                                            echo '<option selected value="'.$rowmember->noBookingroommember.'">'.$rowmember->nmBookingroommember.'</option>';
                                          }
                                        }
                                      ?>
                                      <option value="">Choose..</option>
                                      <?php 
                                        $member = array();
                                        $this->db->from('booking_cart');
                                        $this->db->join('company', 'company.nmCompany=booking_cart.companyBooking');
                                        $this->db->join('company_member', 'company_member.idCompany=company.nmCompany');
                                        $this->db->join('booking_room_member', 'booking_room_member.invoiceBooking=booking_cart.invoiceBooking', 'left');
                                        $this->db->where('booking_cart.invoiceBooking', $new_invoice_number);
                                        $query = $this->db->get();
                                        if ($query->num_rows() > 0)
                                        {
                                          foreach ($query->result() as $row)
                                          {
                                            $member[] = $row;
                                          }
                                        }
                                        $query->free_result(); 
                                      ?>
                                      <?php 
                                        $displayed_name = array(); // Array to keep track of displayed invoices
                                        foreach($member as $row) {
                                          if (!in_array($row->nmCompanymember, $displayed_name)) {
                                          // Add the invoice to the list of displayed invoices
                                          $displayed_name[] = $row->nmCompanymember;
                                      ?>
                                        <option id="selected<?php echo $row->nmCompanymember ?>" value="<?php echo $row->nmCompanymember ?>"><?php echo $row->nmCompanymember ?></option>
                                      <?php } } ?>
                                    </select>
                                  </td>
                                </tr>
                                <script type="text/javascript">
                                  function handleSelectChange(selectElement) {
                                    var selectedValue = selectElement.value;
                                    if (selectedValue) {
                                      var noBookingroommember = selectElement.parentElement.parentElement.querySelector('[name="noBookingroommember"]').value;
                                      insertMemberRoom(noBookingroommember, selectedValue);
                                    }
                                  }

                                  function insertMemberRoom(noBookingroommember, nmCompanymember) {
                                    console.log(noBookingroommember, nmCompanymember);
                                    $.ajax({
                                      type: "POST",
                                      url: '<?php echo base_url("cms/home/insertMemberRoom/") ?>',
                                      data: { nomor: noBookingroommember, member: nmCompanymember },
                                      success: function(response) {
                                        var result = JSON.parse(response);
                                      }
                                    });
                                  }
                                </script>
                                <?php } } ?>
                              </tbody>
                            </table>
                          </div>
                          <div class="modal-footer">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="meetingroom">Meeting Room
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input value="<?php echo $databookingcart->meetingroomBooking ?>" readonly type="text" id="meetingroom" name="meetingroomBooking" class="form-control" data-toggle="modal" data-target="#meetingroomModal">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="firstname">3. First Name *
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="text" id="firstname" value="<?php echo $databookingcart->firstnameBooking ?>" name="firstnameBooking" class="form-control" placeholder="Search name...." required>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="lastname">Last Name *
                  </label>
                  <div class="col-md-4 col-sm-4">
                    <input type="text" id="lastname" value="<?php echo $databookingcart->lastnameBooking ?>" name="lastnameBooking" class="form-control" placeholder="Search name...." required>
                  </div>
                  <label class="col-form-label col-md-2 col-sm-2 label-align" for="gender">Gender *
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <select id="gender" name="genderBooking" class="form-control" required>
                      <?php
                        if($databookingcart->genderBooking != NULL) {
                          echo '<option value="'.$databookingcart->genderBooking.'">'.$databookingcart->genderBooking.'</option>';
                        }
                      ?>
                      <option value>Choose..</option>
                      <option value="Mr">Mr</option>
                      <option value="Mrs">Mrs</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">ID Number *</label>
                  <div class="col-sm-9">
                    <div class="input-group">
                      <input type="text" id="idnumber" value="<?php echo $databookingcart->idnumberBooking ?>" name="idnumberBooking" class="form-control" required>
                      <span class="input-group-btn">
                        <div class="btn btn-warning" style="float: right;" onclick="checkIdNumber()">Check</div>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="birthday">Birthday *
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="date" id="birthday" value="<?php echo $databookingcart->birthdayBooking ?>" name="birthdayBooking" class="form-control" required>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email *
                  </label>
                  <div class="col-md-4 col-sm-4">
                    <input type="text" id="email" value="<?php echo $databookingcart->emailBooking ?>" name="emailBooking" class="form-control" required>
                  </div>
                  <label class="col-form-label col-md-2 col-sm-2 label-align" for="mobile">Mobile *
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <input type="text" id="mobile" value="<?php echo $databookingcart->mobileBooking ?>" name="mobileBooking" class="form-control" required>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="address">Address *
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <textarea type="text" id="address" value="<?php echo $databookingcart->addressBooking ?>" name="addressBooking" class="form-control" required><?php echo $databookingcart->addressBooking ?></textarea>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="autocomplete-custom-append">Company *
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="text" id="autocomplete-custom-append" name="companyBooking" class="form-control" value="<?php echo $databookingcart->companyBooking ?>" required>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="insideallotment">Inside Allotment
                  </label>
                  <div class="col-md-1 col-sm-1">
                    <input type="checkbox" id="insideallotment" value="<?php echo $databookingcart->insideallotmentBooking ?>" name="insideallotmentBooking">
                  </div>
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="individualbill">Individual Bill
                  </label>
                  <div class="col-md-1 col-sm-1">
                    <input type="checkbox" id="individualbill" value="<?php echo $databookingcart->individualbillBooking ?>" name="individualbillBooking">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="bookercode">Booker Code
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <input type="text" id="bookercode" value="<?php echo $databookingcart->bookercodeBooking ?>" name="bookercodeBooking" class="form-control">
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <input type="text" id="bookercode1" value="<?php echo $databookingcart->bookercode1Booking ?>" name="bookercode1Booking" class="form-control">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="bookercontact">4. Booker Contact
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <input type="text" id="bookercontact" value="<?php echo $databookingcart->bookercontactBooking ?>" name="bookercontactBooking" class="form-control" placeholder="Search contact....">
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <input type="text" id="bookercontact1" value="<?php echo $databookingcart->bookercontact1Booking ?>" name="bookercontact1Booking" class="form-control">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="bookeremail">Booker Email
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <input type="text" id="bookeremail" value="<?php echo $databookingcart->bookeremailBooking ?>" name="bookeremailBooking" class="form-control">
                  </div>
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="bookermobile">Mobile
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <input type="text" id="bookermobile" value="<?php echo $databookingcart->bookermobile1Booking ?>" name="bookermobile1Booking" class="form-control">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="pax">5. Pax
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <?php 
                      $totalpax = 0;
                      foreach ($bookingcart as $rowcart) {
                        $totalpax += $rowcart->paxBooking;
                      } 
                    ?>
                    <input type="number" id="pax" value="<?php echo $totalpax ?>" name="paxBooking" class="form-control" min="1" placeholder="1">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="child">Child
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="number" id="child" value="<?php echo $databookingcart->childBooking ?>" name="childBooking" class="form-control" placeholder="1">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="extrabed">Extra Bed
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="number" id="extrabed" value="<?php echo $databookingcart->extrabedBooking ?>" name="extrabedBooking" class="form-control" placeholder="0">
                  </div>
                  <script>
                    var previousExtrabedValue = 0;
                    document.getElementById('pax').addEventListener('input', function() {
                        var extrabedValue = parseInt(this.value, 10) || 0;
                        var newTotalrateValue = extrabedValue * 250000;

                        if (extrabedValue > previousExtrabedValue) {
                            document.getElementById('totalrate').value = parseInt(document.getElementById('totalrate').value, 10) + newTotalrateValue;
                        } else if (extrabedValue < previousExtrabedValue) {
                            document.getElementById('totalrate').value = parseInt(document.getElementById('totalrate').value, 10) - (previousExtrabedValue * 250000);
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
                      <?php
                        if($databookingcart->vipBooking != NULL) {
                          echo '<option value="'.$databookingcart->vipBooking.'">'.$databookingcart->vipBooking.'</option>';
                        }
                      ?>
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
                    <input type="time" id="arrivaltimeBooking" name="arrivaltimeBooking" class="form-control" value="14:00">
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
                    <input type="time" id="departuretimeBooking" name="departuretimeBooking" class="form-control" value="12:00">
                    <script>
                        // Get the current time in the format HH:MM
                        const currentTime = new Date().toLocaleTimeString('id-ID', {hour12: false});
                        
                        // Set the value of the time input to the current time
                        document.getElementById('departuretimeBooking').value = '12:00';
                    </script>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="payment">6. Payment *
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <select id="payment" name="paymentBooking" class="form-control" required>
                      <?php
                        if($databookingcart->paymentBooking != NULL) {
                          echo '<option value="'.$databookingcart->paymentBooking.'">'.$databookingcart->paymentBooking.'</option>';
                        }
                      ?>
                      <option value>Choose..</option>
                      <option value="BCAD">BCAD | BCA Debit Card</option>
                      <option value="BCAM">BCAM | BCA Master Card</option>
                      <option value="BCAP">BCAP | BCA DIP Card</option>
                      <option value="BCAV">BCAV | BCA Visa Card</option>
                      <option value="BT">BT | Bank Transfer BCA</option>
                      <option value="CASH">CASH | Cash</option>
                      <option value="CL">CL | City Ledger</option>
                      <option value="MAND">MAND | Mandiri Debit Card</option>
                      <option value="MANM">MANM | Mandiri Master Card</option>
                      <option value="MANV">MANV | Mandiri Visa Card</option>
                      <option value="NPG">NPG | CIMB Debit</option>
                      <option value="OVO">OVO | OVO Mandiri</option>
                    </select>
                  </div>
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="currency">Currency *
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <select id="currency" name="currencyBooking" class="form-control" required>
                      <?php
                        if($databookingcart->currencyBooking != NULL) {
                          echo '<option value="'.$databookingcart->currencyBooking.'">'.$databookingcart->currencyBooking.'</option>';
                        }
                      ?>
                      <option value>Choose..</option>
                      <option value="IDR">IDR</option>
                    </select>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="creditcardno">Credit Card No.
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="text" id="creditcardno" value="<?php echo $databookingcart->creditcardnoBooking ?>" name="creditcardnoBooking" class="form-control">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="validdatethru">Valid Date (Thru)
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <input type="text" id="validdatethru" value="<?php echo $databookingcart->validdatethruBooking ?>" name="validdatethruBooking" class="form-control">
                  </div>
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="creditlimit">Credit Limit
                  </label>
                  <div class="col-md-3 col-sm-3">
                    <input type="text" id="creditlimit" value="<?php echo $databookingcart->creditlimitBooking ?>" name="creditlimitBooking" class="form-control">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="voucherno">Voucher No.
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="text" id="voucherno" value="<?php echo $databookingcart->vouchernoBooking ?>" name="vouchernoBooking" class="form-control">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="salesperson">Sales Person
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <select id="salesperson" name="salespersonBooking" class="form-control">
                      <?php
                        if($databookingcart->salespersonBooking != NULL) {
                          echo '<option value="'.$databookingcart->salespersonBooking.'">'.$databookingcart->salespersonBooking.'</option>';
                        }
                      ?>
                      <option value>Choose..</option>
                      <option value="AMG">PT. AMG</option>
                      <option value="ECU">PT. ECU</option>
                      <option value="FO">Front Office</option>
                      <option value="RAKACON">RAKACON</option>
                      <option value="SALAM">PT. SALAM</option> 
                      <option value="SALAM1">HARY</option> 
                      <option value="SALAM2">RENDY</option>
                    </select>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="welcoming">Welcoming
                  </label>
                  <div class="col-md-9 col-sm-9">
                    <input type="text" id="welcoming" value="<?php echo $databookingcart->welcomingBooking ?>"  name="welcomingBooking" class="form-control">
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="ln_solid"></div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="segment">7. Segment
                </label>
                <div class="col-md-3 col-sm-3">
                  <select id="segment" name="segmentBooking" class="form-control">
                    <?php
                      if($databookingcart->segmentBooking != NULL) {
                        echo '<option value="'.$databookingcart->segmentBooking.'">'.$databookingcart->segmentBooking.'</option>';
                      }
                    ?>
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
                  <input type="text" id="autocomplete-custom-append-countries" name="nationalityBooking" value="<?php echo $databookingcart->nationalityBooking ?>" class="form-control">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="autocomplete-custom-append-originarea">Origin Area *
                </label>
                <div class="col-md-3 col-sm-3">
                  <input type="text" id="autocomplete-custom-append-originarea" name="originareaBooking" value="<?php echo $databookingcart->originareaBooking ?>" class="form-control">
                </div>
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="destination">Destination *
                </label>
                <div class="col-md-3 col-sm-3">
                  <select id="destination" name="destinationBooking" class="form-control" required>
                    <?php
                      if($databookingcart->destinationBooking != NULL) {
                        echo '<option value="'.$databookingcart->destinationBooking.'">'.$databookingcart->destinationBooking.'</option>';
                      }
                    ?>
                    <option value>Choose..</option>
                    <option value="BGR">BGR</option>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="flightarrive">Flight Arrive
                </label>
                <div class="col-md-3 col-sm-3">
                  <select id="flightarrive" name="flightarriveBooking" class="form-control">
                    <option value>Choose..</option>
                  </select>
                </div>
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="flightdepart">Flight Depart.
                </label>
                <div class="col-md-3 col-sm-3">
                  <select id="flightdepart" name="flightdepartBooking" class="form-control">
                    <option value>Choose..</option>
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
                  <textarea type="text" id="billinginstruction" value="<?php echo $databookingcart->billinginstructionBooking ?>" name="billinginstructionBooking" class="form-control" required rows="5"><?php echo $databookingcart->billinginstructionBooking ?></textarea>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="checkinremark">Check In Remark
                </label>
                <div class="col-md-9 col-sm-9">
                  <input type="text" id="checkinremark" value="<?php echo $databookingcart->checkinremarkBooking ?>" name="checkinremarkBooking" class="form-control">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="preference">Preference
                </label>
                <div class="col-md-9 col-sm-9">
                  <input type="text" id="preference" value="<?php echo $databookingcart->preferenceBooking ?>" name="preferenceBooking" class="form-control">
                </div>
              </div>
              <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <?php
                    if($databookingcart->statusBooking == 'Canceled') {
                  ?>
                    
                  <?php
                    } else {
                  ?>
                    <a href="<?php echo base_url('cms/home/viewBookingCartInvoice/'.$databookingcart->invoiceBooking.'/') ?>" class="btn btn-warning" type="reset">Invoice</a>
                    <input type="submit" class="btn btn-success" name="submit" value="Submit">
                  <?php } ?>
                </div>
              </div>
            </form>
          </div>
        </div>        
      </div>
    </div>
  </div>
</div>