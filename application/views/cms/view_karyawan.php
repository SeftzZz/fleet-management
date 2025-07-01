        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Karyawan</h3>
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
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View Karyawan</h2>
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
                          <th>Group</th>
                          <th>Position</th>
                          <th>Departemen</th>
                          <th>Mobile</th>
                          <th>Email</th>
                          <th>Office</th>
                          <th>Start date</th>
                            <?php if ($this->session->userdata('level') == 7) { ?>
                            <th>Block</th>
                            <?php } ?>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <?php 
                        if($this->session->userdata('level') == 7) {
                      ?>
                      <tbody>
                        <?php
                          $business = array();
                          $this->db->from('karyawan');
                          $this->db->join('user', 'user.idKaryawan=karyawan.idKaryawan');
                          $this->db->join('User_Departemen', 'User_Departemen.idDep=karyawan.idDep');
                          $this->db->join('user_lavel', 'user_lavel.idLevel=karyawan.idLevel');
                          $this->db->join('business_group', 'business_group.idGroup=user.idGroup');
                          $this->db->join('Business_Detail', 'Business_Detail.idBusiness=user.idBusiness');
                          // $this->db->where('user.idGroup', $this->session->userdata('idGroup'));
                          $query = $this->db->get();

                          if ($query->num_rows() > 0) {
                            foreach ($query->result() as $row) {
                              $business[] = $row;
                            }
                          }
                          $query->free_result();
                          foreach($business as $row) {
                        ?>
                        <tr>
                          <td><?php echo $row->nmKaryawan ?></td>
                          <td><?php echo $row->nmGroup ?></td>
                          <td><?php echo $row->Note ?></td>
                          <td><?php echo $row->DepName ?></td>
                          <td><?php echo $row->mobileKaryawan ?></td>
                          <td><?php echo $row->emailKaryawan ?></td>
                          <td><?php echo $row->Name ?></td>
                          <td><?php echo $row->createdAt ?></td>
                            <td><?php if ($row->blockUser == 1) { ?>
                                <a href="<?php echo base_url('cms/home/unblockUser/'.$row->idKaryawan.'/') ?>" class="btn btn-primary">Unblcok</a>
                             <?php } else { ?>
                                <a href="<?php echo base_url('cms/home/blockUser/'.$row->idKaryawan.'/') ?>" class="btn btn-primary">Block</a>
                            <?php }?>
                            </td>
                          <td><a href="<?php echo base_url('cms/home/editKaryawan/'.$row->idKaryawan.'/') ?>" class="btn btn-primary">Edit</a>

                              <a href="<?php echo base_url('cms/home/deleteKaryawan/'.$row->idKaryawan.'/') ?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                      <?php
                        } elseif($this->session->userdata('level') == 1) {
                      ?>
                      <tbody>
                        <?php
                          $business = array();
                          $this->db->from('karyawan');
                          $this->db->join('user', 'user.idKaryawan=karyawan.idKaryawan');
                          $this->db->join('User_Departemen', 'User_Departemen.idDep=karyawan.idDep');
                          $this->db->join('user_lavel', 'user_lavel.idLevel=karyawan.idLevel');
                          $this->db->join('business_group', 'business_group.idGroup=user.idGroup');
                          $this->db->join('Business_Detail', 'Business_Detail.idBusiness=karyawan.officeKaryawan');
                          $this->db->where('user.idGroup', $this->session->userdata('idGroup'));
                          $query = $this->db->get();

                          if ($query->num_rows() > 0) {
                            foreach ($query->result() as $row) {
                              $business[] = $row;
                            }
                          }
                          $query->free_result();

                        $query->free_result();
                          foreach($business as $row) {
                        ?>
                        <tr>
                          <td><?php echo $row->nmKaryawan ?></td>
                          <td><?php echo $row->nmGroup ?></td>
                          <td><?php echo $row->Note ?></td>
                          <td><?php echo $row->DepName ?></td>
                          <td><?php echo $row->mobileKaryawan ?></td>
                          <td><?php echo $row->emailKaryawan ?></td>
                            <td><?php echo $row->Name ?></td>
                          <td><?php echo $row->createdAt ?></td>
                          <td><a href="<?php echo base_url('cms/home/editKaryawan/'.$row->idKaryawan.'/') ?>" class="btn btn-primary">Edit</a></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                      <?php
                        } else {
                      ?>
                      <tbody>
                        <?php
                        $this->db->from('Business_Detail');
                        $this->db->where('idBusiness', $this->session->userdata('idBusiness')); // Replace $your_id with the actual ID you are looking for
                        $query = $this->db->get();

                        if ($query->num_rows() == 1) {
                            $businessDetail = $query->row();
                            // Now $row contains the data for the selected row
                        }
                        $query->free_result();
                          foreach($karyawan as $row) {
                        ?>
                        <tr>
                          <td><?php echo $row->nmKaryawan ?></td>
                          <td><?php echo $row->nmGroup ?></td>
                          <td><?php echo $row->Note ?></td>
                          <td><?php echo $row->DepName ?></td>
                          <td><?php echo $row->mobileKaryawan ?></td>
                          <td><?php echo $row->emailKaryawan ?></td>
                          <td><?php echo $businessDetail->Name ?></td>
                          <td><?php echo $row->createdAt ?></td>
                          <td><a href="<?php echo base_url('cms/home/editKaryawan/'.$row->idKaryawan.'/') ?>" class="btn btn-primary">Edit</a></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                      <?php
                        }
                      ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->