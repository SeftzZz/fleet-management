<!-- Main Content -->
<div class="col-md-10 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-people-fill me-2"></i> Manajemen Supir</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDriverModal">
            <i class="bi bi-person-plus"></i> Tambah Supir
        </button>
    </div>

    <!-- Tab Navigation -->
    <ul class="nav nav-tabs mb-4" id="driverTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="list-tab" data-bs-toggle="tab" data-bs-target="#list" type="button" role="tab">
                <i class="bi bi-list-ul"></i> Daftar Supir
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="wallet-tab" data-bs-toggle="tab" data-bs-target="#wallet" type="button" role="tab">
                <i class="bi bi-wallet2"></i> Wallet Supir
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="license-tab" data-bs-toggle="tab" data-bs-target="#license" type="button" role="tab">
                <i class="bi bi-card-checklist"></i> Manajemen SIM
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="driverTabsContent">
        <!-- Daftar Supir -->
        <div class="tab-pane fade show active" id="list" role="tabpanel">
            <div class="card mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Filter Supir</h5>
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
                                <option>Cuti</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Jenis SIM</label>
                            <select class="form-select">
                                <option selected>Semua SIM</option>
                                <option>SIM A</option>
                                <option>SIM B1</option>
                                <option>SIM B2</option>
                                <option>SIM C</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Pencarian</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari nama/ID...">
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
                    <h5 class="mb-0">Daftar Supir</h5>
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
                                <li><a class="dropdown-item" href="#"><i class="bi bi-check2"></i> Foto</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-check2"></i> ID</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-check2"></i> Nama</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-check2"></i> No. HP</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-check2"></i> SIM</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-check2"></i> Status</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-check2"></i> Kendaraan</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="driversTable">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th width="80">Foto</th>
                                    <th>Nama</th>
                                    <th>No. HP</th>
                                    <th>Jenis SIM</th>
                                    <th>Status</th>
                                    <th>Kendaraan</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <img src="https://randomuser.me/api/portraits/men/1.jpg" class="driver-photo" alt="Driver">
                                    </td>
                                    <td>
                                        <strong>Ahmad Susanto</strong>
                                        <small class="d-block text-muted">ID: DRV-001</small>
                                    </td>
                                    <td>081234567890</td>
                                    <td>SIM B2</td>
                                    <td><span class="badge badge-status badge-active">Aktif</span></td>
                                    <td>B 1234 XYZ</td>
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
                                    <td>
                                        <img src="https://randomuser.me/api/portraits/men/2.jpg" class="driver-photo" alt="Driver">
                                    </td>
                                    <td>
                                        <strong>Budi Setiawan</strong>
                                        <small class="d-block text-muted">ID: DRV-002</small>
                                    </td>
                                    <td>081298765432</td>
                                    <td>SIM B1</td>
                                    <td><span class="badge badge-status badge-active">Aktif</span></td>
                                    <td>B 5678 ABC</td>
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
                                    <td>
                                        <img src="https://randomuser.me/api/portraits/men/3.jpg" class="driver-photo" alt="Driver">
                                    </td>
                                    <td>
                                        <strong>Cahyo Pratomo</strong>
                                        <small class="d-block text-muted">ID: DRV-003</small>
                                    </td>
                                    <td>081223344556</td>
                                    <td>SIM B2</td>
                                    <td><span class="badge badge-status badge-inactive">Cuti</span></td>
                                    <td>-</td>
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
                                    <td>
                                        <img src="https://randomuser.me/api/portraits/men/4.jpg" class="driver-photo" alt="Driver">
                                    </td>
                                    <td>
                                        <strong>Dedi Kusuma</strong>
                                        <small class="d-block text-muted">ID: DRV-004</small>
                                    </td>
                                    <td>081334455667</td>
                                    <td>SIM B2</td>
                                    <td><span class="badge badge-status badge-active">Aktif</span></td>
                                    <td>B 7890 JKL</td>
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
                                    <td>
                                        <img src="https://randomuser.me/api/portraits/men/5.jpg" class="driver-photo" alt="Driver">
                                    </td>
                                    <td>
                                        <strong>Eko Prasetyo</strong>
                                        <small class="d-block text-muted">ID: DRV-005</small>
                                    </td>
                                    <td>081556677889</td>
                                    <td>SIM B1</td>
                                    <td><span class="badge badge-status badge-inactive">Non-Aktif</span></td>
                                    <td>-</td>
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
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            Menampilkan 1 sampai 5 dari 15 entri
                        </div>
                        <nav>
                            <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Sebelumnya</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Selanjutnya</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wallet Supir -->
        <div class="tab-pane fade" id="wallet" role="tabpanel">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card wallet-card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="text-muted">Total Saldo Wallet</h6>
                                    <h3 class="mb-0">Rp 42.750.000</h3>
                                </div>
                                <div class="bg-success bg-opacity-10 p-3 rounded">
                                    <i class="bi bi-wallet2 text-success" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                            <p class="text-muted mt-2 mb-0">
                                <span class="text-success"><i class="bi bi-arrow-up"></i> 8.5%</span> dari bulan lalu
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="text-muted">Top 5 Saldo Tertinggi</h6>
                                    <ol class="mt-2 mb-0 ps-3">
                                        <li>Ahmad Susanto - Rp 12.500.000</li>
                                        <li>Budi Setiawan - Rp 9.750.000</li>
                                        <li>Dedi Kusuma - Rp 7.300.000</li>
                                    </ol>
                                </div>
                                <div class="bg-primary bg-opacity-10 p-3 rounded">
                                    <i class="bi bi-trophy text-primary" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Pencairan Saldo</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Pilih Supir</label>
                                <select class="form-select">
                                    <option selected>Pilih supir...</option>
                                    <option>Ahmad Susanto (DRV-001)</option>
                                    <option>Budi Setiawan (DRV-002)</option>
                                    <option>Dedi Kusuma (DRV-004)</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Jumlah Pencairan</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" class="form-control" placeholder="Jumlah">
                                </div>
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-cash-stack"></i> Proses Pencairan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Riwayat Transaksi</h5>
                    <div class="input-group" style="width: 300px;">
                        <input type="text" class="form-control" placeholder="Cari transaksi...">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>Tanggal</th>
                                    <th>Supir</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                    <th width="100">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>15 Jun 2023</td>
                                    <td>Ahmad Susanto</td>
                                    <td><span class="badge bg-success">Setoran</span></td>
                                    <td>Rp 1.250.000</td>
                                    <td>Setoran ritasi mingguan</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-receipt"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>12 Jun 2023</td>
                                    <td>Budi Setiawan</td>
                                    <td><span class="badge bg-danger">Pencairan</span></td>
                                    <td>Rp 2.000.000</td>
                                    <td>Pencairan tabungan</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-receipt"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>10 Jun 2023</td>
                                    <td>Dedi Kusuma</td>
                                    <td><span class="badge bg-success">Setoran</span></td>
                                    <td>Rp 850.000</td>
                                    <td>Setoran ritasi</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-receipt"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>05 Jun 2023</td>
                                    <td>Ahmad Susanto</td>
                                    <td><span class="badge bg-success">Setoran</span></td>
                                    <td>Rp 1.500.000</td>
                                    <td>Setoran ritasi</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-receipt"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>01 Jun 2023</td>
                                    <td>Budi Setiawan</td>
                                    <td><span class="badge bg-success">Setoran</span></td>
                                    <td>Rp 1.100.000</td>
                                    <td>Setoran ritasi</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-receipt"></i>
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
                                <a class="page-link" href="#" tabindex="-1">Sebelumnya</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Selanjutnya</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Manajemen SIM -->
        <div class="tab-pane fade" id="license" role="tabpanel">
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Upload Data SIM</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Pilih Supir</label>
                                <select class="form-select">
                                    <option selected>Pilih supir...</option>
                                    <option>Ahmad Susanto (DRV-001)</option>
                                    <option>Budi Setiawan (DRV-002)</option>
                                    <option>Cahyo Pratomo (DRV-003)</option>
                                    <option>Dedi Kusuma (DRV-004)</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Jenis SIM</label>
                                <select class="form-select">
                                    <option selected>Pilih jenis...</option>
                                    <option>SIM A</option>
                                    <option>SIM B1</option>
                                    <option>SIM B2</option>
                                    <option>SIM C</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Tanggal Expired</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-upload"></i> Upload
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar SIM Supir</h5>
                    <div class="input-group" style="width: 300px;">
                        <input type="text" class="form-control" placeholder="Cari SIM...">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>Supir</th>
                                    <th>Jenis SIM</th>
                                    <th>No. SIM</th>
                                    <th>Tanggal Expired</th>
                                    <th>Status</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Ahmad Susanto</td>
                                    <td>SIM B2</td>
                                    <td>1234567890123456</td>
                                    <td>15 Mei 2025</td>
                                    <td><span class="badge bg-success">Aktif</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Budi Setiawan</td>
                                    <td>SIM B1</td>
                                    <td>6543210987654321</td>
                                    <td>30 November 2024</td>
                                    <td><span class="badge bg-success">Aktif</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Dedi Kusuma</td>
                                    <td>SIM B2</td>
                                    <td>9876543210123456</td>
                                    <td>31 Desember 2023</td>
                                    <td><span class="badge bg-warning text-dark">Akan Expired</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Cahyo Pratomo</td>
                                    <td>SIM B2</td>
                                    <td>5678901234567890</td>
                                    <td>15 Agustus 2023</td>
                                    <td><span class="badge bg-danger">Expired</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            Menampilkan 1 sampai 4 dari 4 entri
                        </div>
                        <div class="alert alert-warning mb-0 py-2">
                            <i class="bi bi-exclamation-triangle"></i> Terdapat 1 SIM yang akan expired dalam 3 bulan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Supir -->
<div class="modal fade" id="addDriverModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Supir Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" placeholder="Contoh: Ahmad Susanto">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. HP</label>
                            <input type="tel" class="form-control" placeholder="Contoh: 081234567890">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Jenis SIM</label>
                            <select class="form-select">
                                <option selected>Pilih jenis...</option>
                                <option>SIM A</option>
                                <option>SIM B1</option>
                                <option>SIM B2</option>
                                <option>SIM C</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">No. SIM</label>
                            <input type="text" class="form-control" placeholder="Nomor SIM">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" rows="2"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option selected>Aktif</option>
                                <option>Non-Aktif</option>
                                <option>Cuti</option>
                            </select>
                            <div class="mt-2">
                                <label class="form-label">Tanggal Bergabung</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="email@contoh.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Password Awal</label>
                            <input type="password" class="form-control" value="supir123">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Upload Foto</label>
                            <input class="form-control" type="file">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Upload SIM</label>
                            <input class="form-control" type="file">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan Data</button>
            </div>
        </div>
    </div>
</div>