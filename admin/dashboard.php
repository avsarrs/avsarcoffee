<?php
require_once('../core/functions.php');
checkLogin();

$db = getDB();
$message = "";

// Ürün Silme
if (isset($_GET['sil'])) {
    $id = $_GET['sil'];
    $db['urunler'] = array_filter($db['urunler'], function($u) use ($id) {
        return $u['id'] != $id;
    });
    saveDB($db);
    header("Location: dashboard.php?tab=urunler&success=1");
    exit;
}

// Ürün Ekleme/Güncelleme
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['urun_kaydet'])) {
    $id = $_POST['id'] ?? null;
    $yeniUrun = [
        "id" => $id ?: (count($db['urunler']) > 0 ? max(array_column($db['urunler'], 'id')) + 1 : 1),
        "isim" => $_POST['isim'],
        "fiyat" => $_POST['fiyat'],
        "kategori" => $_POST['kategori'],
        "aciklama" => $_POST['aciklama'],
        "gorsel" => $_POST['gorsel'] ?: 'assets/images/home-coffee/menu/menu-img1.jpg'
    ];

    if ($id) {
        foreach ($db['urunler'] as &$u) {
            if ($u['id'] == $id) {
                $u = $yeniUrun;
                break;
            }
        }
    } else {
        $db['urunler'][] = $yeniUrun;
    }
    saveDB($db);
    $message = "Ürün başarıyla kaydedildi.";
}

// Ayarları Güncelleme
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ayarlari_kaydet'])) {
    $db['ayarlar'] = [
        "site_basligi" => $_POST['site_basligi'],
        "logo_metni" => $_POST['logo_metni'],
        "telefon" => $_POST['telefon'],
        "eposta" => $_POST['eposta'],
        "adres" => $_POST['adres']
    ];
    saveDB($db);
    $message = "Ayarlar güncellendi.";
}

