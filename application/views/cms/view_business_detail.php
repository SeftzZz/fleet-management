        
        <script src=""></script>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Business Detail</h3>
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
                    <h2>Business Detail</h2>
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
                    <?php
                      if($this->session->userdata('level') == 7) {
                    ?>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Type</th>
                          <th>Group</th>
                          <th>Address</th>
                          <th>Image</th>
                          <th>Location</th>
                          <!-- <th>Action</th> -->
                        </tr>
                      </thead>
                        <tbody>
                          <?php
                            $business = array();
                            $this->db->from('Business_Detail');
                            $this->db->join('business_group', 'business_group.idGroup=Business_Detail.idGroup');
                            $this->db->order_by('Business_Detail.idBusiness', 'DESC');
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
                            <td><?php echo $row->Name ?></td>
                            <td><?php echo $row->typeBusiness ?></td>
                            <td><?php echo $row->nmGroup ?></td>
                            <td><?php echo $row->addres ?></td>
                            <?php
                              if($row->typeBusiness == 'HOTEL') {
                            ?>
                              <td><img src="<?php echo '/assets/images/hotels/' . $row->image; ?>"  width="20%" alt="no picture"/></td>
                            <?php } elseif($row->typeBusiness == 'PLACE') {
                            ?>
                              <td><img src="<?php echo '/assets/images/place/' . $row->image; ?>"  width="20%" alt="no picture"/></td>
                            <?php } ?>
                            <td>
                            <div class="mapouter"><div class="gmap_canvas"><iframe src="<?php echo $row->urlmapBusiness ?>&amp;output=embed" frameborder="0" scrolling="no" style="width: 200px; height: 200px;"></iframe><style>.mapouter{position:relative;height:200px;width:200px;background:#fff;} .maprouter a{color:#fff !important;position:absolute !important;top:0 !important;z-index:0 !important;}</style><a href="https://blooketjoin.org">blooketjoin</a><style>.gmap_canvas{overflow:hidden;height:200px;width:200px}.gmap_canvas iframe{position:relative;z-index:2}</style></div></div>
                            </td>
                            <!-- <td><a href="<?php echo base_url('cms/home/viewdetailBusiness/'.$row->idBusiness.'/') ?>" class="btn btn-primary">View Detail</a></td> -->
                          </tr>
                          <?php }?>
                        </tbody>
                    </table>
                    <?php
                    } elseif($this->session->userdata('level') == 1) {
                    ?>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Type</th>
                          <th>Group</th>
                          <th>Address</th>
                          <th>Image</th>
                          <th>Location</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                        <tbody>
                          
                          <?php
                            $businessDetails = array();
                            $this->db->from('Business_Detail');
                            $this->db->join('business_group', 'business_group.idGroup=Business_Detail.idGroup');
                            $this->db->order_by('Business_Detail.idBusiness', 'DESC');
                            $this->db->where('Business_Detail.idGroup', $this->session->userdata('idGroup'));
                            $query = $this->db->get();

                            if ($query->num_rows() > 0) {
                              foreach ($query->result() as $row) {
                                $businessDetails[] = $row;
                              }
                            }
                            $query->free_result(); 
                            foreach($businessDetails as $row) {
                          ?>
                          <tr>
                            <td><?php echo $row->Name ?></td>
                            <td><?php echo $row->typeBusiness ?></td>
                            <td><?php echo $row->nmGroup ?></td>
                            <td><?php echo $row->addres ?></td>
                            <?php
                              if($row->typeBusiness == 'HOTEL') {
                            ?>
                              <td><img src="<?php echo '/assets/images/hotels/' . $row->image; ?>"  width="20%" alt="no picture"/></td>
                            <?php } elseif($row->typeBusiness == 'PLACE') {
                            ?>
                              <td><img src="<?php echo '/assets/images/place/' . $row->image; ?>"  width="20%" alt="no picture"/></td>
                            <?php } ?>
                            <td>
                            <div class="mapouter"><div class="gmap_canvas"><iframe src="<?php echo $row->urlmapBusiness ?>&amp;output=embed" frameborder="0" scrolling="no" style="width: 200px; height: 200px;"></iframe><style>.mapouter{position:relative;height:200px;width:200px;background:#fff;} .maprouter a{color:#fff !important;position:absolute !important;top:0 !important;z-index:0 !important;}</style><a href="https://blooketjoin.org">blooketjoin</a><style>.gmap_canvas{overflow:hidden;height:200px;width:200px}.gmap_canvas iframe{position:relative;z-index:2}</style></div></div>
                            </td>
                            <!-- <td><a href="<?php echo base_url('cms/home/viewdetailBusiness/'.$row->idBusiness.'/') ?>" class="btn btn-primary">View Detail</a></td> -->
                          </tr>
                          <?php }?>
                        </tbody>
                    </table>
                    <?php
                    } else {
                    ?>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Type</th>
                          <th>Group</th>
                          <th>Address</th>
                          <th>Image</th>
                          <th>Location</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                        <tbody>
                          
                          <?php
                            $businessDetails = array();
                            $this->db->from('Business_Detail');
                            $this->db->join('business_group', 'business_group.idGroup=Business_Detail.idGroup');
                            $this->db->where('Business_Detail.idBusiness', $this->session->userdata('idBusiness'));
                            $this->db->order_by('Business_Detail.idBusiness', 'DESC');
                            $query = $this->db->get();

                            if ($query->num_rows() > 0) {
                              foreach ($query->result() as $row) {
                                $businessDetails[] = $row;
                              }
                            }
                            $query->free_result(); 
                            foreach($businessDetails as $row) {
                          ?>
                          <tr>
                            <td><?php echo $row->Name ?></td>
                            <td><?php echo $row->typeBusiness ?></td>
                            <td><?php echo $row->nmGroup ?></td>
                            <td><?php echo $row->addres ?></td>
                            <?php
                              if($row->typeBusiness == 'HOTEL') {
                            ?>
                              <td><img src="<?php echo '/assets/images/hotels/' . $row->image; ?>"  width="20%" alt="no picture"/></td>
                            <?php } elseif($row->typeBusiness == 'PLACE') {
                            ?>
                              <td><img src="<?php echo '/assets/images/place/' . $row->image; ?>"  width="20%" alt="no picture"/></td>
                            <?php } ?>
                            <td>
                            <div class="mapouter"><div class="gmap_canvas"><iframe src="<?php echo $row->urlmapBusiness ?>&amp;output=embed" frameborder="0" scrolling="no" style="width: 200px; height: 200px;"></iframe><style>.mapouter{position:relative;height:200px;width:200px;background:#fff;} .maprouter a{color:#fff !important;position:absolute !important;top:0 !important;z-index:0 !important;}</style><a href="https://blooketjoin.org">blooketjoin</a><style>.gmap_canvas{overflow:hidden;height:200px;width:200px}.gmap_canvas iframe{position:relative;z-index:2}</style></div></div>
                            </td>
                            <!-- <td><a href="<?php echo base_url('cms/home/viewdetailBusiness/'.$row->idBusiness.'/') ?>" class="btn btn-primary">View Detail</a></td> -->
                          </tr>
                          <?php }?>
                        </tbody>
                    </table>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->