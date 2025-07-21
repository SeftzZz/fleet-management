<!-- Main Content -->
<div class="col-md-10 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-truck me-2"></i> Manajemen Kendaraan</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVehicleModal">
            <i class="bi bi-plus-circle"></i> Tambah Kendaraan
        </button>
    </div>

    <!-- Tab Navigation -->
    <ul class="nav nav-tabs mb-4" id="vehicleTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="list-tab" data-bs-toggle="tab" data-bs-target="#list" type="button" role="tab">
                <i class="bi bi-list-ul"></i> Daftar Kendaraan
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="docs-tab" data-bs-toggle="tab" data-bs-target="#docs" type="button" role="tab">
                <i class="bi bi-file-earmark-text"></i> Dokumen Kendaraan
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tracking-tab" data-bs-toggle="tab" data-bs-target="#tracking" type="button" role="tab">
                <i class="bi bi-geo-alt"></i> Tracking Kendaraan
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="vehicleTabsContent">
        <!-- Daftar Kendaraan -->
        <div class="tab-pane fade show active" id="list" role="tabpanel">
            <div class="card mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Filter Kendaraan</h5>
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-download"></i> Export
                    </button>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option selected>Semua Status</option>
                                <option>Aktif</option>
                                <option>Non-Aktif</option>
                                <option>Maintenance</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tipe Kendaraan</label>
                            <select class="form-select">
                                <option selected>Semua Tipe</option>
                                <option>Dump Truck</option>
                                <option>Pickup</option>
                                <option>Truk Box</option>
                                <option>Truk Tangki</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Pencarian</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari plat/nama...">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button class="btn btn-primary w-100">
                                <i class="bi bi-funnel"></i> Terapkan Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Kendaraan</h5>
                    <div class="d-flex">
                        <div class="btn-group me-2">
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-printer"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-file-earmark-excel"></i>
                            </button>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-gear"></i> Kolom
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><h6 class="dropdown-header">Tampilkan Kolom</h6></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-check2"></i> No. Plat</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-check2"></i> Tipe</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-check2"></i> Tahun</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-check2"></i> Status</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-check2"></i> Supir</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-check2"></i> Terakhir Service</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>No. Plat</th>
                                    <th>Nama Kendaraan</th>
                                    <th>Tipe</th>
                                    <th>Tahun</th>
                                    <th>Status</th>
                                    <th>Supir</th>
                                    <th>Terakhir Service</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><strong>B 1234 XYZ</strong></td>
                                    <td>Dump Truck Hino 2020</td>
                                    <td>Dump Truck</td>
                                    <td>2020</td>
                                    <td><span class="badge badge-status badge-active">Aktif</span></td>
                                    <td>Ahmad Susanto</td>
                                    <td>15 Jun 2023</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><strong>B 5678 ABC</strong></td>
                                    <td>Pickup Toyota Hilux</td>
                                    <td>Pickup</td>
                                    <td>2021</td>
                                    <td><span class="badge badge-status badge-active">Aktif</span></td>
                                    <td>Budi Setiawan</td>
                                    <td>20 Mei 2023</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><strong>B 9012 DEF</strong></td>
                                    <td>Truk Box Mitsubishi</td>
                                    <td>Truk Box</td>
                                    <td>2019</td>
                                    <td><span class="badge badge-status badge-maintenance">Maintenance</span></td>
                                    <td>-</td>
                                    <td>10 Jun 2023</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><strong>B 3456 GHI</strong></td>
                                    <td>Dump Truck Nissan</td>
                                    <td>Dump Truck</td>
                                    <td>2018</td>
                                    <td><span class="badge badge-status badge-inactive">Non-Aktif</span></td>
                                    <td>-</td>
                                    <td>05 Jan 2023</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><strong>B 7890 JKL</strong></td>
                                    <td>Truk Tangki Pertamina</td>
                                    <td>Truk Tangki</td>
                                    <td>2022</td>
                                    <td><span class="badge badge-status badge-active">Aktif</span></td>
                                    <td>Cahyo Pratomo</td>
                                    <td>01 Jun 2023</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <nav>
                        <ul class="pagination justify-content-center mb-0">
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

        <!-- Dokumen Kendaraan -->
        <div class="tab-pane fade" id="docs" role="tabpanel">
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Upload Dokumen Kendaraan</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Pilih Kendaraan</label>
                                <select class="form-select">
                                    <option selected>Pilih kendaraan...</option>
                                    <option>B 1234 XYZ - Dump Truck Hino 2020</option>
                                    <option>B 5678 ABC - Pickup Toyota Hilux</option>
                                    <option>B 9012 DEF - Truk Box Mitsubishi</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Jenis Dokumen</label>
                                <select class="form-select">
                                    <option selected>Pilih jenis...</option>
                                    <option>STNK</option>
                                    <option>KIR</option>
                                    <option>Asuransi</option>
                                    <option>BPKB</option>
                                    <option>Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tanggal Expired</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label">Upload File</label>
                                <input class="form-control" type="file">
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-upload"></i> Upload Dokumen
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Dokumen</h5>
                    <div class="input-group" style="width: 300px;">
                        <input type="text" class="form-control" placeholder="Cari dokumen...">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Dokumen 1 -->
                        <div class="col-md-4 mb-4">
                            <div class="card document-card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-3">
                                        <span class="badge bg-success">STNK</span>
                                        <small class="text-muted">12 Jun 2023</small>
                                    </div>
                                    <h5 class="card-title">B 1234 XYZ</h5>
                                    <p class="card-text text-muted">STNK Dump Truck Hino 2020</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-danger">Expired: 12 Jun 2024</small>
                                        <div>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-download"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Dokumen 2 -->
                        <div class="col-md-4 mb-4">
                            <div class="card document-card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-3">
                                        <span class="badge bg-warning text-dark">KIR</span>
                                        <small class="text-muted">05 Mei 2023</small>
                                    </div>
                                    <h5 class="card-title">B 5678 ABC</h5>
                                    <p class="card-text text-muted">KIR Pickup Toyota Hilux</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-danger">Expired: 05 Nov 2023</small>
                                        <div>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-download"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Dokumen 3 -->
                        <div class="col-md-4 mb-4">
                            <div class="card document-card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-3">
                                        <span class="badge bg-info">Asuransi</span>
                                        <small class="text-muted">20 Apr 2023</small>
                                    </div>
                                    <h5 class="card-title">B 9012 DEF</h5>
                                    <p class="card-text text-muted">Asuransi Truk Box Mitsubishi</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-danger">Expired: 20 Apr 2024</small>
                                        <div>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-download"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Dokumen 4 -->
                        <div class="col-md-4 mb-4">
                            <div class="card document-card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-3">
                                        <span class="badge bg-secondary">BPKB</span>
                                        <small class="text-muted">15 Mar 2023</small>
                                    </div>
                                    <h5 class="card-title">B 3456 GHI</h5>
                                    <p class="card-text text-muted">BPKB Dump Truck Nissan</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-success">Permanen</small>
                                        <div>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-download"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <nav>
                        <ul class="pagination justify-content-center mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Tracking Kendaraan -->
        <div class="tab-pane fade" id="tracking" role="tabpanel">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Daftar Kendaraan</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <a href="#" class="list-group-item list-group-item-action active">
                                    <div class="d-flex justify-content-between">
                                        <strong>B 1234 XYZ</strong>
                                        <span class="badge bg-white text-primary">Online</span>
                                    </div>
                                    <small class="text-white-50">Dump Truck Hino - Ahmad Susanto</small>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between">
                                        <strong>B 5678 ABC</strong>
                                        <span class="badge bg-white text-primary">Online</span>
                                    </div>
                                    <small class="text-muted">Pickup Toyota - Budi Setiawan</small>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between">
                                        <strong>B 7890 JKL</strong>
                                        <span class="badge bg-light text-muted">Offline</span>
                                    </div>
                                    <small class="text-muted">Truk Tangki - Cahyo Pratomo</small>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between">
                                        <strong>B 9012 DEF</strong>
                                        <span class="badge bg-light text-muted">Maintenance</span>
                                    </div>
                                    <small class="text-muted">Truk Box Mitsubishi</small>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Riwayat Posisi</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <strong>B 1234 XYZ</strong>
                                        <small class="text-muted">10 menit lalu</small>
                                    </div>
                                    <small class="text-muted">Jl. Sudirman, Jakarta</small>
                                </div>
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <strong>B 5678 ABC</strong>
                                        <small class="text-muted">15 menit lalu</small>
                                    </div>
                                    <small class="text-muted">Tol Cipularang KM 45</small>
                                </div>
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <strong>B 7890 JKL</strong>
                                        <small class="text-muted">2 jam lalu</small>
                                    </div>
                                    <small class="text-muted">SPBU Pertamina Cikampek</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card h-100">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Peta Tracking</h5>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-arrow-clockwise"></i> Refresh
                                </button>
                                <button class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-fullscreen"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div id="trackingMap" style="height: 500px; background-color: #eee;">
                                <!-- Peta akan ditampilkan di sini -->
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <div class="text-center">
                                        <i class="bi bi-map" style="font-size: 3rem; color: #ccc;"></i>
                                        <p class="mt-2 text-muted">Peta tracking kendaraan</p>
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

