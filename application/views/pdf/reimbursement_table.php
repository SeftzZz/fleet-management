<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Reimbursement <?= $tanggal ?> - <?= $proyek_nama ?? $proyek ?> - <?= $lokasi ?? $galian ?> - <?= $tim_nama ?? $tim ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            margin-bottom: 5px;
        }
        h3 {
            margin-bottom: 5px;
        }
        .subtitle {
            font-size: 14px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h2>PT. KARYA MAJUJAYA PERKASA</h2>
    <h3>Laporan Reimbursement</h3>
    <div class="subtitle">
        Tanggal: <?= $tanggal ?><br>
        Proyek: <?= $proyek_nama ?? $proyek ?><br>
        Lokasi Galian: <?= $lokasi ?? $galian ?><br>
        Tim: <?= $tim_nama ?? $tim ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>No. Unit</th>
                <th>No. Polisi</th>
                <th>Uang Jalan</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($ritasi_list)): ?>
                <?php foreach ($ritasi_list as $row): ?>
                    <tr>
                        <td><?= $row->no_pintu ?></td>
                        <td><?= $row->no_pol ?></td>
                        <td>Rp <?= number_format($row->uang_jalan, 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="text-align: center;">Tidak ada data ritasi</td>
                </tr>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">Total Reimburse</th>
                <th>Rp <?= number_format($total, 0, ',', '.') ?></th>
            </tr>
        </tfoot>
    </table>

</body>
</html>
