        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View Membership</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Visit</th>
                          <th>Book By</th>
                          <th>Last Visit</th>
                          <th>Tier</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $data = array();
                          $this->db->select('firstnameBooking, lastnameBooking, byBooking, createdAtBooking, COUNT(idBooking) AS visit'); // Menambahkan COUNT untuk menghitung kunjungan
                          $this->db->from('booking');
                          $this->db->group_by('firstnameBooking, lastnameBooking'); // Mengelompokkan berdasarkan nama
                          $this->db->order_by('byBooking', 'DESC');
                          $query = $this->db->get();

                          if ($query->num_rows() > 0) {
                            foreach ($query->result() as $row) {
                              $data[] = $row;
                            }
                          }
                          $query->free_result(); 

                          foreach ($data as $row) {
                        ?>
                        <tr>
                          <td><?php echo $row->firstnameBooking . ' ' . $row->lastnameBooking; ?></td>
                          <td><?php echo $row->visit; ?></td> <!-- Menampilkan jumlah kunjungan -->
                          <td><?php echo $row->byBooking; ?></td>
                          <td><?php echo $row->createdAtBooking; ?></td>
                          <td>
                            <?php
                              // Menentukan Tier berdasarkan jumlah kunjungan
                              if ($row->visit >= 1 && $row->visit <= 19) {
                                echo "BRONZE";
                              } elseif ($row->visit >= 20 && $row->visit <= 34) {
                                echo "SILVER";
                              } elseif ($row->visit >= 35 && $row->visit <= 49) {
                                echo "GOLD";
                              } elseif ($row->visit >= 50) {
                                echo "PLATINUM";
                              } else {
                                echo "WOOD"; // Default tier untuk kunjungan < 1
                              }
                            ?>
                          </td>
                        </tr>
                        <?php
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