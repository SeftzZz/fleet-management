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
        <h3>Form Report Security</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>Input Report Security</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <form id="form-security" method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/api/insertSecurityReport') ?>" class="form-horizontal form-label-left">
                      <table class="table table-bordered table-responsive table-striped">
                          <thead>
                              <tr>
                                  <th>Tanggal</th>
                                  <th>Petugas</th>
                                  <th>Area</th>
                                  <th>Status Keamanan</th>
                                  <th>Kejadian</th>
                                  <th>Shift</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td><input type="date" name="tanggal" class="form-control" required></td>
                                  <td><input type="text" name="petugas" class="form-control" required></td>
                                  <td><input type="text" name="lokasi" class="form-control" required></td>
                                  <td>
                                      <select name="status_keamanan" class="form-control">
                                          <option value="Aman">Aman</option>
                                          <option value="Perlu Perhatian">Perlu Perhatian</option>
                                          <option value="Darurat">Darurat</option>
                                      </select>
                                  </td>
                                  <td><textarea name="kejadian" class="form-control" rows="3"></textarea></td>
                                  <td>
                                      <select name="shift" class="form-control">
                                          <option value="Pagi">Pagi</option>
                                          <option value="Siang">Siang</option>
                                          <option value="Malam">Malam</option>
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
                  <h2>View Security Reports</h2>
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
                  <table id="datatable-security" class="table table-bordered table-responsive table-striped">
                      <thead>
                          <tr>
                              <th>Tanggal</th>
                              <th>Petugas</th>
                              <th>Area</th>
                              <th>Status Keamanan</th>
                              <th>Kejadian</th>
                              <th>Shift</th>
                          </tr>
                      </thead>
                      <tbody id="data-security">
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
  document.getElementById('form-security').addEventListener('submit', function(event) {
    event.preventDefault();

    let formData = new FormData(this);

    fetch('<?php echo base_url('cms/api/insertSecurityReport') ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        document.getElementById('form-security').reset();
        fetchReports();
    })
    .catch(error => {
        console.error('Error:', error);
    });
  });

  function fetchData() {
    let periode = document.getElementById('periode').value;

    fetch('<?php echo base_url('cms/api/getSecurityReportsByPeriode') ?>', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ periode: periode })
    })
    .then(response => response.json())
    .then(responseData => {
        let table = $('#datatable-security').DataTable();
        table.clear();

        let totalAman = 0;
        let totalPerluPerhatian = 0;
        let totalDarurat = 0;

        if (responseData.status && Array.isArray(responseData.data)) {
            responseData.data.forEach(row => {
                // Hitung jumlah status keamanan
                if (row.status_keamanan === 'Aman') totalAman++;
                if (row.status_keamanan === 'Perlu Perhatian') totalPerluPerhatian++;
                if (row.status_keamanan === 'Darurat') totalDarurat++;

                table.row.add([
                    row.tanggal || '-',
                    row.petugas || '-',
                    row.lokasi || '-',
                    `<span class="badge badge-${row.status_keamanan === 'Aman' ? 'success' : row.status_keamanan === 'Perlu Perhatian' ? 'warning' : 'danger'}">${row.status_keamanan}</span>`,
                    row.kejadian || '-',
                    row.shift || '-'
                ]);
            });

            // Tambahkan baris total status keamanan
            table.row.add([
                '<strong>Total:</strong>',
                '',
                '',
                `Aman: ${totalAman}, Perlu Perhatian: ${totalPerluPerhatian}, Darurat: ${totalDarurat}`,
                '',
                ''
            ]);

            table.draw();
        } else {
            table.row.add(['Data tidak ditemukan', '', '', '', '', '']).draw();
        }
    })
    .catch(error => console.error('Error:', error));
  }

  document.addEventListener('DOMContentLoaded', fetchData);
  document.getElementById('periode').addEventListener('change', fetchData);
</script>
