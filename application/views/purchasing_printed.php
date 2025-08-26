<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Fleet Management System">
    <meta name="keywords" content="Fleet Management System, KMP, Karya Majujaya Perkasa">
    <title>Print Purchasing</title>
    <link rel="icon" href="<?php echo base_url(); ?>assets/newstyle/dist/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url(); ?>assets/newstyle/dist/img/icons-192.png" sizes="192x192"/> 
    <link rel="icon" href="<?php echo base_url(); ?>assets/newstyle/dist/img/icons-512.png" sizes="512x512"/> 
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>assets/newstyle/dist/img/apple-touch-icon.png">
    <link rel="manifest" href="<?php echo base_url(); ?>assets/newstyle/dist/img/manifest.webmanifest">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/select2/css/select2.min.css">
    
    <!-- DateRange Picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/dist/css/newtheme.css?v=3.2.0">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/style.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <style>
      @media print {
        .page-break { page-break-after: always; }
      }

      body {
        font-family: Arial, sans-serif;
        font-size: 14px;
      }

      .card {
        border: 1px solid #ccc;
        padding: 20px;
        margin: 20px auto;
        width: 95%;
      }

      table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
      }

      table th, table td {
        border: 1px solid #ccc;
        padding: 6px;
      }

      .no-border td {
        border: none;
        padding: 4px 8px;
      }

      .form-control {
        border: 1px solid #ccc;
        background-color: #f2f2f2;
        padding: 6px;
        width: 100%;
      }

      .text-right {
        text-align: right;
        margin-top: 10px;
      }

      h4 {
        margin-bottom: 10px;
      }
    </style>
</head>
<body onload="window.print()">

<?php foreach ($vendors as $vendor): ?>
  <?php
    $vendor_id = $vendor->id;
    $items = $vendor_items_grouped[$vendor_id] ?? [];
    $total = 0;
  ?>

  <div class="card">
    <h4>Formulir Pengajuan Pembelian Barang</h4>
    <table class="no-border">
      <tr>
        <td style="width: 15%;">Nama</td>
        <td><input type="text" class="form-control" value="<?= $pengajuan->nama ?>" readonly></td>
        <td>Nama Vendor</td>
        <td>
          <input type="text" class="form-control" value="<?= $vendor->name ?>" readonly>
        </td>
      </tr>
      <tr>
        <td>Jabatan</td>
        <td><input type="text" class="form-control" value="<?= $pengajuan->jabatan ?>" readonly></td>
        <td>Nomor PO</td>
        <td><input type="text" class="form-control" value="<?= $vendor->no_po ?? '-' ?>" readonly></td>
      </tr>
      <tr>
        <td>Divisi</td>
        <td><input type="text" class="form-control" value="<?= $pengajuan->divisi ?>" readonly></td>
        <td>PIC</td>
        <td><input type="text" class="form-control" value="<?= $vendor->pic ?? '-' ?>" readonly></td>
      </tr>
      <tr>
        <td>Tanggal</td>
        <td><input type="text" class="form-control" value="<?= date('d-m-Y', strtotime($pengajuan->tanggal)) ?>" readonly></td>
        <td>Phone</td>
        <td><input type="text" class="form-control" value="<?= $vendor->phone ?? '-' ?>" readonly></td>
      </tr>
    </table>

    <br>

    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Qty</th>
          <th>Vendor</th>
          <th>Harga</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; foreach ($items as $item): 
          $subtotal = $item->qty * $item->harga;
          $total += $subtotal;
        ?>
        <tr>
          <td><?= $i++ ?></td>
          <td><input type="text" class="form-control" value="<?= $item->sparepart ?>" readonly></td>
          <td><input type="text" class="form-control" value="<?= $item->qty ?>" readonly></td>
          <td><input type="text" class="form-control" value="<?= $vendor->name ?>" readonly></td>
          <td><input type="text" class="form-control" value="Rp <?= number_format($item->harga, 0, ',', '.') ?>" readonly></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="text-right">
      <strong>Grand Total: Rp <?= number_format($total, 0, ',', '.') ?></strong>
    </div>
  </div>

  <div class="page-break"></div>
<?php endforeach; ?>
<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/newstyle/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>assets/newstyle/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 (berdasarkan asumsi jQuery sudah dimuat) -->
<script src="<?php echo base_url(); ?>assets/newstyle/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Moment.js (digunakan untuk tanggal/waktu) -->
<script src="<?php echo base_url(); ?>assets/newstyle/plugins/moment/moment.min.js"></script>

<!-- Tempusdominus Bootstrap 4 (depend on moment and bootstrap) -->
<script src="<?php echo base_url(); ?>assets/newstyle/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Date Range Picker (depend on moment.js & Bootstrap) -->
<script src="<?php echo base_url(); ?>assets/newstyle/plugins/daterangepicker/daterangepicker.js"></script>

<!-- Select2 (plugin untuk select dropdown) -->
<script src="<?php echo base_url(); ?>assets/newstyle/plugins/select2/js/select2.full.min.js"></script>

<!-- SweetAlert2 -->
<script src="<?php echo base_url(); ?>assets/newstyle/plugins/sweetalert2/sweetalert2.all.min.js"></script>

<!-- overlayScrollbars -->
<script src="<?php echo base_url(); ?>assets/newstyle/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- DataTables core -->
<script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- DataTables Responsive -->
<script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- DataTables Buttons -->
<script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/newstyle/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/newstyle/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/newstyle/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Script utama (pastikan ini paling akhir agar semua dependensi sudah ter-load) -->
<script src="<?php echo base_url(); ?>assets/newstyle/dist/js/newtheme.js?v=3.2.0"></script>
</body>
</html>