<!-- Modal Tambah Kendaraan -->
<div class="modal fade" id="addVehicleModal" tabindex="-1" aria-labelledby="addVehicleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addVehicleModalLabel"><i class="bi bi-plus-circle me-2"></i>Tambah Kendaraan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formTambahKendaraan">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="noPlat" class="form-label">Nomor Plat</label>
                            <input type="text" class="form-control" id="noPlat" placeholder="Contoh: B 1234 XYZ" required>
                        </div>
                        <div class="col-md-6">
                            <label for="namaKendaraan" class="form-label">Nama Kendaraan</label>
                            <input type="text" class="form-control" id="namaKendaraan" placeholder="Contoh: Dump Truck Hino 2020" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="tipeKendaraan" class="form-label">Tipe Kendaraan</label>
                            <select class="form-select" id="tipeKendaraan" required>
                                <option value="" selected disabled>Pilih Tipe</option>
                                <option value="Dump Truck">Dump Truck</option>
                                <option value="Pickup">Pickup</option>
                                <option value="Truk Box">Truk Box</option>
                                <option value="Truk Tangki">Truk Tangki</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="tahunKendaraan" class="form-label">Tahun</label>
                            <input type="number" class="form-control" id="tahunKendaraan" min="2000" max="2023" required>
                        </div>
                        <div class="col-md-4">
                            <label for="statusKendaraan" class="form-label">Status</label>
                            <select class="form-select" id="statusKendaraan" required>
                                <option value="Aktif" selected>Aktif</option>
                                <option value="Non-Aktif">Non-Aktif</option>
                                <option value="Maintenance">Maintenance</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="supirKendaraan" class="form-label">Supir</label>
                            <select class="form-select" id="supirKendaraan">
                                <option value="" selected>Tidak Ada</option>
                                <option value="Ahmad Susanto">Ahmad Susanto</option>
                                <option value="Budi Setiawan">Budi Setiawan</option>
                                <option value="Cahyo Pratomo">Cahyo Pratomo</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="kapasitasKendaraan" class="form-label">Kapasitas Muatan (Ton)</label>
                            <input type="number" class="form-control" id="kapasitasKendaraan" step="0.1">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="catatanKendaraan" class="form-label">Catatan Tambahan</label>
                        <textarea class="form-control" id="catatanKendaraan" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanKendaraan">Simpan Kendaraan</button>
            </div>
        </div>
    </div>
