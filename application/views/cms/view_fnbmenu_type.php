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
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Fnb Menu Type</h3>
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
                    <h2>View <small>Fnb Menu Type</small></h2>
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
                      <table class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                  <th>Index</th>
                                  <th>Name</th>
                                  <th>Display Name</th>
                                  <th>Is Active</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody id="sortable">
                              <?php foreach ($fnbMenuType as $row) { ?>
                                  <tr id="row_<?php echo $row->idMenuType; ?>">
                                      <td><?php echo $row->indexMenuType ?></td>
                                      <td><?php echo $row->name ?></td>
                                      <td><?php echo $row->displayName ?></td>
                                      <td>
                                          <input type="radio" name="isActive" value="<?php echo $row->idMenuType; ?>"
                                              <?php echo ($row->isActive == 1) ? 'checked' : ''; ?>
                                              onclick="updateIsActive(<?php echo $row->idMenuType; ?>)">
                                      </td>
                                      <td>
                                          <a href="<?php echo base_url('cms/home/detailFnbMenuType/' . $row->idMenuType . '/') ?>" class="btn btn-primary">View Detail</a>
                                          <a id="rate<?php echo $row->idMenuType ?>" class="btn btn-danger" onclick="deleteRate(<?php echo $row->idMenuType ?>)">Delete</a>
                                      </td>
                                  </tr>
                              <?php } ?>
                          </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script type="text/javascript">
          function deleteRate(idMenuType) {
              $.ajax({
                  url: '<?php echo base_url('cms/home/deleteMenuType') ?>', // Replace with the actual URL
                  data: { idMenuType: idMenuType },
                  method: 'POST',
                  success: function(response) {
                      console.log(response);
                      if(response == 1) {
                          setTimeout(function() {
                              window.location.reload();
                          }, 1000); // This will refresh after a 2000ms (2 seconds) delay
                          alert('Success Delete Category');
                          // swal({
                          //     title: "Success",
                          //     text: "Berhasil di delete",
                          //     type: "success",
                          //     confirmButtonText: null
                          // });
                          
                      }
                  },
                  error: function(error) {
                      console.error('Error:', error);
                  }
              });
          }
        </script>
        <!-- /page content -->