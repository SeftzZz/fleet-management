        <style type="text/css">
          .bg-dimasak {
              background-color: #4CAF50; /* Warna hijau untuk status 'Dimasak' */
              color: white;
          }

          .bg-menunggu {
              background-color: #FFC107; /* Warna kuning untuk status 'Menunggu Konfirmasi' */
              color: black;
          }

          .bg-disajikan {
              background-color: transparent; /* Warna transparan untuk status 'Disajikan' */
          }

          .bg-dibatalkan {
              background-color: #FF5722; /* Warna merah untuk status 'Dibatalkan' */
              color: white;
          }
        </style>
        <?php if($this->session->flashdata('pesanerror')) { ?>
          <script language="javascript" type="text/javascript">
            swal({
              title: "Failed!",
              text: "<?php echo $this->session->flashdata('pesanerror');?>",
              type: "error",
              confirmButtonText: "Close"
            });
          </script>
        <?php } ?>
        <?php if($this->session->flashdata('pesansukses')) { ?>
          <script language="javascript" type="text/javascript">
            swal({
              title: "Success",
              text: "<?php echo $this->session->flashdata('pesansukses');?>",
              type: "success",
              confirmButtonText: "Close"
            });
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
                    <h2>Pesanan Alacarte Rooms</h2>
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
                    <!-- <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/inputAdditionalFnb/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                      <input type="hidden" name="numberroomBooking" id="numberroomBooking" class="form-control">
                      <input type="hidden" name="idBusiness" id="idBusiness" value="<?php echo $idBusiness ?>" class="form-control">
                      <input type="hidden" name="invoiceFnbadditional" id="invoiceFnbadditional" value="<?php echo $invoiceFnbadditional ?>" class="form-control">
                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="idBooking">ID Booking <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                          <div class="input-group">
                            <input type="text" readonly name="idBooking" id="idBooking" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="numberroomBooking">Room Number <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                          <div class="input-group">
                            <input type="text" id="autocomplete-custom-append-booking" name="numberroomBooking" class="form-control" required onchange="searchName()">
                            <span class="input-group-btn">
                              <div class="btn btn-primary" style="float: right;" data-toggle="modal" id="firstnameBooking" data-target="#memberModal">Customer Name</div>
                            </span>
                          </div>
                        </div>
                      </div>
                      <script type="text/javascript">
                        function searchName() {
                            const input = document.getElementById('autocomplete-custom-append-booking');
                            let query = input.value.trim();

                            // Hapus string dari "-" seterusnya jika ada
                            // if (query.includes('-')) {
                            //     query = query.split('-')[0]; // Mengambil bagian sebelum "-"
                            // }

                            if (query.length > 0) {
                                console.log('Mencari customer dengan query:', query);
                                // Panggil API atau filter data customer berdasarkan query
                                $.ajax({
                                    type: 'POST',
                                    url: '<?php echo base_url('cms/home/ajaxGetBookingData/') ?>', // Ganti dengan URL yang benar
                                    data: { numberroomBooking: query },
                                    success: function(booking) {
                                        var dataBooking = JSON.parse(booking);
                                        document.getElementById('idBooking').value = dataBooking[0].idBooking;
                                        document.getElementById('numberroomBooking').value = dataBooking[0].numberroomBooking;
                                        document.getElementById('firstnameBooking').textContent = dataBooking[0].firstnameBooking + '-' + dataBooking[0].lastnameBooking;
                                    },
                                    error: function(error) {
                                        console.error('Error:', error);
                                    }
                                });
                            } else {
                                console.log('Input kosong');
                                // Jika input kosong, Anda dapat menampilkan semua data atau reset tampilan
                                // resetCustomerList();
                            }
                        }
                      </script>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="autocomplete-custom-append-fnb">Choose Menu <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 ">
                          <input type="text" id="autocomplete-custom-append-fnb" name="ketFnbadditional" class="form-control" required placeholder="Type Menu...">
                        </div>
                        <div class="col-md-3 col-sm-3 ">
                          <input type="number" name="qtyFnbadditional" class="form-control" required placeholder="Type Quantity...">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="descFnbadditional">Description <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                          <div class="input-group">
                            <textarea type="text" name="descFnbadditional" class="form-control" placeholder="Bumbunya di pisah ya.." rows="5" cols="100"></textarea>
                          </div>
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
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID Booking</th>
                          <th>Nomor Kamar</th>
                          <th>Menu Pesanan</th>
                          <th>Tanggal Pesanan</th>
                          <th>Status Pesanan</th>
                          <th>Sub Total</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $displayed_numberroom = array();
                          foreach($additional as $row) {
                            $dateNow = date('Y-m-d');
                        ?>
                        <tr>
                          <!-- <td><a href="<?php echo base_url('cms/home/viewBuktiPembayaran/'.$this->session->userdata('idBusiness')) ?>" class="btn btn-warning"><?php echo $row->idBooking ?></a></td> -->
                          <td><a id="send-notif" class="btn btn-warning"><?php echo $row->idBooking ?></a></td>
                          <td><?php echo $row->numberroomFnbadditional ?></td>
                          <td><?php echo $row->ketFnbadditional ?></td>
                          <td><?php echo $row->createdAt ?></td>
                          <td class="<?php
                              if ($row->statusFnbcooking == '1') {
                                  echo 'bg-dimasak';
                              } elseif ($row->statusFnbcooking == '0') {
                                  echo 'bg-menunggu';
                              } elseif ($row->statusFnbcooking == '2') {
                                  echo 'bg-disajikan';
                              } else {
                                  echo 'bg-dibatalkan';
                              }
                          ?>">
                              <?php
                                  if ($row->statusFnbcooking == '1') {
                                      echo 'Dimasak';
                                  } elseif ($row->statusFnbcooking == '0') {
                                      echo 'Menunggu Konfirmasi';
                                  } elseif ($row->statusFnbcooking == '2') {
                                      echo 'Disajikan';
                                  } else {
                                      echo 'Dibatalkan';
                                  }
                              ?>
                          </td>
                          <td><?php echo number_format($row->subtotalPrice) ?></td>
                          <td><a href="<?php echo base_url('cms/home/viewAdditionalDetail/'.$row->idBooking.'/'.$row->invoiceFnbadditional.'/') ?>" class="btn btn-primary">View Detail</a></td>
                        </tr>
                        <?php
                          $dataFNBAdditional = array();
                          $this->db->select('user.idUser, user.tokenPushNotification, fnb_additional_booking.*');
                          $this->db->from('fnb_additional_booking');
                          $this->db->join('user', 'user.idUser=fnb_additional_booking.idUser');
                          $this->db->where('fnb_additional_booking.idBooking', $row->idBooking);
                          $query = $this->db->get();
                          if ($query->num_rows() > 0) {
                              $dataFNBAdditional = $query->row();
                          }
                          $query->free_result();
                        ?>
                        <script type="text/javascript">
                          document.getElementById('send-notif').addEventListener('click', function() {
                            var invoiceFnbadditional = '<?php echo $dataFNBAdditional->invoiceFnbadditional; ?>';
                            var idBusiness = '<?php echo $row->idBusiness; ?>';
                            var currentToken = '<?php echo $dataFNBAdditional->tokenPushNotification; ?>';
                            var rateafterdiscountBooking = '<?php echo $dataFNBAdditional->priceFnbadditional; ?>';
                            $.ajax({
                              url: '<?php echo base_url('cms/api/postNotificationPayment') ?>',
                              type: 'POST',
                              data: { invoiceBooking: invoiceFnbadditional, idBusiness: idBusiness, currentToken: currentToken, rateafterdiscountBooking: rateafterdiscountBooking },
                              success: function(response) {
                                console.log(response);
                              },
                              error: function(error) {
                                console.error('Error sending data:', error);
                              }
                            });
                          });
                        </script>
                        <?php } ?>
                      </tbody>
                    </table>
                    <script src="<?php echo base_url() ?>/vendors/jquery/dist/jquery.min.js"></script>
                    <script src="<?php echo base_url() ?>/vendors/pnotify/dist/pnotify.js"></script>
                    <script src="<?php echo base_url() ?>/vendors/pnotify/dist/pnotify.buttons.js"></script>
                    <audio id="notificationSound" src="<?php echo base_url('assets/audio/coin_c_02-102844.mp3'); ?>"></audio>
                    <script type="text/javascript">
                      $(document).ready(function() {
                        function ajaxNotifFnb() {
                          $.ajax({
                            url: '<?php echo base_url('cms/home/ajaxPostAdditionalFnb/'.$this->session->userdata('idBusiness').'/') ?>', // Replace with the actual URL
                            method: 'GET',
                            success: function(additional) {
                              var invoice_ = JSON.parse(additional);
                              console.log(invoice_);
                              if(invoice_.result != 'empty') {
                                for(let i in invoice_) {
                                  // Play the notification sound on success
                                  // Attach a click event listener to a button to play the notification sound
                                  $('#playNotificationSoundButton').on('click', function() {
                                    var audio = document.getElementById('notificationSound');
                                    audio.play();
                                  });
                                  
                                  $.ajax({
                                    url: '<?php echo base_url('cms/home/ajaxUpdateStatusAdditionalFnb') ?>', // Replace with the actual URL
                                    method: 'POST',
                                    data: {
                                      invoiceFnbadditional: invoice_[i].invoiceFnbadditional,
                                    },
                                    success: function(update) {                
                                      // console.log(update);
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
                        }

                        ajaxNotifFnb();
                        // setInterval(ajaxNotifFnb, 3000);
                      });
                    </script>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->