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
                    <h2>View Karyawan <small>Users</small></h2>
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
                    <p class="text-muted font-13 m-b-30">
                      The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
                    </p>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Nama Barang</th>
                          <th>Standard Setup</th>
                          <th>Ideal Par</th>
                          <th>Last Inventory</th>
                          <th>Purchased</th>
                          <th>OO</th>
                          <th>Total Item</th>
                          <th>Nomor Kamar</th>
                          <th>Laundry</th>
                          <th>Linen Kotor</th>
                          <th>Office</th>
                          <th>Stock On Hand</th>
                          <th>Variance</th>
                          <th>Harga</th>
                          <th>Par Stock On Hand</th>
                          <th>Need To Order</th>
                          <th>ASUMSI Cost</th>
                          <th>House Keeper</th>
                        </tr>
                      </thead>
                      <?php
                        foreach($lineninventory as $row) {
                      ?>
                        <tbody>
                          <tr>
                            <td><?php echo $row->nmbarangHk ?></td>
                            <td><?php echo $row->stdsetupHk ?></td>
                            <td><?php echo $row->idealparHk ?></td>
                            <td><?php echo $row->lastinvHk ?></td>
                            <td><?php echo $row->purchasedHk ?></td>
                            <td><?php echo $row->ooHk ?></td>
                            <td><?php echo $row->idNumber ?></td>
                            <td><?php echo $row->idKamar ?></td>
                            <td><?php echo $row->laundryHk ?></td>
                            <td><?php echo $row->linenkotorHk ?></td>
                            <td><?php echo $row->officeHk ?></td>
                            <td><?php echo $row->stockonhandHk ?></td>
                            <td><?php echo $row->varianceHk ?></td>
                            <td><?php echo $row->hargaHk ?></td>
                            <td><?php echo $row->parstockonhandHk ?></td>
                            <td><?php echo $row->needtoorderHk ?></td>
                            <td><?php echo $row->asumsicostHk ?></td>
                            <td><?php echo $row->idUser ?></td>
                          </tr>
                        </tbody>
                      <?php } ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->