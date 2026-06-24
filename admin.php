<?php
require 'config.php';

// Ambil semua data dari tabel
$stmt = $conn->query("SELECT * FROM dokumen_pelatihan ORDER BY tanggal_submit DESC");
$peserta = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Peserta Pelatihan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>" href="index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'berita.php' ? 'active' : '' ?>" href="berita.php">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'admin.php' ? 'active' : '' ?>" href="admin.php">Admin</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container my-5">
    <h2 class="mb-4 text-center">Data Peserta Pelatihan</h2>
    <h4 class="mb-4 text-center">Nantinya Akan Dihubungkan Dengan Admin Dashboard Pada lms saja</h4>

    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Peserta</th>
                <th>Email</th>
                <th>Nama Usaha</th>
                <th>Nama Pelatihan</th>
                <th>Omset (Rp)</th>
                <th>Asset (Rp)</th>
                <th>Tenaga Kerja</th>
                <th>Screenshot Pelatihan</th>
                <th>NIB Terbaru</th>
                <th>Foto Produk</th>
                <th>Foto Usaha</th>
                <th>Tanggal Submit</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($peserta) > 0): ?>
                <?php foreach ($peserta as $index => $row): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($row['nama_peserta']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['nama_usaha']) ?></td>
                        <td>
                            <?php
                            // Konversi course_id ke nama pelatihan
                            switch ($row['course_id']) {
                                case 1: echo 'Pelatihan Kewirausahaan Dasar'; break;
                                case 2: echo 'Pelatihan Pemasaran Digital'; break;
                                case 3: echo 'Pelatihan Manajemen Keuangan UMKM'; break;
                                default: echo 'Pelatihan Tidak Dikenal';
                            }
                            ?>
                        </td>
                        <td>Rp<?= number_format($row['omset'], 0, ',', '.') ?></td>
                        <td>Rp<?= number_format($row['asset'], 0, ',', '.') ?></td>
                        <td><?= $row['tenaga_kerja'] ?></td>
                        <td><a href="<?= $row['screenshot_pelatihan'] ?>" target="_blank">Lihat File</a></td>
                        <td><a href="<?= $row['nib_terbaru'] ?>" target="_blank">Lihat File</a></td>
                        <td><a href="<?= $row['foto_produk'] ?>" target="_blank">Lihat File</a></td>
                        <td><a href="<?= $row['foto_usaha'] ?>" target="_blank">Lihat File</a></td>
                        <td><?= date('d-m-Y H:i', strtotime($row['tanggal_submit'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="13" class="text-center">Belum ada data peserta.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
