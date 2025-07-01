<style type="text/css">
  a:hover {
    color: blue;
  }
  /* Basic styling for the folder tree */
  .folder-tree,
  .folder-tree ul {
    list-style-type: none;
    padding-left: 1em;
    position: relative;
  }

  /* Folder items with children will show an expand/collapse icon */
  .folder {
    cursor: pointer;
    position: relative;
  }

  .folder::before {
    content: '\25B6'; /* Right-pointing triangle for collapsed state */
    position: absolute;
    left: 0em;
    top: 0.5em;
    color: #333;
  }

  .folder.open::before {
    content: '\25BC'; /* Down-pointing triangle for expanded state */
  }

  .folder ul {
    display: none; /* Hide child folders by default */
  }

  .folder.open > ul {
    display: block; /* Show children when folder is expanded */
  }
</style>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Form Upload </h3>
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
            <h2>File Manager</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Settings 1</a>
                    <a class="dropdown-item" href="#">Settings 2</a>
                  </div>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="folder-structure">
              <?php display_folder_structure($folders); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>File Manager</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Settings 1</a>
                    <a class="dropdown-item" href="#">Settings 2</a>
                  </div>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable-buttons" class="table table-bordered table-responsive table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>File Name</th>
                        <th>Create Folder</th>
                        <th>Select Folder</th>
                        <th>Keterangan</th>
                        <th>Expired</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-6" style="text-align: center;">
                                    <span id="training-number"></span>
                                </div>
                                <div class="col-6">
                                    <select name="hotel" class="form-control" id="business-select">
                                        <option selected value="">Pilih Unit</option>
                                        <?php
                                          $data = array();
                                          $this->db->from('Business_Detail');
                                          $this->db->where('typeBusiness', 'HOTEL');
                                          $query = $this->db->get();
                                          if ($query->num_rows() > 0)
                                          {
                                            foreach ($query->result() as $row)
                                            {
                                              $data[] = $row;
                                            }
                                          }
                                          $query->free_result();
                                          foreach($data as $index => $row) {
                                        ?>
                                          <option value="<?php echo $row->idBusiness ?>"><?php echo $row->Name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <script>
                                document.getElementById('business-select').addEventListener('change', function () {
                                    const idBusiness = this.value;
                                    fetch('generate_training_number_ajax', { // Replace with the actual URL
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                        },
                                        body: JSON.stringify({ idBusiness }),
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        document.getElementById('training-number').textContent = data.new_training_number;
                                    })
                                    .catch(error => console.error('Error:', error));
                                });
                                </script>
                            </div>
                        </td>
                        <td><input type="text" id="file-name" class="form-control" placeholder="Enter file name"></td>
                        <td><input type="text" name="create_folder" class="form-control" placeholder="Create Folder" readonly><button id="create-folder" class="btn btn-primary mt-2">Create Folder</button></td>
                        <td>
                            <select id="parent-folder" class="form-control mt-2">
                                <option value="">Select Folder</option>
                            </select>
                        </td>
                        <td><textarea name="keterangan" class="form-control" placeholder="Keterangan"></textarea></td>
                        <td><input type="date" name="expired" class="form-control"></td>
                        <td><form action="#" class="dropzone" id="my-awesome-dropzone"></form><button class="btn btn-primary" id="submit-all">Upload All Files</button></td>
                    </tr>
                </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-9 col-sm-9 col-xs-9">
        <div class="x_panel">
          <div class="x_title">
            <h2>History File</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Settings 1</a>
                    <a class="dropdown-item" href="#">Settings 2</a>
                  </div>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable-buttons" class="table table-bordered table-responsive table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>ID Business</th>
                  <th>Unit</th>
                  <th>File</th>
                  <th>Upload By</th>
                  <th>Approved By</th>
                  <th>Status</th>
                  <th>Created At</th>
                  <th>Edited At</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $data = array();
                  $this->db->from('uploads');
                  $this->db->join('user', 'user.idUser=uploads.idUser', 'left');
                  $this->db->join('Business_Detail', 'Business_Detail.idBusiness=uploads.idBusiness', 'left');
                  $query = $this->db->get();
                  if ($query->num_rows() > 0)
                  {
                    foreach ($query->result() as $row)
                    {
                      $data[] = $row;
                    }
                  }
                  $query->free_result();
                  foreach($data as $index => $row) {
                ?>
                <tr>
                  <td><?php echo $index ?></td>
                  <td><?php echo $row->idBusiness ?></td>
                  <td><?php echo $row->Name ?></td>
                  <td><a href="<?php echo base_url($row->fileUploads) ?>" target="_blank"><?php echo $row->nmUploads ?></a></td>
                  <td><?php echo $row->nmUser ?></td>
                  <td><?php echo $row->nmUser ?></td>
                  <td>
                      <?php 
                          if ($row->statusUploads == 0) {
                              echo '<span class="btn btn-primary">Pending</span>';
                          } elseif ($row->statusUploads == 1) {
                              echo '<span class="btn btn-warning">Viewed</span>';
                          } elseif ($row->statusUploads == 2) {
                              echo '<span class="btn btn-success">Approve</span>';
                          } elseif ($row->statusUploads == 3) {
                              echo '<span class="btn btn-danger">Decline</span>';
                          } else {
                              echo '<span>Status Unknown</span>'; // Opsional, jika ada status lain.
                          }
                      ?>
                  </td>
                  <td>
                      <?php 
                          echo date('j M y H:i:s', strtotime($row->created_at_uploads)); 
                      ?>
                  </td>
                  <td>
                      <?php 
                          echo date('j M y H:i:s', strtotime($row->edited_at_uploads)); 
                      ?>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-3 col-xs-3">
        <div class="x_panel">
          <div class="x_title">
            <!-- <h2>Dropzone multiple file uploader</h2> -->
            <!-- <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Settings 1</a>
                    <a class="dropdown-item" href="#">Settings 2</a>
                  </div>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div> -->
          </div>
          <!-- <div class="x_content">
            <p>Masukkan nama folder sebelum upload:</p>
            <form id="folder-form">
              <input type="text" id="folder-name" class="form-control" placeholder="Enter folder name">
              <button id="create-folder" class="btn btn-primary mt-2">Create Folder</button>
              <select id="parent-folder" class="form-control mt-2">
                  <option value="">Select Folder</option>
              </select>
              <input type="text" id="file-name" class="form-control" placeholder="Enter file name">
            </form>
            <br />

            <p>Drag multiple files to the box below for multi upload or click to select files. This is for demonstration purposes only, the files are not uploaded to any server.</p>
            <form action="#" class="dropzone" id="my-awesome-dropzone"></form>
            <br />
            <br />
            <button class="btn btn-primary" id="submit-all">Upload All Files</button>
            <br />
            <br />
          </div> -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<?php
function generate_folder_options($folders, $parent_id = 0) {
  foreach ($folders as $folder) {
    if ($folder->parent_id == $parent_id) {
      echo '<option value="' . $folder->id . '">' . $folder->name . '</option>';
      generate_folder_options($folders, $folder->id); // Recursive call to get children
    }
  }
}
function display_folder_structure($folders, $parentId = null) {
    echo '<div class="folder-container">';

    foreach ($folders as $folder) {
        if ($folder->parent_id == $parentId) { // Check if folder belongs to current parent
            // Render Folder
            echo '<div class="folder" onclick="toggleFolder(this)" style="padding-left: 15px;">'; 
            echo '<h3 class="count" style="text-transform: capitalize;">' . htmlspecialchars($folder->name) . '</h3>';
            echo '</div>';

            // Display subfolders or files within this folder
            echo '<div class="subfolder" style="display:none;">';
            display_folder_structure($folders, $folder->id); // Recursive call for subfolders

            // Display files if they exist in this folder
            if (!empty($folder->files)) {
                echo '<table class="table">';
                echo '<tr><th>Filename</th><th>Category</th><th>Date Uploaded</th><th>Expired Document</th></tr>';
                foreach ($folder->files as $file) {
                    echo '<tr>';
                    // echo '<td>"'..'"</td>';
                    echo '<td><a href="' . base_url($file->fileUploads) . '" target="_blank">' . $file->nmUploads . '</a></td>';
                    echo '<td>' . $file->ketUploads . '</td>';
                    echo '<td>' . date('j M y H:i:s', strtotime($file->created_at_uploads)) . '</td>';
                    echo '<td>' . date('j M y', strtotime($file->expired_uploads)) . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
            echo '</div>'; // Close subfolder div
        }
    }

    echo '</div>'; // Close folder-container div
  }
?>

<script type="text/javascript">
  function toggleFolder(element) {
    const subfolder = element.nextElementSibling;
    if (subfolder.style.display === "none") {
        subfolder.style.display = "block";
    } else {
        subfolder.style.display = "none";
    }
  }
</script>