<?php
require 'config.php';

// Proses form jika disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_peserta = $_POST['nama_peserta'];
    $email = $_POST['email'];
    $nama_usaha = $_POST['nama_usaha'];
    $course_id = $_POST['course_id'];
    $omset = $_POST['omset'];
    $asset = $_POST['asset'];
    $tenaga_kerja = $_POST['tenaga_kerja'];
    
    // Direktori untuk menyimpan file
    $upload_dir = 'uploads/';
    
    // Fungsi untuk upload file
    function uploadFile($file, $upload_dir, $prefix) {
        $target_file = $upload_dir . $prefix . '_' . basename($file["name"]);
        move_uploaded_file($file["tmp_name"], $target_file);
        return $target_file;
    }
    
    // Upload semua file
    $screenshot_pelatihan = uploadFile($_FILES['screenshot_pelatihan'], $upload_dir, 'pelatihan');
    $nib_terbaru = uploadFile($_FILES['nib_terbaru'], $upload_dir, 'nib');
    $foto_produk = uploadFile($_FILES['foto_produk'], $upload_dir, 'produk');
    $foto_usaha = uploadFile($_FILES['foto_usaha'], $upload_dir, 'usaha');
    
    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO dokumen_pelatihan 
        (nama_peserta, email, nama_usaha, course_id, screenshot_pelatihan, nib_terbaru, foto_produk, foto_usaha, omset, asset, tenaga_kerja, tanggal_submit) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    
    $stmt->execute([
        $nama_peserta, $email, $nama_usaha, $course_id, 
        $screenshot_pelatihan, $nib_terbaru, $foto_produk, $foto_usaha,
        $omset, $asset, $tenaga_kerja
    ]);
    
    $success = "Data berhasil disubmit!";
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/disdag-berwarna-kepanjangan-1.png" type="image/x-icon">
  <title>Form Upload Dokumen Pelatihan</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <style>
    .form-container {
      background-color: #f8f9fa;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .form-header {
      text-align: center;
      margin-bottom: 30px;
    }
    .form-group label {
      font-weight: 600;
    }
    .file-upload-info {
      font-size: 0.9rem;
      color: #6c757d;
      margin-top: 5px;
    }
  </style>
</head>
<body>
  
  <section data-bs-version="5.1" class="menu menu2 cid-sFCw1qGFAI" once="menu" id="menu2-23">
    <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
      <div class="container">
        <div class="navbar-brand">
          <span class="navbar-logo">
            <a href="index.php">
              <img src="assets/images/disdag-berwarna-kepanjangan-1.png" alt="WUB IMAGES" style="height: 3.1rem;">
            </a>
          </span>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse" data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
          </div>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
            <li class="nav-item"><a class="nav-link link text-white display-7" href="index.html#top" aria-expanded="false">Home</a></li>
            <li class="nav-item"><a class="nav-link link text-white display-7" href="infomation.html">Information</a></li>
            <li class="nav-item"><a class="nav-link link text-white display-7" href="Seritf.php">Form Claim Sertifikasi</a></li>
          </ul>
          <div class="navbar-buttons mbr-section-btn"><a class="btn btn-warning display-4" href="https://siwub.web.id/Kursus">Ikuti Pelatihan</a></div>
        </div>
      </div>
    </nav>
  </section>

  <section class="py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="form-container">
            <?php if(isset($success)): ?>
              <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <div class="form-header">
              <h2>Form Upload Dokumen Pelatihan</h2>
              <p class="text-muted">Silakan lengkapi form berikut untuk menyelesaikan pelatihan</p>
            </div>
            
            <form method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="course_id" class="form-label">Nama Pelatihan</label>
                <select class="form-select" id="course_id" name="course_id" required>
                  <option value="">Pilih Pelatihan</option>
                  <option value="1">Pelatihan Kewirausahaan Dasar</option>
                  <option value="2">Pelatihan Pemasaran Digital</option>
                  <option value="3">Pelatihan Manajemen Keuangan UMKM</option>
                </select>
              </div>
              
              <div class="mb-3">
                <label for="nama_peserta" class="form-label">Nama Peserta</label>
                <input type="text" class="form-control" id="nama_peserta" name="nama_peserta" required>
              </div>
              
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="file-upload-info">Nantinya Sertifikat Akan Dikirimkan Ke Email ini</div>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              
              <div class="mb-3">
                <label for="nama_usaha" class="form-label">Nama Usaha</label>
                <input type="text" class="form-control" id="nama_usaha" name="nama_usaha" required>
              </div>
              
              <hr class="my-4">
              
              <h5 class="mb-3">Upload Dokumen</h5>
              
              <div class="mb-3">
                <label for="screenshot_pelatihan" class="form-label">Screenshot Penyelasaian Pelatihan</label>
                <input type="file" class="form-control" id="screenshot_pelatihan" name="screenshot_pelatihan" accept="image/*" required>
                <div class="file-upload-info">Format: JPG/PNG, maksimal 2MB</div>
              </div>
              
              <div class="mb-3">
                <label for="nib_terbaru" class="form-label">NIB Terbaru</label>
                <input type="file" class="form-control" id="nib_terbaru" name="nib_terbaru" accept=".pdf,.jpg,.png" required>
                <div class="file-upload-info">Format: PDF/JPG/PNG, maksimal 5MB</div>
              </div>
              
              <div class="mb-3">
                <label for="foto_produk" class="form-label">Foto Perkembangan Produk</label>
                <input type="file" class="form-control" id="foto_produk" name="foto_produk" accept="image/*" required>
                <div class="file-upload-info">Format: JPG/PNG, maksimal 2MB</div>
              </div>
              
              <div class="mb-3">
                <label for="foto_usaha" class="form-label">Foto Aktivitas Usaha</label>
                <input type="file" class="form-control" id="foto_usaha" name="foto_usaha" accept="image/*" required>
                <div class="file-upload-info">Format: JPG/PNG, maksimal 2MB</div>
              </div>
              
              <hr class="my-4">
              
              <h5 class="mb-3">Data Usaha</h5>
              
              <div class="mb-3">
                <label for="omset" class="form-label">Omset Bulanan (Rp)</label>
                <input type="number" class="form-control" id="omset" name="omset" required>
              </div>
              
              <div class="mb-3">
                <label for="asset" class="form-label">Total Asset (Rp)</label>
                <input type="number" class="form-control" id="asset" name="asset" required>
              </div>
              
              <div class="mb-3">
                <label for="tenaga_kerja" class="form-label">Jumlah Tenaga Kerja</label>
                <input type="number" class="form-control" id="tenaga_kerja" name="tenaga_kerja" required>
              </div>
              
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">Submit Dokumen</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>