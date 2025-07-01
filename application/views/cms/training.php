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
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Input Grup Arsip</h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable-group" class="table table-bordered table-responsive table-striped">
              <thead>
                <tr>
                  <th>Nomor Dokumen</th>
                  <th>Unit</th>
                  <th>Nama File</th>
                  <th>Jenis Dokumen</th>
                  <th>Departemen</th>
                  <th>Keterangan</th>
                  <th>BOX Code</th>
                  <th>Expired</th>
                  <th>File</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <form id="form-uploads" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('process-upload') ?>" class="form-horizontal form-label-left">
                    <td>
                      <input type="text" id="training-number" name="training-number" class="form-control" readonly>
                    </td>
                    <td>
                      <select name="hotel" class="form-control" id="business-select">
                        <option selected value="">Pilih Unit</option>
                        <?php
                          $data = array();
                          $this->db->from('Business_Detail');
                          $this->db->where('typeBusiness', 'HOTEL');
                          $this->db->or_where('typeBusiness', 'OFFICE');
                          $query = $this->db->get();

                          if ($query->num_rows() > 0) {
                            foreach ($query->result() as $row) {
                              $data[] = $row;
                            }
                          }

                          $query->free_result();
                          foreach ($data as $index => $row) {
                            echo '<option value="' . $row->idBusiness . '">' . $row->Name . '</option>';
                          }
                        ?>
                      </select>
                    </td>
                    <td>
                      <input type="text" id="file-name" name="file-name" class="form-control" placeholder="Enter file name">
                    </td>
                    <td>
                      <select name="categoryUploads" class="form-control" id="category-select">
                          <option selected value="">Pilih Jenis Dokumen</option>
                          <?php
                            $data = array();
                            $this->db->from('uploads_categories');
                            $query = $this->db->get();

                            if ($query->num_rows() > 0) {
                              foreach ($query->result() as $row) {
                                $data[] = $row;
                              }
                            }

                            $query->free_result();
                            foreach ($data as $index => $row) {
                              echo '<option value="' . $row->kodeUploadcategories . '" title="' . $row->ketUploadcategories . '">' . $row->nmUploadcategories . '</option>';
                            }
                          ?>
                      </select>
                    </td>
                    <td>
                      <select name="departementUploads" class="form-control" id="departement-select">
                          <option selected value="">Pilih Departemen</option>
                          <?php                            
                            $data = array();
                            $this->db->from('uploads_departements');
                            $query = $this->db->get();

                            if ($query->num_rows() > 0) {
                              foreach ($query->result() as $row) {
                                $data[] = $row;
                              }
                            }

                            $query->free_result();
                            foreach ($data as $index => $row) {
                              echo '<option value="' . $row->nmUploaddepartements . '" title="' . $row->ketUploaddepartements . '">' . $row->nmUploaddepartements . '</option>';
                            }
                          ?>
                      </select>
                    </td>
                    <td>
                      <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan" rows="5"></textarea>
                    </td>
                    <td>
                      <input readonly type="text" name="boxcode" id="boxcode" class="form-control" style="color: red;">
                      <button type="button" id="print-boxcode" class="btn btn-warning btn-block" style="margin-top: 10px;">Print Boxcode</button>
                      <script>
                        // Event listener untuk tombol cetak
                        document.getElementById('print-boxcode').addEventListener('click', function () {
                          const boxcode = document.getElementById('boxcode').value;
                          const category = document.getElementById('category-select').value;
                          const department = document.getElementById('departement-select').value;

                          // Cek apakah boxcode, category-select, atau departement-select kosong
                          if (!boxcode) {
                            alert('Boxcode belum diisi!');
                            return;
                          }

                          if (!category) {
                            alert('Kategori belum dipilih!');
                            return;
                          }

                          if (!department) {
                            alert('Departemen belum dipilih!');
                            return;
                          }

                          // Jika semua validasi lulus, lakukan proses pencetakan
                          const printWindow = window.open('', '_blank');
                          printWindow.document.write(`
                            <html>
                              <head>
                                <title>Print Boxcode</title>
                                <style>
                                  .boxcode-container {
                                    display: inline-block; /* Mengatur agar lebar mengikuti isi */
                                    padding: 10px;
                                    border: solid 2px black;
                                    text-align: left;
                                    box-sizing: border-box;
                                  }
                                  .boxcode-container {
                                    margin: 0;
                                  }
                                </style>
                              </head>
                              <body>
                                <div class="boxcode-container">
                                  <h1 style="margin: 0;">Box Code: <span style="color: red;">${boxcode}</span></h1>
                                </div>
                                <script>
                                  window.print();
                                  window.onafterprint = window.close;
                                <\/script>
                              </body>
                            </html>
                          `);
                          printWindow.document.close();
                        });

                        document.getElementById('form-uploads').addEventListener('submit', function (e) {
                          const boxcode = document.getElementById('boxcode').value;
                          const category = document.getElementById('category-select').value;
                          const department = document.getElementById('departement-select').value;
                          const keterangan = document.getElementById('keterangan').value;
                          const fileName = document.getElementById('file-name').value;

                          // Cek apakah boxcode, category-select, file-name, atau departement-select kosong
                          if (!boxcode) {
                            alert('Boxcode belum diisi!');
                            e.preventDefault(); // Mencegah form submit
                            return;
                          }

                          if (!category) {
                            alert('Kategori belum dipilih!');
                            e.preventDefault(); // Mencegah form submit
                            return;
                          }

                          if (!department) {
                            alert('Departemen belum dipilih!');
                            e.preventDefault(); // Mencegah form submit
                            return;
                          }

                          if (!keterangan) {
                            alert('Keterangan file belum diisi!');
                            e.preventDefault(); // Mencegah form submit
                            return;
                          }

                          if (!fileName) {
                            alert('Nama file belum diisi!');
                            e.preventDefault(); // Mencegah form submit
                            return;
                          }

                          // Jika semua validasi lulus, form dapat disubmit
                        });
                      </script>
                    </td>
                    <td>
                      <input type="date" name="expired" class="form-control">
                    </td>
                    <td>
                      <input type="file" id="fileUploads" name="fileUploads" class="form-control">
                    </td>
                    <td>
                      <input class="btn btn-primary" type="submit" value="Upload all files"></input>
                    </td>
                  </form>
                  <script>
                    document.getElementById('fileUploads').addEventListener('change', function () {
                      const file = this.files[0];
                      if (file) {
                        const fileNameWithoutExt = file.name.split('.').slice(0, -1).join('.');
                        document.getElementById('file-name').value = fileNameWithoutExt;
                      }
                    });
                  </script>
                </tr>
              </tbody>
            </table>
            <script type="text/javascript">
              document.addEventListener('DOMContentLoaded', function() {
                if (typeof $.fn.DataTable !== "undefined") {
                  console.log("Initializing Group DataTables...");
                  
                  $("#datatable-group").dataTable();
                }
              });
            </script>
          </div>
        </div>
      </div> -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Input Arsip</h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable-group" class="table table-bordered table-responsive table-striped">
              <thead>
                <tr>
                  <th>Nomor Dokumen</th>
                  <th>Unit</th>
                  <th>Nama File</th>
                  <th>Jenis Dokumen</th>
                  <th>Departemen</th>
                  <th>Keterangan</th>
                  <th>BOX Code</th>
                  <th>Expired</th>
                  <th>File</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <form id="form-uploads" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('process-upload') ?>" class="form-horizontal form-label-left">
                    <td>
                      <input type="text" id="training-number" name="training-number" class="form-control" readonly>
                    </td>
                    <td>
                      <select name="hotel" class="form-control" id="business-select">
                        <option selected value="">Pilih Unit</option>
                        <?php
                          $data = array();
                          $this->db->from('Business_Detail');
                          $this->db->where('typeBusiness', 'HOTEL');
                          $this->db->or_where('typeBusiness', 'OFFICE');
                          $query = $this->db->get();

                          if ($query->num_rows() > 0) {
                            foreach ($query->result() as $row) {
                              $data[] = $row;
                            }
                          }

                          $query->free_result();
                          foreach ($data as $index => $row) {
                            echo '<option value="' . $row->idBusiness . '">' . $row->Name . '</option>';
                          }
                        ?>
                      </select>
                    </td>
                    <td>
                      <input type="text" id="file-name" name="file-name" class="form-control" placeholder="Isi mengikuti nama upload file" readonly>
                    </td>
                    <td>
                      <select name="categoryUploads" class="form-control" id="category-select">
                          <option selected value="">Pilih Jenis Dokumen</option>
                          <?php
                            $data = array();
                            $this->db->from('uploads_categories');
                            $this->db->where('statusUploadcategories', 0);
                            $query = $this->db->get();

                            if ($query->num_rows() > 0) {
                              foreach ($query->result() as $row) {
                                $data[] = $row;
                              }
                            }

                            $query->free_result();
                            foreach ($data as $index => $row) {
                              echo '<option value="' . $row->kodeUploadcategories . '" title="' . $row->ketUploadcategories . '">' . $row->nmUploadcategories . '</option>';
                            }
                          ?>
                      </select>
                    </td>
                    <td>
                      <select name="departementUploads" class="form-control" id="departement-select">
                          <option selected value="">Pilih Departemen</option>
                          <?php                            
                            $data = array();
                            $this->db->from('uploads_departements');
                            $query = $this->db->get();

                            if ($query->num_rows() > 0) {
                              foreach ($query->result() as $row) {
                                $data[] = $row;
                              }
                            }

                            $query->free_result();
                            foreach ($data as $index => $row) {
                              echo '<option value="' . $row->nmUploaddepartements . '" title="' . $row->ketUploaddepartements . '">' . $row->nmUploaddepartements . '</option>';
                            }
                          ?>
                      </select>
                    </td>
                    <td>
                      <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan" rows="5"></textarea>
                    </td>
                    <td>
                      <input readonly type="text" name="boxcode" id="boxcode" class="form-control" style="color: red;">
                      <!-- Tombol untuk cetak nomor boxcode -->
                      <button type="button" id="print-boxcode" class="btn btn-warning btn-block" style="margin-top: 10px;">Print Boxcode</button>
                      <script>
                        // Event listener untuk tombol cetak
                        document.getElementById('print-boxcode').addEventListener('click', function () {
                          const boxcode = document.getElementById('boxcode').value;
                          const category = document.getElementById('category-select').value;
                          const department = document.getElementById('departement-select').value;

                          // Cek apakah boxcode, category-select, atau departement-select kosong
                          if (!boxcode) {
                            alert('Boxcode belum diisi!');
                            return;
                          }

                          if (!category) {
                            alert('Kategori belum dipilih!');
                            return;
                          }

                          if (!department) {
                            alert('Departemen belum dipilih!');
                            return;
                          }

                          // Jika semua validasi lulus, lakukan proses pencetakan
                          const printWindow = window.open('', '_blank');
                          printWindow.document.write(`
                            <html>
                              <head>
                                <title>Print Boxcode</title>
                                <style>
                                  .boxcode-container {
                                    display: inline-block; /* Mengatur agar lebar mengikuti isi */
                                    padding: 10px;
                                    border: solid 2px black;
                                    text-align: left;
                                    box-sizing: border-box;
                                  }
                                  .boxcode-container {
                                    margin: 0;
                                  }
                                </style>
                              </head>
                              <body>
                                <div class="boxcode-container">
                                  <h1 style="margin: 0;">Box Code: <span style="color: red;">${boxcode}</span></h1>
                                </div>
                                <script>
                                  window.print();
                                  window.onafterprint = window.close;
                                <\/script>
                              </body>
                            </html>
                          `);
                          printWindow.document.close();
                        });

                        document.getElementById('form-uploads').addEventListener('submit', function (e) {
                          const boxcode = document.getElementById('boxcode').value;
                          const category = document.getElementById('category-select').value;
                          const department = document.getElementById('departement-select').value;
                          const keterangan = document.getElementById('keterangan').value;
                          const fileName = document.getElementById('file-name').value;

                          // Cek apakah boxcode, category-select, file-name, atau departement-select kosong
                          if (!boxcode) {
                            alert('Boxcode belum diisi!');
                            e.preventDefault(); // Mencegah form submit
                            return;
                          }

                          if (!category) {
                            alert('Kategori belum dipilih!');
                            e.preventDefault(); // Mencegah form submit
                            return;
                          }

                          if (!department) {
                            alert('Departemen belum dipilih!');
                            e.preventDefault(); // Mencegah form submit
                            return;
                          }

                          if (!keterangan) {
                            alert('Keterangan file belum diisi!');
                            e.preventDefault(); // Mencegah form submit
                            return;
                          }

                          if (!fileName) {
                            alert('Nama file belum diisi!');
                            e.preventDefault(); // Mencegah form submit
                            return;
                          }

                          // Jika semua validasi lulus, form dapat disubmit
                        });
                      </script>
                    </td>
                    <td>
                      <input type="date" name="expired" class="form-control">
                    </td>
                    <td>
                      <input type="file" id="fileUploads" name="fileUploads" class="form-control">
                    </td>
                    <td>
                      <input class="btn btn-primary" type="submit" value="Upload files"></input>
                    </td>
                  </form>
                  <script>
                    document.getElementById('fileUploads').addEventListener('change', function () {
                      const file = this.files[0];
                      if (file) {
                        const fileNameWithoutExt = file.name.split('.').slice(0, -1).join('.');
                        document.getElementById('file-name').value = fileNameWithoutExt;
                      }
                    });
                  </script>
                </tr>
              </tbody>
            </table>
            <script type="text/javascript">
              document.addEventListener('DOMContentLoaded', function() {
                if (typeof $.fn.DataTable !== "undefined") {
                  console.log("Initializing Group DataTables...");
                  
                  $("#datatable-group").dataTable();
                }
              });
            </script>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>View all files</h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable" class="table table-bordered table-responsive table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Unit</th>
                  <th>Nama File</th>
                  <th>Departemen</th>
                  <th>Jenis Dokumen</th>
                  <th>Keterangan</th>
                  <th>Unggah Oleh</th>
                  <th>Expired</th>
                  <th>Status</th>
                  <th>File</th>
                  <th>Options</th>
                  <th>Action</th>
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

                  // Dapatkan tanggal 3 bulan dari sekarang
                  $currentDate = new DateTime();
                  $threeMonthsFromNow = $currentDate->modify('+3 months');
                  $threeMonthsFromNow = $threeMonthsFromNow->format('Y-m-d'); // Format: YYYY-MM-DD

                  foreach($data as $index => $row) {
                  // Cek apakah tanggal expired bernilai '0000-00-00'
                  $expiredDate = $row->expired_uploads;
                  $buttonClass = 'btn btn-success'; // Default tombol warna hijau
                  $pNotifyMessage = ''; // Default tidak ada pemberitahuan
                  $buttonText = 'secure';

                  if ($expiredDate == '0000-00-00') {
                    // Jika tanggal expired adalah '0000-00-00', lewati perbandingan dan set tombol hijau
                    $buttonClass = 'btn btn-secondary';
                    $buttonText = 'info';
                  } else {
                    // Bandingkan tanggal expired dengan 3 bulan dari sekarang
                    if (strtotime($expiredDate) <= strtotime($threeMonthsFromNow)) {
                      $buttonClass = 'btn btn-danger'; // Tombol warna merah jika expired dalam 3 bulan
                      $pNotifyMessage = 'Expired file ' . $row->kodeUploads; // Pesan PNotify
                      $buttonText = 'caution';
                    }
                  }
                ?>
                <tr>
                  <td><?php echo $row->kodeUploads ?></td>
                  <td><?php echo $row->Name ?></td>
                  <td><?php echo $row->nmUploads ?></td>
                  <td><?php echo $row->departementUploads ?></td>
                  <td><?php echo $row->categoryUploads ?></td>
                  <td><?php echo $row->ketUploads ?></td>
                  <td><?php echo $row->nmUser ?></td>
                  <td><?php echo $row->expired_uploads ?></td>
                  <td><button class="<?php echo $buttonClass; ?>"></button><span style="display: none;"><?php echo $buttonText ?></span></td>
                  <td><a href="<?php echo base_url($row->fileUploads) ?>" target="_blank"><?php echo $row->fileUploads ?></a></td>
                  
                  <?php if ($row->categoryUploads == 'DINAMIS_INAKTIF') : ?>
                    <form id="form-uploads" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('update-retensi') ?>" class="form-horizontal form-label-left">
                      <input type="hidden" class="form-control" name="idUploads" value="<?php echo $row->idUploads ?>">
                      <td>
                        <div class="radio-group">
                          <label>
                            <input type="radio" class="flat" name="iCheck" value="retensi" id="retensi-radio" checked> Retensi
                          </label>
                        </div>
                        <div id="retensi-date-container">
                          <label for="retensi-date">Tanggal Retensi:</label>
                          <input type="date" class="form-control" name="retensi_uploads" id="retensi-date" value="<?php echo $row->retensi_uploads ?>">
                        </div>
                      </td>
                      <td>
                        <input class="btn btn-primary" type="submit" value="Submit"></input>
                      </td>
                    </form>
                  <?php else : ?>
                    <form id="form-uploads" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('update-category') ?>" class="form-horizontal form-label-left">
                      <input type="hidden" class="form-control" name="idUploads" value="<?php echo $row->idUploads ?>">
                      <td>
                        <select name="categoryUploads" class="form-control" id="category-select">
                          <option selected value="">Pilih Jenis Dokumen</option>
                          <?php
                          $data = $this->db->from('uploads_categories')->get()->result();
                          foreach ($data as $row) :
                          ?>
                            <option value="<?= $row->kodeUploadcategories ?>" title="<?= $row->ketUploadcategories ?>">
                              <?= $row->nmUploadcategories ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                      <td>
                        <input class="btn btn-primary" type="submit" value="Submit"></input>
                      </td>
                    </form>
                  <?php endif; ?>
                  <script>
                    document.addEventListener("DOMContentLoaded", function () {
                      let retensiRadio = document.getElementById("retensi-radio");
                      let pemusnahanRadio = document.getElementById("pemusnahan-radio");
                      let retensiDateContainer = document.getElementById("retensi-date-container");

                      function toggleRetensiDate() {
                        if (retensiRadio.checked) {
                          retensiDateContainer.style.display = "block";
                        } else {
                          retensiDateContainer.style.display = "none";
                        }
                      }

                      // Set default state
                      toggleRetensiDate();

                      // Add event listeners
                      retensiRadio.addEventListener("change", toggleRetensiDate);
                      pemusnahanRadio.addEventListener("change", toggleRetensiDate);
                    });
                  </script>
                </tr>
                <?php 
                  if ($pNotifyMessage) {
                    // Tampilkan PNotify jika ada file yang expired dalam 3 bulan
                    echo '<script src="'.base_url().'/vendors/jquery/dist/jquery.min.js"></script>
                    <script src="'.base_url().'/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
                    <script src="'.base_url().'/vendors/pnotify/dist/pnotify.js"></script>
                    <script src="'.base_url().'/vendors/pnotify/dist/pnotify.buttons.js"></script>';

                    echo "<script type='text/javascript'>
                      new PNotify({
                        title: 'File expired soon',
                        text: '$pNotifyMessage',
                        type: 'error',
                        styling: 'bootstrap3'
                      });
                    </script>";
                  }
                }
                ?>
                <script type="text/javascript">
                  document.addEventListener('DOMContentLoaded', function() {
                    if (typeof $.fn.DataTable !== "undefined") {
                      console.log("Initializing DataTables...");
                      
                      $("#datatable").DataTable({
                        dom: "Bfrtip",
                        buttons: [
                          { extend: "copy", className: "btn-sm" },
                          { extend: "csv", className: "btn-sm" },
                          { extend: "excel", className: "btn-sm" },
                          { extend: "pdfHtml5", className: "btn-sm" },
                          { extend: "print", className: "btn-sm" },
                        ],
                      });
                    }
                  });
                </script>

              </tbody>
            </table>
          </div>
        </div>
      </div>

      <?php
        $data_categories = array();
        $this->db->from('uploads_categories');
        $this->db->where('statusUploadcategories', 0);
        $query_categories = $this->db->get();
        if ($query_categories->num_rows() > 0)
        {
          foreach ($query_categories->result() as $row)
          {
            $data_categories[] = $row;
          }
        }
        $query_categories->free_result();
        foreach($data_categories as $index => $row_categories) {
      ?>
      <div class="col-md-4 col-sm-4 col-xs-4">
        <div class="x_panel">
          <div class="x_title">
            <p>View files <?php echo $row_categories->nmUploadcategories ?></p>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable-<?php echo $row_categories->idUploadcategories ?>" class="table table-bordered table-responsive table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Unit</th>
                  <th>Nama File</th>
                  <th>Jenis Dokumen</th>
                  <th>File</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $data = array();
                  $this->db->from('uploads');
                  $this->db->join('user', 'user.idUser=uploads.idUser', 'left');
                  $this->db->join('Business_Detail', 'Business_Detail.idBusiness=uploads.idBusiness', 'left');
                  $this->db->where('categoryUploads', $row_categories->kodeUploadcategories);
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
                  <td><?php echo $row->kodeUploads ?></td>
                  <td><?php echo $row->Name ?></td>
                  <td><?php echo $row->nmUploads ?></td>
                  <td><?php echo $row->categoryUploads ?></td>
                  <td><a href="<?php echo base_url($row->fileUploads) ?>" target="_blank"><?php echo $row->fileUploads ?></a></td>
                </tr>
                <script type="text/javascript">
                  document.addEventListener('DOMContentLoaded', function() {
                    if (typeof $.fn.DataTable !== "undefined") {
                      console.log("Initializing Categories <?php echo $row_categories->nmUploadcategories ?> DataTables...");
                      
                      $("#datatable-<?php echo $row_categories->idUploadcategories ?>").dataTable();
                    }
                  });
                </script>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <?php } ?>
      <div class="col-md-4 col-sm-4 col-xs-4">
        <div class="x_panel">
          <div class="x_title">
            <p>View files RETENSI</p>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable-RETENSI" class="table table-bordered table-responsive table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Unit</th>
                  <th>Nama File</th>
                  <th>Jenis Dokumen</th>
                  <th>File</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $data = array();
                  $this->db->from('uploads');
                  $this->db->join('user', 'user.idUser=uploads.idUser', 'left');
                  $this->db->join('Business_Detail', 'Business_Detail.idBusiness=uploads.idBusiness', 'left');
                  $this->db->where('retensi_uploads !=', '0000-00-00');
                  $this->db->where('eleminasi_uploads !=', 1);
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
                  <form id="form-uploads" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('update-eleminasi') ?>" class="form-horizontal form-label-left">
                    <input type="hidden" class="form-control" name="idUploads" value="<?php echo $row->idUploads ?>">
                    <td><?php echo $row->kodeUploads ?></td>
                    <td><?php echo $row->Name ?></td>
                    <td><?php echo $row->nmUploads ?></td>
                    <td><?php echo $row->categoryUploads ?></td>
                    <td><a href="<?php echo base_url($row->fileUploads) ?>" target="_blank"><?php echo $row->fileUploads ?></a></td>
                    <td>
                      <input class="btn btn-danger" type="submit" value="Pemusnahan"></input>
                    </td>
                  </form>
                </tr>
                <script type="text/javascript">
                  document.addEventListener('DOMContentLoaded', function() {
                    if (typeof $.fn.DataTable !== "undefined") {
                      console.log("Initializing Categories RETENSI DataTables...");
                      
                      $("#datatable-RETENSI").dataTable();
                    }
                  });
                </script>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-4">
        <div class="x_panel">
          <div class="x_title">
            <p>View files ELIMINASI</p>
            <input type="date" name="date">
            <input type="submit" name="submit" class="btn btn-danger" value="Eliminasi">
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable-checkbox" class="table table-bordered table-responsive table-striped">
              <thead>
                <tr>
                  <th>
                    <th><input type="checkbox" id="check-all" ></th>
                  </th>
                  <th>No</th>
                  <th>Unit</th>
                  <th>Nama File</th>
                  <th>Jenis Dokumen</th>
                  <th>File</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $data = array();
                  $this->db->from('uploads');
                  $this->db->join('user', 'user.idUser=uploads.idUser', 'left');
                  $this->db->join('Business_Detail', 'Business_Detail.idBusiness=uploads.idBusiness', 'left');
                  $this->db->where('eleminasi_uploads', 1);
                  $this->db->where('status_eleminasi_uploads', 0);
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
                  <td>
                    <th><input type="checkbox" id="check-all" ></th>
                  </td>
                  <td><?php echo $row->kodeUploads ?></td>
                  <td><?php echo $row->Name ?></td>
                  <td><?php echo $row->nmUploads ?></td>
                  <td><?php echo $row->categoryUploads ?></td>
                  <td><a href="<?php echo base_url($row->fileUploads) ?>" target="_blank"><?php echo $row->fileUploads ?></a></td>
                  <td>
                    <input class="btn btn-danger" type="submit" value="Pemusnahan"></input>
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

