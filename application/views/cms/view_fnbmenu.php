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
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <table id="datatable-fnb" class="table table-striped table-bordered asc-sort-4">
                      <thead>
                        <tr>
                          <th>Taggal diubah</th>
                          <th>Nama Menu</th>
                          <th>Keterangan</th>
                          <th>Harga</th>
                          <th>Tipe Menu</th>
                          <th>Stock</th>
                          <th>Gambar</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php
                          $displayed_numberroom = array();
                          foreach($fnbMenu as $row) {
                            $dateNow = date('Y-m-d');
                        ?>
                        <tr>
                          <td><?php echo $row->createdAt ?></td>
                          <td><?php echo $row->nmMenu ?></td>
                          <td><?php echo $row->description ?></td>
                          <td><?php echo $row->priceMenu ?></td>
                          <td><?php echo $row->typeMenu ?></td>
                          <td><?php echo $row->stockMenu ?></td>
                          <td><img src="<?php echo $row->pictureUrlMenu; ?>"  width="100" height="100" alt="no picture"/></td>
                          <td><a href="<?php echo base_url('cms/home/detailFnbMenu/'.$row->idMenu.'/') ?>" class="btn btn-primary">View Detail</a>
                          <button class="btn btn-primary" data-toggle="modal" data-target="#roomattendantModal<?php echo $row->idMenu; ?>">History</button>
                          <a id="rate<?php echo $row->idMenu ?>" class="btn btn-danger" onclick="deleteRate(<?php echo $row->idMenu ?>)">Delete</a>
                          </td>
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                    <script type="text/javascript">
                      function deleteRate(idMenu) {
                          $.ajax({
                              url: '<?php echo base_url('cms/home/deleteMenu') ?>', // Replace with the actual URL
                              data: { idMenu: idMenu },
                              method: 'POST',
                              success: function(response) {
                                  console.log(response);
                                  if(response == 1) {
                                      setTimeout(function() {
                                          window.location.reload();
                                      }, 1000); // This will refresh after a 2000ms (2 seconds) delay
                                      alert('Sucess Delete');
                                  }
                              },
                              error: function(error) {
                                  console.error('Error:', error);
                              }
                          });
                      }
                    </script>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php
foreach($fnbMenu as $row) {
    ?>
    <div class="modal fade" id="roomattendantModal<?php echo $row->idMenu; ?>" tabindex="-1" role="dialog" aria-labelledby="roomattendantModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roomattendantModalLabel">Modal title </h5>
                </div>
                <div style="padding:20px">
                    <table id="datatable-buttons" class="table table-striped table-bordered ">
                        <thead>
                        <tr>
                            <th>Nama Menu</th>
                            <th>Harga</th>
                            <th>Tipe Menu</th>
                            <th>Stock</th>
                            <th>Taggal dibuat</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $dateNow = date('Y-m-d');
                        $data = array();
                        $this->db->from('fnb_menu_history');
                        $this->db->where('idMenu', $row->idMenu);
                        $query = $this->db->get();
                        if ($query->num_rows() > 0)
                        {
                            foreach ($query->result() as $row)
                            {
                                $data[] = $row;
                            }
                        }
                        $query->free_result();
                        foreach($data as $history) {
                            ?>
                            <tr>
                                <td><?php echo $history->nmMenu ?></td>
                                <td><?php echo $history->priceMenu ?></td>
                                <td><?php echo $history->typeMenu ?></td>
                                <td><?php echo $history->stockMenu ?></td>
                                <td><?php echo $history->createdAt ?></td>
                                <td><?php echo $history->description ?></td>

                            </tr>
                        <?php }?>>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php }?>

        <!-- /page content -->



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> <!-- Add jQuery -->
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script>
    $("#datatable-fnb").length && $("#datatable-fnb").DataTable({
        dom: "Blfrtip",
            order: [[0, 'desc']],
        buttons: [{
            extend: "copy",
            className: "btn-sm"
        }, {
            extend: "csv",
            className: "btn-sm"
        }, {
            extend: "excel",
            className: "btn-sm"
        }, {
            extend: "pdfHtml5",
            className: "btn-sm"
        }, {
            extend: "print",
            className: "btn-sm"
        }],
        responsive: !0
    })
</script>