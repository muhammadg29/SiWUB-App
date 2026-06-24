<?php
require_once 'config.php';

// Check if we're viewing a single news item
$singleNews = false;
$newsItem = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM berita WHERE id = ?");
    $stmt->execute([$id]);
    $newsItem = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($newsItem) {
        $singleNews = true;
    }
}

// If not viewing single news, get all news
if (!$singleNews) {
    $stmt = $conn->query("SELECT * FROM berita ORDER BY tanggal_upload DESC");
    $berita = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="WUB, WUB">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/disdag-berwarna-kepanjangan-1.png" type="image/x-icon">
    <meta name="description" content="">
    
    <title><?= $singleNews ? htmlspecialchars($newsItem['judul']) : 'Home' ?></title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons2/mobirise2.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/parallax/jarallax.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/socicon/css/styles.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="preload" href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css">
    <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
    
    <style>
        /* Custom styles for news detail page */
        .news-detail-container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.05);
            padding: 30px;
            margin: 40px auto;
            max-width: 900px;
        }
        
        .news-header {
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }
        
        .news-image {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 25px;
            max-height: 500px;
            object-fit: cover;
        }
        
        .news-date {
            color: #0066cc;
            font-weight: 500;
        }
        
        .news-content {
            line-height: 1.8;
            color: #444;
            font-size: 1.1rem;
        }
        
        .back-btn {
            background-color: #2c3e50;
            color: white;
            margin-bottom: 20px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .back-btn:hover {
            background-color: #3498db;
        }
        
        /* News card styles */
        .news-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            height: 100%;
            background-color: white;
        }
        
        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.15);
        }
        
        .news-card .card-img-top {
            height: 250px;
            object-fit: cover;
            width: 100%;
        }
        
        .card-title {
            font-weight: 700;
            color: #2c3e50;
            font-size: 1.25rem;
            min-height: 60px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .card-text {
            color: #666;
            min-height: 72px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .read-more-btn {
            background-color: #2c3e50;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .read-more-btn:hover {
            background-color: #3498db;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(52, 152, 219, 0.3);
        }
        
        @media (max-width: 768px) {
            .news-card {
                margin-bottom: 25px;
            }
            
            .card-title {
                min-height: auto;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <section data-bs-version="5.1" class="menu menu2 cid-sFCw1qGFAI" once="menu" id="menu2-23">
        <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
            <div class="container">
                <div class="navbar-brand">
                    <span class="navbar-logo">
                        <a href="index.html">
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
                        <li class="nav-item"><a class="nav-link link text-white display-7" href="index.html#top" aria-expanded="false">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link link text-white display-7" href="infomation.html">Informasi</a></li>
                        <li class="nav-item"><a class="nav-link link text-white display-7" href="Cer.php">Form Perkembangan Usaha</a></li>
                    </ul>
                    <div class="navbar-buttons mbr-section-btn"><a class="btn btn-warning display-4" href="https://muhammadg.my.id/Kursus">Ikuti Pelatihan</a></div>
                </div>
            </div>
        </nav>
    </section>

    <?php if ($singleNews && $newsItem): ?>
        <!-- News Detail Section -->
        <section class="container">
            <div class="news-detail-container">
                <a href="index.php" class="btn back-btn">
                    <i class="bi bi-arrow-left"></i> Kembali ke Beranda
                </a>
                
                <div class="news-header">
                    <h1 class="mb-3"><?= htmlspecialchars($newsItem['judul']) ?></h1>
                    <p class="news-date">
                        <i class="bi bi-calendar"></i> <?= date('d F Y H:i', strtotime($newsItem['tanggal_upload'])) ?>
                    </p>
                    <h5 class="text-muted"><?= htmlspecialchars($newsItem['subjudul']) ?></h5>
                </div>
                
                <?php if($newsItem['nama_file']): ?>
                    <img src="<?= $newsItem['nama_file'] ?>" class="news-image" alt="<?= htmlspecialchars($newsItem['judul']) ?>">
                <?php endif; ?>
                
                <div class="news-content">
                    <?= nl2br(htmlspecialchars($newsItem['isi_berita'])) ?>
                </div>
            </div>
        </section>
        
    <?php else: ?>
        <!-- Hero Section -->
        <section data-bs-version="5.1" class="header6 cid-uoLEEhWmC3 mbr-fullscreen mbr-parallax-background" id="header6-0">
            <div class="mbr-overlay" style="opacity: 0.7; background-color: rgb(0, 0, 0);"></div>
            <div class="align-center container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8">
                        <h1 class="mbr-section-title mbr-fonts-style mbr-white mb-3 display-1"><strong>Bidang Koperasi Usaha Mikro Kecil dan menengah</strong></h1>
                        <p class="mbr-text mbr-white mbr-fonts-style display-5">Layanan Program Wirausaha Baru.</p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- News Section -->
        <section class="container mb-5 mt-5">
            <div class="row">
                <div class="col-12">
                    <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2"><strong>Newsletter Terkini</strong></h3>
                    <br><br>
                </div>
                
                <?php foreach($berita as $item): ?>
                <div class="col-md-4 mb-4">
                    <div class="card news-card h-100">
                        <?php if($item['nama_file']): ?>
                            <img src="<?= $item['nama_file'] ?>" class="card-img-top" alt="<?= htmlspecialchars($item['judul']) ?>">
                        <?php else: ?>
                            <img src="https://source.unsplash.com/random/600x400/?news,<?= rand(1,100) ?>" class="card-img-top" alt="Default news image">
                        <?php endif; ?>
                        <div class="card-body">
                            <span class="news-date">
                                <i class="bi bi-calendar"></i> <?= date('d F Y', strtotime($item['tanggal_upload'])) ?>
                            </span>
                            <h5 class="card-title mt-2"><?= htmlspecialchars($item['judul']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($item['subjudul']) ?></p>
                            <a href="?id=<?= $item['id'] ?>" class="btn read-more-btn">
                                <i class="bi bi-book"></i> Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        
        <!-- Additional Sections -->
        <section data-bs-version="5.1" class="features15 cid-uJivwGC7Bk" id="features16-h">
            <!-- Content remains same as original -->
        </section>
        
        <section data-bs-version="5.1" class="features1 cid-uJivMcxVfD" id="features1-i">
            <!-- Content remains same as original -->
        </section>
        
        <section data-bs-version="5.1" class="testimonials5 cid-uJivwJgFqJ" id="testimonials5-j">
            <!-- Content remains same as original -->
        </section>
        
        <section data-bs-version="5.1" class="contacts3 map1 cid-uoLRd1oxr3" id="contacts3-5">
            <!-- Content remains same as original -->
        </section>
    <?php endif; ?>
    
    <!-- Footer -->
    <section data-bs-version="5.1" class="footer7 cid-uoLQunlmav" once="footers" id="footer7-4">
        <div class="container">
            <div class="media-container-row align-center mbr-white">
                <div class="col-12">
                    <p class="mbr-text mb-0 mbr-fonts-style display-7">
                        KUKM DISDAGKOPERIN Kota Cimahi © Copyright 2025 - All Rights Reserved
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Scripts -->
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/parallax/jarallax.js"></script>
    <script src="assets/smoothscroll/smooth-scroll.js"></script>
    <script src="assets/ytplayer/index.js"></script>
    <script src="assets/dropdown/js/navbar-dropdown.js"></script>
    <script src="assets/theme/js/script.js"></script>
</body>
</html>