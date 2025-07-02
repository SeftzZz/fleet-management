<!-- Main Content -->
<div class="col-md-10 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-speedometer2 me-2"></i> Dashboard Utama</h2>
        <div class="d-flex">
            <div class="input-group me-2" style="width: 250px;">
                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                <input type="date" class="form-control" value="2023-06-01">
            </div>
            <button class="btn btn-primary">
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
                            <h6 class="text-muted">Kendaraan Aktif</h6>
                            <h3 class="mb-0">42</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="bi bi-truck text-primary" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <p class="text-muted mt-2 mb-0">
                        <span class="text-success"><i class="bi bi-arrow-up"></i> 5.2%</span> dari bulan lalu
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card success h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted">Total Ritasi</h6>
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
                            <h6 class="text-muted">Saldo Wallet</h6>
                            <h3 class="mb-0">Rp 128,4jt</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded">
                            <i class="bi bi-wallet2 text-warning" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <p class="text-muted mt-2 mb-0">
                        <span class="text-danger"><i class="bi bi-arrow-down"></i> 3.1%</span> dari bulan lalu
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card danger h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted">Insiden Bulan Ini</h6>
                            <h3 class="mb-0">8</h3>
                        </div>
                        <div class="bg-danger bg-opacity-10 p-3 rounded">
                            <i class="bi bi-exclamation-triangle text-danger" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <p class="text-muted mt-2 mb-0">
                        <span class="text-success"><i class="bi bi-arrow-down"></i> 20%</span> dari bulan lalu
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Statistik Ritasi Bulanan</h5>
                </div>
                <div class="card-body">
                    <canvas id="ritasiChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Distribusi Kendaraan</h5>
                </div>
                <div class="card-body">
                    <canvas id="vehicleTypeChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Incidents and Activity -->
    <div class="row">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Insiden Terbaru</h5>
                    <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="mb-1">Kecelakaan Ringan</h6>
                                    <small class="text-muted">B 1234 XYZ - Supir Ahmad</small>
                                </div>
                                <span class="badge bg-danger incident-badge">Tinggi</span>
                            </div>
                            <small class="text-muted">2 jam lalu - Jl. Sudirman, Jakarta</small>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="mb-1">Ban Pecah</h6>
                                    <small class="text-muted">B 5678 ABC - Supir Budi</small>
                                </div>
                                <span class="badge bg-warning text-dark incident-badge">Sedang</span>
                            </div>
                            <small class="text-muted">5 jam lalu - Tol Cipularang</small>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="mb-1">Mesin Overheat</h6>
                                    <small class="text-muted">B 9012 DEF - Supir Candra</small>
                                </div>
                                <span class="badge bg-warning text-dark incident-badge">Sedang</span>
                            </div>
                            <small class="text-muted">Kemarin - Cikampek</small>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="mb-1">Lampu Mati</h6>
                                    <small class="text-muted">B 3456 GHI - Supir Dedi</small>
                                </div>
                                <span class="badge bg-success incident-badge">Rendah</span>
                            </div>
                            <small class="text-muted">2 hari lalu - Bandung</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Aktivitas Terkini</h5>
                    <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex">
                                <div class="me-3 text-primary">
                                    <i class="bi bi-fuel-pump" style="font-size: 1.2rem;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Pengisian BBM</h6>
                                    <p class="mb-1 small">B 1234 XYZ mengisi 50 liter Solar di SPBU 44-12345</p>
                                    <small class="text-muted">30 menit lalu - Rp 650.000</small>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex">
                                <div class="me-3 text-success">
                                    <i class="bi bi-check-circle" style="font-size: 1.2rem;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Ritasi Selesai</h6>
                                    <p class="mb-1 small">B 5678 ABC menyelesaikan ritasi Jakarta-Bandung</p>
                                    <small class="text-muted">2 jam lalu - 150 km</small>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex">
                                <div class="me-3 text-warning">
                                    <i class="bi bi-tools" style="font-size: 1.2rem;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Maintenance</h6>
                                    <p class="mb-1 small">B 9012 DEF melakukan ganti oli rutin di bengkel</p>
                                    <small class="text-muted">Kemarin - Rp 1.200.000</small>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex">
                                <div class="me-3 text-info">
                                    <i class="bi bi-cash-stack" style="font-size: 1.2rem;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Klaim Tabungan</h6>
                                    <p class="mb-1 small">Supir Ahmad mengklaim tabungan Rp 2.500.000</p>
                                    <small class="text-muted">2 hari lalu</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>