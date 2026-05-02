<?php
require_once('core/functions.php');

$db = getDB();
$ayarlar = $db['ayarlar'];
$urunler = $db['urunler'];

// Mesaj Kaydetme
$success_msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mesaj_gonder'])) {
    $yeniMesaj = [
        "isim" => $_POST['name'],
        "email" => $_POST['email'],
        "mesaj" => $_POST['message'],
        "tarih" => date('Y-m-d H:i:s')
    ];
    $db['mesajlar'][] = $yeniMesaj;
    saveDB($db);
    $success_msg = "Mesajınız başarıyla iletildi!";
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Foods, Restaurant, Coffee">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--====== Title ======-->
    <title><?php echo $ayarlar['site_basligi']; ?></title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">
    <!--====== Google Fonts ======-->
    <link
        href="https://fonts.googleapis.com/css2?family=Marcellus&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <!--====== Flaticon css ======-->
    <link rel="stylesheet" href="assets/fonts/flaticon/flaticon_bistly.css">
    <!--====== FontAwesome css ======-->
    <link rel="stylesheet" href="assets/fonts/fontawesome/css/all.min.css">
    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css">
    <!--====== Slick-popup css ======-->
    <link rel="stylesheet" href="assets/css/plugins/slick.css">
    <!--====== Magnific-popup css ======-->
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup.css">
    <!--====== Nice Select CSS ======-->
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css">
    <!--====== AOS Animation ======-->
    <link rel="stylesheet" href="assets/css/plugins/aos.css">
    <!--====== Common Style css ======-->
    <link rel="stylesheet" href="assets/css/common-style.css">
    <!--====== Style css ======-->
    <link rel="stylesheet" href="assets/css/pages/home-restaurant.css">
    <!--====== Coffee Route Custom css ======-->
    <link rel="stylesheet" href="assets/css/coffee-route.css">
</head>

