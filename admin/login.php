<?php
require_once('../core/functions.php');

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Geçersiz kullanıcı adı veya şifre!";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8" />
    <title>Giriş Yap | Kavruk Co. Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Theme Config Js -->
    <script src="assets/js/config.js"></script>

    <!-- Vendor css -->
    <link href="assets/css/vendor.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body>

    <div class="auth-bg d-flex min-vh-100 justify-content-center align-items-center">
        <div class="row g-0 justify-content-center w-100 m-xxl-5 px-xxl-4 m-3">
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="card overflow-hidden text-center h-100 p-xxl-4 p-3 mb-0">
                    <a href="../index.php" class="auth-brand mb-3">
                        <h2 class="text-primary fw-bold">KAVRUK CO.</h2>
                    </a>

                    <h4 class="fw-semibold mb-2">Yönetim Paneli Girişi</h4>

                    <p class="text-muted mb-4">Lütfen bilgilerinizi giriniz.</p>

                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <form action="login.php" method="POST" class="text-start mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="username">Kullanıcı Adı</label>
                            <input type="text" id="username" name="username" class="form-control" placeholder="admin" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password">Şifre</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="admin" required>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit">Giriş Yap</button>
                        </div>
                    </form>

                    <p class="mt-auto mb-0">
                        <?php echo date('Y'); ?> © Kavruk Co. - Admin Panel
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

</body>

</html>
