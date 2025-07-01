        <!-- footer content -->
                <footer>
                  <div class="clearfix"></div>
                  <div hidden id="sumRoom"></div>
                  <div hidden id="bookingRoom"></div>
                  <div hidden id="levelRate"></div>
                  <div hidden id="availableRoom"></div>
                </footer>
                <div id="occupancy-level"></div>
                <!-- /footer content -->
              </div>
            </div>
            <?php 
              if($nopage == 15 || $nopage == 26 ||  $nopage == 38 ||  $nopage == 32) {
            ?>
              <!-- Membership Detail -->
              <div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="memberModalLabel">Membership</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <table id="datatable-buttons" class="table">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>ID Number</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $displayed_name = array();
                            $customer = array();
                            $this->db->from('Customer');
                            $query = $this->db->get();
                            if ($query->num_rows() > 0)
                            {
                              foreach ($query->result() as $row)
                              {
                                if (!in_array($row->IDNumber, $displayed_name)) {
                                  // Add the invoice to the list of displayed invoices
                                  $displayed_name[] = $row->IDNumber;
                                  $customer[] = $row;
                                }
                              }
                            }
                            $query->free_result(); 
                          ?>
                          <?php 
                            foreach($customer as $row) {
                          ?>
                          <tr>
                            <td><?php echo $row->FirstName.' '.$row->LastName ?></td>
                            <td><?php echo $row->addres ?></td>
                            <td><?php echo $row->gmail ?></td>
                            <td id="idnumber"><?php echo $row->IDNumber ?></td>
                            <td><div class="btn btn-success" style="float: right;" onclick="checkIdNumber(<?php echo $row->IDNumber ?>)">Pilih</div></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
                    </div>
                  </div>
                </div>
              </div>
              <script>
                document.getElementById('nmMembershipdetail').textContent = 'NONE';
                function checkIdNumber(idnumber) {
                  document.getElementById('firstname').value = 'mencari data...';
                  document.getElementById('lastname').value = 'mencari data...';
                  document.getElementById('email').value = 'mencari data...';
                  document.getElementById('birthday').value = 'mencari data...';
                  document.getElementById('mobile').value = 'mencari data...';
                  document.getElementById('address').value = 'mencari data...';
                  // Construct the URL using JavaScript
                  var url = '<?php echo base_url("cms/home/ajaxCustomer/") ?>' + idnumber + '/';
                  var xhr = new XMLHttpRequest();
                  xhr.open('POST', url, true);
                  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                  xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                      if (xhr.status === 200) {
                        // Handle the response here
                        var response = JSON.parse(xhr.responseText);
                        var FirstName = document.getElementById('firstname').value = response.FirstName;
                        document.getElementById('idnumber').value = response.idnumberBooking;
                        document.getElementById('lastname').value = response.LastName;
                        document.getElementById('email').value = response.gmail;
                        document.getElementById('birthday').value = response.Bday;
                        document.getElementById('mobile').value = response.notel;
                        document.getElementById('address').value = response.addres;
                        $.ajax({
                          type: "POST",
                          url: '<?php echo base_url("cms/home/ajaxVisitMember/") ?>',
                          data: { idnumberBooking: response.idnumberBooking },
                          success: function(responseVisit) {
                            document.getElementById('visitMembership').value = responseVisit;
                            console.log(responseVisit);
                            if(responseVisit >= 0 && responseVisit < 0) {
                              console.log('WOOD');
                              document.getElementById('nmMembershipdetail').textContent = 'WOOD';
                            } else if(responseVisit >= 1 && responseVisit <= 19) {
                              console.log('BRONZE');
                              document.getElementById('nmMembershipdetail').textContent = 'BRONZE';
                            } else if(responseVisit >= 20 && responseVisit <= 34) {
                              console.log('SILVER');
                              document.getElementById('nmMembershipdetail').textContent = 'SILVER';
                            } else if(responseVisit >= 35 && responseVisit <= 49) {
                              console.log('GOLD');
                              document.getElementById('nmMembershipdetail').textContent = 'GOLD';
                            } else if(responseVisit >= 50) {
                              console.log('PLATINUM');
                              document.getElementById('nmMembershipdetail').textContent = 'PLATINUM';
                            }
                          }
                        });
                      } else {
                        alert('Error: ' + xhr.status);
                      }
                    }
                  };
                  xhr.send();
                }
              </script>
              <!-- Modal Room Type -->
              <div class="modal fade" id="roomtypeModal" tabindex="-1" role="dialog" aria-labelledby="roomtypeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="roomtypeModalLabel">Room Type</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <table id="datatable-buttons" class="table">
                        <thead>
                          <tr>
                            <th>Type Kamar</th>
                            <th>Keterangan</th>
                            <th>Owner</th>
                            <th>Harga Kamar</th>
                            <th>Available Kamar</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $priceRate = 0;
                            $priceFixRate = 0;
                            $displayed_name = array();
                            foreach($kamar as $row) {
                              if (!in_array($row->ketKamar, $displayed_name)) {
                                // Add the invoice to the list of displayed invoices
                                $displayed_name[] = $row->ketKamar;
                                $allRooms = $sumRoom;
                                $booking = $bookingRoom;
                                $available = $availableRoom;
                                if ($allRooms >= 0) {
                                    $percentageInUse = ($booking / $allRooms) * 100;
                                } else {
                                    $percentageInUse = 0; // Handle the case where allRooms is 0 to avoid division by zero.
                                }
                                $levelRate = number_format($percentageInUse, 2) . "%";
                          ?>
                          <tr>
                            <td><?php echo $row->ketKamar ?></td>
                            <td><?php echo $row->ketKamar ?></td>
                            <td><?php echo $row->idBusiness ?></td>
                            <td>
                              <?php 
                                if($levelRate >= 0 && $levelRate < 40) {
                                  $priceRate = $row->hargaROKamar;
                                  echo number_format($priceRate);
                                } else if($levelRate > 41 && $levelRate < 60) {
                                  $upHarga = $rateGap->totalRategap;
                                  $priceRate = $row->hargaROKamar + $upHarga;
                                  echo number_format($priceRate);
                                } else if($levelRate > 61 && $levelRate < 70) {
                                  $upHarga = $rateGap->totalRategap2;
                                  $priceRate = $row->hargaROKamar + $upHarga;
                                  echo number_format($priceRate);
                                } else if($levelRate > 71 && $levelRate < 80) {
                                  $upHarga = $rateGap->totalRategap3;
                                  $priceRate = $row->hargaROKamar + $upHarga;
                                  echo number_format($priceRate);
                                } else if($levelRate > 81 && $levelRate < 90) {
                                  $upHarga = $rateGap->totalRategap4;
                                  $priceRate = $row->hargaROKamar + $upHarga;
                                  echo number_format($priceRate);
                                } else if($levelRate > 91 && $levelRate < 100) {
                                  $upHarga = $rateGap->totalRategap5;
                                  $priceRate = $row->hargaROKamar + $upHarga;
                                  echo number_format($priceRate);
                                }
                              ?>
                            </td>
                            <td><?php echo $row->qtyKamar ?></td>
                            <td>
                              <a id="idKamar" class="btn btn-primary" onclick="checkRoomType('<?php echo $row->ketKamar ?>', <?php echo $priceRate ?>)" data-dismiss="modal" aria-label="Close">Pilih</a>
                            </td>
                          </tr>
                          <?php } } ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
                    </div>
                  </div>
                </div>
              </div>
              <script>
                function checkRoomType(ketKamar, priceRate) {        
                  // var ketKamar = document.getElementById('ketKamar').value;
                  document.getElementById('roomtype').value = 'mencari data...';
                  $.ajax({
                    type: "POST",
                    url: '<?php echo base_url("cms/home/ajaxRoomType/") ?>',
                    data: { ketKamar: ketKamar },
                    success: function(resp) {
                      // Handle the response here
                      var response = JSON.parse(resp);
                      console.log("response", response);
                      localStorage.setItem('room', idKamar);
                      document.getElementById('roomtype').value = response.ketKamar;
                      document.getElementById('idkamar').value = idKamar;
                      document.getElementById('feautres').value = response.ketKamar;
                      var totalrate = priceRate;
                      var night = document.getElementById('night').value;
                      var formattedTotalHarga = totalrate; // This formats the number
                      document.getElementById('totalrate').value = formattedTotalHarga;
                      console.log(idKamar);
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
                        url: '<?php echo base_url("cms/home/ajaxNumberkamar/") ?>',
                        data: { arrival: getarrival, departure: getdeparture, ketKamar: ketKamar },
                        success: function(response) {
                          document.getElementById('text-loading-number').style.display = 'block';
                          var result = JSON.parse(response);
                          // Assuming 'datatable-buttons' is the ID of your table
                          var tableBody = document.querySelector(".roomready tbody");
                          // Clear any previous content
                          tableBody.innerHTML = '';
                          console.log('ajax-result', tableBody);
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
                          document.getElementById('text-loading-number').style.display = 'none';
                        }
                      });
                      var ratecodeInput = document.getElementById('ratecode');
                      ratecodeInput.setAttribute('data-toggle', 'modal');
                      ratecodeInput.setAttribute('data-target', '#ratecodeModal');
                      ratecodeInput.readOnly = false;
                      $.ajax({
                        type: "POST",
                        url: '<?php echo base_url("cms/home/ajaxRatecode/") ?>',
                        data: { ratecodeValue: getNumber, ketKamar:ketKamar },
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

                      var discountInput = document.getElementById('discount');
                      discountInput.readOnly = false;
                      function chooseNumber(number, idKamar) {
                        // Add your code to handle the chosen number here
                        console.log("Chosen Number:", number);
                        document.getElementById('numberroom').value = number;
                      }
                    }
                  });
                  localStorage.getItem('roomready');
                }
              </script>
              <!-- Modal Room Member Type -->
              <div class="modal fade" id="roomtypememberModal" tabindex="-1" role="dialog" aria-labelledby="roomtypememberModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="roomtypememberModalLabel">Room Type Member</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <table id="datatable-buttons" class="table memberready">
                        <thead>
                          <tr>
                            <th>Type Kamar</th>
                            <th>Keterangan</th>
                            <th>Owner</th>
                            <th>Harga Kamar</th>
                            <th>Available Kamar</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td id="memberKamar"></td>
                            <td id="memberKeterangan"></td>
                            <td id="memberOwner"></td>
                            <td id="memberHarga"></td>
                            <td id="memberAvailable"></td>
                            <td><button class="btn btn-primary" data-dismiss="modal" aria-label="Close"></button></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal Room Number -->
              <div class="modal fade" id="numberroomModal" tabindex="-1" role="dialog" aria-labelledby="numberroomModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="numberroomModalLabel">Modal Number</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <table id="datatable-buttons" class="table roomready">
                        <thead>
                          <tr>
                            <th>Nomor</th>
                            <th>Type</th>
                            <th>Features</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <div class="text-center" id="text-loading-number">
                            LOADING DATA...
                          </div>
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
                    </div>
                  </div>
                </div>
              </div>

              <!-- Modal Rate Code -->
              <div class="modal fade" id="ratecodeModal" tabindex="-1" role="dialog" aria-labelledby="ratecodeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="ratecodeModalLabel">Rate Code</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <table id="datatable-buttons" class="table ratecodelist">
                        <thead>
                          <tr>
                            <th>Rate Code</th>
                            <th>Begin</th>
                            <th>End</th>
                            <th>Extra Bed</th>
                            <th>Discount</th>
                            <th>RO</th>
                            <th>RB</th>
                          </tr>
                        </thead>
                        <tbody>
                          <td id="rateName"></td>
                          <td id="rateBegin"></td>
                          <td id="rateEnd"></td>
                          <td id="rateExtrabed"></td>
                          <td id="rateDiscount"></td>
                          <td id="rateRO"></td>
                          <td id="rateRB"></td>
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">

                    </div>
                  </div>
                </div>
              </div>
              <script>
                function checkRatecode(idRatecode) {
                  // var idRatecode = document.getElementById('idRatecode').value;
                  document.getElementById('ratecode').value = 'mencari data...';
                  // Construct the URL using JavaScript
                  var url = '<?php echo base_url("cms/home/ajaxRatecode/") ?>' + idRatecode + '/';
                  var xhr = new XMLHttpRequest();
                  xhr.open('POST', url, true);
                  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                  xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                      if (xhr.status === 200) {
                        // Handle the response here
                        var response = JSON.parse(xhr.responseText);
                        var ratecode = document.getElementById('ratecode').value = response.nmRatecode;
                        ratecode.readOnly = true;
                      } else {
                        alert('Error: ' + xhr.status);
                      }
                    }
                  };
                  xhr.send();
                }
              </script>
              <!-- Modal Company -->
              <div class="modal fade" id="companyModal" tabindex="-1" role="dialog" aria-labelledby="companyModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="companyModalLabel">Company</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Company *</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                            <input type="text" id="autocomplete-custom-append" autofocus name="companyBooking" class="form-control" value="<?php echo set_value('companyBooking'); ?>" required>
                            <span class="input-group-btn">
                              <div class="btn btn-warning" style="float: right;" onclick="checkCompany(document.getElementById('autocomplete-custom-append').value)">Check</div>
                            </span>
                          </div>
                        </div>
                        <label class="col-sm-3 col-form-label">Tier Company</label>
                        <div class="col-sm-9">
                          <div class="input-group" id="list-btn-tier">
                            <input type="button" disabled class="btn btn-danger" id="tipeNew" value="NEW">
                            <input type="button" disabled class="btn btn-primary" id="tipeDevelopment" value="DEVELOPMENT">
                            <input type="button" disabled class="btn btn-success" id="tipeRetention" value="RETENTION">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <table id="datatable-buttons" class="table">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Rate Code</th>
                            <th>Total Price</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody class="companydata"></tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <script>
                document.addEventListener('DOMContentLoaded', function() {
                  var buttons = document.querySelectorAll('#list-btn-tier input');
                  buttons.forEach(function(button) {
                    button.addEventListener('click', function() {
                      document.getElementById('member').value = this.value;
                      console.log('Selected value:', this.value);
                      var selectedValue = this.value;
                      var getNumber = localStorage.getItem('room');
                      $.ajax({
                        type: "POST",
                        url: '<?php echo base_url("cms/home/ajaxPaketMember/") ?>' + selectedValue + '/',
                        data: { member: selectedValue },
                        success: function(response) {
                          var result = JSON.parse(response);
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
                                    document.getElementById('idkamar').value = idKamar;
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
                        }
                      });
                    });
                  });
                });
                function checkCompany(company) {
                  document.getElementById('autocomplete-custom-append').value = 'mencari data...';
                  $.ajax({
                    type: "POST",
                    url: '<?php echo base_url("cms/home/ajaxCompany/") ?>',
                    data: { nmCompany: company },
                    success: function(response) {
                      var result = JSON.parse(response);
                      console.log(result);
                      if(result.length == 0) {
                        var tipeNew = document.getElementById('tipeNew');
                        tipeNew.disabled = false;
                      } else if(result.length > 0 && result.length < 5) {
                        var tipeDevelopment = document.getElementById('tipeDevelopment');
                        tipeDevelopment.disabled = false;
                      } else if(result.length > 5) {
                        var tipeRetention = document.getElementById('tipeRetention');
                        tipeRetention.disabled = false;
                      }
                      var nightInput = document.getElementById('roomtype');
                      nightInput.setAttribute('data-toggle', 'modal');
                      nightInput.setAttribute('data-target', '#roomtypeModal');
                      nightInput.readOnly = false;
                      // Clear any previous content
                      var tableBody = document.querySelector(".companydata");
                      document.getElementById('company').value = company;
                      document.getElementById('autocomplete-custom-append').value = company;
                      tableBody.innerHTML = '';
                      result.forEach(function(item) {
                        var tr = document.createElement('tr');
                        var companyBooking = document.createElement('td');
                        companyBooking.textContent = item.companyBooking;
                        companyBooking.style.textAlign = 'left';
                        var companyRatecode = document.createElement('td');
                        companyRatecode.textContent = item.ratecodeBooking;
                        companyRatecode.style.textAlign = 'left';
                        var companyTotalrate = document.createElement('td');
                        companyTotalrate.textContent = item.totalrateBooking;
                        companyTotalrate.style.textAlign = 'left';
                        var companyDatebooking = document.createElement('td');
                        companyDatebooking.textContent = item.createdAtBooking;
                        companyDatebooking.style.textAlign = 'left';
                        tr.appendChild(companyBooking);
                        tr.appendChild(companyRatecode);
                        tr.appendChild(companyTotalrate);
                        tr.appendChild(companyDatebooking);
                        tableBody.appendChild(tr);
                      });
                    }
                  });
                }
              </script>
            <?php } ?>
            <?php 
              if($nopage == 30 || $nopage == 32) {
            ?>
              <!-- Modal Room Meeting Type -->
              <div class="modal fade" id="roomtypemeetingModal" tabindex="-1" role="dialog" aria-labelledby="roomtypemeetingModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="roomtypemeetingModalLabel">Room Meeting <?php echo $nopage ?></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Type Kamar</th>
                            <th>Available</th>
                            <th>Harga Kamar</th>
                            <th>Night</th>
                            <th>Total Harga * Night</th>
                            <th>Room</th>
                            <th>Pax</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $priceRate = 0;
                          $priceFixRate = 0;
                          foreach($meeting as $row) {
                              $allRooms = $sumRoom;
                              $booking = $bookingRoom;
                              $available = $availableRoom;
                              if ($allRooms >= 0) {
                                  $percentageInUse = ($booking / $allRooms) * 100;
                              } else {
                                  $percentageInUse = 0; // Handle the case where allRooms is 0 to avoid division by zero.
                              }
                              $levelRate = number_format($percentageInUse, 2) . "%";
                          ?>
                          <form id="form-type-meeting<?php echo $row->idPaketmeeting ?>" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertFormTypeMeeting') ?>" class="form-horizontal form-label-left">
                            <input type="hidden" name="idBusiness" value="<?php echo $businessId->idBusiness ?>">
                            <input type="hidden" name="invoiceBooking" value="<?php echo $new_invoice_number ?>">
                            <input type="hidden" name="idKamar" value="<?php echo $row->idKamar ?>">
                            <input type="hidden" name="idType" value="<?php echo $row->idType ?>">
                            <input type="hidden" name="roomtypeBooking" value="<?php echo $row->nmPaketmeeting ?>" class="form-control">
                            <tr>
                              <td><?php echo $row->nmPaketmeeting ?></td>
                              <td><?php echo $row->qtyKamar ?></td>
                              <td><input type="numbers" readonly id="pricePaketmeeting<?php echo $row->idPaketmeeting ?>" name="pricePaketmeeting" value="<?php echo $row->pricePaketmeeting ?>" class="form-control"></td>
                              <td><input type="number" readonly id="longnight<?php echo $row->idPaketmeeting ?>" name="nightBooking" class="form-control" min="1" placeholder="1" required></td>
                              <td><input type="number" id="totalPriceMeeting<?php echo $row->idPaketmeeting ?>" class="form-control"></td>
                              <td><input type="number" max="<?php echo $row->qtyKamar ?>" id="roompaxtypeMeeting<?php echo $row->idPaketmeeting ?>" name="roompaxBooking" class="form-control" placeholder="0" oninput="updateRoompaxBooking(this, <?php echo $row->idPaketmeeting ?>)"></td>
                              <td><input type="number" max="<?php echo $row->qtyKamar ?>" id="paxtypeMeeting<?php echo $row->idPaketmeeting ?>" name="paxBooking" class="form-control" placeholder="0"></td>
                            </tr>
                          </form>
                          <script type="text/javascript">
                            function updateDeparture() {
                              const nightCount = parseInt(document.getElementById('night').value);
                              if (!isNaN(nightCount)) {
                                var totalPriceMeeting<?php echo $row->idPaketmeeting ?> = nightCount * document.getElementById('pricePaketmeeting<?php echo $row->idPaketmeeting ?>').value;
                                document.getElementById('totalPriceMeeting<?php echo $row->idPaketmeeting ?>').value = totalPriceMeeting<?php echo $row->idPaketmeeting ?>;
                                document.getElementById('longnight<?php echo $row->idPaketmeeting ?>').value = nightCount;
                              }
                            }
                            function updateRoompaxBooking(input, idPaketmeeting) {
                              if (parseInt(input.value) > parseInt(input.max)) {
                                input.value = input.max;
                              }
                              var roompaxtypeMeetingValue = parseInt(input.value);
                              var roompaxBookingElement = document.getElementById('paxtypeMeeting' + idPaketmeeting);
                              console.log(roompaxBookingElement)
                              // Update roompaxBooking value based on roompaxtypeMeeting value
                              roompaxBookingElement.value = roompaxtypeMeetingValue * 2;
                            }
                            // Attach event listeners to the arrival and night inputs
                            document.getElementById('night').addEventListener('input', updateDeparture);
                          </script>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-primary" id="submitForms" data-dismiss="modal" aria-label="Close">Simpan</button>
                    </div>
                  </div>
                  <script type="text/javascript">
                    function addGroupTypeMeeting() {
                      <?php foreach($meeting as $row) { ?>
                        let formData<?php echo $row->idPaketmeeting ?> = new FormData(document.getElementById('form-type-meeting<?php echo $row->idPaketmeeting ?>'));
                        sendDataToServer(formData<?php echo $row->idPaketmeeting ?>);
                        var getNumber = localStorage.getItem('room');
                        $.ajax({
                          type: "POST",
                          url: '<?php echo base_url("cms/home/ajaxAdditionalTypeMeeting/$new_invoice_number") ?>',
                          success: function(response) {
                            var result = JSON.parse(response);
                            // console.log(result);
                            localStorage.setItem('numberroom'+<?php echo $row->idPaketmeeting ?>, JSON.stringify(result));
                            var localnumber = localStorage.getItem('numberroom'+<?php echo $row->idPaketmeeting ?>);
                            var valuelocalnumber = JSON.parse(localnumber);
                            for(let i in valuelocalnumber) {
                              localStorage.setItem('roomready'+valuelocalnumber[i].nmNumber, valuelocalnumber[i].nmNumber);
                              var tableBody = document.querySelector(".roomready<?php echo $row->idPaketmeeting ?> tbody");
                              // window.location.href = '<?php echo base_url('cms/home/inputAdditionalBookingMeeting/'.$new_invoice_number.'/') ?>';
                              var additional = document.getElementById('additional');
                              additional.setAttribute('data-toggle', 'modal');
                              additional.setAttribute('data-target', '#additionalroomtypemeetingModal');
                              additional.readOnly = false;
                            }
                          }
                        });
                        function chooseNumber(number, idPaketmeeting) {
                          // Add your code to handle the chosen number here
                          console.log("Chosen Number:", number);
                          $.ajax({
                              type: "POST",
                              url: '<?php echo base_url("cms/home/ajaxRatecode/") ?>' + idPaketmeeting + '/',
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
                                      var tdrateRemark = document.createElement('td');
                                      tdrateRemark.textContent = ratecodeitem.remarkRatecode;
                                      var tdrateSegment = document.createElement('td');
                                      tdrateSegment.textContent = ratecodeitem.segmentRatecode;
                                      var ratecodetdAction = document.createElement('td');
                                      var ratecodeactionLink = document.createElement('button');
                                      ratecodeactionLink.href = '#'; // Add your link here
                                      ratecodeactionLink.textContent = 'Pilih';
                                      ratecodeactionLink.classList.add('btn', 'btn-primary'); // Add classes
                                      // Add data attributes
                                      ratecodeactionLink.dataset.dismiss = 'modal';
                                      ratecodeactionLink.setAttribute('aria-label', 'Close');
                                      ratecodeactionLink.onclick = function() {
                                        console.log("Chosen Rate Code:", ratecodeitem.nmRatecode);
                                        document.getElementById('ratecode').value = ratecodeitem.nmRatecode;
                                        if(ratecodeitem.nmRatecode != 'OTA RO') {
                                          var totalrate = ratecodeitem.totalbfHarga;
                                          var totalratenight = document.getElementById('totalrate').value;
                                          var percentageInUse = localStorage.getItem('percentageInUse');
                                          document.getElementById('RateNow').value = percentageInUse;
                                          if(percentageInUse >= 0 && percentageInUse < 40) {
                                            var formattedTotalHarga = parseInt(totalrate) + parseInt(totalratenight); // This formats the number
                                            document.getElementById('totalrate').value = formattedTotalHarga;
                                          } else if(percentageInUse > 41 && percentageInUse < 60) {
                                            var totalHargaRBRate = totalrate + rate_1;
                                            var formattedTotalHarga = parseInt(totalHargaRBRate) + parseInt(totalratenight); // This formats the number
                                            document.getElementById('totalrate').value = formattedTotalHarga;
                                          } else if(percentageInUse > 61 && percentageInUse < 70) {
                                            var totalHargaRBRate = totalrate + rate_2;
                                            var formattedTotalHarga = parseInt(totalHargaRBRate) + parseInt(totalratenight); // This formats the number
                                            document.getElementById('totalrate').value = formattedTotalHarga;
                                          } else if(percentageInUse > 71 && percentageInUse < 80) {
                                            var totalHargaRBRate = totalrate + rate_3;
                                            var formattedTotalHarga = parseInt(totalHargaRBRate) + parseInt(totalratenight); // This formats the number
                                            document.getElementById('totalrate').value = formattedTotalHarga;
                                          } else if(percentageInUse > 81 && percentageInUse < 90) {
                                            var totalHargaRBRate = totalrate + rate_4;
                                            var formattedTotalHarga = parseInt(totalHargaRBRate) + parseInt(totalratenight); // This formats the number
                                            document.getElementById('totalrate').value = formattedTotalHarga;
                                          } else if(percentageInUse > 91 && percentageInUse < 100) {
                                            var totalHargaRBRate = totalrate + rate_5;
                                            var formattedTotalHarga = parseInt(totalHargaRBRate) + parseInt(totalratenight); // This formats the number
                                            document.getElementById('totalrate').value = formattedTotalHarga;
                                          }
                                        } else {
                                          var totalrate = ratecodeitem.totalHarga;
                                          var totalratenight = document.getElementById('totalrate').value;
                                          var formattedTotalHarga = totalrate; // This formats the number
                                          var percentageInUse = localStorage.getItem('perzcentageInUse');
                                          document.getElementById('RateNow').value = percentageInUse;
                                          if(percentageInUse >= 0 && percentageInUse < 40) {
                                            var formattedTotalHarga = parseInt(totalrate) + parseInt(totalratenight); // This formats the number
                                            document.getElementById('totalrate').value = formattedTotalHarga;
                                          } else if(percentageInUse > 41 && percentageInUse < 60) {
                                            var totalHargaRate = totalrate + rate_1;
                                            var formattedTotalHarga = parseInt(totalHargaRate) + parseInt(totalratenight); // This formats the number
                                            document.getElementById('totalrate').value = formattedTotalHarga;
                                          } else if(percentageInUse > 61 && percentageInUse < 70) {
                                            var totalHargaRate = totalrate + rate_2;
                                            var formattedTotalHarga = parseInt(totalHargaRate) + parseInt(totalratenight); // This formats the number
                                            document.getElementById('totalrate').value = formattedTotalHarga;
                                          } else if(percentageInUse > 71 && percentageInUse < 80) {
                                            var totalHargaRate = totalrate + rate_3;
                                            var formattedTotalHarga = parseInt(totalHargaRate) + parseInt(totalratenight); // This formats the number
                                            document.getElementById('totalrate').value = formattedTotalHarga;
                                          } else if(percentageInUse > 81 && percentageInUse < 90) {
                                            var totalHargaRate = totalrate + rate_4;
                                            var formattedTotalHarga = parseInt(totalHargaRate) + parseInt(totalratenight); // This formats the number
                                            document.getElementById('totalrate').value = formattedTotalHarga;
                                          } else if(percentageInUse > 91 && percentageInUse < 100) {
                                            var totalHargaRate = totalrate + rate_5;
                                            var formattedTotalHarga = parseInt(totalHargaRate) + parseInt(totalratenight); // This formats the number
                                            document.getElementById('totalrate').value = formattedTotalHarga;
                                          }
                                        }
                                      };
                                      ratecodetdAction.appendChild(ratecodeactionLink);
                                      ratecodetr.appendChild(tdrateName);
                                      ratecodetr.appendChild(tdrateBegin);
                                      ratecodetr.appendChild(tdrateEnd);
                                      ratecodetr.appendChild(tdrateExtrabed);
                                      ratecodetr.appendChild(tdrateDiscount);
                                      ratecodetr.appendChild(tdrateRemark);
                                      ratecodetr.appendChild(tdrateSegment);
                                      ratecodetr.appendChild(ratecodetdAction);
                                      ratecodetableBody.appendChild(ratecodetr);
                                  });
                              }
                          });
                          console.log(number, idPaketmeeting);
                          var discountInput = document.getElementById('discount');
                          discountInput.readOnly = false;
                        }
                      <?php } ?>
                    }
                    function sendDataToServer(formData) {
                      // Use AJAX to send formData to your CodeIgniter controller
                      // Example using jQuery:
                      $.ajax({
                        url: '<?php echo base_url('cms/home/insertFormTypeMeeting/'.$new_invoice_number.'/') ?>',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                          AlertSuccess();
                        },
                        error: function(error) {
                          console.error('Error sending data:', error);
                        }
                      });
                    }

                    document.getElementById('submitForms').addEventListener('click', function() {
                      addGroupTypeMeeting();
                    });
                    function AlertSuccess() {
                      swal({
                        title: "Success",
                        text: "Blok Type telah ditambahkan",
                        type: "success",
                        confirmButtonText: "Close"
                      });
                    }
                  </script>
                </div>
              </div>
              <div class="modal fade" id="additionalroomtypemeetingModal" tabindex="-1" role="dialog" aria-labelledby="additionalroomtypemeetingModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="additionalroomtypemeetingModalLabel">Room Meeting <?php echo $nopage ?></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <table id="datatable-buttons" class="table">
                        <thead>
                          <tr>
                            <th>Type Kamar</th>
                            <th>Keterangan</th>
                            <th>Available</th>
                            <th>Harga Kamar</th>
                            <th>Room</th>
                            <th>Pax</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $priceRate = 0;
                            $priceFixRate = 0;
                            $displayed_name = array();
                            foreach($kamar as $row) {
                              if (!in_array($row->ketKamar, $displayed_name)) {
                                // Add the invoice to the list of displayed invoices
                                $displayed_name[] = $row->ketKamar;
                                $allRooms = $sumRoom;
                                $booking = $bookingRoom;
                                $available = $availableRoom;
                                if ($allRooms >= 0) {
                                    $percentageInUse = ($booking / $allRooms) * 100;
                                } else {
                                    $percentageInUse = 0; // Handle the case where allRooms is 0 to avoid division by zero.
                                }
                                $levelRate = number_format($percentageInUse, 2) . "%";
                          ?>
                          <form id="form-additional-type-meeting<?php echo $row->idKamar ?>" method="post" title="starter-plan<?php echo $row->idKamar ?>" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertFormTypeMeeting') ?>" class="form-horizontal form-label-left">
                            <input type="hidden" name="idBusiness" value="<?php echo $businessId->idBusiness ?>">
                            <input type="hidden" name="invoiceBooking" value="<?php echo $new_invoice_number ?>">
                            <input type="hidden" name="idKamar" value="<?php echo $row->idKamar ?>">
                            <tr>
                              <td><?php echo $row->ketKamar ?></td>
                              <td><?php echo $row->ketKamar ?></td>
                              <td><?php echo $row->qtyKamar ?></td>
                              <td>
                                <?php 
                                if($levelRate >= 0 && $levelRate < 40) {
                                    $priceRate = $row->hargaROKamar;
                                    // echo number_format($priceRate);
                                    echo '<input type="number" name="hargaROKamar" class="form-control" value="'.$priceRate.'">';
                                } else if($levelRate > 41 && $levelRate < 60) {
                                    $upHarga = $rateGap->totalRategap;
                                    $priceRate = $row->hargaROKamar + $upHarga;
                                    // echo number_format($priceRate);
                                    echo '<input type="number" name="hargaROKamar" class="form-control" value="'.$priceRate.'">';
                                } else if($levelRate > 61 && $levelRate < 70) {
                                    $upHarga = $rateGap->totalRategap2;
                                    $priceRate = $row->hargaROKamar + $upHarga;
                                    // echo number_format($priceRate);
                                    echo '<input type="number" name="hargaROKamar" class="form-control" value="'.$priceRate.'">';
                                } else if($levelRate > 71 && $levelRate < 80) {
                                    $upHarga = $rateGap->totalRategap3;
                                    $priceRate = $row->hargaROKamar + $upHarga;
                                    // echo number_format($priceRate);
                                    echo '<input type="number" name="hargaROKamar" class="form-control" value="'.$priceRate.'">';
                                } else if($levelRate > 81 && $levelRate < 90) {
                                    $upHarga = $rateGap->totalRategap4;
                                    $priceRate = $row->hargaROKamar + $upHarga;
                                    // echo number_format($priceRate);
                                    echo '<input type="number" name="hargaROKamar" class="form-control" value="'.$priceRate.'">';
                                } else if($levelRate > 91 && $levelRate < 100) {
                                    $upHarga = $rateGap->totalRategap5;
                                    $priceRate = $row->hargaROKamar + $upHarga;
                                    // echo number_format($priceRate);
                                    echo '<input type="number" name="hargaROKamar" class="form-control" value="'.$priceRate.'">';
                                }
                                ?>
                              </td>
                              <td><input type="number" max="<?php echo $row->qtyKamar ?>" id="roompaxtypeAdditionalMeeting<?php echo $row->idKamar ?>" name="roompaxBooking" class="form-control" placeholder="0" oninput="updateAdditionalRoompaxBooking(this, <?php echo $row->idKamar ?>)"></td>
                              <td><input type="number" max="<?php echo $row->qtyKamar ?>" id="paxtypeAdditionalMeeting<?php echo $row->idKamar ?>" name="paxBooking" class="form-control" placeholder="0"></td>
                              <td><input type="hidden" name="roomtypeBooking" value="<?php echo $row->ketKamar ?>" class="form-control"></td>
                              <td><input type="hidden" name="pricePaketmeeting" value="<?php echo $row->hargaROKamar ?>" class="form-control"></td>
                            </tr>
                          </form>
                          <?php } } ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-primary" id="submitAdditionalForms" data-dismiss="modal" aria-label="Close">Simpan</button>
                    </div>
                  </div>
                  <script type="text/javascript">
                    function updateAdditionalRoompaxBooking(input, idKamar) {
                      if (parseInt(input.value) > parseInt(input.max)) {
                        input.value = input.max;
                      }
                      var roompaxtypeAdditionalMeetingValue = parseInt(input.value);
                      var roompaxAdditionalBookingElement = document.getElementById('paxtypeAdditionalMeeting' + idKamar);
                      console.log(roompaxAdditionalBookingElement)
                      // Update roompaxBooking value based on roompaxtypeAdditionalMeeting value
                      roompaxAdditionalBookingElement.value = roompaxtypeAdditionalMeetingValue * 3;
                    }
                    document.getElementById('submitAdditionalForms').addEventListener('click', function() {
                      addAdditionalGroupTypeMeeting();
                    });
                    function addAdditionalGroupTypeMeeting() {
                      <?php 
                        $displayed_names = array();
                        foreach($kamar as $rows) {
                          if (!in_array($rows->ketKamar, $displayed_names)) {
                            // Add the invoice to the list of displayed invoices
                            $displayed_names[] = $rows->ketKamar; 
                      ?>
                      let formAdditionalData<?php echo $rows->idKamar ?> = new FormData(document.getElementById('form-additional-type-meeting<?php echo $rows->idKamar ?>'));
                      // Now you can use formData to send to the server
                      sendAdditionalDataToServer(formAdditionalData<?php echo $rows->idKamar ?>);
                      var getNumber = localStorage.getItem('room');
                      $.ajax({
                        type: "POST",
                        url: '<?php echo base_url("cms/home/ajaxAdditionalTypeMeeting/$new_invoice_number") ?>',
                        success: function(response) {
                          var result = JSON.parse(response);
                          // console.log(result);
                          localStorage.setItem('numberroom'+<?php echo $rows->idKamar ?>, JSON.stringify(result));
                          var localnumber = localStorage.getItem('numberroom'+<?php echo $rows->idKamar ?>);
                          var valuelocalnumber = JSON.parse(localnumber);
                          for(let i in valuelocalnumber) {
                            localStorage.setItem('roomready'+valuelocalnumber[i].nmNumber, valuelocalnumber[i].nmNumber);
                            var tableBody = document.querySelector(".roomready<?php echo $rows->idKamar ?> tbody");
                            // window.location.href = '<?php echo base_url('cms/home/inputAdditionalBookingMeeting/'.$new_invoice_number.'/') ?>';
                            var additional = document.getElementById('additional');
                            additional.setAttribute('data-toggle', 'modal');
                            additional.setAttribute('data-target', '#additionalroomtypemeetingModal');
                            additional.readOnly = false;
                          }
                        }
                      });
                      <?php } } ?>
                    }
                    function sendAdditionalDataToServer(formData) {
                      // Use AJAX to send formData to your CodeIgniter controller
                      // Example using jQuery:
                      $.ajax({
                        url: '<?php echo base_url('cms/home/insertFormTypeMeeting/'.$new_invoice_number.'/') ?>',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                          AlertAdditionalSuccess();
                        },
                        error: function(error) {
                          console.error('Error sending data:', error);
                        }
                      });
                    }
                    function AlertAdditionalSuccess() {
                      swal({
                        title: "Success",
                        text: "Blok Type telah ditambahkan",
                        type: "success",
                        confirmButtonText: "Close"
                      });
                    }
                  </script>
                </div>
              </div>
              <!-- Modal Name Meeting Room -->
              <div class="modal fade" id="meetingroomModal" tabindex="-1" role="dialog" aria-labelledby="meetingroomModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="meetingroomModalLabel">Room Type</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <table id="datatable-buttons" class="table">
                        <thead>
                          <tr>
                            <th>Nama Ruang Meeting</th>
                            <th>Kapasitas</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $priceRate = 0;
                            $priceFixRate = 0;
                            foreach($meetingroom as $row) {
                              $allRooms = $sumRoom;
                              $booking = $bookingRoom;
                              $available = $availableRoom;
                              if ($allRooms >= 0) {
                                  $percentageInUse = ($booking / $allRooms) * 100;
                              } else {
                                  $percentageInUse = 0; // Handle the case where allRooms is 0 to avoid division by zero.
                              }
                              $levelRate = number_format($percentageInUse, 2) . "%";
                          ?>
                          <tr>
                            <td><?php echo $row->nmMeeting ?></td>
                            <td><?php echo $row->capacityMeeting ?></td>
                            <td>
                              <a id="idMeeting" class="btn btn-primary" onclick="checkMeetingRoom(<?php echo $row->idMeeting ?>)" data-dismiss="modal" aria-label="Close">Pilih</a>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
                    </div>
                  </div>
                </div>
              </div>
              <script>
                function checkMeetingRoom(idMeeting) {
                  document.getElementById('meetingroom').value = 'mencari data...';
                  // Construct the URL using JavaScript
                  var url = '<?php echo base_url("cms/home/ajaxMeetingRoom/") ?>' + idMeeting + '/';
                  var xhr = new XMLHttpRequest();
                  xhr.open('POST', url, true);
                  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                  xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                      if (xhr.status === 200) {
                        // Handle the response here
                        var response = JSON.parse(xhr.responseText);
                        console.log("response", response);
                        localStorage.setItem('meetingroom', response.idMeeting);
                        document.getElementById('meetingroom').value = response.nmMeeting;
                        // Send an AJAX request to your PHP script
                      } else {
                        alert('Error: ' + xhr.status);
                      }
                    }
                  };
                  xhr.send();
                  localStorage.getItem('roomready');
                }
              </script>
            <?php } ?>
            <?php 
              if($nopage == 15 || $nopage == 26 ||  $nopage == 38 || $nopage == 32) {
            ?>
              <!-- Modal Upgrade To Type -->
              <div class="modal fade" id="upgradetoModal" tabindex="-1" role="dialog" aria-labelledby="upgradetoModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="upgradetoModalLabel">Room Type</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <table id="datatable-buttons" class="table">
                        <thead>
                          <tr>
                            <th>Type Kamar</th>
                            <th>Keterangan</th>
                            <th>Owner</th>
                            <th>Harga Kamar</th>
                            <th>Available Kamar</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $priceRate = 0;
                            $priceFixRate = 0;
                            $displayed_name = array();
                            foreach($kamar as $row) {
                              if (!in_array($row->ketKamar, $displayed_name)) {
                                // Add the invoice to the list of displayed invoices
                                $displayed_name[] = $row->ketKamar;
                                $allRooms = $sumRoom;
                                $booking = $bookingRoom;
                                $available = $availableRoom;
                                if ($allRooms >= 0) {
                                    $percentageInUse = ($booking / $allRooms) * 100;
                                } else {
                                    $percentageInUse = 0; // Handle the case where allRooms is 0 to avoid division by zero.
                                }
                                $levelRate = number_format($percentageInUse, 2) . "%";
                          ?>
                          <tr>
                            <td><?php echo $row->nmType ?></td>
                            <td><?php echo $row->ketKamar ?></td>
                            <td><?php echo $row->idBusiness ?></td>
                            <td>
                              <?php 
                                if($levelRate >= 0 && $levelRate < 40) {
                                  $priceRate = $row->totalHarga;
                                  echo number_format($priceRate);
                                } else if($levelRate > 41 && $levelRate < 60) {
                                  $upHarga = $rateGap->totalRategap;
                                  $priceRate = $row->totalHarga + $upHarga;
                                  echo number_format($priceRate);
                                } else if($levelRate > 61 && $levelRate < 70) {
                                  $upHarga = $rateGap->totalRategap2;
                                  $priceRate = $row->totalHarga + $upHarga;
                                  echo number_format($priceRate);
                                } else if($levelRate > 71 && $levelRate < 80) {
                                  $upHarga = $rateGap->totalRategap3;
                                  $priceRate = $row->totalHarga + $upHarga;
                                  echo number_format($priceRate);
                                } else if($levelRate > 81 && $levelRate < 90) {
                                  $upHarga = $rateGap->totalRategap4;
                                  $priceRate = $row->totalHarga + $upHarga;
                                  echo number_format($priceRate);
                                } else if($levelRate > 91 && $levelRate < 100) {
                                  $upHarga = $rateGap->totalRategap5;
                                  $priceRate = $row->totalHarga + $upHarga;
                                  echo number_format($priceRate);
                                }
                              ?>
                            </td>
                            <td><?php echo $row->qtyKamar ?></td>
                            <td>
                              <a id="idKamar" class="btn btn-primary" onclick="checkUpgradeTo(<?php echo $row->idKamar ?>, <?php echo $priceRate ?>)" data-dismiss="modal" aria-label="Close">Pilih</a>
                            </td>
                          </tr>
                          <?php } } ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
                    </div>
                  </div>
                </div>
              </div>
              <script>
                function checkUpgradeTo(idKamar, priceRate) {
                  var rategap = <?php echo json_encode($rateGap); ?>;
                  var rate_1 = rategap.totalRategap;
                  var rate_2 = rategap.totalRategap2;
                  var rate_3 = rategap.totalRategap3;
                  var rate_4 = rategap.totalRategap4;
                  var rate_5 = rategap.totalRategap5;
                  console.log(rate_1);
                  // var idKamar = document.getElementById('idKamar').value;
                  document.getElementById('updagradeto').value = 'mencari data...';
                  // Construct the URL using JavaScript
                  var url = '<?php echo base_url("cms/home/ajaxRoomType/") ?>' + idKamar + '/';
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
                        document.getElementById('updagradeto').value = response.nmType;
                        document.getElementById('idkamar').value = idKamar;
                        document.getElementById('feautres').value = response.ketKamar;
                        var totalrate = priceRate;
                        var night = document.getElementById('night').value;
                        var formattedTotalHarga = totalrate; // This formats the number
                        // document.getElementById('totalrate').value = formattedTotalHarga;
                        console.log(response.idType);
                        var numberroomInput = document.getElementById('numberroom');
                        numberroomInput.setAttribute('data-toggle', 'modal');
                        numberroomInput.setAttribute('data-target', '#numberroomupgradeModal');
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
                                var tableBody = document.querySelector(".upgradeready tbody");
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
                                      chooseNumberUpgrade(item.nmNumber, idKamar); // Assuming 'chooseNumber' function takes a parameter
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
                        function chooseNumberUpgrade(number, idKamar) {
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
                }
              </script>
              <!-- Modal Room Upgrade Number -->
              <div class="modal fade" id="numberroomupgradeModal" tabindex="-1" role="dialog" aria-labelledby="numberroomupgradeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="numberroomupgradeModalLabel">Modal Number Upgrade</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <table id="datatable-buttons" class="table upgradeready">
                        <thead>
                          <tr>
                              <th>Nomor Kamar</th>
                              <th>Type</th>
                              <th>Features</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td id="resNomor"></td>
                              <td id="resType"></td>
                              <td id="resKetKamar"></td>
                              <td id="resStatus"></td>
                              <td><button class="btn btn-primary" data-dismiss="modal" aria-label="Close"></button></td>
                            </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
            <!-- jQuery -->
            <script src="<?php echo base_url() ?>/vendors/jquery/dist/jquery.min.js"></script>
            <!-- Bootstrap -->
            <script src="<?php echo base_url() ?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
            <!-- FastClick -->
            <script src="<?php echo base_url() ?>/vendors/fastclick/lib/fastclick.js"></script>
            <!-- NProgress -->
            <script src="<?php echo base_url() ?>/vendors/nprogress/nprogress.js"></script>
            <!-- Chart.js -->
            <script src="<?php echo base_url() ?>/vendors/Chart.js/dist/Chart.min.js"></script>
            <!-- gauge.js -->
            <script src="<?php echo base_url() ?>/vendors/gauge.js/dist/gauge.min.js"></script>
            <!-- bootstrap-progressbar -->
            <script src="<?php echo base_url() ?>/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
            <!-- iCheck -->
            <script src="<?php echo base_url() ?>/vendors/iCheck/icheck.min.js"></script>
            <!-- Skycons -->
            <script src="<?php echo base_url() ?>/vendors/skycons/skycons.js"></script>
            <!-- Flot -->
            <script src="<?php echo base_url() ?>/vendors/Flot/jquery.flot.js"></script>
            <script src="<?php echo base_url() ?>/vendors/Flot/jquery.flot.pie.js"></script>
            <script src="<?php echo base_url() ?>/vendors/Flot/jquery.flot.time.js"></script>
            <script src="<?php echo base_url() ?>/vendors/Flot/jquery.flot.stack.js"></script>
            <script src="<?php echo base_url() ?>/vendors/Flot/jquery.flot.resize.js"></script>
            <!-- Flot plugins -->
            <script src="<?php echo base_url() ?>/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
            <script src="<?php echo base_url() ?>/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
            <script src="<?php echo base_url() ?>/vendors/flot.curvedlines/curvedLines.js"></script>
            <!-- DateJS -->
            <script src="<?php echo base_url() ?>/vendors/DateJS/build/date.js"></script>
            <!-- JQVMap -->
            <script src="<?php echo base_url() ?>/vendors/jqvmap/dist/jquery.vmap.js"></script>
            <script src="<?php echo base_url() ?>/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
            <script src="<?php echo base_url() ?>/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
            <!-- bootstrap-daterangepicker -->
            <script src="<?php echo base_url() ?>/vendors/moment/min/moment.min.js"></script>
            <script src="<?php echo base_url() ?>/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
            <!-- Custom Theme Scripts -->
            <script src="<?php echo base_url() ?>/build/js/custom.min.js"></script>

            <!-- Datatables -->
            <script src="<?php echo base_url() ?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="<?php echo base_url() ?>/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
            <script src="<?php echo base_url() ?>/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
            <script src="<?php echo base_url() ?>/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
            <script src="<?php echo base_url() ?>/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
            <script src="<?php echo base_url() ?>/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
            <script src="<?php echo base_url() ?>/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
            <script src="<?php echo base_url() ?>/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
            <script src="<?php echo base_url() ?>/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
            <!-- <script src="<?php echo base_url() ?>/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script> -->
            <!-- <script src="<?php echo base_url() ?>/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script> -->
            <script src="<?php echo base_url() ?>/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
            <script src="<?php echo base_url() ?>/vendors/jszip/dist/jszip.min.js"></script>
            <script src="<?php echo base_url() ?>/vendors/pdfmake/build/pdfmake.min.js"></script>
            <script src="<?php echo base_url() ?>/vendors/pdfmake/build/vfs_fonts.js"></script>
            <!-- Dropzone.js -->
            <script src="<?php echo base_url() ?>/vendors/dropzone/dist/min/dropzone.min.js"></script>
            <!-- Sweetalert -->
            <script src="<?php echo base_url() ?>assets/sweetalert/sweetalert.min.js" type="text/javascript"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js"></script>
            <script src="<?php echo base_url() ?>vendors/fullcalendar/dist/fullcalendar.min.js"></script>
            <script src="<?php echo base_url() ?>vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
            <script src="<?php echo base_url() ?>/vendors/pnotify/dist/pnotify.js"></script>
            <script src="<?php echo base_url() ?>/vendors/pnotify/dist/pnotify.buttons.js"></script>
            <script src="https://www.forkalim.or.id/assets/ckeditor/ckeditor.js"></script>
            <!-- DIAGRAM META PIXEL -->
            <script type="text/javascript">
              function init_flot_chart_meta_pixel_day() {
                if (typeof $.plot === 'undefined') {
                  return;
                }
                console.log('init_flot_chart_meta_pixel_day');
                var chart_plot_meta_pixel_data = [];
                var chart_plot_meta_pixel_settings = {
                  grid: {
                    show: true,
                    aboveData: true,
                    color: "#212121",
                    labelMargin: 10,
                    axisMargin: 0,
                    borderWidth: 0,
                    borderColor: null,
                    minBorderMargin: 5,
                    clickable: true,
                    hoverable: true,
                    autoHighlight: true,
                    mouseActiveRadius: 100
                  },
                  series: {
                    lines: {
                      show: true,
                      fill: true,
                      lineWidth: 1,
                      steps: false
                    },
                    points: {
                      show: true,
                      radius: 4.5,
                      symbol: "circle",
                      lineWidth: 3.0
                    }
                  },
                  legend: {
                    position: "ne",
                    margin: [0, -25],
                    noColumns: 0,
                    labelBoxBorderColor: null,
                    labelFormatter: function (label, series) {
                      return label + '&nbsp;&nbsp;';
                    },
                    width: 40,
                    height: 1
                  },
                  colors: ['#2c7282'],
                  shadowSize: 0,
                  tooltip: true,
                  tooltipOpts: {
                    content: "%s: %y.0",
                    xDateFormat: "%d/%m",
                    shifts: {
                      x: -30,
                      y: -50
                    },
                    defaultTheme: false
                  },
                  yaxis: {
                    min: 0,
                    max: 200
                  },
                  xaxis: {
                    mode: "time",
                    minTickSize: [1, "day"],
                    timeformat: "%d/%m/%y",
                    min: null, // We'll set this later after fetching data
                    max: null  // We'll set this later after fetching data
                  }
                };
                if ($("#chart_plot_meta_pixel").length) {
                    // Make an AJAX request to fetch data from CodeIgniter endpoint
                    $.ajax({
                        url: '<?php echo base_url('cms/home/ajaxMetPixel'); ?>',
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            if (data && data.length > 0) {
                                console.log('Data from server:', data);
                                var chart_plot_meta_pixel_data = [];
                                // Update chart with the retrieved data
                                for (var i = 0; i < data.length; i++) {
                                    // Ambil waktu dalam format timestamp
                                    var timestamp = new Date(data[i].start_time).getTime();
                                    // Tambahkan setiap count ke chart data
                                    for (var j = 0; j < data[i].data.length; j++) {
                                        var count = parseFloat(data[i].data[j].count);
                                        chart_plot_meta_pixel_data.push([timestamp, count]);
                                    }
                                }
                                var tableBody = $('#meta_pixel_table tbody');
                                tableBody.empty(); // Kosongkan tabel sebelum mengisinya
                                // Loop melalui data dan tambahkan baris ke tabel
                                for (var i = 0; i < data.length; i++) {
                                    console.log(data[i]);
                                    var count = data[i].data.length > 0 ? data[i].data[0].count : 0; // Mengambil count dari data[0]
                                    var row = '<tr>' +
                                        '<td>' + new Date(data[i].start_time).toLocaleString() + '</td>' +
                                        '<td>' + count + '</td>' +
                                        '</tr>';
                                    tableBody.append(row);
                                }
                                // Sort the data based on timestamp
                                chart_plot_meta_pixel_data.sort(function (a, b) {
                                    return a[0] - b[0];
                                });
                                // Set min and max values for x-axis
                                chart_plot_meta_pixel_settings.xaxis.min = chart_plot_meta_pixel_data[0][0];
                                chart_plot_meta_pixel_settings.xaxis.max = chart_plot_meta_pixel_data[chart_plot_meta_pixel_data.length - 1][0];
                                // Plot the chart
                                $.plot($("#chart_plot_meta_pixel"), [{
                                    label: "META PIXEL PAGE VIEW PER HOUR",
                                    data: chart_plot_meta_pixel_data,
                                    lines: {
                                        fillColor: "rgb(44, 114, 130, 0.12)"
                                    },
                                    points: {
                                        fillColor: "#fff"
                                    }
                                }], chart_plot_meta_pixel_settings);
                            } else {
                                console.warn('Empty or invalid data received from the server.');
                            }
                        },
                        error: function (error) {
                            console.error('Error fetching data:', error);
                        }
                    });
                }
                // Add tooltip functionality
                var previousPoint = null;
                $("#chart_plot_meta_pixel").bind("plothover", function (event, pos, item) {
                    if (item) {
                        if (previousPoint != item.dataIndex) {
                            previousPoint = item.dataIndex;
                            $("#flot-tooltip").remove();
                            // Ambil nilai x (timestamp) dan y (count)
                            var x = new Date(item.datapoint[0]).toLocaleString(); // Mengonversi timestamp ke string waktu yang lebih mudah dibaca
                            var y = item.datapoint[1].toFixed(2); // Nilai count
                            // Tampilkan tooltip dengan waktu dan count
                            showTooltip(item.pageX, item.pageY, x, y);
                        }
                    } else {
                        $("#flot-tooltip").remove();
                        previousPoint = null;
                    }
                });
                function showTooltip(x, y, startTime, count) {
                    $('<div id="flot-tooltip">Start Time: ' + startTime + '<br/>Count: ' + count + '</div>').css({
                        position: 'absolute',
                        display: 'none',
                        top: y - 40,
                        left: x - 30,
                        border: '1px solid #fdd',
                        padding: '2px',
                        'background-color': '#fee',
                        opacity: 0.80
                    }).appendTo("body").fadeIn(200);
                }
              }
              // Call init_flot_chart_meta_pixel_day every second
              // setInterval(init_flot_chart_meta_pixel_day, 600000);
              const chart_plot_meta_pixel_tab = document.getElementById('page-wiew-tab');
              chart_plot_meta_pixel_tab.addEventListener('click', function() {
                init_flot_chart_meta_pixel_day();
              })
              init_flot_chart_meta_pixel_day();
            </script>
            <!-- DIAGRAM META PIXEL -->
            <!-- DIAGRAM META PIXEL CART -->
            <script type="text/javascript">
              function init_flot_chart_meta_pixel_cart_day() {
                if (typeof $.plot === 'undefined') {
                  return;
                }
                console.log('init_flot_chart_meta_pixel_cart_day');
                var chart_plot_meta_pixel_cart_data = [];
                var chart_plot_meta_pixel_cart_settings = {
                  grid: {
                    show: true,
                    aboveData: true,
                    color: "#212121",
                    labelMargin: 10,
                    axisMargin: 0,
                    borderWidth: 0,
                    borderColor: null,
                    minBorderMargin: 5,
                    clickable: true,
                    hoverable: true,
                    autoHighlight: true,
                    mouseActiveRadius: 100
                  },
                  series: {
                    lines: {
                      show: true,
                      fill: true,
                      lineWidth: 1,
                      steps: false
                    },
                    points: {
                      show: true,
                      radius: 4.5,
                      symbol: "circle",
                      lineWidth: 3.0
                    }
                  },
                  legend: {
                    position: "ne",
                    margin: [0, -25],
                    noColumns: 0,
                    labelBoxBorderColor: null,
                    labelFormatter: function (label, series) {
                      return label + '&nbsp;&nbsp;';
                    },
                    width: 40,
                    height: 1
                  },
                  colors: ['#2c7282'],
                  shadowSize: 0,
                  tooltip: true,
                  tooltipOpts: {
                    content: "%s: %y.0",
                    xDateFormat: "%d/%m",
                    shifts: {
                      x: -30,
                      y: -50
                    },
                    defaultTheme: false
                  },
                  yaxis: {
                    min: 0,
                    max: 50
                  },
                  xaxis: {
                    mode: "time",
                    minTickSize: [1, "day"],
                    timeformat: "%d/%m/%y",
                    min: null, // We'll set this later after fetching data
                    max: null  // We'll set this later after fetching data
                  }
                };
                if ($("#chart_plot_meta_pixel_cart").length) {
                    // Make an AJAX request to fetch data from CodeIgniter endpoint
                    $.ajax({
                        url: '<?php echo base_url('cms/home/ajaxMetPixelCart'); ?>',
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            if (data && data.length > 0) {
                                console.log('Data from server:', data);
                                var chart_plot_meta_pixel_cart_data = [];
                                // Update chart with the retrieved data
                                for (var i = 0; i < data.length; i++) {
                                    // Ambil waktu dalam format timestamp
                                    var timestamp = new Date(data[i].start_time).getTime();
                                    // Tambahkan setiap count ke chart data
                                    for (var j = 0; j < data[i].data.length; j++) {
                                        var count = parseFloat(data[i].data[j].count);
                                        chart_plot_meta_pixel_cart_data.push([timestamp, count]);
                                    }
                                }
                                var tableBody = $('#meta_pixel_cart_table tbody');
                                tableBody.empty(); // Kosongkan tabel sebelum mengisinya
                                // Loop melalui data dan tambahkan baris ke tabel
                                for (var i = 0; i < data.length; i++) {
                                    console.log(data[i]);
                                    var count = data[i].data.length > 0 ? data[i].data[0].count : 0; // Mengambil count dari data[0]
                                    var row = '<tr>' +
                                        '<td>' + new Date(data[i].start_time).toLocaleString() + '</td>' +
                                        '<td>' + count + '</td>' +
                                        '</tr>';
                                    tableBody.append(row);
                                }
                                // Sort the data based on timestamp
                                chart_plot_meta_pixel_cart_data.sort(function (a, b) {
                                    return a[0] - b[0];
                                });
                                // Set min and max values for x-axis
                                chart_plot_meta_pixel_cart_settings.xaxis.min = chart_plot_meta_pixel_cart_data[0][0];
                                chart_plot_meta_pixel_cart_settings.xaxis.max = chart_plot_meta_pixel_cart_data[chart_plot_meta_pixel_cart_data.length - 1][0];
                                // Plot the chart
                                $.plot($("#chart_plot_meta_pixel_cart"), [{
                                    label: "META PIXEL CART PER HOUR",
                                    data: chart_plot_meta_pixel_cart_data,
                                    lines: {
                                        fillColor: "rgb(44, 114, 130, 0.12)"
                                    },
                                    points: {
                                        fillColor: "#fff"
                                    }
                                }], chart_plot_meta_pixel_cart_settings);
                            } else {
                                console.warn('Empty or invalid data received from the server.');
                            }
                        },
                        error: function (error) {
                            console.error('Error fetching data:', error);
                        }
                    });
                }
                // Add tooltip functionality
                var previousPoint = null;
                $("#chart_plot_meta_pixel_cart").bind("plothover", function (event, pos, item) {
                    if (item) {
                        if (previousPoint != item.dataIndex) {
                            previousPoint = item.dataIndex;
                            $("#flot-tooltip").remove();
                            // Ambil nilai x (timestamp) dan y (count)
                            var x = new Date(item.datapoint[0]).toLocaleString(); // Mengonversi timestamp ke string waktu yang lebih mudah dibaca
                            var y = item.datapoint[1].toFixed(2); // Nilai count
                            // Tampilkan tooltip dengan waktu dan count
                            showTooltip(item.pageX, item.pageY, x, y);
                        }
                    } else {
                        $("#flot-tooltip").remove();
                        previousPoint = null;
                    }
                });
                function showTooltip(x, y, startTime, count) {
                    $('<div id="flot-tooltip">Start Time: ' + startTime + '<br/>Count: ' + count + '</div>').css({
                        position: 'absolute',
                        display: 'none',
                        top: y - 40,
                        left: x - 30,
                        border: '1px solid #fdd',
                        padding: '2px',
                        'background-color': '#fee',
                        opacity: 0.80
                    }).appendTo("body").fadeIn(200);
                }
              }
              // Call init_flot_chart_meta_pixel_cart_day every second
              // setInterval(init_flot_chart_meta_pixel_cart_day, 600000);
              const chart_plot_meta_pixel_cart_tab = document.getElementById('add-to-cart-tab');
              chart_plot_meta_pixel_cart_tab.addEventListener('click', function() {
                init_flot_chart_meta_pixel_cart_day();
              })
            </script>
            <!-- DIAGRAM META PIXEL CART -->
            <!-- DIAGRAM META PIXEL purchase -->
            <script type="text/javascript">
              function init_flot_chart_meta_pixel_purchase_day() {
                if (typeof $.plot === 'undefined') {
                  return;
                }
                console.log('init_flot_chart_meta_pixel_purchase_day');
                var chart_plot_meta_pixel_purchase_data = [];
                var chart_plot_meta_pixel_purchase_settings = {
                  grid: {
                    show: true,
                    aboveData: true,
                    color: "#212121",
                    labelMargin: 10,
                    axisMargin: 0,
                    borderWidth: 0,
                    borderColor: null,
                    minBorderMargin: 5,
                    clickable: true,
                    hoverable: true,
                    autoHighlight: true,
                    mouseActiveRadius: 100
                  },
                  series: {
                    lines: {
                      show: true,
                      fill: true,
                      lineWidth: 1,
                      steps: false
                    },
                    points: {
                      show: true,
                      radius: 4.5,
                      symbol: "circle",
                      lineWidth: 3.0
                    }
                  },
                  legend: {
                    position: "ne",
                    margin: [0, -25],
                    noColumns: 0,
                    labelBoxBorderColor: null,
                    labelFormatter: function (label, series) {
                      return label + '&nbsp;&nbsp;';
                    },
                    width: 40,
                    height: 1
                  },
                  colors: ['#2c7282'],
                  shadowSize: 0,
                  tooltip: true,
                  tooltipOpts: {
                    content: "%s: %y.0",
                    xDateFormat: "%d/%m",
                    shifts: {
                      x: -30,
                      y: -50
                    },
                    defaultTheme: false
                  },
                  yaxis: {
                    min: 0,
                    max: 50
                  },
                  xaxis: {
                    mode: "time",
                    minTickSize: [1, "day"],
                    timeformat: "%d/%m/%y",
                    min: null, // We'll set this later after fetching data
                    max: null  // We'll set this later after fetching data
                  }
                };
                if ($("#chart_plot_meta_pixel_purchase").length) {
                    // Make an AJAX request to fetch data from CodeIgniter endpoint
                    $.ajax({
                        url: '<?php echo base_url('cms/home/ajaxMetPixelPurchase'); ?>',
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            if (data && data.length > 0) {
                                console.log('Data from server:', data);
                                var chart_plot_meta_pixel_purchase_data = [];
                                // Update chart with the retrieved data
                                for (var i = 0; i < data.length; i++) {
                                    // Ambil waktu dalam format timestamp
                                    var timestamp = new Date(data[i].start_time).getTime();
                                    // Tambahkan setiap count ke chart data
                                    for (var j = 0; j < data[i].data.length; j++) {
                                        var count = parseFloat(data[i].data[j].count);
                                        chart_plot_meta_pixel_purchase_data.push([timestamp, count]);
                                    }
                                }
                                var tableBody = $('#meta_pixel_purchase_table tbody');
                                tableBody.empty(); // Kosongkan tabel sebelum mengisinya
                                // Loop melalui data dan tambahkan baris ke tabel
                                for (var i = 0; i < data.length; i++) {
                                    console.log(data[i]);
                                    var count = data[i].data.length > 0 ? data[i].data[0].count : 0; // Mengambil count dari data[0]
                                    var row = '<tr>' +
                                        '<td>' + new Date(data[i].start_time).toLocaleString() + '</td>' +
                                        '<td>' + count + '</td>' +
                                        '</tr>';
                                    tableBody.append(row);
                                }
                                // Sort the data based on timestamp
                                chart_plot_meta_pixel_purchase_data.sort(function (a, b) {
                                    return a[0] - b[0];
                                });
                                // Set min and max values for x-axis
                                chart_plot_meta_pixel_purchase_settings.xaxis.min = chart_plot_meta_pixel_purchase_data[0][0];
                                chart_plot_meta_pixel_purchase_settings.xaxis.max = chart_plot_meta_pixel_purchase_data[chart_plot_meta_pixel_purchase_data.length - 1][0];
                                // Plot the chart
                                $.plot($("#chart_plot_meta_pixel_purchase"), [{
                                    label: "META PIXEL PURCHASE PER HOUR",
                                    data: chart_plot_meta_pixel_purchase_data,
                                    lines: {
                                        fillColor: "rgb(44, 114, 130, 0.12)"
                                    },
                                    points: {
                                        fillColor: "#fff"
                                    }
                                }], chart_plot_meta_pixel_purchase_settings);
                            } else {
                                console.warn('Empty or invalid data received from the server.');
                            }
                        },
                        error: function (error) {
                            console.error('Error fetching data:', error);
                        }
                    });
                }
                // Add tooltip functionality
                var previousPoint = null;
                $("#chart_plot_meta_pixel_purchase").bind("plothover", function (event, pos, item) {
                    if (item) {
                        if (previousPoint != item.dataIndex) {
                            previousPoint = item.dataIndex;
                            $("#flot-tooltip").remove();
                            // Ambil nilai x (timestamp) dan y (count)
                            var x = new Date(item.datapoint[0]).toLocaleString(); // Mengonversi timestamp ke string waktu yang lebih mudah dibaca
                            var y = item.datapoint[1].toFixed(2); // Nilai count
                            // Tampilkan tooltip dengan waktu dan count
                            showTooltip(item.pageX, item.pageY, x, y);
                        }
                    } else {
                        $("#flot-tooltip").remove();
                        previousPoint = null;
                    }
                });
                function showTooltip(x, y, startTime, count) {
                    $('<div id="flot-tooltip">Start Time: ' + startTime + '<br/>Count: ' + count + '</div>').css({
                        position: 'absolute',
                        display: 'none',
                        top: y - 40,
                        left: x - 30,
                        border: '1px solid #fdd',
                        padding: '2px',
                        'background-color': '#fee',
                        opacity: 0.80
                    }).appendTo("body").fadeIn(200);
                }
              }
              // Call init_flot_chart_meta_pixel_purchase_day every second
              // setInterval(init_flot_chart_meta_pixel_purchase_day, 600000);
              const chart_plot_meta_pixel_purchase_tab = document.getElementById('purchase-tab');
              chart_plot_meta_pixel_purchase_tab.addEventListener('click', function() {
                init_flot_chart_meta_pixel_purchase_day();
              })
            </script>
            <!-- DIAGRAM META PIXEL purchase -->
            <!--CK EDITOR-->
            <script>
              $(function () {
                CKEDITOR.replace(
                  'cktextarea',{ 
                    height: '400px',
                    filebrowserBrowseUrl : 'https://www.forkalim.or.id/assets/ckeditor/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                    filebrowserUploadUrl : 'https://www.forkalim.or.id/assets/ckeditor/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                    filebrowserImageBrowseUrl : 'https://www.forkalim.or.id/assets/ckeditor/filemanager/dialog.php?type=1&editor=ckeditor&fldr='
                  }
                );
              })
            </script>
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
                swal({
                  title: "Success",
                  text: "Berhasil",
                  type: "success",
                  confirmButtonText: null
                });
              </script>
            <?php } ?>
            <script type="text/javascript">
              /* AUTOCOMPLETE */
              function init_autocomplete() {
                if (typeof ($.fn.autocomplete) === 'undefined') { return; }
                console.log('init_autocomplete');
                var countries = {
                  <?php 
                    $company = array();
                    $this->db->from('company');
                    $this->db->where('idBusiness', $this->session->userdata('idBusiness'));
                    $query = $this->db->get();
                    if ($query->num_rows() > 0)
                    {
                      foreach ($query->result() as $row)
                      {
                        $company[] = $row;
                      }
                    }
                    $query->free_result(); 
                  ?>
                  <?php 
                    foreach($company as $row) {
                  ?>
                  <?php echo $row->idCompany ?>: "<?php echo $row->ketCompany ?>",
                  <?php } ?>
                };
                var countriesArray = $.map(countries, function (value, key) {
                    return {
                        value: value,
                        data: key
                    };
                });
                // initialize autocomplete with custom appendTo
                $('#autocomplete-custom-append').autocomplete({
                    lookup: countriesArray
                });
              };
              init_autocomplete();
            </script>
            <script type="text/javascript">
              /* AUTOCOMPLETE */
              function init_autocomplete_originarea() {
                if (typeof ($.fn.autocomplete) === 'undefined') { return; }
                console.log('init_autocomplete_originarea');
                var originarea = {
                  <?php 
                    $originarea = array();
                    $this->db->from('city');
                    $query = $this->db->get();
                    if ($query->num_rows() > 0)
                    {
                      foreach ($query->result() as $row)
                      {
                        $originarea[] = $row;
                      }
                    }
                    $query->free_result(); 
                  ?>
                  <?php 
                    foreach($originarea as $row) {
                  ?>
                  <?php echo $row->id ?>: "<?php echo $row->name ?>",
                  <?php } ?>
                };
                var originareaArray = $.map(originarea, function (value, key) {
                    return {
                        value: value,
                        data: key
                    };
                });
                // initialize autocomplete with custom appendTo
                $('#autocomplete-custom-append-originarea').autocomplete({
                    lookup: originareaArray
                });
              };
              init_autocomplete_originarea();
            </script>
            <script type="text/javascript">
              /* AUTOCOMPLETE */
              function init_autocomplete_countries() {
                if (typeof ($.fn.autocomplete) === 'undefined') { return; }
                console.log('init_autocomplete_countries');
                var countries = {
                  <?php 
                    $countries = array();
                    $this->db->from('countries');
                    $query = $this->db->get();
                    if ($query->num_rows() > 0)
                    {
                      foreach ($query->result() as $row)
                      {
                        $countries[] = $row;
                      }
                    }
                    $query->free_result(); 
                  ?>
                  <?php 
                    foreach($countries as $row) {
                  ?>
                  <?php echo $row->alpha_3_code ?>: "<?php echo $row->nationality ?>",
                  <?php } ?>
                };
                var countriesArray = $.map(countries, function (value, key) {
                    return {
                        value: value,
                        data: key
                    };
                });
                // initialize autocomplete with custom appendTo
                $('#autocomplete-custom-append-countries').autocomplete({
                    lookup: countriesArray
                });
              };
              init_autocomplete_countries();
            </script>
            <script type="text/javascript">
              /* AUTOCOMPLETE */
              function init_autocomplete_type_kamar() {
                if (typeof ($.fn.autocomplete) === 'undefined') { return; }
                console.log('init_autocomplete_type_kamar');
                var typeKamar = {
                  <?php 
                    $typeKamar = array();
                    $displayed_name = array();
                    $this->db->from('kamar_all');
                    $this->db->where('idBusiness', $this->session->userdata('idBusiness'));          
                    $query = $this->db->get();
                    if ($query->num_rows() > 0)
                    {
                      foreach ($query->result() as $row)
                      { 
                        if (!in_array($row->ketKamar, $displayed_name)) {
                          // Add the invoice to the list of displayed invoices
                          $displayed_name[] = $row->ketKamar;
                          $typeKamar[] = $row;
                        }
                      }
                    }
                    $query->free_result(); 
                  ?>
                  <?php 
                    foreach($typeKamar as $row) {
                  ?>
                  <?php echo $row->idKamar ?>: "<?php echo $row->ketKamar ?>",
                  <?php } ?>
                };
                var typeKamarArray = $.map(typeKamar, function (value, key) {
                    return {
                        value: value,
                        data: key
                    };
                });
                // initialize autocomplete with custom appendTo
                $('#autocomplete-custom-append-type-kamar').autocomplete({
                    lookup: typeKamarArray
                });
              };
              init_autocomplete_type_kamar();
            </script>
            <script type="text/javascript">
              /* AUTOCOMPLETE */
              function init_autocomplete_fnb() {
                if (typeof ($.fn.autocomplete) === 'undefined') { return; }
                console.log('init_autocomplete_fnb');
                var data = {
                  <?php 
                    $data = array();
                    $this->db->from('fnb_menu');
                    $query = $this->db->get();
                    if ($query->num_rows() > 0)
                    {
                      foreach ($query->result() as $row)
                      {
                        $data[] = $row;
                      }
                    }
                    $query->free_result();
                  ?>
                  <?php 
                    foreach($data as $row) {
                  ?>
                  <?php echo $row->idMenu ?>: "<?php echo $row->nmMenu ?>",
                  <?php } ?>
                };
                var dataArray = $.map(data, function (value, key) {
                    return {
                        value: value,
                        data: key
                    };
                });
                // initialize autocomplete with custom appendTo
                $('#autocomplete-custom-append-fnb').autocomplete({
                    lookup: dataArray
                });
              };
              init_autocomplete_fnb();
            </script>
            <script type="text/javascript">
              /* AUTOCOMPLETE */
              function init_autocomplete_booking() {
                if (typeof ($.fn.autocomplete) === 'undefined') { return; }
                console.log('init_autocomplete_booking');
                var data = {
                  <?php 
                    $data = array();
                    $date = date('Y-m-d');
                    $this->db->from('booking');
                    $this->db->where('statusBooking', 'Confirm');
                    $this->db->where('departureBooking >=', $date);
                    $this->db->order_by('idBooking', 'DESC');
                    $query = $this->db->get();
                    if ($query->num_rows() > 0)
                    {
                      foreach ($query->result() as $row)
                      {
                        $data[] = $row;
                      }
                    }
                    $query->free_result();
                  ?>
                  <?php 
                    foreach($data as $row) {
                  ?>
                  <?php echo $row->idBooking ?>: "<?php echo $row->numberroomBooking ?>",
                  <?php } ?>
                };
                var dataArray = $.map(data, function (value, key) {
                    return {
                        value: value,
                        data: key,
                    };
                });
                // initialize autocomplete with custom appendTo
                $('#autocomplete-custom-append-booking').autocomplete({
                    lookup: dataArray
                });
              };
              init_autocomplete_booking();
            </script>
            <?php
              if($this->session->userdata('dep') == '8' || $this->session->userdata('dep') == '3') {
            ?>
            <script type="text/javascript">
              /* CALENDAR */
              function  init_calendar() {
                if( typeof ($.fn.fullCalendar) === 'undefined'){ return; }
                console.log('init_calendar');
                function formatDate(date) {
                  var year = date.getFullYear();
                  var month = ('0' + (date.getMonth() + 1)).slice(-2);
                  var day = ('0' + date.getDate()).slice(-2);
                  return year + '-' + month + '-' + day;
                }

                var date = new Date(),
                  d = date.getDate(),
                  m = date.getMonth(),
                  y = date.getFullYear(),
                  started,
                  categoryClass;
                var datesArray = [
                  <?php
                  foreach ($alltype as $row) {
                    $startDate = new DateTime($row->dateKamar); // Use the date from the database
                    // Generate a unique ID for the modal
                    $modal_id = 'modal_' . strtolower(str_replace(' ', '_', $row->ketKamar));
                    ?>
                    {
                      title: '<?php echo $row->ketKamar ?>',
                      start: new Date('<?php echo $startDate->format('Y-m-d'); ?>'),
                      end: new Date('<?php echo $startDate->format('Y-m-d'); ?>'),
                      ketKamar: <?php echo json_encode($row->ketKamar) ?>,
                      modalID: '<?php echo $modal_id ?>',
                      idBusiness: <?php echo $row->idBusiness ?>,
                      idKamar: <?php echo $row->idKamar ?>,
                      qtyKamar: <?php echo $row->qtyKamar ?>,
                      soldKamar: <?php echo $row->soldKamar ?>,
                    },
                    <?php
                  }
                  ?>
                ];
                var events = datesArray.map(function(dateObj) {
                return {
                  title: dateObj.title + ' ' + dateObj.qtyKamar,
                  start: new Date(dateObj.start),
                  end: new Date(dateObj.end),
                  ketKamar: dateObj.ketKamar,
                  modalID: dateObj.modalID,
                  idBusiness: dateObj.idBusiness,
                  idKamar: dateObj.idKamar,
                  qtyKamar: dateObj.qtyKamar,
                  soldKamar: dateObj.soldKamar,
                  allDay: true
                  };
                });
                var calendar = $('#calendar-fo').fullCalendar({
                  header: {
                  left: 'prev,next today',
                  center: 'title',
                  right: 'month,agendaWeek,agendaDay,listMonth'
                  },
                  selectable: true,
                  selectHelper: true,
                  select: function(start, end, allDay) {
                  $('#fc_create').click();
                  started = start;
                  ended = end;
                  $(".antosubmit").on("click", function() {
                    var title = $("#title").val();
                    if (end) {
                    ended = end;
                    }
                    categoryClass = $("#event_type").val();
                    if (title) {
                    calendar.fullCalendar('renderEvent', {
                      title: title,
                      start: started,
                      end: end,
                      allDay: allDay
                      },
                      true // make the event "stick"
                    );
                    }
                    $('#title').val('');
                    calendar.fullCalendar('unselect');
                    $('.antoclose').click();
                    return false;
                  });
                  },
                  eventClick: function(calEvent, jsEvent, view) {
                    var modalID = document.getElementById('fc_edit');
                    modalID.setAttribute('data-toggle', 'modal');
                    modalID.setAttribute('data-target', '#'+calEvent.modalID);
                    modalID.click();
                    $('#start'+calEvent.modalID).text(calEvent.modalID);

                    // Format and log date
                    var formattedDate = formatDate(new Date(calEvent.start));
                    console.log(formattedDate);
                    // Display formatted date in modal
                    $('#formattedDateDisplay'+calEvent.modalID).text(formattedDate);
                    $.ajax({
                      type: "POST",
                      url: "<?php echo base_url('cms/home/ajaxInventoryRoom/') ?>"+calEvent.idBusiness, // Replace with the actual path to your PHP script
                      data: { formattedDate: formattedDate },
                      success: function(response) {
                        // Parse the JSON response
                        var responseData = JSON.parse(response);
                        // Asumsi data dari tabel meeting_room dan booking_cart
                        var kamar = [
                          <?php 
                            $kamar = array();
                            $this->db->from('Business_Detail');
                            $this->db->join('kamar', 'kamar.idBusiness=Business_Detail.idBusiness');
                            $this->db->where('kamar.idBusiness', $this->session->userdata('idBusiness'));
                            $query = $this->db->get();
                            if ($query->num_rows() > 0)
                            {
                              foreach ($query->result() as $row)
                              {
                                $kamar[] = $row;
                              }
                            }
                            $query->free_result(); 
                          ?>
                          <?php 
                            foreach($kamar as $row) {
                          ?>
                            { ketKamar: '<?php echo $row->ketKamar ?>', qtyKamar: '<?php echo $row->qtyKamar ?>', idKamar: '<?php echo $row->idKamar ?>', soldKamar: '<?php echo $row->soldKamar ?>', onhandKamar: '<?php echo $row->onhandKamar ?>' },
                          <?php } ?>
                        ];
                        // Asumsi data dari tabel kamar dan booking_cart
                        var bookingData = [
                          <?php 
                            $databooking = array();
                            $this->db->from('Business_Detail');
                            $this->db->join('booking', 'booking.idBusiness=Business_Detail.idBusiness');
                            $this->db->where('booking.idBusiness', $this->session->userdata('idBusiness'));
                            $query = $this->db->get();
                            if ($query->num_rows() > 0)
                            {
                              foreach ($query->result() as $row)
                              {
                                $databooking[] = $row;
                              }
                            }
                            $query->free_result(); 
                          ?>
                          <?php 
                            foreach($databooking as $row) {
                          ?>
                          { roompaxBooking: '<?php echo $row->roompaxBooking ?>', arrivalBooking: '<?php echo $row->arrivalBooking ?>', departureBooking: '<?php echo $row->departureBooking ?>', roomtypeBooking: '<?php echo $row->roomtypeBooking ?>' },
                          <?php } ?>
                        ];
                        // Fungsi untuk menghitung total kapasitas yang tersedia
                        function calculateAvailableCapacity(arrivalDate, kamar, bookingData, roomtypeBooking) {
                          var totalCapacity = 0;
                          // Filter data berdasarkan tanggal kedatangan dan ketKamar
                          var filteredData = bookingData.filter(function(booking) {
                            return booking.arrivalBooking === arrivalDate && booking.roomtypeBooking === roomtypeBooking;
                          });
                          // Jika tidak ada pemesanan untuk ruangan ini, tambahkan kapasitas ruangan ke total
                          if (filteredData.length === 0) {
                            var kamar_data = kamar.find(function(room) {
                              return room.ketKamar === roomtypeBooking;
                            });
                            if (kamar_data) {
                              totalCapacity += kamar_data.onhandKamar;
                            }
                          } else {
                            // Jika ada pemesanan, hitung kapasitas yang tersedia seperti sebelumnya
                            filteredData.forEach(function(booking) {
                              var kamar_data = kamar.find(function(room) {
                                return room.ketKamar === booking.roomtypeBooking;
                              });
                              if (kamar_data) {
                                totalCapacity += kamar_data.onhandKamar - kamar_data.soldKamar;
                              }
                            });
                          }
                          return totalCapacity;
                        }
                        kamar.forEach(function(room) {
                          var availableCapacity = calculateAvailableCapacity(formattedDate, kamar, bookingData, room.ketKamar);
                          // Pastikan room memiliki properti idKamar
                          if (room.hasOwnProperty('idKamar')) {
                            console.log("Kapasitas tersedia untuk " + room.ketKamar + " (" + room.idKamar + ") adalah: " + (+availableCapacity));
                          } else {
                            console.log("Kapasitas tersedia untuk " + room.ketKamar + " adalah: " + (+availableCapacity));
                          }
                          var booking = bookingData.find(function(booking) {
                            return booking.roomtypeBooking === room.ketKamar && booking.arrivalBooking === formattedDate;
                          });
                          var roompaxBooking = booking ? booking.roompaxBooking : 0;
                          $('#ketKamar_' + calEvent.modalID + '_' + room.idKamar).text(room.ketKamar);
                          $('#capacityMeeting_' + calEvent.modalID + '_' + room.idKamar).text(+availableCapacity);
                          $('#soldKamar_' + calEvent.modalID + '_' + room.idKamar).text(+room.soldKamar);
                          $('#paxBooking_' + calEvent.modalID + '_' + room.idKamar).text(+roompaxBooking);
                        });
                      }
                    });
                    categoryClass = $("#event_type").val();
                    $(".antosubmit2").on("click", function() {
                      calEvent.title = $("#start").val();
                      calendar.fullCalendar('updateEvent', calEvent);
                      $('.antoclose2').click();
                    });
                    calendar.fullCalendar('unselect');
                  },
                  editable: true,
                  events: events
                });
              };
              init_calendar();
            </script>
            <?php } ?>
            <?php 
              if($this->session->userdata('level') == '1') {
            ?>
            <script type="text/javascript">
              function  init_calendar_owner() {
                if( typeof ($.fn.fullCalendar) === 'undefined'){ return; }
                console.log('init_calendar_owner');
                function formatDate(date) {
                  var year = date.getFullYear();
                  var month = ('0' + (date.getMonth() + 1)).slice(-2);
                  var day = ('0' + date.getDate()).slice(-2);
                  return year + '-' + month + '-' + day;
                }

                var date = new Date(),
                  d = date.getDate(),
                  m = date.getMonth(),
                  y = date.getFullYear(),
                  started,
                  categoryClass;
                var datesArray = [
                  <?php
                  foreach ($alltype as $row) {
                    $startDate = new DateTime($row->dateKamar); // Use the date from the database
                    // Generate a unique ID for the modal
                    $modal_id = 'modal_' . strtolower(str_replace(' ', '_', $row->ketKamar));
                    ?>
                    {
                      title: '<?php echo $row->ketKamar ?>',
                      start: new Date('<?php echo $startDate->format('Y-m-d'); ?>'),
                      end: new Date('<?php echo $startDate->format('Y-m-d'); ?>'),
                      ketKamar: <?php echo json_encode($row->ketKamar) ?>,
                      modalID: '<?php echo $modal_id ?>',
                      idBusiness: <?php echo $row->idBusiness ?>,
                      idKamar: <?php echo $row->idKamar ?>,
                      qtyKamar: <?php echo $row->qtyKamar ?>,
                      soldKamar: <?php echo $row->soldKamar ?>,
                    },
                    <?php
                  }
                  ?>
                ];
                var events = datesArray.map(function(dateObj) {
                return {
                  title: dateObj.title + ' ' + dateObj.qtyKamar,
                  start: new Date(dateObj.start),
                  end: new Date(dateObj.end),
                  ketKamar: dateObj.ketKamar,
                  modalID: dateObj.modalID,
                  idBusiness: dateObj.idBusiness,
                  idKamar: dateObj.idKamar,
                  qtyKamar: dateObj.qtyKamar,
                  soldKamar: dateObj.soldKamar,
                  allDay: true
                  };
                });
                var calendar = $('#calendar-fo-owner').fullCalendar({
                  header: {
                  left: 'prev,next today',
                  center: 'title',
                  right: 'month,agendaWeek,agendaDay,listMonth'
                  },
                  selectable: true,
                  selectHelper: true,
                  select: function(start, end, allDay) {
                  $('#fc_create').click();
                  started = start;
                  ended = end;
                  $(".antosubmit").on("click", function() {
                    var title = $("#title").val();
                    if (end) {
                    ended = end;
                    }
                    categoryClass = $("#event_type").val();
                    if (title) {
                    calendar.fullCalendar('renderEvent', {
                      title: title,
                      start: started,
                      end: end,
                      allDay: allDay
                      },
                      true // make the event "stick"
                    );
                    }
                    $('#title').val('');
                    calendar.fullCalendar('unselect');
                    $('.antoclose').click();
                    return false;
                  });
                  },
                  eventClick: function(calEvent, jsEvent, view) {
                    var modalID = document.getElementById('fc_edit');
                    modalID.setAttribute('data-toggle', 'modal');
                    modalID.setAttribute('data-target', '#'+calEvent.modalID);
                    modalID.click();
                    $('#start'+calEvent.modalID).text(calEvent.modalID);

                    // Format and log date
                    var formattedDate = formatDate(new Date(calEvent.start));
                    console.log(formattedDate);
                    // Display formatted date in modal
                    $('#formattedDateDisplay'+calEvent.modalID).text(formattedDate);
                    $.ajax({
                      type: "POST",
                      url: "<?php echo base_url('cms/home/ajaxInventoryRoom/') ?>"+calEvent.idBusiness, // Replace with the actual path to your PHP script
                      data: { formattedDate: formattedDate },
                      success: function(response) {
                        // Parse the JSON response
                        var responseData = JSON.parse(response);
                        // Asumsi data dari tabel meeting_room dan booking_cart
                        var kamar = [
                          <?php 
                            $kamar = array();
                            $this->db->from('Business_Detail');
                            $this->db->join('kamar', 'kamar.idBusiness=Business_Detail.idBusiness');
                            $this->db->where('kamar.idBusiness', $this->session->userdata('idBusiness'));
                            $query = $this->db->get();
                            if ($query->num_rows() > 0)
                            {
                              foreach ($query->result() as $row)
                              {
                                $kamar[] = $row;
                              }
                            }
                            $query->free_result(); 
                          ?>
                          <?php 
                            foreach($kamar as $row) {
                          ?>
                            { ketKamar: '<?php echo $row->ketKamar ?>', qtyKamar: '<?php echo $row->qtyKamar ?>', idKamar: '<?php echo $row->idKamar ?>', soldKamar: '<?php echo $row->soldKamar ?>', onhandKamar: '<?php echo $row->onhandKamar ?>' },
                          <?php } ?>
                        ];
                        // Asumsi data dari tabel kamar dan booking_cart
                        var bookingData = [
                          <?php 
                            $databooking = array();
                            $this->db->from('Business_Detail');
                            $this->db->join('booking', 'booking.idBusiness=Business_Detail.idBusiness');
                            $this->db->where('booking.idBusiness', $this->session->userdata('idBusiness'));
                            $query = $this->db->get();
                            if ($query->num_rows() > 0)
                            {
                              foreach ($query->result() as $row)
                              {
                                $databooking[] = $row;
                              }
                            }
                            $query->free_result(); 
                          ?>
                          <?php 
                            foreach($databooking as $row) {
                          ?>
                          { roompaxBooking: '<?php echo $row->roompaxBooking ?>', arrivalBooking: '<?php echo $row->arrivalBooking ?>', departureBooking: '<?php echo $row->departureBooking ?>', roomtypeBooking: '<?php echo $row->roomtypeBooking ?>' },
                          <?php } ?>
                        ];
                        // Fungsi untuk menghitung total kapasitas yang tersedia
                        function calculateAvailableCapacity(arrivalDate, kamar, bookingData, roomtypeBooking) {
                          var totalCapacity = 0;
                          // Filter data berdasarkan tanggal kedatangan dan ketKamar
                          var filteredData = bookingData.filter(function(booking) {
                            return booking.arrivalBooking === arrivalDate && booking.roomtypeBooking === roomtypeBooking;
                          });
                          // Jika tidak ada pemesanan untuk ruangan ini, tambahkan kapasitas ruangan ke total
                          if (filteredData.length === 0) {
                            var kamar_data = kamar.find(function(room) {
                              return room.ketKamar === roomtypeBooking;
                            });
                            if (kamar_data) {
                              totalCapacity += kamar_data.onhandKamar;
                            }
                          } else {
                            // Jika ada pemesanan, hitung kapasitas yang tersedia seperti sebelumnya
                            filteredData.forEach(function(booking) {
                              var kamar_data = kamar.find(function(room) {
                                return room.ketKamar === booking.roomtypeBooking;
                              });
                              if (kamar_data) {
                                totalCapacity += kamar_data.onhandKamar - kamar_data.soldKamar;
                              }
                            });
                          }
                          return totalCapacity;
                        }
                        kamar.forEach(function(room) {
                          var availableCapacity = calculateAvailableCapacity(formattedDate, kamar, bookingData, room.ketKamar);
                          // Pastikan room memiliki properti idKamar
                          if (room.hasOwnProperty('idKamar')) {
                            console.log("Kapasitas tersedia untuk " + room.ketKamar + " (" + room.idKamar + ") adalah: " + (+availableCapacity));
                          } else {
                            console.log("Kapasitas tersedia untuk " + room.ketKamar + " adalah: " + (+availableCapacity));
                          }
                          var booking = bookingData.find(function(booking) {
                            return booking.roomtypeBooking === room.ketKamar && booking.arrivalBooking === formattedDate;
                          });
                          var roompaxBooking = booking ? booking.roompaxBooking : 0;
                          $('#ketKamar_' + calEvent.modalID + '_' + room.idKamar).text(room.ketKamar);
                          $('#capacityMeeting_' + calEvent.modalID + '_' + room.idKamar).text(+availableCapacity);
                          $('#soldKamar_' + calEvent.modalID + '_' + room.idKamar).text(+room.soldKamar);
                          $('#paxBooking_' + calEvent.modalID + '_' + room.idKamar).text(+roompaxBooking);
                        });
                      }
                    });
                    categoryClass = $("#event_type").val();
                    $(".antosubmit2").on("click", function() {
                      calEvent.title = $("#start").val();
                      calendar.fullCalendar('updateEvent', calEvent);
                      $('.antoclose2').click();
                    });
                    calendar.fullCalendar('unselect');
                  },
                  editable: true,
                  events: events
                });
              };
              init_calendar_owner();
            </script>
            <?php
              }
            ?>
            <audio id="notificationSound" src="<?php echo base_url('assets/audio/coin_c_02-102844.mp3'); ?>"></audio>
            <script>
            // NProgress
            if (typeof NProgress != 'undefined') {
              $(window).load(function () {
                // Function to periodically check for expired reservations
                function checkExpiredReservations() {
                  // setInterval(function() {
                    // Make an AJAX request to the server to check for expired reservations
                    $.ajax({
                      url: '<?php echo base_url('cms/home/ajaxCheckExpired') ?>', // Replace with the actual URL
                      method: 'GET',
                      success: function(response) {
                        var result_or = JSON.parse(response);
                        var currentDate = new Date();
                        var year = currentDate.getFullYear();
                        var month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Adding 1 because months are 0-indexed
                        var day = String(currentDate.getDate()).padStart(2, '0');
                        var hours = String(currentDate.getHours()).padStart(2, '0');
                        var minutes = String(currentDate.getMinutes()).padStart(2, '0');
                        var seconds = String(currentDate.getSeconds()).padStart(2, '0');
                        var formattedDateTime = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
                        // console.log(formattedDateTime);
                        for(let i in result_or) {
                          var arrival = result_or[i].arrivalBooking;
                          var odTime = '23:59:59';
                          var odarrivalTime = arrival+' '+odTime;
                          console.log(formattedDateTime+ ' & ' +odarrivalTime);
                          if(formattedDateTime == odarrivalTime) {
                            $.ajax({
                              url: '<?php echo base_url('cms/home/ajaxORtoOD') ?>', // Replace with the actual URL
                              method: 'POST',
                              data: {
                                arrival: result_or[i].arrivalBooking,
                                number: result_or[i].numberroomBooking,
                                idKamar: result_or[i].idKamar,
                                ketNumber: result_or[i].ketNumber,
                                idNumber: result_or[i].idNumber,
                                datenow: formattedDateTime,
                                odTime: odarrivalTime,
                              },
                              success: function(resOD) {
                                console.log(resOD);
                              },
                              error: function(error) {
                                console.error('Error:', error);
                              }
                            });
                          } else {
                          }
                        }
                        // Update the UI with the response if needed
                        document.getElementById('text-loading').style.display = 'none';
                        document.getElementById('sidebar-menu').style.display = 'block';
                      },
                      error: function(error) {
                        console.error('Error:', error);
                      }
                    });
                    $.ajax({
                      url: '<?php echo base_url('cms/home/ajaxPostPembayaran') ?>', // Replace with the actual URL
                      method: 'GET',
                      success: function(finance) {
                        var invoice_ = JSON.parse(finance);
                        console.log(invoice_);
                        if(invoice_.result != 'empty') {
                          for(let i in invoice_) {
                            new PNotify({
                              title: ' Payment '+parseFloat(invoice_[i].priceInvoice).toLocaleString('id-ID', {style: 'currency',currency: 'IDR'}),
                              text: 'ID Booking : '+invoice_[i].idBooking+' By '+invoice_[i].nmKaryawan,
                              type: 'info',
                              styling: 'bootstrap3'
                            });
                            // Play the notification sound on success
                            var audio = document.getElementById('notificationSound');
                            audio.play();
                            $.ajax({
                              url: '<?php echo base_url('cms/home/ajaxUpdateStatusInvoice') ?>', // Replace with the actual URL
                              method: 'POST',
                              data: {
                                idInvoice: invoice_[i].idInvoice,
                              },
                              success: function(update) {                
                                console.log(update);
                              },
                              error: function(error_update) {
                                console.error('Error:', error_update);
                              }
                            });
                          }
                        }
                      },
                      error: function(error) {
                        console.error('Error:', error);
                      }
                    });
                  // }, 1000); // Check every minute (adjust as needed)
                }
                // Call the function when the page loads
                $(document).ready(function() {
                  checkExpiredReservations();
                });
              });
            }
            document.addEventListener('DOMContentLoaded', function() {
              function loadPembayaranData(startDate, endDate) {
                $.ajax({
                  url: '<?php echo base_url('cms/home/ajaxPembayaranAll') ?>', // Replace with the actual URL
                  method: 'POST',
                  data: {
                    startDate: startDate,
                    endDate: endDate,
                    idBusiness: <?php echo $idBusiness ?>
                  },
                  success: function(response) {
                    var result = JSON.parse(response);               
                    // Assuming 'datatable-buttons' is the ID of your table
                    var tableBody = document.querySelector(".pembayaran tbody");
                    // Clear any previous content
                    tableBody.innerHTML = '';
                    var totalAmount = 0; // Variable to keep track of the total amount
                    // Assuming 'result' is an array of objects
                    result.forEach(function(item) {
                      var tr = document.createElement('tr');
                      var tdidInvoice = document.createElement('td');
                      tdidInvoice.textContent = item.idInvoice;
                      var tdfirstnameBooking = document.createElement('td');
                      tdfirstnameBooking.textContent = item.firstnameBooking;
                      var tdsegmentBooking = document.createElement('td');
                      tdsegmentBooking.textContent = item.segmentBooking;
                      var tdpaymentBooking = document.createElement('td');
                      tdpaymentBooking.textContent = item.paymentBooking;
                      var tdketInvoice = document.createElement('td');
                      tdketInvoice.textContent = item.ketInvoice;
                      var tdcreatedAtInvoice = document.createElement('td');
                      tdcreatedAtInvoice.textContent = item.createdAtInvoice;
                      var tdrefInvoice = document.createElement('td');
                      tdrefInvoice.textContent = item.refInvoice;
                      // Assuming 'item.priceInvoice' is a number
                      var formattedPrice = parseFloat(item.priceInvoice).toLocaleString('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                      });
                      var tdpriceInvoice = document.createElement('td');
                      tdpriceInvoice.textContent = formattedPrice;
                      var tdcurrencyBooking = document.createElement('td');
                      tdcurrencyBooking.textContent = item.currencyBooking;
                      var tdnationalityBooking = document.createElement('td');
                      tdnationalityBooking.textContent = item.nationalityBooking;
                      var tdAction = document.createElement('td');
                      var actionLink = document.createElement('button');
                      actionLink.href = '#'; // Add your link here
                      actionLink.textContent = 'Pilih';
                      if(item.adpInvoice != 1) {
                        actionLink.classList.add('btn', 'btn-primary'); // Add classes
                      } else {
                        actionLink.classList.add('btn', 'btn-warning'); // Add classes
                        actionLink.setAttribute('disabled', 'True');
                      }
                      // Add data attributes
                      actionLink.dataset.dismiss = 'modal';
                      actionLink.setAttribute('aria-label', 'Close');
                      actionLink.onclick = function() {
                        // Show a confirmation dialog before executing the AJAX request
                        var confirmation = window.confirm('Are you sure you want to proceed with this action?');
                        if (confirmation) {
                          $.ajax({
                            url: '<?php echo base_url('cms/home/sendToAdp') ?>', // Replace with the actual URL
                            method: 'POST',
                            data: { idInvoice: item.idInvoice, priceInvoice: item.priceInvoice, idInvestment:item.idInvestment, idBusiness:item.idBusiness, },
                            success: function(response) {
                              console.log("Saldo data", JSON.parse(response));
                              var saldo = JSON.parse(response);
                              if(saldo.status == 'Gagal') {
                                new PNotify({
                                  title: saldo.status,
                                  text: saldo.keterangan,
                                  type: 'error',
                                  styling: 'bootstrap3'
                                });
                              } else {
                                new PNotify({
                                  title: 'Berhasil',
                                  text: 'Pembayaran telah pindah ke ADP',
                                  type: 'info',
                                  styling: 'bootstrap3'
                                });
                              }
                              // Assuming response contains the ID, adjust this line accordingly
                              var idInvoice = response.idInvoice;
                              // Set Flashdata
                              <?php echo 'var base_url = "' . base_url() . '";'; ?>
                              // window.location.href = base_url + 'cms/home/viewPembayaran'; // Redirect to home page
                              $.ajax({
                                url: '<?php echo base_url('cms/home/ajaxPembayaranAll') ?>', // Replace with the actual URL
                                method: 'POST',
                                data: {
                                  startDate: startDate,
                                  endDate: endDate
                                },
                                success: function(response) {
                                  console.log("refresh data", JSON.parse(response));
                                  // Set default dates
                                  var startDate = document.getElementById('startDate').value;
                                  var endDate = document.getElementById('endDate').value;
                                  localStorage.setItem('startDate', startDate);
                                  loadPembayaranData(startDate, endDate);
                                }
                              });
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                              console.error("AJAX Error:", textStatus, errorThrown);
                              // You can handle the error here, e.g., show an alert or update the UI
                            }
                          });
                        }

                      };
                      tdAction.appendChild(actionLink);
                      tr.appendChild(tdidInvoice);
                      tr.appendChild(tdfirstnameBooking);
                      tr.appendChild(tdsegmentBooking);
                      tr.appendChild(tdpaymentBooking);
                      tr.appendChild(tdketInvoice);
                      tr.appendChild(tdcreatedAtInvoice);
                      tr.appendChild(tdrefInvoice);
                      tr.appendChild(tdpriceInvoice);
                      tr.appendChild(tdcurrencyBooking);
                      tr.appendChild(tdnationalityBooking);
                      tr.appendChild(tdAction);
                      // Calculate the total amount and update it for each row
                      totalAmount += parseFloat(item.priceInvoice);
                      tableBody.appendChild(tr);
                    });
                    // Display the total in a separate row at the end of the table
                    var trTotal = document.createElement('tr');
                    var tdTotalLabel = document.createElement('td');
                    tdTotalLabel.colSpan = 7; // Set colSpan to the total number of columns
                    tdTotalLabel.textContent = 'Total Amount';
                    trTotal.appendChild(tdTotalLabel);
                    var tdTotalAmount = document.createElement('td');
                    tdTotalAmount.textContent = totalAmount.toLocaleString('id-ID', {
                      style: 'currency',
                      currency: 'IDR'
                    });
                    trTotal.appendChild(tdTotalAmount);
                    tableBody.appendChild(trTotal);
                  },
                  error: function(error) {
                    console.error('Error:', error);
                  }
                });
              }
              // Set default dates
              var today = new Date();
              var dd = String(today.getDate()).padStart(2, '0');
              var mm = String(today.getMonth() + 1).padStart(2, '0');
              var yyyy = today.getFullYear();
              today = yyyy + '-' + mm + '-' + dd;
              document.getElementById('startDate').value = today;
              document.getElementById('endDate').value = today;
              // Load data on window load with default dates
              loadPembayaranData(today, today);
              // Add an event listener for the form submission
              document.getElementById('dateIntervalForm').addEventListener('submit', function(event) {
                event.preventDefault();
                var startDate = document.getElementById('startDate').value;
                var endDate = document.getElementById('endDate').value;
                localStorage.setItem('startDate', startDate);
                loadPembayaranData(startDate, endDate);
              });
              init_PNotify();
            });
            document.addEventListener('DOMContentLoaded', function() {
              function loadPembayaranDataTemp(startDate, endDate) {
                $.ajax({
                  url: '<?php echo base_url('cms/home/ajaxInvoiceTemp') ?>', // Replace with the actual URL
                  method: 'POST',
                  data: {
                    startDate: startDate,
                    endDate: endDate,
                    idBusiness: <?php echo $idBusiness ?>
                  },
                  success: function(response) {
                    var result = JSON.parse(response);
                    console.log("result", result);           
                    // Assuming 'datatable-buttons' is the ID of your table
                    var tableBody = document.querySelector(".pembayaran_bukti tbody");
                    // Clear any previous content
                    tableBody.innerHTML = '';
                    var totalAmount = 0; // Variable to keep track of the total amount
                    // Assuming 'result' is an array of objects
                    result.forEach(function(item) {
                      var tr = document.createElement('tr');
                      var tdidInvoicetemp = document.createElement('td');
                      tdidInvoicetemp.textContent = item.idInvoicetemp;
                      var tdinvoiceFnbAdditional = document.createElement('td');
                      tdinvoiceFnbAdditional.textContent = item.invoiceFnbadditional;
                      console.log("item", item.invoiceFnbadditional);
                      var tdidBooking = document.createElement('td');
                      tdidBooking.textContent = item.idBooking;
                      var tdfirstnameBooking = document.createElement('td');
                      tdfirstnameBooking.textContent = item.firstnameBooking;
                      var tdsegmentBooking = document.createElement('td');
                      tdsegmentBooking.textContent = item.segmentBooking;
                      var tdpaymentBooking = document.createElement('td');
                      tdpaymentBooking.textContent = item.paymentBooking;
                      if(item.idBooking) {
                        var tdstatuspaymentBooking = document.createElement('td');
                        tdstatuspaymentBooking.textContent = item.statuspayBooking;
                        if(tdstatuspaymentBooking.textContent == 'UNPAID') {
                          tdstatuspaymentBooking.style.backgroundColor = 'red';
                          tdstatuspaymentBooking.style.color = 'white';
                        } else {
                          tdstatuspaymentBooking.style.backgroundColor = 'green';
                          tdstatuspaymentBooking.style.color = 'white';
                        }
                      } else {
                        var tdsegmentBooking = document.createElement('td');
                        tdsegmentBooking.textContent = item.segmentFnbadditional;
                        var tdstatuspaymentBooking = document.createElement('td');
                        tdstatuspaymentBooking.textContent = item.statuspayFnbcooking;
                        if(tdstatuspaymentBooking.textContent == 'UNPAID') {
                          tdstatuspaymentBooking.style.backgroundColor = 'red';
                          tdstatuspaymentBooking.style.color = 'white';
                        } else {
                          tdstatuspaymentBooking.style.backgroundColor = 'green';
                          tdstatuspaymentBooking.style.color = 'white';
                        }
                      }
                      var tdfileInvoice = document.createElement('td');
                      tdfileInvoice.textContent = item.file;
                      tdfileInvoice.textContent = 'click here to open the file...';
                      // Add a click event listener
                      tdfileInvoice.addEventListener('click', function() {
                        // Assuming item.file is the file name or URL
                        var confirmation = window.confirm('Are you sure you want to proceed with this action?');
                        if (confirmation) {
                          // Redirect to the specified URL in a new tab or window
                          window.open('<?php echo base_url() ?>assets/images/invoice/' + item.file, '_blank');
                        }
                      });
                      var tdcreatedAtInvoicetemp = document.createElement('td');
                      tdcreatedAtInvoicetemp.textContent = item.createdAtInvoicetemp;
                      var tdAction = document.createElement('td');
                      var actionLink = document.createElement('button');
                      actionLink.href = '#'; // Add your link here
                      actionLink.textContent = 'Pilih';
                      // Add data attributes
                      actionLink.classList.add('btn', 'btn-primary'); // Add classes
                      actionLink.onclick = function() {
                        var confirmation = window.confirm('Are you sure you want to proceed with this action?');
                        if (confirmation) {
                          window.open('<?php echo base_url() ?>cms/home/viewBookingInvoice/' + item.idBooking, '_blank');
                        }
                      };
                      tdAction.appendChild(actionLink);
                      tr.appendChild(tdidInvoicetemp);
                      tr.appendChild(tdinvoiceFnbAdditional);
                      tr.appendChild(tdidBooking);
                      tr.appendChild(tdfirstnameBooking);
                      tr.appendChild(tdsegmentBooking);
                      tr.appendChild(tdpaymentBooking);
                      tr.appendChild(tdstatuspaymentBooking);
                      tr.appendChild(tdfileInvoice);
                      tr.appendChild(tdcreatedAtInvoicetemp);
                      tr.appendChild(tdAction);
                      tableBody.appendChild(tr);
                    });
                  },
                  error: function(error) {
                    console.error('Error:', error);
                  }
                });
              }
              // Set default dates
              var today = new Date();
              var dd = String(today.getDate()).padStart(2, '0');
              var mm = String(today.getMonth() + 1).padStart(2, '0');
              var yyyy = today.getFullYear();
              today = yyyy + '-' + mm + '-' + dd;
              document.getElementById('startDate').value = today;
              document.getElementById('endDate').value = today;
              // Load data on window load with default dates
              loadPembayaranDataTemp(today, today);
              // Add an event listener for the form submission
              document.getElementById('dateIntervalFormTemp').addEventListener('submit', function(event) {
                event.preventDefault();
                var startDate = document.getElementById('startDate').value;
                var endDate = document.getElementById('endDate').value;
                localStorage.setItem('startDate', startDate);
                loadPembayaranDataTemp(startDate, endDate);
              });
              init_PNotify();
            });
            </script>
            <script type="text/javascript">
              /* PNotify */
              function init_PNotify() {
                if (typeof (PNotify) === 'undefined') { return; }
                console.log('init_PNotify');
              };
            </script>
            <?php
              if($nopage == 1 && $this->session->userdata('dep') == '8') {
            ?>
            <script type="text/javascript">
              /* CALENDAR */
              function  init_calendar() {
                if( typeof ($.fn.fullCalendar) === 'undefined'){ return; }
                console.log('init_calendar');
                function formatDate(date) {
                  var year = date.getFullYear();
                  var month = ('0' + (date.getMonth() + 1)).slice(-2);
                  var day = ('0' + date.getDate()).slice(-2);
                  return year + '-' + month + '-' + day;
                }

                var date = new Date(),
                  d = date.getDate(),
                  m = date.getMonth(),
                  y = date.getFullYear(),
                  started,
                  categoryClass;
                var datesArray = [
                  <?php
                    $displayed_name = array(); // Array to keep track of displayed invoices
                    foreach ($business as $row) {
                      if($row->Name != 'MidEast Shisha & Lounge Bogor' && $row->Name != 'HO') {
                        // Check if the invoice has already been displayed
                        if (!in_array($row->Name, $displayed_name)) {
                          // Add the invoice to the list of displayed invoices
                          $displayed_name[] = $row->Name;
                          // Display the row
                          $startDate = new DateTime(date('Y') . '-01-01'); // January is 1 in DateTime
                          $endDate = new DateTime(date('Y') . '-12-31');
                          $currentDate = clone $startDate;
                          // Generate a unique ID for the modal
                          $modal_id = 'modal_' . strtolower(str_replace(' ', '_', $row->idBusiness));
                          while ($currentDate <= $endDate) {
                            ?>
                            {
                              title: '<?php echo $row->Name ?>',
                              start: new Date('<?php echo $currentDate->format('Y-m-d'); ?>T00:00:00'),
                              end: new Date('<?php echo $currentDate->format('Y-m-d'); ?>T23:59:59'),
                              ketKamar: <?php echo json_encode($row->Name) ?>,
                              modalID: '<?php echo $modal_id ?>',
                              idBusiness: <?php echo $row->idBusiness ?>,
                              idMeeting: <?php echo $row->idMeeting ?>,
                              capacityMeeting: <?php echo $row->capacityMeeting ?>,
                            },
                            <?php
                            $currentDate->modify('+1 day');
                          }
                        }
                      }
                    }
                  ?>
                ];
                var events = datesArray.map(function(dateObj) {
                return {
                  title: dateObj.title,
                  start: new Date(dateObj.start),
                  end: new Date(dateObj.end),
                  ketKamar: dateObj.ketKamar,
                  modalID: dateObj.modalID,
                  idBusiness: dateObj.idBusiness,
                  idMeeting: dateObj.idMeeting,
                  capacityMeeting: dateObj.capacityMeeting,
                  allDay: true
                  };
                });
                var calendar = $('#calendar-meeting').fullCalendar({
                  header: {
                  left: 'prev,next today',
                  center: 'title',
                  right: 'month,agendaWeek,agendaDay,listMonth'
                  },
                  selectable: true,
                  selectHelper: true,
                  select: function(start, end, allDay) {
                  $('#fc_create').click();
                  started = start;
                  ended = end;
                  $(".antosubmit").on("click", function() {
                    var title = $("#title").val();
                    if (end) {
                    ended = end;
                    }
                    categoryClass = $("#event_type").val();
                    if (title) {
                    calendar.fullCalendar('renderEvent', {
                      title: title,
                      start: started,
                      end: end,
                      allDay: allDay
                      },
                      true // make the event "stick"
                    );
                    }
                    $('#title').val('');
                    calendar.fullCalendar('unselect');
                    $('.antoclose').click();
                    return false;
                  });
                  },
                  eventClick: function(calEvent, jsEvent, view) {
                  var modalID = document.getElementById('fc_edit');
                  modalID.setAttribute('data-toggle', 'modal');
                  modalID.setAttribute('data-target', '#'+calEvent.modalID);
                  modalID.click();
                  $('#start'+calEvent.modalID).text(calEvent.modalID);

                  // Format and log date
                  var formattedDate = formatDate(new Date(calEvent.start));
                  console.log(formattedDate);
                  // Display formatted date in modal
                  $('#formattedDateDisplay'+calEvent.modalID).text(formattedDate);
                  $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('cms/home/ajaxInventoryRoom/') ?>"+calEvent.idBusiness, // Replace with the actual path to your PHP script
                    data: { formattedDate: formattedDate },
                    success: function(response) {
                      // Parse the JSON response
                      var responseData = JSON.parse(response);
                      // Asumsi data dari tabel meeting_room dan booking_cart
                      var meetingRooms = [
                        <?php 
                          $meeting_room = array();
                          $this->db->from('Business_Detail');
                          $this->db->join('meeting_room', 'meeting_room.idBusiness=Business_Detail.idBusiness');
                          $query = $this->db->get();
                          if ($query->num_rows() > 0)
                          {
                            foreach ($query->result() as $row)
                            {
                              $meeting_room[] = $row;
                            }
                          }
                          $query->free_result(); 
                        ?>
                        <?php 
                          foreach($meeting_room as $row) {
                        ?>
                          { nmMeeting: '<?php echo $row->nmMeeting ?>', capacityMeeting: '<?php echo $row->capacityMeeting ?>', idMeeting: '<?php echo $row->idMeeting ?>' },
                        <?php } ?>
                      ];
                      // Asumsi data dari tabel meeting_room dan booking_cart
                      var bookingData = [
                        <?php 
                          $databookingcart = array();
                          $this->db->from('Business_Detail');
                          $this->db->join('booking_cart', 'booking_cart.idBusiness=Business_Detail.idBusiness');
                          $query = $this->db->get();
                          if ($query->num_rows() > 0)
                          {
                            foreach ($query->result() as $row)
                            {
                              $databookingcart[] = $row;
                            }
                          }
                          $query->free_result(); 
                        ?>
                        <?php 
                          foreach($databookingcart as $row) {
                        ?>
                        { paxBooking: '<?php echo $row->paxBooking ?>', arrivalBooking: '<?php echo $row->arrivalBooking ?>', departureBooking: '<?php echo $row->departureBooking ?>', meetingroomBooking: '<?php echo $row->meetingroomBooking ?>' },
                        <?php } ?>
                      ];
                      // Fungsi untuk menghitung total kapasitas yang tersedia
                      function calculateAvailableCapacity(arrivalDate, meetingRooms, bookingData, meetingRoomName) {
                        var totalCapacity = 0;
                        // Filter data berdasarkan tanggal kedatangan dan nmMeeting
                        var filteredData = bookingData.filter(function(booking) {
                          return booking.arrivalBooking === arrivalDate && booking.meetingroomBooking === meetingRoomName;
                        });
                        // Jika tidak ada pemesanan untuk ruangan ini, tambahkan kapasitas ruangan ke total
                        if (filteredData.length === 0) {
                          var meetingRoom = meetingRooms.find(function(room) {
                            return room.nmMeeting === meetingRoomName;
                          });
                          if (meetingRoom) {
                            totalCapacity += meetingRoom.capacityMeeting;
                          }
                        } else {
                          // Jika ada pemesanan, hitung kapasitas yang tersedia seperti sebelumnya
                          filteredData.forEach(function(booking) {
                            var meetingRoom = meetingRooms.find(function(room) {
                              return room.nmMeeting === booking.meetingroomBooking;
                            });
                            if (meetingRoom) {
                              totalCapacity += meetingRoom.capacityMeeting - booking.paxBooking;
                            }
                          });
                        }
                        return totalCapacity;
                      }
                      meetingRooms.forEach(function(room) {
                        var availableCapacity = calculateAvailableCapacity(formattedDate, meetingRooms, bookingData, room.nmMeeting);
                        // Pastikan room memiliki properti idMeeting
                        if (room.hasOwnProperty('idMeeting')) {
                          console.log("Kapasitas tersedia untuk " + room.nmMeeting + " (" + room.idMeeting + ") adalah: " + (+availableCapacity));
                        } else {
                          console.log("Kapasitas tersedia untuk " + room.nmMeeting + " adalah: " + (+availableCapacity));
                        }
                        var booking = bookingData.find(function(booking) {
                          return booking.meetingroomBooking === room.nmMeeting && booking.arrivalBooking === formattedDate;
                        });
                        var paxBooking = booking ? booking.paxBooking : 0;
                        $('#nmMeeting_' + calEvent.modalID + '_' + room.idMeeting).text(room.nmMeeting);
                        $('#capacityMeeting_' + calEvent.modalID + '_' + room.idMeeting).text(+availableCapacity);
                        $('#paxBooking_' + calEvent.modalID + '_' + room.idMeeting).text(+paxBooking);
                      });
                    }
                  });
                  categoryClass = $("#event_type").val();
                  $(".antosubmit2").on("click", function() {
                    calEvent.title = $("#start").val();
                    calendar.fullCalendar('updateEvent', calEvent);
                    $('.antoclose2').click();
                  });
                  calendar.fullCalendar('unselect');
                  },
                  editable: true,
                  events: events
                });
              };
              init_calendar();
            </script>
            <?php } ?>
            <script type="text/javascript">
              if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
              } else {
                console.error('Geolocation is not supported by this browser.');
              }
              function successCallback(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                // Set a zoom level (you can adjust this value)
                var zoomLevel = 20; // Example value, you can change it to your desired zoom level
                // Use an AJAX request to send the coordinates to your server
                $.ajax({
                  url: '<?php echo base_url('cms/home') ?>', // Replace with your server endpoint
                  method: 'POST',
                  data: { latitude: latitude, longitude: longitude, zoom: zoomLevel },
                  success: function(response) {
                    console.log('Coordinates sent to server successfully.');
                  },
                  error: function(error) {
                    console.error('Error sending coordinates to server:', error);
                  }
                });
              }
              function errorCallback(error) {
                console.error('Error getting location:', error);
              }
            </script>
            <!-- DIAGRAM ADP FIT -->
            <script type="text/javascript">
              function init_flot_chart_adp_accumulation_fit() {
                if (typeof $.plot === 'undefined') {
                  return;
                }
                // console.log('init_flot_chart_adp_accumulation_fit');
                var chart_plot_adp_accumulation_data = [];
                var chart_plot_adp_accumulation_settings = {
                  grid: {
                    show: true,
                    aboveData: true,
                    color: "#212121",
                    labelMargin: 10,
                    axisMargin: 0,
                    borderWidth: 0,
                    borderColor: null,
                    minBorderMargin: 5,
                    clickable: true,
                    hoverable: true,
                    autoHighlight: true,
                    mouseActiveRadius: 100
                  },
                  series: {
                    lines: {
                      show: true,
                      fill: true,
                      lineWidth: 1,
                      steps: false
                    },
                    points: {
                      show: true,
                      radius: 4.5,
                      symbol: "circle",
                      lineWidth: 3.0
                    }
                  },
                  legend: {
                    position: "ne",
                    margin: [0, -25],
                    noColumns: 0,
                    labelBoxBorderColor: null,
                    labelFormatter: function (label, series) {
                      return label + '&nbsp;&nbsp;';
                    },
                    width: 40,
                    height: 1
                  },
                  colors: ['#2c7282'],
                  shadowSize: 0,
                  tooltip: true,
                  tooltipOpts: {
                    content: "%s: %y.0",
                    xDateFormat: "%d/%m",
                    shifts: {
                      x: -30,
                      y: -50
                    },
                    defaultTheme: false
                  },
                  yaxis: {
                    min: 0,
                    max: 50000000
                  },
                  xaxis: {
                    mode: "time",
                    minTickSize: [1, "day"],
                    timeformat: "%d/%m/%y",
                    min: null, // We'll set this later after fetching data
                    max: null  // We'll set this later after fetching data
                  }
                };
                if ($("#chart_plot_adp_accumulation").length) {          
                  // Make an AJAX request to fetch data from CodeIgniter endpoint
                  $.ajax({
                      url: '<?php echo base_url('cms/home/ajaxgetchartdata_adp/'.$idBusiness.'/'); ?>',
                      type: 'GET',
                      dataType: 'json',
                      success: function (data) {
                          if (data && data.length > 0) {
                              console.log('Data from server:', data);
                              var cumulativeSum = 0;
                              var chart_plot_adp_accumulation_data = [];
                              var currentDate = null;
                              // Sort the data based on timestamp
                              data.sort(function (a, b) {
                                  return new Date(a.createdAtInvoice) - new Date(b.createdAtInvoice);
                              });
                              // Update chart with the retrieved data
                              for (var i = 0; i < data.length; i++) {
                                  var currentDateFormatted = new Date(data[i].createdAtInvoice).toLocaleDateString();
                                  // Check if it's a new day
                                  if (currentDate !== currentDateFormatted) {
                                      // If it's a new day, push the accumulated sum of the previous day
                                      if (currentDate !== null) {
                                          chart_plot_adp_accumulation_data.push([
                                              new Date(currentDate).getTime(),
                                              cumulativeSum
                                          ]);
                                      }
                                      // Reset cumulative sum for the new day
                                      currentDate = currentDateFormatted;
                                  }
                                  // Convert priceInvoice to a number before adding to the cumulative sum
                                  cumulativeSum += parseFloat(data[i].priceInvoice);
                              }
                              // Push the accumulated sum for the last day
                              if (currentDate !== null) {
                                  chart_plot_adp_accumulation_data.push([
                                      new Date(currentDate).getTime(),
                                      cumulativeSum
                                  ]);
                              }
                              // Set min and max values for x-axis
                              chart_plot_adp_accumulation_settings.xaxis.min = chart_plot_adp_accumulation_data[0][0];
                              chart_plot_adp_accumulation_settings.xaxis.max =
                                  chart_plot_adp_accumulation_data[
                                      chart_plot_adp_accumulation_data.length - 1
                                  ][0];
                              // Plot the chart
                              $.plot($("#chart_plot_adp_accumulation"), [
                                  {
                                      label: "ADP ACCUMULATION",
                                      data: chart_plot_adp_accumulation_data,
                                      lines: {
                                          fillColor: "rgb(44, 114, 130, 0.12)",
                                      },
                                      points: {
                                          fillColor: "#fff",
                                      },
                                  },
                              ], chart_plot_adp_accumulation_settings);
                          } else {
                              console.warn('Empty or invalid data received from the server.');
                          }
                      },
                      error: function (error) {
                          console.error('Error fetching data:', error);
                      },
                  });
                }
                // Add tooltip functionality
                var previousPoint = null;
                $("#chart_plot_adp_accumulation").bind("plothover", function (event, pos, item) {
                  if (item) {
                    if (previousPoint != item.dataIndex) {
                      previousPoint = item.dataIndex;
                      $("#flot-tooltip").remove();
                      var x = item.datapoint[0].toFixed(2);
                      var y = item.datapoint[1].toFixed(2);
                      showTooltip(item.pageX, item.pageY, x, y);
                    }
                  } else {
                    $("#flot-tooltip").remove();
                    previousPoint = null;
                  }
                });
                function showTooltip(x, y, xValue, yValue) {
                  $('<div id="flot-tooltip">' + yValue + '</div>').css({
                    position: 'absolute',
                    display: 'none',
                    top: y - 40,
                    left: x - 30,
                    border: '1px solid #fdd',
                    padding: '2px',
                    'background-color': '#fee',
                    opacity: 0.80
                  }).appendTo("body").fadeIn(200);
                }
              }
              // Call init_flot_chart_adp_accumulation_fit every second
              setInterval(init_flot_chart_adp_accumulation_fit, 3000);
              init_flot_chart_adp_accumulation_fit();
            </script>
            <script type="text/javascript">
              function init_flot_chart_adp_day_fit() {
                if (typeof $.plot === 'undefined') {
                  return;
                }
                // console.log('init_flot_chart_adp_day_fit');
                var chart_plot_adp_data = [];
                var chart_plot_adp_settings = {
                  grid: {
                    show: true,
                    aboveData: true,
                    color: "#212121",
                    labelMargin: 10,
                    axisMargin: 0,
                    borderWidth: 0,
                    borderColor: null,
                    minBorderMargin: 5,
                    clickable: true,
                    hoverable: true,
                    autoHighlight: true,
                    mouseActiveRadius: 100
                  },
                  series: {
                    lines: {
                      show: true,
                      fill: true,
                      lineWidth: 1,
                      steps: false
                    },
                    points: {
                      show: true,
                      radius: 4.5,
                      symbol: "circle",
                      lineWidth: 3.0
                    }
                  },
                  legend: {
                    position: "ne",
                    margin: [0, -25],
                    noColumns: 0,
                    labelBoxBorderColor: null,
                    labelFormatter: function (label, series) {
                      return label + '&nbsp;&nbsp;';
                    },
                    width: 40,
                    height: 1
                  },
                  colors: ['#2c7282'],
                  shadowSize: 0,
                  tooltip: true,
                  tooltipOpts: {
                    content: "%s: %y.0",
                    xDateFormat: "%d/%m",
                    shifts: {
                      x: -30,
                      y: -50
                    },
                    defaultTheme: false
                  },
                  yaxis: {
                    min: 0,
                    max: 50000000
                  },
                  xaxis: {
                    mode: "time",
                    minTickSize: [1, "day"],
                    timeformat: "%d/%m/%y",
                    min: null, // We'll set this later after fetching data
                    max: null  // We'll set this later after fetching data
                  }
                };
                if ($("#chart_plot_adp").length) {          
                  // Make an AJAX request to fetch data from CodeIgniter endpoint
                  $.ajax({
                      url: '<?php echo base_url('cms/home/ajaxgetchartdata_adp/'.$idBusiness.'/'); ?>',
                      type: 'GET',
                      dataType: 'json',
                      success: function (data) {
                          if (data && data.length > 0) {
                              console.log('Data from server:', data);
                              var cumulativeSum = 0;
                              var currentDate = null;
                              // Update chart with the retrieved data
                              for (var i = 0; i < data.length; i++) {
                                  var currentDateFormatted = new Date(data[i].createdAtInvoice).toLocaleDateString();
                                  // Check if it's a new day
                                  if (currentDate !== currentDateFormatted) {
                                      // If it's a new day, push the accumulated sum of the previous day
                                      if (currentDate !== null) {
                                          chart_plot_adp_data.push([new Date(currentDate).getTime(), cumulativeSum]);
                                      }
                                      // Reset cumulative sum for the new day
                                      currentDate = currentDateFormatted;
                                      cumulativeSum = 0;
                                  }
                                  // Convert priceInvoice to a number before adding to the cumulative sum
                                  cumulativeSum += parseFloat(data[i].priceInvoice);
                              }
                              // Push the accumulated sum for the last day
                              if (currentDate !== null) {
                                  chart_plot_adp_data.push([new Date(currentDate).getTime(), cumulativeSum]);
                              }
                              // Sort the data based on timestamp
                              chart_plot_adp_data.sort(function (a, b) {
                                  return a[0] - b[0];
                              });
                              // Set min and max values for x-axis
                              chart_plot_adp_settings.xaxis.min = chart_plot_adp_data[0][0];
                              chart_plot_adp_settings.xaxis.max = chart_plot_adp_data[chart_plot_adp_data.length - 1][0];
                              // Plot the chart
                              $.plot($("#chart_plot_adp"), [{
                                  label: "ADP PER DAY",
                                  data: chart_plot_adp_data,
                                  lines: {
                                      fillColor: "rgb(44, 114, 130, 0.12)"
                                  },
                                  points: {
                                      fillColor: "#fff"
                                  }
                              }], chart_plot_adp_settings);
                          } else {
                              console.warn('Empty or invalid data received from the server.');
                          }
                      },
                      error: function (error) {
                          console.error('Error fetching data:', error);
                      }
                  });
                }
                // Add tooltip functionality
                var previousPoint = null;
                $("#chart_plot_adp").bind("plothover", function (event, pos, item) {
                  if (item) {
                    if (previousPoint != item.dataIndex) {
                      previousPoint = item.dataIndex;
                      $("#flot-tooltip").remove();
                      var x = item.datapoint[0].toFixed(2);
                      var y = item.datapoint[1].toFixed(2);
                      showTooltip(item.pageX, item.pageY, x, y);
                    }
                  } else {
                    $("#flot-tooltip").remove();
                    previousPoint = null;
                  }
                });
                function showTooltip(x, y, xValue, yValue) {
                  $('<div id="flot-tooltip">' + yValue + '</div>').css({
                    position: 'absolute',
                    display: 'none',
                    top: y - 40,
                    left: x - 30,
                    border: '1px solid #fdd',
                    padding: '2px',
                    'background-color': '#fee',
                    opacity: 0.80
                  }).appendTo("body").fadeIn(200);
                }
              }
              // Call init_flot_chart_adp_day_fit every second
              setInterval(init_flot_chart_adp_day_fit, 3000);
              init_flot_chart_adp_day_fit();
            </script>
            <!-- DIAGRAM ADP FIT -->
            <!-- DIAGRAM ADP OTA -->
            <script type="text/javascript">
              function init_flot_chart_adp_accumulation_ota() {
                if (typeof $.plot === 'undefined') {
                  return;
                }
                // console.log('init_flot_chart_adp_accumulation_ota');
                var chart_plot_adp_accumulation_ota_data = [];
                var chart_plot_adp_accumulation_ota_settings = {
                  grid: {
                    show: true,
                    aboveData: true,
                    color: "#212121",
                    labelMargin: 10,
                    axisMargin: 0,
                    borderWidth: 0,
                    borderColor: null,
                    minBorderMargin: 5,
                    clickable: true,
                    hoverable: true,
                    autoHighlight: true,
                    mouseActiveRadius: 100
                  },
                  series: {
                    lines: {
                      show: true,
                      fill: true,
                      lineWidth: 1,
                      steps: false
                    },
                    points: {
                      show: true,
                      radius: 4.5,
                      symbol: "circle",
                      lineWidth: 3.0
                    }
                  },
                  legend: {
                    position: "ne",
                    margin: [0, -25],
                    noColumns: 0,
                    labelBoxBorderColor: null,
                    labelFormatter: function (label, series) {
                      return label + '&nbsp;&nbsp;';
                    },
                    width: 40,
                    height: 1
                  },
                  colors: ['#2c7282'],
                  shadowSize: 0,
                  tooltip: true,
                  tooltipOpts: {
                    content: "%s: %y.0",
                    xDateFormat: "%d/%m",
                    shifts: {
                      x: -30,
                      y: -50
                    },
                    defaultTheme: false
                  },
                  yaxis: {
                    min: 0,
                    max: 50000000
                  },
                  xaxis: {
                    mode: "time",
                    minTickSize: [1, "day"],
                    timeformat: "%d/%m/%y",
                    min: null, // We'll set this later after fetching data
                    max: null  // We'll set this later after fetching data
                  }
                };
                if ($("#chart_plot_adp_accumulation_ota").length) {          
                  // Make an AJAX request to fetch data from CodeIgniter endpoint
                  $.ajax({
                      url: '<?php echo base_url('cms/home/ajaxgetchartdata_adp_ota/'.$idBusiness.'/'); ?>',
                      type: 'GET',
                      dataType: 'json',
                      success: function (data) {
                          if (data && data.length > 0) {
                              console.log('Data from server:', data);
                              var cumulativeSum = 0;
                              var chart_plot_adp_accumulation_ota_data = [];
                              var currentDate = null;
                              // Sort the data based on timestamp
                              data.sort(function (a, b) {
                                  return new Date(a.createdAtInvoice) - new Date(b.createdAtInvoice);
                              });
                              // Update chart with the retrieved data
                              for (var i = 0; i < data.length; i++) {
                                  var currentDateFormatted = new Date(data[i].createdAtInvoice).toLocaleDateString();
                                  // Check if it's a new day
                                  if (currentDate !== currentDateFormatted) {
                                      // If it's a new day, push the accumulated sum of the previous day
                                      if (currentDate !== null) {
                                          chart_plot_adp_accumulation_ota_data.push([
                                              new Date(currentDate).getTime(),
                                              cumulativeSum
                                          ]);
                                      }
                                      // Reset cumulative sum for the new day
                                      currentDate = currentDateFormatted;
                                  }
                                  // Convert priceInvoice to a number before adding to the cumulative sum
                                  cumulativeSum += parseFloat(data[i].priceInvoice);
                              }
                              // Push the accumulated sum for the last day
                              if (currentDate !== null) {
                                  chart_plot_adp_accumulation_ota_data.push([
                                      new Date(currentDate).getTime(),
                                      cumulativeSum
                                  ]);
                              }
                              // Set min and max values for x-axis
                              chart_plot_adp_accumulation_ota_settings.xaxis.min = chart_plot_adp_accumulation_ota_data[0][0];
                              chart_plot_adp_accumulation_ota_settings.xaxis.max =
                                  chart_plot_adp_accumulation_ota_data[
                                      chart_plot_adp_accumulation_ota_data.length - 1
                                  ][0];
                              // Plot the chart
                              $.plot($("#chart_plot_adp_accumulation_ota"), [
                                  {
                                      label: "ADP ACCUMULATION",
                                      data: chart_plot_adp_accumulation_ota_data,
                                      lines: {
                                          fillColor: "rgb(44, 114, 130, 0.12)",
                                      },
                                      points: {
                                          fillColor: "#fff",
                                      },
                                  },
                              ], chart_plot_adp_accumulation_ota_settings);
                          } else {
                              console.warn('Empty or invalid data received from the server.');
                          }
                      },
                      error: function (error) {
                          console.error('Error fetching data:', error);
                      },
                  });
                }
                // Add tooltip functionality
                var previousPoint = null;
                $("#chart_plot_adp_accumulation_ota").bind("plothover", function (event, pos, item) {
                  if (item) {
                    if (previousPoint != item.dataIndex) {
                      previousPoint = item.dataIndex;
                      $("#flot-tooltip").remove();
                      var x = item.datapoint[0].toFixed(2);
                      var y = item.datapoint[1].toFixed(2);
                      showTooltip(item.pageX, item.pageY, x, y);
                    }
                  } else {
                    $("#flot-tooltip").remove();
                    previousPoint = null;
                  }
                });
                function showTooltip(x, y, xValue, yValue) {
                  $('<div id="flot-tooltip">' + yValue + '</div>').css({
                    position: 'absolute',
                    display: 'none',
                    top: y - 40,
                    left: x - 30,
                    border: '1px solid #fdd',
                    padding: '2px',
                    'background-color': '#fee',
                    opacity: 0.80
                  }).appendTo("body").fadeIn(200);
                }
              }
              // Call init_flot_chart_adp_accumulation_ota every second
              setInterval(init_flot_chart_adp_accumulation_ota, 3000);
              init_flot_chart_adp_accumulation_ota();
            </script>
            <script type="text/javascript">
              function init_flot_chart_adp_day_ota() {
                if (typeof $.plot === 'undefined') {
                  return;
                }
                // console.log('init_flot_chart_adp_day_ota');
                var chart_plot_adp_day_ota_data = [];
                var chart_plot_adp_day_ota_settings = {
                  grid: {
                    show: true,
                    aboveData: true,
                    color: "#212121",
                    labelMargin: 10,
                    axisMargin: 0,
                    borderWidth: 0,
                    borderColor: null,
                    minBorderMargin: 5,
                    clickable: true,
                    hoverable: true,
                    autoHighlight: true,
                    mouseActiveRadius: 100
                  },
                  series: {
                    lines: {
                      show: true,
                      fill: true,
                      lineWidth: 1,
                      steps: false
                    },
                    points: {
                      show: true,
                      radius: 4.5,
                      symbol: "circle",
                      lineWidth: 3.0
                    }
                  },
                  legend: {
                    position: "ne",
                    margin: [0, -25],
                    noColumns: 0,
                    labelBoxBorderColor: null,
                    labelFormatter: function (label, series) {
                      return label + '&nbsp;&nbsp;';
                    },
                    width: 40,
                    height: 1
                  },
                  colors: ['#2c7282'],
                  shadowSize: 0,
                  tooltip: true,
                  tooltipOpts: {
                    content: "%s: %y.0",
                    xDateFormat: "%d/%m",
                    shifts: {
                      x: -30,
                      y: -50
                    },
                    defaultTheme: false
                  },
                  yaxis: {
                    min: 0,
                    max: 50000000
                  },
                  xaxis: {
                    mode: "time",
                    minTickSize: [1, "day"],
                    timeformat: "%d/%m/%y",
                    min: null, // We'll set this later after fetching data
                    max: null  // We'll set this later after fetching data
                  }
                };
                if ($("#chart_plot_adp_day_ota").length) {          
                  // Make an AJAX request to fetch data from CodeIgniter endpoint
                  $.ajax({
                      url: '<?php echo base_url('cms/home/ajaxgetchartdata_adp_ota/'.$idBusiness.'/'); ?>',
                      type: 'GET',
                      dataType: 'json',
                      success: function (data) {
                          if (data && data.length > 0) {
                              console.log('Data from server:', data);
                              var cumulativeSum = 0;
                              var currentDate = null;
                              // Update chart with the retrieved data
                              for (var i = 0; i < data.length; i++) {
                                  var currentDateFormatted = new Date(data[i].createdAtInvoice).toLocaleDateString();
                                  // Check if it's a new day
                                  if (currentDate !== currentDateFormatted) {
                                      // If it's a new day, push the accumulated sum of the previous day
                                      if (currentDate !== null) {
                                          chart_plot_adp_day_ota_data.push([new Date(currentDate).getTime(), cumulativeSum]);
                                      }
                                      // Reset cumulative sum for the new day
                                      currentDate = currentDateFormatted;
                                      cumulativeSum = 0;
                                  }
                                  // Convert priceInvoice to a number before adding to the cumulative sum
                                  cumulativeSum += parseFloat(data[i].priceInvoice);
                              }
                              // Push the accumulated sum for the last day
                              if (currentDate !== null) {
                                  chart_plot_adp_day_ota_data.push([new Date(currentDate).getTime(), cumulativeSum]);
                              }
                              // Sort the data based on timestamp
                              chart_plot_adp_day_ota_data.sort(function (a, b) {
                                  return a[0] - b[0];
                              });
                              // Set min and max values for x-axis
                              chart_plot_adp_day_ota_settings.xaxis.min = chart_plot_adp_day_ota_data[0][0];
                              chart_plot_adp_day_ota_settings.xaxis.max = chart_plot_adp_day_ota_data[chart_plot_adp_day_ota_data.length - 1][0];
                              // Plot the chart
                              $.plot($("#chart_plot_adp_day_ota"), [{
                                  label: "ADP PER DAY",
                                  data: chart_plot_adp_day_ota_data,
                                  lines: {
                                      fillColor: "rgb(44, 114, 130, 0.12)"
                                  },
                                  points: {
                                      fillColor: "#fff"
                                  }
                              }], chart_plot_adp_day_ota_settings);
                          } else {
                              console.warn('Empty or invalid data received from the server.');
                          }
                      },
                      error: function (error) {
                          console.error('Error fetching data:', error);
                      }
                  });
                }
                // Add tooltip functionality
                var previousPoint = null;
                $("#chart_plot_adp_day_ota").bind("plothover", function (event, pos, item) {
                  if (item) {
                    if (previousPoint != item.dataIndex) {
                      previousPoint = item.dataIndex;
                      $("#flot-tooltip").remove();
                      var x = item.datapoint[0].toFixed(2);
                      var y = item.datapoint[1].toFixed(2);
                      showTooltip(item.pageX, item.pageY, x, y);
                    }
                  } else {
                    $("#flot-tooltip").remove();
                    previousPoint = null;
                  }
                });
                function showTooltip(x, y, xValue, yValue) {
                  $('<div id="flot-tooltip">' + yValue + '</div>').css({
                    position: 'absolute',
                    display: 'none',
                    top: y - 40,
                    left: x - 30,
                    border: '1px solid #fdd',
                    padding: '2px',
                    'background-color': '#fee',
                    opacity: 0.80
                  }).appendTo("body").fadeIn(200);
                }
              }
              // Call init_flot_chart_adp_day_ota every second
              setInterval(init_flot_chart_adp_day_ota, 3000);
              init_flot_chart_adp_day_ota();
            </script>
            <!-- DIAGRAM ADP OTA -->
            <script type="text/javascript">
              // Set default dates
              var today = new Date();
              var dd = String(today.getDate()).padStart(2, '0');
              var mm = String(today.getMonth() + 1).padStart(2, '0');
              var yyyy = today.getFullYear();
              today = yyyy + '-' + mm + '-' + dd;
              document.getElementById('startDateReport').value = today;
              document.getElementById('endDateReport').value = today;
              console.log("Default Dates:", today);
              var table = $('#datatable-buttons-report').DataTable({
                  dom: "lBfrtip",
                  buttons: [
                      { extend: "copy", className: "btn-sm" },
                      { extend: "csv", className: "btn-sm" },
                      { extend: "excel", className: "btn-sm" },
                      { extend: "pdfHtml5", className: "btn-sm" },
                      { extend: "print", className: "btn-sm" },
                  ],
                  lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                  responsive: false,
                  ajax: {
                      url: '<?php echo base_url('cms/home/ajaxReport/'.$idBusiness.'/') ?>',
                      data: function (d) {
                          d.startDateReport = document.getElementById('startDateReport').value;
                          d.endDateReport = document.getElementById('endDateReport').value;
                      },
                      type: 'POST',
                      dataSrc: function (json) {
                          // console.log("Ajax Success Response:", json);
                          return json; // Assuming the data is directly in the array without a 'data' property
                      }
                  },
                  order: [[ 1, 'desc' ]],
                  columns: [
                      { data: null, render: function (data, type, row, meta) { return meta.row + 1; }, orderable: true },
                      { data: 'idBooking' },
                      { data: 'idInvoice' },
                      { data: 'firstnameBooking' },
                      { data: 'segmentBooking' },
                      { data: 'companyBooking' },
                      { data: 'nmKaryawan' },
                      { data: 'roomtypeBooking' },
                      { data: 'arrivalBooking' },
                      { data: 'nightBooking' },
                      { data: 'paxBooking' },
                      { data: 'statusBooking' },
                      // { data: 'extrabedBooking' },
                      { data: 'ratecodeBooking' },
                      { data: 'totalrateBooking' },
                      { data: 'rateafterdiscountBooking' },
                      // { data: 'chargeBooking' },
                      // { data: 'additionalBooking' },
                      { data: 'paymentBooking' },
                      { data: 'statuspayBooking' },
                      { data: 'ketInvoice' },
                      { data: 'createdAtInvoice' },
                      // { data: 'refInvoice' },
                      { data: 'priceInvoice' },
                      { data: 'currencyBooking' },
                      // { data: 'idnumberBooking' },
                      { data: 'emailBooking' },
                      // { data: 'mobileBooking' },
                      { data: 'nationalityBooking' },
                  ],
                  initComplete: function () {
                    var api = this.api();
                    api.ajax.reload(function (json) {
                      var result = json;
                      var tableBody = document.querySelector(".report tbody");
                      // Clear any previous content
                      tableBody.innerHTML = '';
                      var totalAmount = 0; // Variable to keep track of the total amount
                      // Assuming 'result' is an array of objects
                      result.forEach(function(item) {
                        var tr = document.createElement('tr');
                        var tdidBooking = document.createElement('td');
                        tdidBooking.textContent = item.idBooking;
                        var tdidInvoice = document.createElement('td');
                        tdidInvoice.textContent = item.idInvoice;
                        var tdfirstnameBooking = document.createElement('td');
                        tdfirstnameBooking.textContent = item.firstnameBooking;
                        var tdsegmentBooking = document.createElement('td');
                        tdsegmentBooking.textContent = item.segmentBooking;
                        var tdcompanyBooking = document.createElement('td');
                        tdcompanyBooking.textContent = item.companyBooking;
                        var tdnmKaryawan = document.createElement('td');
                        tdnmKaryawan.textContent = item.nmKaryawan;
                        var tdroomtypeBooking = document.createElement('td');
                        tdroomtypeBooking.textContent = item.roomtypeBooking;
                        var tdarrivalBooking = document.createElement('td');
                        tdarrivalBooking.textContent = item.arrivalBooking;
                        var tdnightBooking = document.createElement('td');
                        tdnightBooking.textContent = item.nightBooking;
                        var tdpaxBooking = document.createElement('td');
                        tdpaxBooking.textContent = item.paxBooking;
                        var tdstatusBooking = document.createElement('td');
                        tdstatusBooking.textContent = item.statusBooking;
                        var tdextrabedBooking = document.createElement('td');
                        tdextrabedBooking.textContent = item.extrabedBooking;
                        var tdratecodeBooking = document.createElement('td');
                        tdratecodeBooking.textContent = item.ratecodeBooking;
                        var tdtotalrateBooking = document.createElement('td');
                        tdtotalrateBooking.textContent = item.totalrateBooking;
                        var tdrateafterdiscountBooking = document.createElement('td');
                        tdrateafterdiscountBooking.textContent = item.rateafterdiscountBooking;
                        var tdchargeBooking = document.createElement('td');
                        tdchargeBooking.textContent = item.chargeBooking;
                        var tdadditionalBooking = document.createElement('td');
                        tdadditionalBooking.textContent = item.additionalBooking;
                        var tdpaymentBooking = document.createElement('td');
                        tdpaymentBooking.textContent = item.paymentBooking;
                        var tdstatuspayBooking = document.createElement('td');
                        tdstatuspayBooking.textContent = item.statuspayBooking;
                        var tdketInvoice = document.createElement('td');
                        tdketInvoice.textContent = item.ketInvoice;
                        var tdcreatedAtInvoice = document.createElement('td');
                        tdcreatedAtInvoice.textContent = item.createdAtInvoice;
                        var tdrefInvoice = document.createElement('td');
                        tdrefInvoice.textContent = item.refInvoice;
                        // Assuming 'item.priceInvoice' is a number
                        var formattedPrice = parseFloat(item.priceInvoice).toLocaleString('id-ID', {
                          style: 'currency',
                          currency: 'IDR'
                        });
                        var tdpriceInvoice = document.createElement('td');
                        tdpriceInvoice.textContent = formattedPrice;
                        var tdcurrencyBooking = document.createElement('td');
                        tdcurrencyBooking.textContent = item.currencyBooking;
                        var tdidnumberBooking = document.createElement('td');
                        tdidnumberBooking.textContent = item.idnumberBooking;
                        var tdemailBooking = document.createElement('td');
                        tdemailBooking.textContent = item.emailBooking;
                        var tdmobileBooking = document.createElement('td');
                        tdmobileBooking.textContent = item.mobileBooking;
                        var tdnationalityBooking = document.createElement('td');
                        tdnationalityBooking.textContent = item.nationalityBooking;
                        tr.appendChild(tdidBooking);
                        tr.appendChild(tdidInvoice);
                        tr.appendChild(tdfirstnameBooking);
                        tr.appendChild(tdsegmentBooking);
                        tr.appendChild(tdcompanyBooking);
                        tr.appendChild(tdnmKaryawan);
                        tr.appendChild(tdstatusBooking);
                        tr.appendChild(tdroomtypeBooking);
                        tr.appendChild(tdarrivalBooking);
                        tr.appendChild(tdnightBooking);
                        tr.appendChild(tdpaxBooking);
                        tr.appendChild(tdextrabedBooking);
                        tr.appendChild(tdratecodeBooking);
                        tr.appendChild(tdtotalrateBooking);
                        tr.appendChild(tdrateafterdiscountBooking);
                        tr.appendChild(tdchargeBooking);
                        tr.appendChild(tdadditionalBooking);
                        tr.appendChild(tdpaymentBooking);
                        tr.appendChild(tdstatuspayBooking);
                        tr.appendChild(tdketInvoice);
                        tr.appendChild(tdcreatedAtInvoice);
                        tr.appendChild(tdrefInvoice);
                        tr.appendChild(tdpriceInvoice);
                        tr.appendChild(tdcurrencyBooking);
                        tr.appendChild(tdidnumberBooking);
                        tr.appendChild(tdemailBooking);
                        tr.appendChild(tdmobileBooking);
                        tr.appendChild(tdnationalityBooking);
                        // Calculate the total amount and update it for each row
                        totalAmount += parseFloat(item.priceInvoice);
                        tableBody.appendChild(tr);
                      });
                      // Display the total in a separate row at the end of the table
                      var trTotal = document.createElement('tr');
                      var tdTotalLabel = document.createElement('td');
                      tdTotalLabel.colSpan = 7; // Set colSpan to the total number of columns
                      tdTotalLabel.textContent = 'Total Amount';
                      trTotal.appendChild(tdTotalLabel);
                      var tdTotalAmount = document.createElement('td');
                      tdTotalAmount.textContent = totalAmount.toLocaleString('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                      });
                      trTotal.appendChild(tdTotalAmount);
                      tableBody.appendChild(trTotal);
                    }, false);
                  }
              });
              // Add an event listener for the form submission
              document.getElementById('dateIntervalFormReport').addEventListener('submit', function (event) {
                  event.preventDefault();
                  table.ajax.reload();
              });
            </script>
            <script src="https://www.gstatic.com/firebasejs/7.3.0/firebase-app.js"></script>
            <script src="https://www.gstatic.com/firebasejs/7.3.0/firebase-firestore.js"></script>
            <script type="text/javascript">
              // Initialize Firebase
              var config = {
                apiKey: "AIzaSyAoj4LEUsXjy_jbIA3qV1KJ2k-AXIPT2JQ",
                authDomain: "sahira-hotels.firebaseapp.com",
                projectId: "sahira-hotels",
                storageBucket: "sahira-hotels.appspot.com",
                messagingSenderId: "696853318422",
                appId: "1:696853318422:web:6c0d40b9cb82309a471e37",
                measurementId: "G-V601MGELKJ",
                vapidKey: "BLiwxCPXurhlDC0imZXp29yh8CGv9Gful419-cD47iP7YoWkwOSe0mZxJdDuGBjyevx5UYfl8SMue5NGJCyoysE"
              };
              firebase.initializeApp(config);
              const database = firebase.firestore();
              const chatsCollection = database.collection('chats');
            </script>
            <script type="text/javascript">
              if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('<?php echo base_url() ?>firebase-messaging-sw.js')
                .then(function(registration) {
                  console.log('Service Worker registered successfully:', registration);
                });
              } else {
                console.warn('Service Worker is not supported in this browser');
              }
            </script>
            <script type="module">
              import { initializeApp } from "https://www.gstatic.com/firebasejs/9.7.0/firebase-app.js";
              import { getMessaging, getToken, onMessage } from "https://www.gstatic.com/firebasejs/9.7.0/firebase-messaging.js";

              // Konfigurasi Firebase
              const firebaseConfig = {
                apiKey: "AIzaSyAoj4LEUsXjy_jbIA3qV1KJ2k-AXIPT2JQ",
                authDomain: "sahira-hotels.firebaseapp.com",
                projectId: "sahira-hotels",
                storageBucket: "sahira-hotels.appspot.com",
                messagingSenderId: "696853318422",
                appId: "1:696853318422:web:6c0d40b9cb82309a471e37",
                measurementId: "G-V601MGELKJ",
                vapidKey: "BLiwxCPXurhlDC0imZXp29yh8CGv9Gful419-cD47iP7YoWkwOSe0mZxJdDuGBjyevx5UYfl8SMue5NGJCyoysE",
              };

              // Inisialisasi Firebase
              const firebaseApp = initializeApp(firebaseConfig);

              // Dapatkan instance Messaging
              const messaging = getMessaging(firebaseApp);

              // Minta izin untuk notifikasi
              Notification.requestPermission()
                .then((result) => {
                  if (result === "granted") {
                    console.log("Notification permission granted.");

                    // Dapatkan token FCM
                    getToken(messaging, { vapidKey: firebaseConfig.vapidKey })
                      .then((tokenPushNotification) => {
                        if (tokenPushNotification) {
                          console.log("Token berhasil diperoleh:", tokenPushNotification);

                          // Kirim token ke server
                          $.ajax({
                            url: "<?php echo base_url('cms/home/ajaxtokenPushNotification'); ?>",
                            type: "POST",
                            data: {
                              tokenPushNotification: tokenPushNotification,
                              idUser: "<?php echo $this->session->userdata('idUser'); ?>",
                            },
                            success: function () {
                              console.log("Token berhasil didaftarkan ke server.");
                            },
                            error: function (error) {
                              console.error("Gagal mendaftarkan token:", error);
                            },
                          });
                        } else {
                          console.log("Token FCM tidak tersedia.");
                        }
                      })
                      .catch((err) => {
                        console.error("Gagal mendapatkan token FCM:", err);
                      });

                    // Tangani pesan saat aplikasi aktif (foreground)
                    onMessage(messaging, (payload) => {
                      console.log("Pesan diterima di foreground:", payload);

                      const { transaction, notification } = payload.data || {};
                      const audio = document.getElementById("notificationSound");
                      if (audio) audio.play();

                      switch (transaction) {
                        case "reservation":
                          handleReservation(notification, payload);
                          break;
                        case "fnb-room":
                          handleFnbOrder(notification, payload, "Room Number");
                          break;
                        case "fnb-table":
                          handleFnbOrder(notification, payload, "Table Number");
                          break;
                        case "payment":
                          handlePayment(notification, payload);
                          break;
                        case "livechat":
                          handleLiveChat();
                          break;
                        default:
                          console.warn("Jenis transaksi tidak dikenal:", transaction);
                      }
                    });
                  } else {
                    console.warn("Izin notifikasi tidak diberikan.");
                  }
                })
                .catch((err) => {
                  console.error("Gagal meminta izin notifikasi:", err);
                });

              // Fungsi penanganan pesan berdasarkan jenis transaksi
              function handleReservation(notification, payload) {
                const arrayPayload = JSON.parse(payload.data.value);
                Swal.fire({
                  title: `New Reservation<br>${notification.title} a/n ${arrayPayload.customerName}`,
                  html: `<h4>Type Room: ${notification.body}</h4>
                         <h5>Arrival: ${arrayPayload.arrivalDate} & Departure: ${arrayPayload.departureDate}</h5>`,
                  icon: "info",
                  confirmButtonText: "Close",
                  allowHtml: true,
                  willClose: () => location.reload(),
                });
              }

              function handleFnbOrder(notification, payload, typeLabel) {
                const arrayPayload = JSON.parse(payload.data.value);
                let menuItemsHTML = "";
                arrayPayload.forEach((menuItem) => {
                  menuItemsHTML += `${menuItem.menuName}: ${menuItem.updatedQty}<br>-note:(${menuItem.optional})<br><br>`;
                });

                Swal.fire({
                  title: `New Order<br>${notification.title}`,
                  html: `<h4>${typeLabel}: ${notification.body}</h4>
                         <h5>${menuItemsHTML}</h5>`,
                  icon: "info",
                  confirmButtonText: "Close",
                  allowHtml: true,
                  willClose: () => location.reload(),
                });
              }

              function handlePayment(notification, payload) {
                Swal.fire({
                  title: `New Payment<br>${notification.title}`,
                  html: `<h4>Room Number: ${notification.body}</h4>
                         <h5><a target="_blank" href="${payload.data.url}">Click here to see payment</a></h5>`,
                  icon: "info",
                  confirmButtonText: "Close",
                  allowHtml: true,
                  willClose: () => location.reload(),
                });
              }

              function handleLiveChat() {
                console.log("Handling live chat messages...");
                // Tambahkan implementasi live chat sesuai kebutuhan
                chatsCollection.onSnapshot(snapshot => {
                  const chatContainer = document.getElementById('chat-container');
                  chatContainer.innerHTML = ''; // Clear previous messages
                  const sortedDocs = snapshot.docs.sort((a, b) => {
                    const latestTimestampA = getLatestTimestamp(a.data().history);
                    const latestTimestampB = getLatestTimestamp(b.data().history);
                    return latestTimestampB - latestTimestampA;
                  });
                  sortedDocs.forEach(doc => {
                    const id = doc.id; // Get the document ID
                    const data = doc.data();
                    const latestMessage = data.history.length > 0 ? data.history[0] : null;
                    // Iterate over the keys of the data object and render each message
                    Object.keys(data).forEach(key => {
                      const message = data[key]; // Get the value corresponding to the key
                      const divMailList = document.createElement('div');
                      divMailList.className = 'mail_list';
                      const divRight = document.createElement('div');
                      divRight.className = 'right';
                      const h3 = document.createElement('h3');
                      const small = document.createElement('small');
                      const p = document.createElement('p');
                      // Render the message value
                      h3.textContent = id;
                      if (latestMessage) {
                        small.textContent = latestMessage.to_created_at;
                        if (latestMessage.status === 'read') {
                          p.style.color = 'black';
                          p.textContent = '-';
                        } else {
                          p.style.color = 'red';
                          p.textContent = 'New Message';
                        }
                      }
                      divRight.appendChild(h3);
                      h3.appendChild(small);
                      divRight.appendChild(p);
                      divMailList.appendChild(divRight);
                      chatContainer.appendChild(divMailList);
                      divMailList.onclick = function() {
                        renderChatMessages(data.history || [], id);
                      }
                    });
                    // console.log("Document ID:", id);
                    // console.log("Document Data:", data);
                  });
                  // Scroll to the bottom of the chat container to show the latest message
                  chatContainer.scrollTop = chatContainer.scrollHeight;
                });
              }

              <?php
                if($this->session->userdata('dep') == 9) {
              ?>
                // Function to render chat messages in the chat container
                function renderChatMessages(messages, id) {
                  const chatContainer = document.getElementById('chat-container-business');
                  chatContainer.innerHTML = ''; // Clear previous messages
                  messages.forEach(message => {
                    const divMailList = document.createElement('div');
                    divMailList.className = 'mail_list';
                    const divRight = document.createElement('div');
                    divRight.className = 'right';
                    const h3 = document.createElement('h3');
                    const small = document.createElement('small');
                    const p = document.createElement('p');
                    // Assuming message is an object with properties 'to', 'to_created_at', and 'status'
                    h3.textContent = message.to + ' ';
                    small.textContent = message.to_created_at;
                    h3.appendChild(small);
                    p.textContent = message.status;
                    if (message.status === 'read') {
                      p.style.color = 'black';
                      p.textContent = '-';
                    } else {
                      p.style.color = 'red';
                      p.textContent = 'New Message';
                    }
                    divRight.appendChild(h3);
                    divRight.appendChild(p);
                    divMailList.appendChild(divRight);
                    chatContainer.appendChild(divMailList);
                    // Create a closure to capture message variables
                    (function(message) {
                      divMailList.onclick = function() {
                        const chatToContainer = document.createElement('div');
                        chatToContainer.id = 'chat-container-to-business';
                        chatToContainer.style.backgroundColor = '#fff';
                        chatToContainer.style.color = 'black';
                        chatToContainer.style.padding = '10px';
                        chatToContainer.style.borderRadius = '10px';
                        const divMailList = document.createElement('div');
                        divMailList.className = 'mail_list';
                        const divRight = document.createElement('div');
                        divRight.className = 'right';
                        const h3 = document.createElement('h3');
                        const small = document.createElement('small');
                        const p = document.createElement('p');
                        // Assuming message is an object with properties 'to', 'to_created_at', and 'status'
                        h3.textContent = id + ' ';
                        small.textContent = message.to_created_at;
                        h3.appendChild(small);
                        p.textContent = message.to;
                        divRight.appendChild(h3);
                        divRight.appendChild(p);
                        divMailList.appendChild(divRight);
                        chatToContainer.appendChild(divMailList);
                        const mailView = document.getElementById('chat_view');
                        mailView.innerHTML = '';
                        mailView.appendChild(chatToContainer);
                        // console.log(message.to, message.to_created_at, message.status);
                        var to_data = message.to_data;
                        const additionalDiv = document.createElement('div');
                        additionalDiv.style.height = '40vh';
                        mailView.appendChild(additionalDiv);
                        to_data.forEach(chats => {
                          // console.log(chats.text, chats.created_at);
                          console.log("chats", chats);
                          // Create elements for the mail view
                          const inboxBody = document.createElement('div');
                          inboxBody.className = 'inbox-body';
                          const repliedBody = document.createElement('div');
                          repliedBody.className = 'replied-body';
                          const mailHeadingRow = document.createElement('div');
                          mailHeadingRow.className = 'mail_heading row';
                          const mailHeadingRowReplied = document.createElement('div');
                          mailHeadingRowReplied.className = 'mail_heading row';
                          const colMd4 = document.createElement('div');
                          colMd4.className = 'col-md-4';
                          const dateParagraph = document.createElement('small');
                          dateParagraph.className = 'date';
                          if(chats.created_at) {
                            dateParagraph.textContent = transformDate(chats.created_at);
                          }
                          const viewMail = document.createElement('div');
                          viewMail.className = 'view-mail';
                          const viewMailContent = document.createElement('p');
                          viewMailContent.textContent = chats.text;
                          viewMailContent.style.fontWeight = '600';
                          viewMail.appendChild(viewMailContent);
                          const viewMailAgentReplied = document.createElement('div');
                          viewMailAgentReplied.className = 'mail_heading';
                          const agentRepliesParagraph = document.createElement('p');
                          agentRepliesParagraph.style.textAlign = 'right';
                          agentRepliesParagraph.style.marginBottom = '0px';
                          agentRepliesParagraph.style.fontWeight = '600';
                          viewMailAgentReplied.appendChild(agentRepliesParagraph);
                          if(chats.agent) {
                            agentRepliesParagraph.textContent = chats.agent;
                          }
                          const dateRepliesParagraph = document.createElement('small');
                          dateRepliesParagraph.style.float = 'right';
                          if(chats.replied_at) {
                            dateRepliesParagraph.textContent = transformDate(chats.replied_at);
                          }
                          const viewMailReplied = document.createElement('div');
                          viewMailReplied.className = 'view-mail';
                          const viewRepliesContent = document.createElement('p');
                          viewRepliesContent.textContent = chats.replies;
                          viewRepliesContent.style.textAlign = 'right';
                          viewRepliesContent.style.fontWeight = '600';
                          viewMailReplied.appendChild(viewRepliesContent);
                          // Append elements to their respective parents
                          inboxBody.appendChild(dateParagraph);
                          inboxBody.appendChild(mailHeadingRow);
                          inboxBody.appendChild(viewMail);
                          mailView.appendChild(inboxBody);
                          repliedBody.appendChild(viewMailAgentReplied);
                          repliedBody.appendChild(dateRepliesParagraph);
                          repliedBody.appendChild(mailHeadingRowReplied);
                          repliedBody.appendChild(viewMailReplied);
                          mailView.appendChild(repliedBody);

                          mailView.style.display = 'block';
                        })
                        // console.log("to_data", to_data);
                        const insertForm = document.createElement('div');
                        const messageInput = document.createElement('textarea');
                        // messageInput.type = 'text';
                        messageInput.id = 'message-input';
                        messageInput.rows = '5';
                        messageInput.className = 'form-control';
                        messageInput.placeholder = 'Type your message...';
                        const sendButton = document.createElement('button');
                        sendButton.className = 'btn btn-warning btn-lg';
                        sendButton.textContent = 'Send';
                        sendButton.onclick = function() {
                          sendMessage(message.to, id);
                        };
                        insertForm.appendChild(messageInput);
                        insertForm.appendChild(sendButton);
                        mailView.appendChild(insertForm);
                        mailView.style.display = 'block';
                      };
                    })(message);
                  });
                  // console.log("messages", messages);
                  // Scroll to the bottom of the chat container to show the latest message
                  chatContainer.scrollTop = chatContainer.scrollHeight;
                }
                // Function to retrieve existing chat messages
                function getChatMessages() {
                  chatsCollection.onSnapshot(snapshot => {
                    const chatContainer = document.getElementById('chat-container');
                    chatContainer.innerHTML = ''; // Clear previous messages
                    const sortedDocs = snapshot.docs.sort((a, b) => {
                      const latestTimestampA = getLatestTimestamp(a.data().history);
                      const latestTimestampB = getLatestTimestamp(b.data().history);
                      return latestTimestampB - latestTimestampA;
                    });
                    sortedDocs.forEach(doc => {
                      const id = doc.id; // Get the document ID
                      const data = doc.data();
                      const latestMessage = data.history.length > 0 ? data.history[0] : null;
                      // Iterate over the keys of the data object and render each message
                      Object.keys(data).forEach(key => {
                        const message = data[key]; // Get the value corresponding to the key
                        const divMailList = document.createElement('div');
                        divMailList.className = 'mail_list';
                        const divRight = document.createElement('div');
                        divRight.className = 'right';
                        const h3 = document.createElement('h3');
                        const small = document.createElement('small');
                        const p = document.createElement('p');
                        // Render the message value
                        h3.textContent = id;
                        if (latestMessage) {
                          small.textContent = latestMessage.to_created_at;
                          if (latestMessage.status === 'read') {
                            p.style.color = 'black';
                            p.textContent = '-';
                          } else {
                            p.style.color = 'red';
                            p.textContent = 'New Message';
                          }
                        }
                        divRight.appendChild(h3);
                        h3.appendChild(small);
                        divRight.appendChild(p);
                        divMailList.appendChild(divRight);
                        chatContainer.appendChild(divMailList);
                        divMailList.onclick = function() {
                          renderChatMessages(data.history || [], id);
                        }
                      });
                      // console.log("Document ID:", id);
                      // console.log("Document Data:", data);
                    });
                    // Scroll to the bottom of the chat container to show the latest message
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                  });
                }
                // Function to handle sending a message when the button is clicked
                function sendMessage(toMessage, id) {
                  const now = new Date();
                  const year = now.getFullYear();
                  const month = String(now.getMonth() + 1).padStart(2, '0');
                  const day = String(now.getDate()).padStart(2, '0');
                  const hours = String(now.getHours()).padStart(2, '0');
                  const minutes = String(now.getMinutes()).padStart(2, '0');
                  const seconds = String(now.getSeconds()).padStart(2, '0');

                  const messageInput = document.getElementById('message-input');
                  const message = messageInput.value.trim();
                  if (message !== '') {
                    chatsCollection.doc(id).get()
                    .then(snapshot => {
                      if (snapshot.exists) {
                        const data = snapshot.data();
                        const existingItemIndex = data.history.findIndex(item => item.to === toMessage);
                        // If this.toMessage already exists, update to_data only
                        const updatedHistory = data.history.map((item, index) => {
                          if (index === existingItemIndex) {
                            return {
                              ...item,
                              to_created_at: `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`,
                              status: 'read',
                              to_data: [
                                ...item.to_data,
                                {
                                  text: '',
                                  replied_at: `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`,
                                  replies: message,
                                  agent: 'Salam Djourney Official'
                                }
                              ]
                            };
                          }
                          return item;
                        });
                        // console.log(updatedHistory);
                        chatsCollection.doc(id).update({
                          history: updatedHistory
                        })
                        .then(() => {
                          console.log("Message sent successfully", updatedHistory);
                          // Filter data.history to include only toMessage
                          const filteredHistory = updatedHistory.filter(item => item.to === toMessage);
                          // Optionally, you can update the UI to show the new message immediately
                          renderChatToMessages(filteredHistory || [], id);
                        })
                        .catch(error => {
                          console.error("Error sending message: ", error);
                        });
                      } else {
                        console.log("No chat messages found");
                      }
                    })
                    .catch(error => {
                      console.error("Error getting chat messages: ", error);
                    });
                    messageInput.value = ''; // Clear the input field
                  }
                }
                function renderChatToMessages(messages, id) {
                  const chatContainer = document.getElementById('chat-container-business');
                  chatContainer.innerHTML = ''; // Clear previous messages
                  messages.forEach(message => {
                    const divMailList = document.createElement('div');
                    divMailList.className = 'mail_list';
                    const divRight = document.createElement('div');
                    divRight.className = 'right';
                    const h3 = document.createElement('h3');
                    const small = document.createElement('small');
                    const p = document.createElement('p');
                    // Assuming message is an object with properties 'to', 'to_created_at', and 'status'
                    h3.textContent = message.to + ' ';
                    small.textContent = message.to_created_at;
                    h3.appendChild(small);
                    p.textContent = message.status;
                    if (message.status === 'read') {
                      p.style.color = 'black';
                      p.textContent = '-';
                    } else {
                      p.style.color = 'red';
                      p.textContent = 'New Message';
                    }
                    divRight.appendChild(h3);
                    divRight.appendChild(p);
                    divMailList.appendChild(divRight);
                    chatContainer.appendChild(divMailList);
                    // Create a closure to capture message variables
                    (function(message) {
                      const chatToContainer = document.createElement('div');
                      chatToContainer.id = 'chat-container-business';
                      chatToContainer.style.backgroundColor = '#fff';
                      chatToContainer.style.color = 'black';
                      chatToContainer.style.padding = '10px';
                      chatToContainer.style.borderRadius = '10px';
                      const divMailList = document.createElement('div');
                      divMailList.className = 'mail_list';
                      const divRight = document.createElement('div');
                      divRight.className = 'right';
                      const h3 = document.createElement('h3');
                      const small = document.createElement('small');
                      const p = document.createElement('p');
                      // Assuming message is an object with properties 'to', 'to_created_at', and 'status'
                      h3.textContent = id + ' ';
                      small.textContent = message.to_created_at;
                      h3.appendChild(small);
                      p.textContent = message.to;
                      divRight.appendChild(h3);
                      divRight.appendChild(p);
                      divMailList.appendChild(divRight);
                      chatToContainer.appendChild(divMailList);
                      const mailView = document.getElementById('chat_view');
                      mailView.innerHTML = '';
                      mailView.appendChild(chatToContainer);
                      // console.log(message.to, message.to_created_at, message.status);
                      var to_data = message.to_data;
                      to_data.forEach(chats => {
                        // console.log(chats.text, chats.created_at);
                        console.log("chats", chats);
                        // Create elements for the mail view
                        const inboxBody = document.createElement('div');
                        inboxBody.className = 'inbox-body';
                        const repliedBody = document.createElement('div');
                        repliedBody.className = 'replied-body';
                        const mailHeadingRow = document.createElement('div');
                        mailHeadingRow.className = 'mail_heading row';
                        const mailHeadingRowReplied = document.createElement('div');
                        mailHeadingRowReplied.className = 'mail_heading row';
                        const colMd4 = document.createElement('div');
                        colMd4.className = 'col-md-4';
                        const dateParagraph = document.createElement('small');
                        dateParagraph.className = 'date';
                        if(chats.created_at) {
                          dateParagraph.textContent = transformDate(chats.created_at);
                        }
                        const viewMail = document.createElement('div');
                        viewMail.className = 'view-mail';
                        const viewMailContent = document.createElement('p');
                        viewMailContent.textContent = chats.text;
                        viewMailContent.style.fontWeight = '600';
                        viewMail.appendChild(viewMailContent);
                        const viewMailAgentReplied = document.createElement('div');
                        viewMailAgentReplied.className = 'mail_heading';
                        const agentRepliesParagraph = document.createElement('p');
                        agentRepliesParagraph.style.textAlign = 'right';
                        agentRepliesParagraph.style.marginBottom = '0px';
                        agentRepliesParagraph.style.fontWeight = '600';
                        viewMailAgentReplied.appendChild(agentRepliesParagraph);
                        if(chats.agent) {
                          agentRepliesParagraph.textContent = chats.agent;
                        }
                        const dateRepliesParagraph = document.createElement('small');
                        dateRepliesParagraph.style.float = 'right';
                        if(chats.replied_at) {
                          dateRepliesParagraph.textContent = transformDate(chats.replied_at);
                        }
                        const viewMailReplied = document.createElement('div');
                        viewMailReplied.className = 'view-mail';
                        const viewRepliesContent = document.createElement('p');
                        viewRepliesContent.textContent = chats.replies;
                        viewRepliesContent.style.textAlign = 'right';
                        viewRepliesContent.style.fontWeight = '600';
                        viewMailReplied.appendChild(viewRepliesContent);
                        // Append elements to their respective parents
                        inboxBody.appendChild(dateParagraph);
                        inboxBody.appendChild(mailHeadingRow);
                        inboxBody.appendChild(viewMail);
                        mailView.appendChild(inboxBody);

                        repliedBody.appendChild(viewMailAgentReplied);
                        repliedBody.appendChild(dateRepliesParagraph);
                        repliedBody.appendChild(mailHeadingRowReplied);
                        repliedBody.appendChild(viewMailReplied);
                        mailView.appendChild(repliedBody);

                        mailView.style.display = 'block';
                      })
                      // console.log("to_data", to_data);
                      const insertForm = document.createElement('div');
                      const messageInput = document.createElement('textarea');
                      // messageInput.type = 'text';
                      messageInput.id = 'message-input';
                      messageInput.rows = '5';
                      messageInput.className = 'form-control';
                      messageInput.placeholder = 'Type your message...';
                      const sendButton = document.createElement('button');
                      sendButton.className = 'btn btn-warning btn-lg';
                      sendButton.textContent = 'Send';
                      sendButton.onclick = function() {
                        sendMessage(message.to, id);
                      };
                      insertForm.appendChild(messageInput);
                      insertForm.appendChild(sendButton);
                      mailView.appendChild(insertForm);
                      mailView.style.display = 'block';
                    })(message);
                  });
                  // console.log("messages", messages);
                  // Scroll to the bottom of the chat container to show the latest message
                  chatContainer.scrollTop = chatContainer.scrollHeight;
                }
                // Call getChatMessages when the page loads to retrieve existing messages
                document.addEventListener('DOMContentLoaded', getChatMessages);
              <?php } ?>
              <?php
                if($this->session->userdata('dep') == 8) {
              ?>
                // Function to render chat messages in the chat container
                function renderChatMessages(messages, id) {
                  // Filter messages to exclude those from Salam Djourney Official
                  const filteredMessages = messages.filter(message => message.to !== 'Salam Djourney Official' && message.to == '<?php echo $this->session->userdata('business'); ?>');
                  const chatContainer = document.getElementById('chat-container-business');
                  chatContainer.innerHTML = ''; // Clear previous messages
                  filteredMessages.forEach(message => {
                    const divMailList = document.createElement('div');
                    divMailList.className = 'mail_list';
                    const divRight = document.createElement('div');
                    divRight.className = 'right';
                    const h3 = document.createElement('h3');
                    const small = document.createElement('small');
                    const p = document.createElement('p');
                    // Assuming message is an object with properties 'to', 'to_created_at', and 'status'
                    h3.textContent = message.to + ' ';
                    small.textContent = message.to_created_at;
                    h3.appendChild(small);
                    p.textContent = message.status;
                    if (message.status === 'read') {
                      p.style.color = 'black';
                      p.textContent = '-';
                    } else {
                      p.style.color = 'red';
                      p.textContent = 'New Message';
                    }
                    divRight.appendChild(h3);
                    divRight.appendChild(p);
                    divMailList.appendChild(divRight);
                    chatContainer.appendChild(divMailList);
                    // Create a closure to capture message variables
                    (function(message) {
                      divMailList.onclick = function() {
                        const chatToContainer = document.createElement('div');
                        chatToContainer.id = 'chat-container-to-business';
                        chatToContainer.style.backgroundColor = '#fff';
                        chatToContainer.style.color = 'black';
                        chatToContainer.style.padding = '10px';
                        chatToContainer.style.borderRadius = '10px';
                        const divMailList = document.createElement('div');
                        divMailList.className = 'mail_list';
                        const divRight = document.createElement('div');
                        divRight.className = 'right';
                        const h3 = document.createElement('h3');
                        const small = document.createElement('small');
                        const p = document.createElement('p');
                        // Assuming message is an object with properties 'to', 'to_created_at', and 'status'
                        h3.textContent = id + ' ';
                        small.textContent = message.to_created_at;
                        h3.appendChild(small);
                        p.textContent = message.to;
                        divRight.appendChild(h3);
                        divRight.appendChild(p);
                        divMailList.appendChild(divRight);
                        chatToContainer.appendChild(divMailList);
                        const mailView = document.getElementById('chat_view');
                        mailView.innerHTML = '';
                        mailView.appendChild(chatToContainer);
                        // console.log(message.to, message.to_created_at, message.status);
                        var to_data = message.to_data;
                        to_data.forEach(chats => {
                          // console.log(chats.text, chats.created_at);
                          console.log("chats", chats);
                          // Create elements for the mail view
                          const inboxBody = document.createElement('div');
                          inboxBody.className = 'inbox-body';
                          const repliedBody = document.createElement('div');
                          repliedBody.className = 'replied-body';
                          const mailHeadingRow = document.createElement('div');
                          mailHeadingRow.className = 'mail_heading row';
                          const mailHeadingRowReplied = document.createElement('div');
                          mailHeadingRowReplied.className = 'mail_heading row';
                          const colMd4 = document.createElement('div');
                          colMd4.className = 'col-md-4';
                          const dateParagraph = document.createElement('small');
                          dateParagraph.className = 'date';
                          if(chats.created_at) {
                            dateParagraph.textContent = transformDate(chats.created_at);
                          }
                          const viewMail = document.createElement('div');
                          viewMail.className = 'view-mail';
                          const viewMailContent = document.createElement('p');
                          viewMailContent.textContent = chats.text;
                          viewMailContent.style.fontWeight = '600';
                          viewMail.appendChild(viewMailContent);
                          const viewMailAgentReplied = document.createElement('div');
                          viewMailAgentReplied.className = 'mail_heading';
                          const agentRepliesParagraph = document.createElement('p');
                          agentRepliesParagraph.style.textAlign = 'right';
                          agentRepliesParagraph.style.marginBottom = '0px';
                          agentRepliesParagraph.style.fontWeight = '600';
                          viewMailAgentReplied.appendChild(agentRepliesParagraph);
                          if(chats.agent) {
                            agentRepliesParagraph.textContent = chats.agent;
                          }
                          const dateRepliesParagraph = document.createElement('small');
                          dateRepliesParagraph.style.float = 'right';
                          if(chats.replied_at) {
                            dateRepliesParagraph.textContent = transformDate(chats.replied_at);
                          }
                          const viewMailReplied = document.createElement('div');
                          viewMailReplied.className = 'view-mail';
                          const viewRepliesContent = document.createElement('p');
                          viewRepliesContent.textContent = chats.replies;
                          viewRepliesContent.style.textAlign = 'right';
                          viewRepliesContent.style.fontWeight = '600';
                          viewMailReplied.appendChild(viewRepliesContent);
                          // Append elements to their respective parents
                          inboxBody.appendChild(dateParagraph);
                          inboxBody.appendChild(mailHeadingRow);
                          inboxBody.appendChild(viewMail);
                          mailView.appendChild(inboxBody);

                          repliedBody.appendChild(viewMailAgentReplied);
                          repliedBody.appendChild(dateRepliesParagraph);
                          repliedBody.appendChild(mailHeadingRowReplied);
                          repliedBody.appendChild(viewMailReplied);
                          mailView.appendChild(repliedBody);

                          mailView.style.display = 'block';
                        })
                        // console.log("to_data", to_data);
                        const insertForm = document.createElement('div');
                        const messageInput = document.createElement('textarea');
                        // messageInput.type = 'text';
                        messageInput.id = 'message-input';
                        messageInput.rows = '5';
                        messageInput.className = 'form-control';
                        messageInput.placeholder = 'Type your message...';
                        const sendButton = document.createElement('button');
                        sendButton.className = 'btn btn-warning btn-lg';
                        sendButton.textContent = 'Send';
                        sendButton.onclick = function() {
                          sendMessage(message.to, id);
                        };
                        insertForm.appendChild(messageInput);
                        insertForm.appendChild(sendButton);
                        mailView.appendChild(insertForm);
                        mailView.style.display = 'block';
                      };
                    })(message);
                  });
                  // console.log("messages", messages);
                  // Scroll to the bottom of the chat container to show the latest message
                  chatContainer.scrollTop = chatContainer.scrollHeight;
                }
                // Function to retrieve existing chat messages
                function getChatMessages() {
                  chatsCollection.onSnapshot(snapshot => {
                    const chatContainer = document.getElementById('chat-container');
                    chatContainer.innerHTML = ''; // Clear previous messages
                    const sortedDocs = snapshot.docs.sort((a, b) => {
                      const latestTimestampA = getLatestTimestamp(a.data().history);
                      const latestTimestampB = getLatestTimestamp(b.data().history);
                      return latestTimestampB - latestTimestampA;
                    });
                    sortedDocs.forEach(doc => {
                      const id = doc.id; // Get the document ID
                      const data = doc.data();
                      const latestMessage = data.history.length > 0 ? data.history[0] : null;
                      // Iterate over the keys of the data object and render each message
                      Object.keys(data).forEach(key => {
                        if (latestMessage.to === '<?php echo $this->session->userdata('business'); ?>') {
                          const message = data[key]; // Get the value corresponding to the key
                          const divMailList = document.createElement('div');
                          divMailList.className = 'mail_list';
                          const divRight = document.createElement('div');
                          divRight.className = 'right';
                          const h3 = document.createElement('h3');
                          const small = document.createElement('small');
                          const p = document.createElement('p');
                          // Render the message value
                          h3.textContent = id;
                          small.textContent = latestMessage.to_created_at;
                          if (latestMessage.status == 'read') {
                            p.style.color = 'black';
                            p.textContent = '-';
                          } else {
                            p.style.color = 'red';
                            p.textContent = 'New Message';
                          }
                          divRight.appendChild(h3);
                          h3.appendChild(small);
                          divRight.appendChild(p);
                          divMailList.appendChild(divRight);
                          chatContainer.appendChild(divMailList);
                          divMailList.onclick = function() {
                            renderChatMessages(data.history || [], id);
                          }
                        }
                      });
                      // console.log("Document ID:", id);
                      // console.log("Document Data:", data);
                    });
                    // Scroll to the bottom of the chat container to show the latest message
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                  });
                }
                // Function to handle sending a message when the button is clicked
                function sendMessage(toMessage, id) {
                  const now = new Date();
                  const year = now.getFullYear();
                  const month = String(now.getMonth() + 1).padStart(2, '0');
                  const day = String(now.getDate()).padStart(2, '0');
                  const hours = String(now.getHours()).padStart(2, '0');
                  const minutes = String(now.getMinutes()).padStart(2, '0');
                  const seconds = String(now.getSeconds()).padStart(2, '0');

                  const messageInput = document.getElementById('message-input');
                  const message = messageInput.value.trim();
                  if (message !== '') {
                    chatsCollection.doc(id).get()
                    .then(snapshot => {
                      if (snapshot.exists) {
                        const data = snapshot.data();
                        const existingItemIndex = data.history.findIndex(item => item.to === toMessage);
                        // If this.toMessage already exists, update to_data only
                        const updatedHistory = data.history.map((item, index) => {
                          if (index === existingItemIndex) {
                            return {
                              ...item,
                              to_created_at: `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`,
                              status: 'read',
                              to_data: [
                                ...item.to_data,
                                {
                                  text: '',
                                  replied_at: `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`,
                                  replies: message,
                                  agent: '<?php echo $this->session->userdata('nmKaryawan') ?>'
                                }
                              ]
                            };
                          }
                          return item;
                        });
                        // console.log(updatedHistory);
                        chatsCollection.doc(id).update({
                          history: updatedHistory
                        })
                        .then(() => {
                          console.log("Message sent successfully", updatedHistory);
                          // Filter data.history to include only toMessage
                          const filteredHistory = updatedHistory.filter(item => item.to === toMessage);
                          // Optionally, you can update the UI to show the new message immediately
                          renderChatToMessages(filteredHistory || [], id);
                        })
                        .catch(error => {
                          console.error("Error sending message: ", error);
                        });
                      } else {
                        console.log("No chat messages found");
                      }
                    })
                    .catch(error => {
                      console.error("Error getting chat messages: ", error);
                    });
                    messageInput.value = ''; // Clear the input field
                  }
                }
                function renderChatToMessages(messages, id) {
                  const filteredMessages = messages.filter(message => message.to !== 'Salam Djourney Official' && message.to == '<?php echo $this->session->userdata('business'); ?>');
                  const chatContainer = document.getElementById('chat-container-business');
                  chatContainer.innerHTML = ''; // Clear previous messages
                  filteredMessages.forEach(message => {
                    const divMailList = document.createElement('div');
                    divMailList.className = 'mail_list';
                    const divRight = document.createElement('div');
                    divRight.className = 'right';
                    const h3 = document.createElement('h3');
                    const small = document.createElement('small');
                    const p = document.createElement('p');
                    // Assuming message is an object with properties 'to', 'to_created_at', and 'status'
                    h3.textContent = message.to + ' ';
                    small.textContent = message.to_created_at;
                    h3.appendChild(small);
                    p.textContent = message.status;
                    if (message.status === 'read') {
                      p.style.color = 'black';
                      p.textContent = '-';
                    } else {
                      p.style.color = 'red';
                      p.textContent = 'New Message';
                    }
                    // Assuming message is an object with properties 'to', 'to_created_at', and 'status'
                    h3.textContent = message.to + ' ';
                    small.textContent = message.to_created_at;
                    h3.appendChild(small);
                    p.textContent = message.status;
                    divRight.appendChild(h3);
                    divRight.appendChild(p);
                    divMailList.appendChild(divRight);
                    chatContainer.appendChild(divMailList);
                    // Create a closure to capture message variables
                    (function(message) {
                      const chatToContainer = document.createElement('div');
                      chatToContainer.id = 'chat-container-to-business';
                      chatToContainer.style.backgroundColor = '#fff';
                      chatToContainer.style.color = 'black';
                      chatToContainer.style.padding = '10px';
                      chatToContainer.style.borderRadius = '10px';
                      const divMailList = document.createElement('div');
                      divMailList.className = 'mail_list';
                      const divRight = document.createElement('div');
                      divRight.className = 'right';
                      const h3 = document.createElement('h3');
                      const small = document.createElement('small');
                      const p = document.createElement('p');
                      // Assuming message is an object with properties 'to', 'to_created_at', and 'status'
                      h3.textContent = id + ' ';
                      small.textContent = message.to_created_at;
                      h3.appendChild(small);
                      p.textContent = message.to;
                      divRight.appendChild(h3);
                      divRight.appendChild(p);
                      divMailList.appendChild(divRight);
                      chatToContainer.appendChild(divMailList);
                      const mailView = document.getElementById('chat_view');
                      mailView.innerHTML = '';
                      mailView.appendChild(chatToContainer);
                      // console.log(message.to, message.to_created_at, message.status);
                      var to_data = message.to_data;
                      to_data.forEach(chats => {
                        // console.log(chats.text, chats.created_at);
                        console.log("chats", chats);
                        // Create elements for the mail view
                        const inboxBody = document.createElement('div');
                        inboxBody.className = 'inbox-body';
                        const repliedBody = document.createElement('div');
                        repliedBody.className = 'replied-body';
                        const mailHeadingRow = document.createElement('div');
                        mailHeadingRow.className = 'mail_heading row';
                        const mailHeadingRowReplied = document.createElement('div');
                        mailHeadingRowReplied.className = 'mail_heading row';
                        const colMd4 = document.createElement('div');
                        colMd4.className = 'col-md-4';
                        const dateParagraph = document.createElement('small');
                        dateParagraph.className = 'date';
                        if(chats.created_at) {
                          dateParagraph.textContent = transformDate(chats.created_at);
                        }
                        const viewMail = document.createElement('div');
                        viewMail.className = 'view-mail';
                        const viewMailContent = document.createElement('p');
                        viewMailContent.textContent = chats.text;
                        viewMailContent.style.fontWeight = '600';
                        viewMail.appendChild(viewMailContent);
                        const viewMailAgentReplied = document.createElement('div');
                        viewMailAgentReplied.className = 'mail_heading';
                        const agentRepliesParagraph = document.createElement('p');
                        agentRepliesParagraph.style.textAlign = 'right';
                        agentRepliesParagraph.style.marginBottom = '0px';
                        agentRepliesParagraph.style.fontWeight = '600';
                        viewMailAgentReplied.appendChild(agentRepliesParagraph);
                        if(chats.agent) {
                          agentRepliesParagraph.textContent = chats.agent;
                        }
                        const dateRepliesParagraph = document.createElement('small');
                        dateRepliesParagraph.style.float = 'right';
                        if(chats.replied_at) {
                          dateRepliesParagraph.textContent = transformDate(chats.replied_at);
                        }
                        const viewMailReplied = document.createElement('div');
                        viewMailReplied.className = 'view-mail';
                        const viewRepliesContent = document.createElement('p');
                        viewRepliesContent.textContent = chats.replies;
                        viewRepliesContent.style.textAlign = 'right';
                        viewRepliesContent.style.fontWeight = '600';
                        viewMailReplied.appendChild(viewRepliesContent);
                        // Append elements to their respective parents
                        inboxBody.appendChild(dateParagraph);
                        inboxBody.appendChild(mailHeadingRow);
                        inboxBody.appendChild(viewMail);
                        mailView.appendChild(inboxBody);

                        repliedBody.appendChild(viewMailAgentReplied);
                        repliedBody.appendChild(dateRepliesParagraph);
                        repliedBody.appendChild(mailHeadingRowReplied);
                        repliedBody.appendChild(viewMailReplied);
                        mailView.appendChild(repliedBody);

                        mailView.style.display = 'block';
                      })
                      // console.log("to_data", to_data);
                      const insertForm = document.createElement('div');
                      const messageInput = document.createElement('textarea');
                      // messageInput.type = 'text';
                      messageInput.id = 'message-input';
                      messageInput.rows = '5';
                      messageInput.className = 'form-control';
                      messageInput.placeholder = 'Type your message...';
                      const sendButton = document.createElement('button');
                      sendButton.className = 'btn btn-warning btn-lg';
                      sendButton.textContent = 'Send';
                      sendButton.onclick = function() {
                        sendMessage(message.to, id);
                      };
                      insertForm.appendChild(messageInput);
                      insertForm.appendChild(sendButton);
                      mailView.appendChild(insertForm);
                      mailView.style.display = 'block';
                    })(message);
                  });
                  // Scroll to the bottom of the chat container to show the latest message
                  chatContainer.scrollTop = chatContainer.scrollHeight;
                }
                // Call getChatMessages when the page loads to retrieve existing messages
                document.addEventListener('DOMContentLoaded', getChatMessages);
              <?php } ?>
              function getLatestTimestamp(history) {
                if (!history || history.length === 0) {
                  return 0;
                }
                const timestamps = history
                  .map(message => {
                    // Assuming to_created_at is either a JavaScript Date object or a string representing a date
                    if (typeof message.to_created_at === 'object' && message.to_created_at instanceof Date) {
                      return message.to_created_at.getTime(); // Convert Date object to milliseconds
                    } else if (typeof message.to_created_at === 'string') {
                      return new Date(message.to_created_at).getTime(); // Convert date string to milliseconds
                    } else {
                      return null; // Handle invalid or undefined timestamps
                    }
                  })
                  .filter(timestamp => timestamp !== null);
                if (timestamps.length === 0) {
                  return 0;
                }
                return Math.max(...timestamps); // Return the maximum timestamp
              }
              function transformDate(timestamp) {
                const currentDate = new Date();
                const date = new Date(timestamp);
                const diffInDays = Math.floor((currentDate.getTime() - date.getTime()) / (1000 * 60 * 60 * 24));
                // const options: Intl.DateTimeFormatOptions = { hour: '2-digit', minute: '2-digit' };
                if (diffInDays === 0) {
                  return `Today at ${date.toLocaleTimeString(undefined)}`;
                } else if (diffInDays === 1) {
                  return `Yesterday at ${date.toLocaleTimeString(undefined)}`;
                } else if (diffInDays < 7) {
                  return `${getDayName(date.getDay())} at ${date.toLocaleTimeString(undefined)}`;
                } else if (diffInDays < 30) {
                  const weeks = Math.floor(diffInDays / 7);
                  return `${weeks} week${weeks > 1 ? 's' : ''} ago`;
                } else if (diffInDays < 90) {
                  const months = Math.floor(diffInDays / 30);
                  return `${months} month${months > 1 ? 's' : ''} ago`;
                } else {
                  return date.toLocaleDateString();
                }
              }
              function getDayName(dayIndex) {
                const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                return daysOfWeek[dayIndex];
              }
            </script>
            <script>
            $(document).ready(function() {
                $('#create-folder').on('click', function() {
                    const folderName = $('#folder-name').val().trim();
                    const parentId = $('#parent-folder').val();

                    if (folderName) {
                        $.ajax({
                            url: "<?php echo base_url('create-folder'); ?>",
                            type: "POST",
                            data: { folderName: folderName, parentId: parentId },
                            success: function(response) {
                                if (response.status === 'success') {
                                    alert(`Folder "${folderName}" created successfully.`);
                                    location.reload(); // Reload the page to see the updated folder structure
                                } else {
                                    alert("Failed to create folder: " + response.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                alert("An error occurred while creating the folder.");
                            }
                        });
                    } else {
                        alert("Please enter a folder name.");
                    }
                });
            });
            </script>
            <script type="text/javascript">
              (function($) {
                'use strict';

                // Mengambil nama folder dari input
                let folderName = '';
                
                // Konfigurasi Dropzone dengan jQuery
                console.log("Initializing Dropzone...");
                $('.folder > a').on('click', function(e) {
                    e.preventDefault();
                    $(this).parent().toggleClass('open');
                });
                
                $.ajax({
                  url: "<?php echo base_url('get-folders'); ?>",
                  type: "GET",
                  success: function(response) {
                    console.log("Full response from server:", response); // Cek respons dari server
                    
                    if (response.folders && Array.isArray(response.folders)) {
                      response.folders.forEach(folder => {
                        console.log(folder.name);
                        $('#parent-folder').append(`<option value="${folder.id}">${folder.name}</option>`);
                      });
                    } else {
                      console.error("Response does not contain a valid 'folders' array.");
                    }
                  },
                  error: function(xhr, status, error) {
                    console.error("AJAX request failed:", status, error);
                  }
                });

                $("#my-awesome-dropzone").dropzone({
                  url: "<?php echo base_url('process-upload'); ?>",  // Gunakan PHP base_url untuk menentukan endpoint
                  autoProcessQueue: false, // Jangan upload secara otomatis
                  uploadMultiple: true, // Izinkan upload multiple files
                  parallelUploads: 10, // Jumlah maksimum file yang di-upload bersamaan
                  maxFiles: 10, // Maksimum file yang bisa di-upload
                  acceptedFiles: 'image/*,.pdf,.docx,.txt', // Batasi tipe file
                  addRemoveLinks: true, // Tampilkan link untuk menghapus file
                  dictRemoveFile: "Remove", // Teks untuk remove link
                  
                  init: function() {
                    var myDropzone = this;
                    console.log("Dropzone initialized with config:", myDropzone.options);

                    // Event listener untuk membuat folder baru
                    $('#create-folder').on("click", function() {
                      const folderName = $("#folder-name").val().trim();
                      const parentId = $("#parent-folder").val();

                      if (folderName) {
                        $.ajax({
                          url: "<?php echo base_url('create-folder'); ?>",
                          type: "POST",
                          data: { folderName: folderName, parentId: parentId },
                          success: function(response) {
                            const res = JSON.parse(response);
                            if (res.status === 'success') {
                              alert(`Folder "${folderName}" berhasil dibuat.`);
                            } else {
                              // alert("Gagal membuat folder: " + response.message);
                            }
                          },
                          error: function(xhr, status, error) {
                            alert("Terjadi kesalahan saat membuat folder.");
                          }
                        });
                      } else {
                        alert("Harap masukkan nama folder.");
                      }
                    });

                    // Function to check file-name and uploaded file name
                    function validateFileName(file) {
                        const inputFileName = document.getElementById("file-name").value;
                        const fileNameWithoutExtension = file.name.replace(/\.[^/.]+$/, "");

                        if (inputFileName !== fileNameWithoutExtension) {
                            alert("Keterangan: Input nama file harus sama dengan file yang diunggah.");
                            return false;
                        }
                        return true;
                    }

                    // Menangani tombol submit untuk upload file
                    $("#submit-all").on("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        // Ambil nama folder yang dipilih
                        const folderName = $("#parent-folder option:selected").text();
                        const fileName = $("#file-name").val().trim();

                        // Tambahkan folderName ke formData setiap file
                        myDropzone.on('sending', function(file, xhr, formData) {
                            formData.append('folderName', folderName); // Menambahkan folderName ke data
                        });

                        const files = myDropzone.getAcceptedFiles(); // Get all accepted files

                        if (files.length === 0) {
                            alert("Keterangan: Tidak ada file yang diunggah.");
                            return;
                        }

                        // Validate file name
                        const isValid = validateFileName(files[0]); // Assuming only one file due to maxFiles: 1
                        if (!isValid) {
                            return; // Stop submission if the file name does not match
                        }

                        console.log("Submit button clicked. File name matches. Processing queue...");
                        myDropzone.processQueue(); // Proses semua file
                    });

                    // Tambahkan informasi tambahan saat mengirimkan file
                    myDropzone.on("sending", function(file, xhr, formData) {
                      console.log("Sending file:", file.name);
                      formData.append("someKey", "someValue"); // Data tambahan jika diperlukan
                    });

                    // Callback saat semua file berhasil di-upload
                    myDropzone.on("successmultiple", function(files, response) {
                      const res = JSON.parse(response);
                      Swal.fire({
                        title: "Success!",
                        text: res.message,
                        icon: "success",
                        confirmButtonText: "Close"
                      }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload(); // Reload halaman ketika tombol "Close" diklik
                        }
                      });
                    });

                    // Callback saat terjadi error selama upload
                    myDropzone.on("errormultiple", function(files, response) {
                      console.error("Upload failed for files:");
                      files.forEach(file => console.error(file.name));
                      console.error("Server response:", response);
                    });

                    // Log untuk file yang ditambahkan ke Dropzone
                    myDropzone.on("addedfile", function(file) {
                        console.log("File added:", file.name);

                        // Remove the file extension from the file name
                        const fileNameWithoutExtension = file.name.replace(/\.[^/.]+$/, "");

                        // Set the processed file name to the #file-name input
                        document.getElementById("file-name").value = fileNameWithoutExtension;
                    });

                    // Log saat file dihapus
                    myDropzone.on("removedfile", function(file) {
                      console.log("File removed:", file.name);

                      // Clear the #file-name field when the file is removed
                      document.getElementById("file-name").value = "";
                    });
                  }
                });

                // Function to display CSV result in the table
                function loadCSVFile(csvFile) {
                    const filePath = `<?php echo base_url() ?>assets/uploads/results/${csvFile}`; // Path ke file CSV
                    console.log(`Fetching CSV file from: ${filePath}`); // Log untuk melihat path file yang diambil

                    // Mengambil file CSV dari server
                    fetch(filePath)
                        .then(response => {
                            console.log(`Response status: ${response.status}`); // Log status respons
                            if (!response.ok) {
                                throw new Error('Network response was not ok: ' + response.statusText);
                            }
                            return response.text(); // Mengembalikan konten sebagai teks
                        })
                        .then(csvContents => {
                            console.log('CSV file fetched successfully.'); // Log jika berhasil mengambil file
                            displayCSVResult(csvContents); // Memanggil fungsi untuk menampilkan hasil CSV
                        })
                        .catch(error => {
                            console.error('Error fetching the CSV file:', error);
                            // Anda bisa menampilkan pesan kesalahan kepada pengguna di sini
                        });
                }

                // Fungsi untuk menampilkan hasil CSV
                function displayCSVResult(csvContents) {
                    console.log('Processing CSV contents...'); // Log sebelum memproses CSV

                    const rows = csvContents.split('\r\n'); // Pisahkan setiap baris 
                    const table = document.createElement('table');
                    table.classList.add('table', 'table-striped'); // Tambahkan kelas Bootstrap

                    const headerRow = document.createElement('tr');

                    // Tambahkan header ke dalam tabel
                    const headers = rows[0].split(','); // Mendapatkan header
                    headers.forEach(header => {
                        const th = document.createElement('th');
                        th.textContent = header.trim();
                        headerRow.appendChild(th);
                    });
                    table.appendChild(headerRow);

                    // Tambahkan setiap baris data ke dalam tabel
                    for (let i = 1; i < rows.length; i++) { // Mulai dari 1 untuk melewati header
                        const row = document.createElement('tr');
                        const cells = rows[i].split(','); // Pisahkan setiap sel

                        cells.forEach(cell => {
                            const td = document.createElement('td');
                            td.textContent = cell.trim(); // Trim untuk menghapus spasi tambahan
                            row.appendChild(td);
                        });

                        table.appendChild(row);
                        console.log(`Row ${i}: ${cells.join(', ')}`); // Log isi setiap baris
                    }

                    // Insert table HTML into the DOM
                    document.getElementById('csv-result-table').innerHTML = ''; // Hapus konten sebelumnya
                    document.getElementById('csv-result-table').appendChild(table); // Tambahkan tabel baru
                    console.log('CSV contents displayed in table.'); // Log setelah tabel ditambahkan
                    alert('CSV contents displayed in table.\r\nScroll to bottom and download file by type');

                    const btnDownload = document.getElementById('btn-download');
                    btnDownload.style.display = 'block';
                }

              })(jQuery);
            </script>
          </body>
          </html>