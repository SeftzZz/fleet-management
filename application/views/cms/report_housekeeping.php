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
      text: "Laporan Berhasil Diupload",
      type: "success",
      confirmButtonText: null
    });
  </script>
<?php } ?>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Form Laporan Housekeeping</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Input Laporan Housekeeping</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form id="form-housekeeping" method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/api/insertHousekeepingReport') ?>" class="form-horizontal">
              <table class="table table-bordered table-responsive table-striped">
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Area</th>
                    <th>Jenis Pekerjaan</th>
                    <th width="20px">Jumlah Personel</th>
                    <th width="200px">Petugas</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>File</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="date" name="tanggal" class="form-control" required></td>
                    
                    <td>
                      <select name="kamar" class="form-control" required>
                        <option disabled value="">Pilih Area</option>
                        <?php foreach ($assignments as $area): ?>
                          <option value="<?= $area->location_id ?>">Fasilitas <?= $area->location_name ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>

                    <td>
                      <select name="kondisi_awal" class="form-control" required>
                        <option value="pemeliharaan_harian">Pemeliharaan Harian</option>
                        <option value="pemeliharaan_mingguan">Pemeliharaan Mingguan</option>
                        <option value="pemeliharaan_bulanan">Pemeliharaan Bulanan</option>
                        <option value="perbaikan">Perbaikan</option>
                      </select>
                    </td>

                    <td>
                      <input type="number" name="jumlah_personel" id="jumlah_personel" class="form-control" placeholder="Jumlah Petugas" min="1" required>
                    </td>

                    <td>
                      <!-- Select petugas -->
                      <select name="housekeeper[]" id="housekeeper_select" class="form-control mt-2" multiple required style="height: 215px;">
                        <option disabled value="">Pilih Petugas</option>
                        <?php foreach ($housekeeping_users as $user): ?>
                          <option value="<?= $user->idKaryawan ?>"><?= $user->nmKaryawan ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>

                    <td>
                      <textarea name="masalah" class="form-control" placeholder="Keterangan / Masalah" rows="10"></textarea>
                    </td>

                    <td>
                      <select name="status" class="form-control" required>
                        <option value="pending">Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                      </select>
                    </td>

                    <td>
                      <input type="file" name="fileUploads" class="form-control">
                    </td>

                    <td>
                      <input class="btn btn-primary" type="submit" value="Upload Laporan">
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>View Laporan Housekeeping</h2>
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
                  <th>Personel</th>
                  <th>Jenis Pekerjaan</th>
                  <th>Lost & Found</th>
                  <th>Status</th>
                  <th>File</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="data-housekeeping">
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
  document.addEventListener('DOMContentLoaded', function () {
    const jumlahInput = document.getElementById('jumlah_personel');
    const select = document.getElementById('housekeeper_select');

    if (!jumlahInput || !select) return; // jaga-jaga kalau elemen tidak ketemu

    jumlahInput.addEventListener('input', function () {
      const jumlah = parseInt(this.value) || 0;

      select.onchange = function () {
        const selected = Array.from(select.selectedOptions);
        if (selected.length > jumlah) {
          selected[selected.length - 1].selected = false;
          alert(`Maksimal ${jumlah} petugas dapat dipilih.`);
        }
      };
    });
  });
  
  document.getElementById('form-housekeeping').addEventListener('submit', function(event) {
    event.preventDefault();
    let formData = new FormData(this);
    fetch('<?php echo base_url('cms/api/insertHousekeepingReport') ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        document.getElementById('form-housekeeping').reset();
        fetchData();
    })
    .catch(error => console.error('Error:', error));
  });

  function fetchData() {
    let periode = document.getElementById('periode').value; // Ambil nilai periode dari dropdown
    
    fetch('<?php echo base_url('cms/api/getHousekeepingByPeriode') ?>', {
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
                const housekeepingUsers = <?= json_encode($housekeeping_users) ?>;
                const assignments = <?= json_encode($assignments) ?>;
                console.log('assignments:', assignments);

                // Convert housekeeper (1,6,1) to names
                let housekeeperNames = '-';
                if (row.housekeeper) {
                    let ids = row.housekeeper.split(','); // ["1", "6", "1"]
                    let names = ids.map(id => {
                        let user = housekeepingUsers.find(u => u.idKaryawan == id.trim());
                        return user ? user.nmKaryawan : id;
                    });
                    housekeeperNames = [...new Set(names)].join(', '); // Hilangkan duplikat
                }

                let location = '-';
                if (row.kamar) {
                    let ids = row.kamar.split(','); // ex: ["1", "6", "1"]
                    let names = ids.map(id => {
                        let fasilitas = assignments.find(u => u.location_id.toString().trim() === id.trim());
                        return fasilitas ? fasilitas.location_name : id;
                    });
                    location = [...new Set(names)].join(', ');
                    console.log('location:', location);
                }

                let statusBadge = `<span class="badge badge-${row.status === 'pending' ? 'danger' : 'success'}">${row.status}</span>`;
                if (row.status === 'completed' && row.updated_at) {
                    statusBadge += `<br><small>${row.updated_at}</small>`;
                }

                let statusButton = '';
                if (row.status !== 'completed') {
                    statusButton = `<button class="btn btn-primary btn-submit-status" data-id="${row.id}">Complete now</button>`;
                }


                // Hitung jumlah status
                if (row.status === 'pending') totalPending++;
                if (row.status === 'completed') totalCompleted++;
                if (row.status === 'in_progress') totalInProgress++;

                // Hitung jumlah jenis_pekerjaan
                if (row.kondisi_awal === 'pemeliharaan_harian') totalPemeliharaan_harian++;
                if (row.kondisi_awal === 'pemeliharaan_mingguan') totalPemeliharaan_mingguan++;
                if (row.kondisi_awal === 'pemeliharaan_bulanan') totalPemeliharaan_bulanan++;
                if (row.kondisi_awal === 'perbaikan') totalPerbaikan++;

                table.row.add([
                    row.tanggal || '-',
                    location || '-',
                    housekeeperNames || '-',
                    row.kondisi_awal || '-',
                    row.masalah || '-',
                    statusBadge,
                    row.file_path ? `<a href="<?php echo base_url() ?>${row.file_path}" target="_blank">Download</a>` : '-',
                    statusButton
                ]);
            });

            // Tambahkan baris total status
            table.row.add([
                '<strong>Total:</strong>',
                '',
                '',
                `pemeliharaan_harian: ${totalPemeliharaan_harian}, pemeliharaan_mingguan: ${totalPemeliharaan_mingguan}, pemeliharaan_bulanan: ${totalPemeliharaan_bulanan}, perbaikan: ${totalPerbaikan}`,
                '',
                `pending: ${totalPending}, in_progress: ${totalInProgress}, completed: ${totalCompleted}`,
                '',
                ''
            ]);

            table.draw(); // Update tabel
        } else {
            table.row.add(['Data tidak ditemukan', '', '', '', '', '', '', '']).draw();
        }
    })
    .catch(error => console.error('Error:', error));
  }

  document.addEventListener('DOMContentLoaded', fetchData);
</script>