</div>
<script>
    // Vehicle Type Chart
    const vehicleTypeCtx = document.getElementById('vehicleTypeChart').getContext('2d');
    const vehicleTypeChart = new Chart(vehicleTypeCtx, {
        type: 'doughnut',
        data: {
            labels: ['Dump Truck', 'Pickup', 'Box', 'Truk Besar', 'Lainnya'],
            datasets: [{
                data: [25, 8, 5, 3, 1],
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
</script>
<script>
    // Handle form submission for new vehicle
    document.getElementById('simpanKendaraan').addEventListener('click', function() {
        // Get form values
        const noPlat = document.getElementById('noPlat').value;
        const nama = document.getElementById('namaKendaraan').value;
        const tipe = document.getElementById('tipeKendaraan').value;
        const tahun = document.getElementById('tahunKendaraan').value;
        const status = document.getElementById('statusKendaraan').value;
        const supir = document.getElementById('supirKendaraan').value;
        const kapasitas = document.getElementById('kapasitasKendaraan').value;
        const catatan = document.getElementById('catatanKendaraan').value;
        
        // Basic validation
        if (!noPlat || !nama || !tipe || !tahun || !status) {
            alert('Harap isi semua field yang wajib diisi!');
            return;
        }
        
        // Prepare data object
        const vehicleData = {
            noPlat,
            nama,
            tipe,
            tahun,
            status,
            supir,
            kapasitas,
            catatan
        };
        
        console.log('Data kendaraan baru:', vehicleData);
        
        // Here you would typically send data to server via API
        // fetch('/api/kendaraan', {
        //     method: 'POST',
        //     headers: { 'Content-Type': 'application/json' },
        //     body: JSON.stringify(vehicleData)
        // })
        // .then(response => response.json())
        // .then(data => {
        //     // Handle success
        // });
        
        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('addVehicleModal'));
        modal.hide();
        
        // Show success message
        alert('Kendaraan baru berhasil ditambahkan!');
        
        // In real application, you would:
        // 1. Add the new vehicle to the table dynamically
        // 2. Or refresh the page: location.reload();
    });
</script>

<style>
    /* Additional styles for vehicle management */
    .badge-status {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    .badge-active {
        background-color: var(--success);
        color: white;
    }
    .badge-inactive {
        background-color: var(--danger);
        color: white;
    }
    .badge-maintenance {
        background-color: var(--warning);
        color: black;
    }
    .document-card {
        border-left: 4px solid var(--primary);
        transition: all 0.3s ease;
    }
    .document-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
</style>
    