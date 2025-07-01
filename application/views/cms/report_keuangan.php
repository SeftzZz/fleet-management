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
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>Input Laporan Keuangan</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <form id="form-keuangan" method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/api/insertKeuanganByPeriode') ?>" class="form-horizontal form-label-left">
                      <table class="table table-bordered table-responsive table-striped">
                          <thead>
                              <tr>
                                  <th>Tanggal</th>
                                  <!-- <th>Pemasukan</th>
                                  <th>Pengeluaran</th>
                                  <th>Laba Rugi</th> -->
                                  <th>Keterangan</th>
                                  <th>Status Report</th>
                                  <th>File</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td><input type="date" name="tanggal" class="form-control" required></td>
                                  <!-- <td><input type="number" id="pemasukan" name="pemasukan" class="form-control" required></td>
                                  <td><input type="number" id="pengeluaran" name="pengeluaran" class="form-control" required></td>
                                  <td><input type="text" id="laba_rugi" name="laba_rugi" class="form-control" readonly></td> -->
                                  <td><textarea name="keterangan" class="form-control" rows="3"></textarea></td>
                                  <td>
                                      <select name="status_report" class="form-control">
                                          <option value="draft">Draft</option>
                                          <option value="hold">Hold</option>
                                          <option value="approved">Approved</option>
                                      </select>
                                  </td>
                                  <td><input type="file" name="fileUploads" class="form-control"></td>
                                  <td><input class="btn btn-primary" type="submit" value="Upload Laporan"></td>
                              </tr>
                          </tbody>
                      </table>
                  </form>
              </div>
          </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>View Laporan Keuangan</h2>
                  <div class="clearfix"></div>
                  <label for="periode">Pilih Periode:</label>
                  <select id="periode" onchange="fetchData()">
                      <option value="harian">Harian</option>
                      <option value="mingguan">Mingguan</option>
                      <option value="bulanan">Bulanan</option>
                      <option value="semesteran">Semesteran</option>
                      <option value="tahunan">Tahunan</option>
                  </select>
              </div>
              <div class="x_content">
                  <table id="datatable-buttons" class="table table-bordered table-responsive table-striped">
                      <thead>
                          <tr>
                              <th>Tanggal</th>
                              <!-- <th>Pemasukan</th>
                              <th>Pengeluaran</th>
                              <th>Saldo</th> -->
                              <th>Keterangan</th>
                              <th>Status Report</th>
                              <th>File</th>
                          </tr>
                      </thead>
                      <tbody id="data-keuangan">
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<script>
  document.getElementById('form-keuangan').addEventListener('submit', function(event) {
    event.preventDefault();

    let formData = new FormData(this);

    fetch('https://cms.sahirahotelsgroup.com/cms/api/insertKeuanganByPeriode', {
        method: 'POST',
        body: formData // Kirim langsung FormData tanpa JSON.stringify
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        document.getElementById('form-keuangan').reset(); // Kosongkan form setelah sukses
        fetchData();
    })
    .catch(error => {
        console.error('Error:', error);
    });
  });


  document.getElementById('pemasukan').addEventListener('input', hitungLabaRugi);
  document.getElementById('pengeluaran').addEventListener('input', hitungLabaRugi);

  function hitungLabaRugi() {
    let pemasukan = parseFloat(document.getElementById('pemasukan').value) || 0;
    let pengeluaran = parseFloat(document.getElementById('pengeluaran').value) || 0;
    let labaRugi = pemasukan - pengeluaran;
    document.getElementById('laba_rugi').value = labaRugi;
  }

  function formatCurrency(value) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
    }).format(value);
  }

  function fetchData() {
    let periode = document.getElementById('periode').value;
    fetch('<?php echo base_url('cms/api/getKeuanganByPeriode') ?>', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ periode: periode })
    })
    .then(response => response.json())
    .then(responseData => {
        let table = $('#datatable-buttons').DataTable();
        table.clear(); // Clear previous data

        let totalPemasukan = 0;
        let totalPengeluaran = 0;
        let totalLabaRugi = 0;

        // Akumulasi untuk status report
        let countDraft = 0;
        let countHold = 0;
        let countApproved = 0;

        if (responseData.status && Array.isArray(responseData.data)) {
            responseData.data.forEach(row => {
                totalPemasukan += parseFloat(row.pemasukan) || 0;
                totalPengeluaran += parseFloat(row.pengeluaran) || 0;
                totalLabaRugi += parseFloat(row.laba_rugi) || 0;

                // Akumulasi untuk status report
                if (row.status_report === 'draft') {
                    countDraft++;
                } else if (row.status_report === 'hold') {
                    countHold++;
                } else if (row.status_report === 'approved') {
                    countApproved++;
                }

                // Tentukan kelas untuk status report
                let statusClass = '';
                if (row.status_report === 'draft') {
                    statusClass = 'btn btn-secondary'; // Draft
                } else if (row.status_report === 'hold') {
                    statusClass = 'btn btn-danger'; // Hold
                } else if (row.status_report === 'approved') {
                    statusClass = 'btn btn-success'; // Approved
                }

                table.row.add([
                    row.tanggal || '-',
                    // formatCurrency(row.pemasukan), // Format pemasukan
                    // formatCurrency(row.pengeluaran), // Format pengeluaran
                    // formatCurrency(row.laba_rugi), // Format laba rugi
                    row.keterangan || '-',
                    `<button class="${statusClass}">${row.status_report}</button>`, // Menambahkan tombol dengan kelas
                    row.file_path ? `<a href="<?php echo base_url() ?>${row.file_path}" target="_blank">Download</a>` : '-'
                ]);
            });

            // Menambahkan baris untuk akumulasi total
            table.row.add([
                '<strong>Total:</strong>',
                // formatCurrency(totalPemasukan), // Format total pemasukan
                // formatCurrency(totalPengeluaran), // Format total pengeluaran
                // formatCurrency(totalLabaRugi), // Format total laba rugi
                '',
                `Draft: ${countDraft}, Hold: ${countHold}, Approved: ${countApproved}`,
                ''
            ]);

            table.draw(); // Redraw the table to show new data
        } else {
            table.row.add(['Data tidak ditemukan', '', '', '', '', '', '']).draw();
        }
    })
    .catch(error => console.error('Error:', error));
  }

  document.addEventListener('DOMContentLoaded', fetchData);
</script>