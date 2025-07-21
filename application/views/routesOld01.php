            <!-- Main Content -->
            <div class="col-md-10 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="bi bi-signpost-split me-2"></i> Rute & Ritasi</h2>
                    <div class="d-flex">
                        <div class="input-group me-2" style="width: 250px;">
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                            <input type="date" class="form-control" value="2023-06-15">
                        </div>
                        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#tambahRitasiModal">
                            <i class="bi bi-plus-circle"></i> Tambah Ritasi
                        </button>
                        <button class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-clockwise"></i> Refresh
                        </button>
                    </div>
                </div>

                <!-- Stat Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card stat-card primary h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="text-muted">Ritasi Hari Ini</h6>
                                        <h3 class="mb-0">48</h3>
                                    </div>
                                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-signpost text-primary" style="font-size: 1.5rem;"></i>
                                    </div>
                                </div>
                                <p class="text-muted mt-2 mb-0">
                                    <span class="text-success"><i class="bi bi-arrow-up"></i> 14%</span> dari kemarin
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stat-card success h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="text-muted">Ritasi Bulan Ini</h6>
                                        <h3 class="mb-0">1,248</h3>
                                    </div>
                                    <div class="bg-success bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-arrow-repeat text-success" style="font-size: 1.5rem;"></i>
                                    </div>
                                </div>
                                <p class="text-muted mt-2 mb-0">
                                    <span class="text-success"><i class="bi bi-arrow-up"></i> 12.7%</span> dari bulan lalu
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stat-card warning h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="text-muted">Rata-rata KM/Hari</h6>
                                        <h3 class="mb-0">187</h3>
                                    </div>
                                    <div class="bg-warning bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-speedometer2 text-warning" style="font-size: 1.5rem;"></i>
                                    </div>
                                </div>
                                <p class="text-muted mt-2 mb-0">
                                    <span class="text-danger"><i class="bi bi-arrow-down"></i> 5.3%</span> dari bulan lalu
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stat-card danger h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="text-muted">Ritasi Tertunda</h6>
                                        <h3 class="mb-0">3</h3>
                                    </div>
                                    <div class="bg-danger bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-exclamation-triangle text-danger" style="font-size: 1.5rem;"></i>
                                    </div>
                                </div>
                                <p class="text-muted mt-2 mb-0">
                                    <span class="text-success"><i class="bi bi-arrow-down"></i> 25%</span> dari minggu lalu
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs mb-4" id="ritasiTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="daftar-rute-tab" data-bs-toggle="tab" data-bs-target="#daftar-rute" type="button" role="tab">Daftar Rute</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="log-ritasi-tab" data-bs-toggle="tab" data-bs-target="#log-ritasi" type="button" role="tab">Log Ritasi Harian</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="statistik-tab" data-bs-toggle="tab" data-bs-target="#statistik" type="button" role="tab">Statistik Ritasi</button>
                    </li>
                </ul>

                <!-- Tabs Content -->
                <div class="tab-content" id="ritasiTabsContent">
                    <!-- Daftar Rute Tab -->
                    <div class="tab-pane fade show active" id="daftar-rute" role="tabpanel">
                        <div class="card">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Daftar Rute</h5>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambahRuteModal">
                                    <i class="bi bi-plus"></i> Tambah Rute
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Asal</th>
                                                <th>Tujuan</th>
                                                <th>Jarak (KM)</th>
                                                <th>Waktu Tempuh</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($routes as $route): ?>
                                            <?php 
                                                // $duration = $route->estimated_time; // dalam menit

                                                // $hours = floor($duration / 60);
                                                // $minutes = $duration % 60;

                                                // $travel_time = '';
                                                // if ($hours > 0) {
                                                //     $travel_time .= $hours . ' jam ';
                                                // }
                                                // $travel_time .= $minutes . ' menit';
                                            ?>
                                            <tr>
                                                <td><?php echo html_escape($route->start_point); ?></td>
                                                <td><?php echo html_escape($route->end_point); ?></td>
                                                <td><?php echo number_format($route->planned_distance, 2); ?></td>
                                                <td><?php // echo $travel_time; ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary" onclick="editRoute(<?php echo $route->id; ?>)">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete(<?php echo $route->id; ?>)">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <?php echo $pagination; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    
                    <script>
                        function editRoute(id) {
                            // AJAX call to get route data and populate edit modal
                            // Implementation depends on your edit functionality
                        }

                        function confirmDelete(id) {
                            if (confirm('Apakah Anda yakin ingin menghapus rute ini?')) {
                                fetch('<?php echo base_url("api/route/delete/"); ?>' + id, {
                                    method: 'DELETE',
                                    headers: {
                                        'Authorization': 'Bearer ' + localStorage.getItem('token'),
                                        'Content-Type': 'application/json'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.status === 'deleted') {
                                        showToast('Rute berhasil dihapus!', 'success');
                                        // Refresh daftar rute, misal:
                                        setTimeout(() => {
                                            window.location.reload();
                                        }, 1500); // delay 1.5 detik supaya toast sempat tampil
                                        // loadRouteOptions();
                                        // Atau reload table/rute yang tampil
                                    } else {
                                        showToast('Gagal menghapus rute', 'danger');
                                    }
                                })
                                .catch(err => {
                                    console.error('Error:', err);
                                    showToast('Terjadi kesalahan saat menghapus rute', 'danger');
                                });
                            }
                        }
                    </script>

                    <!-- Log Ritasi Harian Tab -->
                    <div class="tab-pane fade" id="log-ritasi" role="tabpanel">
                        <div class="card">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Log Ritasi Harian</h5>
                                <div>
                                    <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#inputLogRitasiModal">
                                        <i class="bi bi-plus"></i> Tambah Log
                                    </button>
                                    <button class="btn btn-sm btn-success">
                                        <i class="bi bi-file-earmark-excel"></i> Export
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>No. Polisi</th>
                                                <th>Supir</th>
                                                <th>Rute</th>
                                                <th>Jarak (KM)</th>
                                                <th>Muatan</th>
                                                <th>Waktu</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>15 Jun 2023</td>
                                                <td>B 1234 XYZ</td>
                                                <td>Ahmad</td>
                                                <td>Jakarta - Bandung</td>
                                                <td>150</td>
                                                <td>Pasir (12 Ton)</td>
                                                <td>4 jam 15 menit</td>
                                                <td><span class="badge bg-success">Selesai</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                                                    <button class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <!-- Statistik Ritasi Tab -->
                    <div class="tab-pane fade" id="statistik" role="tabpanel">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card mb-4">
                                    <div class="card-header bg-white">
                                        <h5 class="mb-0">Statistik Ritasi Bulanan</h5>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="ritasiChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-header bg-white">
                                        <h5 class="mb-0">Distribusi Rute</h5>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="routeDistributionChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-white">
                                        <h5 class="mb-0">Top 5 Supir</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="list-group list-group-flush">
                                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-1">Ahmad</h6>
                                                    <small class="text-muted">B 1234 XYZ</small>
                                                </div>
                                                <span class="badge bg-primary">48 Ritasi</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-white">
                                        <h5 class="mb-0">Top 5 Kendaraan</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="list-group list-group-flush">
                                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-1">B 1234 XYZ</h6>
                                                    <small class="text-muted">Dump Truck - Hino</small>
                                                </div>
                                                <span class="badge bg-success">2,450 KM</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="toastContainer" class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100;"></div>

    <!-- Modal Tambah Ritasi -->
    <div class="modal fade" id="tambahRitasiModal" tabindex="-1" aria-labelledby="tambahRitasiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahRitasiModalLabel"><i class="bi bi-plus-circle me-2"></i>Tambah Ritasi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambahRitasi">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="ritasi_date" class="form-label">Tanggal Ritasi</label>
                                <input type="date" class="form-control" id="ritasi_date" name="ritasi_date" required>
                            </div>
                            <div class="col-md-6">
                                <label for="vehicle_id" class="form-label">Kendaraan</label>
                                <select class="form-select" id="vehicle_id" name="vehicle_id" required>
                                    <option value="" selected disabled>Pilih Kendaraan</option>
                                    <!-- Data akan diisi dari database -->
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="driver_id" class="form-label">Supir</label>
                                <select class="form-select" id="driver_id" name="driver_id" required>
                                    <option value="" selected disabled>Pilih Supir</option>
                                    <!-- Data akan diisi dari database -->
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="route_id" class="form-label">Rute</label>
                                <select class="form-select" id="route_id" name="route_id" required>
                                    <option value="" selected disabled>Pilih Rute</option>
                                    <!-- Data akan diisi dari database -->
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="bak_number" class="form-label">Nomor Bak</label>
                                <input type="text" class="form-control" id="bak_number" name="bak_number" required>
                            </div>
                            <div class="col-md-4">
                                <label for="jam_angkut" class="form-label">Jam Angkut</label>
                                <input type="time" class="form-control" id="jam_angkut" name="jam_angkut" required>
                            </div>
                            <div class="col-md-4">
                                <label for="no_do" class="form-label">Nomor DO</label>
                                <input type="text" class="form-control" id="no_do" name="no_do" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="simpanRitasi">Simpan Ritasi</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Rute -->
    <div class="modal fade" id="tambahRuteModal" tabindex="-1" aria-labelledby="tambahRuteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahRuteModalLabel"><i class="bi bi-signpost-split me-2"></i>Tambah Rute Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambahRute">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="start_point" class="form-label">Asal</label>
                                <input type="text" class="form-control" id="start_point" name="start_point" required>
                            </div>
                            <div class="col-md-6">
                                <label for="end_point" class="form-label">Tujuan</label>
                                <input type="text" class="form-control" id="end_point" name="end_point" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="planned_distance" class="form-label">Jarak Rencana (KM)</label>
                                <input type="number" step="0.01" class="form-control" id="planned_distance" name="planned_distance" required>
                            </div>
                            <div class="col-md-6">
                                <label for="estimated_time" class="form-label">Perkiraan Waktu (Menit)</label>
                                <input type="text" class="form-control" id="estimated_time" name="estimated_time" placeholder="Contoh: 3 jam 30 menit">
                            </div>
                        </div>
                        <!-- <div class="mb-3">
                            <div id="map" style="height: 300px; width: 100%; margin-top: 15px;"></div>
                        </div> -->
                        <div class="mb-3">
                            <label for="notes" class="form-label">Catatan Rute</label>
                            <textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="simpanRute">Simpan Rute</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Input Log Ritasi Harian -->
    <div class="modal fade" id="inputLogRitasiModal" tabindex="-1" aria-labelledby="inputLogRitasiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inputLogRitasiModalLabel"><i class="bi bi-journal-plus me-2"></i>Input Log Ritasi Harian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formLogRitasi">
                        <!-- Tanggal & Kendaraan -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="log_ritasi_date" class="form-label">Tanggal Ritasi</label>
                                <input type="date" class="form-control" id="log_ritasi_date" name="ritasi_date" required>
                            </div>
                            <div class="col-md-6">
                                <label for="log_vehicle_id" class="form-label">Kendaraan</label>
                                <select class="form-select" id="log_vehicle_id" name="vehicle_id" required>
                                    <option value="" selected disabled>Pilih Kendaraan</option>
                                    <!-- Data akan diisi dari database -->
                                </select>
                            </div>
                        </div>

                        <!-- Supir & Rute -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="log_driver_id" class="form-label">Supir</label>
                                <select class="form-select" id="log_driver_id" name="driver_id" required>
                                    <option value="" selected disabled>Pilih Supir</option>
                                    <!-- Data akan diisi dari database -->
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="log_route_id" class="form-label">Rute</label>
                                <select class="form-select" id="log_route_id" name="route_id" required>
                                    <option value="" selected disabled>Pilih Rute</option>
                                    <!-- Data akan diisi dari database -->
                                </select>
                            </div>
                        </div>

                        <!-- Nomor Bak, Jam Angkut, Nomor DO -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="log_bak_number" class="form-label">Nomor Bak</label>
                                <input type="text" class="form-control" id="log_bak_number" name="bak_number" required>
                            </div>
                            <div class="col-md-4">
                                <label for="log_jam_angkut" class="form-label">Jam Angkut</label>
                                <input type="time" class="form-control" id="log_jam_angkut" name="jam_angkut" required>
                            </div>
                            <div class="col-md-4">
                                <label for="log_no_do" class="form-label">Nomor DO</label>
                                <input type="text" class="form-control" id="log_no_do" name="no_do" required>
                            </div>
                        </div>

                        <!-- Jarak & Waktu Selesai -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="log_actual_distance" class="form-label">Jarak Aktual (KM)</label>
                                <input type="number" step="0.01" class="form-control" id="log_actual_distance" name="actual_distance">
                            </div>
                            <div class="col-md-6">
                                <label for="log_end_time" class="form-label">Waktu Selesai</label>
                                <input type="datetime-local" class="form-control" id="log_end_time" name="end_time">
                            </div>
                        </div>

                        <!-- Catatan Tambahan -->
                        <div class="mb-3">
                            <label for="log_notes" class="form-label">Catatan Tambahan</label>
                            <textarea class="form-control" id="log_notes" name="notes" rows="3"></textarea>
                        </div>

                        <!-- Tambahan: Input Saldo Wallet (Uang Jalan) -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="log_wallet_amount" class="form-label">Saldo Uang Jalan (Rp)</label>
                                <input type="text" min="0" class="form-control" id="log_wallet_amount" name="wallet_amount" placeholder="0">
                                <div class="form-text">Masukkan jumlah uang jalan yang akan ditambahkan ke wallet driver.</div>
                            </div>
                        </div>
                        <script>
                            const walletInput = document.getElementById('log_wallet_amount');

                            walletInput.addEventListener('input', function(e) {
                                let cursorPosition = this.selectionStart;
                                let originalLength = this.value.length;

                                // Hilangkan semua karakter non angka
                                let value = this.value.replace(/\D/g, '');

                                // Format ribuan
                                let formatted = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

                                this.value = formatted;

                                // Hitung selisih panjang string baru dan lama
                                let newLength = formatted.length;
                                cursorPosition = cursorPosition + (newLength - originalLength);

                                // Set posisi kursor lagi supaya gak lompat ke akhir
                                this.setSelectionRange(cursorPosition, cursorPosition);
                            });
                        </script>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="simpanLogRitasi">Simpan Log</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Ritasi Chart
        const ritasiCtx = document.getElementById('ritasiChart').getContext('2d');
        const ritasiChart = new Chart(ritasiCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Ritasi 2023',
                    data: [850, 920, 1020, 980, 1100, 1248, 0, 0, 0, 0, 0, 0],
                    backgroundColor: 'rgba(52, 152, 219, 0.7)',
                    borderColor: '#3498db',
                    borderWidth: 1
                }, {
                    label: 'Ritasi 2022',
                    data: [780, 810, 890, 950, 1000, 1100, 1150, 1200, 1050, 980, 900, 850],
                    backgroundColor: 'rgba(149, 165, 166, 0.5)',
                    borderColor: '#95a5a6',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Route Distribution Chart
        const routeDistCtx = document.getElementById('routeDistributionChart').getContext('2d');
        const routeDistChart = new Chart(routeDistCtx, {
            type: 'doughnut',
            data: {
                labels: ['Jakarta-Bandung', 'Bandung-Cirebon', 'Jakarta-Bogor', 'Semarang-Yogyakarta', 'Surabaya-Malang'],
                datasets: [{
                    data: [35, 25, 20, 15, 5],
                    backgroundColor: [
                        '#3498db',
                        '#2ecc71',
                        '#f39c12',
                        '#e74c3c',
                        '#9b59b6'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // Set min date ke tanggal hari ini (format YYYY-MM-DD)
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('log_ritasi_date').setAttribute('min', today);

        // Handle form submission for new ritasi (matches ritasi_logs table)
        document.querySelector('#tambahRitasiModal .btn-primary').addEventListener('click', function() {
            // Ambil data dari form
            const ritasi_date = document.getElementById('log_ritasi_date').value;
            const vehicle_id = document.getElementById('log_vehicle_id').value;
            const driver_id = document.getElementById('log_driver_id').value;
            const route_id = document.getElementById('log_route_id').value;
            const bak_number = document.getElementById('log_bak_number').value;
            const jam_angkut = document.getElementById('log_jam_angkut').value;
            const no_do = document.getElementById('log_no_do').value;
            const actual_distance = document.getElementById('log_actual_distance').value;
            const end_time = document.getElementById('log_end_time').value;
            const notes = document.getElementById('log_notes').value;

            const walletInput = document.getElementById('log_wallet_amount');
            const rawValue = walletInput.value.replace(/\./g, ''); // misal "1.000.000" -> "1000000"
            const wallet_amount = parseInt(rawValue, 10);

            // Validasi wajib
            if (!ritasi_date || !vehicle_id || !driver_id || !route_id || !bak_number || !jam_angkut || !no_do) {
                alert('Harap isi semua field yang wajib diisi!');
                return;
            }

            // Data untuk dikirim ke API / backend
            const ritasiData = {
                ritasi_date,
                vehicle_id: parseInt(vehicle_id),
                driver_id: parseInt(driver_id),
                route_id: parseInt(route_id),
                bak_number,
                jam_angkut,
                no_do,
                actual_distance: actual_distance ? parseFloat(actual_distance) : null,
                end_time: end_time || null,
                notes: notes || '',
                wallet_amount: wallet_amount ? parseFloat(wallet_amount) : 0
            };

            console.log('Data ritasi baru dengan wallet:', ritasiData);
            
            // Example API call (uncomment in production)
            /*
            fetch('/api/ritasi', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                body: JSON.stringify(ritasiData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('tambahRitasiModal'));
                    modal.hide();
                    
                    // Show success message
                    showToast('Ritasi baru berhasil ditambahkan!', 'success');
                    
                    // Refresh data table
                    refreshRitasiTable();
                } else {
                    throw new Error(data.message || 'Gagal menambahkan ritasi');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast(error.message, 'danger');
            });
            */
            
            // For demo purposes:
            const modal = bootstrap.Modal.getInstance(document.getElementById('tambahRitasiModal'));
            modal.hide();
            alert('Ritasi baru berhasil ditambahkan!');
        });

        async function loadRouteOptions() {
            try {
                const response = await fetch('/api/routes', {
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                    }
                });
                if (!response.ok) throw new Error('Gagal memuat data rute');

                const data = await response.json();
                if (!Array.isArray(data)) throw new Error('Format data rute tidak valid');

                const select = document.getElementById('route_id');
                select.innerHTML = ''; // Kosongkan dulu opsi lama

                data.forEach(route => {
                    const option = document.createElement('option');
                    option.value = route.id;
                    option.textContent = `${route.start_point} - ${route.end_point}`;
                    select.appendChild(option);
                });
            } catch (error) {
                console.error('Error loadRouteOptions:', error);
                showToast(error.message, 'danger');
            }
        }

        async function calculateRoute(start, end) {
            const apiKey = '5b3ce3597851110001cf624879cf649ca75f4d8eab517b60a2e66708';  // Ganti dengan API key ORS kamu
            // Untuk geocoding (dapatkan koordinat lat/lon dari alamat)
            const geocode = async (place) => {
                const res = await fetch(`https://api.openrouteservice.org/geocode/search?api_key=${apiKey}&text=${encodeURIComponent(place)}&size=1`);
                const data = await res.json();
                if (data.features && data.features.length) {
                    return data.features[0].geometry.coordinates; // [lon, lat]
                }
                throw new Error('Geocode gagal: ' + place);
            };

            // Dapatkan koordinat start dan end
            const startCoords = await geocode(start); // [lon, lat]
            const endCoords = await geocode(end);

            const profile = 'driving-hgv';  // bisa ganti ke 'foot-walking', 'cycling-regular', dll.

            // Panggil directions API ORS
            const directionsRes = await fetch(`https://api.openrouteservice.org/v2/directions/${profile}/geojson`, {
                method: 'POST',
                headers: {
                    'Authorization': apiKey,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    coordinates: [startCoords, endCoords]
                })
            });
            const directionsData = await directionsRes.json();

            // Ambil distance (m) dan duration (s)
            const summary = directionsData.features[0].properties.summary;
            const distanceKm = summary.distance / 1000;
            const durationMin = summary.duration / 60;

            return {
                distance: distanceKm.toFixed(2),
                duration: Math.round(durationMin),
                geojson: directionsData
            };
        }

        document.getElementById('start_point').addEventListener('change', triggerRouteUpdate);
        document.getElementById('end_point').addEventListener('change', triggerRouteUpdate);

        // let map, routeLayer;

        // // Inisialisasi Leaflet saat modal tampil (agar div map sudah visible)
        // const tambahRuteModalEl = document.getElementById('tambahRuteModal');
        // tambahRuteModalEl.addEventListener('shown.bs.modal', () => {
        //     if (!map) {
        //         map = L.map('map').setView([-6.200000, 106.816666], 10); // Default Jakarta
        //         L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //             attribution: '&copy; OpenStreetMap contributors'
        //         }).addTo(map);
        //     }
        //     map.invalidateSize(); // Refresh ukuran peta agar pas tampil
        // });

        // // Fungsi untuk gambar rute di peta dari GeoJSON ORS
        // function drawRouteOnMap(geojson) {
        //     if (routeLayer) {
        //         map.removeLayer(routeLayer);
        //     }
        //     routeLayer = L.geoJSON(geojson, {
        //         style: { color: 'blue', weight: 5 }
        //     }).addTo(map);

        //     // Zoom ke bounds rute
        //     map.fitBounds(routeLayer.getBounds());
        // }

        // Modifikasi fungsi triggerRouteUpdate untuk juga gambar rute
        async function triggerRouteUpdate() {
            const start_point = document.getElementById('start_point').value;
            const end_point = document.getElementById('end_point').value;

            if (start_point && end_point) {
                try {
                    // Fungsi calculateRoute sekarang mengembalikan {distance, duration, geojson}
                    const { distance, duration, geojson } = await calculateRoute(start_point, end_point);

                    const distanceNumber = parseFloat(distance);
                    const durationMinutes = Math.round(parseFloat(duration));

                    if (!isNaN(distanceNumber)) {
                        document.getElementById('planned_distance').value = distanceNumber.toFixed(2);
                        document.getElementById('estimated_time').value = durationMinutes + ' menit';
                        console.log(`Rute dihitung otomatis: ${distanceNumber.toFixed(2)} km`);
                    } else {
                        console.error('Gagal konversi jarak ke number:', distance);
                        document.getElementById('estimated_time').value = '';
                    }

                    // if (geojson) {
                    //     drawRouteOnMap(geojson);
                    // }
                } catch (error) {
                    console.error('Gagal menghitung rute:', error);
                    document.getElementById('estimated_time').value = '';
                }
            }
        }

        // Handle form submission for new route (matches routes table)
        document.getElementById('simpanRute').addEventListener('click', async function () {
            const start_point = document.getElementById('start_point').value;
            const end_point = document.getElementById('end_point').value;
            const notes = document.getElementById('notes').value;
            const planned_distance = document.getElementById('planned_distance').value;
            const estimated_time = document.getElementById('estimated_time').value;

            if (!start_point || !end_point || !planned_distance || !estimated_time) {
                alert('Harap lengkapi semua data rute!');
                return;
            }

            const routeData = {
                start_point,
                end_point,
                planned_distance: parseFloat(planned_distance),
                estimated_time: estimated_time + ' menit',
                notes,
                start_time: new Date().toISOString()
            };

            console.log('Data rute baru:', routeData);

            try {
                const response = await fetch('/api/routes', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                    },
                    body: JSON.stringify(routeData)
                });

                const data = await response.json();
                if (data.status === 'created') {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('tambahRuteModal'));
                    modal.hide();
                    showToast('Rute baru berhasil ditambahkan!', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500); // delay 1.5 detik supaya toast sempat tampil
                    // loadRouteOptions();
                } else {
                    throw new Error(data.message || 'Gagal menambahkan rute');
                }
            } catch (error) {
                console.error('Error:', error);
                showToast(error.message, 'danger');
            }
        });

        // Handle form submission for daily trip log (matches ritasi_logs table)
        document.getElementById('simpanLogRitasi').addEventListener('click', function() {
            // Get form values
            const ritasi_date = document.getElementById('log_ritasi_date').value;
            const vehicle_id = document.getElementById('log_vehicle_id').value;
            const driver_id = document.getElementById('log_driver_id').value;
            const route_id = document.getElementById('log_route_id').value;
            const bak_number = document.getElementById('log_bak_number').value;
            const jam_angkut = document.getElementById('log_jam_angkut').value;
            const no_do = document.getElementById('log_no_do').value;
            const actual_distance = document.getElementById('log_actual_distance').value;
            const end_time = document.getElementById('log_end_time').value;
            const notes = document.getElementById('log_notes').value;
            
            // Basic validation
            if (!ritasi_date || !vehicle_id || !driver_id || !route_id || !bak_number || !jam_angkut || !no_do) {
                alert('Harap isi semua field yang wajib diisi!');
                return;
            }
            
            // Prepare data object matching database structure
            const logData = {
                ritasi_date,
                vehicle_id: parseInt(vehicle_id),
                driver_id: parseInt(driver_id),
                route_id: parseInt(route_id),
                bak_number,
                jam_angkut,
                no_do,
                actual_distance: actual_distance ? parseFloat(actual_distance) : null,
                end_time: end_time || null,
                notes
            };
            
            console.log('Data log ritasi:', logData);
            
            // Example API call (uncomment in production)
            /*
            fetch('/api/ritasi-logs', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                body: JSON.stringify(logData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('inputLogRitasiModal'));
                    modal.hide();
                    
                    // Show success message
                    showToast('Log ritasi berhasil disimpan!', 'success');
                    
                    // Refresh data table
                    refreshRitasiLogsTable();
                } else {
                    throw new Error(data.message || 'Gagal menyimpan log ritasi');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast(error.message, 'danger');
            });
            */
            
            // For demo purposes:
            const modal = bootstrap.Modal.getInstance(document.getElementById('inputLogRitasiModal'));
            modal.hide();
            alert('Log ritasi berhasil disimpan!');
        });

        // Helper functions (would be used in production)

        
        // Function to load dropdown options from API
        async function loadDropdownOptions() {
            try {
                // Load vehicles
                const vehiclesRes = await fetch('/api/vehicles');
                const vehicles = await vehiclesRes.json();
                const vehicleSelects = document.querySelectorAll('select[id$="vehicle_id"]');
                
                vehicles.forEach(vehicle => {
                    vehicleSelects.forEach(select => {
                        const option = document.createElement('option');
                        option.value = vehicle.id;
                        option.textContent = `${vehicle.plate_number} - ${vehicle.brand} ${vehicle.model}`;
                        select.appendChild(option);
                    });
                });
                
                // Load drivers
                const driversRes = await fetch('/api/drivers');
                const drivers = await driversRes.json();
                const driverSelects = document.querySelectorAll('select[id$="driver_id"]');
                
                drivers.forEach(driver => {
                    driverSelects.forEach(select => {
                        const option = document.createElement('option');
                        option.value = driver.id;
                        option.textContent = `${driver.name} (${driver.license_number})`;
                        select.appendChild(option);
                    });
                });
                
                // Load routes
                const routesRes = await fetch('/api/routes');
                const routes = await routesRes.json();
                const routeSelects = document.querySelectorAll('select[id$="route_id"]');
                
                routes.forEach(route => {
                    routeSelects.forEach(select => {
                        const option = document.createElement('option');
                        option.value = route.id;
                        option.textContent = `${route.start_point} - ${route.end_point} (${route.planned_distance} km)`;
                        select.appendChild(option);
                    });
                });
            } catch (error) {
                console.error('Error loading options:', error);
            }
        }

        // Function to show toast notifications
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `toast align-items-center text-white bg-${type} border-0`;
            toast.setAttribute('role', 'alert');
            toast.setAttribute('aria-live', 'assertive');
            toast.setAttribute('aria-atomic', 'true');
            
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">${message}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            `;
            
            const toastContainer = document.getElementById('toastContainer');
            toastContainer.appendChild(toast);
            
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
            
            // Remove toast after it hides
            toast.addEventListener('hidden.bs.toast', () => {
                toast.remove();
            });
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadDropdownOptions();
        });       
    </script>    