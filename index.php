<?php
require_once 'config.php';

// Ambil data berita dari database
$stmt = $conn->query("SELECT * FROM berita ORDER BY tanggal_upload DESC");
$berita = $stmt->fetchAll(PDO::FETCH_ASSOC);
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


    <title>Home</title>
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons2/mobirise2.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/parallax/jarallax.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/socicon/css/styles.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <link rel="preload" href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&display=swap">
    </noscript>
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap">
    </noscript>
    <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css">
    <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">




</head>

<body>

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

    <section data-bs-version="5.1" class="header6 cid-uoLEEhWmC3 mbr-fullscreen mbr-parallax-background" id="header6-0">




        <div class="mbr-overlay" style="opacity: 0.7; background-color: rgb(0, 0, 0);"></div>

        <div class="align-center container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <h1 class="mbr-section-title mbr-fonts-style mbr-white mb-3 display-1"><strong>Bidang Koperasi Usaha Mikro Kecil dan menengah</strong></h1>

                    <p class="mbr-text mbr-white mbr-fonts-style display-5">
                        Layanan Program Wirausaha Baru.
                    </p>

                </div>
            </div>
        </div>
    </section>
    <br><br><br>
    <section class="container mb-5">
        <div class="row">
            <div class="col-12">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2"><strong>Newsletter Terkini</strong></h3>
                <br><br>
                <a href="detail_berita.php">
                    <p>
                        <strong>Lihat Semua Berita</strong>
                    </p>
                </a>
            </div>


            <?php foreach ($berita as $item): ?>
                <div class="col-md-4">
                    <div class="card news-card">
                        <?php if ($item['nama_file']): ?>
                            <img src="<?= $item['nama_file'] ?>"
                                class="img-fluid"
                                style="width: 300px; height: 300px; object-fit: cover;"
                                alt="<?= htmlspecialchars($item['judul']) ?>">
                        <?php else: ?>
                            <img src="https://source.unsplash.com/random/600x400/?news,<?= rand(1, 100) ?>" class="card-img-top news-img" alt="Default news image">
                        <?php endif; ?>
                        <div class="card-body">
                            <span class="news-date">
                                <i class="bi bi-calendar"></i> <?= date('d F Y', strtotime($item['tanggal_upload'])) ?>
                            </span>
                            <h5 class="card-title mt-2"><?= htmlspecialchars($item['judul']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($item['subjudul']) ?></p>
                            <a href="detail_berita.php?id=<?= $item['id'] ?>" class="text-decoration-none">
                                <button class="btn read-more-btn text-BLACK">
                                    Baca Selengkapnya
                                </button>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Modal for each news -->
                <div class="modal fade" id="newsModal<?= $item['id'] ?>" tabindex="-1" aria-labelledby="newsModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="newsModalLabel"><?= htmlspecialchars($item['judul']) ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body news-detail-modal">
                                <?php if ($item['nama_file']): ?>
                                    <img src="<?= $item['nama_file'] ?>" class="img-fluid" style="max-height: 500px;" alt="<?= htmlspecialchars($item['judul']) ?>">
                                <?php endif; ?>
                                <br>
                                <p class="text-muted">
                                    <i class="bi bi-calendar"></i> <?= date('d F Y H:i', strtotime($item['tanggal_upload'])) ?>
                                </p>
                                <h6 class="text-muted mb-3"><?= htmlspecialchars($item['subjudul']) ?></h6>
                                <div><?= nl2br(htmlspecialchars($item['isi_berita'])) ?></div><br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section data-bs-version="5.1" class="features15 cid-uJivwGC7Bk" id="features16-h">
        <div class="container">
            <div class="content-wrapper">
                <div class="row align-items-center">
                    <div class="col-12 col-lg">
                        <div class="text-wrapper">
                            <h6 class="card-title mbr-fonts-style display-2"><strong>Apa itu Program Wirausaha Baru ?</strong></h6>
                            <p class="mbr-text mbr-fonts-style mb-4 display-4">
                                Klik learn more untuk melihat penjelasan detail tentang program wirausaha baru</p>
                            <div class="mbr-section-btn mt-3">
                                <a class="btn btn-warning display-4" href="infomation.html">Learn more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="image-wrapper">
                            <img src="assets/images/wub-1.png" alt="WUB IMAGES">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="features1 cid-uJivMcxVfD" id="features1-i">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2"><strong>Jenis Usaha</strong></h3>
                    <br><br>
                </div>
            </div>
            <div class="row">
                <div class="card col-12 col-md-6 col-lg-3">
                    <div class="card-wrapper">
                        <div class="card-box align-center">
                            <div class="iconfont-wrapper">
                                <span class="mbr-iconfont mobi-mbri-shopping-bag mobi-mbri" style="color: rgb(0, 56, 157); fill: rgb(0, 56, 157);"></span>
                            </div>
                            <h5 class="card-title mbr-fonts-style display-7"><strong>Fashion</strong></h5>
                        </div>
                    </div>
                </div>
                <div class="card col-12 col-md-6 col-lg-3">
                    <div class="card-wrapper">
                        <div class="card-box align-center">
                            <div class="iconfont-wrapper">
                                <span class="mbr-iconfont mobi-mbri-apple mobi-mbri" style="color: rgb(0, 56, 157); fill: rgb(0, 56, 157);"></span>
                            </div>
                            <h5 class="card-title mbr-fonts-style display-7"><strong>Kuliner</strong></h5>
                        </div>
                    </div>
                </div>
                <div class="card col-12 col-md-6 col-lg-3">
                    <div class="card-wrapper">
                        <div class="card-box align-center">
                            <div class="iconfont-wrapper">
                                <span class="mbr-iconfont mobi-mbri-setting mobi-mbri" style="color: rgb(0, 56, 157); fill: rgb(0, 56, 157);"></span>
                            </div>
                            <h5 class="card-title mbr-fonts-style display-7"><strong>Kerajinan</strong></h5>
                        </div>
                    </div>
                </div>
                <div class="card col-12 col-md-6 col-lg-3">
                    <div class="card-wrapper">
                        <div class="card-box align-center">
                            <div class="iconfont-wrapper">
                                <span class="mbr-iconfont mobi-mbri-touch mobi-mbri" style="color: rgb(0, 56, 157); fill: rgb(0, 56, 157);"></span>
                            </div>
                            <h5 class="card-title mbr-fonts-style display-7"><strong>Jasa</strong></h5>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-12">
                    <p class="mbr-fonts-style align-center display-7">Pada program WUB terdapat 4 jenis kategori usaha, para peserta dapat mengakses materi yang di berikan dan memilih sesuai dengan jenis usaha peserta masing-masing</p>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 image-wrapper">
                <img src="assets/images/pak-emir-min-4.png" alt="WUB IMAGES">
            </div>
            <div class="col-12 col-md">
                <div class="text-wrapper">

                    <p class="mbr-text mbr-fonts-style display-7">“Dalam upaya <strong>pemerintah </strong>meningkatkan kapasitas dan <em>managerial</em> usaha bidang koperasi usaha <em>mikro </em>kecil dan menengah, kami memberikan pelayanan peningkatan kapasitas <em>managerial </em>usaha melalui beberapa fasilitasi yang akan di berikan kepada para pelaku usaha kecil.”<br><br><strong>Bapak Emir Faisal</strong><br>Kepala &nbsp;Bidang Koperasi dan Usaha Mikro Dinas Perdagangan, Koperasi, UKM dan Perindustrian Kota Cimahi<br></p>

                </div>
            </div>
        </div>
    </div>
    </section>
    <BR><BR><BR>


    <section data-bs-version="5.1" class="contacts3 map1 cid-uoLRd1oxr3" id="contacts3-5">
        <div class="container">
            <div class="mbr-section-head">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2"><strong>Kontak Kami</strong></h3>
                <h4 class="mbr-section-subtitle mbr-fonts-style align-center mb-0 mt-2 display-7">Komplek Perkantoran Pemkot Cimahi Gedung C Lantai 3 JL.Demang Hardjakusumah Blok Jati Cihanjuang Cimahi</h4>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="card col-12 col-md-6">
                    <div class="card-wrapper">
                        <div class="image-wrapper">
                            <span class="mbr-iconfont mobi-mbri-phone mobi-mbri"></span>
                        </div>
                        <div class="text-wrapper">
                            <h6 class="card-title mbr-fonts-style mb-1 display-5"><strong>Telepone</strong></h6>
                            <p class="mbr-text mbr-fonts-style display-7">
                                <a href="tel:+12345678910" class="text-black">022-665-1816</a>
                            </p>
                        </div>
                    </div>
                    <div class="card-wrapper">
                        <div class="image-wrapper">
                            <span class="mbr-iconfont socicon-mail socicon"></span>
                        </div>
                        <div class="text-wrapper">
                            <h6 class="card-title mbr-fonts-style mb-1 display-5">
                                <strong>Email</strong>
                            </h6>
                            <p class="mbr-text mbr-fonts-style display-7"><a href="mailto:info@site.com" class="text-black">disdagkoperin@cimahikota.go.id </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="map-wrapper col-12 col-md-6">
                    <div class="google-map"><iframe frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyB7QWkvlxV39ZsyKvhZRjPGVqlJFvxxNkw&amp;q=4HH3+QRQ, Jl. Rd. Demang Hardjakusumah Blok Jati, Cihanjuang, Cibabat, Kec. Cimahi Utara, Kota Cimahi, Jawa Barat 40513" allowfullscreen=""></iframe></div>
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="footer7 cid-uoLQunlmav" once="footers" id="footer7-4">
        <div class="container">
            <div class="media-container-row align-center mbr-white">
                <div class="col-12">
                    <p class="mbr-text mb-0 mbr-fonts-style display-7">KUKM DISDAGKOPERIN Kota Cimahi © Copyright 2025 - All Rights Reserved
                    </p>
                </div>
            </div>
        </div>
    </section>

    <script src="assets/bootstrap/js/bootstrap.bundle.min.js">

    </script>
    <script src="assets/parallax/jarallax.js"></script>
    <script src="assets/smoothscroll/smooth-scroll.js"></script>
    <script src="assets/ytplayer/index.js"></script>
    <script src="assets/dropdown/js/navbar-dropdown.js">
    </script>
    <script src="assets/theme/js/script.js"></script>


</body>

</html>