$tab = $_GET['tab'] ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8" />
    <title>Dashboard | Kavruk Co. Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <script src="assets/js/config.js"></script>
    <link href="assets/css/vendor.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="wrapper">
        <!-- Sidenav -->
        <div class="sidenav-menu">
            <a href="dashboard.php" class="logo">
                <span class="logo-light"><h4 class="mt-3 text-white">KAVRUK CO.</h4></span>
            </a>
            <div data-simplebar>
                <ul class="side-nav">
                    <li class="side-nav-item">
                        <a href="dashboard.php?tab=dashboard" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                            <span class="menu-text"> Dashboard </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="dashboard.php?tab=urunler" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-basket"></i></span>
                            <span class="menu-text"> Ürün Yönetimi </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="dashboard.php?tab=mesajlar" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-message"></i></span>
                            <span class="menu-text"> Mesajlar </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="dashboard.php?tab=ayarlar" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-settings"></i></span>
                            <span class="menu-text"> Site Ayarları </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="logout.php" class="side-nav-link text-danger">
                            <span class="menu-icon"><i class="ti ti-logout"></i></span>
                            <span class="menu-text"> Çıkış Yap </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="page-content">
            <header class="topbar">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <div class="d-flex align-items-center gap-2">
                            <h4 class="mb-0">Yönetim Paneli</h4>
                        </div>
                    </div>
                </div>
            </header>

            <main class="p-4">
                <?php if ($message): ?>
                    <div class="alert alert-success alert-dismissible fade show"><?php echo $message; ?></div>
                <?php endif; ?>

                <?php if ($tab == 'dashboard'): ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card p-3 bg-primary text-white">
                                <h5>Toplam Ürün</h5>
                                <h2><?php echo count($db['urunler']); ?></h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-3 bg-success text-white">
                                <h5>Gelen Mesajlar</h5>
                                <h2><?php echo count($db['mesajlar']); ?></h2>
                            </div>
                        </div>
                    </div>

                <?php elseif ($tab == 'urunler'): ?>
                    <div class="card p-4">
                        <div class="d-flex justify-content-between mb-4">
                            <h4>Ürün Listesi</h4>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#urunModal">Yeni Ürün Ekle</button>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Görsel</th>
                                    <th>İsim</th>
                                    <th>Kategori</th>
                                    <th>Fiyat</th>
                                    <th>İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($db['urunler'] as $u): ?>
                                    <tr>
                                        <td><img src="../<?php echo $u['gorsel']; ?>" height="40" class="rounded"></td>
                                        <td><?php echo $u['isim']; ?></td>
                                        <td><?php echo $u['kategori']; ?></td>
                                        <td><?php echo $u['fiyat']; ?> TL</td>
                                        <td>
                                            <a href="?tab=urunler&sil=<?php echo $u['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Ürün Modal -->
                    <div class="modal fade" id="urunModal" tabindex="-1">
                        <div class="modal-dialog">
                            <form action="dashboard.php?tab=urunler" method="POST" class="modal-content">
                                <div class="modal-header"><h5>Ürün Detayları</h5></div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" id="u_id">
                                    <div class="mb-3"><label>İsim</label><input type="text" name="isim" class="form-control" required></div>
                                    <div class="mb-3"><label>Fiyat</label><input type="text" name="fiyat" class="form-control" required></div>
                                    <div class="mb-3"><label>Kategori</label>
                                        <select name="kategori" class="form-control">
                                            <option>Sıcak Kahveler</option>
                                            <option>Soğuk Kahveler</option>
                                            <option>Tatlılar</option>
                                        </select>
                                    </div>
                                    <div class="mb-3"><label>Açıklama</label><textarea name="aciklama" class="form-control"></textarea></div>
                                    <div class="mb-3"><label>Görsel Yolu</label><input type="text" name="gorsel" class="form-control" placeholder="assets/images/..."></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="urun_kaydet" class="btn btn-primary">Kaydet</button>
                                </div>
                            </form>
                        </div>
                    </div>

                <?php elseif ($tab == 'ayarlar'): ?>
                    <div class="card p-4 col-md-6">
                        <h4>Site Ayarları</h4>
                        <form action="dashboard.php?tab=ayarlar" method="POST">
                            <div class="mb-3"><label>Site Başlığı</label><input type="text" name="site_basligi" class="form-control" value="<?php echo $db['ayarlar']['site_basligi']; ?>"></div>
                            <div class="mb-3"><label>Logo Metni</label><input type="text" name="logo_metni" class="form-control" value="<?php echo $db['ayarlar']['logo_metni']; ?>"></div>
                            <div class="mb-3"><label>Telefon</label><input type="text" name="telefon" class="form-control" value="<?php echo $db['ayarlar']['telefon']; ?>"></div>
                            <div class="mb-3"><label>E-posta</label><input type="text" name="eposta" class="form-control" value="<?php echo $db['ayarlar']['eposta']; ?>"></div>
                            <div class="mb-3"><label>Adres</label><textarea name="adres" class="form-control"><?php echo $db['ayarlar']['adres']; ?></textarea></div>
                            <button type="submit" name="ayarlari_kaydet" class="btn btn-primary">Kaydet</button>
                        </form>
                    </div>
                
                <?php elseif ($tab == 'mesajlar'): ?>
                    <div class="card p-4">
                        <h4>İletişim Mesajları</h4>
                        <table class="table">
                            <thead><tr><th>İsim</th><th>E-posta</th><th>Mesaj</th><th>Tarih</th></tr></thead>
                            <tbody>
                                <?php foreach ($db['mesajlar'] as $m): ?>
                                    <tr>
                                        <td><?php echo $m['isim']; ?></td>
                                        <td><?php echo $m['email']; ?></td>
                                        <td><?php echo $m['mesaj']; ?></td>
                                        <td><?php echo $m['tarih']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </main>
        </div>
    </div>
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>