<body class="restaurant-website">
    <!--====== Start Loader Area ======-->
    <div class="preloader">
        <div class="loader"></div>
    </div><!--====== End Loader Area ======-->
    <!--====== Start Overlay ======-->
    <div class="offcanvas__overlay"></div>
    <!--======  Start Header Area  ======-->
    <header class="header-area header-one sticky-top">
        <div class="container">
            <!--====  Header Navigation  ===-->
            <div class="header-navigation">
                <!--====  Header Nav Inner  ===-->
                <div class="nav-inner-menu">
                    <!--====  Primary Menu  ===-->
                    <div class="primary-menu">
                        <!--====  Site Branding  ===-->
                        <div class="site-branding">
                            <a href="index.php" class="brand-logo text-white fs-2 fw-bold"><i
                                    class="flaticon-coffee me-2 text-accent"></i><?php echo $ayarlar['logo_metni']; ?></a>
                        </div>
                        <!--=== Theme Main Menu ===-->
                        <div class="theme-nav-menu">
                            <nav class="main-menu">
                                <ul>
                                    <li class="menu-item"><a href="index.php">Ana Sayfa</a></li>
                                    <li class="menu-item"><a href="#menu-section">Menü</a></li>
                                    <li class="menu-item"><a href="#contact-section">İletişim</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!--=== Header Nav Right ===-->
                        <div class="nav-right-item">
                            <div class="nav-button d-none d-md-block">
                                <a href="#contact-section" class="theme-btn style-one">İletişime Geç</a>
                            </div>
                            <div class="navbar-toggler">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div id="smooth-wrapper">
        <div id="smooth-content">
            <main>
                <!--======  Start Hero Section  ======-->
                <section class="rs-hero bg_cover" style="background-image: url(industrial_coffee_shop_hero_1777104259380.png);">
                    <div class="container-fluid px-lg-5">
                        <div class="row align-items-start pt-5">
                            <!-- Left Frames -->
                            <div class="col-lg-3 d-none d-lg-block">
                                <div class="d-flex flex-column justify-content-between" style="min-height: 800px;">
                                    <div class="bistly-image hero-arch" style="max-width: 250px;" data-aos="fade-right">
                                        <img src="assets/images/home-coffee/blog/blog-img1.jpg" alt="coffee craft">
                                    </div>
                                    <div class="bistly-image hero-arch mt-auto" style="max-width: 250px; margin-bottom: -50px;" data-aos="fade-right" data-aos-delay="200">
                                        <img src="assets/images/home-coffee/menu/menu-img1.jpg" alt="coffee beans">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Center Content -->
                            <div class="col-lg-6">
                                <div class="hero-content text-center mb-5">
                                    <span class="hero-sub-title d-block mb-3" data-aos="fade-down">Bir Lezzet Yolculuğu</span>
                                    <h1 class="text-anm"><?php echo $ayarlar['logo_metni']; ?></h1>
                                    <h3 class="mb-4 text-accent">"Kahve bir sanattır"</h3>
                                    <p data-aos="fade-up" data-aos-duration="1000" class="lead text-white">Yeni nesil
                                        kahve deneyimi, modern dokunuşlar ve ferah bir atmosfer sizleri bekliyor.</p>
                                </div>
                                
                                <div class="quiz-container text-center mt-5" data-aos="zoom-in">
                                    <h2 class="mb-4 text-white">Hangi Kahveyi İçmelisin?</h2>
                                    <p class="mb-5 text-white-50">Karakterine en uygun kahveyi 3 soruda belirle.</p>
                                    <div id="quiz-content">
                                        <!-- JS will render here -->
                                    </div>
                                    <div id="quiz-result" class="industrial-border"></div>
                                </div>
                            </div>
                            
                            <!-- Right Frames -->
                            <div class="col-lg-3 d-none d-lg-block text-end">
                                <div class="d-flex flex-column justify-content-between h-100" style="min-height: 800px;">
                                    <div class="bistly-image hero-arch ms-auto" style="max-width: 250px;" data-aos="fade-left">
                                        <img src="assets/images/home-coffee/blog/blog-img2.jpg" alt="coffee ritual">
                                    </div>
                                    <div class="bistly-image hero-arch mt-auto ms-auto" style="max-width: 250px; margin-bottom: -50px;" data-aos="fade-left" data-aos-delay="200">
                                        <img src="assets/images/home-coffee/menu/menu-img2.jpg" alt="coffee selection">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!--======  Start Menu Section (Dynamic) ======-->
                <section id="menu-section" class="py-5 bg-dark">
                    <div class="container">
                        <div class="row mb-5">
                            <div class="col-lg-12 text-center">
                                <h2 class="text-accent">Özel Kahve Seçkimiz</h2>
                                <p class="text-white-50">Sizin için özenle hazırladığımız menümüzü keşfedin.</p>
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach ($urunler as $urun): ?>
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="menu-item-card" data-aos="fade-up">
                                        <img src="<?php echo $urun['gorsel']; ?>" class="img-fluid rounded mb-3" alt="<?php echo $urun['isim']; ?>">
                                        <h4 class="coffee-name"><?php echo $urun['isim']; ?></h4>
                                        <p class="text-white-50"><?php echo $urun['aciklama']; ?></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge bg-primary"><?php echo $urun['kategori']; ?></span>
                                            <span class="text-accent fw-bold fs-4"><?php echo $urun['fiyat']; ?> TL</span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>

                <!--====== Contact Section (Dynamic) ======-->
                <section id="contact-section" class="rs-time-sec py-5 p-r z-1">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="card bg-dark industrial-border p-5">
                                    <h2 class="text-white text-center mb-4">Bizimle İletişime Geçin</h2>
                                    <?php if ($success_msg): ?>
                                        <div class="alert alert-success"><?php echo $success_msg; ?></div>
                                    <?php endif; ?>
                                    <form action="index.php#contact-section" method="POST">
                                        <div class="row">
                                            <div class="col-md-6 mb-3"><input type="text" name="name" class="form-control" placeholder="Adınız" required></div>
                                            <div class="col-md-6 mb-3"><input type="email" name="email" class="form-control" placeholder="E-posta" required></div>
                                            <div class="col-12 mb-3"><textarea name="message" class="form-control" rows="5" placeholder="Mesajınız" required></textarea></div>
                                            <div class="col-12 text-center"><button type="submit" name="mesaj_gonder" class="theme-btn style-one">Gönder</button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <!--====== Start Footer ======-->
            <footer class="default-footer rs-footer pt-5 p-r z-1">
                <div class="container">
                    <div class="row py-5">
                        <div class="col-lg-4">
                            <h3 class="text-white mb-4"><?php echo $ayarlar['logo_metni']; ?></h3>
                            <p><?php echo $ayarlar['adres']; ?></p>
                            <p><?php echo $ayarlar['telefon']; ?></p>
                        </div>
                        <div class="col-lg-4">
                            <h4 class="text-white mb-4">Linkler</h4>
                            <ul class="footer-links">
                                <li><a href="admin/login.php">Yönetim Paneli</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!--====== Jquery & Plugins ======-->
    <script src="assets/js/plugins/jquery-3.7.1.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/aos.js"></script>
    <script src="assets/js/common.js"></script>
    <script src="assets/js/coffee-route.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