<script>
  document.getElementById('business-select').addEventListener('change', function () {
    const idBusiness = this.value;
    fetch('generate_training_number_ajax', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ idBusiness }),
    })
      .then(response => response.json())
      .then(data => {
        // Set training number
        const trainingNumber = data.new_training_number;
        document.getElementById('training-number').value = trainingNumber;

        // Update boxcode
        updateBoxCode();
      })
      .catch(error => console.error('Error:', error));
  });

  document.getElementById('category-select').addEventListener('change', function () {
    updateBoxCode();
  });

  document.getElementById('departement-select').addEventListener('change', function () {
    updateBoxCode();
  });

  function updateBoxCode() {
    const trainingNumber = document.getElementById('training-number').value;
    
    // Cek apakah training-number sudah diisi
    if (!trainingNumber) {
      alert('Nomor Dokumen belum diisi!');
      return; // Hentikan eksekusi jika training number kosong
    }

    const categorySelect = document.getElementById('category-select');
    const departmentSelect = document.getElementById('departement-select');

    // Ambil nomor urut dari training number (setelah TSH-YYYYMMDD-)
    const sequenceNumber = trainingNumber.split('-')[0] + '-' + trainingNumber.split('-')[2]; // Contoh: 0001

    // Ambil kodeUploadcategories (diambil dari value category select)
    const categoryCode = categorySelect.value; // Contoh: DI

    // Ambil idUploaddepartements (diambil dari value department select)
    const departmentId = departmentSelect.selectedIndex; // Contoh: 1

    // Cek jika semua data tersedia
    if (sequenceNumber && categoryCode && departmentId >= 0) {
      const boxCode = `${sequenceNumber}-${categoryCode}-${departmentId}`;
      document.querySelector('[name="boxcode"]').value = boxCode;
    }
  }
</script>