<style type="text/css">
  a:hover {
    color: blue;
  }
</style>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Form Report Engineering</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>Input Report Engineering</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <form id="form-engineering" method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/api/insertEngineering') ?>" class="form-horizontal form-label-left">
                      <table class="table table-bordered table-responsive table-striped">
                          <thead>
                              <tr>
                                  <th>Tanggal</th>
                                  <th>Area</th>
                                  <th>Jenis Pekerjaan</th>
                                  <th>Remark</th>
                                  <th>Shift</th>
                                  <th>Status</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td><input type="date" name="tanggal" class="form-control" required></td>
                                  <td>
                                      <select name="lokasi" class="form-control" required>
                                          <option value="">Pilih Area</option>
                                          <option value="public_area">Fasilitas Publik</option>
                                          <option value="hotel_area">Fasilitas Hotel</option>
                                          <option value="guest_area">Fasilitas Tamu</option>
                                      </select>
                                  </td>
                                  <td>
                                      <select name="jenis_kerusakan" class="form-control">
                                          <option value="pemeliharaan_harian">Pemeliharaan Harian</option>
                                          <option value="pemeliharaan_mingguan">Pemeliharaan Mingguan</option>
                                          <option value="pemeliharaan_bulanan">Pemeliharaan Bulanan</option>
                                          <option value="perbaikan">Perbaikan</option>
                                      </select>
                                  </td>
                                  <td><textarea name="deskripsi" class="form-control" rows="3" required></textarea></td>
                                  <td>
                                      <select name="shift" class="form-control">
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                      </select>
                                  </td>
                                  <td>
                                      <select name="status" class="form-control">
                                          <option value="pending">Pending</option>
                                          <option value="in_progress">In Progress</option>
                                          <option value="completed">Completed</option>
                                      </select>
                                  </td>
                                  <td><input class="btn btn-primary" type="submit" value="Submit Report"></td>
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
                  <h2>View Engineering Reports</h2>
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
                              <th>Area</th>
                              <th>Jenis Pekerjaan</th>
                              <th>Deskripsi Pekerjaan</th>
                              <th>Shift</th>                              
                              <th>Status</th>
                          </tr>
                      </thead>
                      <tbody id="data-engineering">
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
  document.getElementById('form-engineering').addEventListener('submit', function(event) {
    event.preventDefault();

    let formData = new FormData(this);

    fetch('<?php echo base_url('cms/api/insertEngineering') ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        document.getElementById('form-engineering').reset();
        fetchReports();
    })
    .catch(error => {
        console.error('Error:', error);
    });
  });

  function fetchData() {
    let periode = document.getElementById('periode').value; // Ambil nilai periode dari dropdown
    
    fetch('<?php echo base_url('cms/api/getEngineeringByPeriode') ?>', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ periode: periode }) // Kirim periode ke API
    })
    .then(response => response.json())
    .then(responseData => {
        let table = $('#datatable-buttons').DataTable();
        table.clear(); // Bersihkan data sebelumnya

        let totalPending = 0;
        let totalCompleted = 0;
        let totalInProgress = 0;

        let totalPemeliharaan_harian = 0;
        let totalPemeliharaan_mingguan = 0;
        let totalPemeliharaan_bulanan = 0;
        let totalPerbaikan = 0;

        if (responseData.status && Array.isArray(responseData.data)) {
            responseData.data.forEach(row => {
                // Hitung jumlah status
                if (row.status === 'pending') totalPending++;
                if (row.status === 'completed') totalCompleted++;
                if (row.status === 'in_progress') totalInProgress++;

                // Hitung jumlah jenis_kerusakan
                if (row.jenis_kerusakan === 'pemeliharaan_harian') totalPemeliharaan_harian++;
                if (row.jenis_kerusakan === 'pemeliharaan_mingguan') totalPemeliharaan_mingguan++;
                if (row.jenis_kerusakan === 'pemeliharaan_bulanan') totalPemeliharaan_bulanan++;
                if (row.jenis_kerusakan === 'perbaikan') totalPerbaikan++;

                table.row.add([
                    row.tanggal || '-',
                    row.lokasi || '-',
                    row.jenis_kerusakan || '-',
                    row.deskripsi || '-',
                    row.shift || '-',
                    `<span class="badge badge-${row.status === 'pending' ? 'danger' : row.status === 'completed' ? 'success' : 'warning'}">${row.status}</span>`,
                    row.file_path ? `<a href="<?php echo base_url() ?>${row.file_path}" target="_blank">Download</a>` : '-'
                ]);
            });

            // Tambahkan baris total status
            table.row.add([
                '<strong>Total:</strong>',
                '',
                `pemeliharaan_harian: ${totalPemeliharaan_harian}, pemeliharaan_mingguan: ${totalPemeliharaan_mingguan}, pemeliharaan_bulanan: ${totalPemeliharaan_bulanan}, perbaikan: ${totalPerbaikan}`,
                '',
                '',
                `pending: ${totalPending}, in_progress: ${totalInProgress}, completed: ${totalCompleted}`,
                ''
            ]);

            table.draw(); // Update tabel
        } else {
            table.row.add(['Data tidak ditemukan', '', '', '', '', '']).draw();
        }
    })
    .catch(error => console.error('Error:', error));
  }

  document.addEventListener('DOMContentLoaded', fetchData);
  document.getElementById('periode').addEventListener('change', fetchData);
</script>
