<?php
require 'config.php';
session_start();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create/Update berita
    if (isset($_POST['save'])) {
        $judul = $_POST['judul'];
        $subjudul = $_POST['subjudul'] ?? '';
        $isi_berita = $_POST['isi_berita'];
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        
        // Handle file upload
        $nama_file = '';
        if (isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] == 0) {
            $target_dir = "uploads/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $file_name = basename($_FILES["file_upload"]["name"]);
            $target_file = $target_dir . uniqid() . '_' . $file_name;
            
            if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file)) {
                $nama_file = $target_file;
                
                // Delete old file if updating
                if ($id > 0) {
                    $stmt = $conn->prepare("SELECT nama_file FROM berita WHERE id = ?");
                    $stmt->execute([$id]);
                    $old_file = $stmt->fetchColumn();
                    if ($old_file && file_exists($old_file)) {
                        unlink($old_file);
                    }
                }
            }
        }
        
        try {
            if ($id > 0) {
                // Update existing record
                if ($nama_file) {
                    $sql = "UPDATE berita SET judul=?, subjudul=?, isi_berita=?, nama_file=? WHERE id=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$judul, $subjudul, $isi_berita, $nama_file, $id]);
                } else {
                    $sql = "UPDATE berita SET judul=?, subjudul=?, isi_berita=? WHERE id=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$judul, $subjudul, $isi_berita, $id]);
                }
            } else {
                // Insert new record
                $sql = "INSERT INTO berita (judul, subjudul, isi_berita, nama_file) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$judul, $subjudul, $isi_berita, $nama_file]);
            }
            
            $_SESSION['message'] = "Berita " . ($id > 0 ? "updated" : "created") . " successfully!";
        } catch(PDOException $e) {
            $_SESSION['error'] = "Error: " . $e->getMessage();
        }
    }
    
    // Delete berita
    if (isset($_POST['delete'])) {
        $id = intval($_POST['id']);
        
        try {
            // Delete file if exists
            $stmt = $conn->prepare("SELECT nama_file FROM berita WHERE id = ?");
            $stmt->execute([$id]);
            $file = $stmt->fetchColumn();
            
            if ($file && file_exists($file)) {
                unlink($file);
            }
            
            $stmt = $conn->prepare("DELETE FROM berita WHERE id=?");
            $stmt->execute([$id]);
            
            $_SESSION['message'] = "Berita deleted successfully!";
        } catch(PDOException $e) {
            $_SESSION['error'] = "Error deleting record: " . $e->getMessage();
        }
    }
    
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Get all berita for listing
$berita_list = $conn->query("SELECT id, judul, tanggal_upload FROM berita ORDER BY tanggal_upload DESC")->fetchAll(PDO::FETCH_ASSOC);

// Get berita details for edit/view
$berita = null;
if (isset($_GET['action']) && in_array($_GET['action'], ['edit', 'view']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM berita WHERE id = ?");
    $stmt->execute([$id]);
    $berita = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .form-container {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .news-item:hover {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">LandingPageAdmin-Panel</a>
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
    <div class="container py-5">
        <h1 class="text-center mb-5">Berita Management</h1>
        
        <!-- Message Display -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_SESSION['error'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        
        <!-- Berita Form -->
        <div class="form-container">
            <h2><?= isset($_GET['action']) && $_GET['action'] == 'edit' ? 'Edit' : 'Tambah' ?> Berita</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $berita['id'] ?? '' ?>">
                
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" required 
                           value="<?= htmlspecialchars($berita['judul'] ?? '') ?>">
                </div>
                
                <div class="mb-3">
                    <label for="subjudul" class="form-label">Subjudul</label>
                    <input type="text" class="form-control" id="subjudul" name="subjudul" 
                           value="<?= htmlspecialchars($berita['subjudul'] ?? '') ?>">
                </div>
                
                <div class="mb-3">
                    <label for="isi_berita" class="form-label">Isi Berita</label>
                    <textarea class="form-control" id="isi_berita" name="isi_berita" rows="5" required><?= htmlspecialchars($berita['isi_berita'] ?? '') ?></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="file_upload" class="form-label">File Lampiran</label>
                    <input class="form-control" type="file" id="file_upload" name="file_upload">
                    <?php if (isset($berita['nama_file']) && $berita['nama_file']): ?>
                        <small class="text-muted">Current file: <?= basename($berita['nama_file']) ?></small>
                    <?php endif; ?>
                </div>
                
                <button type="submit" name="save" class="btn btn-primary">
                    <?= isset($_GET['action']) && $_GET['action'] == 'edit' ? 'Update' : 'Simpan' ?>
                </button>
                
                <?php if (isset($_GET['action']) && $_GET['action'] == 'edit'): ?>
                    <a href="?" class="btn btn-secondary">Batal</a>
                <?php endif; ?>
            </form>
        </div>
        
        <!-- Berita List -->
        <h2 class="mb-3">Daftar Berita</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Tanggal Upload</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($berita_list as $row): ?>
                    <tr class="news-item">
                        <td><?= htmlspecialchars($row['judul']) ?></td>
                        <td><?= date('d M Y H:i', strtotime($row['tanggal_upload'])) ?></td>
                        <td>
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewModal" 
                                    onclick="viewBerita(<?= $row['id'] ?>)">
                                <i class="bi bi-eye"></i> Lihat
                            </button>
                            <a href="?action=edit&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <button type="submit" name="delete" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- View Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Detail Berita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyContent">
                    <!-- Content will be loaded via AJAX -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function viewBerita(id) {
            fetch('?action=view&id=' + id)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('modalBodyContent').innerHTML = data;
                });
        }
    </script>
</body>
</html>

<?php
// View content for modal
if (isset($_GET['action']) && $_GET['action'] == 'view' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM berita WHERE id = ?");
    $stmt->execute([$id]);
    $berita = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($berita) {
        ?>
        <h3><?= htmlspecialchars($berita['judul']) ?></h3>
        <?php if ($berita['subjudul']): ?>
            <h5 class="text-muted"><?= htmlspecialchars($berita['subjudul']) ?></h5>
        <?php endif; ?>
        <p class="text-muted mb-3">
            <small>Diposting pada: <?= date('d M Y H:i', strtotime($berita['tanggal_upload'])) ?></small>
        </p>
        <div class="mb-4">
            <?= nl2br(htmlspecialchars($berita['isi_berita'])) ?>
        </div>
        <?php if ($berita['nama_file']): ?>
            <div class="mt-4">
                <h5>Lampiran:</h5>
                <a href="<?= $berita['nama_file'] ?>" target="_blank" class="btn btn-outline-primary">
                    <i class="bi bi-download"></i> Download File
                </a>
            </div>
        <?php endif; ?>
        <?php
    }
    exit();
}
?>